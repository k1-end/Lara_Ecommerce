@extends('layouts.master')

@section('content')
    @if(isset($result))
        @if($result === true)
            <div class="alert alert-success">Payment was successful.</div>
        @elseif($result === false)
            <p>Payment was unsuccessful.</p>
        @endif
    @else
        <div class="alert alert-danger">The requested page is not available</div>
    @endif
@endsection