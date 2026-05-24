@extends('layouts.dashboard', ['pageTitle' => 'Schedule'])

@section('content')
<div class="flex flex-col gap-6 max-w-4xl mx-auto pb-8" x-data>

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Your Schedule</h2>
            <p class="text-gray-500 text-sm mt-1">Manage your availability and upcoming sessions.</p>
        </div>
        <div class="flex items-center gap-3">
            <button class="dash-btn-outline">
                @include('components.dashboard.icon', ['name' => 'settings', 'size' => 16])
                Availability Settings
            </button>
        </div>
    </div>

    {{-- Minimal Calendar/Date Picker placeholder --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-4 shadow-sm flex items-center justify-between gap-4">
        @php
            $selectedDate = request('date', now()->format('Y-m-d'));
            $startOfWeek = \Carbon\Carbon::parse($selectedDate)->startOfWeek();
            
            $prevWeekDate = $startOfWeek->copy()->subWeek()->format('Y-m-d');
            $nextWeekDate = $startOfWeek->copy()->addWeek()->format('Y-m-d');
            
            $days = [];
            for ($i = 0; $i < 7; $i++) {
                $date = $startOfWeek->copy()->addDays($i);
                $days[] = [
                    'day' => $date->format('D'),
                    'date' => $date->format('d'),
                    'full_date' => $date->format('l, F j'),
                    'query_date' => $date->format('Y-m-d'),
                    'active' => $date->format('Y-m-d') === $selectedDate,
                ];
            }
            $activeDateStr = collect($days)->firstWhere('active', true)['full_date'] ?? $days[0]['full_date'];
        @endphp
        
        <a href="?date={{ $prevWeekDate }}" class="p-2 text-gray-400 hover:text-gray-900 shrink-0">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
        </a>
        
        <div class="flex items-center gap-2 max-w-full mx-auto">
            @foreach($days as $d)
                <a href="?date={{ $d['query_date'] }}" class="flex flex-col items-center justify-center min-w-[3.5rem] w-14 h-16 rounded-xl transition-all {{ $d['active'] ? 'bg-lime-500 text-white shadow-md' : 'hover:bg-gray-50 text-gray-600' }}">
                    <span class="text-xs font-semibold uppercase {{ $d['active'] ? 'text-lime-100' : 'text-gray-400' }}">{{ $d['day'] }}</span>
                    <span class="text-lg font-bold">{{ $d['date'] }}</span>
                </a>
            @endforeach
        </div>

        <a href="?date={{ $nextWeekDate }}" class="p-2 text-gray-400 hover:text-gray-900 shrink-0">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </a>
    </div>

    {{-- Timeline --}}
    <div class="dash-card mt-2">
        <div class="p-6 sm:p-8">
            <h3 class="text-lg font-bold text-gray-900 mb-8 border-b border-gray-100 pb-4">{{ $activeDateStr }}</h3>
            
            @if($upcomingLessons->isEmpty())
                <div class="text-center py-12">
                    <div class="w-16 h-16 rounded-full bg-gray-50 flex items-center justify-center mx-auto mb-4 text-gray-400">
                        @include('components.dashboard.icon', ['name' => 'clock', 'size' => 24])
                    </div>
                    <h4 class="text-gray-900 font-bold mb-2">No sessions scheduled</h4>
                    <p class="text-sm text-gray-500">Your calendar is clear for this day.</p>
                </div>
            @else
                <div class="relative border-l-2 border-gray-100 ml-4 sm:ml-6 flex flex-col gap-10">
                    @foreach($upcomingLessons as $lesson)
                        <div class="relative pl-8 sm:pl-10">
                            {{-- Timeline dot --}}
                            <div class="absolute left-0 top-1.5 w-3 h-3 rounded-full bg-lime-500 border-4 border-white shadow-sm" style="transform: translateX(-calc(50% + 1px));"></div>
                            
                            {{-- Time --}}
                            <div class="text-sm font-bold text-lime-600 mb-2">
                                {{ $lesson->scheduled_at->format('H:i') }} — {{ $lesson->scheduled_at->copy()->addMinutes($lesson->duration_minutes)->format('H:i') }}
                            </div>
                            
                            {{-- Session Card --}}
                            <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition-shadow">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    
                                    <div class="flex items-center gap-4">
                                        @if($lesson->user->avatar_url)
                                            <img src="{{ $lesson->user->avatar_url }}" alt="{{ $lesson->user->name }}" class="w-12 h-12 rounded-full object-cover shadow-sm">
                                        @else
                                            <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-lg shadow-sm">
                                                {{ $lesson->user->initials }}
                                            </div>
                                        @endif
                                        
                                        <div>
                                            <h4 class="text-base font-bold text-gray-900">{{ $lesson->title }}</h4>
                                            <p class="text-sm text-gray-500 font-medium">with {{ $lesson->user->name }} • {{ $lesson->duration_label }}</p>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center gap-3">
                                        <div class="flex flex-col items-end mr-2">
                                            @if($lesson->meeting_link)
                                                <span class="text-xs font-bold text-lime-600 mb-1 flex items-center gap-1">
                                                    @include('components.dashboard.icon', ['name' => 'check-circle', 'size' => 12])
                                                    Lesson ready
                                                </span>
                                                <button type="button" @click.stop="$dispatch('open-link-modal', { id: {{ $lesson->id }}, link: '{{ addslashes($lesson->meeting_link) }}' })" class="dash-btn-outline text-xs py-1.5 px-3 cursor-pointer">
                                                    Update Meeting Link
                                                </button>
                                            @else
                                                <span class="text-xs font-medium text-gray-400 mb-1">
                                                    Meeting link not added yet
                                                </span>
                                                <button type="button" @click.stop="$dispatch('open-link-modal', { id: {{ $lesson->id }}, link: '' })" class="dash-btn-lime text-xs py-1.5 px-3 cursor-pointer">
                                                    Add Meeting Link
                                                </button>
                                            @endif
                                        </div>
                                        <button type="button" class="p-2.5 text-gray-400 hover:text-gray-900 hover:bg-gray-50 rounded-xl transition-colors tooltip-trigger" title="Message Student">
                                            @include('components.dashboard.icon', ['name' => 'message-square', 'size' => 20])
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>

</div>

{{-- Meeting Link Modal --}}
<div x-data="{
    isOpen: false,
    lessonId: null,
    meetingLink: ''
}" @open-link-modal.window="
    isOpen = true;
    lessonId = $event.detail.id;
    meetingLink = $event.detail.link || '';
" x-show="isOpen" style="display: none;" class="fixed inset-0 z-[100] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm p-4">
    <div @click.away="isOpen = false" class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden relative z-10">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <h3 class="font-bold text-gray-900">Set Meeting Link</h3>
            <button type="button" @click="isOpen = false" class="text-gray-400 hover:text-gray-900">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form :action="`/tutor/lessons/${lessonId}/meeting-link`" method="POST" class="p-6">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-2">Meeting Link</label>
                <input type="url" name="meeting_link" x-model="meetingLink" placeholder="Paste Zoom / Google Meet / Teams link" required
                    class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-lime-500">
                <p class="text-xs text-gray-500 mt-2">Students will use this link to join the lesson. Supported platforms: Zoom, Google Meet, Microsoft Teams.</p>
            </div>
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" @click="isOpen = false" class="px-5 py-2.5 rounded-xl font-bold text-gray-600 hover:bg-gray-100">Cancel</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl font-bold text-white bg-gray-900 hover:bg-black shadow-lg shadow-gray-900/20">Save Link</button>
            </div>
        </form>
    </div>
</div>
@endsection
