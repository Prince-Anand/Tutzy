{{--
    Tutzy Tutor Sidebar Component
    Desktop only (hidden on mobile, drawer handles mobile nav)
--}}
@php
    $user = Auth::user();
    $tutor = $user->tutorProfile;
    $avatarUrl = str_starts_with($tutor->image, 'http') ? $tutor->image : '/storage/' . $tutor->image;
    
    $nav = [
        ['route' => 'tutor.dashboard', 'label' => 'Dashboard', 'icon' => 'layout-dashboard'],
        ['route' => 'tutor.schedule',  'label' => 'Schedule',  'icon' => 'calendar'],
        ['route' => 'tutor.lessons',   'label' => 'Lessons',   'icon' => 'video'],
        ['route' => 'tutor.earnings',  'label' => 'Earnings',  'icon' => 'trending-up'],
        ['route' => 'tutor.reviews',   'label' => 'Reviews',   'icon' => 'star'],
        ['route' => 'tutor.settings',  'label' => 'Settings',  'icon' => 'settings'],
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
        @if($tutor && $tutor->image)
            <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="dash-sidebar__avatar-img">
        @else
            <div class="dash-sidebar__avatar-initials bg-lime-100 text-lime-700">
                {{ $user->initials }}
            </div>
        @endif
        <div class="dash-sidebar__user-info">
            <p class="dash-sidebar__user-name">{{ Str::limit($user->name, 20) }}</p>
            <span class="dash-sidebar__role-badge">Tutor</span>
        </div>
    </div>

    {{-- ── Navigation ─────────────────────────────────────── --}}
    <nav class="dash-sidebar__nav" aria-label="Tutor navigation">
        <ul class="dash-sidebar__nav-list">
            @foreach($nav as $item)
                @php $isActive = request()->routeIs($item['route']); @endphp
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
