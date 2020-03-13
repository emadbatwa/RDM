@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                    @endif
                            <form action={{url('/ticket/list')}} method="get">
                                <button type="submit" class="btn btn-primary">list</button>
                            </form>
                        </div>
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
