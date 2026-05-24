@extends('layouts.dashboard')

@section('title', 'Dashboard')
@php $pageTitle = 'Dashboard'; @endphp

@section('content')
<div class="dash-page">

    {{-- ╔══════════════════════════════════════════════════════════╗ --}}
    {{-- ║  WELCOME HEADER                                          ║ --}}
    {{-- ╚══════════════════════════════════════════════════════════╝ --}}
    <div class="dash-welcome">
        <div class="dash-welcome__text">
            <h2 class="dash-welcome__heading">Welcome back, {{ Str::before($user->name, ' ') }} 👋</h2>
            <p class="dash-welcome__sub">{{ now()->format('l, F j') }} · Here's your learning overview</p>
        </div>
        <a href="{{ route('find-tutors') }}" class="dash-welcome__cta">
            @include('components.dashboard.icon', ['name' => 'search', 'size' => 16])
            Find a Tutor
        </a>
    </div>

    {{-- ╔══════════════════════════════════════════════════════════╗ --}}
    {{-- ║  QUICK STATS ROW                                         ║ --}}
    {{-- ╚══════════════════════════════════════════════════════════╝ --}}
    <div class="dash-stats-grid">

        <div class="dash-stat-card dash-stat-card--lime">
            <div class="dash-stat-card__icon-wrap dash-stat-card__icon-wrap--lime">
                @include('components.dashboard.icon', ['name' => 'check-circle', 'size' => 22])
            </div>
            <div>
                <p class="dash-stat-card__value">{{ $stats['lessons_completed'] }}</p>
                <p class="dash-stat-card__label">Lessons Completed</p>
            </div>
        </div>

        <div class="dash-stat-card dash-stat-card--blue">
            <div class="dash-stat-card__icon-wrap dash-stat-card__icon-wrap--blue">
                @include('components.dashboard.icon', ['name' => 'clock', 'size' => 22])
            </div>
            <div>
                <p class="dash-stat-card__value">{{ number_format($stats['hours_learned'], 1) }}h</p>
                <p class="dash-stat-card__label">Hours Learned</p>
            </div>
        </div>

        <div class="dash-stat-card dash-stat-card--purple">
            <div class="dash-stat-card__icon-wrap dash-stat-card__icon-wrap--purple">
                @include('components.dashboard.icon', ['name' => 'heart', 'size' => 22])
            </div>
            <div>
                <p class="dash-stat-card__value">{{ $stats['tutors_saved'] }}</p>
                <p class="dash-stat-card__label">Tutors Saved</p>
            </div>
        </div>

        <div class="dash-stat-card dash-stat-card--amber">
            <div class="dash-stat-card__icon-wrap dash-stat-card__icon-wrap--amber">
                @include('components.dashboard.icon', ['name' => 'trending-up', 'size' => 22])
            </div>
            <div>
                <p class="dash-stat-card__value">{{ $stats['weekly_progress'] }}%</p>
                <p class="dash-stat-card__label">Weekly Goal</p>
                <div class="dash-stat-card__bar-bg mt-2">
                    <div class="dash-stat-card__bar-fill" style="width: {{ $stats['weekly_progress'] }}%"></div>
                </div>
            </div>
        </div>

    </div>

    {{-- ╔══════════════════════════════════════════════════════════╗ --}}
    {{-- ║  TWO-COLUMN CONTENT ROW                                  ║ --}}
    {{-- ╚══════════════════════════════════════════════════════════╝ --}}
    <div class="dash-two-col">

        {{-- ── LEFT: Upcoming Lessons ─────────────────────────────── --}}
        <div class="dash-card">
            <div class="dash-card__header">
                <h3 class="dash-card__title">
                    @include('components.dashboard.icon', ['name' => 'calendar', 'size' => 18, 'class' => 'text-lime-600'])
                    Upcoming Lessons
                </h3>
                <a href="{{ route('student.lessons') }}" class="dash-card__link">View all →</a>
            </div>

            @if($upcomingLessons->isEmpty())
                <div class="dash-empty-state">
                    <div class="dash-empty-state__icon">📅</div>
                    <p class="dash-empty-state__text">No upcoming lessons yet.</p>
                    <a href="{{ route('find-tutors') }}" class="dash-btn-lime dash-btn-sm mt-3">Book your first lesson</a>
                </div>
            @else
                <div class="flex flex-col gap-3">
                    @foreach($upcomingLessons as $lesson)
                        <div class="dash-lesson-mini">
                            <div class="dash-lesson-mini__avatar">
                                @if($lesson->tutor && $lesson->tutor->image)
                                    <img src="{{ str_starts_with($lesson->tutor->image, 'http') ? $lesson->tutor->image : '/storage/' . $lesson->tutor->image }}" alt="{{ $lesson->tutor->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-sm font-bold text-lime-700">{{ strtoupper(substr($lesson->tutor->name ?? 'T', 0, 1)) }}</span>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $lesson->title }}</p>
                                <p class="text-xs text-gray-500 mt-0.5 flex items-center gap-1">
                                    @include('components.dashboard.icon', ['name' => 'clock', 'size' => 12])
                                    {{ $lesson->scheduled_at->format('D, M j · g:i A') }}
                                    · {{ $lesson->duration_label }}
                                </p>
                            </div>
                            <div class="flex flex-col gap-1 items-end shrink-0">
                                @if($lesson->meeting_link)
                                    <a href="{{ $lesson->meeting_link }}" target="_blank" rel="noopener noreferrer" class="dash-btn-lime dash-btn-xs flex items-center gap-1">
                                        @include('components.dashboard.icon', ['name' => 'external-link', 'size' => 12])
                                        Join Meeting
                                    </a>
                                    <button @click="$dispatch('open-report-modal', { id: {{ $lesson->id }} })" class="text-[10px] text-gray-400 hover:text-gray-600 underline decoration-dashed underline-offset-2">Having trouble?</button>
                                @else
                                    <span class="inline-flex items-center gap-1 text-[11px] font-medium text-gray-400 bg-gray-50 border border-gray-100 px-2 py-1 rounded-md" title="Waiting for tutor to add meeting link">
                                        @include('components.dashboard.icon', ['name' => 'clock', 'size' => 10])
                                        Waiting for link
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- ── RIGHT: Learning Streak + Progress ─────────────────── --}}
        <div class="flex flex-col gap-5">

            {{-- Streak card --}}
            <div class="dash-card">
                <div class="dash-streak">
                    <div class="dash-streak__flame">🔥</div>
                    <div>
                        <p class="dash-streak__count">{{ $streak }} day{{ $streak !== 1 ? 's' : '' }}</p>
                        <p class="dash-streak__label">Learning streak this month</p>
                    </div>
                </div>
            </div>

            {{-- Subject progress --}}
            <div class="dash-card flex-1">
                <div class="dash-card__header">
                    <h3 class="dash-card__title">
                        @include('components.dashboard.icon', ['name' => 'book-open', 'size' => 18, 'class' => 'text-lime-600'])
                        Progress by Subject
                    </h3>
                </div>

                @if($subjectProgress->isEmpty())
                    <p class="text-sm text-gray-400 text-center py-4">Complete lessons to see subject progress.</p>
                @else
                    <div class="flex flex-col gap-4">
                        @php
                            $maxCount = $subjectProgress->max('count') ?: 1;
                            $progressColors = ['bg-lime-400', 'bg-blue-400', 'bg-purple-400', 'bg-amber-400'];
                        @endphp
                        @foreach($subjectProgress as $i => $sp)
                            <div>
                                <div class="flex justify-between text-xs font-medium text-gray-600 mb-1.5">
                                    <span>{{ $sp['subject'] }}</span>
                                    <span class="text-gray-400">{{ $sp['count'] }} lesson{{ $sp['count'] !== 1 ? 's' : '' }}</span>
                                </div>
                                <div class="h-2 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-700 {{ $progressColors[$i % count($progressColors)] }}"
                                         style="width: {{ round(($sp['count'] / $maxCount) * 100) }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{-- ╔══════════════════════════════════════════════════════════╗ --}}
    {{-- ║  RECOMMENDED TUTORS                                       ║ --}}
    {{-- ╚══════════════════════════════════════════════════════════╝ --}}
    @if($recommended->isNotEmpty())
        <div class="dash-card">
            <div class="dash-card__header">
                <h3 class="dash-card__title">
                    @include('components.dashboard.icon', ['name' => 'star', 'size' => 18, 'class' => 'text-amber-500'])
                    Recommended Tutors
                </h3>
                <a href="{{ route('find-tutors') }}" class="dash-card__link">See all →</a>
            </div>

            <div class="dash-tutor-grid">
                @foreach($recommended as $tutor)
                    <div class="dash-tutor-card">
                        <div class="dash-tutor-card__avatar">
                            @if($tutor->image)
                                <img src="{{ str_starts_with($tutor->image, 'http') ? $tutor->image : '/storage/' . $tutor->image }}" alt="{{ $tutor->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xl font-bold text-lime-600">{{ strtoupper(substr($tutor->name, 0, 1)) }}</span>
                            @endif
                            @if($tutor->is_online)
                                <span class="dash-tutor-card__online-dot"></span>
                            @endif
                        </div>
                        <h4 class="dash-tutor-card__name">{{ Str::limit($tutor->name, 16) }}</h4>
                        <p class="dash-tutor-card__subject">{{ $tutor->speciality ?? $tutor->subject->name ?? 'Tutor' }}</p>
                        <div class="dash-tutor-card__rating">
                            <span class="text-amber-400 text-sm">★</span>
                            <span class="text-xs font-semibold text-gray-700">{{ number_format($tutor->rating, 1) }}</span>
                        </div>
                        <p class="dash-tutor-card__price">from Rs {{ number_format($tutor->hourly_rate, 0) }}/hr</p>
                        <a href="{{ route('tutor.book', $tutor->id) }}" class="dash-btn-lime dash-btn-sm w-full mt-3 text-center">Book</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- ╔══════════════════════════════════════════════════════════╗ --}}
    {{-- ║  RECENT ACTIVITY TIMELINE                                 ║ --}}
    {{-- ╚══════════════════════════════════════════════════════════╝ --}}
    @if($recentActivity->isNotEmpty())
        <div class="dash-card">
            <div class="dash-card__header">
                <h3 class="dash-card__title">
                    @include('components.dashboard.icon', ['name' => 'zap', 'size' => 18, 'class' => 'text-lime-600'])
                    Recent Activity
                </h3>
            </div>
            <ol class="dash-timeline">
                @foreach($recentActivity as $lesson)
                    @php
                        $icons = [
                            'upcoming'  => ['icon' => 'calendar', 'color' => 'dash-timeline__dot--blue',   'label' => 'Lesson booked'],
                            'completed' => ['icon' => 'check-circle', 'color' => 'dash-timeline__dot--lime', 'label' => 'Lesson completed'],
                            'cancelled' => ['icon' => 'x',          'color' => 'dash-timeline__dot--red',  'label' => 'Lesson cancelled'],
                        ];
                        $meta = $icons[$lesson->status] ?? $icons['upcoming'];
                    @endphp
                    <li class="dash-timeline__item">
                        <div class="dash-timeline__dot {{ $meta['color'] }}">
                            @include('components.dashboard.icon', ['name' => $meta['icon'], 'size' => 12])
                        </div>
                        <div class="dash-timeline__body">
                            <p class="dash-timeline__event">
                                <span class="font-semibold text-gray-900">{{ $meta['label'] }}</span>
                                — {{ $lesson->title }}
                            </p>
                            <p class="dash-timeline__meta">
                                with {{ $lesson->tutor->name ?? 'Unknown Tutor' }}
                                · {{ $lesson->scheduled_at->diffForHumans() }}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ol>
        </div>
    @endif
    </div>
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

@endsection
