<?php

namespace App\Services;

class MockTutorDashboardDataService
{
    /**
     * Get mock earnings for the dashboard.
     */
    public function getEarningsOverview()
    {
        return [
            'today' => 145.00,
            'this_week' => 840.00,
            'this_month' => 3250.00,
            'pending_payout' => 450.00,
            'completed_lessons' => 28,
            'average_rate' => 30.00,
            'chart_data' => [
                'Mon' => 120,
                'Tue' => 90,
                'Wed' => 180,
                'Thu' => 150,
                'Fri' => 200,
                'Sat' => 100,
                'Sun' => 0
            ]
        ];
    }

    /**
     * Get mock reviews for the tutor.
     */
    public function getRecentReviews()
    {
        return [
            [
                'id' => 1,
                'student_name' => 'Emma Watson',
                'student_avatar' => 'https://ui-avatars.com/api/?name=Emma+Watson&background=a3e635&color=fff',
                'rating' => 5,
                'subject' => 'Advanced Calculus',
                'comment' => 'Saurabh is an incredible tutor! He broke down the complex theorems into easy-to-understand concepts. I finally understand limits and continuity. Highly recommend!',
                'date' => '2 days ago'
            ],
            [
                'id' => 2,
                'student_name' => 'Liam Chen',
                'student_avatar' => 'https://ui-avatars.com/api/?name=Liam+Chen&background=facc15&color=fff',
                'rating' => 5,
                'subject' => 'Python for Beginners',
                'comment' => 'Very patient and structured approach. We built a real script during our first lesson. I feel much more confident now.',
                'date' => '1 week ago'
            ],
            [
                'id' => 3,
                'student_name' => 'Sophia Martinez',
                'student_avatar' => 'https://ui-avatars.com/api/?name=Sophia+Martinez&background=f43f5e&color=fff',
                'rating' => 4.5,
                'subject' => 'IELTS Preparation',
                'comment' => 'Great mock speaking sessions. Gave me actionable feedback on my pronunciation and grammar.',
                'date' => '2 weeks ago'
            ],
            [
                'id' => 4,
                'student_name' => 'James Wilson',
                'student_avatar' => 'https://ui-avatars.com/api/?name=James+Wilson&background=3b82f6&color=fff',
                'rating' => 5,
                'subject' => 'React & Node.js',
                'comment' => 'Helped me debug my full-stack application. We fixed the issue in 15 minutes and spent the rest of the time learning best practices.',
                'date' => '1 month ago'
            ]
        ];
    }

    /**
     * Get mock performance metrics.
     */
    public function getPerformanceMetrics()
    {
        return [
            'response_rate' => '98%',
            'lesson_completion' => '100%',
            'repeat_students' => '15',
            'total_students' => '42',
            'average_rating' => '4.9',
        ];
    }
}
