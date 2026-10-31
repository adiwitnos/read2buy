@extends('layouts.app')

@section('title', 'Access Denied — 403 | ' . ($siteSettings['site_name'] ?? 'Read2Buy.com'))
@section('meta_description', 'You do not have authorization to view this area.')

@section('content')
<div class="py-24 sm:py-32 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto text-center space-y-6">
    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-50 text-amber-800 text-xs uppercase tracking-widest font-semibold border border-amber-200">
        <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
        HTTP 403 &bull; Restricted Curation Vault
    </div>

    <h1 class="font-serif-editorial text-4xl sm:text-6xl font-bold tracking-tight text-stone-900">
        Authorization Required
    </h1>

    <p class="text-base sm:text-lg text-stone-600 leading-relaxed font-light max-w-xl mx-auto">
        You do not have the credentials required to access this specific curation desk or administrator console.
    </p>

    <div class="pt-6 flex flex-wrap items-center justify-center gap-4">
        <a href="{{ route('home') }}" class="px-6 py-3.5 bg-stone-900 text-white rounded-lg text-xs uppercase tracking-wider font-semibold hover:bg-stone-800 transition-colors shadow-sm">
            &larr; Return to Showroom
        </a>
        <a href="{{ route('login') }}" class="px-6 py-3.5 bg-white text-stone-800 rounded-lg text-xs uppercase tracking-wider font-semibold hover:bg-stone-50 transition-colors border border-stone-200">
            Sign In with Proper Role
        </a>
    </div>
</div>
@endsection

