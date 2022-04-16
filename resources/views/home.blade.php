@extends('layouts.master')

@section('content')
<section class="splide" aria-label="Splide Basic HTML Example">
    <style>
        
    </style>
    <div class="splide__track">
        @php
            $slides = $products->random(4);
        @endphp
          <ul class="splide__list">
              @foreach ($slides as $slide)
              <li class="splide__slide"><a href="{{route('product',['product' => $slide])}}"><img src="{{Storage::url($slide->thumbnail)}}" alt="" ></a></li>
              @endforeach
          </ul>
    </div>
  </section>
    @if($products)
        <ul class="d-flex flex-wrap" >
        @foreach($products as $p)
            <li class="card p-1 mw-30" style="flex: 200px;">
                <a href="{{route('product',['product' => $p])}}"><img src="{{Storage::url($p->thumbnail)}}" alt="" width="200"></a>
                <a href="{{route('product',['product' => $p])}}">{{$p->name}}</a>
                <p>{{$p->desc}}</p>
                <p>{{$p->price}}</p>
            </li>
        @endforeach
        </ul>
        {{$products->links()}}
    @endif
    <script>
        new Splide( '.splide' , {
            type : 'loop',
            // rewind : true,
            focus: 'center',
            // autoplay : true,
            // interval : 1000
        }).mount();
      </script>
@endsection