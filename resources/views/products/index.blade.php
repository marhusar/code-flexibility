@extends('layout')

@section('content_title', 'Products')

@section('content')
<p>@foreach ($product_list as $product)
    <p>{{ $product->getId() }}</p>
    <p>{{ $product->getName() }}</p>
    @endforeach
</p>
@endsection
