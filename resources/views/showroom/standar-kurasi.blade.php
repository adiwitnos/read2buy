@extends('layouts.app')

@section('title', 'Curation Standards & Research Methodology — The Read2Buy Standard')
@section('meta_description', 'Independent research principles, zero-bias review policies, and the transparent Essentials / Select / Signature tiers.')

@section('content')
<div class="bg-white border-b border-stone-200/80 py-16 sm:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-stone-100 text-stone-800 text-xs uppercase tracking-widest font-semibold border border-stone-200">
            <span class="w-1.5 h-1.5 rounded-full bg-stone-900"></span>
            Editorial Methodology
        </div>
        <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold tracking-tight text-stone-900">
            The Read2Buy Standard
        </h1>
        <p class="text-lg text-stone-600 font-light leading-relaxed">
            Independent, verifiable, and transparent product curation. Building consumer trust through candid evaluation and accountable research.
        </p>
    </div>
</div>

<div class="py-16 bg-[#faf8f5]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Anti-Ranking Manifesto: Reality-Check Trade-Off Desk -->
        <section class="bg-amber-50/70 rounded-xl border border-amber-200/90 p-8 sm:p-10 shadow-xs space-y-4">
            <div class="inline-flex items-center gap-2 text-xs uppercase tracking-wider font-bold text-amber-900">
                <span class="w-2 h-2 rounded-full bg-amber-600"></span>
                Trade-Off Research Manifesto
            </div>
            <h2 class="font-serif-editorial text-2xl sm:text-3xl font-bold text-stone-900 leading-snug">
                We Are Not a Superficial Rankings Board
            </h2>
            <p class="text-sm sm:text-base text-stone-700 leading-relaxed">
                Read2Buy is an <strong>independent research desk</strong> that dissects <em>verified strengths, hidden flaws, and purchasing trade-offs</em>. There is no single "magic" product that fits everyone. Our mission is not to crown absolute winners through artificial rating points, but to candidly expose what you gain and compromise with every choice, who will benefit most, and when you should <strong>skip buying altogether</strong>.
            </p>
        </section>

        <!-- 5 Core Editorial Directives -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-6">
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                Five Core Editorial Directives
            </h2>
            <ol class="space-y-4 text-sm text-stone-700 leading-relaxed list-decimal list-inside">
                <li>
                    <strong>Independent research is our primary methodology:</strong> We audit official technical specifications from manufacturers, analyze benchmark metrics, and synthesize long-term user telemetry.
                </li>
                <li>
                    <strong>Zero paid promotional reviews ($0):</strong> We never accept payment in exchange for positive reviews, top placements, or deceptive endorsement claims.
                </li>
                <li>
                    <strong>Hands-on testing strictly without editorial constraints:</strong> Manufacturer review units are accepted on an optional basis only, with zero conditions regarding our editorial findings or scores.
                </li>
                <li>
                    <strong>Commissions never dictate recommendations:</strong> Products with minimal or zero affiliate commissions are recommended whenever they represent the best value for readers.
                </li>
                <li>
                    <strong>Claims strictly adhere to evidence:</strong> If empirical data is limited, we transparently state that evidence is <em>moderate or limited</em> rather than making speculative claims.
                </li>
            </ol>
        </section>

        <!-- Three Functional Tiers -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-6">
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                Three Functional Tiers (Essentials / Select / Signature)
            </h2>
            <p class="text-sm text-stone-600 leading-relaxed">
                We categorize instruments into three contextual functional tiers rather than arbitrary social ranking:
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
                <div class="p-5 rounded-lg border border-emerald-200 bg-emerald-50/50 space-y-2">
                    <span class="inline-block px-2.5 py-0.5 rounded text-xs font-bold uppercase tracking-wider bg-emerald-100 text-emerald-800">Essentials</span>
                    <h3 class="font-serif-editorial text-lg font-bold text-stone-900">Core Utility, Controlled Cost</h3>
                    <p class="text-xs text-stone-600 leading-relaxed">
                        Meets fundamental functional requirements with minimal financial outlay. Perfect for getting started without paying for superfluous features.
                    </p>
                </div>

                <div class="p-5 rounded-lg border border-amber-200 bg-amber-50/50 space-y-2">
                    <span class="inline-block px-2.5 py-0.5 rounded text-xs font-bold uppercase tracking-wider bg-amber-100 text-amber-900">Select</span>
                    <h3 class="font-serif-editorial text-lg font-bold text-stone-900">Optimal Daily Balance</h3>
                    <p class="text-xs text-stone-600 leading-relaxed">
                        The sweet spot of performance, material durability, and daily ownership value. The most rational choice for most users.
                    </p>
                </div>

                <div class="p-5 rounded-lg border border-stone-800 bg-stone-900 text-white space-y-2">
                    <span class="inline-block px-2.5 py-0.5 rounded text-xs font-bold uppercase tracking-wider bg-stone-800 text-stone-100">Signature</span>
                    <h3 class="font-serif-editorial text-lg font-bold text-white">Specialized Capability</h3>
                    <p class="text-xs text-stone-300 leading-relaxed">
                        Refined ergonomics, stringent technical tolerances, or specialized capability engineered for intensive professional use.
                    </p>
                </div>
            </div>
        </section>

        <!-- 6-Step Research SOP -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-6">
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                6-Step Independent Research SOP
            </h2>
            <div class="space-y-4 text-sm text-stone-700">
                <div class="flex gap-4 items-start">
                    <span class="font-mono font-bold text-stone-400 text-base">01</span>
                    <div>
                        <strong class="text-stone-900 block">Problem & Boundary Definition:</strong>
                        <p class="text-stone-600">Clarify the user dilemma, realistic usage context, and budget parameters.</p>
                    </div>
                </div>
                <div class="flex gap-4 items-start">
                    <span class="font-mono font-bold text-stone-400 text-base">02</span>
                    <div>
                        <strong class="text-stone-900 block">Primary Data Gathering:</strong>
                        <p class="text-stone-600">Compile official manufacturer technical sheets, manuals, third-party benchmarks, and inspection timestamps.</p>
                    </div>
                </div>
                <div class="flex gap-4 items-start">
                    <span class="font-mono font-bold text-stone-400 text-base">03</span>
                    <div>
                        <strong class="text-stone-900 block">Side-by-Side Parameter Matrix:</strong>
                        <p class="text-stone-600">Benchmark 2–5 comparable instruments across specifications, total cost of ownership, and engineering trade-offs.</p>
                    </div>
                </div>
                <div class="flex gap-4 items-start">
                    <span class="font-mono font-bold text-stone-400 text-base">04</span>
                    <div>
                        <strong class="text-stone-900 block">Target Audience & Non-Purchase Criteria:</strong>
                        <p class="text-stone-600">Determine exactly who benefits, who should skip, and when the user should hold off on purchasing.</p>
                    </div>
                </div>
                <div class="flex gap-4 items-start">
                    <span class="font-mono font-bold text-stone-400 text-base">05</span>
                    <div>
                        <strong class="text-stone-900 block">Original Editorial Synthesis:</strong>
                        <p class="text-stone-600">Draft actionable buying guides highlighting empirical limitations alongside key strengths.</p>
                    </div>
                </div>
                <div class="flex gap-4 items-start">
                    <span class="font-mono font-bold text-stone-400 text-base">06</span>
                    <div>
                        <strong class="text-stone-900 block">Affiliate Verification & FTC Compliance:</strong>
                        <p class="text-stone-600">Verify official partner channels and ensure unambiguous affiliate disclosure.</p>
                    </div>
                </div>
            </div>
        </section>

        <x-disclosure-box method="online_research" :hasAffiliate="true" />

    </div>
</div>
@endsection
