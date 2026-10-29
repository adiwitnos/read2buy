@extends('layouts.app')

@section('title', 'Buying Guides — Read2Buy.com')
@section('meta_description', 'Problem-oriented buying guides for workspace setups and mindful consumer purchasing.')

@section('content')
<div class="bg-white border-b border-stone-200/80 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-4">
            <span class="text-xs uppercase font-mono tracking-widest text-stone-500 font-semibold">
                Problem-Based Buying Guides
            </span>
            <h1 class="font-serif-editorial text-4xl sm:text-5xl font-bold text-stone-900">
                Informed Buying Guides
            </h1>
            <p class="text-stone-600 text-lg font-light">
                Analytical reviews and in-depth teardowns designed to solve practical equipment and workspace dilemmas before you buy.
            </p>
        </div>
    </div>
</div>

<section class="py-16 bg-[#faf8f5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Guide 1 -->
            <article class="bg-white p-8 rounded-xl border border-stone-200 shadow-xs flex flex-col justify-between space-y-6">
                <div class="space-y-3">
                    <span class="text-xs uppercase font-bold tracking-wider text-stone-400">Ergonomics & Lighting</span>
                    <h3 class="font-serif-editorial text-2xl font-bold text-stone-900">
                        <a href="{{ route('showroom.product', 'benq-screenbar-monitor-light') }}" class="hover:text-stone-600 transition-colors">
                            ScreenBar Monitor Lights vs. Desk Lamps: Why Asymmetric Optics Matter
                        </a>
                    </h3>
                    <p class="text-sm text-stone-600 leading-relaxed font-light">
                        Why do your eyes feel fatigued after evening screen sessions? We dissect asymmetric optical paths, glare reduction, and desk space optimization.
                    </p>
                </div>

                <div class="pt-4 border-t border-stone-100 flex items-center justify-between">
                    <span class="text-xs text-stone-400">Reading time: 5 mins</span>
                    <a href="{{ route('showroom.product', 'benq-screenbar-monitor-light') }}" class="text-xs font-semibold uppercase tracking-wider text-stone-900 hover:text-stone-600">
                        Read Guide &rarr;
                    </a>
                </div>
            </article>

            <!-- Guide 2 -->
            <article class="bg-white p-8 rounded-xl border border-stone-200 shadow-xs flex flex-col justify-between space-y-6">
                <div class="space-y-3">
                    <span class="text-xs uppercase font-bold tracking-wider text-stone-400">Workspace Organization</span>
                    <h3 class="font-serif-editorial text-2xl font-bold text-stone-900">
                        <a href="{{ route('showroom.product', 'wool-felt-desk-mat-charcoal') }}" class="hover:text-stone-600 transition-colors">
                            Structuring the Focus Zone: Why Natural Felt Outperforms Synthetic Leather
                        </a>
                    </h3>
                    <p class="text-sm text-stone-600 leading-relaxed font-light">
                        A desk pad is not merely surface protection—it establishes a tactile boundary between active work and peripheral clutter.
                    </p>
                </div>

                <div class="pt-4 border-t border-stone-100 flex items-center justify-between">
                    <span class="text-xs text-stone-400">Reading time: 4 mins</span>
                    <a href="{{ route('showroom.product', 'wool-felt-desk-mat-charcoal') }}" class="text-xs font-semibold uppercase tracking-wider text-stone-900 hover:text-stone-600">
                        Read Guide &rarr;
                    </a>
                </div>
            </article>
        </div>
    </div>
</section>
@endsection
