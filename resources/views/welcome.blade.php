@extends('layout')

@section('title', 'Tutzy - Find Tutors. Book on Demand.')

@section('content')

{{-- ═══════════════════════════════════════════════════ --}}
{{-- HERO SECTION --}}
{{-- ═══════════════════════════════════════════════════ --}}
<section class="hero" id="hero">
    <div class="hero__container">

        {{-- Left Column – Text Content --}}
        <div class="hero__content">

            {{-- Badge --}}
            <div class="hero__badge">
                <span class="hero__badge-dot"></span>
                LEARN BETTER, ANYTIME
            </div>

            {{-- Heading (Satoshi font) --}}
            <h1 class="hero__heading">
                Find Tutors.<br>
                Book on Demand.<br>
                <span class="hero__heading-accent">Learn with Confidence.</span>
            </h1>

            {{-- Description --}}
            <p class="hero__desc">
                Connect with verified tutors anytime, schedule live sessions, and track your progress with feedback.
            </p>

            {{-- Buttons --}}
            <div class="hero__buttons">
                <a href="/find-tutors" class="hero__btn-primary" id="hero-cta-find">
                    Find a Tutor Now
                    {{-- Arrow right SVG --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="/how-it-works" class="hero__btn-secondary" id="hero-cta-works">
                    How It Works
                    {{-- Play SVG --}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5.14v14l11-7-11-7z"/>
                    </svg>
                </a>
            </div>

            {{-- Hero Features --}}
            <div class="hero__features">
                {{-- On-Demand Tutoring --}}
                <div class="hero__feature">
                    <div class="hero__feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 13.5 10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z" />
                        </svg>
                    </div>
                    <span>On-Demand<br>Tutoring</span>
                </div>

                {{-- Verified Tutors --}}
                <div class="hero__feature">
                    <div class="hero__feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" />
                        </svg>
                    </div>
                    <span>Verified<br>Tutors</span>
                </div>

                {{-- Real-time Feedback --}}
                <div class="hero__feature">
                    <div class="hero__feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                        </svg>
                    </div>
                    <span>Real-time<br>Feedback</span>
                </div>

                {{-- Track Learning Outcomes --}}
                <div class="hero__feature">
                    <div class="hero__feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                        </svg>
                    </div>
                    <span>Track Learning<br>Outcomes</span>
                </div>
            </div>
        </div>

        {{-- Right Column – Phone Mockup --}}
        <div class="hero__visual">
            <div class="hero__phone-wrapper">

                {{-- Floating Card: Quick Booking --}}
                <div class="hero__float-card hero__float-card--booking">
                    <div class="hero__float-card-icon hero__float-card-icon--green">
                        {{-- Calendar SVG --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" width="20" height="20">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                        </svg>
                    </div>
                    <div class="hero__float-card-title">Quick Booking</div>
                    <div class="hero__float-card-desc">Book a session<br>in seconds</div>
                </div>

                {{-- Floating Card: Session Feedback --}}
                <div class="hero__float-card hero__float-card--feedback" >
                    <div class="hero__float-card-title">Session Feedback</div>
                    <div class="hero__float-stars">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>
                    <div class="hero__float-card-quote">Great explanation!<br>Very helpful.</div>
                    <div class="hero__float-card-author">– Alex</div>
                </div>

                {{-- Floating Card: Learning Progress --}}
                <div class="hero__float-card hero__float-card--progress">
                    <div class="hero__float-card-title">Learning Progress</div>
                    <div class="hero__progress-label">
                        <span class="hero__progress-subject">Calculus</span>
                        <span class="hero__progress-pct">75%</span>
                    </div>
                    <div class="hero__progress-bar-bg">
                        <div class="hero__progress-bar-fill"></div>
                    </div>
                    <div class="hero__float-card-desc" style="margin-top:6px;">Keep it up!</div>
                </div>

                {{-- Phone Image --}}
                <img
                    src="/images/phone-mockup.png"
                    alt="Tutzy App on Mobile"
                    class="hero__phone-img"
                    loading="eager"
                >
            </div>
        </div>
    </div>
</section>




{{-- ═══════════════════════════════════════════════════ --}}
{{-- SECTION 1: TRUST & STATS --}}
{{-- ═══════════════════════════════════════════════════ --}}
<section class="stats-section" id="stats">
    <div class="section-container">
        <div class="section-eyebrow">Trusted Worldwide</div>
        <h2 class="section-heading">Numbers that speak for themselves</h2>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg>
                </div>
                <div class="stat-value">100K+</div>
                <div class="stat-label">Expert Tutors</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z"/></svg>
                </div>
                <div class="stat-value">300K+</div>
                <div class="stat-label">Verified Reviews</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.966 8.966 0 0 0-6 2.292m0-14.25v14.25"/></svg>
                </div>
                <div class="stat-value">120+</div>
                <div class="stat-label">Subjects Covered</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253M3 12c0 .778.099 1.533.284 2.253"/></svg>
                </div>
                <div class="stat-value">180+</div>
                <div class="stat-label">Nationalities</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.006 5.404.434c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.434 2.082-5.005Z" clip-rule="evenodd"/></svg>
                </div>
                <div class="stat-value">4.8</div>
                <div class="stat-label">Average Rating</div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════ --}}
{{-- SECTION 2: POPULAR SUBJECTS --}}
{{-- ═══════════════════════════════════════════════════ --}}
<section class="subjects-section" id="subjects">
    <div class="section-container">
        <div class="section-eyebrow">Explore Categories</div>
        <h2 class="section-heading">Popular Subjects</h2>
        <p class="section-subheading">From languages to STEM — find an expert tutor in any subject, instantly.</p>
        <div class="subjects-grid">
            <a href="/find-tutors?subject=english" class="subject-card" id="subject-english">
                <div class="subject-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.966 8.966 0 0 0-6 2.292m0-14.25v14.25"/></svg>
                </div>
                <div class="subject-name">English</div>
                <div class="subject-count">12,400+ tutors</div>
            </a>
            <a href="/find-tutors?subject=coding" class="subject-card" id="subject-coding">
                <div class="subject-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5"/></svg>
                </div>
                <div class="subject-name">Coding</div>
                <div class="subject-count">8,700+ tutors</div>
            </a>
            <a href="/find-tutors?subject=math" class="subject-card" id="subject-math">
                <div class="subject-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.745 3A23.933 23.933 0 0 0 3 12c0 3.183.62 6.22 1.745 9M19.255 3A23.933 23.933 0 0 1 21 12c0 3.183-.62 6.22-1.745 9M8.25 8.885l1.444-.89a.75.75 0 0 1 1.105.402l2.402 7.206a.75.75 0 0 0 1.104.401l1.445-.889m-8.25.75.213.09a1.687 1.687 0 0 0 2.062-.617l4.45-6.676a1.688 1.688 0 0 1 2.062-.618l.213.09"/></svg>
                </div>
                <div class="subject-name">Mathematics</div>
                <div class="subject-count">15,200+ tutors</div>
            </a>
            <a href="/find-tutors?subject=science" class="subject-card" id="subject-science">
                <div class="subject-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 1-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/></svg>
                </div>
                <div class="subject-name">Science</div>
                <div class="subject-count">9,100+ tutors</div>
            </a>
            <a href="/find-tutors?subject=languages" class="subject-card" id="subject-languages">
                <div class="subject-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m10.5 21 5.25-11.25L21 21m-9-3h7.5M3 5.621a48.474 48.474 0 0 1 6-.371m0 0c1.12 0 2.233.038 3.334.114M9 5.25V3m3.334 2.364C11.176 10.658 7.69 15.08 3 17.502m9.334-12.138c.896.061 1.785.147 2.666.257m-4.589 8.495a18.023 18.023 0 0 1-3.827-5.802"/></svg>
                </div>
                <div class="subject-name">Languages</div>
                <div class="subject-count">11,800+ tutors</div>
            </a>
            <a href="/find-tutors?subject=ai" class="subject-card" id="subject-ai">
                <div class="subject-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z"/></svg>
                </div>
                <div class="subject-name">AI & Programming</div>
                <div class="subject-count">6,300+ tutors</div>
            </a>
        </div>
        <div class="subjects-cta">
            <a href="/find-tutors" class="btn-outline" id="subjects-browse-all">Browse all subjects →</a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════ --}}
{{-- SECTION 3: HOW IT WORKS --}}
{{-- ═══════════════════════════════════════════════════ --}}
<section class="how-section" id="how-it-works">
    <div class="section-container">
        <div class="section-eyebrow">Simple Process</div>
        <h2 class="section-heading">How Tutzy Works</h2>
        <p class="section-subheading">From search to session in under 60 seconds.</p>
        <div class="how-grid">
            <div class="how-card" id="how-step-1">
                <div class="how-step-num">01</div>
                <div class="how-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/></svg>
                </div>
                <h3 class="how-title">Find Your Tutor</h3>
                <p class="how-desc">Browse verified tutors by subject, availability, and rating. Use smart filters to find the perfect match.</p>
                <div class="how-float-card">
                    <div class="how-fc-row">
                        <div class="how-avatar how-avatar--green">S</div>
                        <div>
                            <div class="how-fc-name">Sarah K. — Math</div>
                            <div class="how-fc-meta">⭐ 4.9 · 320 sessions</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="how-card" id="how-step-2">
                <div class="how-step-num">02</div>
                <div class="how-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5"/></svg>
                </div>
                <h3 class="how-title">Book Instantly</h3>
                <p class="how-desc">Pick a time slot that works for you and confirm your session in one tap. No emails, no waiting.</p>
                <div class="how-float-card">
                    <div class="how-fc-time">Today · 3:00 PM</div>
                    <div class="how-fc-badge">✓ Confirmed</div>
                </div>
            </div>
            <div class="how-card" id="how-step-3">
                <div class="how-step-num">03</div>
                <div class="how-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z"/></svg>
                </div>
                <h3 class="how-title">Track Your Progress</h3>
                <p class="how-desc">After every session, get feedback, see your improvement graph, and stay motivated with milestones.</p>
                <div class="how-float-card">
                    <div class="how-fc-bar-label"><span>Calculus</span><span class="how-fc-pct">82%</span></div>
                    <div class="how-fc-bar-bg"><div class="how-fc-bar-fill" style="width:82%"></div></div>
                    <div class="how-fc-bar-label" style="margin-top:6px"><span>Physics</span><span class="how-fc-pct">67%</span></div>
                    <div class="how-fc-bar-bg"><div class="how-fc-bar-fill" style="width:67%"></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════ --}}
{{-- SECTION 4: FEATURES --}}
{{-- ═══════════════════════════════════════════════════ --}}
<section class="features-section" id="features">
    <div class="section-container">
        <div class="section-eyebrow">Platform Features</div>
        <h2 class="section-heading">Everything you need to learn better</h2>

        {{-- Feature Row 1 --}}
        <div class="feature-row">
            <div class="feature-row__text">
                <div class="feature-tag">Real-time Booking</div>
                <h3 class="feature-row__title">Instant session scheduling, zero friction</h3>
                <p class="feature-row__desc">See live tutor availability and book a session in seconds. Smart calendar sync ensures no clashes, ever.</p>
                <ul class="feature-list">
                    <li>Live availability calendar</li>
                    <li>One-tap confirmation</li>
                    <li>Automatic reminders</li>
                </ul>
            </div>
            <div class="feature-row__visual">
                <div class="feature-dashboard">
                    <div class="fd-header">
                        <span class="fd-dot fd-dot--green"></span>
                        <span class="fd-title">My Schedule</span>
                    </div>
                    <div class="fd-slot fd-slot--booked">Mon 10:00 AM — Sarah K. · Math ✓</div>
                    <div class="fd-slot fd-slot--open">Tue 2:00 PM — Available</div>
                    <div class="fd-slot fd-slot--booked">Wed 4:00 PM — James L. · Python ✓</div>
                    <div class="fd-slot fd-slot--open">Thu 11:00 AM — Available</div>
                </div>
            </div>
        </div>

        {{-- Feature Row 2 --}}
        <div class="feature-row feature-row--reverse">
            <div class="feature-row__text">
                <div class="feature-tag">Progress Tracking</div>
                <h3 class="feature-row__title">Visualise your learning journey</h3>
                <p class="feature-row__desc">A personal dashboard shows your growth over time. Track session hours, skill scores, and milestone badges.</p>
                <ul class="feature-list">
                    <li>Weekly progress graphs</li>
                    <li>Milestone badges</li>
                    <li>Skill heatmaps</li>
                </ul>
            </div>
            <div class="feature-row__visual">
                <div class="feature-dashboard">
                    <div class="fd-header">
                        <span class="fd-dot fd-dot--green"></span>
                        <span class="fd-title">Progress Overview</span>
                    </div>
                    <div class="fd-progress-item">
                        <span>Mathematics</span>
                        <div class="fd-bar-bg"><div class="fd-bar-fill" style="width:88%"></div></div>
                        <span class="fd-pct">88%</span>
                    </div>
                    <div class="fd-progress-item">
                        <span>Physics</span>
                        <div class="fd-bar-bg"><div class="fd-bar-fill" style="width:64%"></div></div>
                        <span class="fd-pct">64%</span>
                    </div>
                    <div class="fd-progress-item">
                        <span>English</span>
                        <div class="fd-bar-bg"><div class="fd-bar-fill" style="width:75%"></div></div>
                        <span class="fd-pct">75%</span>
                    </div>
                    <div class="fd-badges">
                        <span class="fd-badge">🏆 10 Sessions</span>
                        <span class="fd-badge">⚡ On a Streak</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Feature Row 3 --}}
        <div class="feature-row">
            <div class="feature-row__text">
                <div class="feature-tag">Smart Recommendations</div>
                <h3 class="feature-row__title">AI-powered tutor matching</h3>
                <p class="feature-row__desc">Tutzy's smart engine analyses your goals, learning style, and past sessions to recommend the perfect tutors.</p>
                <ul class="feature-list">
                    <li>Personalised tutor picks</li>
                    <li>Learning style analysis</li>
                    <li>Goal-based roadmaps</li>
                </ul>
            </div>
            <div class="feature-row__visual">
                <div class="feature-dashboard">
                    <div class="fd-header">
                        <span class="fd-dot fd-dot--green"></span>
                        <span class="fd-title">Recommended for You</span>
                    </div>
                    <div class="fd-tutor-row">
                        <div class="fd-avatar" style="background:#a3e635;color:#1a1a1a;">A</div>
                        <div class="fd-tutor-info">
                            <div class="fd-tutor-name">Ananya S.</div>
                            <div class="fd-tutor-sub">Calculus · ⭐ 4.9</div>
                        </div>
                        <div class="fd-match">98% match</div>
                    </div>
                    <div class="fd-tutor-row">
                        <div class="fd-avatar" style="background:#bef264;color:#1a1a1a;">R</div>
                        <div class="fd-tutor-info">
                            <div class="fd-tutor-name">Ravi M.</div>
                            <div class="fd-tutor-sub">Python · ⭐ 4.8</div>
                        </div>
                        <div class="fd-match">94% match</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════ --}}
{{-- SECTION 5: MOBILE APP --}}
{{-- ═══════════════════════════════════════════════════ --}}
<section class="mobile-section" id="mobile-app">
    <div class="section-container">
        <div class="mobile-inner">
            <div class="mobile-text">
                <div class="section-eyebrow">Mobile First</div>
                <h2 class="section-heading" style="text-align:left;">Learn anywhere,<br>on any device.</h2>
                <p class="section-subheading" style="text-align:left;margin:0 0 32px;">Tutzy is built mobile-first. Get push notifications, book sessions on the go, and track your progress right from your pocket.</p>
                <div class="mobile-features">
                    <div class="mobile-feature-item">
                        <div class="mobile-feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/></svg>
                        </div>
                        <span>Push notifications for sessions</span>
                    </div>
                    <div class="mobile-feature-item">
                        <div class="mobile-feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 8.25h3m-3 3.75h3m-3 3.75h3"/></svg>
                        </div>
                        <span>PWA — install like a native app</span>
                    </div>
                    <div class="mobile-feature-item">
                        <div class="mobile-feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155"/></svg>
                        </div>
                        <span>In-app tutor messaging</span>
                    </div>
                    <div class="mobile-feature-item">
                        <div class="mobile-feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75Z"/></svg>
                        </div>
                        <span>Offline-ready learning content</span>
                    </div>
                </div>
            </div>
            <div class="mobile-visual">
                <div class="mobile-phone-wrap">
                    <img src="/images/phone-mockup.png" alt="Tutzy mobile app" class="mobile-phone-img">
                    <div class="mobile-notif mobile-notif--1">
                        <span class="mobile-notif-icon">🔔</span>
                        <div>
                            <div class="mobile-notif-title">Session in 10 min</div>
                            <div class="mobile-notif-sub">Sarah K. · Calculus</div>
                        </div>
                    </div>
                    <div class="mobile-notif mobile-notif--2">
                        <span class="mobile-notif-icon">⭐</span>
                        <div>
                            <div class="mobile-notif-title">New review!</div>
                            <div class="mobile-notif-sub">"Amazing session today"</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════ --}}
{{-- SECTION 6: TESTIMONIALS --}}
{{-- ═══════════════════════════════════════════════════ --}}
<section class="testimonials-section" id="testimonials">
    <div class="section-container">
        <div class="section-eyebrow">Student Stories</div>
        <h2 class="section-heading">Loved by learners worldwide</h2>
        <p class="section-subheading">Real results from real students across 180+ countries.</p>
        <div class="testimonials-grid">
            <div class="testi-card" id="testi-1">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-quote">"Tutzy completely changed how I study. I found an amazing math tutor in minutes and my grades went from C to A in one month."</p>
                <div class="testi-author">
                    <div class="testi-avatar" style="background:#a3e635;color:#1a1a1a;">M</div>
                    <div>
                        <div class="testi-name">Meera R.</div>
                        <div class="testi-meta">Mathematics · India</div>
                    </div>
                </div>
            </div>
            <div class="testi-card testi-card--featured" id="testi-2">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-quote">"The real-time booking is a game-changer. No back-and-forth emails — I just pick a slot and it's done. My tutor's feedback after each session is incredibly helpful."</p>
                <div class="testi-author">
                    <div class="testi-avatar" style="background:#bef264;color:#1a1a1a;">J</div>
                    <div>
                        <div class="testi-name">James O.</div>
                        <div class="testi-meta">Python · Nigeria</div>
                    </div>
                </div>
            </div>
            <div class="testi-card" id="testi-3">
                <div class="testi-stars">★★★★★</div>
                <p class="testi-quote">"I've tried 3 other platforms but Tutzy is the smoothest by far. Progress tracking keeps me motivated every single day."</p>
                <div class="testi-author">
                    <div class="testi-avatar" style="background:#d9f99d;color:#1a1a1a;">L</div>
                    <div>
                        <div class="testi-name">Lena K.</div>
                        <div class="testi-meta">English · Germany</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════ --}}
{{-- SECTION 7: BECOME A TUTOR --}}
{{-- ═══════════════════════════════════════════════════ --}}
<section class="tutor-cta-section" id="for-tutors">
    <div class="section-container">
        <div class="tutor-cta-inner">
            <div class="tutor-cta-text">
                <div class="section-eyebrow section-eyebrow--light">For Tutors</div>
                <h2 class="tutor-cta-heading">Share your knowledge.<br>Earn on your terms.</h2>
                <p class="tutor-cta-desc">Join 100,000+ tutors already teaching on Tutzy. Set your rate, choose your hours, and teach students from anywhere in the world.</p>
                <div class="tutor-perks">
                    <div class="tutor-perk">
                        <span class="tutor-perk-icon">💰</span>
                        <div>
                            <div class="tutor-perk-title">Earn Online</div>
                            <div class="tutor-perk-desc">Set your own hourly rate</div>
                        </div>
                    </div>
                    <div class="tutor-perk">
                        <span class="tutor-perk-icon">🌍</span>
                        <div>
                            <div class="tutor-perk-title">Teach Globally</div>
                            <div class="tutor-perk-desc">Reach students in 180+ countries</div>
                        </div>
                    </div>
                    <div class="tutor-perk">
                        <span class="tutor-perk-icon">🕐</span>
                        <div>
                            <div class="tutor-perk-title">Flexible Schedule</div>
                            <div class="tutor-perk-desc">Teach whenever it suits you</div>
                        </div>
                    </div>
                    <div class="tutor-perk">
                        <span class="tutor-perk-icon">🔒</span>
                        <div>
                            <div class="tutor-perk-title">Secure Payouts</div>
                            <div class="tutor-perk-desc">Fast, reliable payments</div>
                        </div>
                    </div>
                </div>
                <a href="/for-tutors" class="hero__btn-primary" id="become-tutor-cta" style="margin-top:32px;display:inline-flex;">
                    Become a Tutor
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                </a>
            </div>
            <div class="tutor-cta-card">
                <div class="tc-card-header">Your Earnings</div>
                <div class="tc-earn-value">₹2,06,000</div>
                <div class="tc-earn-label">This month</div>
                <div class="tc-divider"></div>
                <div class="tc-stats-row">
                    <div class="tc-stat"><div class="tc-stat-val">48</div><div class="tc-stat-lbl">Sessions</div></div>
                    <div class="tc-stat"><div class="tc-stat-val">4.9</div><div class="tc-stat-lbl">Rating</div></div>
                    <div class="tc-stat"><div class="tc-stat-val">23</div><div class="tc-stat-lbl">Students</div></div>
                </div>
                <div class="tc-badge">🏆 Top Tutor this week</div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════ --}}
{{-- SECTION 8: FINAL CTA --}}
{{-- ═══════════════════════════════════════════════════ --}}
<section class="final-cta-section" id="final-cta">
    <div class="section-container">
        <div class="final-cta-inner">
            <h2 class="final-cta-heading">Start learning with confidence.</h2>
            <p class="final-cta-sub">Join over 300,000 students already growing with Tutzy. No commitments, cancel anytime.</p>
            <div class="final-cta-buttons">
                <a href="/find-tutors" class="hero__btn-primary" id="final-cta-find">
                    Find Tutors
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg>
                </a>
                <a href="/for-tutors" class="hero__btn-secondary" id="final-cta-tutor">
                    Become a Tutor
                </a>
            </div>
            <div class="final-cta-trust">
                <span>✓ Free to join</span>
                <span>✓ Verified tutors</span>
                <span>✓ Cancel anytime</span>
            </div>
        </div>
    </div>
</section>

@endsection