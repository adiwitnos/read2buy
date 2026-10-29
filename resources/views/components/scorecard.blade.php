@props(['score'])

@if($score)
<div class="bg-white rounded-xl border border-stone-200/90 shadow-sm p-6 sm:p-8 space-y-6">
    <!-- Header: The Read2Buy Standard Badge & Overall Score -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-stone-100">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-stone-900 text-stone-100 tracking-wide">
                    The Read2Buy Standard
                </span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-stone-100 text-stone-800 border border-stone-200">
                    {{ $score->evaluation_method->label() }}
                </span>
            </div>
            <p class="text-xs text-stone-500 mt-1 max-w-md">
                {{ $score->evaluation_method->description() }}
            </p>
        </div>

        <div class="flex items-baseline gap-1.5 bg-[#faf8f5] px-5 py-3 rounded-lg border border-stone-200/70 self-start sm:self-auto">
            <span class="text-xs uppercase font-medium text-stone-500 tracking-wider">Curation Score:</span>
            <span class="font-serif-editorial text-3xl font-bold text-stone-900 leading-none">
                {{ number_format($score->overall_score, 1) }}
            </span>
            <span class="text-xs text-stone-400 font-medium">/ 10</span>
        </div>
    </div>

    <!-- 5 Evaluation Dimensions -->
    <div class="space-y-4">
        <h4 class="text-xs uppercase font-bold tracking-wider text-stone-500">
            5 Evaluation Dimensions
        </h4>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-3.5 text-sm">
            <!-- Dimension 1: Purpose -->
            <div>
                <div class="flex justify-between items-center mb-1 text-xs">
                    <span class="font-medium text-stone-800">1. Purpose (Real Solutions)</span>
                    <span class="font-bold text-stone-900 font-mono">{{ number_format($score->score_purpose, 1) }}</span>
                </div>
                <div class="w-full bg-stone-100 rounded-full h-1.5 overflow-hidden">
                    <div class="bg-stone-800 h-1.5 rounded-full" style="width: {{ ($score->score_purpose / 10) * 100 }}%"></div>
                </div>
            </div>

            <!-- Dimension 2: Craft -->
            <div>
                <div class="flex justify-between items-center mb-1 text-xs">
                    <span class="font-medium text-stone-800">2. Craft (Build & Materials)</span>
                    <span class="font-bold text-stone-900 font-mono">{{ number_format($score->score_craft, 1) }}</span>
                </div>
                <div class="w-full bg-stone-100 rounded-full h-1.5 overflow-hidden">
                    <div class="bg-stone-800 h-1.5 rounded-full" style="width: {{ ($score->score_craft / 10) * 100 }}%"></div>
                </div>
            </div>

            <!-- Dimension 3: Character -->
            <div>
                <div class="flex justify-between items-center mb-1 text-xs">
                    <span class="font-medium text-stone-800">3. Character (Design & Usability)</span>
                    <span class="font-bold text-stone-900 font-mono">{{ number_format($score->score_character, 1) }}</span>
                </div>
                <div class="w-full bg-stone-100 rounded-full h-1.5 overflow-hidden">
                    <div class="bg-stone-800 h-1.5 rounded-full" style="width: {{ ($score->score_character / 10) * 100 }}%"></div>
                </div>
            </div>

            <!-- Dimension 4: Longevity -->
            <div>
                <div class="flex justify-between items-center mb-1 text-xs">
                    <span class="font-medium text-stone-800">4. Longevity (Durability & Lifespan)</span>
                    <span class="font-bold text-stone-900 font-mono">{{ number_format($score->score_longevity, 1) }}</span>
                </div>
                <div class="w-full bg-stone-100 rounded-full h-1.5 overflow-hidden">
                    <div class="bg-stone-800 h-1.5 rounded-full" style="width: {{ ($score->score_longevity / 10) * 100 }}%"></div>
                </div>
            </div>

            <!-- Dimension 5: Value -->
            <div class="sm:col-span-2">
                <div class="flex justify-between items-center mb-1 text-xs">
                    <span class="font-medium text-stone-800">5. Value (Price-to-Value Ratio)</span>
                    <span class="font-bold text-stone-900 font-mono">{{ number_format($score->score_value, 1) }}</span>
                </div>
                <div class="w-full bg-stone-100 rounded-full h-1.5 overflow-hidden">
                    <div class="bg-stone-800 h-1.5 rounded-full" style="width: {{ ($score->score_value / 10) * 100 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Verdict -->
    <div class="bg-stone-50 border-l-2 border-stone-800 p-4 rounded-r-lg">
        <h5 class="text-xs uppercase tracking-wider font-bold text-stone-700 mb-1">
            Curator Editorial Verdict:
        </h5>
        <p class="text-sm text-stone-800 leading-relaxed font-serif-editorial italic">
            "{{ $score->verdict }}"
        </p>
    </div>

    <!-- Key Strengths & Trade-offs (Pros & Cons) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-stone-100">
        <!-- Strengths -->
        <div class="space-y-3">
            <div class="flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-emerald-800">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                Key Strengths
            </div>
            <ul class="space-y-2 text-xs sm:text-sm text-stone-700">
                @foreach($score->key_strengths ?? [] as $strength)
                    <li class="flex items-start gap-2">
                        <span class="text-emerald-600 font-bold">•</span>
                        <span>{{ $strength }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Trade-offs / Limitations -->
        <div class="space-y-3">
            <div class="flex items-center gap-1.5 text-xs font-bold uppercase tracking-wider text-stone-600">
                <svg class="w-4 h-4 text-stone-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                Trade-offs & Limitations
            </div>
            <ul class="space-y-2 text-xs sm:text-sm text-stone-700">
                @foreach($score->trade_offs ?? [] as $limitation)
                    <li class="flex items-start gap-2">
                        <span class="text-stone-400 font-bold">•</span>
                        <span>{{ $limitation }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Who is this for / Not for -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-stone-100 text-xs sm:text-sm">
        <div class="bg-emerald-50/50 border border-emerald-100 rounded-lg p-3.5">
            <span class="block text-xs uppercase font-bold text-emerald-900 tracking-wider mb-1">
                Best Suited For:
            </span>
            <p class="text-emerald-950 leading-relaxed">
                {{ $score->ideal_for }}
            </p>
        </div>

        <div class="bg-stone-50 border border-stone-200/80 rounded-lg p-3.5">
            <span class="block text-xs uppercase font-bold text-stone-700 tracking-wider mb-1">
                Who Should Skip:
            </span>
            <p class="text-stone-700 leading-relaxed">
                {{ $score->not_recommended_for }}
            </p>
        </div>
    </div>
</div>
@endif
