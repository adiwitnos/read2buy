@extends('layouts.app')

@section('title', 'Affiliate Disclosure & Editorial Independence — Read2Buy.com')
@section('meta_description', 'Official affiliate disclosure, editorial independence guidelines, and global affiliate compliance at Read2Buy.com.')

@section('content')
<article class="py-16 sm:py-24 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <header class="space-y-4">
            <span class="text-xs uppercase font-mono tracking-widest text-stone-500 font-semibold">
                Compliance & Integrity
            </span>
            <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold text-stone-900 leading-tight">
                Affiliate Disclosure
            </h1>
            <p class="text-xs text-stone-500 font-mono">
                Last Updated: October 2026 &bull; In Compliance with FTC Guidelines (16 CFR Part 255)
            </p>
        </header>

        <div class="prose prose-stone text-stone-700 leading-relaxed space-y-6 text-sm sm:text-base">
            <div class="p-6 bg-stone-50 rounded-xl border border-stone-200">
                <h3 class="font-serif-editorial text-lg font-bold text-stone-900 mb-2">
                    Executive Summary
                </h3>
                <p class="text-sm text-stone-700 leading-relaxed">
                    <strong>Read2Buy.com</strong> operates as an independent, reader-supported editorial publication and research desk. We participate in verified affiliate marketing programs (including Amazon Associates, authorized direct brand partner programs, and official merchant networks). When you click our outbound product links and make a qualified purchase, we may earn a modest commission at <strong>zero additional cost</strong> to you.
                </p>
            </div>

            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 pt-4">
                1. Complete Editorial Independence
            </h2>
            <p>
                Our product recommendations and buying decisions are strictly anchored in <strong>The Read2Buy Curation Standard</strong>:
            </p>
            <ul class="list-disc pl-6 space-y-2">
                <li>We never accept financial payment, sponsored placement fees, or gifts in exchange for favorable reviews or false high ratings.</li>
                <li>Commission rates never dictate product inclusion or ranking. A product with 0% commission will still be ranked #1 if it provides the highest value to our readers.</li>
                <li>When a product possesses notable drawbacks, ergonomic compromises, or poor longevity signals, we state them explicitly in our <em>Trade-offs</em> and <em>When to Skip</em> sections.</li>
            </ul>

            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 pt-4">
                2. Order Fulfillment, Payment & Warranties
            </h2>
            <p>
                <strong>Read2Buy.com</strong> is neither a direct retailer nor an e-commerce platform. We do not inventory merchandise, handle checkout payments, or process customer returns and shipments.
            </p>
            <p>
                All orders, transaction processing, invoice compliance, fulfillment, and manufacturer warranties are executed directly by the official merchant or authorized retail marketplace (such as Amazon, brand flagships, and certified e-commerce retailers).
            </p>

            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 pt-4">
                3. Outbound Link Standards & Search Transparency
            </h2>
            <p>
                In strict accordance with Google Search Central guidelines and international consumer protection standards, every outbound commercial and affiliate link on <strong>Read2Buy.com</strong> is tagged with standard relationship attributes:
            </p>
            <pre class="bg-stone-900 text-stone-200 p-4 rounded-lg text-xs font-mono">rel="nofollow sponsored noopener"</pre>
            <p>
                This ensures transparency for search crawlers, safeguards web link hygiene, and upholds ethical digital publishing practices.
            </p>

            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 pt-4">
                4. Contact Our Editorial Desk
            </h2>
            <p>
                If you have questions regarding our research methodology, wish to request technical specification corrections, or have compliance inquiries, please reach out directly to our editorial curators at <strong>editorial@read2buy.com</strong>.
            </p>
        </div>
    </div>
</article>
@endsection
