@extends('layouts.master')

@section('content')
    @if (isset($carts))
        @php $sum = 0; @endphp
        <table class="table mt-1 table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carts as $cart)
                    <tr class="">
                        <td>
                            <a href="{{route('product',['product' => $cart->product])}}">{{$cart->product->name}}</a>
                        </td>
                        <td>{{$cart->product->price}}$</td>
                        <td>{{$cart->quantity}}</td>
                        <td>{{$cart->product->price * $cart->quantity}}$</td>
                        @php $sum +=$cart->product->price * $cart->quantity;@endphp
                    </tr>
                @endforeach
            </tbody>
            <tfoot class="table-secondary">
                <tr>
                    <td>Total</td>
                    <td></td>
                    <td></td>
                    <td>{{$sum}}$</td>
                </tr>
            </tfoot>
        </table>
    @else
        <p>Add some products to your cart first</p>
    @endif
  	<a class="btn btn-primary" href="{{route('order')}}">Checkout</a>
@endsection