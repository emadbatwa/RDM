@extends('layouts.app')
@section('content')
    <div class="sidebar shadow-sm w">
        <!--
          Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

          Tip 2: you can also add an image using data-image tag
      -->
        <div class="logo ">
            <a href="{{ url('/ticket/list') }}" class="simple-text logo-normal">
                <img src="{{ asset('material') }}/img/logo.png" alt="Smiley" style="height: 46px">
            </a>
        </div>


        <div class="sidebar-wrapper w">
            <ul class="nav ">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/ticket/list') }}">
                        <i class="material-icons">list_alt</i>
                        <p>التذاكر</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ url('/user/employees') }}">  <!--  need to be  -->
                        <i class="material-icons">group</i>
                        <p>الموظفين</p>
                    </a>
                </li>
                <li class="nav-item  fixed-bottom-m">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">

                        <i class="material-icons">logout</i>
                        <p>تسجيل خروج</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

            </ul>
        </div>

    </div>
    @include('layouts.Side-bar-toggle')
    <div class="main-panel">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="post" action="{{url('/register')}}" autocomplete="off"
                                          class="form-horizontal">
                                        @csrf
                                        <div class="card ">
                                            <div class="card-header card-header-primary">
                                                <h4 class="card-title">{{ __('اضافة موظف') }}</h4>
                                                <p class="card-category"></p>
                                            </div>
                                            <div class="card-body ">
                                                <div class="row">
                                                    <div class="col-md-12 text-right">
                                                        <button onclick="location.href='{{ url('user/employees') }}'"
                                                                class="btn btn-sm btn-primary">{{ __('العودة للقائمة') }}</button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label">{{ __('الاسم') }}</label>
                                                    <div class="col-sm-7">
                                                        <div
                                                            class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                                            <input
                                                                class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                name="name" id="input-name" type="text"
                                                                placeholder="{{ __('الاسم') }}"
                                                                value="{{ old('name') }}" required="true"
                                                                aria-required="true"/>
                                                            @if ($errors->has('name'))
                                                                <span id="name-error" class="error text-danger"
                                                                      for="input-name">{{ $errors->first('name') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label
                                                        class="col-sm-2 col-form-label">{{ __('البريد الالكتروني') }}</label>
                                                    <div class="col-sm-7">
                                                        <div
                                                            class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                                            <input
                                                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                                name="email" id="input-email" type="email"
                                                                placeholder="{{ __('البريد الاكتروني') }}"
                                                                value="{{ old('email') }}" required/>
                                                            @if ($errors->has('email'))
                                                                <span id="email-error" class="error text-danger"
                                                                      for="input-email">{{ $errors->first('email') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label"
                                                           for="input-password">{{ __('كلمة المرور') }}</label>
                                                    <div class="col-sm-7">
                                                        <div
                                                            class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                                            <input
                                                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                                input type="password" name="password"
                                                                id="input-password"
                                                                placeholder="{{ __('كلمة المرور') }}" value=""
                                                                required/>
                                                            @if ($errors->has('password'))
                                                                <span id="name-error" class="error text-danger"
                                                                      for="input-name">{{ $errors->first('password') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label class="col-sm-2 col-form-label"
                                                           for="input-password-confirmation">{{ __('تأكيد كلمة المرور') }}</label>
                                                    <div class="col-sm-7">
                                                        <div class="form-group">
                                                            <input class="form-control" name="password_confirmation"
                                                                   id="input-password-confirmation" type="password"
                                                                   placeholder="{{ __('تأكيد كلمة المرور') }}" value=""
                                                                   required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer ml-auto mr-auto">
                                                <button type="submit"
                                                        class="btn btn-primary">{{ __('اضافة موظف') }}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
