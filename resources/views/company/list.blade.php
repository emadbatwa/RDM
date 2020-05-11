<html lang="fa" dir="rtl">
@extends('layouts.app')

@section('content')
    <script>
        $(document).ready(function () {
            $('#example').DataTable({});
        });
    </script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>company</h1>
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <table id="example" class="display" style="width:100%">
                            <thead>
                            <tr>
                                <th>رقم التذكرة</th>
                                <th>الوصف</th>
                                <th>الحالة</th>
                                <th>الدرجة</th>
                                <th>التصنيف</th>
                                <th>تاريخ الإنشاء</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{$ticket['ticket']->id}}</td>
                                    <td>{{$ticket['ticket']->description}}</td>
                                    <td>{{$ticket['ticket']->status_ar}}</td>
                                    <td>{{$ticket['ticket']->degree_ar}}</td>
                                    <td>{{$ticket['ticket']->classification_ar}}</td>
                                    <td>{{$ticket['ticket']->created_at}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>رقم التذكرة</th>
                                <th>الوصف</th>
                                <th>الحالة</th>
                                <th>الدرجة</th>
                                <th>التصنيف</th>
                                <th>تاريخ الإنشاء</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
