<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tutzy Student Dashboard — Manage your lessons, tutors, and learning progress.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard') — Tutzy</title>
    <link rel="icon" type="image/png" href="/1.png" sizes="32x32">

    {{-- Fonts --}}
    <link rel="stylesheet" href="/fonts/satoshi/css/satoshi.css">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="dash-body">

    {{-- ════════════════════════════════════════════ --}}
    {{-- SIDEBAR (Desktop — hidden on mobile) --}}
    {{-- ════════════════════════════════════════════ --}}
    @if(auth()->check() && auth()->user()->role === 'tutor')
        <x-dashboard.tutor-sidebar />
    @else
        <x-dashboard.sidebar />
    @endif

    {{-- ════════════════════════════════════════════ --}}
    {{-- MAIN PANEL --}}
    {{-- ════════════════════════════════════════════ --}}
    <div class="dash-panel">

        {{-- TOPBAR --}}
        <x-dashboard.topbar :title="$pageTitle ?? 'Dashboard'" />

        {{-- ── FLASH MESSAGES ─────────────────────────────── --}}
        @if(session('success'))
            <div class="dash-flash dash-flash--success" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-end="opacity-0 -translate-y-2">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
                <button @click="show = false" class="ml-auto opacity-60 hover:opacity-100">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
        @endif

        @if(session('error') || $errors->any())
            <div class="dash-flash dash-flash--error" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-end="opacity-0 -translate-y-2">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" x2="12" y1="8" y2="12"/><line x1="12" x2="12.01" y1="16" y2="16"/></svg>
                @if(session('error'))
                    {{ session('error') }}
                @else
                    {{ $errors->first() }}
                @endif
                <button @click="show = false" class="ml-auto opacity-60 hover:opacity-100">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
            </div>
        @endif

        {{-- ── CONTENT ─────────────────────────────────────── --}}
        <main class="dash-content" id="main-content">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
