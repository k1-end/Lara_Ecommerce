@extends('layouts.master')

@section('content')
	<ul>
        @foreach($carts as $cart)
            <li class="card p-1 mw-30">
                <a href="{{route('product',['product' => $cart->product])}}">{{$cart->product->name}}</a>
                <p>Unit Price: {{$cart->product->price}}</p>
                <p>Quantity: {{$cart->quantity}}</p>
                <p>Total: {{$cart->product->price * $cart->quantity}}</p>
            </li>
        @endforeach
    </ul>
  	<a class="btn btn-primary" href="{{route('order')}}">Checkout</a>
@endsection