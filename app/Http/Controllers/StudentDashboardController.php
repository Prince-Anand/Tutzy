<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\StudentProfile;
use App\Models\Tutor;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class StudentDashboardController extends Controller
{
    // ─── Dashboard Home ────────────────────────────────────────────────

    public function index(): View
    {
        $user = Auth::user()->load(['studentProfile', 'lessons.tutor', 'wishlists.tutor']);

        // Quick Stats
        $stats = [
            'lessons_completed' => $user->lessons->where('status', Lesson::STATUS_COMPLETED)->count(),
            'tutors_saved'      => $user->wishlists->count(),
            'hours_learned'     => $user->lessons
                ->where('status', Lesson::STATUS_COMPLETED)
                ->sum('duration_minutes') / 60,
            'weekly_progress'   => $this->weeklyProgressPercent($user),
        ];

        // Next upcoming lesson
        $nextLesson = $user->lessons
            ->where('status', Lesson::STATUS_UPCOMING)
            ->sortBy('scheduled_at')
            ->first();

        // Upcoming lessons (next 3 after nextLesson)
        $upcomingLessons = $user->lessons
            ->where('status', Lesson::STATUS_UPCOMING)
            ->sortBy('scheduled_at')
            ->take(3)
            ->values();

        // Recommended tutors (not already wishlisted, random selection)
        $wishedIds = $user->wishlists->pluck('tutor_id')->toArray();
        $recommended = Tutor::whereNotIn('id', $wishedIds)
            ->inRandomOrder()
            ->take(4)
            ->get();

        // Subject progress (from completed lessons)
        $subjectProgress = $user->lessons
            ->where('status', Lesson::STATUS_COMPLETED)
            ->groupBy('subject')
            ->map(fn($g) => [
                'subject' => $g->first()->subject,
                'count'   => $g->count(),
            ])
            ->values()
            ->take(4);

        // Recent activity (last 5 lessons of any status, newest first)
        $recentActivity = $user->lessons
            ->sortByDesc('updated_at')
            ->take(5)
            ->values();

        // Learning streak (days) - simplified: count distinct days with completed lessons in last 30 days
        $streak = $user->lessons
            ->where('status', Lesson::STATUS_COMPLETED)
            ->filter(fn($l) => $l->scheduled_at->gte(now()->subDays(30)))
            ->pluck('scheduled_at')
            ->map(fn($d) => $d->toDateString())
            ->unique()
            ->count();

        return view('student.dashboard', compact(
            'user', 'stats', 'nextLesson', 'upcomingLessons',
            'recommended', 'subjectProgress', 'recentActivity', 'streak'
        ));
    }

    // ─── My Lessons ────────────────────────────────────────────────────

    public function lessons(Request $request): View
    {
        $user   = Auth::user();
        $filter = $request->input('status', 'upcoming');

        $lessons = Lesson::where('user_id', $user->id)
            ->where('status', $filter)
            ->with('tutor')
            ->orderBy('scheduled_at', $filter === 'upcoming' ? 'asc' : 'desc')
            ->get();

        $counts = [
            'upcoming'  => Lesson::where('user_id', $user->id)->where('status', 'upcoming')->count(),
            'completed' => Lesson::where('user_id', $user->id)->where('status', 'completed')->count(),
            'cancelled' => Lesson::where('user_id', $user->id)->where('status', 'cancelled')->count(),
        ];

        return view('student.lessons', compact('lessons', 'filter', 'counts'));
    }

    // ─── Saved Tutors ──────────────────────────────────────────────────

    public function savedTutors(): View
    {
        $user = Auth::user();

        $savedTutors = Wishlist::where('user_id', $user->id)
            ->with('tutor.subject')
            ->latest()
            ->get()
            ->pluck('tutor')
            ->filter();

        return view('student.saved-tutors', compact('savedTutors'));
    }

    public function removeWishlist(Request $request, int $tutorId): RedirectResponse
    {
        Wishlist::where('user_id', Auth::id())
            ->where('tutor_id', $tutorId)
            ->delete();

        return back()->with('success', 'Tutor removed from your saved list.');
    }

    // ─── Settings ──────────────────────────────────────────────────────

    public function settings(): View
    {
        $user    = Auth::user()->load('studentProfile');
        $profile = $user->studentProfile ?? new StudentProfile(['user_id' => $user->id]);

        return view('student.settings', compact('user', 'profile'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'bio'            => ['nullable', 'string', 'max:500'],
            'learning_goals' => ['nullable', 'string', 'max:500'],
            'avatar'         => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        // Handle avatar upload
        $avatarFilename = null;
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            $profile = $user->studentProfile;
            if ($profile && $profile->avatar) {
                Storage::disk('public')->delete('avatars/' . $profile->avatar);
            }
            $file           = $request->file('avatar');
            $avatarFilename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('avatars', $avatarFilename, 'public');
        }

        // Update user name/email
        $user->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Update or create student profile
        $profileData = [
            'bio'            => $validated['bio'] ?? null,
            'learning_goals' => $validated['learning_goals'] ?? null,
        ];
        if ($avatarFilename) {
            $profileData['avatar'] = $avatarFilename;
        }

        StudentProfile::updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return back()->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Password updated successfully!');
    }

    public function updateNotifications(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'notify_email'            => ['boolean'],
            'notify_sms'              => ['boolean'],
            'notify_lesson_reminders' => ['boolean'],
            'notify_new_messages'     => ['boolean'],
            'notify_promotions'       => ['boolean'],
        ]);

        StudentProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'notify_email'            => $request->boolean('notify_email'),
                'notify_sms'              => $request->boolean('notify_sms'),
                'notify_lesson_reminders' => $request->boolean('notify_lesson_reminders'),
                'notify_new_messages'     => $request->boolean('notify_new_messages'),
                'notify_promotions'       => $request->boolean('notify_promotions'),
            ]
        );

        return back()->with('success', 'Notification preferences saved!');
    }

    public function updateLearningPrefs(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $validated = $request->validate([
            'timezone'           => ['nullable', 'string', 'max:100'],
            'preferred_subjects' => ['nullable', 'string', 'max:255'],
            'weekly_goal_hours'  => ['nullable', 'integer', 'min:1', 'max:40'],
        ]);

        StudentProfile::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return back()->with('success', 'Learning preferences updated!');
    }

    // ─── Helpers ───────────────────────────────────────────────────────

    private function weeklyProgressPercent($user): int
    {
        $profile   = $user->studentProfile;
        $goalHours = $profile ? $profile->weekly_goal_hours : 5;

        $thisWeekMinutes = $user->lessons
            ->where('status', Lesson::STATUS_COMPLETED)
            ->filter(fn($l) => $l->scheduled_at->isCurrentWeek())
            ->sum('duration_minutes');

        $goalMinutes = $goalHours * 60;
        if ($goalMinutes === 0) return 0;

        return min(100, (int) round(($thisWeekMinutes / $goalMinutes) * 100));
    }

    public function reportIssue(Request $request, Lesson $lesson): RedirectResponse
    {
        $user = Auth::user();
        if ($lesson->user_id !== $user->id) {
            abort(403);
        }

        $validated = $request->validate([
            'issue_type' => 'required|string|in:link_not_working,tutor_absent,wrong_details',
            'notes' => 'nullable|string|max:500'
        ]);

        \App\Models\LessonReport::create([
            'lesson_id' => $lesson->id,
            'user_id' => Auth::id(),
            'issue_type' => $validated['issue_type'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Your report has been submitted. Our team will review it shortly.');
    }

    public function cancelLesson(Request $request, Lesson $lesson)
    {
        if ($lesson->user_id !== Auth::id()) {
            abort(403);
        }

        if ($lesson->status !== 'upcoming') {
            return back()->with('error', 'Only upcoming lessons can be cancelled.');
        }

        $validated = $request->validate([
            'cancellation_reason' => ['required', 'string', 'max:500'],
        ]);

        $lesson->update([
            'status' => 'cancelled',
            'cancellation_reason' => $validated['cancellation_reason'],
            'cancelled_by' => 'student',
        ]);

        return back()->with('success', 'Session cancelled successfully. A full refund will be provided.');
    }
}
