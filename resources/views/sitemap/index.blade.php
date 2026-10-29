{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Static Institutional & Showroom Pages --}}
    @foreach ($staticPages as $url)
        <url>
            <loc>{{ $url }}</loc>
            <changefreq>daily</changefreq>
            <priority>0.9</priority>
        </url>
    @endforeach

    {{-- Curated Products --}}
    @foreach ($products as $product)
        <url>
            <loc>{{ route('showroom.product', $product->slug) }}</loc>
            <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach

    {{-- Content: Guides, Stories, Blog --}}
    @foreach ($contents as $content)
        @php
            $contentUrl = match($content->type->value) {
                'guide' => route('content.guide', $content->slug),
                'story' => route('content.story', $content->slug),
                'blog' => route('blog.show', $content->slug),
                default => route('home'),
            };
        @endphp
        <url>
            <loc>{{ $contentUrl }}</loc>
            <lastmod>{{ $content->updated_at->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>{{ $content->type->value === 'blog' ? '0.85' : '0.8' }}</priority>
        </url>
    @endforeach

    {{-- Categories --}}
    @foreach ($categories as $category)
        <url>
            <loc>{{ url('/?q=' . urlencode($category->name)) }}</loc>
            <lastmod>{{ $category->updated_at->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.7</priority>
        </url>
    @endforeach
</urlset>
