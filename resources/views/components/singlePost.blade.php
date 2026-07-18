@php
    $categoryName = optional($posts->category()->first())->category_Menu ?? 'Article';
    $categoryRoute = route('postByCategory', ['category' => $categoryName]);
    $authorAvatar = optional($posts->user)->media?->url() ?? \App\Models\Media::placeholderAvatarUrl();
    $readingMinutes = max(1, (int) ceil(str_word_count(strip_tags($posts->content)) / 220));
@endphp

<article class="post-article">
<header class="post-hero">
<div class="post-hero-media">
<img src="{{ $posts->media?->url() ?? \App\Models\Media::placeholderPostUrl() }}" alt="{{ $posts->title }}">
<div class="post-hero-overlay"></div>
</div>

<div class="post-hero-inner">
<div class="post-layout">
<nav class="breadcrumb-nav breadcrumb-nav--hero" aria-label="Breadcrumb">
<a href="{{ route('home.index') }}">Home</a>
<span class="breadcrumb-sep" aria-hidden="true">›</span>
<a href="{{ route('posts.index') }}">Articles</a>
<span class="breadcrumb-sep" aria-hidden="true">›</span>
<a href="{{ $categoryRoute }}">{{ $categoryName }}</a>
</nav>

<a href="{{ $categoryRoute }}" class="post-label">{{ strtoupper($categoryName) }}</a>
<h1 class="post-hero-title">{{ $posts->title }}</h1>

<div class="post-hero-meta">
<div class="post-author-chip">
<img src="{{ $authorAvatar }}" alt="{{ $author }}" class="post-author-avatar">
<div>
<span class="post-author-name">{{ $author }}</span>
<small class="post-hero-date">{{ $posts->created_at->format('M d, Y') }} · {{ $readingMinutes }} min read</small>
</div>
</div>
</div>

@if ($posts->tags->isNotEmpty())
<div class="post-tags">
@foreach ($posts->tags as $tag)
<a href="{{ route('postByTag', ['tag' => $tag->slug]) }}" class="tag-pill">#{{ $tag->name }}</a>
@endforeach
</div>
@endif
</div>
</div>
</header>

<div class="post-body">
<div class="post-layout">
<div class="post-reactions" role="group" aria-label="Article reactions">
<div class="reaction-group">
<label class="reaction-btn" for="like_Btn">
<input type="checkbox" name="likeBtn" id="like_Btn" data-index-number="{{ $posts->id }}" data-id="{{ $posts->users_id }}">
<i class='bx bx-heart actionIcon' id="like_Btn_Icon" aria-hidden="true"></i>
<span class="reaction-count" id="like_val">{{ $posts->likeCount()->count() }}</span>
<span class="reaction-label">Like</span>
</label>
<label class="reaction-btn" for="dislike_Btn">
<input type="checkbox" name="dislikeBtn" id="dislike_Btn" data-index-number="{{ $posts->id }}" data-id="{{ $posts->users_id }}">
<i class='bx bx-dislike actionIcon' id="dislike_Btn_Icon" aria-hidden="true"></i>
<span class="reaction-count" id="dislike_val">{{ $posts->dislikeCount()->count() }}</span>
<span class="reaction-label">Dislike</span>
</label>
</div>
</div>

<div class="post-content">{!! $posts->content !!}</div>

<footer class="post-footer">
<div class="post-author-card">
<img src="{{ $authorAvatar }}" alt="{{ $author }}" class="post-author-avatar">
<div>
<p class="post-author-card-label">Written by</p>
<p class="post-author-card-name">{{ $author }}</p>
</div>
</div>
@if ($posts->tags->isNotEmpty())
<div class="post-footer-tags">
<span class="post-footer-tags-label">Tagged</span>
@foreach ($posts->tags as $tag)
<a href="{{ route('postByTag', ['tag' => $tag->slug]) }}" class="tag-pill tag-pill--sm">#{{ $tag->name }}</a>
@endforeach
</div>
@endif
</footer>
</div>
</div>
</article>
