@extends('layouts.dashboard')

@section('content')
    <form class="w-50 m-auto" action="{{url("product/edit/$product->id")}}" method="post">
        @csrf
        <div class="text-center">
            <img class="w-50" src="{{Storage::url($product->thumbnail)}}" alt="">
        </div>
        <div class="form-floating">
            <input type="text" class="form-control"  name="name" id="name" value="{{$product->name}}">
            <label for="name">Name</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control"  name="category" id="category" value="{{ $product->category}}">
            <label for="category">Category</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control"  name="brand" id="brand" value="{{ $product->brand}}">
            <label for="brand">Brand</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control"  name="price" id="price" value="{{ $product->price}}">
            <label for="price">Price</label>
        </div>
        <div class="form-group">
            <label  for="desc">Description</label>
            <textarea  class="form-control"  name="desc" id="desc" rows="10">{{$product->desc}}</textarea>
        </div>
        <div class="container text-center ">
            <button class="w-50 btn btn-lg btn-primary" type="submit">Edit</button>
            <a class="w-50 btn btn-lg btn-danger mt-1" href="{{route('delete_product',['product' => $product])}}">Delete Product</a>
        </div>
        
    </form>
@endsection