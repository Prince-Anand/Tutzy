@extends('layouts.dashboard', ['pageTitle' => 'Reviews'])

@section('content')
<div class="flex flex-col gap-6 pb-8 max-w-5xl mx-auto">

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Student Reviews</h2>
            <p class="text-gray-500 text-sm mt-1">Read what your students are saying about your lessons.</p>
        </div>
        
        <div class="bg-white px-4 py-2 rounded-xl border border-gray-200 shadow-sm flex items-center gap-4">
            <div class="text-right">
                <p class="text-xs font-bold text-gray-500 uppercase tracking-wide">Average</p>
                <p class="text-lg font-black text-gray-900">{{ $metrics['rating_average'] }}</p>
            </div>
            <div class="flex items-center text-amber-400 gap-0.5">
                @for($i = 0; $i < 5; $i++)
                    @include('components.dashboard.icon', ['name' => 'star', 'size' => 20])
                @endfor
            </div>
        </div>
    </div>

    {{-- Review Cards Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
        @forelse($reviews as $review)
            <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-100 shadow-sm flex flex-col h-full hover:shadow-md transition-shadow relative overflow-hidden group">
                
                {{-- Decorative Quote Icon --}}
                <div class="absolute top-4 right-4 opacity-5 text-lime-500 group-hover:opacity-10 transition-opacity pointer-events-none">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="currentColor"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h4v10h-10z"/></svg>
                </div>

                {{-- Header --}}
                <div class="flex items-start gap-4 mb-6 relative z-10">
                    @if($review->user->avatar_url)
                        <img src="{{ $review->user->avatar_url }}" alt="{{ $review->user->name }}" class="w-14 h-14 rounded-full object-cover shadow-sm ring-2 ring-white">
                    @else
                        <div class="w-14 h-14 rounded-full bg-lime-100 text-lime-700 font-bold flex items-center justify-center text-xl shadow-sm ring-2 ring-white">
                            {{ substr($review->user->name, 0, 1) }}
                        </div>
                    @endif
                    <div class="flex-1">
                        <h3 class="text-base font-bold text-gray-900">{{ $review->user->name }}</h3>
                        <p class="text-sm font-medium text-lime-600">{{ $review->subject }}</p>
                        <p class="text-xs text-gray-400 mt-1">{{ $review->scheduled_at->format('M j, Y') }}</p>
                    </div>
                    <div class="flex flex-col items-end gap-1">
                        <div class="flex items-center text-amber-400 gap-0.5">
                            @for($i = 0; $i < floor($review->rating); $i++)
                                @include('components.dashboard.icon', ['name' => 'star', 'size' => 14])
                            @endfor
                            @if($review->rating - floor($review->rating) >= 0.5)
                                <div class="w-[14px] h-[14px] overflow-hidden relative">
                                    <div class="absolute inset-0 w-1/2 overflow-hidden text-amber-400">@include('components.dashboard.icon', ['name' => 'star', 'size' => 14])</div>
                                    <div class="absolute inset-0 text-gray-200">@include('components.dashboard.icon', ['name' => 'star', 'size' => 14])</div>
                                </div>
                            @endif
                        </div>
                        <span class="text-xs font-bold text-gray-500 bg-gray-100 px-2 rounded-full">{{ number_format($review->rating, 1) }}</span>
                    </div>
                </div>

                {{-- Body --}}
                <div class="flex-1 relative z-10">
                    <p class="text-gray-700 leading-relaxed text-sm md:text-base italic">"{{ $review->feedback }}"</p>
                </div>

            </div>
        @empty
            <div class="col-span-1 md:col-span-2 dash-card p-12 text-center">
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 text-gray-400">
                    @include('components.dashboard.icon', ['name' => 'star', 'size' => 24])
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">No reviews yet</h3>
                <p class="text-gray-500">Reviews from your students will appear here after they complete a session with you.</p>
            </div>
        @endforelse
    </div>

</div>
@endsection
