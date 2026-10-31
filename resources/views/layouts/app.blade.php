<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Read2Buy — Informed Choices for Every Purchase')</title>
    <meta name="description" content="@yield('meta_description', 'Read before you buy. Research-backed product curation and buying guides.')">
    
    <!-- OpenGraph / Social -->
    <meta property="og:title" content="@yield('title', ($siteSettings['site_name'] ?? 'Read2Buy') . ' — Informed Choices for Every Purchase')">
    <meta property="og:description" content="@yield('meta_description', 'Read before you buy. Research-backed product curation and buying guides.')">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteSettings['site_name'] ?? 'Read2Buy.com' }}">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', ($siteSettings['site_name'] ?? 'Read2Buy') . ' — Informed Choices for Every Purchase')">
    <meta name="twitter:description" content="@yield('meta_description', 'Read before you buy. Research-backed product curation and buying guides.')">

    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    @stack('meta')

    @if(!empty($siteSettings['ga_id']))
        <!-- Google Analytics GA4 -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $siteSettings['ga_id'] }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ $siteSettings['ga_id'] }}');
        </script>
    @endif

    @if(!empty($siteSettings['meta_pixel_id']))
        <!-- Meta Pixel -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{{ $siteSettings['meta_pixel_id'] }}');
            fbq('track', 'PageView');
        </script>
    @endif

    @if(!empty($siteSettings['custom_head']))
        {!! $siteSettings['custom_head'] !!}
    @endif

    <script>
        if (localStorage.getItem('member_sidebar_collapsed') === 'true') {
            document.documentElement.classList.add('sidebar-collapsed');
        }
    </script>
    <style>
        @media (min-width: 1024px) {
            #member-sidebar {
                position: sticky !important;
                top: 5rem !important;
                height: calc(100vh - 5rem) !important;
                width: 16rem;
                min-width: 16rem;
                max-width: 16rem;
                transform: none !important;
                margin-right: 1.5rem;
                transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1), min-width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            .sidebar-collapsed #member-sidebar {
                width: 4.25rem !important;
                min-width: 4.25rem !important;
                max-width: 4.25rem !important;
            }
        }
        @media (max-width: 1023px) {
            #member-sidebar {
                position: fixed !important;
                top: 5rem;
                bottom: 0;
                left: 0;
                width: 16rem !important;
                min-width: 16rem !important;
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            #member-sidebar.sidebar-mobile-open {
                transform: translateX(0) !important;
            }
        }
        .sidebar-collapsed #member-sidebar .sidebar-text-expandable {
            display: none !important;
        }
        .sidebar-collapsed #member-sidebar .sidebar-item-inner {
            justify-content: center !important;
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }
        .sidebar-collapsed #member-sidebar #sidebar-rail-icon {
            transform: rotate(180deg) !important;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#faf8f5] text-[#1c1d20] flex flex-col min-h-screen selection:bg-stone-800 selection:text-white">

    <!-- Main Navigation Header -->
    <header class="bg-white/90 backdrop-blur-md sticky top-0 z-40 border-b border-stone-200/80 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                @auth
                    <!-- Sidebar Toggle Button (Desktop Mini-Rail & Mobile Drawer) -->
                    <button type="button" id="sidebar-toggle-btn" class="p-2 rounded-lg text-stone-600 hover:text-stone-950 hover:bg-stone-100 transition-colors cursor-pointer" title="Toggle Sidebar" aria-label="Toggle Sidebar">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                @endauth

                <!-- Brand Logo (Link to Home) -->
                <a href="{{ route('home') }}" class="group shrink-0" title="Read2Buy">
                    <span class="font-serif-editorial text-2xl sm:text-3xl font-bold tracking-tight text-stone-900 group-hover:text-stone-700 transition-colors">
                        Read2Buy
                    </span>
                </a>
            </div>

            <!-- Right Controls: Guest vs Member/Administrator -->
            @guest
                <div class="flex items-center gap-3 sm:gap-6">
                    <!-- Search Product Input -->
                    <form action="{{ route('home') }}" method="GET" class="relative w-44 sm:w-64 md:w-80">
                        <input
                            type="search"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Search Products..."
                            class="w-full px-4 py-2 text-xs sm:text-sm bg-stone-100 hover:bg-stone-50 focus:bg-white border border-stone-300 rounded-full focus:outline-none focus:ring-1 focus:ring-stone-900 focus:border-stone-900 transition-all text-stone-900 placeholder:text-stone-400"
                        />
                    </form>

                    <!-- Log In Link -->
                    <a href="{{ route('login') }}" class="px-4 py-2 text-xs uppercase tracking-wider font-semibold rounded-md bg-stone-900 text-white hover:bg-stone-800 transition-colors shadow-xs shrink-0">
                        Log In
                    </a>
                </div>
            @endguest

            @auth
                @php
                    $userDashboardUrl = Auth::user()->isAdmin() ? url('/admin') : route('dashboard');
                @endphp
                <div class="flex items-center gap-4 sm:gap-6 shrink-0">
                    <!-- User Name Link -->
                    <a href="{{ $userDashboardUrl }}" class="text-xs sm:text-sm font-semibold text-stone-900 hover:text-stone-600 transition-colors py-1.5 px-3 rounded-md hover:bg-stone-100 border border-transparent hover:border-stone-200" title="{{ Auth::user()->name }}">
                        {{ Auth::user()->name }}
                    </a>

                    <!-- Log Out Button -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-xs uppercase tracking-wider font-semibold rounded-md bg-stone-900 text-white hover:bg-stone-800 transition-colors shadow-xs shrink-0 cursor-pointer">
                            Log Out
                        </button>
                    </form>
                </div>
            @endauth
        </div>
    </header>

    @guest
        <!-- Main Content Slot for Guests -->
        <main class="flex-grow">
            @if(session('status'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                    <div class="p-4 bg-emerald-50 border border-emerald-200/90 text-emerald-900 rounded-xl text-xs font-medium flex items-center justify-between shadow-2xs">
                        <span class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            {{ session('status') }}
                        </span>
                        <a href="{{ route('dashboard') }}" class="underline font-semibold hover:text-emerald-950 ml-4 shrink-0">
                            Open Bookmarks Dashboard &rarr;
                        </a>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    @endguest

    @auth
        @php
            $authUser = Auth::user();
            $authBookmarkCount = $authUser->bookmarks()->count();
            $authIsAdmin = $authUser->isAdmin();
            $isBookmarksActive = request()->routeIs('dashboard') && (!request()->has('tab') || request('tab') === 'bookmarks');
            $isShowroomActive = (request()->routeIs('dashboard') && request('tab') === 'showroom');
            $isPanduanActive = (request()->routeIs('dashboard') && request('tab') === 'panduan') || request()->routeIs('content.guides') || request()->routeIs('content.guide');
            $isCeritaActive = (request()->routeIs('dashboard') && request('tab') === 'cerita') || request()->routeIs('content.stories') || request()->routeIs('content.story');
        @endphp

        <!-- App Shell for Authenticated Members with Persistent Collapsible Sidebar -->
        <div class="flex-grow flex relative min-w-0">
            <!-- Mobile Backdrop -->
            <div id="sidebar-backdrop" class="fixed inset-0 bg-stone-950/40 backdrop-blur-xs z-30 hidden lg:hidden transition-opacity"></div>

            <!-- Persistent Collapsible Sidebar -->
            <aside id="member-sidebar" class="z-40 bg-white/95 backdrop-blur-md border-r border-stone-200/80 flex flex-col justify-between overflow-y-auto shrink-0 shadow-sm lg:shadow-none">
                <!-- Top Section: User Profile & Nav -->
                <div class="p-3 space-y-4">
                    <!-- User Profile Card -->
                    <div class="sidebar-user-card p-3 rounded-xl bg-stone-50 border border-stone-200/70 transition-all">
                        <div class="flex items-center gap-3 sidebar-item-inner">
                            <div class="w-10 h-10 rounded-full bg-stone-900 text-amber-100 flex items-center justify-center font-serif-editorial text-base font-bold shrink-0 shadow-2xs" title="{{ $authUser->name }}">
                                {{ strtoupper(substr($authUser->name, 0, 1)) }}
                            </div>
                            <div class="sidebar-text-expandable min-w-0 flex-1 overflow-hidden">
                                <h2 class="text-xs font-bold text-stone-900 truncate" title="{{ $authUser->name }}">{{ $authUser->name }}</h2>
                                <p class="text-[11px] text-stone-500 truncate font-mono">{{ $authUser->email }}</p>
                                <span class="inline-block mt-1 px-1.5 py-0.5 rounded text-[9px] font-bold uppercase tracking-wider {{ $authIsAdmin ? 'bg-amber-100 text-amber-800 border border-amber-200' : 'bg-emerald-100 text-emerald-800 border border-emerald-200' }}">
                                    {{ $authIsAdmin ? 'Administrator' : 'Verified Member' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Navigation Menu -->
                    <div class="space-y-1">
                        <div class="sidebar-text-expandable px-3 py-1 text-[10px] font-bold uppercase tracking-widest text-stone-400">
                            Dashboard Menu
                        </div>

                        <!-- Bookmarked Products -->
                        <a href="{{ route('dashboard') }}" class="sidebar-item-inner flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs tracking-wide transition-colors {{ $isBookmarksActive ? 'bg-stone-900 text-white font-semibold shadow-xs' : 'text-stone-700 hover:bg-stone-100 hover:text-stone-950 font-medium' }}" title="Bookmarked Products ({{ $authBookmarkCount }})">
                            <svg class="w-4 h-4 shrink-0 {{ $isBookmarksActive ? 'text-amber-300' : 'text-stone-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                            <span class="sidebar-text-expandable flex-1 truncate">Bookmarked Products</span>
                            <span class="sidebar-text-expandable px-1.5 py-0.5 rounded text-[10px] font-mono font-bold {{ $isBookmarksActive ? 'bg-stone-800 text-amber-300' : 'bg-stone-200/70 text-stone-700' }}">
                                {{ $authBookmarkCount }}
                            </span>
                        </a>

                        <!-- Explore Showroom -->
                        <a href="{{ route('dashboard', ['tab' => 'showroom']) }}" class="sidebar-item-inner flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs transition-colors {{ $isShowroomActive ? 'bg-stone-900 text-white font-semibold shadow-xs' : 'text-stone-700 hover:bg-stone-100 hover:text-stone-950 font-medium' }}" title="Explore Showroom">
                            <svg class="w-4 h-4 shrink-0 {{ $isShowroomActive ? 'text-amber-300' : 'text-stone-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span class="sidebar-text-expandable flex-1 truncate">Explore Showroom</span>
                        </a>

                        <!-- Buying Guides -->
                        <a href="{{ route('dashboard', ['tab' => 'panduan']) }}" class="sidebar-item-inner flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs transition-colors {{ $isPanduanActive ? 'bg-stone-900 text-white font-semibold shadow-xs' : 'text-stone-700 hover:bg-stone-100 hover:text-stone-950 font-medium' }}" title="Buying Guides">
                            <svg class="w-4 h-4 shrink-0 {{ $isPanduanActive ? 'text-amber-300' : 'text-stone-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="sidebar-text-expandable flex-1 truncate">Buying Guides</span>
                        </a>

                        <!-- Consumer Stories -->
                        <a href="{{ route('dashboard', ['tab' => 'cerita']) }}" class="sidebar-item-inner flex items-center gap-3 px-3 py-2.5 rounded-lg text-xs transition-colors {{ $isCeritaActive ? 'bg-stone-900 text-white font-semibold shadow-xs' : 'text-stone-700 hover:bg-stone-100 hover:text-stone-950 font-medium' }}" title="Consumer Stories">
                            <svg class="w-4 h-4 shrink-0 {{ $isCeritaActive ? 'text-amber-300' : 'text-stone-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <span class="sidebar-text-expandable flex-1 truncate">Consumer Stories</span>
                        </a>

                        @if($authIsAdmin)
                            <div class="pt-2 border-t border-stone-200/80">
                                <a href="{{ url('/admin') }}" class="sidebar-item-inner flex items-center gap-3 px-3 py-2 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-900 text-xs font-semibold transition-colors border border-amber-200" title="Filament Admin Panel">
                                    <svg class="w-4 h-4 shrink-0 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="sidebar-text-expandable flex-1 truncate">Admin Panel</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Bottom Collapse / Expand Button (Desktop) -->
                <div class="p-3 border-t border-stone-200/80 hidden lg:block">
                    <button type="button" id="sidebar-rail-btn" class="sidebar-item-inner w-full flex items-center justify-center gap-2 p-2 rounded-lg text-stone-500 hover:text-stone-900 hover:bg-stone-100 transition-colors text-xs font-medium cursor-pointer" title="Toggle Sidebar">
                        <svg id="sidebar-rail-icon" class="w-4 h-4 shrink-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
                        </svg>
                        <span class="sidebar-text-expandable truncate">Collapse Menu</span>
                    </button>
                </div>
            </aside>

            <!-- Main Content Area alongside Persistent Sidebar -->
            <main class="flex-1 min-w-0 transition-all duration-300 flex flex-col">
                @if(session('status'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 w-full">
                        <div class="p-4 bg-emerald-50 border border-emerald-200/90 text-emerald-900 rounded-xl text-xs font-medium flex items-center justify-between shadow-2xs">
                            <span class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                {{ session('status') }}
                            </span>
                            <a href="{{ route('dashboard') }}" class="underline font-semibold hover:text-emerald-950 ml-4 shrink-0">
                                Open Bookmarks Dashboard &rarr;
                            </a>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    @endauth

    <!-- Editorial Footer -->
    <footer class="bg-[#121316] text-stone-400 border-t border-stone-800 pt-16 pb-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-16">
                <!-- Column 1 -->
                <div class="space-y-3">
                    <span class="font-serif-editorial text-2xl font-bold tracking-tight text-white block">
                        Read2Buy<span class="text-stone-500 font-sans text-lg font-normal">.com</span>
                    </span>
                    <p class="text-stone-200 text-sm italic font-serif-editorial leading-relaxed">
                        &ldquo;Informed Choices for Every Purchase.&rdquo;
                    </p>
                    <p class="text-stone-400 text-xs leading-relaxed">
                        Independent research-backed product curation and buying guides.
                    </p>
                </div>

                <!-- Column 2 -->
                <div>
                    <ul class="space-y-3 text-xs sm:text-sm">
                        <li>
                            <a href="{{ route('content.guides') }}" class="hover:text-white transition-colors">
                                Practical Buying Guides
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('content.stories') }}" class="hover:text-white transition-colors">
                                Consumer Stories
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('showroom.curation-standards') }}" class="hover:text-white transition-colors">
                                Curation Standards
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('faq') }}" class="hover:text-white transition-colors">
                                Frequently Asked Questions (FAQ)
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3 -->
                <div>
                    <ul class="space-y-3 text-xs sm:text-sm">
                        <li>
                            <a href="{{ route('about.us') }}" class="hover:text-white transition-colors">
                                About Us
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('legal.editorial-policy') }}" class="hover:text-white transition-colors">
                                Editorial Policy
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('legal.affiliate-disclosure') }}" class="hover:text-white transition-colors">
                                Affiliate Disclosure & Transparency
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('contact') }}" class="hover:text-white transition-colors">
                                Contact Us
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 4 -->
                <div>
                    <ul class="space-y-3 text-xs sm:text-sm">
                        <li>
                            <a href="{{ route('legal.disclaimer') }}" class="hover:text-white transition-colors">
                                Legal Disclaimer
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('legal.privacy-policy') }}" class="hover:text-white transition-colors">
                                Privacy Policy
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('legal.terms') }}" class="hover:text-white transition-colors">
                                Terms of Service
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-8 border-t border-stone-800/80 flex items-center justify-between text-xs text-stone-500">
                <p>&copy; {{ date('Y') }} Read2Buy.com. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @if(!empty($siteSettings['custom_body']))
        {!! $siteSettings['custom_body'] !!}
    @endif

    @auth
    <script>
    (function() {
        const toggleBtn = document.getElementById('sidebar-toggle-btn');
        const railBtn = document.getElementById('sidebar-rail-btn');
        const sidebar = document.getElementById('member-sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');

        if (!sidebar) return;

        function toggleSidebar() {
            if (window.innerWidth >= 1024) {
                const isCurrentlyCollapsed = document.documentElement.classList.contains('sidebar-collapsed');
                if (isCurrentlyCollapsed) {
                    document.documentElement.classList.remove('sidebar-collapsed');
                    localStorage.setItem('member_sidebar_collapsed', 'false');
                } else {
                    document.documentElement.classList.add('sidebar-collapsed');
                    localStorage.setItem('member_sidebar_collapsed', 'true');
                }
            } else {
                const isOpen = sidebar.classList.contains('sidebar-mobile-open');
                if (isOpen) {
                    sidebar.classList.remove('sidebar-mobile-open');
                    if (backdrop) backdrop.classList.add('hidden');
                } else {
                    sidebar.classList.add('sidebar-mobile-open');
                    if (backdrop) backdrop.classList.remove('hidden');
                }
            }
        }

        if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);
        if (railBtn) railBtn.addEventListener('click', toggleSidebar);
        if (backdrop) {
            backdrop.addEventListener('click', function() {
                sidebar.classList.remove('sidebar-mobile-open');
                backdrop.classList.add('hidden');
            });
        }
    })();
    </script>
    @endauth

</body>
</html>
