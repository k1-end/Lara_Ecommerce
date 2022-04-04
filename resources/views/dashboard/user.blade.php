@extends('layouts.master')  

@section('content')
    @if (isset($user))
        <ul>
            <li>ID: {{$user->id}}</li>
            <li>Name: {{$user->name}}</li>
            <li>Email: {{$user->email}}</li>
            <li>Creation date: {{$user->created_at}}</li>
        </ul>
    @endif
@endsection