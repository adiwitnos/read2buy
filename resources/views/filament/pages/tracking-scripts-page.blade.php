<x-filament-panels::page>
    <form wire:submit="save" class="space-y-6">
        <!-- 1. Tracking Analytics & Pixels -->
        <x-filament::section
            heading="Tracking IDs & Analytics Pixels"
            description="Configure official tracking IDs to monitor audience traffic, referral channels, and outbound affiliate conversions accurately."
        >
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;">
                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                        Google Analytics 4 (GA4)
                    </label>
                    <x-filament::input.wrapper>
                        <x-filament::input
                            type="text"
                            wire:model="googleAnalyticsId"
                            placeholder="G-XXXXXXXXXX"
                            style="font-family: monospace;"
                        />
                    </x-filament::input.wrapper>
                    <p class="text-xs text-gray-500 mt-1">Google Analytics measurement ID.</p>
                </div>

                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                        Meta Pixel ID
                    </label>
                    <x-filament::input.wrapper>
                        <x-filament::input
                            type="text"
                            wire:model="metaPixelId"
                            placeholder="123456789012345"
                            style="font-family: monospace;"
                        />
                    </x-filament::input.wrapper>
                    <p class="text-xs text-gray-500 mt-1">Meta/Facebook Ads pixel ID.</p>
                </div>

                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                        Google Tag Manager (GTM)
                    </label>
                    <x-filament::input.wrapper>
                        <x-filament::input
                            type="text"
                            wire:model="googleTagManagerId"
                            placeholder="GTM-XXXXXX"
                            style="font-family: monospace;"
                        />
                    </x-filament::input.wrapper>
                    <p class="text-xs text-gray-500 mt-1">Google Tag Manager container ID.</p>
                </div>
            </div>
        </x-filament::section>

        <!-- 2. Custom Scripts Injection -->
        <x-filament::section
            heading="Custom Script Injection"
            description="Insert domain verification tags (Google Search Console, Bing Webmaster) or custom header/body snippets."
        >
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                        Header Custom Script (&lt;head&gt;)
                    </label>
                    <x-filament::input.wrapper>
                        <textarea
                            wire:model="customHeadScripts"
                            rows="5"
                            class="fi-input block w-full border-none bg-transparent py-2 px-3 text-xs text-gray-950 outline-hidden placeholder:text-gray-400 focus:ring-0"
                            style="font-family: monospace;"
                            placeholder="<!-- Insert script tags or verification meta to inject inside <head> -->"
                        ></textarea>
                    </x-filament::input.wrapper>
                    <p class="text-xs text-gray-500 mt-1">Rendered directly inside the &lt;head&gt; element across all public pages.</p>
                </div>

                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                        Body / Footer Custom Script (&lt;/body&gt;)
                    </label>
                    <x-filament::input.wrapper>
                        <textarea
                            wire:model="customBodyScripts"
                            rows="5"
                            class="fi-input block w-full border-none bg-transparent py-2 px-3 text-xs text-gray-950 outline-hidden placeholder:text-gray-400 focus:ring-0"
                            style="font-family: monospace;"
                            placeholder="<!-- Insert script tags to inject before the closing </body> tag -->"
                        ></textarea>
                    </x-filament::input.wrapper>
                    <p class="text-xs text-gray-500 mt-1">Rendered immediately before the closing &lt;/body&gt; tag.</p>
                </div>
            </div>

            <x-slot name="footer">
                <x-filament::button type="submit" color="primary">
                    Save Tracking & Scripts
                </x-filament::button>
            </x-slot>
        </x-filament::section>
    </form>
</x-filament-panels::page>
