@extends('layouts.dashboard')

@section('title', 'Saved Tutors')
@php $pageTitle = 'Saved Tutors'; @endphp

@section('content')
<div class="dash-page">

    {{-- ══ PAGE HEADER ══════════════════════════════════════════════ --}}
    <div class="dash-welcome">
        <div class="dash-welcome__text">
            <h2 class="dash-welcome__heading">Saved Tutors</h2>
            <p class="dash-welcome__sub">Your wishlist of tutors — ready to book whenever you are.</p>
        </div>
        <a href="{{ route('find-tutors') }}" class="dash-welcome__cta">
            @include('components.dashboard.icon', ['name' => 'search', 'size' => 16])
            Explore Tutors
        </a>
    </div>

    {{-- ══ SAVED TUTORS GRID / EMPTY STATE ═════════════════════════ --}}
    @if($savedTutors->isEmpty())
        {{-- ── Empty State ──────────────────────────────────────────── --}}
        <div class="dash-card">
            <div class="dash-empty-state py-20">
                <div class="text-7xl mb-6">🔖</div>
                <p class="dash-empty-state__heading">Your wishlist is empty</p>
                <p class="dash-empty-state__text mt-2 max-w-sm">
                    Browse tutors and tap the heart icon to save your favourites here for quick booking.
                </p>
                <a href="{{ route('find-tutors') }}" class="dash-btn-lime mt-6">
                    @include('components.dashboard.icon', ['name' => 'search', 'size' => 16])
                    Find Tutors
                </a>
            </div>
        </div>
    @else
        <p class="text-sm text-gray-500 mb-4 font-medium">{{ $savedTutors->count() }} saved tutor{{ $savedTutors->count() !== 1 ? 's' : '' }}</p>

        <div class="dash-saved-grid">
            @foreach($savedTutors as $tutor)
                <div class="dash-tutor-full-card" x-data="{ removing: false }">

                    {{-- Top: Avatar + Online Dot --}}
                    <div class="dash-tutor-full-card__top">
                        <div class="dash-tutor-full-card__avatar">
                            @if($tutor->image)
                                <img src="{{ str_starts_with($tutor->image, 'http') ? $tutor->image : '/storage/' . $tutor->image }}" alt="{{ $tutor->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-2xl font-bold text-lime-600">{{ strtoupper(substr($tutor->name, 0, 1)) }}</span>
                            @endif
                            @if($tutor->is_online)
                                <span class="dash-tutor-full-card__online"></span>
                            @endif
                        </div>

                        {{-- Remove saved --}}
                        <form method="POST"
                              action="{{ route('student.wishlist.remove', $tutor->id) }}"
                              x-ref="removeForm">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="dash-tutor-full-card__remove"
                                    title="Remove from saved"
                                    @click.prevent="removing = true; $nextTick(() => $refs.removeForm.submit())">
                                @include('components.dashboard.icon', ['name' => 'heart', 'size' => 18])
                            </button>
                        </form>
                    </div>

                    {{-- Info --}}
                    <div class="dash-tutor-full-card__info">
                        <h4 class="dash-tutor-full-card__name">{{ $tutor->name }}</h4>
                        <p class="dash-tutor-full-card__subject">{{ $tutor->speciality ?? ($tutor->subject->name ?? 'Tutor') }}</p>

                        {{-- Rating row --}}
                        <div class="flex items-center gap-2 mt-2">
                            <div class="flex items-center gap-0.5">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="{{ $i <= floor($tutor->rating) ? '#facc15' : 'none' }}" stroke="#facc15" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                                @endfor
                            </div>
                            <span class="text-xs font-semibold text-gray-700">{{ number_format($tutor->rating, 1) }}</span>
                            <span class="text-xs text-gray-400">({{ $tutor->reviews_count }})</span>
                        </div>

                        {{-- Meta pills --}}
                        <div class="flex flex-wrap gap-1.5 mt-3">
                            @if($tutor->country)
                                <span class="dash-pill">{{ $tutor->country_flag }} {{ $tutor->country }}</span>
                            @endif
                            @if($tutor->languages)
                                <span class="dash-pill">{{ Str::limit($tutor->languages, 20) }}</span>
                            @endif
                            <span class="dash-pill capitalize">{{ $tutor->availability }}</span>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="dash-tutor-full-card__footer">
                        <div>
                            <p class="text-xs text-gray-400">Starting from</p>
                            <p class="text-lg font-bold text-gray-900">Rs {{ number_format($tutor->hourly_rate, 0) }}<span class="text-xs font-normal text-gray-400">/hr</span></p>
                        </div>
                        <a href="{{ route('tutor.book', $tutor->id) }}" class="dash-btn-lime dash-btn-sm">
                            @include('components.dashboard.icon', ['name' => 'calendar', 'size' => 14])
                            Book Now
                        </a>
                    </div>

                    {{-- Removing overlay --}}
                    <div x-show="removing" x-cloak class="absolute inset-0 bg-white/80 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                        <div class="text-sm font-semibold text-gray-500">Removing...</div>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
