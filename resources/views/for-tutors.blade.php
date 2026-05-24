@extends('layout')

@section('title', 'Teach on Tutzy – Earn Teaching the World\'s Largest Learning Community')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/for-tutors.css') }}">
@endpush

@section('content')

{{-- ═══════════════════════════════ HERO ═══════════════════════════════ --}}
<section class="ft-hero" id="ft-hero">

    {{-- Mesh gradient bg --}}
    <div class="ft-hero__mesh" aria-hidden="true">
        <svg class="ft-hero__mesh-svg" viewBox="0 0 1440 900" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
            <defs>
                <radialGradient id="g1" cx="20%" cy="30%" r="55%">
                    <stop offset="0%" stop-color="#d9f99d" stop-opacity="0.55"/>
                    <stop offset="100%" stop-color="#ffffff" stop-opacity="0"/>
                </radialGradient>
                <radialGradient id="g2" cx="80%" cy="70%" r="50%">
                    <stop offset="0%" stop-color="#a3e635" stop-opacity="0.25"/>
                    <stop offset="100%" stop-color="#ffffff" stop-opacity="0"/>
                </radialGradient>
                <radialGradient id="g3" cx="50%" cy="10%" r="40%">
                    <stop offset="0%" stop-color="#bef264" stop-opacity="0.2"/>
                    <stop offset="100%" stop-color="#ffffff" stop-opacity="0"/>
                </radialGradient>
            </defs>
            <rect width="100%" height="100%" fill="url(#g1)"/>
            <rect width="100%" height="100%" fill="url(#g2)"/>
            <rect width="100%" height="100%" fill="url(#g3)"/>
        </svg>
        {{-- Animated path lines --}}
        <svg class="ft-hero__path-lines" viewBox="0 0 1440 900" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
            <path class="ft-path-line ft-path-line--1" d="M-100,450 C200,200 600,700 900,350 S1300,100 1600,400" fill="none" stroke="#a3e635" stroke-width="1.5" stroke-opacity="0.25"/>
            <path class="ft-path-line ft-path-line--2" d="M-50,600 C300,300 700,800 1050,400 S1400,150 1700,500" fill="none" stroke="#84cc16" stroke-width="1" stroke-opacity="0.15"/>
            <path class="ft-path-line ft-path-line--3" d="M0,200 C400,500 800,100 1200,500 S1500,300 1800,200" fill="none" stroke="#a3e635" stroke-width="0.8" stroke-opacity="0.12"/>
        </svg>
    </div>

    <div class="ft-hero__container">

        {{-- LEFT ─ Content --}}
        <div class="ft-hero__left" id="ft-hero-left">

            <div class="ft-hero__eyebrow">
                <span class="ft-eyebrow-dot"></span>
                For Tutors
            </div>

            <h1 class="ft-hero__heading">
                Make a living by<br>
                <span class="ft-hero__highlight">teaching</span> the world's<br>
                largest community<br>
                of <span class="ft-hero__highlight">learners</span>
            </h1>

            <p class="ft-hero__sub">
                Join 100,000+ tutors already earning on Tutzy. Set your rate, choose your hours, and teach students from 180+ countries — all from one elegant workspace.
            </p>

            <div class="ft-hero__actions">
                <a href="/get-started" class="ft-btn ft-btn--primary" id="ft-hero-cta-primary">
                    <span>Start Teaching Today</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                </a>
                <a href="#ft-how" class="ft-btn ft-btn--ghost" id="ft-hero-cta-learn">
                    See how it works
                </a>
            </div>

            {{-- Mini stats --}}
            <div class="ft-hero__stats">
                <div class="ft-hero__stat">
                    <span class="ft-hero__stat-val">₹2,30,000</span>
                    <span class="ft-hero__stat-lbl">avg. monthly earnings</span>
                </div>
                <div class="ft-hero__stat-divider"></div>
                <div class="ft-hero__stat">
                    <span class="ft-hero__stat-val">100K+</span>
                    <span class="ft-hero__stat-lbl">active tutors</span>
                </div>
                <div class="ft-hero__stat-divider"></div>
                <div class="ft-hero__stat">
                    <span class="ft-hero__stat-val">4.9★</span>
                    <span class="ft-hero__stat-lbl">tutor satisfaction</span>
                </div>
            </div>

            {{-- Trust badges --}}
            <div class="ft-hero__trust">
                <div class="ft-trust-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                    Free to join
                </div>
                <div class="ft-trust-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z"/></svg>
                    Weekly payouts
                </div>
                <div class="ft-trust-badge">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    Flexible hours
                </div>
            </div>
        </div>

        {{-- RIGHT ─ Workspace scene --}}
        <div class="ft-hero__right" id="ft-hero-right">
            <div class="ft-workspace" id="ft-workspace">

                {{-- Glow behind profile --}}
                <div class="ft-workspace__glow" aria-hidden="true"></div>

                {{-- Central tutor profile card --}}
                <div class="ft-profile-card" id="ft-profile-card">
                    <div class="ft-profile-card__pulse" aria-hidden="true"></div>
                    <div class="ft-profile-card__avatar">
                        <svg viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg" fill="none">
                            <circle cx="30" cy="30" r="30" fill="#d9f99d"/>
                            <circle cx="30" cy="22" r="10" fill="#65a30d"/>
                            <ellipse cx="30" cy="50" rx="16" ry="11" fill="#65a30d"/>
                        </svg>
                        <div class="ft-profile-card__online"></div>
                    </div>
                    <div class="ft-profile-card__info">
                        <div class="ft-profile-card__name">Sarah K.</div>
                        <div class="ft-profile-card__subject">Mathematics · Physics</div>
                        <div class="ft-profile-card__rating">
                            <svg viewBox="0 0 20 20" fill="#a3e635" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <span>4.97</span>
                            <span class="ft-profile-card__reviews">(284 reviews)</span>
                        </div>
                    </div>
                </div>

                {{-- Earnings card - floats upper right --}}
                <div class="ft-float-card ft-float-card--earnings" id="ft-card-earnings">
                    <div class="ft-float-card__label">This Month</div>
                    <div class="ft-float-card__value">₹2,70,000</div>
                    <div class="ft-float-card__trend">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="#65a30d"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 19.5 15-15m0 0H8.25m11.25 0v11.25"/></svg>
                        <span>+18% vs last month</span>
                    </div>
                    {{-- Mini bar chart --}}
                    <div class="ft-mini-chart">
                        <div class="ft-mini-chart__bar" style="height:40%"></div>
                        <div class="ft-mini-chart__bar" style="height:60%"></div>
                        <div class="ft-mini-chart__bar" style="height:50%"></div>
                        <div class="ft-mini-chart__bar" style="height:75%"></div>
                        <div class="ft-mini-chart__bar" style="height:65%"></div>
                        <div class="ft-mini-chart__bar ft-mini-chart__bar--active" style="height:90%"></div>
                    </div>
                </div>

                {{-- SVG line graph card --}}
                <div class="ft-float-card ft-float-card--graph" id="ft-card-graph">
                    <div class="ft-float-card__header">
                        <div class="ft-float-card__label">Earnings Growth</div>
                        <span class="ft-graph-badge">Live</span>
                    </div>
                    <svg class="ft-svg-graph" viewBox="0 0 220 80" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="graphGrad" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#a3e635" stop-opacity="0.3"/>
                                <stop offset="100%" stop-color="#a3e635" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                        <path class="ft-graph-area" d="M0,70 L30,55 L60,45 L90,50 L120,30 L150,20 L180,10 L220,5 L220,80 L0,80 Z" fill="url(#graphGrad)"/>
                        <path class="ft-graph-line" id="ft-graph-path" d="M0,70 L30,55 L60,45 L90,50 L120,30 L150,20 L180,10 L220,5" fill="none" stroke="#84cc16" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle class="ft-graph-dot" cx="220" cy="5" r="4" fill="#84cc16"/>
                    </svg>
                </div>

                {{-- Rating widget - lower left --}}
                <div class="ft-float-card ft-float-card--rating" id="ft-card-rating">
                    <div class="ft-rating-stars">
                        <svg viewBox="0 0 20 20" fill="#a3e635" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg viewBox="0 0 20 20" fill="#a3e635" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg viewBox="0 0 20 20" fill="#a3e635" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg viewBox="0 0 20 20" fill="#a3e635" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        <svg viewBox="0 0 20 20" fill="#a3e635" xmlns="http://www.w3.org/2000/svg"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </div>
                    <div class="ft-rating-text">New 5★ review!</div>
                    <div class="ft-rating-quote">"Best math tutor I've ever had"</div>
                </div>

                {{-- Student avatars card --}}
                <div class="ft-float-card ft-float-card--students" id="ft-card-students">
                    <div class="ft-students-avatars">
                        <div class="ft-student-avatar" style="background:#d9f99d;color:#365314;">A</div>
                        <div class="ft-student-avatar" style="background:#bef264;color:#1a2e05;">J</div>
                        <div class="ft-student-avatar" style="background:#a3e635;color:#1a1a1a;">M</div>
                        <div class="ft-student-avatar ft-student-avatar--more">+21</div>
                    </div>
                    <div class="ft-students-info">
                        <div class="ft-students-count">24 active students</div>
                        <div class="ft-students-live">
                            <span class="ft-live-dot"></span> 3 live now
                        </div>
                    </div>
                </div>

                {{-- Animated progress arc --}}
                <div class="ft-float-card ft-float-card--progress" id="ft-card-progress">
                    <svg class="ft-arc-svg" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="40" cy="40" r="30" fill="none" stroke="#e5e7eb" stroke-width="6"/>
                        <circle class="ft-arc-fill" cx="40" cy="40" r="30" fill="none" stroke="#a3e635" stroke-width="6" stroke-linecap="round"
                            stroke-dasharray="188.5" stroke-dashoffset="28" transform="rotate(-90 40 40)"/>
                        <text x="40" y="45" text-anchor="middle" font-size="14" font-weight="700" fill="#1a1a1a">85%</text>
                    </svg>
                    <div class="ft-arc-label">Completion<br>rate</div>
                </div>

            </div>
        </div>
    </div>
