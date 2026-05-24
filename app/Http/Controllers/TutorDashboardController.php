<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lesson;
use App\Models\Tutor;
use Illuminate\Support\Str;
use Carbon\Carbon;

class TutorDashboardController extends Controller
{
    private function getTutorProfile()
    {
        $user = Auth::user();
        $tutor = $user->tutorProfile;

        if (!$tutor) {
            $tutor = Tutor::create([
                'user_id' => $user->id,
                'subject_id' => 1,
                'name' => $user->name,
                'slug' => Str::slug($user->name) . '-' . uniqid(),
                'bio' => 'I am a new tutor on Tutzy. I look forward to helping students achieve their goals!',
                'country' => 'Global',
                'hourly_rate' => 25.00,
            ]);
            $user->refresh(); // Refresh the relationship
        }

        return $tutor;
    }

    /**
     * Helper to get real earnings metrics.
     */
    private function getRealEarningsData($tutor)
    {
        $allCompleted = Lesson::where('tutor_id', $tutor->id)->where('status', 'completed')->get();
        
        $totalCompletedLessons = $allCompleted->count();
        $grossEarnings = $totalCompletedLessons * $tutor->hourly_rate;
        $pendingPayout = $grossEarnings * 0.85; // 15% platform fee deduction

        $completedThisMonthCount = $allCompleted->filter(function($lesson) {
            return $lesson->scheduled_at->isCurrentMonth();
        })->count();
        $thisMonthEarnings = $completedThisMonthCount * $tutor->hourly_rate;

        // Chart Data: Earnings per day for the last 7 days
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayName = $date->format('D');
            
            $lessonsOnDayCount = $allCompleted->filter(function($lesson) use ($date) {
                return $lesson->scheduled_at->isSameDay($date);
            })->count();
            
            $chartData[$dayName] = $lessonsOnDayCount * $tutor->hourly_rate;
        }

