@extends('layouts.master')

@section('content')
    @if (isset($query))
        <b>Search results for "{{$query}}":</b>
    @endif
    @if (isset($products))
        <ol>
        @foreach ($products as $product)
            <li><a href="{{url('product/'.$product->id)}}">{{$product->name}}</a></li>
        @endforeach
        </ol>
    @endif
@endsection