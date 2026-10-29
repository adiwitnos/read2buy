@extends('layouts.app')

@section('title', 'Editorial Policy & Research Integrity — Read2Buy.com')
@section('meta_description', 'Editorial independence principles, our $0 review policy, manufacturer sample guidelines, and technical correction standards at Read2Buy.com.')

@section('content')
<div class="bg-white border-b border-stone-200/80 py-16 sm:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-stone-100 text-stone-800 text-xs uppercase tracking-widest font-semibold border border-stone-200">
            <span class="w-1.5 h-1.5 rounded-full bg-stone-900"></span>
            Journalistic Standards & Ethics
        </div>
        <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold tracking-tight text-stone-900">
            Editorial Policy
        </h1>
        <p class="text-lg text-stone-600 font-light leading-relaxed">
            Operating principles protecting editorial independence, candid consumer guidance, and respectful dialogue with quality manufacturers.
        </p>
    </div>
</div>

<div class="py-16 bg-[#faf8f5]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- 1. Absolute Separation -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-6">
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                1. Absolute Separation Between Editorial & Commercials
            </h2>
            <p class="text-sm sm:text-base text-stone-700 leading-relaxed">
                Our decision to recommend a product is never influenced by affiliate commission rates. If a product with a 0% commission is the most sensible, durable, and value-packed choice for our readers, it remains our top recommendation. Our editorial research team operates with zero sales quotas or commercial conversion targets.
            </p>
        </section>

        <!-- 2. Manufacturer Sample Policy -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-6">
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                2. Manufacturer Sample Unit Guidelines
            </h2>
            <div class="space-y-4 text-sm sm:text-base text-stone-700 leading-relaxed">
                <p>
                    For verified manufacturers and brand owners wishing to submit items for Read2Buy evaluation:
                </p>
                <ul class="list-disc pl-6 space-y-2 text-stone-600">
                    <li><strong>No Paid Reviews:</strong> We strictly reject financial compensation for publishing reviews or granting favorable tier statuses.</li>
                    <li><strong>Unconditional Samples:</strong> Physical review samples provided to our desk are treated purely as functional research material. Brands hold no preview rights, editorial veto power, or ability to suppress critical observations.</li>
                    <li><strong>Mandatory Disclosure:</strong> If a guide features a complimentary unit provided by a manufacturer, this relationship is explicitly stated at the outset of the article.</li>
                </ul>
            </div>
        </section>

        <!-- 3. Primary Online Research -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-6">
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                3. Honest Research Without False Pretenses ($0 Review Budget)
            </h2>
            <p class="text-sm sm:text-base text-stone-700 leading-relaxed">
                We refuse to pretend we purchased every large consumer good out-of-pocket or tested hundreds of heavy appliances for years in secret. The foundation of our analysis relies on <strong>primary online technical research</strong>: scrutinizing factory datasheets, material certifications (ISO, UL, CE, ANSI/BIFMA), exploded component schematics, authorized distributor warranties, and hundreds of verified long-term consumer failure reports.
            </p>
        </section>

        <!-- 4. The 5 Evaluation Questions Framework -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-6">
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                4. The 5 Core Evaluation Questions
            </h2>
            <p class="text-sm text-stone-600">
                Every curated product assessment must definitively answer these five rigorous questions:
            </p>
            <ol class="space-y-3 text-sm text-stone-700 list-decimal list-inside leading-relaxed">
                <li><strong>Who is this truly for?</strong> Identifying the precise user persona whose pain point is genuinely solved.</li>
                <li><strong>Is the price justifiable?</strong> Measuring whether material quality and engineering merit match the retail price point.</li>
                <li><strong>What are the verifiable strengths?</strong> Spotlighting tested mechanical and functional advantages, not advertising slogans.</li>
                <li><strong>What are the genuine compromises?</strong> Exposing design limitations, missing adjustments, and maintenance trade-offs.</li>
                <li><strong>When should readers skip purchasing?</strong> Recommending non-buying alternatives, repairs, or free workarounds whenever that represents the wisest choice.</li>
            </ol>
        </section>

        <!-- 5. Corrections & Right of Reply -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-6">
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                5. Technical Corrections & Manufacturer Right of Reply
            </h2>
            <p class="text-sm sm:text-base text-stone-700 leading-relaxed">
                We hold technical accuracy to the highest standard. If an engineer, manufacturer, or reader identifies an outdated component spec, revised warranty period, or new batch update, please forward verifiable documentation to our desk. Our editorial team investigates and updates active publications promptly.
            </p>
        </section>

    </div>
</div>
@endsection
