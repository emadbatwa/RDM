@extends('layouts.app')
@include('layouts.nav-bar')
@section('content')
    <style>


        .center {
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;

            margin: auto;
        }

    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card center " style="width: 70%; ">
                    <div class="card-header"
                         style="align-items: center; text-align: center">{{ __('تسجيل دخول') }}</div>

                    <div class="card-body ">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <label for="email"
                                   class=" col-form-label text-md-right">{{ __('البريد الالكتروني') }}</label>

                            <div class="form-group ">

                                <div class="">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           style="width: 100%"
                                           name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <label for="password"
                                   class="text-md-right">{{ __('كلمة المرور') }}</label>

                            <div class="form-group ">

                                <div class="">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           style="width: 100%"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="center">
                                    <button type="submit" class="btn btn-primary" style="width: 200px">
                                        {{ __('تسجيل الدخول') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
