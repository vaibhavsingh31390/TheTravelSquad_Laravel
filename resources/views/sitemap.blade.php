<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url>
<loc>{{ url('/') }}</loc>
<changefreq>daily</changefreq>
<priority>1.0</priority>
</url>
<url>
<loc>{{ route('posts.index') }}</loc>
<changefreq>daily</changefreq>
<priority>0.9</priority>
</url>
<url>
<loc>{{ route('pages.about') }}</loc>
<changefreq>monthly</changefreq>
<priority>0.6</priority>
</url>
<url>
<loc>{{ route('pages.contact') }}</loc>
<changefreq>monthly</changefreq>
<priority>0.6</priority>
</url>
<url>
<loc>{{ route('pages.privacy') }}</loc>
<changefreq>yearly</changefreq>
<priority>0.4</priority>
</url>
<url>
<loc>{{ route('pages.terms') }}</loc>
<changefreq>yearly</changefreq>
<priority>0.4</priority>
</url>
@foreach ($categories as $category)
<url>
<loc>{{ route('postByCategory', ['category' => $category]) }}</loc>
<changefreq>weekly</changefreq>
<priority>0.7</priority>
</url>
@endforeach
@foreach ($tags as $tag)
<url>
<loc>{{ route('postByTag', ['tag' => $tag->slug]) }}</loc>
<changefreq>weekly</changefreq>
<priority>0.65</priority>
</url>
@endforeach
@foreach ($posts as $post)
<url>
<loc>{{ route('posts.show', $post->id) }}</loc>
<lastmod>{{ $post->updated_at->toAtomString() }}</lastmod>
<changefreq>monthly</changefreq>
<priority>0.8</priority>
</url>
@endforeach
</urlset>
