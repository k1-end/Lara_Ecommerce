@extends('layouts.master')
@php
$sum = 0;
@endphp

@section('content')
    <ul>
        @foreach($carts as $cart)
            <li class="card p-1 mw-30">
                <a href="{{route('product',['product' => $cart->product])}}">{{$cart->product->name}}</a>
                <p>Unit Price: {{$cart->product->price}}</p>
                <p>Quantity: {{$cart->quantity}}</p>
                <p>Total: 
                    @php
                        $total = $cart->product->price * $cart->quantity;
                        $sum +=$total;
                        echo $total;
                    @endphp
                </p>
            </li>
        @endforeach
        Sum: {{$sum}}
    </ul>
    <form action="/checkout" method="GET" class=" w-25 m-auto">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Shipping address</h1>
        <div class="form-floating">
            <input type="text" class="form-control" placeholder="Address" name="address" id="address" >
            <label for="address">Shipping address</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
    </form>

@endsection