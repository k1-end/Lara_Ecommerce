@extends('layouts.master')

@section('content')
    @if(isset($result))
        @if($result === true)
            <p>Payment was successful.</p>
        @elseif($result === false)
            <p>Payment was unsuccessful.</p>
        @endif
    @else
        <p>The requested page is not available</p>
    @endif
@endsection