</section>


{{-- ═══════════════════════════════ HOW IT WORKS ═══════════════════════ --}}
<section class="ft-how" id="ft-how">
    <div class="ft-section-container">
        <div class="ft-section-eyebrow">Simple Process</div>
        <h2 class="ft-section-heading">From sign-up to <span class="ft-heading-lime">first earnings</span><br>in 24 hours</h2>
        <p class="ft-section-sub">A streamlined onboarding that gets you teaching — and earning — fast.</p>

        {{-- Connected step path --}}
        <div class="ft-steps" id="ft-steps">

            {{-- SVG connector path --}}
            <svg class="ft-steps__connector" viewBox="0 0 900 80" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path class="ft-connector-track" d="M80,40 L820,40" fill="none" stroke="#e5e7eb" stroke-width="2" stroke-dasharray="6 4"/>
                <path class="ft-connector-progress" id="ft-connector-path" d="M80,40 L820,40" fill="none" stroke="#a3e635" stroke-width="2.5" stroke-dasharray="740" stroke-dashoffset="740"/>
            </svg>

            <div class="ft-step" id="ft-step-1">
                <div class="ft-step__node">
                    <div class="ft-step__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                    </div>
                    <div class="ft-step__num">01</div>
                </div>
                <div class="ft-step__content">
                    <h3 class="ft-step__title">Create your profile</h3>
                    <p class="ft-step__desc">Set up your teaching profile with your expertise, bio, and hourly rate in minutes.</p>
                    <div class="ft-step__tag">~5 minutes</div>
                </div>
            </div>

            <div class="ft-step" id="ft-step-2">
                <div class="ft-step__node">
                    <div class="ft-step__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                    </div>
                    <div class="ft-step__num">02</div>
                </div>
                <div class="ft-step__content">
                    <h3 class="ft-step__title">Get verified</h3>
                    <p class="ft-step__desc">Upload credentials and pass our quick quality check. Most tutors get approved within 24 hours.</p>
                    <div class="ft-step__tag">24 hrs</div>
                </div>
            </div>

            <div class="ft-step" id="ft-step-3">
                <div class="ft-step__node">
                    <div class="ft-step__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                    </div>
                    <div class="ft-step__num">03</div>
                </div>
                <div class="ft-step__content">
                    <h3 class="ft-step__title">Set availability</h3>
                    <p class="ft-step__desc">Use our smart calendar to set when you're available. Students book you instantly.</p>
                    <div class="ft-step__tag">Your schedule</div>
                </div>
            </div>

            <div class="ft-step" id="ft-step-4">
                <div class="ft-step__node ft-step__node--active">
                    <div class="ft-step__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/></svg>
                    </div>
                    <div class="ft-step__num">04</div>
                </div>
                <div class="ft-step__content">
                    <h3 class="ft-step__title">Start earning</h3>
                    <p class="ft-step__desc">Teach sessions and get paid weekly via Stripe. Track every dollar in your dashboard.</p>
                    <div class="ft-step__tag ft-step__tag--green">💰 Payday!</div>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ═══════════════════════════════ BENEFITS ═══════════════════════════ --}}
