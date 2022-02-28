@extends('layouts.master')



@section('content')

<div class="card">
    <a href="{{route('product',['product' => $product])}}">{{$product->name}}</a>
    <p>{{$product->desc}}</p>
    <p>{{$product->price}}</p>
    
</div>
<a class="btn btn-primary" href="/add_to_cart/{{$product->id}}">Add to cart</a>
@endsection