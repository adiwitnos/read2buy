@extends('layouts.app')

@section('title', $story->meta_title ?? ($story->title . ' — Read2Buy'))
@section('meta_description', $story->meta_description ?? ($story->excerpt ?? 'Consumer narrative series by Read2Buy.'))

@section('content')
<article class="bg-[#faf8f5] pb-24">
    <header class="bg-white border-b border-stone-200/80 pt-16 pb-16">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-wrap items-center gap-3 text-xs">
                <span class="px-3 py-1 bg-amber-50 text-amber-900 border border-amber-200 rounded-full font-semibold uppercase tracking-wider text-[10px]">
                    Consumer Narrative Series
                </span>
                <span class="text-stone-400">&bull;</span>
                <span class="text-stone-500 font-mono">{{ $story->reading_time_minutes }} min read</span>
                <span class="text-stone-400">&bull;</span>
                <span class="text-stone-500">{{ $story->published_at ? $story->published_at->format('M d, Y') : 'Draft' }}</span>
            </div>

            <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold tracking-tight text-stone-900 leading-[1.2]">
                {{ $story->title }}
            </h1>

            @if($story->headline)
                <p class="text-lg sm:text-xl text-stone-700 font-light leading-relaxed">
                    {{ $story->headline }}
                </p>
            @endif

            <!-- Disclosure of Narrative Label & Editorial Integrity -->
            <div class="p-4 bg-stone-50 rounded-xl border border-stone-200 text-xs text-stone-600 space-y-1">
                <p>
                    <strong class="text-stone-900">Editorial Note:</strong> This narrative illustration reflects real-world dynamics to contextualize purchasing trade-offs. Products and engineering specifications are independently verified.
                </p>
            </div>
        </div>
    </header>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 space-y-12">
        <!-- Story Body -->
        <div class="bg-white rounded-xl border border-stone-200/80 p-8 sm:p-12 shadow-xs prose prose-stone max-w-none text-stone-800 leading-relaxed text-base sm:text-lg font-serif">
            {!! nl2br(e($story->body)) !!}
        </div>

        <!-- Curated Products Appearing in Story Context -->
        @if($story->products->isNotEmpty())
            <section class="bg-white rounded-xl border border-stone-200/90 p-6 sm:p-8 space-y-6 shadow-xs">
                <div class="border-b border-stone-100 pb-3">
                    <span class="text-[10px] uppercase font-bold tracking-widest text-stone-400">Contextual Instruments</span>
                    <h3 class="font-serif-editorial text-xl font-bold text-stone-900">
                        Practical Choices Featured in This Story
                    </h3>
                </div>

                <div class="space-y-4">
                    @foreach($story->products as $product)
                        <div class="p-4 bg-stone-50 rounded-lg border border-stone-200/70 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <span class="text-xs uppercase font-semibold text-stone-500">{{ $product->brand }}</span>
                                    @if($product->pivot->tier)
                                        <x-tier-badge :tier="$product->pivot->tier" />
                                    @endif
                                </div>
                                <h4 class="font-serif-editorial text-base font-bold text-stone-900">
                                    <a href="{{ route('showroom.product', $product->slug) }}" class="hover:underline">
                                        {{ $product->name }}
                                    </a>
                                </h4>
                                @if($product->pivot->curation_reason)
                                    <p class="text-xs text-stone-600 italic">
                                        &ldquo;{{ $product->pivot->curation_reason }}&rdquo;
                                    </p>
                                @endif
                            </div>

                            @if($product->primaryAffiliateOffer)
                                <div class="shrink-0">
                                    <a href="{{ route('affiliate.out', $product->primaryAffiliateOffer->id) }}" target="_blank" rel="sponsored noopener" class="inline-flex items-center gap-1.5 px-4 py-2 bg-stone-900 text-white text-xs uppercase font-semibold tracking-wider rounded-lg hover:bg-stone-800 transition-colors">
                                        <span>Check Offer</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Standard Disclosure Box -->
        <x-disclosure-box method="online_research" :hasAffiliate="true" />
    </div>
</article>
@endsection
