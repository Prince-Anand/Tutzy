<nav id="main-navbar" class="navbar" x-data="{ mobileMenuOpen: false, profileOpen: false }">
    <div class="navbar__container">

        {{-- Logo --}}
        <a href="/" class="navbar__logo" id="navbar-logo">
            <img src="/images/logo.png" alt="Tutzy Logo" class="navbar__logo-img">
        </a>

        {{-- Desktop Nav Links --}}
        <ul class="navbar__links hidden lg:flex" id="navbar-links-desktop">
            <li><a href="/" class="navbar__link {{ request()->is('/') ? 'navbar__link--active' : '' }}">Home</a></li>
            <li><a href="{{ route('find-tutors') }}" class="navbar__link {{ request()->is('find-tutors*') ? 'navbar__link--active' : '' }}">Find Tutors</a></li>
            <!-- <li><a href="/how-it-works" class="navbar__link {{ request()->is('how-it-works*') ? 'navbar__link--active' : '' }}">How it Works</a></li> -->
            <li><a href="{{ route('for-tutors') }}" class="navbar__link {{ request()->is('for-tutors*') ? 'navbar__link--active' : '' }}">For Tutors</a></li>
            <li><a href="/pricing" class="navbar__link {{ request()->is('pricing*') ? 'navbar__link--active' : '' }}">Pricing</a></li>
            <!-- <li><a href="/careers" class="navbar__link {{ request()->is('careers*') ? 'navbar__link--active' : '' }}">Careers</a></li> -->
        </ul>

        {{-- Desktop Right Side --}}
        <div class="hidden lg:flex items-center gap-4">
            @guest
                <a href="{{ route('login') }}" class="navbar__cta" id="navbar-cta-desktop">
                    Get Started
                </a>
            @endguest

            @auth
                {{-- Notifications Placeholder --}}
                <button type="button" class="p-2 text-gray-500 hover:text-gray-900 transition-colors relative" aria-label="Notifications">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-bell"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                </button>

                {{-- Wishlist/Saved --}}
                <a href="#" class="p-2 text-gray-500 hover:text-gray-900 transition-colors" aria-label="Saved Tutors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                </a>

                {{-- Profile Dropdown Wrapper --}}
                <div class="relative ml-2">
                    {{-- Avatar Trigger --}}
                    @php
                        $user = Auth::user();
                        $initials = strtoupper(substr($user->name, 0, 2));
                        $hues = ['bg-green-100 text-green-700', 'bg-blue-100 text-blue-700', 'bg-amber-100 text-amber-700', 'bg-purple-100 text-purple-700', 'bg-rose-100 text-rose-700'];
                        $colorHash = $hues[$user->id % count($hues)];
                    @endphp
                    
                    <button @click="profileOpen = !profileOpen" @click.outside="profileOpen = false" @keydown.escape.window="profileOpen = false" type="button" class="flex items-center gap-2 focus:outline-none group">
                        @if($user->avatar_url)
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-xl object-cover shadow-sm border border-black/5 group-hover:scale-105 transition-transform duration-200">
                        @else
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center font-bold text-sm tracking-wide shadow-sm border border-black/5 group-hover:scale-105 transition-transform duration-200 {{ $colorHash }}">
                                {{ $initials }}
                            </div>
                        @endif
                    </button>

                    {{-- Dropdown Panel --}}
                    <div x-show="profileOpen" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95 translate-y-1"
                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                         x-transition:leave-end="opacity-0 scale-95 translate-y-1"
                         x-cloak
                         class="absolute right-0 mt-3 w-64 bg-white/95 backdrop-blur-xl rounded-2xl shadow-[0_12px_40px_rgba(0,0,0,0.08)] border border-gray-100 py-2 z-50 origin-top-right">
                        
                        {{-- Dropdown Header --}}
                        <div class="px-5 py-4 border-b border-gray-100/80">
                            <div class="text-sm font-bold text-gray-900 truncate">{{ $user->name }}</div>
                            <div class="text-[13px] font-medium text-gray-500 capitalize mt-0.5">{{ $user->role }}</div>
                        </div>

                        {{-- Dropdown Links --}}
                        <div class="py-2 px-3 flex flex-col gap-1">
                            <a href="{{ $user->role === 'tutor' ? route('tutor.dashboard') : route('student.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-[14.5px] font-medium text-gray-700 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-layout-dashboard text-gray-400"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                                Dashboard
                            </a>
                            <a href="{{ $user->role === 'tutor' ? route('tutor.dashboard') : route('student.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-[14.5px] font-medium text-gray-700 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-square text-gray-400"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                                Messages
                            </a>
                            @if($user->role === 'student')
                                <a href="{{ $user->role === 'tutor' ? route('tutor.lessons') : route('student.lessons') }}" class="flex items-center gap-3 px-3 py-2.5 text-[14.5px] font-medium text-gray-700 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-video text-gray-400"><path d="m16 13 5.223 3.482a.5.5 0 0 0 .777-.416V7.87a.5.5 0 0 0-.752-.432L16 10.5"/><rect x="2" y="6" width="14" height="12" rx="2"/></svg>
                                    My Lessons
                                </a>
                                <a href="{{ $user->role === 'tutor' ? route('tutor.dashboard') : route('student.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-[14.5px] font-medium text-gray-700 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart text-gray-400"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                                    Saved Tutors
                                </a>
                            @else
                                <a href="{{ $user->role === 'tutor' ? route('tutor.schedule') : route('student.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-[14.5px] font-medium text-gray-700 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar text-gray-400"><path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/></svg>
                                    Schedule
                                </a>
                                <!-- <a href="#" class="flex items-center gap-3 px-3 py-2.5 text-[14.5px] font-medium text-gray-700 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users text-gray-400"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                    Students
                                </a> -->
                                <a href="{{ $user->role === 'tutor' ? route('tutor.earnings') : route('student.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 text-[14.5px] font-medium text-gray-700 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-coins text-gray-400"><circle cx="8" cy="8" r="6"/><path d="M18.09 10.37A6 6 0 1 1 10.34 18"/><path d="M7 6h1v4"/><path d="m16.71 13.88.7.71-2.82 2.82"/></svg>
                                    Earnings
                                </a>
                            @endif
                            <a href="{{ $user->role === 'tutor' ? route('tutor.settings') : route('student.settings') }}" class="flex items-center gap-3 px-3 py-2.5 text-[14.5px] font-medium text-gray-700 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-settings text-gray-400"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                                Settings
                            </a>
                        </div>

                        <div class="px-3 py-2 border-t border-gray-100">
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-[14.5px] font-medium text-red-600 rounded-xl hover:bg-red-50 transition-colors text-left">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-log-out text-red-500"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                                    Log out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
        </div>

        {{-- Mobile Hamburger (Alpine Controlled) --}}
        <button
            type="button"
            class="navbar__hamburger lg:hidden flex flex-col justify-center items-center w-10 h-10 gap-[5px] z-50 focus:outline-none"
            @click="mobileMenuOpen = !mobileMenuOpen"
            :aria-expanded="mobileMenuOpen.toString()"
            aria-label="Toggle navigation menu"
        >
            <span class="w-6 h-[2px] bg-gray-900 rounded-full transition-transform duration-300 origin-center" :class="{ 'translate-y-[7px] rotate-45': mobileMenuOpen }"></span>
            <span class="w-6 h-[2px] bg-gray-900 rounded-full transition-opacity duration-300" :class="{ 'opacity-0': mobileMenuOpen }"></span>
            <span class="w-6 h-[2px] bg-gray-900 rounded-full transition-transform duration-300 origin-center" :class="{ '-translate-y-[7px] -rotate-45': mobileMenuOpen }"></span>
        </button>
    </div>

    {{-- Mobile Menu Overlay --}}
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak
         class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm z-40 lg:hidden"
         @click="mobileMenuOpen = false"></div>

    {{-- Mobile Menu Drawer --}}
    <div x-show="mobileMenuOpen"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         x-cloak
         class="fixed inset-y-0 left-0 w-[85%] max-w-sm bg-white shadow-2xl z-50 flex flex-col lg:hidden overflow-y-auto">
        
        <div class="p-6 flex-1 flex flex-col">
            <a href="/" class="mb-8 block" @click="mobileMenuOpen = false">
                <img src="/images/logo.png" alt="Tutzy Logo" class="h-8">
            </a>

            @auth
                {{-- Mobile Profile Summary --}}
                @php
                    $user = Auth::user();
                    $initials = strtoupper(substr($user->name, 0, 2));
                    $hues = ['bg-green-100 text-green-700', 'bg-blue-100 text-blue-700', 'bg-amber-100 text-amber-700', 'bg-purple-100 text-purple-700', 'bg-rose-100 text-rose-700'];
                    $colorHash = $hues[$user->id % count($hues)];
                @endphp
                <div class="flex items-center gap-4 mb-8 pb-8 border-b border-gray-100">
                    @if($user->avatar_url)
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-xl object-cover shadow-sm">
                    @else
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center font-bold tracking-wide shadow-sm {{ $colorHash }}">
                            {{ $initials }}
                        </div>
                    @endif
                    <div>
                        <div class="text-base font-bold text-gray-900 truncate">{{ $user->name }}</div>
                        <div class="text-sm font-medium text-gray-500 capitalize">{{ $user->role }}</div>
                    </div>
                </div>
            @endauth

            <ul class="flex flex-col gap-4 mb-8">
                <li><a href="/" class="text-[17px] font-bold text-gray-900 hover:text-[#84cc16] transition-colors" @click="mobileMenuOpen = false">Home</a></li>
                <li><a href="{{ route('find-tutors') }}" class="text-[17px] font-bold text-gray-900 hover:text-[#84cc16] transition-colors" @click="mobileMenuOpen = false">Find Tutors</a></li>
                <li><a href="/how-it-works" class="text-[17px] font-bold text-gray-900 hover:text-[#84cc16] transition-colors" @click="mobileMenuOpen = false">How it Works</a></li>
                <li><a href="/pricing" class="text-[17px] font-bold text-gray-900 hover:text-[#84cc16] transition-colors" @click="mobileMenuOpen = false">Pricing</a></li>
                <li><a href="{{ route('for-tutors') }}" class="text-[17px] font-bold text-gray-900 hover:text-[#84cc16] transition-colors" @click="mobileMenuOpen = false">For Tutors</a></li>
            </ul>

            @guest
                <div class="mt-auto pb-4">
                    <a href="{{ route('login') }}" class="flex items-center justify-center w-full py-3.5 bg-[#A3E635] text-gray-900 font-bold text-[15px] rounded-xl hover:bg-[#84cc16] transition-colors shadow-sm" @click="mobileMenuOpen = false">
                        Get Started
                    </a>
                </div>
            @endguest

            @auth
                <div class="mt-auto">
                    <div class="h-px w-full bg-gray-100 mb-4"></div>
                    <ul class="flex flex-col gap-3 mb-6">
                        <li><a href="{{ $user->role === 'tutor' ? route('tutor.dashboard') : route('student.dashboard') }}" class="text-[15px] font-semibold text-gray-600 hover:text-gray-900" @click="mobileMenuOpen = false">Dashboard</a></li>
                        <li><a href="#" class="text-[15px] font-semibold text-gray-600 hover:text-gray-900" @click="mobileMenuOpen = false">Messages</a></li>
                        <li><a href="#" class="text-[15px] font-semibold text-gray-600 hover:text-gray-900" @click="mobileMenuOpen = false">Settings</a></li>
                    </ul>
                    
                    <form method="POST" action="{{ route('logout') }}" class="m-0 pb-4">
                        @csrf
                        <button type="submit" class="flex items-center justify-center w-full py-3.5 bg-gray-100 text-gray-900 font-bold text-[15px] rounded-xl hover:bg-gray-200 transition-colors shadow-sm">
                            Log out
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>
