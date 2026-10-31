@extends('layouts.app')

@section('title', 'Page Not Found — 404 | ' . ($siteSettings['site_name'] ?? 'Read2Buy.com'))
@section('meta_description', 'The page you were looking for could not be found.')

@section('content')
<div class="py-24 sm:py-32 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto text-center space-y-6">
    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-stone-100 text-stone-800 text-xs uppercase tracking-widest font-semibold border border-stone-200">
        <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span>
        HTTP 404 &bull; Missing Specification
    </div>

    <h1 class="font-serif-editorial text-4xl sm:text-6xl font-bold tracking-tight text-stone-900">
        We Couldn't Find That Curated Page
    </h1>

    <p class="text-base sm:text-lg text-stone-600 leading-relaxed font-light max-w-xl mx-auto">
        The review, guide, or product link you requested may have been archived, updated to a newer edition, or moved during our catalog re-indexing.
    </p>

    <div class="pt-6 flex flex-wrap items-center justify-center gap-4">
        <a href="{{ route('home') }}" class="px-6 py-3.5 bg-stone-900 text-white rounded-lg text-xs uppercase tracking-wider font-semibold hover:bg-stone-800 transition-colors shadow-sm">
            &larr; Return to Showroom
        </a>
        <a href="{{ route('content.guides') }}" class="px-6 py-3.5 bg-white text-stone-800 rounded-lg text-xs uppercase tracking-wider font-semibold hover:bg-stone-50 transition-colors border border-stone-200">
            Browse Buying Guides
        </a>
    </div>
</div>
@endsection

