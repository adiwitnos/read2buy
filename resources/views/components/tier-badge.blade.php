@props(['tier'])

@php
    $tierEnum = is_string($tier) ? \App\Enums\ProductTier::tryFrom($tier) : $tier;
@endphp

@if($tierEnum)
    <span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold uppercase tracking-wider border ' . $tierEnum->badgeClasses()]) }} title="{{ $tierEnum->definition() }}">
        <span class="w-1.5 h-1.5 rounded-full {{ $tierEnum === \App\Enums\ProductTier::Signature ? 'bg-amber-400' : ($tierEnum === \App\Enums\ProductTier::Select ? 'bg-amber-600' : 'bg-emerald-600') }}"></span>
        {{ $tierEnum->label() }}
    </span>
@endif
