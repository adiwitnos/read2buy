@extends('layouts.app')

@section('title', 'Privacy Policy & Data Protection — Read2Buy.com')
@section('meta_description', 'Clear, transparent privacy policy and data protection practices for readers and partners at Read2Buy.com.')

@section('content')
<article class="py-16 sm:py-24 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <header class="space-y-4">
            <span class="text-xs uppercase font-mono tracking-widest text-stone-500 font-semibold">
                Data Protection
            </span>
            <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold text-stone-900 leading-tight">
                Privacy Policy
            </h1>
            <p class="text-xs text-stone-500 font-mono">
                Last Updated: October 2026
            </p>
        </header>

        <div class="prose prose-stone text-stone-700 leading-relaxed space-y-8 text-sm sm:text-base">
            <p class="text-base sm:text-lg text-stone-800 font-light leading-relaxed">
                At <strong>Read2Buy.com</strong>, we believe an exceptional buying decision engine does not need to surveil its audience. We collect the bare minimum amount of technical data necessary for system reliability, spam prevention, and operational security.
            </p>

            <div class="space-y-3 border-l-2 border-stone-800 pl-4 py-1">
                <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                    1. Information Collected Automatically
                </h2>
                <p>
                    Readers can explore all guides, comparisons, and articles freely without mandatory account creation. Our web servers record standard, non-personally identifiable server telemetry: IP addresses, browser types, referring pages, and access timestamps to monitor server health, security defense, and link integrity.
                </p>
            </div>

            <div class="space-y-3 border-l-2 border-stone-800 pl-4 py-1">
                <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                    2. Cookies & Partner Retailer Attribution
                </h2>
                <p>
                    When clicking an outbound referral link to verified retailer platforms (such as Amazon or partner storefronts), the destination merchant may place a temporary session cookie on your browser. This cookie exists solely to credit Read2Buy with the qualifying referral. We never receive, process, or store your payment card numbers, billing addresses, or personal checkout history from those partner merchants.
                </p>
            </div>

            <div class="space-y-3 border-l-2 border-stone-800 pl-4 py-1">
                <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                    3. Direct Communications & Confidentiality
                </h2>
                <p>
                    When you contact our editorial desk via email (whether submitting reader feedback or brand product datasheets), your contact details and message contents remain confidential. We never monetize, rent, or distribute your email address to marketing third parties or data brokers.
                </p>
            </div>

            <div class="space-y-3 border-l-2 border-stone-800 pl-4 py-1">
                <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                    4. Security Infrastructure
                </h2>
                <p>
                    All traffic between your device and Read2Buy is encrypted via modern TLS/HTTPS protocols to safeguard against data interception and spoofing attacks.
                </p>
            </div>
        </div>
    </div>
</article>
@endsection
