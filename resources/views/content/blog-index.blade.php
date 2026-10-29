@extends('layouts.app')

@section('title', 'Research Articles & Buying Insights — Read2Buy.com')
@section('meta_description', 'Deep research articles, specification breakdowns, and analytical guides to inform your purchases.')

@section('content')
<div class="bg-[#faf8f5] py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="max-w-3xl space-y-4 mb-12">
            <span class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-widest text-amber-900 bg-amber-100 px-2.5 py-1 rounded border border-amber-300">
                Research Articles & Knowledge Base
            </span>
            <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold text-stone-900 tracking-tight leading-tight">
                Rational Insights for Informed Purchasing Decisions
            </h1>
            <p class="text-base text-stone-600 leading-relaxed font-light">
                Curated independent research, specification deconstructions, and consumer trade-off analysis without corporate bias. Designed as an objective, authoritative reference.
            </p>
        </div>

        <!-- Articles Grid -->
        @if($articles->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($articles as $article)
                    <article class="bg-white rounded-xl border border-stone-200/80 p-6 shadow-xs flex flex-col justify-between hover:shadow-sm transition-all group">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between text-xs text-stone-400 font-mono">
                                <span>{{ $article->category?->name ?? 'General Research' }}</span>
                                <time datetime="{{ $article->published_at?->toDateString() }}">
                                    {{ $article->published_at?->format('M d, Y') }}
                                </time>
                            </div>

                            <h2 class="font-serif-editorial text-xl font-bold text-stone-900 group-hover:text-amber-900 transition-colors leading-snug">
                                <a href="{{ route('blog.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </h2>

                            @if($article->excerpt)
                                <p class="text-xs text-stone-600 leading-relaxed line-clamp-3">
                                    {{ $article->excerpt }}
                                </p>
                            @endif
                        </div>

                        <div class="pt-6 border-t border-stone-100 flex items-center justify-between text-xs mt-6">
                            <span class="text-stone-400 font-mono">
                                {{ $article->reading_time_minutes ?? 5 }} min read
                            </span>
                            <a href="{{ route('blog.show', $article->slug) }}" class="font-semibold text-stone-900 group-hover:text-amber-800 transition-colors inline-flex items-center gap-1">
                                <span>Read Article</span>
                                <span>&rarr;</span>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $articles->links() }}
            </div>
        @else
            <div class="bg-white rounded-xl border border-stone-200 p-12 text-center text-stone-500">
                <p>No research articles published yet.</p>
            </div>
        @endif
    </div>
</div>
@endsection
