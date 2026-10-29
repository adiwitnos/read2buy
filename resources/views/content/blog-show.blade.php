@extends('layouts.app')

@section('title', ($article->meta_title ?? $article->title) . ' — Read2Buy.com')
@section('meta_description', $article->meta_description ?? ($article->excerpt ?? 'In-depth research article by Read2Buy.'))

@push('meta')
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ route('blog.show', $article->slug) }}">

    <!-- Open Graph (SEO/Social) -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $article->meta_title ?? $article->title }}">
    <meta property="og:description" content="{{ $article->meta_description ?? ($article->excerpt ?? '') }}">
    <meta property="og:url" content="{{ route('blog.show', $article->slug) }}">
    <meta property="og:site_name" content="Read2Buy.com">
    <meta property="article:published_time" content="{{ $article->published_at?->toIso8601String() }}">

    <!-- Structured Data JSON-LD (SEO, AEO, GEO) -->
    <script type="application/ld+json">
    {!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => $article->title,
        'description' => $article->excerpt ?? $article->meta_description,
        'datePublished' => $article->published_at?->toIso8601String(),
        'dateModified' => $article->updated_at->toIso8601String(),
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => route('blog.show', $article->slug),
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Read2Buy.com',
            'url' => url('/'),
        ],
        'author' => [
            '@type' => 'Organization',
            'name' => 'Read2Buy Editorial Desk',
            'url' => route('showroom.curation-standards'),
        ],
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')
<article class="bg-[#faf8f5] py-12 sm:py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center gap-2 text-xs text-stone-500 font-mono" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-stone-900">Home</a>
            <span>/</span>
            <a href="{{ route('blog.index') }}" class="hover:text-stone-900">Blog & Research</a>
            <span>/</span>
            <span class="text-stone-900 truncate">{{ $article->category?->name ?? 'Research' }}</span>
        </nav>

        <!-- Article Header -->
        <header class="space-y-4">
            <div class="flex items-center gap-3 text-xs">
                <span class="px-2.5 py-0.5 rounded text-[10px] font-bold uppercase tracking-widest bg-amber-100 text-amber-900 border border-amber-300">
                    {{ $article->category?->name ?? 'Independent Research' }}
                </span>
                <span class="text-stone-400 font-mono">•</span>
                <time datetime="{{ $article->published_at?->toDateString() }}" class="text-stone-500 font-mono">
                    {{ $article->published_at?->format('M d, Y') }}
                </time>
                <span class="text-stone-400 font-mono">•</span>
                <span class="text-stone-500 font-mono">{{ $article->reading_time_minutes ?? 5 }} min read</span>
            </div>

            <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold text-stone-900 tracking-tight leading-[1.2]">
                {{ $article->title }}
            </h1>

            @if($article->headline)
                <p class="text-lg text-stone-600 font-light leading-relaxed">
                    {{ $article->headline }}
                </p>
            @endif
        </header>

        <!-- Quick Answer / Executive Takeaway Box -->
        @if($article->excerpt)
            <section class="bg-amber-50/70 border-l-4 border-amber-600 rounded-r-xl p-5 sm:p-6 shadow-xs space-y-2">
                <div class="flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-amber-900 font-mono">
                    <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Executive Summary & Direct Answer</span>
                </div>
                <p class="text-sm text-stone-800 leading-relaxed font-medium">
                    {{ $article->excerpt }}
                </p>
            </section>
        @endif

        <!-- Article Body -->
        <div class="bg-white rounded-xl border border-stone-200/80 p-6 sm:p-10 shadow-xs space-y-6 text-stone-800 leading-relaxed text-base prose prose-stone max-w-none">
            {!! nl2br(e($article->body)) !!}
        </div>

        <!-- Curated Products Mentioned in this Article -->
        @if($article->products->isNotEmpty())
            <section class="bg-white rounded-xl border border-stone-200/80 p-6 sm:p-8 shadow-xs space-y-4">
                <h3 class="font-serif-editorial text-xl font-bold text-stone-900">
                    Curated Instruments Featured in this Research
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    @foreach($article->products as $product)
                        <div class="p-4 rounded-lg bg-stone-50 border border-stone-200 flex items-center justify-between gap-3">
                            <div>
                                <span class="text-[10px] font-mono uppercase text-stone-400 block">{{ $product->brand }}</span>
                                <h4 class="font-bold text-sm text-stone-900 hover:text-amber-800">
                                    <a href="{{ route('showroom.product', $product->slug) }}">{{ $product->name }}</a>
                                </h4>
                            </div>
                            <a href="{{ route('showroom.product', $product->slug) }}" class="text-xs font-semibold text-stone-800 hover:text-stone-950 underline shrink-0">
                                Review &rarr;
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Editorial Disclosure Notice -->
        <footer class="pt-6 border-t border-stone-200/80 text-xs text-stone-500 leading-relaxed space-y-2">
            <p>
                <strong>Editorial Transparency:</strong> All Read2Buy research articles are authored independently without brand sponsorships or paid review arrangements. If you make a purchase through our partner links, we may earn an affiliate commission at zero additional cost to you.
            </p>
            <p>
                <a href="{{ route('legal.editorial-policy') }}" class="underline hover:text-stone-800">Editorial Policy</a> &bull;
                <a href="{{ route('legal.affiliate-disclosure') }}" class="underline hover:text-stone-800">Affiliate Disclosure</a> &bull;
                <a href="{{ route('blog.index') }}" class="underline hover:text-stone-800">All Research Articles</a>
            </p>
        </footer>
    </div>
</article>
@endsection
