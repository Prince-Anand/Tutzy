<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FindTutorsController;
use App\Http\Controllers\ForTutorsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\TutorDashboardController;

use Illuminate\Support\Facades\Artisan;


Route::get('/force-seed', function () {
    Artisan::call('db:seed', ['--force' => true]);
    return nl2br(Artisan::output());
});
Route::get('/force-migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return nl2br(Artisan::output());
});
Route::get('/', function () {
    return view('welcome');
});

Route::get('/find-tutors', [FindTutorsController::class, 'index'])->name('find-tutors');
Route::get('/for-tutors', [ForTutorsController::class, 'index'])->name('for-tutors');

// Authentication Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
Route::get('/signup/student', [AuthController::class, 'signupStudent'])->name('signup.student');
Route::post('/signup/student', [AuthController::class, 'signupStudentPost'])->name('signup.student.post');
Route::get('/signup/tutor', [AuthController::class, 'signupTutor'])->name('signup.tutor');
Route::post('/signup/tutor', [AuthController::class, 'signupTutorPost'])->name('signup.tutor.post');

// OAuth Placeholders
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Protected SaaS Routes
Route::middleware('auth')->group(function () {

    // Generic dashboard redirect (role-aware)
    Route::get('/dashboard', function () {
        $role = Auth::user()->role;
        return redirect()->route($role === 'tutor' ? 'tutor.dashboard' : 'student.dashboard');
    })->name('dashboard');

    // ── Student Dashboard ─────────────────────────────────────────────
    Route::prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard',     [StudentDashboardController::class, 'index'])->name('dashboard');
        Route::get('/lessons',       [StudentDashboardController::class, 'lessons'])->name('lessons');
        Route::get('/saved-tutors',  [StudentDashboardController::class, 'savedTutors'])->name('saved-tutors');
        Route::get('/settings',      [StudentDashboardController::class, 'settings'])->name('settings');

        // Settings — form submissions
        Route::post('/settings/profile',       [StudentDashboardController::class, 'updateProfile'])->name('settings.profile');
        Route::post('/settings/password',      [StudentDashboardController::class, 'updatePassword'])->name('settings.password');
        Route::post('/settings/notifications', [StudentDashboardController::class, 'updateNotifications'])->name('settings.notifications');
        Route::post('/settings/learning',      [StudentDashboardController::class, 'updateLearningPrefs'])->name('settings.learning');

        // Wishlist removal
        Route::delete('/saved-tutors/{tutor}', [StudentDashboardController::class, 'removeWishlist'])->name('wishlist.remove');
        
        // Reporting & Cancellation
        Route::post('/lessons/{lesson}/report', [StudentDashboardController::class, 'reportIssue'])->name('lessons.report');
        Route::post('/lessons/{lesson}/cancel', [StudentDashboardController::class, 'cancelLesson'])->name('lessons.cancel');
    });

    // ── Tutor Dashboard ───────────────────────────────────────────────
    Route::prefix('tutor')->name('tutor.')->group(function () {
        Route::get('/dashboard', [TutorDashboardController::class, 'index'])->name('dashboard');
        Route::get('/schedule',  [TutorDashboardController::class, 'schedule'])->name('schedule');
        
        // Lessons
        Route::get('/lessons', [TutorDashboardController::class, 'lessons'])->name('lessons');
        Route::post('/lessons/{lesson}/meeting-link', [TutorDashboardController::class, 'updateMeetingLink'])->name('lessons.meeting-link');
        Route::post('/lessons/{lesson}/complete', [TutorDashboardController::class, 'completeLesson'])->name('lessons.complete');
        
        Route::get('/earnings',  [TutorDashboardController::class, 'earnings'])->name('earnings');
        Route::get('/reviews',   [TutorDashboardController::class, 'reviews'])->name('reviews');
        Route::get('/settings',  [TutorDashboardController::class, 'settings'])->name('settings');
        Route::post('/settings', [TutorDashboardController::class, 'updateSettings'])->name('settings.update');
        Route::post('/settings/availability', [TutorDashboardController::class, 'updateAvailability'])->name('settings.availability');
        Route::post('/lessons/{lesson}/meeting-link', [TutorDashboardController::class, 'updateMeetingLink'])->name('lessons.meeting-link');
    });

    // ── Tutor Interaction ─────────────────────────────────────────────
    Route::get('/tutors/{tutor}/book', function ($tutor) {
        return redirect()->route('find-tutors');
    })->name('tutor.book');

    Route::get('/tutors/{tutor}/message', function ($tutor) {
        return redirect()->back()->with('error', 'Messaging is coming soon!');
    })->name('tutor.message');

    Route::post('/tutors/{tutor:slug}/wishlist', function ($tutor) {
        return redirect()->back()->with('success', "Tutor {$tutor} added to wishlist!");
    })->name('tutor.wishlist.store');

    // ── Booking System ────────────────────────────────────────────────
    Route::get('/api/tutors/{tutor}/slots', [App\Http\Controllers\BookingController::class, 'getSlots'])->name('api.tutors.slots');
    Route::post('/api/tutors/{tutor}/book', [App\Http\Controllers\BookingController::class, 'store'])->name('api.tutors.book');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Redirects
Route::redirect('/get-started', '/login');

