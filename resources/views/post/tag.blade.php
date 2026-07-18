@extends('partisals.layout')
@section('title', '#'.$tagName.' Articles | The Travel Squad')
@section('meta_description', 'Browse articles tagged #'.$tagName.' on The Travel Squad — travel stories and guides from our community.')
@section('canonical_url', route('postByTag', ['tag' => $tagSlug]))
@section('section')
    @include('post.partials.postCards')
@endsection
