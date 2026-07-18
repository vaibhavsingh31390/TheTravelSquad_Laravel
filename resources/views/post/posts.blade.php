@extends('partisals.layout')
@section('title', 'All Articles | The Travel Squad')
@section('meta_description', 'Browse all travel articles on The Travel Squad — destination guides, food stories, sports travel, technology on the road, and community tips.')
@section('canonical_url', route('posts.index'))
@section('section')
    @include('post.partials.postCards')
@endsection
