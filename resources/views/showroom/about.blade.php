@extends('layouts.app')

@section('title', 'About Read2Buy — Informed Choices for Every Purchase')
@section('meta_description', 'Read before you buy. Research-backed product curation and buying guides.')

@section('content')
<div class="bg-white border-b border-stone-200/80 py-16 sm:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-stone-100 text-stone-800 text-xs uppercase tracking-widest font-semibold border border-stone-200">
            <span class="w-1.5 h-1.5 rounded-full bg-stone-900"></span>
            Editorial Manifesto
        </div>
        <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold tracking-tight text-stone-900">
            Read2Buy — Informed Choices for Every Purchase
        </h1>
        <p class="text-xl text-stone-600 font-light leading-relaxed">
            Empowering consumers to read carefully and buy with confidence.
        </p>
    </div>
</div>

<div class="py-16 bg-[#faf8f5]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-12 shadow-xs space-y-6">
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                The Read2Buy Philosophy
            </h2>

            <div class="prose prose-stone text-stone-700 leading-relaxed space-y-4 text-base">
                <p>
                    Modern shopping has become an overwhelming sea of sponsored placements, hype cycles, and superficial unboxings. <strong>Read2Buy</strong> was created on a straightforward premise: <em>read before you buy</em>. The most valuable purchase is the one that genuinely solves your problem without unnecessary financial strain.
                </p>

                <div class="my-6 p-6 bg-stone-50 rounded-xl border border-stone-200/90 space-y-2">
                    <p class="text-xs uppercase font-mono tracking-wider text-rose-700 font-semibold line-through">
                        Not our message: &ldquo;Buy this product to chase status or fleeting trends.&rdquo;
                    </p>
                    <p class="text-sm uppercase font-mono tracking-wider text-emerald-800 font-bold">
                        Our message: &ldquo;Choose what genuinely serves the life and work you are building.&rdquo;
                    </p>
                </div>

                <p>
                    Read2Buy serves as an independent curation and buying guide desk. We dissect real customer challenges, audit official engineering specifications, calculate long-term ownership costs, and categorize choices into transparent tiers: <em>Essentials</em>, <em>Select</em>, and <em>Signature</em>.
                </p>

                <p>
                    In fact, repairing what you already own or delaying an upgrade is frequently the most responsible conclusion we advocate.
                </p>
            </div>
        </section>

        <!-- Focus Areas -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-6">
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                Core Editorial Focus
            </h2>
            <p class="text-sm text-stone-600 leading-relaxed">
                We concentrate on essential tools that directly shape daily productivity and life choices:
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
                <div class="p-5 bg-stone-50 rounded-lg space-y-2 border border-stone-200/60">
                    <span class="text-xs font-mono font-bold text-stone-400">01 / STUDY & LEARNING</span>
                    <h3 class="font-serif-editorial text-base font-bold text-stone-900">Study Tools & Reading</h3>
                    <p class="text-xs text-stone-600 leading-relaxed">Curated books, document workflows, and study gear with disciplined budgets.</p>
                </div>
                <div class="p-5 bg-stone-50 rounded-lg space-y-2 border border-stone-200/60">
                    <span class="text-xs font-mono font-bold text-stone-400">02 / WORK & CRAFT</span>
                    <h3 class="font-serif-editorial text-base font-bold text-stone-900">Workspace & Productivity</h3>
                    <p class="text-xs text-stone-600 leading-relaxed">Precision task lighting, ergonomic monitor stands, and daily workspace instruments.</p>
                </div>
                <div class="p-5 bg-stone-50 rounded-lg space-y-2 border border-stone-200/60">
                    <span class="text-xs font-mono font-bold text-stone-400">03 / CREATORS & VENTURES</span>
                    <h3 class="font-serif-editorial text-base font-bold text-stone-900">Lean Digital Tools</h3>
                    <p class="text-xs text-stone-600 leading-relaxed">Reliable hosting, domain platforms, and business hardware for modern creators.</p>
                </div>
            </div>
        </section>

        <!-- Relations with Brands & Manufacturers -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-4">
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                For Brands & Manufacturers
            </h2>
            <p class="text-sm text-stone-700 leading-relaxed">
                We welcome manufacturers dedicated to quality craftsmanship. We invite brands to clarify technical documentation, share independent lab testing results, or submit sample units for evaluation under our strict editorial independence guidelines.
            </p>
            <div class="pt-2">
                <a href="{{ route('contact') }}" class="text-xs uppercase font-semibold text-stone-900 hover:text-stone-700 underline">
                    Contact Our Partnership Desk &rarr;
                </a>
            </div>
        </section>

        <x-disclosure-box method="online_research" :hasAffiliate="true" />

    </div>
</div>
@endsection
