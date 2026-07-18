@extends('partisals.layout')
@section('title', 'Home | The Travel Squad')
@section('meta_description', 'Discover travel stories, destination guides, and tips from The Travel Squad community. Explore featured articles on travel, food, sports, technology, and more.')
@section('canonical_url', route('home.index'))
@section('structured_data')
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => config('app.name', 'The Travel Squad'),
    'url' => url('/'),
    'potentialAction' => [
        '@type' => 'SearchAction',
        'target' => route('posts.index'),
        'query-input' => 'required name=search_term_string',
    ],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
@endsection
@section('section')
@include('partisals.cards')
@endsection
