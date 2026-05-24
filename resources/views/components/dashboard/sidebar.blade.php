{{--
    Tutzy Dashboard Sidebar Component
    Usage: <x-dashboard.sidebar />
--}}
@php
    $user    = Auth::user();
    $profile = $user->studentProfile;
    $avatarUrl = $profile && $profile->avatar ? asset('storage/avatars/' . $profile->avatar) : null;

    $hues = ['bg-lime-100 text-lime-700', 'bg-blue-100 text-blue-700', 'bg-amber-100 text-amber-700', 'bg-purple-100 text-purple-700', 'bg-rose-100 text-rose-700'];
    $colorHash = $hues[$user->id % count($hues)];

    $navItems = [
        ['route' => 'student.dashboard',    'label' => 'Dashboard',     'icon' => 'layout-dashboard'],
        ['route' => 'student.lessons',      'label' => 'My Lessons',    'icon' => 'video'],
        ['route' => 'student.saved-tutors', 'label' => 'Saved Tutors',  'icon' => 'heart'],
        ['route' => 'student.settings',     'label' => 'Settings',      'icon' => 'settings'],
    ];
@endphp

<aside class="dash-sidebar" id="dashboard-sidebar">
    {{-- ── Brand ──────────────────────────────────────────── --}}
    <div class="dash-sidebar__brand">
        <a href="/" class="flex items-center gap-2">
            <img src="/images/logo.png" alt="Tutzy" class="h-9 w-auto object-contain">
        </a>
    </div>

    {{-- ── User Identity ──────────────────────────────────── --}}
    <div class="dash-sidebar__identity">
        @if($avatarUrl)
            <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="dash-sidebar__avatar-img">
        @else
            <div class="dash-sidebar__avatar-initials {{ $colorHash }}">
                {{ $user->initials }}
            </div>
        @endif
        <div class="dash-sidebar__user-info">
            <p class="dash-sidebar__user-name">{{ Str::limit($user->name, 20) }}</p>
            <span class="dash-sidebar__role-badge">Student</span>
        </div>
    </div>

    {{-- ── Navigation ─────────────────────────────────────── --}}
    <nav class="dash-sidebar__nav" aria-label="Student navigation">
        <ul class="dash-sidebar__nav-list">
            @foreach($navItems as $item)
                @php
                    $isActive = request()->routeIs($item['route']);
                @endphp
                <li>
                    <a href="{{ route($item['route']) }}"
                       class="dash-sidebar__nav-link {{ $isActive ? 'dash-sidebar__nav-link--active' : '' }}"
                       aria-current="{{ $isActive ? 'page' : 'false' }}">
                        @include('components.dashboard.icon', ['name' => $item['icon']])
                        <span>{{ $item['label'] }}</span>
                    </a>
                </li>
            @endforeach

            {{-- Messages (disabled — coming soon) --}}
            <li>
                <span class="dash-sidebar__nav-link dash-sidebar__nav-link--disabled" title="Coming soon">
                    @include('components.dashboard.icon', ['name' => 'message-square'])
                    <span>Messages</span>
                    <span class="dash-sidebar__soon-badge">Soon</span>
                </span>
            </li>
        </ul>
    </nav>

    {{-- ── Spacer ──────────────────────────────────────────── --}}
    <div class="flex-1"></div>

    {{-- ── Bottom: Find Tutors CTA ─────────────────────────── --}}
    <div class="dash-sidebar__bottom-cta">
        <a href="{{ route('find-tutors') }}" class="dash-sidebar__find-btn">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/></svg>
            Find a Tutor
        </a>
    </div>

    {{-- ── Logout ──────────────────────────────────────────── --}}
    <div class="dash-sidebar__logout-wrap">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dash-sidebar__logout-btn">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                Log out
            </button>
        </form>
    </div>
</aside>
