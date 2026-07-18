@php
    $archivePosts = $posts_All ?? $post_By_Category ?? $post_By_Tag ?? $posts_Search ?? collect();
    $isAll = isset($posts_All);
    $isCategory = isset($post_By_Category);
    $isTag = isset($post_By_Tag);
    $isSearch = isset($posts_Search);

    if ($isSearch) {
        $archiveTitle = 'Search results';
        $archiveSubtitle = 'Showing articles matching “'.e($searchQuery ?? request('q', '')).'”.';
        $archiveBadge = 'Search';
        $scrollCategory = 'Search';
        $scrollTag = '';
        $scrollSearch = $searchQuery ?? request('q', '');
    } elseif ($isTag) {
        $archiveTitle = $tagName;
        $archiveSubtitle = 'Stories tagged with this topic from our community.';
        $archiveBadge = 'Tag';
        $scrollCategory = 'All Posts';
        $scrollTag = $tagSlug;
        $scrollSearch = '';
    } elseif ($isCategory) {
        $archiveTitle = $categoryName ?? ($post_By_Category[0]->category[0]->category_Menu ?? request()->route('category') ?? 'Articles');
        $archiveSubtitle = 'Curated reads in the '.$archiveTitle.' category.';
        $archiveBadge = 'Category';
        $scrollCategory = request()->route('category') ?? 'All Posts';
        $scrollTag = '';
        $scrollSearch = '';
    } else {
        $archiveTitle = 'All Articles';
        $archiveSubtitle = 'Every travel story, guide, and tip from The Travel Squad.';
        $archiveBadge = 'Archive';
        $scrollCategory = 'All Posts';
        $scrollTag = '';
        $scrollSearch = '';
    }

    $initialCount = $archivePosts->count();
@endphp

<section class="archive-shell page-wrap pb-5">
<header class="archive-hero">
<nav class="breadcrumb-nav breadcrumb-nav--archive" aria-label="Breadcrumb">
<a href="{{ route('home.index') }}">Home</a>
<span class="breadcrumb-sep" aria-hidden="true">›</span>
<a href="{{ route('posts.index') }}">Articles</a>
@if ($isCategory)
<span class="breadcrumb-sep" aria-hidden="true">›</span>
<span aria-current="page">{{ $archiveTitle }}</span>
@elseif ($isTag)
<span class="breadcrumb-sep" aria-hidden="true">›</span>
<span aria-current="page">#{{ $archiveTitle }}</span>
@elseif ($isSearch)
<span class="breadcrumb-sep" aria-hidden="true">›</span>
<span aria-current="page">Search</span>
@else
<span class="breadcrumb-sep" aria-hidden="true">›</span>
<span aria-current="page">All</span>
@endif
</nav>
<span class="archive-badge">{{ $archiveBadge }}</span>
<h1 class="archive-title">{{ $isTag ? '#'.$archiveTitle : $archiveTitle }}</h1>
<p class="archive-subtitle">{{ $archiveSubtitle }}</p>
<p class="archive-count">{{ $initialCount }}+ articles</p>
</header>

<div class="archive-toolbar">
@include('partisals.filterBar')
@if (isset($popularTags) && $popularTags->isNotEmpty())
<div class="tag-filter-bar">
<span class="tag-filter-label">Popular tags</span>
<div class="tag-pills">
@foreach ($popularTags as $tag)
<a href="{{ route('postByTag', ['tag' => $tag->slug]) }}" class="tag-pill {{ (isset($tagSlug) && $tagSlug === $tag->slug) ? 'active' : '' }}">#{{ $tag->name }}</a>
@endforeach
</div>
</div>
@endif
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 g-xl-5 archive-grid" id="data-col" data-offset="{{ $initialCount }}" data-category="{{ $scrollCategory }}" data-tag="{{ $scrollTag }}" data-search="{{ $scrollSearch ?? '' }}">
@forelse ($archivePosts as $card)
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
@empty
<div class="col-12">
<div class="archive-empty">
@if ($isSearch)
<h2>No results found</h2>
<p>Try a different search term or browse <a href="{{ route('posts.index') }}">all articles</a>.</p>
@else
<h2>No articles yet</h2>
<p>Check back soon or explore <a href="{{ route('posts.index') }}">all articles</a>.</p>
@endif
</div>
</div>
@endforelse
</div>
<div id="scroll-sentinel" class="scroll-sentinel" aria-hidden="true"></div>
</section>
