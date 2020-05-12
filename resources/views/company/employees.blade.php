@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if($employees ?? '')
                    @foreach($employees as $employee)
                        <p>{{$employee->id}}</p>
                        <br>
                    @endforeach
                @endif
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
                                                <a href="http://gp.test/user/create"
                                                   class="btn btn-sm btn-primary">إضافة
                                                    موظف</a>
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
                                                    <td>
                                                        mohammed
                                                    </td>
                                                    <td>
                                                        mo@gmail.com
                                                    </td>
                                                    <td>
                                                        2020-03-04
                                                    </td>
                                                    <td class="td-actions text-right">
                                                        <a rel="tooltip" class="btn btn-success btn-link"
                                                           href="http://gp.test/profile" data-original-title=""
                                                           title="">
                                                            <i class="material-icons">edit</i>
                                                            <div class="ripple-container"></div>
                                                        </a>
                                                    </td>
                                                </tr>
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
