@extends('layouts.master')

@section('content')
    @if($products)
        <ul class="d-flex flex-wrap" >
        @foreach($products as $p)
            <li class="card p-1 mw-30" style="flex: 200px;">
                <a href="{{route('product',['product' => $p])}}">{{$p->name}}</a>
                <p>{{$p->desc}}</p>
                <p>{{$p->price}}</p>
            </li>
        @endforeach
        </ul>
    @endif

@endsection