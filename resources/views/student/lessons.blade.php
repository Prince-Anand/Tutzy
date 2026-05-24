@extends('layouts.dashboard')

@section('title', 'My Lessons')
@php $pageTitle = 'My Lessons'; @endphp

@section('content')
<div class="dash-page" x-data="{ activeTab: '{{ $filter }}' }">

    {{-- ══ PAGE HEADER ══════════════════════════════════════════════ --}}
    <div class="dash-welcome">
        <div class="dash-welcome__text">
            <h2 class="dash-welcome__heading">My Lessons</h2>
            <p class="dash-welcome__sub">Track all your booked, completed, and cancelled sessions.</p>
        </div>
        <a href="{{ route('find-tutors') }}" class="dash-welcome__cta">
            @include('components.dashboard.icon', ['name' => 'search', 'size' => 16])
            Book a Lesson
        </a>
    </div>

    {{-- ══ FILTER TABS ══════════════════════════════════════════════ --}}
    <div class="dash-card p-2 flex gap-1">
        @php
            $tabs = [
                ['key' => 'upcoming',  'label' => 'Upcoming',  'count' => $counts['upcoming']],
                ['key' => 'completed', 'label' => 'Completed', 'count' => $counts['completed']],
                ['key' => 'cancelled', 'label' => 'Cancelled', 'count' => $counts['cancelled']],
            ];
        @endphp
        @foreach($tabs as $tab)
            <a href="{{ route('student.lessons', ['status' => $tab['key']]) }}"
               class="dash-tab {{ $filter === $tab['key'] ? 'dash-tab--active' : '' }}">
                {{ $tab['label'] }}
                <span class="dash-tab__count {{ $filter === $tab['key'] ? 'dash-tab__count--active' : '' }}">{{ $tab['count'] }}</span>
            </a>
        @endforeach
    </div>

    {{-- ══ LESSONS LIST ═════════════════════════════════════════════ --}}
    @if($lessons->isEmpty())
        <div class="dash-card">
            <div class="dash-empty-state py-16">
                <div class="dash-empty-state__icon text-5xl">
                    @if($filter === 'upcoming') 📅
                    @elseif($filter === 'completed') 🎓
                    @else ❌
                    @endif
                </div>
                <p class="dash-empty-state__heading">
                    @if($filter === 'upcoming') No upcoming lessons
                    @elseif($filter === 'completed') No completed lessons yet
                    @else No cancelled lessons
                    @endif
                </p>
                <p class="dash-empty-state__text mt-1">
                    @if($filter === 'upcoming') Book a session with a tutor to get started.
                    @elseif($filter === 'completed') Your completed sessions will appear here after your first lesson.
                    @else Great! You haven't cancelled any lessons.
                    @endif
                </p>
                @if($filter === 'upcoming')
                    <a href="{{ route('find-tutors') }}" class="dash-btn-lime mt-5">Find a Tutor</a>
                @endif
            </div>
        </div>
    @else
        <div class="flex flex-col gap-4">
            @foreach($lessons as $lesson)
                <div class="dash-lesson-card">

                    {{-- Tutor Avatar --}}
                    <div class="dash-lesson-card__avatar">
                        @if($lesson->tutor && $lesson->tutor->image)
                            <img src="{{ str_starts_with($lesson->tutor->image, 'http') ? $lesson->tutor->image : '/storage/' . $lesson->tutor->image }}" alt="{{ $lesson->tutor->name }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-lg font-bold text-lime-600">
                                {{ strtoupper(substr($lesson->tutor->name ?? 'T', 0, 1)) }}
                            </span>
                        @endif
                    </div>

                    {{-- Lesson Info --}}
                    <div class="dash-lesson-card__info">
                        <div class="flex items-start justify-between gap-3 flex-wrap">
                            <div>
                                <h4 class="dash-lesson-card__title">{{ $lesson->title }}</h4>
                                <p class="dash-lesson-card__tutor">with {{ $lesson->tutor->name ?? 'Unknown Tutor' }}</p>
                            </div>
                            <span class="dash-status-badge dash-status-badge--{{ $lesson->status }}">
                                @if($lesson->status === 'upcoming') 🟢 Upcoming
                                @elseif($lesson->status === 'completed') ✅ Completed
                                @else ❌ Cancelled
                                @endif
                            </span>
                        </div>

                        <div class="dash-lesson-card__meta">
                            <span class="dash-lesson-card__meta-item">
                                @include('components.dashboard.icon', ['name' => 'calendar', 'size' => 14])
                                {{ $lesson->scheduled_at->format('D, M j, Y') }}
                            </span>
                            <span class="dash-lesson-card__meta-item">
                                @include('components.dashboard.icon', ['name' => 'clock', 'size' => 14])
                                {{ $lesson->scheduled_at->format('g:i A') }}
                            </span>
                            <span class="dash-lesson-card__meta-item">
                                @include('components.dashboard.icon', ['name' => 'book-open', 'size' => 14])
                                {{ $lesson->subject }} · {{ $lesson->duration_label }}
                            </span>
                        </div>

                        @if($lesson->notes)
                            <p class="text-xs text-gray-400 mt-2 italic line-clamp-1">{{ $lesson->notes }}</p>
                        @endif
                    </div>

                    {{-- CTA --}}
                    <div class="dash-lesson-card__actions">
                        @if($lesson->status === 'upcoming')
                            <div class="flex flex-col gap-1 items-end shrink-0">
                                @if($lesson->meeting_link)
                                    <a href="{{ $lesson->meeting_link }}" target="_blank" rel="noopener noreferrer" class="dash-btn-lime dash-btn-sm flex items-center gap-1 whitespace-nowrap">
                                        @include('components.dashboard.icon', ['name' => 'external-link', 'size' => 14])
                                        Join Meeting
                                    </a>
                                    <div class="flex items-center gap-2 mt-1">
                                        <button @click="$dispatch('open-cancel-modal', { id: {{ $lesson->id }} })" class="text-[10px] text-red-500 hover:text-red-700 font-medium underline decoration-dashed underline-offset-2">Cancel Session</button>
                                        <span class="text-gray-300 text-[10px]">|</span>
                                        <button @click="$dispatch('open-report-modal', { id: {{ $lesson->id }} })" class="text-[10px] text-gray-400 hover:text-gray-600 underline decoration-dashed underline-offset-2">Having trouble?</button>
                                    </div>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[11px] font-medium text-gray-400 bg-gray-50 border border-gray-100 px-2 py-1.5 rounded-md" title="Waiting for tutor to add meeting link">
                                        @include('components.dashboard.icon', ['name' => 'clock', 'size' => 12])
                                        Waiting for link
                                    </span>
                                    <button @click="$dispatch('open-cancel-modal', { id: {{ $lesson->id }} })" class="mt-1 text-[10px] text-red-500 hover:text-red-700 font-medium underline decoration-dashed underline-offset-2">Cancel Session</button>
                                @endif
                            </div>
                        @elseif($lesson->status === 'completed')
                            @if($lesson->rating)
                                <div class="flex items-center gap-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="{{ $i <= $lesson->rating ? '#facc15' : 'none' }}" stroke="#facc15" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                    @endfor
                                </div>
                            @else
                                <button class="dash-btn-outline dash-btn-sm">Rate Session</button>
                            @endif
                        @elseif($lesson->status === 'cancelled')
                            <div class="flex flex-col items-end text-right">
                                <span class="text-xs font-bold text-red-600 bg-red-50 border border-red-100 px-2 py-1 rounded-md">Cancelled</span>
                                @if($lesson->cancellation_reason)
                                    <span class="text-[10px] text-gray-500 mt-1.5 max-w-[200px] truncate" title="{{ $lesson->cancellation_reason }}">
                                        Reason: {{ $lesson->cancellation_reason }}
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>

