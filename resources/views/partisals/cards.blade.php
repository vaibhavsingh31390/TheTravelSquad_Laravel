@php
    $featured = $postsData->first();
    $compactPosts = $postsData->slice(1, 2);
    $gridPosts = $postsData->slice(3);
@endphp

{{-- HERO FEATURED GRID --}}
@if ($featured)
<section class="page-wrap hero-featured">
<div class="hero-grid">
<div class="hero-main-slot">
@postCard([
    'variant' => 'featured',
    'route' => 'posts.show',
    'id' => $featured->id,
    'media' => $featured->media,
    'path' => $featured->media?->url(),
    'title' => $featured->title,
    'content' => $featured->content,
    'createdAt' => $featured->created_at->format('M d, Y'),
    'comments' => $featured->comments->count(),
    'post' => $featured,
    'categoryName' => $featured->category()->first()->category_Menu ?? 'Travel',
])
@endpostCard
</div>
@foreach ($compactPosts as $compact)
<div class="hero-side-slot">
@postCard([
    'variant' => 'compact',
    'route' => 'posts.show',
    'id' => $compact->id,
    'media' => $compact->media,
    'path' => $compact->media?->url(),
    'title' => $compact->title,
    'content' => $compact->content,
    'createdAt' => $compact->created_at->format('M d, Y'),
    'comments' => $compact->comments->count(),
    'post' => $compact,
    'categoryName' => $compact->category()->first()->category_Menu ?? 'Travel',
])
@endpostCard
</div>
@endforeach
</div>
</section>
@endif

{{-- FILTER BAR --}}
<section class="page-wrap">
<div class="filter-bar">
<button type="button" class="search-btn" aria-label="Search" onclick="document.getElementById('serach_String')?.focus()">
<i class='bx bx-search'></i>
</button>
<div class="category-pills">
<a href="{{ route('posts.index') }}" class="category-pill {{ Route::is('posts.index') ? 'active' : '' }}">All</a>
@foreach ($category->unique() as $key)
<a href="{{ route('postByCategory', ['category' => $key]) }}" class="category-pill {{ request()->is("type/$key") ? 'active' : '' }}">{{ $key }}</a>
@endforeach
</div>
</div>
</section>

{{-- ARTICLE GRID --}}
<section class="page-wrap pb-5">
<div class="section-header">
<h2 class="heading">Latest Stories</h2>
<p class="section-subtitle">Fresh travel stories from our community.</p>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 g-xl-5" id="data-col">
@foreach ($gridPosts->isNotEmpty() ? $gridPosts : $postsData->skip(3) as $card)
<div class="col d-flex">
@postCard([
    'route' => 'posts.show',
    'id' => $card->id,
    'media' => $card->media,
    'path' => $card->media?->url(),
    'title' => $card->title,
    'content' => $card->content,
    'createdAt' => $card->created_at->format('M d, Y'),
    'comments' => $card->comments->count(),
    'post' => $card,
    'categoryName' => $card->category()->first()->category_Menu ?? 'Travel',
    'tags' => $card->tags,
])
@endpostCard
</div>
@endforeach
</div>

<div class="text-center mt-5">
<button class="btn load_MoreBtn" type="button" id="load_More">Load More</button>
</div>
</section>
