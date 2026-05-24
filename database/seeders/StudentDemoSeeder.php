<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\StudentProfile;
use App\Models\Tutor;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentDemoSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Create or find the demo student ──────────────────────────
        $student = User::firstOrCreate(
            ['email' => 'prince@tutzy.dev'],
            [
                'name'     => 'Prince Anand',
                'password' => Hash::make('password'),
                'role'     => 'student',
            ]
        );

        // ── 2. Student Profile ──────────────────────────────────────────
        StudentProfile::updateOrCreate(
            ['user_id' => $student->id],
            [
                'bio'                     => 'Passionate learner exploring mathematics, physics, and music. Looking for expert guidance to level up my skills.',
                'learning_goals'          => 'Master calculus, improve guitar fingerpicking, and prepare for competitive entrance exams.',
                'timezone'                => 'Asia/Kolkata',
                'preferred_subjects'      => 'Mathematics, Physics, Guitar, English',
                'weekly_goal_hours'       => 8,
                'notify_email'            => true,
                'notify_sms'              => false,
                'notify_lesson_reminders' => true,
                'notify_new_messages'     => true,
                'notify_promotions'       => false,
            ]
        );

        // ── 3. Get tutors (first 6) ─────────────────────────────────────
        $tutors = Tutor::take(6)->get();

        if ($tutors->isEmpty()) {
            $this->command->warn('No tutors found. Run the main database seeder first, then re-run this seeder.');
            return;
        }

        // ── 4. Lessons ──────────────────────────────────────────────────
        // Clear old demo lessons for this student
        Lesson::where('user_id', $student->id)->delete();

        $lessonsData = [
            // UPCOMING
            [
                'tutor_id'         => $tutors[0]->id,
                'title'            => 'Advanced Calculus — Limits & Continuity',
                'subject'          => 'Mathematics',
                'scheduled_at'     => now()->addDays(1)->setHour(10)->setMinute(0),
                'duration_minutes' => 60,
                'status'           => 'upcoming',
                'join_url'         => 'https://meet.tutzy.dev/session/demo-1',
                'notes'            => 'Prepare chapters 3 & 4 from the shared PDF.',
            ],
            [
                'tutor_id'         => $tutors[1 % $tutors->count()]->id,
                'title'            => 'Guitar Fingerpicking — Travis Picking Pattern',
                'subject'          => 'Music',
                'scheduled_at'     => now()->addDays(3)->setHour(16)->setMinute(30),
                'duration_minutes' => 45,
                'status'           => 'upcoming',
                'join_url'         => 'https://meet.tutzy.dev/session/demo-2',
                'notes'            => 'Bring your acoustic guitar. Tuning required.',
            ],
            [
                'tutor_id'         => $tutors[2 % $tutors->count()]->id,
                'title'            => 'IELTS Writing Task 2 — Argument Essays',
                'subject'          => 'English',
                'scheduled_at'     => now()->addDays(5)->setHour(9)->setMinute(0),
                'duration_minutes' => 90,
                'status'           => 'upcoming',
                'join_url'         => 'https://meet.tutzy.dev/session/demo-3',
                'notes'            => 'Topic practice: urbanization & environment.',
            ],
            // COMPLETED
            [
                'tutor_id'         => $tutors[0]->id,
                'title'            => 'Trigonometry — Sine Rule & Applications',
                'subject'          => 'Mathematics',
                'scheduled_at'     => now()->subDays(2)->setHour(11)->setMinute(0),
                'duration_minutes' => 60,
                'status'           => 'completed',
                'rating'           => 5,
                'feedback'         => 'Excellent session! Clear explanations and great pace.',
            ],
            [
                'tutor_id'         => $tutors[1 % $tutors->count()]->id,
                'title'            => 'Newton\'s Laws of Motion — Problem Solving',
                'subject'          => 'Physics',
                'scheduled_at'     => now()->subDays(5)->setHour(15)->setMinute(0),
                'duration_minutes' => 60,
                'status'           => 'completed',
                'rating'           => 4,
                'feedback'         => 'Good session. Would love more practice problems next time.',
            ],
            [
                'tutor_id'         => $tutors[2 % $tutors->count()]->id,
                'title'            => 'Basic Guitar Chords — A, D, E, G',
                'subject'          => 'Music',
                'scheduled_at'     => now()->subDays(8)->setHour(17)->setMinute(0),
                'duration_minutes' => 45,
                'status'           => 'completed',
                'rating'           => 5,
                'feedback'         => 'Super fun session! Finally got the G chord down.',
            ],
            [
                'tutor_id'         => $tutors[3 % $tutors->count()]->id,
                'title'            => 'Essay Writing — Introduction & Thesis',
                'subject'          => 'English',
                'scheduled_at'     => now()->subDays(11)->setHour(10)->setMinute(30),
                'duration_minutes' => 60,
                'status'           => 'completed',
                'rating'           => 4,
            ],
            [
                'tutor_id'         => $tutors[0]->id,
                'title'            => 'Differential Equations — Introduction',
                'subject'          => 'Mathematics',
                'scheduled_at'     => now()->subDays(14)->setHour(9)->setMinute(0),
                'duration_minutes' => 90,
                'status'           => 'completed',
                'rating'           => 5,
            ],
            // CANCELLED
            [
                'tutor_id'         => $tutors[4 % $tutors->count()]->id,
                'title'            => 'Organic Chemistry — Nomenclature',
                'subject'          => 'Chemistry',
                'scheduled_at'     => now()->subDays(4)->setHour(14)->setMinute(0),
                'duration_minutes' => 60,
                'status'           => 'cancelled',
                'notes'            => 'Tutor unavailable due to emergency. Rescheduling.',
            ],
        ];

        foreach ($lessonsData as $data) {
            Lesson::create(array_merge(['user_id' => $student->id], $data));
        }

        // ── 5. Wishlists ────────────────────────────────────────────────
        Wishlist::where('user_id', $student->id)->delete();

        $wishlistTutors = $tutors->take(3);
        foreach ($wishlistTutors as $tutor) {
            Wishlist::firstOrCreate([
                'user_id'  => $student->id,
                'tutor_id' => $tutor->id,
            ]);
        }

        $this->command->info('✅ Student demo data seeded successfully!');
        $this->command->info('   Login: prince@tutzy.dev / password');
        $this->command->info('   Lessons: 3 upcoming, 5 completed, 1 cancelled');
        $this->command->info('   Wishlisted tutors: ' . $wishlistTutors->count());
    }
}
