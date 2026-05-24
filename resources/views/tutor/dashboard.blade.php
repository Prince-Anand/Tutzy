@extends('layouts.dashboard', ['pageTitle' => 'Dashboard'])

@section('content')
<div class="flex flex-col gap-8 pb-8">

    {{-- Welcome Header --}}
    <div class="dash-welcome">
        <div>
            <h2 class="dash-welcome__title">Welcome back, {{ explode(' ', $tutor->name)[0] }} 👋</h2>
            <p class="dash-welcome__subtitle">You have {{ $upcomingCount }} upcoming lessons.</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right">
                <p class="text-sm text-gray-500 font-medium">Available for Payout</p>
                <p class="text-xl font-bold text-gray-900">Rs {{ number_format($earnings['pending_payout'], 2) }}</p>
            </div>
            <a href="{{ route('tutor.schedule') }}" class="dash-btn-lime">
                View Schedule
            </a>
        </div>
    </div>

    {{-- Quick Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="dash-stat-card">
            <div class="dash-stat-card__icon bg-blue-100 text-blue-600">
                @include('components.dashboard.icon', ['name' => 'calendar'])
            </div>
            <div class="dash-stat-card__info">
                <p class="dash-stat-card__label">Upcoming Lessons</p>
                <p class="dash-stat-card__value">{{ $upcomingCount }}</p>
            </div>
        </div>
        
        <div class="dash-stat-card">
            <div class="dash-stat-card__icon bg-purple-100 text-purple-600">
                @include('components.dashboard.icon', ['name' => 'user'])
            </div>
            <div class="dash-stat-card__info">
                <p class="dash-stat-card__label">Total Students</p>
                <p class="dash-stat-card__value">{{ $metrics['total_students'] }}</p>
            </div>
        </div>

        <div class="dash-stat-card">
            <div class="dash-stat-card__icon bg-lime-100 text-lime-600">
                @include('components.dashboard.icon', ['name' => 'trending-up'])
            </div>
            <div class="dash-stat-card__info">
                <p class="dash-stat-card__label">Earnings Last 7 Days</p>
                <p class="dash-stat-card__value">Rs {{ number_format(array_sum($earnings['chart_data']), 2) }}</p>
            </div>
        </div>

        <div class="dash-stat-card">
            <div class="dash-stat-card__icon bg-amber-100 text-amber-600">
                @include('components.dashboard.icon', ['name' => 'star'])
            </div>
            <div class="dash-stat-card__info">
                <p class="dash-stat-card__label">Rating Average</p>
                <p class="dash-stat-card__value">{{ $metrics['rating_average'] }} <span class="text-sm font-normal text-gray-500">/ 5.0</span></p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        
        {{-- Left Column: Today's Schedule & Reviews --}}
        <div class="xl:col-span-2 flex flex-col gap-8">
            
            {{-- Today's Schedule --}}
            <div class="dash-card">
                <div class="dash-card__header border-b border-gray-100 pb-4">
                    <h3 class="dash-card__title">Today's Schedule</h3>
                    <a href="{{ route('tutor.schedule') }}" class="dash-card__link">Full schedule</a>
                </div>
                
                <div class="p-6">
                    @if($todaysLessons->isEmpty())
                        <div class="text-center py-8">
                            <div class="w-16 h-16 rounded-full bg-gray-50 flex items-center justify-center mx-auto mb-3 text-gray-400">
                                @include('components.dashboard.icon', ['name' => 'calendar', 'size' => 24])
                            </div>
                            <h4 class="text-gray-900 font-bold mb-1">No lessons today</h4>
                            <p class="text-sm text-gray-500">Take a break or update your availability.</p>
                        </div>
                    @else
                        <div class="flex flex-col gap-4">
                            @foreach($todaysLessons as $lesson)
                                <div class="flex items-center gap-4 p-4 rounded-xl border border-gray-100 hover:border-lime-200 hover:shadow-sm transition-all bg-white">
                                    <div class="flex-shrink-0 w-16 text-center border-r border-gray-100 pr-4">
                                        <p class="text-lg font-bold text-gray-900">{{ $lesson->scheduled_at->format('H:i') }}</p>
                                        <p class="text-xs font-semibold text-gray-500 uppercase">{{ $lesson->duration_label }}</p>
                                    </div>
                                    
                                    <div class="flex-shrink-0">
                                        @if($lesson->user->avatar_url)
                                            <img src="{{ $lesson->user->avatar_url }}" alt="{{ $lesson->user->name }}" class="w-10 h-10 rounded-full object-cover">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-lime-100 text-lime-700 font-bold flex items-center justify-center text-sm">
                                                {{ $lesson->user->initials }}
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex-1 min-w-0">
                                        <h4 class="text-sm font-bold text-gray-900 truncate">{{ $lesson->title }}</h4>
                                        <p class="text-sm text-gray-500 truncate">with {{ $lesson->user->name }}</p>
                                    </div>
                                    
                                    <div class="flex-shrink-0 flex items-center gap-2">
                                        @if($lesson->meeting_link)
                                            <a href="{{ $lesson->meeting_link }}" target="_blank" class="dash-btn-lime dash-btn-sm">Join Session</a>
                                        @else
                                            <button disabled class="dash-btn-outline dash-btn-sm opacity-50 cursor-not-allowed">Add Link First</button>
                                        @endif
                                        
                                        @if($lesson->scheduled_at->isPast())
                                            <form action="{{ route('tutor.lessons.complete', $lesson) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dash-btn-outline dash-btn-sm border-blue-200 text-blue-700 hover:bg-blue-50">Complete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Recent Reviews --}}
            <div class="dash-card">
                <div class="dash-card__header border-b border-gray-100 pb-4">
                    <h3 class="dash-card__title">Recent Reviews</h3>
                    <a href="{{ route('tutor.reviews') }}" class="dash-card__link">View all</a>
                </div>
                
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($reviews as $review)
                        <div class="bg-gray-50 rounded-2xl p-5 border border-gray-100">
                            <div class="flex items-center gap-3 mb-3">
                                @if($review->user->avatar_url)
                                    <img src="{{ $review->user->avatar_url }}" alt="{{ $review->user->name }}" class="w-10 h-10 rounded-full shadow-sm object-cover">
                                @else
                                    <div class="w-10 h-10 rounded-full bg-lime-100 text-lime-700 font-bold flex items-center justify-center text-sm">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ $review->user->name }}</p>
                                    <div class="flex items-center text-amber-400 gap-0.5">
                                        @for($i = 0; $i < floor($review->rating); $i++)
                                            @include('components.dashboard.icon', ['name' => 'star', 'size' => 12])
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 line-clamp-3">"{{ $review->feedback }}"</p>
                            <p class="text-xs text-gray-400 mt-3 font-medium">{{ $review->scheduled_at->format('M j, Y') }} • {{ $review->subject }}</p>
                        </div>
                    @empty
                        <div class="col-span-2 text-center text-gray-500 py-4 text-sm">
                            No reviews yet.
                        </div>
                    @endforelse
                </div>
            </div>
            
        </div>

        {{-- Right Column: Earnings & Performance --}}
        <div class="flex flex-col gap-8">
            
            {{-- Performance Metrics --}}
            <div class="dash-card">
                <div class="dash-card__header border-b border-gray-100 pb-4">
                    <h3 class="dash-card__title">Tutor Performance</h3>
                </div>
                <div class="p-6 flex flex-col gap-5">
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3 text-gray-600">
                            @include('components.dashboard.icon', ['name' => 'message-square', 'size' => 18])
                            <span class="text-sm font-medium">Response Rate</span>
                        </div>
                        <span class="text-sm font-bold text-gray-900">{{ $metrics['response_rate'] }}</span>
                    </div>
                    
                    <div class="w-full bg-gray-100 rounded-full h-1.5 mb-1">
                        <div class="bg-lime-500 h-1.5 rounded-full" style="width: {{ $metrics['response_rate'] }}"></div>
                    </div>
                    
                    <div class="flex items-center justify-between mt-2">
                        <div class="flex items-center gap-3 text-gray-600">
                            @include('components.dashboard.icon', ['name' => 'check-circle', 'size' => 18])
                            <span class="text-sm font-medium">Lesson Completion</span>
                        </div>
                        <span class="text-sm font-bold text-gray-900">{{ $metrics['completion_rate'] }}</span>
                    </div>
                    
                    <div class="w-full bg-gray-100 rounded-full h-1.5 mb-1">
                        <div class="bg-lime-500 h-1.5 rounded-full" style="width: {{ $metrics['completion_rate'] }}"></div>
                    </div>

                    <div class="flex items-center justify-between mt-2">
                        <div class="flex items-center gap-3 text-gray-600">
                            @include('components.dashboard.icon', ['name' => 'user', 'size' => 18])
                            <span class="text-sm font-medium">Repeat Students</span>
                        </div>
                        <span class="text-sm font-bold text-gray-900">{{ $metrics['repeat_students'] }}</span>
                    </div>

                </div>
            </div>

            {{-- Pending Payout --}}
            <div class="dash-card bg-gradient-to-br from-gray-900 to-gray-800 text-white border-0 shadow-lg relative overflow-hidden">
                <div class="absolute top-0 right-0 p-6 opacity-10">
                    @include('components.dashboard.icon', ['name' => 'trending-up', 'size' => 120])
                </div>
                <div class="relative z-10 p-6">
                    <p class="text-gray-400 font-medium mb-1">Available for Payout</p>
                    <h3 class="text-3xl font-black mb-6">Rs {{ number_format($earnings['pending_payout'], 2) }}</h3>
                    <a href="{{ route('tutor.earnings') }}" class="inline-flex items-center justify-center bg-lime-500 text-white rounded-xl px-4 py-2 text-sm font-bold hover:bg-lime-400 transition-colors shadow-sm w-full">
                        Withdraw Funds
                    </a>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
