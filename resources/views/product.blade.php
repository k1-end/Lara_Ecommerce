@extends('layouts.master')



@section('content')

<div class="card d-flex flex-row justify-content-start p-1">
    <img src="{{Storage::url($product->image)}}" alt="" height="500">
    <div class="w-25 ps-3">
        <a href="{{route('product',['product' => $product])}}"><h2>{{$product->name}}</h2></a>
        <p>{{$product->desc}}</p>
        <p>{{$product->price}} $</p>
        @can('EditProducts')
            <a href="{{route('edit_product',['product' => $product])}}">Edit Product</a>
            <a href="{{route('delete_product',['product' => $product])}}">Delete Product</a>
        @endcan
        @cannot('EditProducts')
            <a class="btn btn-primary" href="/add_to_cart/{{$product->id}}">Add to cart</a>
        @endcannot
    </div>
    
</div>
@endsection