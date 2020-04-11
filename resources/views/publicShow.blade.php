@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>public</h1>
                @if($ticket ?? '')
                    {{$ticket['ticket']->id}}
                    <br>
                    {{$ticket['location']->city}}
                    <br>
                    @foreach($ticket['photos'] as $photo)
                        @if($photo->role_id ==1)
                            <img src="{{'http://www.ai-rdm.website/storage/photos/'.$photo->photo_name}}"
                                 alt="photo">
                        @endif
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
