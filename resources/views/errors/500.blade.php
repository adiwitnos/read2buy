@extends('layouts.app')

@section('title', 'Server Error — 500 | ' . ($siteSettings['site_name'] ?? 'Read2Buy.com'))
@section('meta_description', 'An internal server error occurred while processing your request.')

@section('content')
<div class="py-24 sm:py-32 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto text-center space-y-6">
    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-50 text-rose-800 text-xs uppercase tracking-widest font-semibold border border-rose-200">
        <span class="w-1.5 h-1.5 rounded-full bg-rose-600"></span>
        HTTP 500 &bull; Editorial Desk Diagnostic
    </div>

    <h1 class="font-serif-editorial text-4xl sm:text-6xl font-bold tracking-tight text-stone-900">
        Temporary Mechanical Interruption
    </h1>

    <p class="text-base sm:text-lg text-stone-600 leading-relaxed font-light max-w-xl mx-auto">
        Our research desk encountered an unexpected internal condition. Our technical team has been automatically alerted and is inspecting the system state.
    </p>

    <div class="pt-6 flex flex-wrap items-center justify-center gap-4">
        <a href="{{ route('home') }}" class="px-6 py-3.5 bg-stone-900 text-white rounded-lg text-xs uppercase tracking-wider font-semibold hover:bg-stone-800 transition-colors shadow-sm">
            &larr; Back to Safety
        </a>
        <a href="{{ route('contact') }}" class="px-6 py-3.5 bg-white text-stone-800 rounded-lg text-xs uppercase tracking-wider font-semibold hover:bg-stone-50 transition-colors border border-stone-200">
            Report Issue to Editorial
        </a>
    </div>
</div>
@endsection

