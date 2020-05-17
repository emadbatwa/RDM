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
                                    <div class="card">
                                        <div class="card-header card-header-primary">
                                            <h4 class="card-title ">قائمة الموظفين</h4>
                                            <!--<p class="card-category"> Here you can manage users</p>-->
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12 text-right">
                                                    <button onclick="location.href='{{ url('user/add') }}'"
                                                            class="btn btn-sm btn-primary">إضافة موظف
                                                    </button>
                                                </div>
                                            </div>
                                            <br/>
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class=" text-primary">
                                                    <tr>
                                                        <th>
                                                            الاسم
                                                        </th>
                                                        <th>
                                                            البريد الالكتروني
                                                        </th>
                                                        <th>
                                                            تاريخ الإنشاء
                                                        </th>
                                                        <th class="text-right">
                                                            إجراء
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                    @foreach($employees as $employee)
                                                        <tr>
                                                            <td>
                                                                {{$employee->name}}
                                                            </td>
                                                            <td>
                                                                {{$employee->email}}
                                                            </td>
                                                            <td>
                                                                {{$employee->created_at}}
                                                            </td>
                                                            <!-- <tr>
                                                                <td>
                                                                    mohammed
                                                                </td>
                                                                <td>
                                                                    mo@gmail.com
                                                                </td>
                                                                <td>
                                                                    2020-03-04
                                                                </td> -->
                                                            <td class="td-actions text-right">
                                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                                   href="http://gp.test/profile" data-original-title=""
                                                                   title="">
                                                                    <i class="material-icons">edit</i>
                                                                    <div class="ripple-container"></div>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
