<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('email', 'saurabh@tutzy.dev')->first();
if (!$user) {
    echo "User not found.\n";
    exit;
}

echo "User ID: " . $user->id . "\n";
echo "User Role: " . $user->role . "\n";

$tutor = $user->tutorProfile;
if (!$tutor) {
    echo "Tutor profile is NULL.\n";
    $allTutors = \App\Models\Tutor::where('user_id', $user->id)->get();
    echo "Tutors with user_id=" . $user->id . ": " . count($allTutors) . "\n";
    
    // Check what happens if we query it directly
    $directTutor = \App\Models\Tutor::where('user_id', $user->id)->first();
    if ($directTutor) {
        echo "Found directly via user_id! There might be a relationship caching issue or foreign key mismatch.\n";
    } else {
        echo "NOT FOUND directly. Let's check if the seeder worked.\n";
        $codingTutor = \App\Models\Tutor::whereHas('subject', function($q) {
            $q->where('slug', 'coding');
        })->first();
        echo "Coding tutor user_id: " . ($codingTutor ? $codingTutor->user_id : 'Not Found') . "\n";
    }
} else {
    echo "Tutor profile found! ID: " . $tutor->id . "\n";
}
