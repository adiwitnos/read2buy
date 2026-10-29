@props([
    'products' => collect(),
    'activeCategory' => null,
    'categories' => collect(),
])

@if($products->isNotEmpty())
@php
    // Extract all unique specification keys across all compared products
    $parameterKeys = [];
    foreach ($products as $prod) {
        if (!empty($prod->specifications) && is_array($prod->specifications)) {
            foreach (array_keys($prod->specifications) as $key) {
                if (!in_array($key, $parameterKeys, true)) {
                    $parameterKeys[] = $key;
                }
            }
        }
    }

    // Friendly labels for parameter rows
    $formatParamName = function(string $key): string {
        $labels = [
            'material' => 'Material & Build',
            'color_temperature' => 'Color Temperature',
            'illuminance' => 'Illuminance (Lux)',
            'power_input' => 'Power Consumption',
            'dimensions' => 'Dimensions',
            'dimensi' => 'Dimensions',
            'weight' => 'Weight',
            'thickness' => 'Thickness',
            'adjustment' => 'Angle / Height Adjustment',
            'compatibility' => 'Device Compatibility',
            'tipe' => 'Type & Primary Function',
            'kecepatan' => 'Operational Speed',
            'kapasitas_tinta' => 'Ink Volume / Capacity',
            'kapasitas_adf' => 'ADF Document Capacity',
            'konektivitas' => 'Connectivity & Ports',
            'resolusi_cetak' => 'Print Resolution',
            'kapasitas' => 'Storage Capacity',
            'bandwidth' => 'Bandwidth & Data',
            'domain' => 'Domain Policy',
            'email' => 'Email Hosting',
            'color' => 'Color Variants',
        ];

        return $labels[$key] ?? ucwords(str_replace('_', ' ', $key));
    };

    $productCount = $products->count();
    $colWidth = match($productCount) {
        2 => 'w-1/2 min-w-[280px]',
        3 => 'w-1/3 min-w-[270px]',
        default => 'w-1/4 min-w-[260px]',
    };
@endphp

