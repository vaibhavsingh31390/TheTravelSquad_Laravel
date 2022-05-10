@extends('partisals.layout')
@section('title', $CARDS[0]->category[0]->category_Menu.' Posts - The Travel Squad')

@section('section')
    @include('post.partials.postCards')
@endsection