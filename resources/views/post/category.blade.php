@extends('partisals.layout')
@section('title', $categoryName.' Articles | The Travel Squad')
@section('meta_description', 'Read '.$categoryName.' articles on The Travel Squad — curated travel stories and guides from our community.')
@section('canonical_url', route('postByCategory', ['category' => request()->route('category')]))
@section('section')
    @include('post.partials.postCards')
@endsection