<section id="komparasi-produk" class="py-20 bg-[#faf8f5] border-b border-stone-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-2">
            <div class="space-y-2 max-w-3xl">
                <span class="text-xs uppercase font-bold tracking-widest text-stone-500 inline-flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-stone-900"></span>
                    Objective Comparative Audit
                </span>
                <h2 class="font-serif-editorial text-3xl sm:text-4xl font-bold text-stone-900">
                    Side-by-Side Product Comparison
                </h2>
                <p class="text-base text-stone-600 font-light leading-relaxed">
                    Comparing {{ $productCount }} curated instruments in category <strong class="font-semibold text-stone-800">&ldquo;{{ $activeCategory->name ?? 'Curated' }}&rdquo;</strong> side-by-side: examine technical specifications, estimated price, verified strengths, and trade-offs before deciding.
                </p>
            </div>

            <div class="text-xs text-stone-500 font-mono shrink-0">
                <span>{{ $productCount }} Curated Products</span>
            </div>
        </div>

        <!-- Category Tabs Switcher -->
        @if($categories->count() > 1)
            <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-stone-200/60">
                <span class="text-xs text-stone-400 font-medium mr-1 uppercase tracking-wider">Category:</span>
                @foreach($categories as $categoryTab)
                    @php $isActive = $activeCategory && $activeCategory->id === $categoryTab->id; @endphp
                    <a href="{{ route('home', ['category' => $categoryTab->slug]) }}#komparasi-produk"
                       class="px-3.5 py-1.5 rounded-lg text-xs font-semibold uppercase tracking-wider transition-all {{ $isActive ? 'bg-stone-900 text-white shadow-xs' : 'bg-white text-stone-700 border border-stone-200 hover:bg-stone-100 hover:border-stone-300' }}">
                        {{ $categoryTab->name }}
                        <span class="text-[10px] ml-1 {{ $isActive ? 'text-stone-300' : 'text-stone-400' }}">({{ $categoryTab->products_count }})</span>
                    </a>
                @endforeach
            </div>
        @endif

        <!-- Comparison Table Container -->
        <div class="relative bg-white rounded-2xl border border-stone-200/90 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-left text-sm table-fixed">
                    <!-- Column Header: Product Cards (Sticky Row) -->
                    <thead>
                        <tr class="border-b border-stone-200 bg-stone-50/60">
                            <th scope="col" class="w-44 sm:w-56 sticky left-0 bg-stone-100/95 backdrop-blur-sm z-20 border-r border-stone-200 p-5 text-left align-bottom">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-stone-500 block">
                                    Criteria
                                </span>
                                <span class="font-serif-editorial text-base font-bold text-stone-900 block mt-1">
                                    Curated Instruments
                                </span>
                            </th>
                            @foreach($products as $product)
                                <th scope="col" class="{{ $colWidth }} p-5 align-top border-r border-stone-200/70 last:border-r-0">
                                    <div class="space-y-3">
                                        <!-- Image -->
                                        <div class="relative aspect-4/3 w-full bg-stone-100 rounded-lg overflow-hidden border border-stone-200/80 group">
                                            @if($product->primary_image)
                                                <img src="{{ $product->primary_image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" loading="lazy">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-stone-400 text-xs font-mono">
                                                    Photo in Curation
                                                </div>
                                            @endif

                                            @if($product->curationScore)
                                                <div class="absolute top-2.5 right-2.5 bg-stone-900/90 backdrop-blur-sm text-white text-[10px] font-semibold px-2 py-0.5 rounded-full shadow-xs flex items-center gap-1">
                                                    <span class="text-stone-400">Score</span>
                                                    <span class="font-serif-editorial font-bold">{{ number_format($product->curationScore->overall_score, 1) }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Brand & Title -->
                                        <div class="space-y-1">
                                            @if($product->brand)
                                                <span class="text-[10px] uppercase font-bold tracking-widest text-stone-400 block">
                                                    {{ $product->brand }}
                                                </span>
                                            @endif
                                            <h3 class="font-serif-editorial text-base sm:text-lg font-bold text-stone-900 leading-snug">
                                                <a href="{{ route('showroom.product', $product->slug) }}" class="hover:text-stone-600 transition-colors">
                                                    {{ $product->name }}
                                                </a>
                                            </h3>
                                            @if($product->tagline)
                                                <p class="text-xs text-stone-500 font-light line-clamp-2 leading-relaxed">
                                                    {{ $product->tagline }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-stone-200/70">
                        <!-- Parameter 1: Bookmark Button -->
                        <tr class="hover:bg-stone-50/50 transition-colors">
                            <th scope="row" class="sticky left-0 bg-stone-50/95 backdrop-blur-sm z-10 border-r border-stone-200 p-4 text-xs font-semibold uppercase tracking-wider text-stone-700 align-middle">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                    </svg>
                                    Bookmark
                                </span>
                            </th>
                            @foreach($products as $product)
                                <td class="p-4 align-middle border-r border-stone-200/70 last:border-r-0">
                                    @auth
                                        <form method="POST" action="{{ route('bookmark.toggle', $product->id) }}" class="w-full">
                                            @csrf
                                            @php $isBookmarked = auth()->user()->hasBookmarked($product); @endphp
                                            <button type="submit"
                                                    class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-semibold uppercase tracking-wider rounded-lg transition-colors border cursor-pointer {{ $isBookmarked ? 'bg-amber-100 text-amber-900 border-amber-300' : 'bg-white text-stone-700 border-stone-300 hover:bg-stone-50' }}">
                                                <svg class="w-4 h-4 {{ $isBookmarked ? 'text-amber-700 fill-amber-700' : 'text-stone-400' }}" fill="{{ $isBookmarked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                                </svg>
                                                <span>{{ $isBookmarked ? 'Saved (★)' : 'Save Bookmark' }}</span>
                                            </button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center gap-2 px-3 py-2 text-xs font-semibold uppercase tracking-wider rounded-lg transition-colors border bg-white text-stone-600 border-stone-300 hover:bg-stone-50">
                                            <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                            </svg>
                                            <span>Save Bookmark</span>
                                        </a>
                                    @endauth
                                </td>
                            @endforeach
                        </tr>

                        <!-- Parameter 2: Price -->
                        <tr class="hover:bg-stone-50/50 transition-colors">
                            <th scope="row" class="sticky left-0 bg-stone-50/95 backdrop-blur-sm z-10 border-r border-stone-200 p-4 text-xs font-semibold uppercase tracking-wider text-stone-700 align-top">
                                Estimated Price
                            </th>
                            @foreach($products as $product)
                                <td class="p-4 align-top border-r border-stone-200/70 last:border-r-0">
                                    <div class="space-y-0.5">
                                        <span class="font-mono text-base font-bold text-stone-900 block">
                                            @if($product->primaryAffiliateOffer && $product->primaryAffiliateOffer->price)
                                                ${{ number_format($product->primaryAffiliateOffer->price, 2) }}
                                            @elseif($product->estimated_price_min)
                                                ${{ number_format($product->estimated_price_min, 2) }}
                                            @else
                                                Check Retailer
                                            @endif
                                        </span>
                                        <span class="text-[10px] text-stone-400 block uppercase tracking-wider">
                                            {{ $product->primaryAffiliateOffer ? 'Verified Retailer' : 'Market Estimate' }}
                                        </span>
                                    </div>
                                </td>
                            @endforeach
                        </tr>

                        <!-- Parameter 3: Key Strengths (Pros) -->
                        <tr class="hover:bg-stone-50/50 transition-colors">
                            <th scope="row" class="sticky left-0 bg-stone-50/95 backdrop-blur-sm z-10 border-r border-stone-200 p-4 text-xs font-semibold uppercase tracking-wider text-stone-700 align-top">
                                <span class="flex items-center gap-1.5 text-emerald-800">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    Key Strengths
                                </span>
                            </th>
                            @foreach($products as $product)
                                @php
                                    $strengths = $product->primaryResearchNote->key_strengths
                                        ?? $product->curationScore->key_strengths
                                        ?? [];
                                @endphp
                                <td class="p-4 align-top border-r border-stone-200/70 last:border-r-0">
                                    @if(!empty($strengths))
                                        <ul class="space-y-2">
                                            @foreach($strengths as $strength)
                                                <li class="flex items-start gap-2 text-xs text-stone-700 leading-relaxed">
                                                    <span class="w-4 h-4 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5 font-bold text-[10px]">✓</span>
                                                    <span>{{ $strength }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-stone-300 font-mono text-xs">—</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>

                        <!-- Parameter 4: Limitations & Trade-offs (Cons) -->
                        <tr class="hover:bg-stone-50/50 transition-colors">
                            <th scope="row" class="sticky left-0 bg-stone-50/95 backdrop-blur-sm z-10 border-r border-stone-200 p-4 text-xs font-semibold uppercase tracking-wider text-stone-700 align-top">
                                <span class="flex items-center gap-1.5 text-amber-800">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    Limitations & Trade-offs
                                </span>
                            </th>
                            @foreach($products as $product)
                                @php
                                    $limitations = $product->primaryResearchNote->limitations
                                        ?? $product->curationScore->trade_offs
                                        ?? [];
                                @endphp
                                <td class="p-4 align-top border-r border-stone-200/70 last:border-r-0">
                                    @if(!empty($limitations))
                                        <ul class="space-y-2">
                                            @foreach($limitations as $limitation)
                                                <li class="flex items-start gap-2 text-xs text-stone-700 leading-relaxed">
                                                    <span class="w-4 h-4 rounded-full bg-amber-100 text-amber-800 flex items-center justify-center shrink-0 mt-0.5 font-bold text-[10px]">!</span>
                                                    <span>{{ $limitation }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-stone-300 font-mono text-xs">—</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>

                        <!-- Parameter 5: Best Suited For -->
                        <tr class="hover:bg-stone-50/50 transition-colors">
                            <th scope="row" class="sticky left-0 bg-stone-50/95 backdrop-blur-sm z-10 border-r border-stone-200 p-4 text-xs font-semibold uppercase tracking-wider text-stone-700 align-top">
                                Best Suited For
                            </th>
                            @foreach($products as $product)
                                @php
                                    $usefulFor = $product->primaryResearchNote->useful_for
                                        ?? $product->curationScore->ideal_for
                                        ?? null;
                                @endphp
                                <td class="p-4 align-top border-r border-stone-200/70 last:border-r-0">
                                    @if($usefulFor)
                                        <div class="bg-[#faf8f5] p-3 rounded-lg border border-stone-200/80">
                                            <p class="text-xs text-stone-700 leading-relaxed">
                                                {{ $usefulFor }}
                                            </p>
                                        </div>
                                    @else
                                        <span class="text-stone-300 font-mono text-xs">—</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>

                        <!-- Parameter 6+: Technical Specifications -->
                        @foreach($parameterKeys as $paramKey)
                            <tr class="hover:bg-stone-50/50 transition-colors">
                                <th scope="row" class="sticky left-0 bg-stone-50/95 backdrop-blur-sm z-10 border-r border-stone-200 p-4 text-xs font-semibold uppercase tracking-wider text-stone-700 align-top">
                                    {{ $formatParamName($paramKey) }}
                                </th>
                                @foreach($products as $product)
                                    <td class="p-4 align-top border-r border-stone-200/70 last:border-r-0">
                                        @if(!empty($product->specifications[$paramKey]))
                                            <span class="font-mono text-xs font-semibold text-stone-900 block leading-relaxed">
                                                {{ $product->specifications[$paramKey] }}
                                            </span>
                                        @else
                                            <span class="text-stone-300 font-mono text-xs">—</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach

                        <!-- Parameter: Editorial Verdict -->
                        <tr class="hover:bg-stone-50/50 transition-colors">
                            <th scope="row" class="sticky left-0 bg-stone-50/95 backdrop-blur-sm z-10 border-r border-stone-200 p-4 text-xs font-semibold uppercase tracking-wider text-stone-700 align-top">
                                Editorial Verdict
                            </th>
                            @foreach($products as $product)
                                @php
                                    $verdict = $product->primaryResearchNote->verdict
                                        ?? $product->curationScore->verdict
                                        ?? null;
                                @endphp
                                <td class="p-4 align-top border-r border-stone-200/70 last:border-r-0">
                                    @if($verdict)
                                        <p class="text-xs text-stone-600 italic leading-relaxed">
                                            &ldquo;{{ $verdict }}&rdquo;
                                        </p>
                                    @else
                                        <span class="text-stone-300 font-mono text-xs">—</span>
                                    @endif
                                </td>
                            @endforeach
                        </tr>

                        <!-- Parameter: Action Links -->
                        <tr class="bg-stone-50/70">
                            <th scope="row" class="sticky left-0 bg-stone-100/95 backdrop-blur-sm z-10 border-r border-stone-200 p-4 text-xs font-semibold uppercase tracking-wider text-stone-700 align-middle">
                                Actions
                            </th>
                            @foreach($products as $product)
                                <td class="p-4 align-middle border-r border-stone-200/70 last:border-r-0">
                                    <div class="space-y-2">
                                        <a href="{{ route('showroom.product', $product->slug) }}"
                                           class="inline-flex items-center justify-center w-full px-3.5 py-2 text-xs font-semibold uppercase tracking-wider text-stone-800 bg-white hover:bg-stone-100 rounded-lg border border-stone-200 transition-colors shadow-2xs">
                                            <span>Review Details &rarr;</span>
                                        </a>

                                        @if($product->primaryAffiliateOffer)
                                            <a href="{{ route('affiliate.out', $product->primaryAffiliateOffer->id) }}"
                                               target="_blank"
                                               rel="sponsored noopener"
                                               class="inline-flex items-center justify-center w-full px-3.5 py-2 bg-stone-900 text-white rounded-lg text-xs font-semibold uppercase tracking-wider hover:bg-stone-800 transition-colors shadow-xs">
                                                <span>Check Price & Store</span>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endif
