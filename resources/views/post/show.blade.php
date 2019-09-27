@extends('layout')

@section('content_title', $post->getTitle())

@section('content')
    <p>{{ $post->getBody() }}</p>
@endsection
