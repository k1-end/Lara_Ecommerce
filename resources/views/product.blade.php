@extends('layouts.master')



@section('content')

<div class="card">
    <img src="{{Storage::url($product->thumbnail)}}" alt="" width="500">
    <a href="{{route('product',['product' => $product])}}">{{$product->name}}</a>
    <p>{{$product->desc}}</p>
    <p>{{$product->price}}</p>
    @can('EditProducts')
        <a href="{{route('edit_product',['product' => $product])}}">Edit Product</a>
        <a href="{{route('delete_product',['product' => $product])}}">Delete Product</a>
    @endcan
</div>
@cannot('EditProducts')
    <a class="btn btn-primary" href="/add_to_cart/{{$product->id}}">Add to cart</a>
@endcannot
@endsection