<section class="ft-benefits" id="ft-benefits">
    <div class="ft-section-container">
        <div class="ft-section-eyebrow">Why Tutors Choose Tutzy</div>
        <h2 class="ft-section-heading">Everything you need to <span class="ft-heading-lime">build a thriving</span> teaching career</h2>

        <div class="ft-benefits-grid">

            <div class="ft-benefit-card ft-reveal" id="ft-benefit-1">
                <div class="ft-benefit-card__icon ft-benefit-card__icon--lime">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/></svg>
                </div>
                <h3 class="ft-benefit-card__title">Premium earnings</h3>
                <p class="ft-benefit-card__desc">Set your own rate. Top tutors earn ₹2,50,000–₹6,50,000/month. You keep 85% of every session — one of the best rates in the industry.</p>
                <div class="ft-benefit-card__stat">
                    <span class="ft-benefit-stat-val">85%</span>
                    <span class="ft-benefit-stat-lbl">you keep</span>
                </div>
            </div>

            <div class="ft-benefit-card ft-reveal" id="ft-benefit-2">
                <div class="ft-benefit-card__icon ft-benefit-card__icon--emerald">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                </div>
                <h3 class="ft-benefit-card__title">Total flexibility</h3>
                <p class="ft-benefit-card__desc">Teach 5 hours or 50 hours a week. Set your schedule, block off personal time, and never miss what matters.</p>
                <div class="ft-benefit-card__visual">
                    <div class="ft-mini-calendar">
                        <div class="ft-cal-day ft-cal-day--on">M</div>
                        <div class="ft-cal-day">T</div>
                        <div class="ft-cal-day ft-cal-day--on">W</div>
                        <div class="ft-cal-day">T</div>
                        <div class="ft-cal-day ft-cal-day--on">F</div>
                        <div class="ft-cal-day">S</div>
                        <div class="ft-cal-day ft-cal-day--half">S</div>
                    </div>
                </div>
            </div>

            <div class="ft-benefit-card ft-reveal" id="ft-benefit-3">
                <div class="ft-benefit-card__icon ft-benefit-card__icon--teal">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253M3 12c0 .778.099 1.533.284 2.253"/></svg>
                </div>
                <h3 class="ft-benefit-card__title">Global student base</h3>
                <p class="ft-benefit-card__desc">Access millions of motivated students from 180+ countries. Teach English, STEM, coding, arts — whatever you're great at.</p>
                <div class="ft-benefit-card__stat">
                    <span class="ft-benefit-stat-val">180+</span>
                    <span class="ft-benefit-stat-lbl">countries</span>
                </div>
            </div>

            <div class="ft-benefit-card ft-reveal" id="ft-benefit-4">
                <div class="ft-benefit-card__icon ft-benefit-card__icon--violet">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/></svg>
                </div>
                <h3 class="ft-benefit-card__title">Smart tools built in</h3>
                <p class="ft-benefit-card__desc">Interactive whiteboard, session recordings, student progress analytics, and AI session summaries — all included, no extra cost.</p>
                <div class="ft-benefit-card__tags">
                    <span class="ft-mini-tag">Whiteboard</span>
                    <span class="ft-mini-tag">Analytics</span>
                    <span class="ft-mini-tag">AI Notes</span>
                </div>
            </div>

            <div class="ft-benefit-card ft-reveal" id="ft-benefit-5">
                <div class="ft-benefit-card__icon ft-benefit-card__icon--amber">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                </div>
                <h3 class="ft-benefit-card__title">Tutor protection</h3>
                <p class="ft-benefit-card__desc">Our policies protect you from last-minute cancellations. Get paid even when students cancel within 24 hours of a session.</p>
                <div class="ft-benefit-card__badge">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>
                    Tutzy Guarantee
                </div>
            </div>

            <div class="ft-benefit-card ft-reveal" id="ft-benefit-6">
                <div class="ft-benefit-card__icon ft-benefit-card__icon--rose">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/></svg>
                </div>
                <h3 class="ft-benefit-card__title">Tutor community</h3>
                <p class="ft-benefit-card__desc">Join Slack groups, attend monthly webinars, and get mentored by top-rated tutors. You're never building this alone.</p>
                <div class="ft-benefit-card__avatars">
                    <div class="ft-tiny-avatar" style="background:#a3e635;color:#1a1a1a;">S</div>
                    <div class="ft-tiny-avatar" style="background:#bef264;color:#1a1a1a;">J</div>
                    <div class="ft-tiny-avatar" style="background:#d9f99d;color:#365314;">M</div>
                    <div class="ft-tiny-avatar ft-tiny-avatar--count">+4k</div>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ═══════════════════════════════ PLATFORM FEATURES ════════════════ --}}
