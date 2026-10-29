@extends('layouts.app')

@section('title', 'Frequently Asked Questions (FAQ) — Read2Buy.com')
@section('meta_description', 'Direct, straightforward answers for consumers and manufacturers regarding how Read2Buy works, our research methodology, and editorial ethics.')

@section('content')
<div class="bg-white border-b border-stone-200/80 py-16 sm:py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-stone-100 text-stone-800 text-xs uppercase tracking-widest font-semibold border border-stone-200">
            <span class="w-1.5 h-1.5 rounded-full bg-stone-900"></span>
            Information Center
        </div>
        <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold tracking-tight text-stone-900">
            Frequently Asked Questions
        </h1>
        <p class="text-lg text-stone-600 font-light leading-relaxed">
            Unfiltered, transparent answers for conscious consumers and brand manufacturers.
        </p>
    </div>
</div>

<div class="py-16 bg-[#faf8f5]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">

        <!-- Section 1: For Consumers / Readers -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-8">
            <div class="border-b border-stone-200/80 pb-4">
                <span class="text-xs uppercase font-bold tracking-widest text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded border border-emerald-200 inline-block mb-2">
                    For Consumers & Readers
                </span>
                <h2 class="font-serif-editorial text-2xl font-bold text-stone-900">
                    Making Conscious Decisions & Navigating Curation
                </h2>
            </div>

            <div class="space-y-6 divide-y divide-stone-100">
                <div class="pt-4 first:pt-0 space-y-2">
                    <h3 class="font-serif-editorial text-lg font-bold text-stone-900">
                        Does Read2Buy sell products directly or function as an online retailer?
                    </h3>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        No. Read2Buy is an independent research and editorial publication. We do not maintain warehouses, process payments, or handle parcels. When you click to purchase, you are securely transferred directly to authorized brand stores or verified retail marketplaces (such as Amazon or official brand storefronts).
                    </p>
                </div>

                <div class="pt-6 space-y-2">
                    <h3 class="font-serif-editorial text-lg font-bold text-stone-900">
                        Do products cost more if I buy through links on Read2Buy?
                    </h3>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        Never. You pay the exact same retail price as navigating directly to the merchant. Applicable store coupons, free shipping vouchers, and customer loyalty points remain 100% active. We receive a modest referral commission from the seller platform at no cost to you.
                    </p>
                </div>

                <div class="pt-6 space-y-2">
                    <h3 class="font-serif-editorial text-lg font-bold text-stone-900">
                        Does Read2Buy purchase and physically test every single item reviewed?
                    </h3>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        In full transparency: no. Our procurement budget for speculative product purchases is <strong>$0</strong>. We reject the deceptive pretense of having personally owned hundreds of large items for years. We operate as an analytical research desk: dissecting manufacturer datasheets, engineering schematics, material certifications, warranty claim histories, and extensive real-world user defect reports.
                    </p>
                </div>

                <div class="pt-6 space-y-2">
                    <h3 class="font-serif-editorial text-lg font-bold text-stone-900">
                        Why do some guides advise readers NOT to buy anything at all?
                    </h3>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        Because often the most sound financial and environmental decision is to maintain existing equipment, repair what you have, or leverage free alternatives. We prioritize your real-world well-being over affiliate commissions.
                    </p>
                </div>
            </div>
        </section>

        <!-- Section 2: For Manufacturers & Brand Owners -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-10 shadow-xs space-y-8">
            <div class="border-b border-stone-200/80 pb-4">
                <span class="text-xs uppercase font-bold tracking-widest text-amber-900 bg-amber-50 px-2.5 py-1 rounded border border-amber-200 inline-block mb-2">
                    For Manufacturers & Brands
                </span>
                <h2 class="font-serif-editorial text-2xl font-bold text-stone-900">
                    Editorial Standards & Evaluation Samples
                </h2>
            </div>

            <div class="space-y-6 divide-y divide-stone-100">
                <div class="pt-4 first:pt-0 space-y-2">
                    <h3 class="font-serif-editorial text-lg font-bold text-stone-900">
                        Can brands pay for a positive review or guaranteed top ranking?
                    </h3>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        <strong>Under no circumstances.</strong> We never sell editorial conclusions or rating scores. Our tier placements (Essentials, Select, Signature) are strictly determined by technical merits, build quality, price-to-performance ratio, and verifiable public data.
                    </p>
                </div>

                <div class="pt-6 space-y-2">
                    <h3 class="font-serif-editorial text-lg font-bold text-stone-900">
                        How can a product be considered for Read2Buy curation?
                    </h3>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        Products are proactively selected by our editorial curators based on genuine consumer challenges (e.g., compact workspace ergonomics, reliable creator tools, or durable home essentials). Official manufacturers may also submit technical documentation and certified testing data via our contact desk.
                    </p>
                </div>

                <div class="pt-6 space-y-2">
                    <h3 class="font-serif-editorial text-lg font-bold text-stone-900">
                        May manufacturers provide complimentary review sample units?
                    </h3>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        Yes, provided samples are offered without any preconditions or editorial oversight. If a product exhibits flaws, weak points, or ergonomic compromises, our curators remain duty-bound to detail them clearly for our readers.
                    </p>
                </div>

                <div class="pt-6 space-y-2">
                    <h3 class="font-serif-editorial text-lg font-bold text-stone-900">
                        Do outbound links adhere to international advertising and web standards?
                    </h3>
                    <p class="text-sm text-stone-600 leading-relaxed">
                        Yes. We strictly utilize approved affiliate networks, avoid deceptive link cloaking, and mark all commercial hyperlinks with standard <code>rel="sponsored noopener"</code> attributes in accordance with Google Webmaster directives and consumer protection standards.
                    </p>
                </div>
            </div>
        </section>

        <!-- CTA Contact Desk -->
        <div class="text-center bg-stone-100 rounded-xl p-8 border border-stone-200 space-y-3">
            <h3 class="font-serif-editorial text-xl font-bold text-stone-900">Have a Specific Question?</h3>
            <p class="text-xs sm:text-sm text-stone-600 max-w-lg mx-auto leading-relaxed">
                Our editorial team welcomes technical specification clarifications from manufacturers as well as real-world durability feedback from readers.
            </p>
            <div class="pt-2">
                <a href="{{ route('contact') }}" class="inline-block px-5 py-2.5 bg-stone-900 text-white rounded text-xs uppercase font-semibold hover:bg-stone-800 transition-colors shadow-xs">
                    Contact Editorial Desk &rarr;
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
