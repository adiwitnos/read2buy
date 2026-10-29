<x-filament-panels::page>
    <form wire:submit="save" class="space-y-6">
        <!-- 1. Identity & Slogan -->
        <x-filament::section
            heading="Site Identity & Brand Slogan"
            description="Manage your brand name and official slogan displayed in public headers, footers, metadata, and editorial cards."
        >
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                        Website / Brand Name
                    </label>
                    <x-filament::input.wrapper>
                        <x-filament::input
                            type="text"
                            wire:model="siteName"
                            required
                            placeholder="Read2Buy.com"
                        />
                    </x-filament::input.wrapper>
                    <p class="text-xs text-gray-500 mt-1">Main identity shown in logos, titles, and legal policies.</p>
                </div>

                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                        Official Slogan
                    </label>
                    <x-filament::input.wrapper>
                        <x-filament::input
                            type="text"
                            wire:model="siteSlogan"
                            required
                            placeholder="Curated Selections for Conscious Decisions"
                        />
                    </x-filament::input.wrapper>
                    <p class="text-xs text-gray-500 mt-1">Official brand tagline.</p>
                </div>
            </div>
        </x-filament::section>

        <!-- 2. Public Showroom Hero -->
        <x-filament::section
            heading="Showroom Hero Banner"
            description="Configure the primary headline and editorial manifesto greeting visitors on the homepage."
        >
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                        Hero Headline
                    </label>
                    <x-filament::input.wrapper>
                        <x-filament::input
                            type="text"
                            wire:model="heroHeadline"
                            placeholder="Research-backed buying guides for conscious living."
                        />
                    </x-filament::input.wrapper>
                </div>

                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                        Editorial Manifesto / Description
                    </label>
                    <x-filament::input.wrapper>
                        <textarea
                            wire:model="heroDescription"
                            rows="3"
                            class="fi-input block w-full border-none bg-transparent py-2 px-3 text-sm text-gray-950 outline-hidden placeholder:text-gray-400 focus:ring-0"
                            placeholder="Independent research desk evaluating technical merits and long-term durability..."
                        ></textarea>
                    </x-filament::input.wrapper>
                </div>
            </div>
        </x-filament::section>

        <!-- 3. Contact & Editorial Communication -->
        <x-filament::section
            heading="Contact & Editorial Disclosure"
            description="Public contact details for consumer inquiries and manufacturer technical verifications."
        >
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                    <div>
                        <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                            Editorial Email
                        </label>
                        <x-filament::input.wrapper>
                            <x-filament::input
                                type="email"
                                wire:model="contactEmail"
                                placeholder="editorial@read2buy.com"
                            />
                        </x-filament::input.wrapper>
                    </div>

                    <div>
                        <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                            Support / Inquiries Line
                        </label>
                        <x-filament::input.wrapper>
                            <x-filament::input
                                type="text"
                                wire:model="contactWhatsApp"
                                placeholder="+1-800-READ2BUY"
                            />
                        </x-filament::input.wrapper>
                    </div>
                </div>

                <div>
                    <label class="fi-fo-field-wrp-label inline-flex items-center gap-x-2 text-sm font-medium leading-6 text-gray-950 mb-1.5">
                        Editorial Ethics Statement
                    </label>
                    <x-filament::input.wrapper>
                        <textarea
                            wire:model="editorialStatement"
                            rows="2"
                            class="fi-input block w-full border-none bg-transparent py-2 px-3 text-sm text-gray-950 outline-hidden placeholder:text-gray-400 focus:ring-0"
                            placeholder="Independent curation based on rigorous engineering research without paid placements..."
                        ></textarea>
                    </x-filament::input.wrapper>
                </div>
            </div>

            <x-slot name="footer">
                <x-filament::button type="submit" color="primary">
                    Save Customizations
                </x-filament::button>
            </x-slot>
        </x-filament::section>
    </form>
</x-filament-panels::page>
