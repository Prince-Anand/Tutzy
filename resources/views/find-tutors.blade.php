@extends('layout')

@section('title', ($subject?->name ?? 'Find Tutors') . ' Tutors — Tutzy')

@push('styles')
<style>
/* ── Find Tutors: premium price card layout fix (INR horizontal alignment) ── */
.ftc {
    container-type: inline-size;
}

.ftc__cta {
    padding: 12px 12px 14px !important;
    gap: 6px !important;
    flex-wrap: nowrap !important;
    align-items: center !important;
    justify-content: space-between !important;
}

.ftc__price {
    display: flex !important;
    flex-direction: row !important;
    align-items: baseline !important;
    gap: 3px !important;
    flex-shrink: 0 !important;
    white-space: nowrap !important;
}

.ftc__price-val {
    font-size: 15.5px !important;
    font-weight: 900 !important;
    color: #1a1a1a !important;
    white-space: nowrap !important;
    line-height: 1 !important;
}

.ftc__price-unit {
    font-size: 10px !important;
    color: #6b7280 !important;
    white-space: nowrap !important;
    line-height: 1 !important;
    margin-top: 0 !important;
}

.ftc__cta-buttons {
    display: flex !important;
    gap: 6px !important;
    align-items: center !important;
    flex-shrink: 0 !important;
}

.ftc__btn-book {
    padding: 8px 10px !important;
    font-size: 11px !important;
    white-space: nowrap !important;
    border-radius: 10px !important;
}

.ftc__btn-msg {
    width: 32px !important;
    height: 32px !important;
    border-radius: 10px !important;
    flex-shrink: 0 !important;
}

/* Container query for extremely tight cards (e.g. multi-column layouts on medium tablets) */
@container (max-width: 310px) {
    .ftc__cta {
        padding: 10px 8px 12px !important;
        gap: 4px !important;
    }
    .ftc__price {
        gap: 2px !important;
    }
    .ftc__price-val {
        font-size: 14px !important;
    }
    .ftc__price-unit {
        font-size: 9px !important;
    }
    .ftc__cta-buttons {
        gap: 4px !important;
    }
    .ftc__btn-book {
        padding: 8px 7px !important;
        font-size: 10px !important;
    }
    .ftc__btn-msg {
        width: 30px !important;
        height: 30px !important;
    }
}
</style>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@endpush

@section('content')


