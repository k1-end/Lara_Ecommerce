@extends('layouts.master')

@section('content')
    <form action="{{url('/dashboard/products/new')}}" method="post">
        @csrf
        <div class="form-floating">
            <input type="text" class="form-control"  name="name" id="name" >
            <label for="name">Name</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control"  name="category" id="category" >
            <label for="category">Category</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control"  name="brand" id="brand" >
            <label for="brand">Brand</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control"  name="price" id="price" >
            <label for="price">Price</label>
        </div>
        <div class="form-floating">
            <textarea  class="form-control"  name="desc" id="desc" rows="10"></textarea>
            <label for="desc">Description</label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Create</button>
    </form>
@endsection