        return [
            'pending_payout' => $pendingPayout,
            'this_month' => $thisMonthEarnings,
            'completed_lessons' => $totalCompletedLessons,
            'average_rate' => $tutor->hourly_rate,
            'chart_data' => $chartData,
        ];
    }

    /**
     * Helper to get real performance metrics.
     */
    private function getRealMetricsData($tutor)
    {
        $allLessons = Lesson::where('tutor_id', $tutor->id)->get();
        $completedCount = $allLessons->where('status', 'completed')->count();
        $cancelledCount = $allLessons->where('status', 'cancelled')->count();
        $totalCount = $completedCount + $cancelledCount;

        $completionRate = $totalCount > 0 ? round(($completedCount / $totalCount) * 100) : 100;
        
        $totalStudents = $allLessons->pluck('user_id')->unique()->count();
        
        $repeatStudentsCount = $allLessons->where('status', 'completed')
            ->groupBy('user_id')
            ->filter(fn($lessons) => $lessons->count() > 1)
            ->count();

        $ratingAverage = $allLessons->where('status', 'completed')->whereNotNull('rating')->avg('rating') ?? 0;

        return [
            'response_rate' => '100%', // Mocked for now as we don't have a messaging system
            'completion_rate' => $completionRate . '%',
            'total_students' => $totalStudents,
            'repeat_students' => $repeatStudentsCount,
            'rating_average' => number_format($ratingAverage, 1)
        ];
    }

    /**
     * Display the main tutor dashboard.
     */
    public function index()
    {
        $user = Auth::user();
        $tutor = $this->getTutorProfile();

        // Fetch today's lessons
        $todaysLessons = Lesson::where('tutor_id', $tutor->id)
            ->where('status', 'upcoming')
            ->whereDate('scheduled_at', today())
            ->orderBy('scheduled_at')
            ->with('user.studentProfile')
            ->get();

        $earnings = $this->getRealEarningsData($tutor);
        $metrics = $this->getRealMetricsData($tutor);
        
        // Get top 2 recent reviews
        $reviews = Lesson::where('tutor_id', $tutor->id)
            ->where('status', 'completed')
            ->whereNotNull('rating')
            ->whereNotNull('feedback')
            ->orderBy('scheduled_at', 'desc')
            ->with('user.studentProfile')
            ->take(2)
            ->get();

        // Count upcoming lessons for the widget
        $upcomingCount = Lesson::where('tutor_id', $tutor->id)
            ->where('status', 'upcoming')
            ->count();

        return view('tutor.dashboard', compact('tutor', 'todaysLessons', 'earnings', 'metrics', 'reviews', 'upcomingCount'));
    }

    /**
     * Display the schedule page.
     */
    public function schedule(Request $request)
    {
        $tutor = $this->getTutorProfile();
        
        $selectedDate = $request->query('date', now()->format('Y-m-d'));
        
        // Fetch upcoming lessons for the timeline
        $upcomingLessons = Lesson::where('tutor_id', $tutor->id)
            ->where('status', 'upcoming')
            ->whereDate('scheduled_at', $selectedDate)
            ->orderBy('scheduled_at')
            ->with('user.studentProfile')
            ->get();

        return view('tutor.schedule', compact('tutor', 'upcomingLessons'));
    }

    /**
     * Display all lessons (upcoming, completed, cancelled).
     */
    public function lessons(Request $request)
    {
        $tutor = $this->getTutorProfile();
        $status = $request->query('status', 'upcoming');

        $lessons = Lesson::where('tutor_id', $tutor->id)
            ->where('status', $status)
            ->orderBy('scheduled_at', $status === 'upcoming' ? 'asc' : 'desc')
            ->with('user.studentProfile')
            ->get();

        return view('tutor.lessons', compact('tutor', 'lessons', 'status'));
    }

    /**
     * Display the earnings page.
     */
    public function earnings()
    {
        $tutor = $this->getTutorProfile();
        $earnings = $this->getRealEarningsData($tutor);
        
        $recentTransactions = Lesson::where('tutor_id', $tutor->id)
            ->where('status', 'completed')
            ->orderBy('scheduled_at', 'desc')
            ->with('user')
            ->take(5)
            ->get();

        return view('tutor.earnings', compact('tutor', 'earnings', 'recentTransactions'));
    }

    /**
     * Display the reviews page.
     */
    public function reviews()
    {
        $tutor = $this->getTutorProfile();
        $metrics = $this->getRealMetricsData($tutor);
        
        $reviews = Lesson::where('tutor_id', $tutor->id)
            ->where('status', 'completed')
            ->whereNotNull('rating')
            ->orderBy('scheduled_at', 'desc')
            ->with('user.studentProfile')
            ->get();

        return view('tutor.reviews', compact('tutor', 'reviews', 'metrics'));
    }

    /**
     * Display the settings page.
     */
    public function settings()
    {
        $user = Auth::user();
        $tutor = $this->getTutorProfile();
        $availabilities = $tutor->availabilities->keyBy('day_of_week');

        return view('tutor.settings', compact('user', 'tutor', 'availabilities'));
    }

    /**
     * Update the settings for the tutor.
     */
    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        $tutor = $this->getTutorProfile();

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'country' => 'sometimes|nullable|string|max:255',
            'languages' => 'sometimes|nullable|string|max:255',
            'bio' => 'sometimes|nullable|string',
            'hourly_rate' => 'sometimes|numeric|min:50|max:10000',
            'subject_id' => 'sometimes|nullable|exists:subjects,id',
            'speciality' => 'sometimes|nullable|string|max:255',
            'avatar' => 'sometimes|nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $validated['image'] = $path;
            unset($validated['avatar']);
        }

        if (isset($validated['name'])) {
            $user->update(['name' => $validated['name']]);
        }

        $tutor->update($validated);

        return back()->with('success', 'Settings updated successfully.');
    }

    /**
     * Update the tutor's availability schedule.
     */
    public function updateAvailability(Request $request)
    {
        $tutor = $this->getTutorProfile();
        
        $validated = $request->validate([
            'availabilities' => 'required|array',
            'availabilities.*.is_available' => 'sometimes|boolean',
            'availabilities.*.start_time' => 'nullable|date_format:H:i',
            'availabilities.*.end_time' => 'nullable|date_format:H:i|after:availabilities.*.start_time',
        ]);

        foreach ($validated['availabilities'] as $day => $data) {
            $isAvailable = isset($data['is_available']) ? true : false;
            
            $tutor->availabilities()->updateOrCreate(
                ['day_of_week' => $day],
                [
                    'is_available' => $isAvailable,
                    'start_time' => $isAvailable ? $data['start_time'] : null,
                    'end_time' => $isAvailable ? $data['end_time'] : null,
                ]
            );
        }

        return back()->with('success', 'Availability updated successfully.');
    }
    public function updateMeetingLink(Request $request, Lesson $lesson)
    {
        $tutor = $this->getTutorProfile();
        
        if ($lesson->tutor_id !== $tutor->id) {
            abort(403);
        }

        $request->validate([
            'meeting_link' => ['nullable', 'url', function ($attribute, $value, $fail) {
                if ($value) {
                    $host = parse_url($value, PHP_URL_HOST);
                    if (!preg_match('/(zoom\.us|meet\.google\.com|teams\.microsoft\.com)$/', $host)) {
                        $fail('The meeting link must be from Zoom, Google Meet, or Microsoft Teams.');
                    }
                }
            }],
        ]);

        $lesson->update([
            'meeting_link' => $request->meeting_link
        ]);

        return redirect()->back()->with('success', 'Meeting link updated successfully.');
    }

    public function completeLesson(Request $request, Lesson $lesson)
    {
        $tutor = $this->getTutorProfile();
        
        if ($lesson->tutor_id !== $tutor->id) {
            abort(403);
        }

        if ($lesson->status !== 'upcoming') {
            return back()->with('error', 'Only upcoming lessons can be marked as completed.');
        }

        // Optional: Ensure time has passed before allowing completion
        if ($lesson->scheduled_at->isFuture()) {
            return back()->with('error', 'Cannot complete a lesson before its scheduled time.');
        }

        $lesson->update([
            'status' => 'completed'
        ]);

        return back()->with('success', 'Session marked as completed!');
    }
}