<section class="ft-platform" id="ft-platform">
    <div class="ft-section-container">
        <div class="ft-section-eyebrow">Platform Features</div>
        <h2 class="ft-section-heading">A workspace designed<br>for <span class="ft-heading-lime">world-class tutors</span></h2>

        <div class="ft-platform-features">

            {{-- Feature 1: Smart Calendar --}}
            <div class="ft-platform-row ft-reveal" id="ft-pf-1">
                <div class="ft-platform-row__text">
                    <div class="ft-platform-tag">Smart Scheduling</div>
                    <h3 class="ft-platform-row__title">Your calendar, fully intelligent</h3>
                    <p class="ft-platform-row__desc">Set recurring availability, block off holidays, and let students book in their timezone. Tutzy handles timezone conversion, reminders, and rescheduling automatically.</p>
                    <ul class="ft-feature-list">
                        <li>Auto timezone detection for students</li>
                        <li>Buffer time between sessions</li>
                        <li>Google Calendar & Outlook sync</li>
                        <li>Instant booking confirmations</li>
                    </ul>
                </div>
                <div class="ft-platform-row__visual">
                    <div class="ft-cal-widget">
                        <div class="ft-cal-widget__header">
                            <span class="ft-cal-dot ft-cal-dot--green"></span>
                            <span class="ft-cal-widget__title">May 2026</span>
                            <div class="ft-cal-nav">
                                <button aria-label="Previous">‹</button>
                                <button aria-label="Next">›</button>
                            </div>
                        </div>
                        <div class="ft-cal-grid">
                            <div class="ft-cal-label">M</div><div class="ft-cal-label">T</div><div class="ft-cal-label">W</div>
                            <div class="ft-cal-label">T</div><div class="ft-cal-label">F</div><div class="ft-cal-label">S</div><div class="ft-cal-label">S</div>
                            <div class="ft-cal-cell"></div><div class="ft-cal-cell"></div><div class="ft-cal-cell ft-cal-cell--booked">1</div>
                            <div class="ft-cal-cell">2</div><div class="ft-cal-cell ft-cal-cell--booked">3</div><div class="ft-cal-cell">4</div><div class="ft-cal-cell">5</div>
                            <div class="ft-cal-cell ft-cal-cell--booked">6</div><div class="ft-cal-cell">7</div><div class="ft-cal-cell ft-cal-cell--today">8</div>
                            <div class="ft-cal-cell ft-cal-cell--booked">9</div><div class="ft-cal-cell ft-cal-cell--booked">10</div><div class="ft-cal-cell">11</div><div class="ft-cal-cell">12</div>
                        </div>
                        <div class="ft-cal-sessions">
                            <div class="ft-cal-session-item ft-cal-session-item--live">
                                <span class="ft-live-dot"></span> Live now — Ananya S. · Calculus
                            </div>
                            <div class="ft-cal-session-item">
                                3:00 PM — James O. · Python
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Feature 2: Analytics --}}
            <div class="ft-platform-row ft-platform-row--reverse ft-reveal" id="ft-pf-2">
                <div class="ft-platform-row__text">
                    <div class="ft-platform-tag">Analytics & Growth</div>
                    <h3 class="ft-platform-row__title">Data-driven insights to grow faster</h3>
                    <p class="ft-platform-row__desc">See exactly how your teaching business performs. Earnings trends, student retention, rating breakdowns, and subject performance — all in real time.</p>
                    <ul class="ft-feature-list">
                        <li>Monthly earnings reports</li>
                        <li>Student retention metrics</li>
                        <li>Rating & review analytics</li>
                        <li>Top subjects by demand</li>
                    </ul>
                </div>
                <div class="ft-platform-row__visual">
                    <div class="ft-analytics-widget">
                        <div class="ft-analytics-widget__header">
                            <span class="ft-cal-dot ft-cal-dot--green"></span>
                            <span class="ft-cal-widget__title">Earnings Overview</span>
                        </div>
                        <div class="ft-analytics-chart">
                            <svg viewBox="0 0 260 120" xmlns="http://www.w3.org/2000/svg">
                                <defs>
                                    <linearGradient id="aGrad" x1="0" y1="0" x2="0" y2="1">
                                        <stop offset="0%" stop-color="#a3e635" stop-opacity="0.3"/>
                                        <stop offset="100%" stop-color="#a3e635" stop-opacity="0"/>
                                    </linearGradient>
                                </defs>
                                <path d="M0,100 L40,80 L80,70 L120,55 L160,35 L200,20 L260,10 L260,120 L0,120 Z" fill="url(#aGrad)"/>
                                <path class="ft-analytics-line" d="M0,100 L40,80 L80,70 L120,55 L160,35 L200,20 L260,10" fill="none" stroke="#84cc16" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="ft-analytics-stats">
                            <div class="ft-a-stat"><div class="ft-a-stat__val">₹2,70,000</div><div class="ft-a-stat__lbl">This month</div></div>
                            <div class="ft-a-stat"><div class="ft-a-stat__val">48</div><div class="ft-a-stat__lbl">Sessions</div></div>
                            <div class="ft-a-stat"><div class="ft-a-stat__val">4.97</div><div class="ft-a-stat__lbl">Avg rating</div></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Feature 3: Classroom & Payments --}}
            <div class="ft-platform-row ft-reveal" id="ft-pf-3">
                <div class="ft-platform-row__text">
                    <div class="ft-platform-tag">Classroom & Payments</div>
                    <h3 class="ft-platform-row__title">Teach live. Get paid instantly.</h3>
                    <p class="ft-platform-row__desc">Our built-in classroom includes HD video, collaborative whiteboard, code editor, and file sharing. Payments are processed weekly via Stripe with no hidden fees.</p>
                    <ul class="ft-feature-list">
                        <li>HD video + screen share</li>
                        <li>Interactive collaborative whiteboard</li>
                        <li>Session recordings for students</li>
                        <li>Weekly Stripe payouts</li>
                    </ul>
                </div>
                <div class="ft-platform-row__visual">
                    <div class="ft-classroom-widget">
                        <div class="ft-classroom-widget__header">
                            <div class="ft-classroom-dots">
                                <span class="ft-dot-red"></span>
                                <span class="ft-dot-yellow"></span>
                                <span class="ft-dot-green"></span>
                            </div>
                            <span class="ft-classroom-title">Live Session</span>
                            <span class="ft-classroom-live">● REC</span>
                        </div>
                        <div class="ft-classroom-screen">
                            <div class="ft-classroom-video">
                                <svg viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="30" cy="30" r="30" fill="#1f2937"/>
                                    <circle cx="30" cy="22" r="9" fill="#374151"/>
                                    <ellipse cx="30" cy="50" rx="14" ry="10" fill="#374151"/>
                                </svg>
                                <div class="ft-classroom-video__name">Sarah K.</div>
                            </div>
                            <div class="ft-classroom-board">
                                <div class="ft-board-line"></div>
                                <div class="ft-board-line ft-board-line--short"></div>
                                <div class="ft-board-eq">f(x) = <span style="color:#a3e635">x²</span> + 2x + 1</div>
                            </div>
                        </div>
                        <div class="ft-classroom-tools">
                            <div class="ft-tool-btn">✏️</div>
                            <div class="ft-tool-btn">📐</div>
                            <div class="ft-tool-btn">💬</div>
                            <div class="ft-tool-btn ft-tool-btn--end">✕ End</div>
                        </div>
                        <div class="ft-payout-bar">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#65a30d"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"/></svg>
                            <span>Next payout: <strong>₹40,000</strong> · Wednesday</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ═══════════════════════════════ TESTIMONIALS ══════════════════════ --}}
