@extends('layouts.app')

@section('title', 'Contact Us — Editorial Desk & Brand Relations — Read2Buy.com')
@section('meta_description', 'Official contact channels for readers, consumers, and manufacturers at Read2Buy.com.')

@section('content')
<div class="bg-white border-b border-stone-200/80 py-16 sm:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-stone-100 text-stone-800 text-xs uppercase tracking-widest font-semibold border border-stone-200">
            <span class="w-1.5 h-1.5 rounded-full bg-stone-900"></span>
            Communication Desk
        </div>
        <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold tracking-tight text-stone-900">
            Contact Us
        </h1>
        <p class="text-lg text-stone-600 font-light leading-relaxed">
            Open channels for readers sharing real-world user feedback, and manufacturers providing verified technical specifications.
        </p>
    </div>
</div>

<div class="py-16 bg-[#faf8f5]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- 2 Communication Channels: Readers vs Brands -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Card 1: For Readers & Consumers -->
            <div class="bg-white rounded-xl border border-stone-200/80 p-8 shadow-xs flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <span class="text-xs uppercase font-bold tracking-widest text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded border border-emerald-200 inline-block">
                        For Readers & Consumers
                    </span>
                    <h2 class="font-serif-editorial text-2xl font-bold text-stone-900">
                        Corrections & Guide Requests
                    </h2>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        Spotted a broken link, a significant price discrepancy, or have a specific buying dilemma you'd like our research desk to analyze in an upcoming guide?
                    </p>
                    <ul class="text-xs text-stone-500 space-y-2 list-disc pl-4">
                        <li>Broken outbound merchant links or expired deals</li>
                        <li>Long-term durability reports & user feedback</li>
                        <li>Suggestions for workspace, productivity, or lifestyle topics</li>
                    </ul>
                </div>

                <div class="pt-4 border-t border-stone-100">
                    <span class="text-xs text-stone-400 uppercase tracking-wider font-mono block mb-1">Reader Inquiries Email:</span>
                    <a href="mailto:editorial@read2buy.com" class="text-base font-semibold text-stone-900 hover:underline">
                        editorial@read2buy.com
                    </a>
                </div>
            </div>

            <!-- Card 2: For Manufacturers & Brand Owners -->
            <div class="bg-white rounded-xl border border-stone-200/80 p-8 shadow-xs flex flex-col justify-between space-y-6">
                <div class="space-y-4">
                    <span class="text-xs uppercase font-bold tracking-widest text-amber-900 bg-amber-50 px-2.5 py-1 rounded border border-amber-200 inline-block">
                        For Manufacturers & Brands
                    </span>
                    <h2 class="font-serif-editorial text-2xl font-bold text-stone-900">
                        Technical Specs & Sample Units
                    </h2>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        Interested in submitting verified technical datasheets, factory compliance certifications, or sending test units under our strict $0-review editorial policy?
                    </p>
                    <ul class="text-xs text-stone-500 space-y-2 list-disc pl-4">
                        <li>Factory specification sheets and architectural blueprints</li>
                        <li>Verified authorized retailer documentation</li>
                        <li>Independent evaluation samples ($0 review policy, zero editorial conditions)</li>
                    </ul>
                </div>

                <div class="pt-4 border-t border-stone-100">
                    <span class="text-xs text-stone-400 uppercase tracking-wider font-mono block mb-1">Brand & Partner Desk:</span>
                    <a href="mailto:partners@read2buy.com" class="text-base font-semibold text-stone-900 hover:underline">
                        partners@read2buy.com
                    </a>
                </div>
            </div>
        </div>

        <!-- Response Commitment -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-4">
            <h2 class="font-serif-editorial text-xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                Response Times & Editorial Ethics
            </h2>
            <p class="text-sm text-stone-600 leading-relaxed">
                We are an independent research and editorial publication. Every correspondence from readers and verified manufacturers is manually reviewed by our curators within 1–3 business days. We strictly reject undisclosed native advertising, paid placement offers, and reciprocal rating manipulation.
            </p>
        </section>

    </div>
</div>
@endsection
