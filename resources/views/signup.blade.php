@extends('layouts.master')

@section('title')
Sign Up
@endsection

@section('content')
<style>
    .login_form{
        margin: auto;
        max-width: 330px;
        width:100%;
        padding-top: 3em;
    }
</style>
<form action="/signup" method="POST" class="login_form">
    @csrf
    <h1 class="h3 mb-3 fw-normal">Sign Up</h1>
    <div class="form-floating">
      <input type="text" class="form-control"  name="name">
      <label for="floatingInput">Name</label>
    </div>
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
      <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
      <label for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
    <p class="mt-5 mb-3 text-muted">© 2017–2021</p>
  </form>

@endsection