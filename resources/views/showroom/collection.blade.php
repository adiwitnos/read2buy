@extends('layouts.app')

@section('title', $collection->name . ' — Editorial Collection | Read2Buy.com')
@section('meta_description', $collection->tagline ?? $collection->description)

@section('content')
<!-- Collection Header -->
<header class="bg-white border-b border-stone-200/80 pt-16 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-4">
            <div class="flex items-center gap-2">
                <a href="{{ route('home') }}" class="text-xs uppercase tracking-wider text-stone-500 hover:text-stone-900 transition-colors">Home</a>
                <span class="text-xs text-stone-400">/</span>
                <span class="text-xs uppercase tracking-wider text-stone-900 font-semibold">Curated Collection</span>
            </div>

            <h1 class="font-serif-editorial text-4xl sm:text-5xl font-bold tracking-tight text-stone-900">
                {{ $collection->name }}
            </h1>

            @if($collection->tagline)
                <p class="text-lg text-stone-600 font-light">
                    {{ $collection->tagline }}
                </p>
            @endif

            @if($collection->curator_statement)
                <div class="bg-stone-50 border-l-2 border-stone-800 p-4 rounded-r-lg mt-6">
                    <span class="block text-[11px] uppercase tracking-wider font-bold text-stone-500 mb-1">Curator Statement:</span>
                    <p class="text-sm text-stone-800 font-serif-editorial italic leading-relaxed">
                        "{{ $collection->curator_statement }}"
                    </p>
                </div>
            @endif
        </div>
    </div>
</header>

<!-- Products in Collection -->
<section class="py-16 bg-[#faf8f5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8 pb-4 border-b border-stone-200/60">
            <span class="text-xs uppercase tracking-wider font-semibold text-stone-500">
                Showing {{ $products->count() }} Verified Selections
            </span>
            <div class="flex items-center gap-2 text-xs text-stone-500">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>The Read2Buy Standard</span>
            </div>
        </div>

        @if($products->isEmpty())
            <div class="bg-white rounded-xl border border-stone-200 p-12 text-center text-stone-500 space-y-3">
                <p class="text-base font-serif-editorial italic">This collection is currently undergoing evaluation.</p>
                <p class="text-xs text-stone-400">We only publish instruments after rigorous independent auditing.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
