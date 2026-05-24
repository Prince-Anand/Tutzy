{{--
    Tutzy Dashboard Topbar Component
    Usage: <x-dashboard.topbar :title="$pageTitle" />
--}}
@php
    $user    = Auth::user();
    $role    = $user->role;
    $avatarUrl = $user->avatar_url;

    $hues = ['bg-lime-100 text-lime-700', 'bg-blue-100 text-blue-700', 'bg-amber-100 text-amber-700', 'bg-purple-100 text-purple-700', 'bg-rose-100 text-rose-700'];
    $colorHash = $hues[$user->id % count($hues)];
@endphp

<header class="dash-topbar" id="dashboard-topbar" x-data="{ notifOpen: false, mobileNavOpen: false }">

    {{-- ── Mobile Hamburger ───────────────────────────────── --}}
    <button class="dash-topbar__hamburger lg:hidden"
            @click="mobileNavOpen = true"
            aria-label="Open menu">
        @include('components.dashboard.icon', ['name' => 'menu', 'size' => 22])
    </button>

    {{-- ── Page Title ─────────────────────────────────────── --}}
    <div class="dash-topbar__title-wrap">
        <h1 class="dash-topbar__title">{{ $title ?? 'Dashboard' }}</h1>
    </div>

    {{-- ── Right Actions ──────────────────────────────────── --}}
    <div class="dash-topbar__actions">
        {{-- Notifications bell --}}
        <div class="relative" x-data="{ open: false }">
            <button class="dash-topbar__icon-btn"
                    @click="open = !open"
                    @click.outside="open = false"
                    aria-label="Notifications">
                @include('components.dashboard.icon', ['name' => 'bell', 'size' => 20])
                <span class="dash-topbar__notif-dot"></span>
            </button>

            {{-- Notification Dropdown --}}
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-1"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-end="opacity-0 translate-y-1"
                 x-cloak
                 class="dash-notif-dropdown">
                <div class="dash-notif-dropdown__header">
                    <span class="font-semibold text-gray-900 text-sm">Notifications</span>
                    <span class="text-xs text-lime-600 font-medium">2 new</span>
                </div>
                <div class="dash-notif-dropdown__list">
                    <div class="dash-notif-item">
                        <div class="dash-notif-item__dot dash-notif-item__dot--lime"></div>
                        <div>
                            <p class="dash-notif-item__text">Your lesson with <strong>Sarah K.</strong> starts in 1 hour.</p>
                            <span class="dash-notif-item__time">Just now</span>
                        </div>
                    </div>
                    <div class="dash-notif-item">
                        <div class="dash-notif-item__dot dash-notif-item__dot--blue"></div>
                        <div>
                            <p class="dash-notif-item__text">Lesson recap available from yesterday's session.</p>
                            <span class="dash-notif-item__time">Yesterday</span>
                        </div>
                    </div>
                    <div class="dash-notif-item dash-notif-item--read">
                        <div class="dash-notif-item__dot"></div>
                        <div>
                            <p class="dash-notif-item__text">Welcome to Tutzy! Complete your profile.</p>
                            <span class="dash-notif-item__time">2 days ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Avatar --}}
        <a href="{{ route($role === 'tutor' ? 'tutor.settings' : 'student.settings') }}" class="dash-topbar__avatar-link">
            @if($avatarUrl)
                <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="dash-topbar__avatar-img">
            @else
                <div class="dash-topbar__avatar-initials {{ $colorHash }}">{{ $user->initials }}</div>
            @endif
        </a>
    </div>

    {{-- ── Mobile Sidebar Overlay ──────────────────────────── --}}
    <div x-show="mobileNavOpen"
         x-transition:enter="transition-opacity ease-linear duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-200"
         x-transition:leave-end="opacity-0"
         x-cloak
         class="fixed inset-0 bg-black/40 backdrop-blur-sm z-40 lg:hidden"
         @click="mobileNavOpen = false">
    </div>

    {{-- ── Mobile Sidebar Drawer ───────────────────────────── --}}
    <div x-show="mobileNavOpen"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         x-cloak
         class="fixed inset-y-0 left-0 z-50 lg:hidden"
         style="width: min(85vw, 280px)">
        <div class="h-full bg-white shadow-2xl flex flex-col overflow-y-auto">
            {{-- Close button --}}
            <div class="flex items-center justify-between px-5 pt-5 pb-4 border-b border-gray-100">
                <img src="/images/logo.png" alt="Tutzy" class="h-8">
                <button @click="mobileNavOpen = false" class="p-2 text-gray-500 hover:text-gray-900 rounded-lg">
                    @include('components.dashboard.icon', ['name' => 'x', 'size' => 20])
                </button>
            </div>

            {{-- Mobile user identity --}}
            <div class="px-5 py-4 flex items-center gap-3 border-b border-gray-100">
                @if($avatarUrl)
                    <img src="{{ $avatarUrl }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-xl object-cover">
                @else
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm {{ $colorHash }}">{{ $user->initials }}</div>
                @endif
                <div>
                    <p class="text-sm font-bold text-gray-900">{{ Str::limit($user->name, 20) }}</p>
                    <span class="text-xs font-semibold text-lime-600 bg-lime-50 px-2 py-0.5 rounded-full">{{ ucfirst($role) }}</span>
                </div>
            </div>

            @php
                if ($role === 'tutor') {
                    $mobileNav = [
                        ['route' => 'tutor.dashboard', 'label' => 'Dashboard', 'icon' => 'layout-dashboard'],
                        ['route' => 'tutor.schedule',  'label' => 'Schedule',  'icon' => 'calendar'],
                        ['route' => 'tutor.lessons',   'label' => 'Lessons',   'icon' => 'video'],
                        ['route' => 'tutor.earnings',  'label' => 'Earnings',  'icon' => 'trending-up'],
                        ['route' => 'tutor.reviews',   'label' => 'Reviews',   'icon' => 'star'],
                        ['route' => 'tutor.settings',  'label' => 'Settings',  'icon' => 'settings'],
                    ];
                } else {
                    $mobileNav = [
                        ['route' => 'student.dashboard',    'label' => 'Dashboard',    'icon' => 'layout-dashboard'],
                        ['route' => 'student.lessons',      'label' => 'My Lessons',   'icon' => 'video'],
                        ['route' => 'student.saved-tutors', 'label' => 'Saved Tutors', 'icon' => 'heart'],
                        ['route' => 'student.settings',     'label' => 'Settings',     'icon' => 'settings'],
                    ];
                }
            @endphp
            <nav class="flex-1 px-4 py-4">
                <ul class="flex flex-col gap-1">
                    @foreach($mobileNav as $item)
                        @php $active = request()->routeIs($item['route']); @endphp
                        <li>
                            <a href="{{ route($item['route']) }}"
                               class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold transition-all {{ $active ? 'bg-lime-50 text-lime-700' : 'text-gray-600 hover:bg-gray-50' }}"
                               @click="mobileNavOpen = false">
                                @include('components.dashboard.icon', ['name' => $item['icon'], 'size' => 18])
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @endforeach
                    <li>
                        <span class="flex items-center gap-3 px-3 py-3 rounded-xl text-sm font-semibold text-gray-400 cursor-not-allowed">
                            @include('components.dashboard.icon', ['name' => 'message-square', 'size' => 18])
                            Messages
                            <span class="ml-auto text-[10px] font-bold bg-amber-100 text-amber-700 px-2 py-0.5 rounded-full">Soon</span>
                        </span>
                    </li>
                </ul>
            </nav>

            {{-- Mobile logout --}}
            <div class="px-4 pb-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-3 py-3 rounded-xl text-sm font-semibold text-red-600 hover:bg-red-50 transition-colors">
                        @include('components.dashboard.icon', ['name' => 'log-out', 'size' => 18])
                        Log out
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
