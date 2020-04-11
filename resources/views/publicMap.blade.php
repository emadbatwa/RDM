@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>public map</h1>
                @if($tickets ?? '')
                    @foreach($tickets as $ticket)
                        <p>{{$ticket['ticket']->status_ar}}</p>
                        <p>{{$ticket['location']->latitude}}</p>
                        <p>{{$ticket['location']->longitude}}</p>
                        <br/>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
