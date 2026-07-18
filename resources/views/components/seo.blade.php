@php
    $siteName = config('app.name', 'The Travel Squad');
    $pageTitle = trim($__env->yieldContent('title'));
    $metaDescription = trim($__env->yieldContent('meta_description'));
    $metaImage = trim($__env->yieldContent('meta_image'));
    $metaType = trim($__env->yieldContent('meta_type')) ?: 'website';
    $robots = trim($__env->yieldContent('meta_robots')) ?: 'index, follow';
    $canonical = trim($__env->yieldContent('canonical_url')) ?: url()->current();

    if ($metaDescription === '') {
        $metaDescription = 'The Travel Squad publishes travel stories, destination guides, and tips from a community of explorers. Discover articles on travel, food, technology, sports, and more.';
    }

    if ($metaImage === '') {
        $metaImage = asset('assets/placeholder-post.svg');
    }

    $absoluteImage = str_starts_with($metaImage, 'http') ? $metaImage : url($metaImage);
@endphp
<meta name="description" content="{{ $metaDescription }}">
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonical }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:title" content="{{ $pageTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:type" content="{{ $metaType }}">
<meta property="og:url" content="{{ $canonical }}">
<meta property="og:image" content="{{ $absoluteImage }}">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $pageTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $absoluteImage }}">
@yield('structured_data')
