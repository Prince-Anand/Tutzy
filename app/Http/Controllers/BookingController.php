<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tutor;
use App\Models\Lesson;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Fetch available time slots for a specific date via AJAX.
     */
    public function getSlots(Request $request, Tutor $tutor)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
        ]);

        $date = Carbon::parse($request->date);
        
        // Cannot book in the past
        if ($date->isPast() && !$date->isToday()) {
            return response()->json(['slots' => []]);
        }

        $dayOfWeek = $date->dayOfWeek; // 0 (Sunday) to 6 (Saturday)
        
        $availability = $tutor->availabilities()->where('day_of_week', $dayOfWeek)->first();

        if (!$availability || !$availability->is_available) {
            return response()->json(['slots' => []]);
        }

        $startTime = Carbon::parse($date->format('Y-m-d') . ' ' . $availability->start_time);
        $endTime = Carbon::parse($date->format('Y-m-d') . ' ' . $availability->end_time);

        // Fetch existing booked lessons for this tutor on this date
        $bookedTimes = Lesson::where('tutor_id', $tutor->id)
            ->whereDate('scheduled_at', $date->format('Y-m-d'))
            ->whereIn('status', [Lesson::STATUS_UPCOMING, Lesson::STATUS_COMPLETED])
            ->pluck('scheduled_at')
            ->map(fn($dt) => $dt->format('H:i'))
            ->toArray();

        $slots = [];
        $now = Carbon::now();

        // Generate 1-hour slots
        while ($startTime->copy()->addHour()->lte($endTime)) {
            $slotTime = $startTime->format('H:i');
            
            // 12 hour minimum notice rule
            $isNoticeMet = $startTime->diffInHours($now) >= 12 && $startTime->isFuture();
            
            // Allow immediate bookings for demo account (prince@tutzy.dev)
            $isDemoUser = auth()->check() && auth()->user()->email === 'prince@tutzy.dev';
            $isNoticeMet = $now->diffInHours($startTime, false) >= ($isDemoUser ? 0 : 12);

            if ($isNoticeMet && !in_array($slotTime, $bookedTimes)) {
                $slots[] = [
                    'time' => $slotTime,
                    'label' => $startTime->format('g:i A'),
                ];
            }
            
            $startTime->addHour();
        }

        return response()->json(['slots' => $slots]);
    }

    /**
     * Store the booking.
     */
    public function store(Request $request, Tutor $tutor)
    {
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required|date_format:H:i',
        ]);

        $scheduledAt = Carbon::parse($request->date . ' ' . $request->time);
        $now = Carbon::now();

        // 1. Minimum notice check (Bypassed for demo account)
        $isDemoUser = auth()->check() && auth()->user()->email === 'prince@tutzy.dev';
        $minHours = $isDemoUser ? 0 : 12;
        
        if ($now->diffInHours($scheduledAt, false) < $minHours) {
            return response()->json(['error' => 'Bookings must be made at least 12 hours in advance.'], 422);
        }

        // 2. Availability check
        $dayOfWeek = $scheduledAt->dayOfWeek;
        $availability = $tutor->availabilities()->where('day_of_week', $dayOfWeek)->first();

        if (!$availability || !$availability->is_available) {
            return response()->json(['error' => 'Tutor is not available on this day.'], 422);
        }

        $startTime = Carbon::parse($request->date . ' ' . $availability->start_time);
        $endTime = Carbon::parse($request->date . ' ' . $availability->end_time);

        if ($scheduledAt->lt($startTime) || $scheduledAt->copy()->addHour()->gt($endTime)) {
            return response()->json(['error' => 'Selected time is outside tutor availability.'], 422);
        }

        // 3. Conflict check
        $conflict = Lesson::where('tutor_id', $tutor->id)
            ->where('scheduled_at', $scheduledAt)
            ->whereIn('status', [Lesson::STATUS_UPCOMING, Lesson::STATUS_COMPLETED])
            ->exists();

        if ($conflict) {
            return response()->json(['error' => 'This time slot has already been booked.'], 422);
        }

        // Create Lesson
        Lesson::create([
            'user_id' => auth()->id(),
            'tutor_id' => $tutor->id,
            'title' => 'Lesson with ' . $tutor->name,
            'subject' => $tutor->subject->name ?? 'General',
            'scheduled_at' => $scheduledAt,
            'duration_minutes' => 60,
            'status' => Lesson::STATUS_UPCOMING,
        ]);

        return response()->json(['success' => true, 'message' => 'Lesson booked successfully!']);
    }
}
