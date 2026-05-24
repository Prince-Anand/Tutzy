<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tutzy - Real-time tutor booking and feedback platform. Find tutors, book on demand, learn with confidence.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Tutzy - Find Tutors. Book on Demand.')</title>
    <link rel="icon" type="image/png" href="/1.png" sizes="32x32">

    {{-- Fonts --}}
    <link rel="stylesheet" href="/fonts/satoshi/css/satoshi.css">

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>

<body class="font-sans bg-white text-gray-900 antialiased min-h-screen flex flex-col overflow-x-hidden">

    {{-- ═══════════════════════════════════════════════════ --}}
    {{-- NAVBAR --}}
    {{-- ═══════════════════════════════════════════════════ --}}
    <x-navbar />

    {{-- ═══════════════════════════════════════════════════ --}}
    {{-- MAIN CONTENT --}}
    {{-- ═══════════════════════════════════════════════════ --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- ═══════════════════════════════════════════════════ --}}
    {{-- FOOTER --}}
    {{-- ═══════════════════════════════════════════════════ --}}
    <footer class="footer" id="main-footer">
        <div class="footer__inner">
            <div class="footer__brand">
                <a href="/" class="navbar__logo"><img src="/images/logo.png" alt="Tutzy" class="navbar__logo-img" style="height:40px;"></a>
                <p class="footer__tagline">The smart way to find tutors, book sessions, and track your learning — all in one place.</p>
                <div class="footer__socials">
                    <a href="#" class="footer__social" aria-label="Twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.748l7.73-8.835L1.254 2.25H8.08l4.259 5.631 5.905-5.631Zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <a href="#" class="footer__social" aria-label="LinkedIn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="#" class="footer__social" aria-label="Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                    </a>
                </div>
            </div>
            <div class="footer__col">
                <div class="footer__col-title">For Students</div>
                <ul class="footer__links-list">
                    <li><a href="/find-tutors">Find Tutors</a></li>
                    <li><a href="/subjects">Browse Subjects</a></li>
                    <li><a href="/how-it-works">How It Works</a></li>
                    <li><a href="/pricing">Pricing</a></li>
                    <li><a href="/reviews">Student Reviews</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <div class="footer__col-title">For Tutors</div>
                <ul class="footer__links-list">
                    <li><a href="/for-tutors">Become a Tutor</a></li>
                    <li><a href="/tutor-resources">Resources</a></li>
                    <li><a href="/tutor-success">Success Stories</a></li>
                    <li><a href="/payout">Payouts</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <div class="footer__col-title">Company</div>
                <ul class="footer__links-list">
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="/careers">Careers</a></li>
                    <li><a href="/press">Press</a></li>
                    <li><a href="/contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer__col">
                <div class="footer__col-title">Legal</div>
                <ul class="footer__links-list">
                    <li><a href="/privacy">Privacy Policy</a></li>
                    <li><a href="/terms">Terms of Service</a></li>
                    <li><a href="/cookies">Cookie Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="footer__bottom">
            <p class="footer__copy">&copy; {{ date('Y') }} Tutzy. All rights reserved.</p>
            <p class="footer__copy">Made with ❤️ for learners everywhere.</p>
        </div>
    </footer>




    @stack('scripts')
</body>
</html>
