@extends('layouts.dashboard', ['pageTitle' => 'Lessons'])

@section('content')
<div class="flex flex-col gap-6 pb-8">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="dash-welcome__title text-2xl font-black">All Lessons</h2>
            <p class="dash-welcome__subtitle text-sm mt-1">View and manage your tutoring sessions.</p>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="border-b border-gray-200">
        <nav class="flex gap-6 -mb-px" aria-label="Tabs">
            <a href="{{ route('tutor.lessons', ['status' => 'upcoming']) }}" class="dash-tab {{ $status === 'upcoming' ? 'dash-tab--active' : '' }}">
                Upcoming
            </a>
            <a href="{{ route('tutor.lessons', ['status' => 'completed']) }}" class="dash-tab {{ $status === 'completed' ? 'dash-tab--active' : '' }}">
                Completed
            </a>
            <a href="{{ route('tutor.lessons', ['status' => 'cancelled']) }}" class="dash-tab {{ $status === 'cancelled' ? 'dash-tab--active' : '' }}">
                Cancelled
            </a>
        </nav>
    </div>

    {{-- Lesson List --}}
    <div class="flex flex-col gap-4 mt-2">
        @if($lessons->isEmpty())
            <div class="dash-card p-12 text-center">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                    @include('components.dashboard.icon', ['name' => 'video', 'size' => 24])
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">No {{ $status }} lessons</h3>
                <p class="text-gray-500">You don't have any {{ $status }} lessons at the moment.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($lessons as $lesson)
                    <div class="dash-card flex flex-col h-full hover:border-lime-200 hover:shadow-md transition-all group">
                        
                        {{-- Header / Status --}}
                        <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold 
                                {{ $lesson->status === 'upcoming' ? 'bg-lime-100 text-lime-800' : '' }}
                                {{ $lesson->status === 'completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $lesson->status === 'cancelled' ? 'bg-gray-100 text-gray-800' : '' }}">
                                {{ ucfirst($lesson->status) }}
                            </span>
                            <span class="text-sm font-semibold text-gray-900">
                                {{ $lesson->duration_label }}
                            </span>
                        </div>

                        {{-- Body --}}
                        <div class="p-5 flex-1 flex flex-col">
                            <div class="flex items-center gap-3 mb-4">
                                @if($lesson->user->avatar_url)
                                    <img src="{{ $lesson->user->avatar_url }}" alt="{{ $lesson->user->name }}" class="w-12 h-12 rounded-full object-cover shadow-sm">
                                @else
                                    <div class="w-12 h-12 rounded-full bg-lime-100 text-lime-700 font-bold flex items-center justify-center text-lg">
                                        {{ $lesson->user->initials }}
                                    </div>
                                @endif
                                <div>
                                    <h4 class="text-base font-bold text-gray-900">{{ $lesson->user->name }}</h4>
                                    <p class="text-sm text-gray-500">Student</p>
                                </div>
                            </div>
                            
                            <h3 class="font-bold text-gray-900 mb-2 text-lg leading-tight">{{ $lesson->title }}</h3>
                            
                            <div class="mt-auto pt-4 flex flex-col gap-2">
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    @include('components.dashboard.icon', ['name' => 'calendar', 'size' => 16])
                                    <span class="font-medium">{{ $lesson->scheduled_at->format('M j, Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600">
                                    @include('components.dashboard.icon', ['name' => 'clock', 'size' => 16])
                                    <span class="font-medium">{{ $lesson->scheduled_at->format('g:i A') }}</span>
                                </div>
                            </div>
                        </div>

                        {{-- Footer Action --}}
                        <div class="p-5 border-t border-gray-100 bg-gray-50/50 rounded-b-2xl">
                            @if($lesson->status === 'upcoming')
                                <div class="flex gap-2">
                                    @if($lesson->meeting_link)
                                        <a href="{{ $lesson->meeting_link }}" target="_blank" class="w-full text-center dash-btn-lime">Join Session</a>
                                    @else
                                        <button disabled class="w-full dash-btn-outline opacity-50 cursor-not-allowed">Add link to join</button>
                                    @endif
                                    
                                    @if($lesson->scheduled_at->isPast())
                                        <form action="{{ route('tutor.lessons.complete', $lesson) }}" method="POST" class="w-full">
                                            @csrf
                                            <button type="submit" class="w-full dash-btn-outline border-blue-200 text-blue-700 hover:bg-blue-50">Mark Complete</button>
                                        </form>
                                    @endif
                                </div>
                            @elseif($lesson->status === 'completed')
                                <button class="w-full dash-btn-outline">View Notes</button>
                            @else
                                <button class="w-full dash-btn-outline opacity-50 cursor-not-allowed">Cancelled</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection
