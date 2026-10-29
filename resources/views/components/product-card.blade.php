@props(['product'])

<article class="group bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-sm hover:shadow-md hover:border-stone-300 transition-all duration-300 flex flex-col h-full">
    <!-- Image Header with Score Overlay -->
    <div class="relative aspect-4/3 bg-stone-100 overflow-hidden">
        @if($product->primary_image)
            <img src="{{ $product->primary_image }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500" loading="lazy">
        @else
            <div class="w-full h-full flex items-center justify-center text-stone-400 bg-stone-100">
                <span class="text-xs uppercase tracking-widest font-mono">Photo in Curation</span>
            </div>
        @endif

        <!-- Floating Score Badge -->
        @if($product->curationScore)
            <div class="absolute top-3 right-3 bg-stone-900/90 backdrop-blur-md text-white text-xs font-semibold px-2.5 py-1 rounded-full shadow-sm flex items-center gap-1">
                <span class="text-[10px] text-stone-400 uppercase tracking-wider">Score</span>
                <span class="font-serif-editorial text-sm font-bold text-white">{{ number_format($product->curationScore->overall_score, 1) }}</span>
            </div>
        @endif

        <!-- Category Badge -->
        <div class="absolute bottom-3 left-3 bg-white/95 backdrop-blur-sm text-stone-800 text-[10px] uppercase tracking-wider font-semibold px-2 py-0.5 rounded shadow-xs">
            {{ $product->category->name }}
        </div>
    </div>

    <!-- Body Information -->
    <div class="p-5 flex-grow flex flex-col justify-between space-y-4">
        <div class="space-y-1.5">
            @if($product->brand)
                <span class="text-xs uppercase font-medium tracking-widest text-stone-400 block">
                    {{ $product->brand }}
                </span>
            @endif

            <h3 class="font-serif-editorial text-lg font-bold text-stone-900 group-hover:text-stone-700 transition-colors line-clamp-1">
                <a href="{{ route('showroom.product', $product->slug) }}">
                    {{ $product->name }}
                </a>
            </h3>

            @if($product->tagline)
                <p class="text-xs text-stone-600 line-clamp-2 leading-relaxed">
                    {{ $product->tagline }}
                </p>
            @endif
        </div>

        <!-- Footer: Price & Action -->
        <div class="pt-4 border-t border-stone-100 flex items-center justify-between">
            <div>
                <span class="text-[10px] uppercase tracking-wider text-stone-400 block font-medium">Estimated Price</span>
                <span class="text-xs font-semibold text-stone-900 font-mono">
                    @if($product->primaryAffiliateOffer && $product->primaryAffiliateOffer->price)
                        ${{ number_format($product->primaryAffiliateOffer->price, 2) }}
                    @elseif($product->estimated_price_min)
                        ${{ number_format($product->estimated_price_min, 2) }}
                    @else
                        Check Retailer
                    @endif
                </span>
            </div>

            <a href="{{ route('showroom.product', $product->slug) }}" class="inline-flex items-center gap-1 text-xs font-medium text-stone-900 hover:text-stone-600 transition-colors group/link">
                <span>Review Details</span>
                <svg class="w-3.5 h-3.5 group-hover/link:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</article>
