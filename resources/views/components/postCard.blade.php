@php
    $variant = $variant ?? 'grid';
    $categoryName = $categoryName ?? optional($post ?? null)->category()->first()->category_Menu ?? 'Travel';
    $authorName = optional(optional($post ?? null)->user)->name ?? 'Travel Squad';
    $authorAvatar = optional(optional($post ?? null)->user)->media?->url() ?? \App\Models\Media::placeholderAvatarUrl();
    $postTags = $tags ?? optional($post)->tags ?? collect();
@endphp

@if ($variant === 'featured')
<div class="card card-featured h-100" data-id="{{ $id }}">
<a href="{{ route("$route", [$id]) }}" class="featured-link">
<div class="featured-img-wrap">
<img src="{{ $path ?: \App\Models\Media::placeholderPostUrl() }}" alt="{{ $title }}">
</div>
<div class="featured-content">
<span class="card-tag">{{ strtoupper($categoryName) }}</span>
<h3 class="card-title">{{ Str::of($title)->limit(90) }}</h3>
<div class="featured-meta">
<span>{{ $authorName }}</span>
<span>{{ $createdAt }}</span>
</div>
</div>
</a>
</div>

@elseif ($variant === 'compact')
<a href="{{ route("$route", [$id]) }}" class="card card-compact h-100" data-id="{{ $id }}">
<div class="compact-img-wrap">
<img src="{{ $path ?: \App\Models\Media::placeholderPostUrl() }}" alt="{{ $title }}">
</div>
<div class="compact-content">
<span class="card-tag">{{ strtoupper($categoryName) }}</span>
<h4 class="card-title">{{ Str::of($title)->limit(60) }}</h4>
</div>
</a>

@else
<article class="card card-grid h-100" data-id="{{ $id }}">
<a href="{{ route("$route", [$id]) }}" class="card-grid__hit">
<div class="card-grid__media">
<span class="img-tag">{{ strtoupper($categoryName) }}</span>
<img src="{{ $path ?: \App\Models\Media::placeholderPostUrl() }}" class="card-img-top" alt="{{ $title }}">
</div>
<div class="card-grid__body">
<div class="card-title-row">
<h4 class="card-title">{{ Str::of($title)->limit(58) }}</h4>
<span class="card-arrow" aria-hidden="true"><i class='bx bx-up-arrow-alt'></i></span>
</div>
<p class="card-text">{{ Str::of(strip_tags($content))->limit(105) }}</p>
</div>
</a>

@if ($postTags->isNotEmpty())
<div class="card-grid__tags">
@foreach ($postTags->take(3) as $tag)
<a href="{{ route('postByTag', ['tag' => $tag->slug]) }}" class="tag-pill tag-pill--sm">#{{ $tag->name }}</a>
@endforeach
</div>
@endif

<footer class="card-grid__footer">
<img src="{{ $authorAvatar }}" alt="{{ $authorName }}" class="author-avatar">
<div class="author-info">
<span class="author-name">{{ $authorName }}</span>
<small class="date_Added">{{ $createdAt }}</small>
</div>
</footer>
</article>
@endif
