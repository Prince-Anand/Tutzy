<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('student_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->unique();
            $table->string('avatar')->nullable();            // stored filename in storage/app/public/avatars
            $table->text('bio')->nullable();
            $table->text('learning_goals')->nullable();
            $table->string('timezone')->default('Asia/Kolkata');
            $table->string('preferred_subjects')->nullable(); // JSON-style comma list
            $table->unsignedInteger('weekly_goal_hours')->default(5);
            $table->boolean('notify_email')->default(true);
            $table->boolean('notify_sms')->default(false);
            $table->boolean('notify_lesson_reminders')->default(true);
            $table->boolean('notify_new_messages')->default(true);
            $table->boolean('notify_promotions')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_profiles');
    }
};
