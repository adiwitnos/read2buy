@extends('layouts.app')

@section('title', 'Terms of Service — Read2Buy.com')
@section('meta_description', 'Terms and conditions governing the use of Read2Buy.com, intellectual property guidelines, and liability boundaries.')

@section('content')
<article class="py-16 sm:py-24 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <header class="space-y-4">
            <span class="text-xs uppercase font-mono tracking-widest text-stone-500 font-semibold">
                Usage Guidelines
            </span>
            <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold text-stone-900 leading-tight">
                Terms of Service
            </h1>
            <p class="text-xs text-stone-500 font-mono">
                Last Updated: October 2026
            </p>
        </header>

        <div class="prose prose-stone text-stone-700 leading-relaxed space-y-8 text-sm sm:text-base">
            <p class="text-base sm:text-lg text-stone-800 font-light leading-relaxed">
                Welcome to <strong>Read2Buy.com</strong>. By accessing and utilizing our guides, research comparisons, and editorial analyses, you agree to comply with the terms and conditions outlined below.
            </p>

            <div class="space-y-3 border-l-2 border-stone-800 pl-4 py-1">
                <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                    1. Informational & Research Purpose
                </h2>
                <p>
                    Read2Buy provides technical evaluations, product comparisons, buying frameworks, and consumer analyses free of charge for educational and informational reference. All materials are prepared in good faith utilizing publicly verifiable specifications and engineering documentation available at the time of publication.
                </p>
            </div>

            <div class="space-y-3 border-l-2 border-stone-800 pl-4 py-1">
                <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                    2. Intellectual Property & Fair Use
                </h2>
                <p>
                    All original editorial text, comparison scorecards, evaluation matrices, and layout frameworks are the exclusive intellectual property of Read2Buy.com and protected under international copyright treaties. Brief excerpts may be cited provided clear, active attribution links are retained. Third-party brand names, logos, and model identifiers mentioned remain the trademarks of their respective owners, used solely for nominative fair use review and identification purposes.
                </p>
            </div>

            <div class="space-y-3 border-l-2 border-stone-800 pl-4 py-1">
                <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                    3. Independent Retail Transactions
                </h2>
                <p>
                    Read2Buy does not sell or distribute merchandise directly. When navigating to third-party retail partners (such as Amazon or authorized merchant storefronts) via outbound links, all checkout transactions, billing, shipping logistics, and manufacturer warranty obligations are strictly between you and the respective retail seller.
                </p>
            </div>

            <div class="space-y-3 border-l-2 border-stone-800 pl-4 py-1">
                <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                    4. Acceptable System Use
                </h2>
                <p>
                    Visitors are prohibited from engaging in activities that impair server stability, including malicious automated mass scraping that degrades site performance, vulnerability exploitation attempts, or unsolicited spam transmissions via our editorial contact channels.
                </p>
            </div>

            <div class="space-y-3 border-l-2 border-stone-800 pl-4 py-1">
                <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                    5. Modifications & Updates
                </h2>
                <p>
                    We reserve the right to revise these Terms of Service periodically to reflect evolving legal requirements or site capabilities. Continued usage of Read2Buy following revisions constitutes acceptance of the updated terms.
                </p>
            </div>
        </div>
    </div>
</article>
@endsection
