@extends('layouts.master')

@section('content')
    <form action="{{url("product/edit/$product->id")}}" method="post">
        @csrf
        <img src="{{Storage::url($product->thumbnail)}}" alt="" width="500">
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
        <div class="form-floating">
            <textarea  class="form-control"  name="desc" id="desc" rows="10">{{$product->desc}}</textarea>
            <label for="desc">Description</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Edit</button>
    </form>
@endsection