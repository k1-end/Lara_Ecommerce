@extends('layouts.master')
@php
$sum = 0;
@endphp

@section('content')
@if (isset($carts))
@php $sum = 0; @endphp
<table class="table mt-1 table-striped">
    <thead class="table-dark">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach($carts as $cart)
            <tr>
                <td>
                    <a href="{{route('product',['product' => $cart->product])}}">{{$cart->product->name}}</a>
                </td>
                <td>{{$cart->quantity}}</td>
                @php $sum +=$cart->product->price * $cart->quantity;@endphp
            </tr>
        @endforeach
    </tbody>
    <tfoot class="table-secondary">
        <tr>
            <td>Total</td>
            <td>{{$sum}}$</td>
        </tr>
    </tfoot>
</table>
@else
<p>Add some products to your cart first</p>
@endif
    <form action="/checkout" method="GET" class=" w-25 m-auto">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Shipping Address</h1>
        <div class="form-floating">
            <input type="text" class="form-control" placeholder="Address" name="address" id="address" >
            <label for="address">Shipping Address</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Submit</button>
    </form>

@endsection