{{-- Report Issue Modal --}}
<div x-data="{
    isOpen: false,
    lessonId: null,
    issueType: 'link_not_working',
    notes: '',
    init() {
        window.addEventListener('open-report-modal', (e) => {
            this.lessonId = e.detail.id;
            this.isOpen = true;
        });
    }
}" x-show="isOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm p-4">
    <div @click.away="isOpen = false" class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h3 class="font-bold text-gray-900">Having trouble joining?</h3>
            <button @click="isOpen = false" class="text-gray-400 hover:text-gray-900">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form :action="`/student/lessons/${lessonId}/report`" method="POST" class="p-6">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">What is the issue?</label>
                <select name="issue_type" x-model="issueType" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-lime-500">
                    <option value="link_not_working">Meeting link is broken or not working</option>
                    <option value="tutor_absent">Tutor did not show up</option>
                    <option value="wrong_details">Wrong meeting details</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">Additional Notes (Optional)</label>
                <textarea name="notes" x-model="notes" rows="3" placeholder="Provide any extra details..."
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-lime-500"></textarea>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" @click="isOpen = false" class="px-5 py-2.5 rounded-xl font-bold text-gray-600 hover:bg-gray-100">Cancel</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl font-bold text-white bg-gray-900 hover:bg-black shadow-lg shadow-gray-900/20">Submit Report</button>
            </div>
        </form>
    </div>
</div>

{{-- Cancel Session Modal --}}
<div x-data="{
    isOpen: false,
    lessonId: null,
    reason: ''
}" @open-cancel-modal.window="
    isOpen = true;
    lessonId = $event.detail.id;
    reason = '';
" x-show="isOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm p-4">
    <div @click.away="isOpen = false" class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-red-50">
            <h3 class="font-bold text-red-700">Cancel Session</h3>
            <button @click="isOpen = false" class="text-red-400 hover:text-red-900">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form :action="`/student/lessons/${lessonId}/cancel`" method="POST" class="p-6">
            @csrf
            
            <div class="bg-amber-50 text-amber-800 p-4 rounded-xl text-sm mb-5 border border-amber-100 flex gap-3 items-start">
                <svg class="w-5 h-5 shrink-0 mt-0.5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p><strong>Note:</strong> Your session will be cancelled and a full refund will be provided to your original payment method.</p>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">Reason for cancellation</label>
                <textarea name="cancellation_reason" x-model="reason" rows="3" placeholder="Please let the tutor know why you are cancelling..." required
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>
            </div>
            
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" @click="isOpen = false" class="px-5 py-2.5 rounded-xl font-bold text-gray-600 hover:bg-gray-100">Keep Session</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl font-bold text-white bg-red-600 hover:bg-red-700 shadow-lg shadow-red-600/20">Confirm Cancellation</button>
            </div>
        </form>
    </div>
</div>

@endsection
