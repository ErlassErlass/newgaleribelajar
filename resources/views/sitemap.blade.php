{!! '<'.'?xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
@foreach($static as $page)
    <url>
        <loc>{{ $page['loc'] }}</loc>
        <changefreq>{{ $page['changefreq'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
    </url>
@endforeach
@foreach($products as $product)
    <url>
        <loc>{{ route('products.show', $product->slug) }}</loc>
        <lastmod>{{ $product->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>{{ $product->on_shopee || $product->total_deals >= 50 ? '0.8' : '0.6' }}</priority>
        <image:image>
            <image:loc>{{ $product->cover_url }}</image:loc>
            <image:title>{{ $product->name }}</image:title>
        </image:image>
    </url>
@endforeach
@foreach($articles as $article)
    <url>
        <loc>{{ route('articles.show', $article->slug) }}</loc>
        <lastmod>{{ $article->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
@if($article->cover_image)
        <image:image>
            <image:loc>{{ asset($article->cover_image) }}</image:loc>
            <image:title>{{ $article->title }}</image:title>
        </image:image>
@endif
    </url>
@endforeach
</urlset>
