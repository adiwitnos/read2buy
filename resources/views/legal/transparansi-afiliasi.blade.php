@extends('layouts.app')

@section('title', 'Affiliate Transparency & Monetization Policy — Read2Buy.com')
@section('meta_description', 'Affiliate monetization disclosure, reader protection principles, and editorial independence at Read2Buy.com.')

@section('content')
<div class="bg-white border-b border-stone-200/80 py-16 sm:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-stone-100 text-stone-800 text-xs uppercase tracking-widest font-semibold border border-stone-200">
            <span class="w-1.5 h-1.5 rounded-full bg-stone-900"></span>
            Openness & Trust
        </div>
        <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold tracking-tight text-stone-900">
            Affiliate Transparency
        </h1>
        <p class="text-lg text-stone-600 font-light leading-relaxed">
            How Read2Buy sustains independent research without compromising reader trust or editorial integrity.
        </p>
    </div>
</div>

<div class="py-16 bg-[#faf8f5]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- 5-Step Monetization Model -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-6">
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                How We Generate Revenue (The 5-Step Model)
            </h2>
            <div class="space-y-4 text-sm text-stone-700 leading-relaxed">
                <p>
                    Read2Buy is <strong>not a retailer</strong> and <strong>does not process consumer checkout payments</strong>. We are an independent buying decision desk. Our revenue workflow operates in five simple, transparent steps:
                </p>
                <div class="p-6 bg-stone-50 rounded-xl border border-stone-200/80 font-mono text-xs space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-stone-900 text-white flex items-center justify-center font-bold">1</span>
                        <span>Readers review our in-depth research guides and identify products matching their exact needs.</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-stone-900 text-white flex items-center justify-center font-bold">2</span>
                        <span>Readers click an outbound merchant link clearly marked as a partner/affiliate link.</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-stone-900 text-white flex items-center justify-center font-bold">3</span>
                        <span>Readers complete their transaction securely on the verified merchant or retailer website.</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-stone-900 text-white flex items-center justify-center font-bold">4</span>
                        <span>The merchant confirms the qualifying purchase according to standard terms.</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="w-6 h-6 rounded-full bg-stone-900 text-white flex items-center justify-center font-bold">5</span>
                        <span>A small referral commission is remitted to Read2Buy to fund ongoing independent research.</span>
                    </div>
                </div>
                <p class="text-xs text-stone-500 italic">
                    Note: Purchasing via our affiliate links <strong>never increases the retail price</strong> you pay. Pricing, promotions, and return policies remain identical to standard checkout.
                </p>
            </div>
        </section>

        <!-- Compliance & Link Standards -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-6">
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                Program Compliance & Consumer Safeguards
            </h2>
            <ul class="space-y-3 text-sm text-stone-700 list-disc list-inside leading-relaxed">
                <li>
                    <strong>Standard Attributes:</strong> All outbound commercial links carry <code>rel="sponsored"</code> and <code>rel="nofollow"</code> tags according to Google Webmaster directives to prevent artificial search ranking manipulation.
                </li>
                <li>
                    <strong>Verified Channels Only:</strong> We only direct readers to merchants and programs where <code>read2buy.com</code> is an approved, registered publisher channel.
                </li>
                <li>
                    <strong>Zero Covert Advertising:</strong> We never run undisclosed native ads, sponsored product reviews disguised as organic guides, or paid placement deals.
                </li>
                <li>
                    <strong>Sensitive Category Safeguards:</strong> High-risk financial services, unregulated supplements, and questionable health claims are omitted from our editorial scope to protect consumers.
                </li>
            </ul>
        </section>

        <x-disclosure-box method="online_research" :hasAffiliate="true" />

    </div>
</div>
@endsection
