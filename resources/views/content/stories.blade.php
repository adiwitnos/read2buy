@extends('layouts.app')

@section('title', 'Consumer Stories & Narrative Case Studies — Read2Buy')
@section('meta_description', 'Human narrative case studies examining real-world workspaces, study routines, and entrepreneurial setups.')

@section('content')
<div class="py-12 sm:py-16 bg-white border-b border-stone-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-stone-100 text-stone-800 text-xs uppercase tracking-widest font-semibold border border-stone-200">
                <span class="w-1.5 h-1.5 rounded-full bg-stone-900"></span>
                Story-Led Architecture
            </div>

            <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold tracking-tight text-stone-900">
                Consumer Stories & Case Studies
            </h1>

            <p class="text-base sm:text-lg text-stone-600 font-light leading-relaxed">
                Behind every purchasing decision lies a real human workflow: structuring compact workspaces, launching home ventures, or outfitting a creative studio. Functional case studies that ground product curation in everyday life.
            </p>
        </div>
    </div>
</div>

<div class="py-12 sm:py-16 bg-[#faf8f5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($stories->isEmpty())
            <div class="text-center py-20 bg-white rounded-xl border border-stone-200/80 p-8 space-y-3">
                <p class="text-stone-500 font-light">No consumer stories published yet.</p>
                <a href="{{ route('home') }}" class="text-xs uppercase font-semibold text-stone-900 underline">Return to Home</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($stories as $story)
                    <article class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-xs hover:shadow-md hover:border-stone-300 transition-all flex flex-col justify-between">
                        <div class="p-8 space-y-4">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-[10px] uppercase font-bold tracking-widest text-amber-800 bg-amber-50 px-2.5 py-1 rounded border border-amber-200">
                                    Narrative Series
                                </span>
                                <span class="text-stone-400 font-mono">{{ $story->reading_time_minutes }} min read</span>
                            </div>

                            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 hover:text-stone-700 transition-colors leading-snug">
                                <a href="{{ route('content.story', $story->slug) }}">
                                    {{ $story->title }}
                                </a>
                            </h2>

                            @if($story->excerpt)
                                <p class="text-sm text-stone-600 leading-relaxed font-light">
                                    {{ $story->excerpt }}
                                </p>
                            @endif
                        </div>

                        <div class="p-8 pt-0 border-t border-stone-100 mt-4 flex items-center justify-between">
                            <span class="text-xs text-stone-400">
                                {{ $story->published_at ? $story->published_at->format('M d, Y') : 'Draft' }}
                            </span>
                            <a href="{{ route('content.story', $story->slug) }}" class="inline-flex items-center gap-1.5 text-xs uppercase font-semibold text-stone-900 hover:text-stone-600 transition-colors">
                                <span>Read Story</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $stories->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
