@extends('layouts.app')

@section('title', 'Legal Disclaimer & Scope of Research — Read2Buy.com')
@section('meta_description', 'Clear explanations regarding research scope, third-party pricing fluctuations, and editorial independence at Read2Buy.com.')

@section('content')
<article class="py-16 sm:py-24 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <header class="space-y-4">
            <span class="text-xs uppercase font-mono tracking-widest text-stone-500 font-semibold">
                Transparency & Boundaries
            </span>
            <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold text-stone-900 leading-tight">
                Legal Disclaimer
            </h1>
            <p class="text-xs text-stone-500 font-mono">
                Last Updated: October 2026
            </p>
        </header>

        <div class="prose prose-stone text-stone-700 leading-relaxed space-y-8 text-sm sm:text-base">
            <p class="text-base sm:text-lg text-stone-800 font-light leading-relaxed">
                Read2Buy.com was built to help you make conscious, rational, and well-researched consumer decisions while saving valuable time. To maintain clear expectations, the boundaries of our editorial research and platform operations are outlined below.
            </p>

            <div class="space-y-3 border-l-2 border-stone-800 pl-4 py-1">
                <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                    1. Primary Online Research & Technical Datasheets
                </h2>
                <p>
                    All product evaluations and comparative guides on this site are constructed via primary data research: official manufacturer technical datasheets, operational manuals, regulatory compliance certifications, and audits of long-term real-world user defect reports. We do not claim physical ownership of every listed product. Manufacturers may alter internal component revisions, firmware, or batch packaging without prior notice.
                </p>
            </div>

            <div class="space-y-3 border-l-2 border-stone-800 pl-4 py-1">
                <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                    2. Fluctuations in Pricing, Stock & Promotions
                </h2>
                <p>
                    Product prices displayed across our guides reflect estimated values at the time of publication or verification. Actual retail prices, stock availability, promo codes, and shipping fees are controlled solely by authorized third-party sellers on their respective platforms (such as Amazon or verified merchant storefronts). Always confirm final checkout amounts before completing payment.
                </p>
            </div>

            <div class="space-y-3 border-l-2 border-stone-800 pl-4 py-1">
                <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                    3. Fulfillment & After-Sales Warranties
                </h2>
                <p>
                    Read2Buy is neither a direct retailer, distributor, logistics provider, nor warranty guarantor. All sales agreements, payment processing, packaging, delivery, and warranty fulfillment occur legally and directly between you and the respective merchant.
                </p>
            </div>

            <div class="space-y-3 border-l-2 border-stone-800 pl-4 py-1">
                <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                    4. Individual Responsibility & Tailored Requirements
                </h2>
                <p>
                    Ergonomic needs, physical proportions, space dimensions, and budgetary constraints vary by individual. Our guides serve as structured decision-making frameworks, not certified medical advice, architectural blueprints, or binding financial counsel. Final evaluation remains your personal prerogative.
                </p>
            </div>

            <div class="space-y-3 border-l-2 border-stone-800 pl-4 py-1">
                <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                    5. Affiliate Relationship & Outbound Links
                </h2>
                <p>
                    Certain outbound links on this website are official affiliate links. If you follow these links and make a qualified purchase, we may receive a referral commission at no additional cost to you. These earnings sustain our independent editorial team and research tools.
                </p>
            </div>
        </div>
    </div>
</article>
@endsection