{{-- ════════════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════════ --}}
<section class="fth">
    <div class="fth__inner">

        {{-- Left: text + search --}}
        <div class="fth__text">

            <h1 class="fth__heading">
                @if($subject)
                    @php
                        $title     = $subject->hero_title;
                        $highlight = $subject->hero_highlight;
                        $parts     = explode($highlight, $title, 2);
                    @endphp
                    @if(count($parts) === 2)
                        {!! $parts[0] !!}<span class="fth__accent">{{ $highlight }}</span>{!! $parts[1] !!}
                    @else
                        {{ $title }}
                    @endif
                @else
                    Find the perfect <span class="fth__accent">tutor</span> for you
                @endif
            </h1>

            <p class="fth__desc">
                {{ $subject?->hero_description ?? 'Browse thousands of verified tutors across every subject and skill level.' }}
            </p>

            {{-- Inline filter bar (reference-style) --}}
            <form method="GET" action="{{ route('find-tutors') }}" class="fth__filterbar" id="ft-search-form">
                <input type="hidden" name="subject" value="{{ $slug }}">

                {{-- Subject dropdown --}}
                <div class="fth__fb-item">
                    <span class="fth__fb-label">I want to learn</span>
                    <select name="subject" class="fth__fb-select" onchange="this.form.submit()">
                        @foreach($allSubjects as $s)
                            <option value="{{ $s->slug }}" {{ $s->slug === $slug ? 'selected' : '' }}>{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="fth__fb-divider"></div>

                {{-- Price range --}}
                <div class="fth__fb-item">
                    <span class="fth__fb-label">Price per hour</span>
                    <div class="fth__fb-price-row">
                        <span class="fth__fb-price-val">
                            ₹{{ number_format(request('min_price', 400)) }} — ₹{{ number_format(request('max_price', 16600)) }}+
                        </span>
                    </div>
                </div>

                <div class="fth__fb-divider"></div>

                {{-- Availability --}}
                <div class="fth__fb-item">
                    <span class="fth__fb-label">I'm available</span>
                    <select name="availability" class="fth__fb-select" onchange="this.form.submit()">
                        <option value="any"      {{ request('availability','any')==='any'      ? 'selected':'' }}>Any time</option>
                        <option value="flexible" {{ request('availability','any')==='flexible' ? 'selected':'' }}>Flexible</option>
                        <option value="weekdays" {{ request('availability','any')==='weekdays' ? 'selected':'' }}>Weekdays</option>
                        <option value="weekends" {{ request('availability','any')==='weekends' ? 'selected':'' }}>Weekends</option>
                    </select>
                </div>

                <button type="submit" class="fth__fb-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                    Search
                </button>
            </form>

            {{-- Second filter row: chips --}}
            <form method="GET" action="{{ route('find-tutors') }}" id="chip-filter-form" class="fth__chip-row">
                <input type="hidden" name="subject" value="{{ $slug }}">
                @foreach(request()->except(['tutor_type','sort']) as $k => $v)
                    @if($k !== 'tutor_type') <input type="hidden" name="{{ $k }}" value="{{ $v }}"> @endif
                @endforeach

                @foreach(['any'=>'All','professional'=>'Professional','native'=>'Native Speaker','student'=>'Student'] as $val => $label)
                    <button type="submit" name="tutor_type" value="{{ $val }}"
                        class="fth__chip {{ request('tutor_type','any')===$val ? 'fth__chip--on' : '' }}">
                        {{ $label }}
                    </button>
                @endforeach

                <div class="fth__chip-sep"></div>

                {{-- Rating chip --}}
                <select name="min_rating" class="fth__chip-select" onchange="document.getElementById('chip-filter-form').submit()">
                    <option value="">Any Rating</option>
                    <option value="4.5" {{ request('min_rating')=='4.5' ? 'selected':'' }}>★ 4.5+</option>
                    <option value="4.7" {{ request('min_rating')=='4.7' ? 'selected':'' }}>★ 4.7+</option>
                    <option value="4.9" {{ request('min_rating')=='4.9' ? 'selected':'' }}>★ 4.9+</option>
                </select>

                @if(request()->hasAny(['min_price','max_price','availability','tutor_type','min_rating']))
                    <a href="{{ route('find-tutors', ['subject'=>$slug]) }}" class="fth__clear">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/></svg>
                        Clear
                    </a>
                @endif
            </form>
        </div>

        {{-- Right: illustration / stat cards --}}
        <div class="fth__visual" aria-hidden="true">
            <div class="fth__vis-blob"></div>
            <div class="fth__vis-card fth__vis-card--1">
                <div class="fth__vis-num">{{ number_format($totalCount) }}+</div>
                <div class="fth__vis-lbl">{{ $subject?->name }} Tutors</div>
            </div>
            <div class="fth__vis-card fth__vis-card--2">
                <div class="fth__vis-num">4.8 ★</div>
                <div class="fth__vis-lbl">Average Rating</div>
            </div>
            <div class="fth__vis-card fth__vis-card--3">
                <div class="fth__vis-num">180+</div>
                <div class="fth__vis-lbl">Countries</div>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════════════════
     RESULTS BAR + GRID
════════════════════════════════════════════════════════ --}}
<section class="ftb">
    <div class="ftb__inner">

        {{-- Results count + sort --}}
        <div class="ftb__bar">
            <p class="ftb__count">
                <strong>{{ number_format($tutors->total()) }}</strong>
                {{ $subject?->name ?? 'tutors' }} found
            </p>
            <div class="ftb__controls">
                <form method="GET" action="{{ route('find-tutors') }}" id="sort-form">
                    @foreach(request()->except('sort') as $k => $v)
                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                    @endforeach
                    <select name="sort" class="ftb__sort" onchange="document.getElementById('sort-form').submit()">
                        <option value="top_rated"  {{ $sort==='top_rated'  ? 'selected':'' }}>Top Rated</option>
                        <option value="price_low"  {{ $sort==='price_low'  ? 'selected':'' }}>Price: Low to High</option>
                        <option value="price_high" {{ $sort==='price_high' ? 'selected':'' }}>Price: High to Low</option>
                        <option value="newest"     {{ $sort==='newest'     ? 'selected':'' }}>Newest First</option>
                    </select>
                </form>
            </div>
        </div>

        {{-- Tutor Cards --}}
        @if($tutors->isEmpty())
            <div class="ftb__empty">
                <div class="ftb__empty-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                </div>
                <h3>No tutors found</h3>
                <p>Try adjusting your filters or <a href="{{ route('find-tutors', ['subject'=>$slug]) }}">reset them</a>.</p>
            </div>
        @else
            <div class="ftb__grid" id="tutor-grid">
                @foreach($tutors as $tutor)

                {{-- Generate a deterministic pastel hue from the tutor's initial --}}
                @php
                    $hues   = ['E8F5E9','F3E5F5','E3F2FD','FFF3E0','FCE4EC','E0F7FA','F9FBE7','EDE7F6'];
                    $hue    = $hues[$tutor->id % count($hues)];
                    $initials = strtoupper(substr($tutor->name, 0, 2));
                @endphp

                <article class="ftc" id="tutor-{{ $tutor->id }}">

                    {{-- ── Image section ─────────────────── --}}
                    <div class="ftc__img-wrap">

                        @if($tutor->image)
                            <img src="{{ str_starts_with($tutor->image, 'http') ? $tutor->image : '/storage/' . $tutor->image }}" alt="{{ $tutor->name }}" class="ftc__img" loading="lazy">
                        @else
                            {{-- Premium placeholder: initials on coloured gradient --}}
                            <div class="ftc__img-placeholder" style="background: #{{ $hue }}">
                                <span class="ftc__initials">{{ $initials }}</span>
                            </div>
                        @endif

                        {{-- Gradient overlay --}}
                        <div class="ftc__img-overlay"></div>

                        {{-- Floating badges on image --}}
                        <div class="ftc__img-badges">
                            @if($tutor->badge_label)
                                <span class="ftc__badge ftc__badge--{{ $tutor->badge }}">
                                    @if($tutor->badge==='top_rated')
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd"/></svg>
                                    @elseif($tutor->badge==='super_tutor')
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M9 4.5a.75.75 0 0 1 .721.544l.813 2.846a3.75 3.75 0 0 0 2.576 2.576l2.846.813a.75.75 0 0 1 0 1.442l-2.846.813a3.75 3.75 0 0 0-2.576 2.576l-.813 2.846a.75.75 0 0 1-1.442 0l-.813-2.846a3.75 3.75 0 0 0-2.576-2.576l-2.846-.813a.75.75 0 0 1 0-1.442l2.846-.813A3.75 3.75 0 0 0 7.466 7.89l.813-2.846A.75.75 0 0 1 9 4.5ZM18 1.5a.75.75 0 0 1 .728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 0 1 0 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 0 1-1.456 0l-.258-1.036a2.625 2.625 0 0 0-1.91-1.91l-1.036-.258a.75.75 0 0 1 0-1.456l1.036-.258a2.625 2.625 0 0 0 1.91-1.91l.258-1.036A.75.75 0 0 1 18 1.5Z" clip-rule="evenodd"/></svg>
                                    @endif
                                    {{ $tutor->badge_label }}
                                </span>
                            @endif
                            @if($tutor->is_online)
                                <span class="ftc__badge ftc__badge--online">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><circle cx="12" cy="12" r="4"/></svg>
                                    Live
                                </span>
                            @endif
                        </div>

                        {{-- Wishlist --}}
                        @if(!Auth::check() || Auth::user()->role === 'student')
                            <form action="{{ route('tutor.wishlist.store', $tutor->slug) }}" method="POST" style="display: contents;">
                                @csrf
                                <button type="submit" class="ftc__wish" aria-label="Save tutor">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/></svg>
                                </button>
                            </form>
                        @endif
                    </div>

                    {{-- ── Card body ──────────────────────── --}}
                    <div class="ftc__body">

                        {{-- Name + flag + verified --}}
                        <div class="ftc__name-row">
                            <h3 class="ftc__name">{{ $tutor->name }}</h3>
                            <div class="ftc__meta-right">
                                @if($tutor->is_verified)
                                    <span class="ftc__verified" title="Verified">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0 1 12 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 0 1 3.498 1.307 4.491 4.491 0 0 1 1.307 3.497A4.49 4.49 0 0 1 21.75 12a4.49 4.49 0 0 1-1.549 3.397 4.491 4.491 0 0 1-1.307 3.497 4.491 4.491 0 0 1-3.497 1.307A4.49 4.49 0 0 1 12 21.75a4.49 4.49 0 0 1-3.397-1.549 4.49 4.49 0 0 1-3.498-1.307 4.491 4.491 0 0 1-1.307-3.498A4.49 4.49 0 0 1 2.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 0 1 1.307-3.497 4.49 4.49 0 0 1 3.497-1.307Zm7.007 6.387a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd"/></svg>
                                    </span>
                                @endif
                                <span class="ftc__flag">{{ $tutor->country_flag }}</span>
                            </div>
                        </div>

                        {{-- Speciality --}}
                        <p class="ftc__role">{{ $tutor->speciality ?? 'General Tutoring' }}</p>

                        {{-- Rating --}}
                        <div class="ftc__rating">
                            <span class="ftc__stars">★</span>
                            <span class="ftc__rval">{{ number_format($tutor->rating, 1) }}</span>
                            <span class="ftc__rct">({{ number_format($tutor->reviews_count) }})</span>
                        </div>

                        {{-- Students + lessons --}}
                        <div class="ftc__stats">
                            <span>{{ number_format($tutor->students_count) }} students</span>
                            <span class="ftc__bull">·</span>
                            <span>{{ number_format($tutor->lessons_count) }} lessons</span>
                        </div>

                        {{-- Language chips --}}
                        <div class="ftc__langs">
                            @if($tutor->languages)
                                @foreach(explode(',', $tutor->languages) as $lang)
                                    <span class="ftc__lang">{{ trim($lang) }}</span>
                                @endforeach
                            @else
                                <span class="ftc__lang">Languages not added</span>
                            @endif
                        </div>

                        {{-- Speciality tag --}}
                        @if($tutor->speciality)
                            <div class="ftc__spec-tag">{{ \Str::limit($tutor->speciality, 40) }}</div>
                        @endif
                    </div>

                    {{-- ── Card CTA ───────────────────────── --}}
                    <div class="ftc__cta">
                        <div class="ftc__price">
                            <span class="ftc__price-val">Rs {{ number_format($tutor->hourly_rate) }}</span>
                            <span class="ftc__price-unit">/ lesson</span>
                        </div>
                        <div class="ftc__cta-buttons">
                            @if(Auth::check() && Auth::user()->role === 'tutor')
                                <button disabled class="ftc__btn-book bg-gray-100 text-gray-400 border border-gray-200 cursor-not-allowed" title="Booking lessons is only available for student accounts">Use Student Account</button>
                                <button disabled class="ftc__btn-msg bg-gray-50 text-gray-300 border border-gray-100 cursor-not-allowed relative group">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/></svg>
                                </button>
                            @else
                                <button onclick="openBookingModal({{ $tutor->id }}, '{{ addslashes($tutor->name) }}', '{{ $tutor->image ? (str_starts_with($tutor->image, 'http') ? $tutor->image : '/storage/' . $tutor->image) : '' }}', {{ $tutor->hourly_rate }}, '{{ addslashes($tutor->speciality ?? 'General Tutoring') }}')" class="ftc__btn-book">Book lesson</button>
                                <a href="#" class="ftc__btn-msg group relative" title="Message (Coming Soon)">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="group-hover:opacity-50"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>

                </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($tutors->hasPages())
                <div class="ftb__pagination">
                    {{ $tutors->links('pagination::tailwind') }}
                </div>
            @endif
        @endif
    </div>
</section>

{{-- ════════════════════════════════════════════════════════
     TRUST BAR
════════════════════════════════════════════════════════ --}}
<div class="ftt">
    <div class="ftt__inner">
        <div class="ftt__item">
            <div class="ftt__icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0 1 12 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 0 1 3.498 1.307 4.491 4.491 0 0 1 1.307 3.497A4.49 4.49 0 0 1 21.75 12a4.49 4.49 0 0 1-1.549 3.397 4.491 4.491 0 0 1-1.307 3.497 4.491 4.491 0 0 1-3.497 1.307A4.49 4.49 0 0 1 12 21.75a4.49 4.49 0 0 1-3.397-1.549 4.49 4.49 0 0 1-3.498-1.307 4.491 4.491 0 0 1-1.307-3.498A4.49 4.49 0 0 1 2.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 0 1 1.307-3.497 4.49 4.49 0 0 1 3.497-1.307Zm7.007 6.387a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <div class="ftt__name">Verified Tutors</div>
                <div class="ftt__sub">All tutors are verified and background checked</div>
            </div>
        </div>
        <div class="ftt__item">
            <div class="ftt__icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd"/></svg>
            </div>
            <div>
                <div class="ftt__name">5-Star Reviews</div>
                <div class="ftt__sub">Real reviews from students worldwide</div>
            </div>
        </div>
        <div class="ftt__item">
            <div class="ftt__icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z"/></svg>
            </div>
            <div>
                <div class="ftt__name">Instant Booking</div>
                <div class="ftt__sub">Book your first lesson in just a few clicks</div>
            </div>
        </div>
        <div class="ftt__item">
            <div class="ftt__icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
            </div>
            <div>
                <div class="ftt__name">24/7 Support</div>
                <div class="ftt__sub">We're here to help you anytime</div>
            </div>
        </div>
        <div class="ftt__item">
            <div class="ftt__icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
            </div>
            <div>
                <div class="ftt__name">Safe &amp; Secure</div>
                <div class="ftt__sub">Your payments and data are always protected</div>
            </div>
        </div>
    </div>
</div>

{{-- ════════════════════════════════════════════════════════
     BOOKING MODAL (Alpine.js)
════════════════════════════════════════════════════════ --}}
<div x-data="bookingModal()" 
     @open-booking.window="open($event.detail)"
     x-show="isOpen" 
     style="display: none;"
     class="fixed inset-0 z-[100] overflow-y-auto" 
     aria-labelledby="modal-title" 
     role="dialog" 
     aria-modal="true">
     
    {{-- Backdrop --}}
    <div x-show="isOpen" 
         x-transition:enter="ease-out duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="ease-in duration-200" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm transition-opacity" 
         @click="close()"></div>

    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        {{-- Modal Panel --}}
        <div x-show="isOpen" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-4xl flex flex-col md:flex-row max-h-[90vh]">
            
            {{-- Close button --}}
            <button @click="close()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-full p-2 transition-colors z-10">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            {{-- Left Pane: Tutor Details --}}
            <div class="bg-gray-50 p-8 md:w-1/3 border-b md:border-b-0 md:border-r border-gray-100 flex flex-col justify-between">
                <div>
                    <h3 class="text-sm font-bold text-gray-400 tracking-wider uppercase mb-6">Book Lesson</h3>
                    
                    <div class="flex flex-col items-start gap-4">
                        <template x-if="tutor.image">
                            <img :src="tutor.image" class="w-20 h-20 rounded-full object-cover shadow-sm border-2 border-white">
                        </template>
                        <template x-if="!tutor.image">
                            <div class="w-20 h-20 rounded-full bg-lime-100 flex items-center justify-center text-lime-700 font-bold text-xl border-2 border-white shadow-sm" x-text="tutor.name ? tutor.name.substring(0,2).toUpperCase() : ''"></div>
                        </template>
                        
                        <div>
                            <h4 class="text-xl font-black text-gray-900" x-text="tutor.name"></h4>
                            <p class="text-sm text-gray-500 font-medium mt-1" x-text="tutor.speciality"></p>
                        </div>
                    </div>

                    <div class="mt-8 space-y-4">
                        <div class="flex items-center gap-3 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                            <span class="text-sm font-medium">60 minutes</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-600">
                            <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/></svg>
                            <span class="text-sm font-medium">Rs <span x-text="tutor.price"></span></span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <p class="text-xs text-gray-500">You will be charged securely via Razorpay to confirm your booking.</p>
                </div>
            </div>

            {{-- Right Pane: Calendar & Slots --}}
            <div class="p-8 md:w-2/3 bg-white flex flex-col overflow-y-auto">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Select Date & Time</h3>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 flex-grow">
                    
                    {{-- Calendar area --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Date</label>
                        <input type="date" x-model="selectedDate" @change="fetchSlots()" :min="minDate" class="w-full border border-gray-300 rounded-xl px-4 py-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-transparent transition-shadow">
                    </div>

                    {{-- Time slots area --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Available Times</label>
                        
                        <div x-show="isLoading" class="flex justify-center items-center h-32">
                            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-lime-500"></div>
                        </div>

                        <div x-show="!isLoading && !selectedDate" class="flex flex-col items-center justify-center h-32 text-center border-2 border-dashed border-gray-100 rounded-xl bg-gray-50">
                            <p class="text-sm text-gray-400">Select a date first</p>
                        </div>

                        <div x-show="!isLoading && selectedDate && slots.length === 0" class="flex flex-col items-center justify-center h-32 text-center border-2 border-dashed border-gray-100 rounded-xl bg-gray-50">
                            <p class="text-sm text-gray-500 font-medium">No slots available</p>
                            <p class="text-xs text-gray-400 mt-1">Try selecting another date</p>
                        </div>

                        <div x-show="!isLoading && slots.length > 0" class="grid grid-cols-2 gap-3 max-h-64 overflow-y-auto pr-2 custom-scrollbar">
                            <template x-for="slot in slots" :key="slot.time">
                                <button type="button" 
                                    @click="selectedTime = slot.time"
                                    class="py-3 px-4 rounded-xl text-sm font-bold transition-all border"
                                    :class="selectedTime === slot.time ? 'bg-lime-50 border-lime-500 text-lime-700 shadow-sm' : 'bg-white border-gray-200 text-gray-700 hover:border-lime-300 hover:bg-gray-50'">
                                    <span x-text="slot.label"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                </div>

                {{-- Action Footer --}}
                <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-between">
                    <div>
                        <template x-if="selectedDate && selectedTime">
                            <div class="text-sm font-medium text-gray-900">
                                Selected: <span class="font-bold text-lime-600" x-text="formatSelectedDateTime()"></span>
                            </div>
                        </template>
                    </div>
                    <button @click="submitBooking()" 
                            :disabled="!selectedDate || !selectedTime || isSubmitting"
                            class="px-8 py-3 bg-gray-900 hover:bg-black text-white font-bold rounded-xl transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2 shadow-lg shadow-gray-900/20">
                        <span x-show="!isSubmitting">Confirm Booking</span>
                        <span x-show="isSubmitting">Booking...</span>
                    </button>
                </div>
                
                {{-- Error Message --}}
                <div x-show="errorMessage" class="mt-4 p-3 bg-red-50 text-red-700 text-sm rounded-lg font-medium" x-text="errorMessage"></div>
                <div x-show="successMessage" class="mt-4 p-3 bg-green-50 text-green-700 text-sm rounded-lg font-medium" x-text="successMessage"></div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Preserve existing price range inputs on search
    document.querySelectorAll('.fth__filterbar').forEach(form => {
        form.addEventListener('submit', () => {
            // allowed to submit naturally
        });
    });

    // Booking modal Alpine component
    function bookingModal() {
        return {
            isOpen: false,
            isLoading: false,
            isSubmitting: false,
            tutor: {},
            selectedDate: '',
            selectedTime: '',
            slots: [],
            minDate: new Date().toISOString().split('T')[0],
            errorMessage: '',
            successMessage: '',

            open(data) {
                // If not logged in, redirect to login
                @if(!Auth::check())
                    window.location.href = "{{ route('login') }}";
                    return;
                @endif

                this.tutor = data;
                this.isOpen = true;
                this.reset();
            },

            close() {
                this.isOpen = false;
                setTimeout(() => this.reset(), 300);
            },

            reset() {
                this.selectedDate = '';
                this.selectedTime = '';
                this.slots = [];
                this.errorMessage = '';
                this.successMessage = '';
                this.isLoading = false;
                this.isSubmitting = false;
            },

            async fetchSlots() {
                if (!this.selectedDate) return;
                
                this.selectedTime = '';
                this.slots = [];
                this.isLoading = true;
                this.errorMessage = '';
                
                try {
                    const response = await fetch(`/api/tutors/${this.tutor.id}/slots?date=${this.selectedDate}`);
                    const data = await response.json();
                    
                    if (data.slots) {
                        this.slots = data.slots;
                    }
                } catch (error) {
                    this.errorMessage = 'Failed to fetch availability. Please try again.';
                } finally {
                    this.isLoading = false;
                }
            },

            formatSelectedDateTime() {
                if (!this.selectedDate || !this.selectedTime) return '';
                const d = new Date(this.selectedDate + 'T' + this.selectedTime);
                return d.toLocaleString('en-US', { weekday: 'short', month: 'short', day: 'numeric', hour: 'numeric', minute: '2-digit' });
            },

            async submitBooking() {
                if (!this.selectedDate || !this.selectedTime) return;
                
                this.isSubmitting = true;
                this.errorMessage = '';
                this.successMessage = '';
                
                // Razorpay Test Mode Options
                const options = {
                    "key": "{{ config('services.razorpay.key') ?? 'rzp_test_dummy' }}",
                    "amount": this.tutor.price * 100, // amount in paisa
                    "currency": "INR",
                    "name": "Tutzy Marketplace",
                    "description": "Lesson with " + this.tutor.name,
                    "handler": async (response) => {
                        // On successful payment, confirm booking on backend
                        try {
                            const res = await fetch(`/api/tutors/${this.tutor.id}/book`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    date: this.selectedDate,
                                    time: this.selectedTime,
                                    payment_id: response.razorpay_payment_id
                                })
                            });
                            
                            const data = await res.json();
                            
                            if (res.ok) {
                                this.successMessage = data.message || 'Booking successful!';
                                setTimeout(() => {
                                    this.close();
                                    window.location.href = "{{ route('student.lessons') }}";
                                }, 1500);
                            } else {
                                this.errorMessage = data.error || 'Failed to confirm booking after payment.';
                                this.isSubmitting = false;
                            }
                        } catch (error) {
                            this.errorMessage = 'A network error occurred verifying your payment. Please contact support.';
                            this.isSubmitting = false;
                        }
                    },
                    "modal": {
                        "ondismiss": () => {
                            this.isSubmitting = false;
                            this.errorMessage = 'Payment cancelled. Your lesson was not booked.';
                        }
                    }
                };

                const rzp = new Razorpay(options);
                rzp.on('payment.failed', (response) => {
                    this.isSubmitting = false;
                    this.errorMessage = response.error.description || 'Payment failed.';
                });
                rzp.open();
            }
        };
    }

    // Trigger open
    function openBookingModal(id, name, image, price, speciality) {
        window.dispatchEvent(new CustomEvent('open-booking', {
            detail: { id, name, image, price, speciality }
        }));
    }
</script>
@endpush
