<x-filament-panels::page>
    <div class="space-y-6">
        <!-- 1. Sitemap Distribution Status -->
        <x-filament::section
            heading="Search Engine Index Distribution Hub (SEO, AEO, GEO)"
            description="The XML sitemap is dynamically generated and refreshed automatically whenever new products or editorial guides are published."
        >
            <div style="padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e5e7eb; background-color: #ffffff; display: flex; flex-direction: column; gap: 1rem;">
                <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #6b7280;">
                            Public XML Sitemap URL
                        </span>
                        <x-filament::badge color="success">Active & Dynamic</x-filament::badge>
                    </div>
                    <p style="font-family: monospace; font-size: 0.875rem; font-weight: 600; color: #111827; word-break: break-all; margin: 0.25rem 0 0 0;">
                        {{ $sitemapUrl }}
                    </p>
                </div>

                <div style="display: flex; align-items: center; gap: 0.75rem; flex-wrap: wrap;">
                    <x-filament::button
                        tag="a"
                        href="{{ $sitemapUrl }}"
                        target="_blank"
                        color="gray"
                        icon="heroicon-m-arrow-top-right-on-square"
                    >
                        View XML Sitemap
                    </x-filament::button>

                    <x-filament::button
                        wire:click="pingSearchEngines"
                        color="primary"
                        icon="heroicon-m-check-badge"
                    >
                        Verify Status
                    </x-filament::button>
                </div>
            </div>
        </x-filament::section>

        <style>
            .read2buy-sitemap-grid {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 1rem;
            }
            @media (min-width: 768px) {
                .read2buy-sitemap-grid {
                    grid-template-columns: repeat(5, minmax(0, 1fr));
                }
            }
            .read2buy-metric-box {
                padding: 1.25rem 1rem;
                border-radius: 0.75rem;
                border: 1px solid #e5e7eb;
                background-color: #ffffff;
                text-align: center;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.04);
            }
        </style>

        <!-- 2. Indexed Sitemap Entries -->
        <x-filament::section
            heading="Indexed Entries Breakdown"
            description="Composition of canonical links delivered to Googlebot, Bingbot, and AI answer engines."
        >
            <div class="read2buy-sitemap-grid">
                <div class="read2buy-metric-box">
                    <span style="font-size: 2rem; font-weight: 800; color: #d97706; display: block; line-height: 1;">
                        {{ $totalProducts }}
                    </span>
                    <span style="font-size: 0.875rem; font-weight: 600; color: #111827; display: block; margin-top: 0.5rem;">
                        Curated Products
                    </span>
                    <span style="font-size: 0.75rem; color: #6b7280; display: block; margin-top: 0.25rem;">
                        Active research
                    </span>
                </div>

                <div class="read2buy-metric-box">
                    <span style="font-size: 2rem; font-weight: 800; color: #059669; display: block; line-height: 1;">
                        {{ $totalBlogs }}
                    </span>
                    <span style="font-size: 0.875rem; font-weight: 600; color: #111827; display: block; margin-top: 0.5rem;">
                        Blog Articles
                    </span>
                    <span style="font-size: 0.75rem; color: #6b7280; display: block; margin-top: 0.25rem;">
                        SEO & AEO knowledge
                    </span>
                </div>

                <div class="read2buy-metric-box">
                    <span style="font-size: 2rem; font-weight: 800; color: #2563eb; display: block; line-height: 1;">
                        {{ $totalGuides }}
                    </span>
                    <span style="font-size: 0.875rem; font-weight: 600; color: #111827; display: block; margin-top: 0.5rem;">
                        Buying Guides
                    </span>
                    <span style="font-size: 0.75rem; color: #6b7280; display: block; margin-top: 0.25rem;">
                        Problem-led matrices
                    </span>
                </div>

                <div class="read2buy-metric-box">
                    <span style="font-size: 2rem; font-weight: 800; color: #7c3aed; display: block; line-height: 1;">
                        {{ $totalStories }}
                    </span>
                    <span style="font-size: 0.875rem; font-weight: 600; color: #111827; display: block; margin-top: 0.5rem;">
                        Story Series
                    </span>
                    <span style="font-size: 0.75rem; color: #6b7280; display: block; margin-top: 0.25rem;">
                        Human narrative context
                    </span>
                </div>

                <div class="read2buy-metric-box">
                    <span style="font-size: 2rem; font-weight: 800; color: #4b5563; display: block; line-height: 1;">
                        {{ $totalStaticPages }}
                    </span>
                    <span style="font-size: 0.875rem; font-weight: 600; color: #111827; display: block; margin-top: 0.5rem;">
                        Static Pages
                    </span>
                    <span style="font-size: 0.75rem; color: #6b7280; display: block; margin-top: 0.25rem;">
                        Policies & disclosures
                    </span>
                </div>
            </div>
        </x-filament::section>
    </div>
</x-filament-panels::page>