<section class="ft-testimonials" id="ft-testimonials">
    <div class="ft-section-container">
        <div class="ft-section-eyebrow">Tutor Stories</div>
        <h2 class="ft-section-heading">Voices from tutors<br>who <span class="ft-heading-lime">changed their lives</span></h2>

        <div class="ft-testi-editorial">

            {{-- Featured large testimonial --}}
            <div class="ft-testi-featured ft-reveal" id="ft-testi-featured">
                <div class="ft-testi-featured__quote">
                    <svg class="ft-quote-mark" viewBox="0 0 60 44" xmlns="http://www.w3.org/2000/svg" fill="#a3e635" opacity="0.25">
                        <path d="M0 44V27.2C0 19.2 2.4 12.5333 7.2 7.2C12.1067 1.86667 19.2 .533333 28.48 0L30.4 5.12C24.5333 6.08 20 8.10667 16.8 11.2C13.7067 14.2933 12.16 18.3467 12.16 23.36H22.4V44H0ZM33.6 44V27.2C33.6 19.2 36 12.5333 40.8 7.2C45.7067 1.86667 52.8 .533333 62.08 0L64 5.12C58.1333 6.08 53.6 8.10667 50.4 11.2C47.3067 14.2933 45.76 18.3467 45.76 23.36H56V44H33.6Z"/>
                    </svg>
                    <p>"I was a full-time teacher earning ₹3.2L/year. Within 8 months on Tutzy, I matched that income working 20 hours a week — teaching only the subjects I love. I've never looked back."</p>
                </div>
                <div class="ft-testi-featured__author">
                    <div class="ft-testi-featured__avatar">P</div>
                    <div>
                        <div class="ft-testi-featured__name">Priya Nair</div>
                        <div class="ft-testi-featured__role">Mathematics Tutor · Mumbai, India</div>
                        <div class="ft-testi-featured__meta">
                            <span>⭐ 4.98 rating</span>
                            <span>·</span>
                            <span>1,240 sessions</span>
                            <span>·</span>
                            <span>₹5,60,000/mo</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Secondary testimonials --}}
            <div class="ft-testi-grid">

                <div class="ft-testi-card ft-reveal" id="ft-testi-2">
                    <div class="ft-testi-card__stars">★★★★★</div>
                    <p class="ft-testi-card__quote">"The calendar tool is exceptional. Students book me while I'm asleep and I wake up to a full day's schedule. Tutzy runs my business for me."</p>
                    <div class="ft-testi-card__author">
                        <div class="ft-testi-avatar" style="background:#bef264;color:#1a2e05;">D</div>
                        <div>
                            <div class="ft-testi-name">David Osei</div>
                            <div class="ft-testi-role">Physics & Chemistry · Ghana</div>
                        </div>
                    </div>
                </div>

                <div class="ft-testi-card ft-reveal" id="ft-testi-3">
                    <div class="ft-testi-card__stars">★★★★★</div>
                    <p class="ft-testi-card__quote">"The analytics dashboard showed me which of my subjects had the most demand. I pivoted to coding and doubled my earnings in 3 months."</p>
                    <div class="ft-testi-card__author">
                        <div class="ft-testi-avatar" style="background:#d9f99d;color:#365314;">L</div>
                        <div>
                            <div class="ft-testi-name">Lena Kovač</div>
                            <div class="ft-testi-role">Web Dev & React · Croatia</div>
                        </div>
                    </div>
                </div>

                <div class="ft-testi-card ft-reveal" id="ft-testi-4">
                    <div class="ft-testi-card__stars">★★★★★</div>
                    <p class="ft-testi-card__quote">"I love that I can teach from anywhere. Last month I tutored from a coffee shop in Lisbon, my flat in London, and a beach in Bali. Freedom is real."</p>
                    <div class="ft-testi-card__author">
                        <div class="ft-testi-avatar" style="background:#a3e635;color:#1a1a1a;">R</div>
                        <div>
                            <div class="ft-testi-name">Ravi Menon</div>
                            <div class="ft-testi-role">English & IELTS · India</div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Trust metrics bar --}}
            <div class="ft-trust-metrics ft-reveal" id="ft-trust-metrics">
                <div class="ft-trust-metric">
                    <div class="ft-trust-metric__val">4.9/5</div>
                    <div class="ft-trust-metric__lbl">Tutor satisfaction score</div>
                </div>
                <div class="ft-trust-metric__sep"></div>
                <div class="ft-trust-metric">
                    <div class="ft-trust-metric__val">92%</div>
                    <div class="ft-trust-metric__lbl">Return within 6 months</div>
                </div>
                <div class="ft-trust-metric__sep"></div>
                <div class="ft-trust-metric">
                    <div class="ft-trust-metric__val">₹2,30,000</div>
                    <div class="ft-trust-metric__lbl">Average monthly earnings</div>
                </div>
                <div class="ft-trust-metric__sep"></div>
                <div class="ft-trust-metric">
                    <div class="ft-trust-metric__val">24hr</div>
                    <div class="ft-trust-metric__lbl">Average approval time</div>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ═══════════════════════════════ FAQ ════════════════════════════════ --}}
