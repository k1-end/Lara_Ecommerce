@extends('layouts.master')

@section('content')
<section class="splide" aria-label="Splide Basic HTML Example">
    <div class="splide__track">
        @php
            $slides = $products->random(4);
        @endphp
          <ul class="splide__list">
              @foreach ($slides as $slide)
              <li class="splide__slide"><a href="{{route('product',['product' => $slide])}}"><img src="{{Storage::url($slide->image)}}" alt="" ></a></li>
              @endforeach
          </ul>
    </div>
  </section>
    @if($products)
        <ul class="d-flex flex-wrap" >
        @foreach($products as $p)
            <li class="card p-1 mw-30 m-1" style="flex: 200px;" >
                <a href="{{route('product',['product' => $p])}}"><img src="{{Storage::url($p->thumbnail)}}" alt="" class="img-fluid rounded"></a>
                <div class="card-body">
                <a class="card-title text-decoration-none link-dark fw-bolder" href="{{route('product',['product' => $p])}}">{{$p->name}}</a>
                <p class="card-text text-truncate" >{{$p->desc}}</p>
                <span class="fw-bolder badge bg-info text-dark">{{$p->price}}</span>
                </div>
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