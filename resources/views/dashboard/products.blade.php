@extends('layouts.master')

@section('content')
    <a href="{{route('new_product')}}">New</a>
    @if (isset($products))
    <ol>
        @foreach ($products as $product)
            <li><a href="{{url('dashboard/products/'.$product->id)}}">{{$product->category}} - {{$product->name}}</a></li>
        @endforeach
    </ol>
    @endif
@endsection