<section class="ft-faq" id="ft-faq">
    <div class="ft-section-container ft-section-container--narrow">
        <div class="ft-section-eyebrow">FAQ</div>
        <h2 class="ft-section-heading">Questions tutors ask<br><span class="ft-heading-lime">before joining</span></h2>

        <div class="ft-faq-list" id="ft-faq-list">

            <div class="ft-faq-item" id="ft-faq-1">
                <button class="ft-faq-trigger" aria-expanded="false" aria-controls="ft-faq-body-1">
                    <span>How much can I earn as a tutor on Tutzy?</span>
                    <svg class="ft-faq-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                </button>
                <div class="ft-faq-body" id="ft-faq-body-1" role="region">
                    <p>Earnings vary based on your subject, rate, and teaching hours. New tutors typically start earning ₹40,000–₹1,20,000/month. Experienced tutors with strong ratings commonly earn ₹2,50,000–₹6,50,000/month. You set your own hourly rate — we never cap it.</p>
                </div>
            </div>

            <div class="ft-faq-item" id="ft-faq-2">
                <button class="ft-faq-trigger" aria-expanded="false" aria-controls="ft-faq-body-2">
                    <span>What percentage does Tutzy take from my earnings?</span>
                    <svg class="ft-faq-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                </button>
                <div class="ft-faq-body" id="ft-faq-body-2" role="region">
                    <p>Tutzy charges a 15% platform fee — which means you keep 85% of every session. This is among the lowest commission rates in the online tutoring industry. There are no monthly fees, no setup costs, and no hidden charges.</p>
                </div>
            </div>

            <div class="ft-faq-item" id="ft-faq-3">
                <button class="ft-faq-trigger" aria-expanded="false" aria-controls="ft-faq-body-3">
                    <span>How long does it take to get approved?</span>
                    <svg class="ft-faq-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                </button>
                <div class="ft-faq-body" id="ft-faq-body-3" role="region">
                    <p>Most tutors are approved within 24 hours. Our team reviews your profile, credentials, and demo session (if applicable). You'll receive an email notification once your application is reviewed. You can start teaching as soon as you're approved.</p>
                </div>
            </div>

            <div class="ft-faq-item" id="ft-faq-4">
                <button class="ft-faq-trigger" aria-expanded="false" aria-controls="ft-faq-body-4">
                    <span>Do I need any qualifications to become a tutor?</span>
                    <svg class="ft-faq-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                </button>
                <div class="ft-faq-body" id="ft-faq-body-4" role="region">
                    <p>Formal qualifications are not always required. We look for subject expertise, clear communication skills, and a passion for teaching. For subjects like medicine or law, relevant credentials are required. For most other subjects, demonstrated knowledge and a trial lesson are sufficient.</p>
                </div>
            </div>

            <div class="ft-faq-item" id="ft-faq-5">
                <button class="ft-faq-trigger" aria-expanded="false" aria-controls="ft-faq-body-5">
                    <span>When and how do I get paid?</span>
                    <svg class="ft-faq-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                </button>
                <div class="ft-faq-body" id="ft-faq-body-5" role="region">
                    <p>Payments are processed weekly every Wednesday via Stripe. Funds typically arrive within 1–3 business days depending on your bank. We support payouts to 40+ countries. You can also view your pending earnings in real time on your dashboard.</p>
                </div>
            </div>

            <div class="ft-faq-item" id="ft-faq-6">
                <button class="ft-faq-trigger" aria-expanded="false" aria-controls="ft-faq-body-6">
                    <span>What happens if a student cancels at the last minute?</span>
                    <svg class="ft-faq-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                </button>
                <div class="ft-faq-body" id="ft-faq-body-6" role="region">
                    <p>Tutzy's Tutor Protection Policy ensures you're compensated for cancellations made within 24 hours of a session start time. You receive a 50% session fee for late cancellations and a 100% fee if a student is a no-show. Your time is valuable and we protect it.</p>
                </div>
            </div>

        </div>
    </div>
