@extends('layouts.dashboard')

@section('content')
    @if (isset($users))
    <ol>
        @foreach ($users as $user)
            <li><a href="{{url('dashboard/'.$user->id)}}">{{$user->email}} - {{$user->name}}</a></li>
        @endforeach
    </ol>
    @endif
@endsection