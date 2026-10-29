@extends('layouts.app')

@section('title', 'Practical Buying Guides & Comparisons — Read2Buy')
@section('meta_description', 'Rational buying guides and comparisons grounded in independent research to inform your purchasing decisions.')

@section('content')
<div class="py-12 sm:py-16 bg-white border-b border-stone-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-stone-100 text-stone-800 text-xs uppercase tracking-widest font-semibold border border-stone-200">
                <span class="w-1.5 h-1.5 rounded-full bg-stone-900"></span>
                Problem-Led Architecture
            </div>

            <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold tracking-tight text-stone-900">
                Practical Buying Guides
            </h1>

            <p class="text-base sm:text-lg text-stone-600 font-light leading-relaxed">
                Clear, measured answers to real purchasing dilemmas. We audit official specifications, calculate total cost of ownership, and structure choices across <strong>Essentials</strong>, <strong>Select</strong>, and <strong>Signature</strong> tiers without exaggerated claims.
            </p>
        </div>
    </div>
</div>

<div class="py-12 sm:py-16 bg-[#faf8f5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($guides->isEmpty())
            <div class="text-center py-20 bg-white rounded-xl border border-stone-200/80 p-8 space-y-3">
                <p class="text-stone-500 font-light">No buying guides published yet.</p>
                <a href="{{ route('home') }}" class="text-xs uppercase font-semibold text-stone-900 underline">Return to Home</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($guides as $guide)
                    <article class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-xs hover:shadow-md hover:border-stone-300 transition-all flex flex-col justify-between">
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between text-xs">
                                @if($guide->category)
                                    <span class="text-[11px] uppercase tracking-wider font-semibold text-stone-500 bg-stone-100 px-2 py-0.5 rounded">
                                        {{ $guide->category->name }}
                                    </span>
                                @endif
                                <span class="text-stone-400 font-mono">{{ $guide->reading_time_minutes }} min read</span>
                            </div>

                            <h2 class="font-serif-editorial text-xl font-bold text-stone-900 hover:text-stone-700 transition-colors leading-snug">
                                <a href="{{ route('content.guide', $guide->slug) }}">
                                    {{ $guide->title }}
                                </a>
                            </h2>

                            @if($guide->excerpt)
                                <p class="text-sm text-stone-600 line-clamp-3 leading-relaxed">
                                    {{ $guide->excerpt }}
                                </p>
                            @endif
                        </div>

                        <div class="p-6 pt-0 border-t border-stone-100 mt-4 flex items-center justify-between">
                            <span class="text-xs text-stone-400">
                                {{ $guide->published_at ? $guide->published_at->format('M d, Y') : 'Draft' }}
                            </span>
                            <a href="{{ route('content.guide', $guide->slug) }}" class="inline-flex items-center gap-1 text-xs uppercase font-semibold text-stone-900 hover:text-stone-600 transition-colors">
                                <span>Read Guide</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $guides->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