</section>


{{-- ═══════════════════════════════ FINAL CTA ═════════════════════════ --}}
<section class="ft-final-cta" id="ft-final-cta">

    {{-- Animated wave lines --}}
    <div class="ft-final-cta__waves" aria-hidden="true">
        <svg class="ft-wave-svg" viewBox="0 0 1440 200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path class="ft-wave-path ft-wave-path--1" d="M0,100 C240,40 480,160 720,100 S1200,40 1440,100 L1440,0 L0,0 Z" fill="#a3e635" fill-opacity="0.08"/>
            <path class="ft-wave-path ft-wave-path--2" d="M0,120 C360,60 600,180 900,120 S1260,60 1440,120 L1440,0 L0,0 Z" fill="#84cc16" fill-opacity="0.05"/>
        </svg>
        <svg class="ft-wave-bottom" viewBox="0 0 1440 200" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path class="ft-wave-path ft-wave-path--3" d="M0,80 C360,160 720,0 1080,80 S1380,160 1440,80 L1440,200 L0,200 Z" fill="#a3e635" fill-opacity="0.06"/>
        </svg>
    </div>

    {{-- Mesh gradient --}}
    <div class="ft-final-cta__mesh" aria-hidden="true"></div>

    <div class="ft-final-cta__content">
        <div class="ft-final-cta__eyebrow">Join Tutzy Today</div>
        <h2 class="ft-final-cta__heading">
            Your teaching career<br>
            starts <span class="ft-heading-lime-dark">right now</span>
        </h2>
        <p class="ft-final-cta__sub">
            Free to join. No contracts. No upfront costs. Just you, your knowledge, and thousands of eager students waiting to learn from you.
        </p>
        <div class="ft-final-cta__actions">
            <a href="/get-started" class="ft-btn ft-btn--primary ft-btn--large ft-btn--glow" id="ft-final-cta-btn">
                <span>Apply to Become a Tutor</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
            </a>
            <a href="/find-tutors" class="ft-btn ft-btn--outline-dark" id="ft-final-explore">Browse Tutors First</a>
        </div>
        <div class="ft-final-cta__trust">
            <span>✓ Free to join</span>
            <span>✓ No contracts</span>
            <span>✓ Weekly payouts</span>
            <span>✓ Cancel anytime</span>
        </div>
    </div>
</section>

@endsection

@push('scripts')
    <script src="{{ asset('js/for-tutors.js') }}"></script>
@endpush
