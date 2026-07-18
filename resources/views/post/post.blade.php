@extends('partisals.layout')
@section('title', $posts->title.' | The Travel Squad')
@section('meta_description', Str::limit(strip_tags($posts->content), 155))
@section('meta_image', $posts->media?->url() ?? \App\Models\Media::placeholderPostUrl())
@section('meta_type', 'article')
@section('canonical_url', route('posts.show', $posts->id))
@section('structured_data')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Article',
    'headline' => $posts->title,
    'description' => Str::limit(strip_tags($posts->content), 200),
    'image' => [$posts->media?->url() ?? \App\Models\Media::placeholderPostUrl()],
    'datePublished' => $posts->created_at->toAtomString(),
    'dateModified' => $posts->updated_at->toAtomString(),
    'author' => [
        '@type' => 'Person',
        'name' => $author,
    ],
    'publisher' => [
        '@type' => 'Organization',
        'name' => config('app.name', 'The Travel Squad'),
        'url' => url('/'),
    ],
    'mainEntityOfPage' => route('posts.show', $posts->id),
    'articleSection' => optional($posts->category()->first())->category_Menu,
    'keywords' => $posts->tags->pluck('name')->join(', '),
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection
@section('section')
    @include('partisals.singlePostLayout')
@endsection
