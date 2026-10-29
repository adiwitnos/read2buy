@props([
    'method' => 'online_research',
    'brand' => null,
    'hasAffiliate' => true
])

<div {{ $attributes->merge(['class' => 'bg-stone-50 border border-stone-200/90 rounded-xl p-4 sm:p-5 text-xs text-stone-600 space-y-2 leading-relaxed']) }}>
    <div class="flex items-center gap-2 font-semibold text-stone-900 uppercase tracking-wider text-[11px]">
        <svg class="w-4 h-4 text-stone-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span>Transparency & Curation Standards</span>
    </div>

    <div class="space-y-1.5 pt-1 border-t border-stone-200/60">
        @if($method === 'manufacturer_sample' || (is_object($method) && $method->value === 'manufacturer_sample'))
            <p>
                <strong class="text-stone-800">Manufacturer sample:</strong> Product evaluated using a sample provided by {{ $brand ?? 'the manufacturer' }}, following strict independent testing protocols with no editorial influence.
            </p>
        @else
            <p>
                <strong class="text-stone-800">Independent research:</strong> Evaluated independently through technical specifications, benchmark data, and verified primary feedback; not physically lab-tested.
            </p>
        @endif

        @if($hasAffiliate)
            <p>
                <strong class="text-stone-800">Affiliate disclosure:</strong> As an associate, Read2Buy may earn a commission from qualifying purchases made through our referral links, at zero additional cost to you.
            </p>
        @endif
    </div>

    <div class="pt-2 text-[11px] text-stone-400 flex flex-wrap gap-x-4 gap-y-1">
        <a href="{{ route('showroom.curation-standards') }}" class="underline hover:text-stone-700 transition-colors">
            Learn Our Curation Methodology &rarr;
        </a>
        <a href="{{ route('legal.affiliate-disclosure') }}" class="underline hover:text-stone-700 transition-colors">
            Commission Policy & Compliance &rarr;
        </a>
    </div>
</div>
