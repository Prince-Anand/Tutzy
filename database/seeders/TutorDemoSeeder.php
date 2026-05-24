<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Lesson;
use App\Models\StudentProfile;

class TutorDemoSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create a Tutor User
        $user = User::updateOrCreate(
            ['email' => 'saurabh@tutzy.dev'],
            [
                'name' => 'Saurabh Patel',
                'password' => Hash::make('password'),
                'role' => 'tutor',
            ]
        );

        // 2. Assign an existing Tutor profile to this user
        // We'll just grab the first Coding tutor and overwrite its details for the demo.
        $tutor = Tutor::whereHas('subject', function($q) {
            $q->where('slug', 'coding');
        })->first();

        if ($tutor) {
            $tutor->update([
                'user_id' => $user->id,
                'name' => 'Saurabh Patel',
                'slug' => 'saurabh-patel',
                'country' => 'India',
                'country_flag' => '🇮🇳',
                'hourly_rate' => 30.00,
                'rating' => 4.9,
                'reviews_count' => 124,
                'students_count' => 85,
                'lessons_count' => 640,
                'languages' => 'English, Hindi',
                'speciality' => 'React, Next.js, Laravel',
                'bio' => 'Full-stack developer with 6+ years of experience. I love teaching web development from scratch and helping students build real-world SaaS applications.',
                'image' => 'https://ui-avatars.com/api/?name=Saurabh+Patel&background=a3e635&color=fff&size=256'
            ]);
        }

        // 3. Create some mock students to act as lesson attendees
        $studentUser1 = clone $user; // just to get a dummy User model format, we'll create real ones
        
        $students = [
            ['name' => 'Emma Watson', 'email' => 'emma@tutzy.dev'],
            ['name' => 'Liam Chen', 'email' => 'liam@tutzy.dev'],
            ['name' => 'Sophia Martinez', 'email' => 'sophia@tutzy.dev'],
        ];

        $studentModels = [];
        foreach ($students as $s) {
            $su = User::updateOrCreate(
                ['email' => $s['email']],
                [
                    'name' => $s['name'],
                    'password' => Hash::make('password'),
                    'role' => 'student',
                ]
            );
            StudentProfile::firstOrCreate(
                ['user_id' => $su->id],
                [
                    'bio' => 'Student bio',
                    'weekly_goal_hours' => 2,
                    'timezone' => 'UTC'
                ]
            );
            $studentModels[] = $su;
        }

        // 4. Seed Lessons for the Tutor
        // Delete existing mock lessons for this tutor
        Lesson::where('tutor_id', $tutor->id)->delete();

        $now = now();

        $lessonsToCreate = [
            // Today's lessons (upcoming)
            ['user' => $studentModels[0], 'title' => 'React Fundamentals', 'status' => 'upcoming', 'time' => $now->copy()->addHours(2), 'duration' => 60],
            ['user' => $studentModels[1], 'title' => 'Laravel APIs', 'status' => 'upcoming', 'time' => $now->copy()->addHours(4), 'duration' => 90],
            
            // Future lessons (upcoming)
            ['user' => $studentModels[2], 'title' => 'Next.js App Router', 'status' => 'upcoming', 'time' => $now->copy()->addDays(1)->setHour(10), 'duration' => 60],
            ['user' => $studentModels[0], 'title' => 'State Management', 'status' => 'upcoming', 'time' => $now->copy()->addDays(2)->setHour(14), 'duration' => 60],
            
            // Completed lessons
            ['user' => $studentModels[1], 'title' => 'PHP Basics', 'status' => 'completed', 'time' => $now->copy()->subDays(1)->setHour(10), 'duration' => 60],
            ['user' => $studentModels[2], 'title' => 'Database Design', 'status' => 'completed', 'time' => $now->copy()->subDays(2)->setHour(15), 'duration' => 90],
            ['user' => $studentModels[0], 'title' => 'JavaScript ES6', 'status' => 'completed', 'time' => $now->copy()->subDays(3)->setHour(9), 'duration' => 60],
            
            // Cancelled
            ['user' => $studentModels[1], 'title' => 'Authentication', 'status' => 'cancelled', 'time' => $now->copy()->subDays(4)->setHour(11), 'duration' => 60],
        ];

        foreach ($lessonsToCreate as $l) {
            Lesson::create([
                'user_id' => $l['user']->id,
                'tutor_id' => $tutor->id,
                'title' => $l['title'],
                'status' => $l['status'],
                'scheduled_at' => $l['time'],
                'duration_minutes' => $l['duration'],
            ]);
        }

        $this->command->info('✅ Tutor demo data seeded successfully!');
        $this->command->info('   Login: saurabh@tutzy.dev / password');
    }
}
