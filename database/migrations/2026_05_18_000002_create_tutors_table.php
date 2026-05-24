<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tutors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('bio');
            $table->string('country');
            $table->string('country_flag')->default('🌍');
            $table->decimal('rating', 3, 2)->default(5.00);
            $table->unsignedInteger('reviews_count')->default(0);
            $table->unsignedInteger('students_count')->default(0);
            $table->unsignedInteger('lessons_count')->default(0);
            $table->decimal('hourly_rate', 8, 2)->default(25.00);
            $table->string('languages')->default('English');
            $table->string('tutor_type')->default('professional'); // professional, student, native
            $table->string('speciality')->nullable();
            $table->string('availability')->default('flexible'); // flexible, weekdays, weekends
            $table->boolean('is_verified')->default(true);
            $table->boolean('is_online')->default(false);
            $table->string('badge')->nullable(); // top_rated, super_tutor, rising
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tutors');
    }
};
