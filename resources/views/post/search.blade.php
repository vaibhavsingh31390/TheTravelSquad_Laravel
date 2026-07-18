@extends('partisals.layout')
@section('title', 'Search: '.$searchQuery.' | The Travel Squad')
@section('meta_description', 'Search results for "'.$searchQuery.'" on The Travel Squad — travel stories, guides, and tips.')
@section('canonical_url', route('posts.search', ['q' => $searchQuery]))
@section('section')
    @include('post.partials.postCards')
@endsection
