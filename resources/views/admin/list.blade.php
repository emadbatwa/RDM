<html lang="fa" dir="rtl">


@extends('layouts.app' )

@section('content')
    <script>
        $(document).ready(function () {
             window.tickets = @json($tickets);
           var table =  $('#example').DataTable({});
        //});
        //$('#example tbody').on( 'click', 'tr', function () {
  // Get the rows id value

  //var id = this.value;
  //alert( 'Clicked row id '+id );
});


function getid (ele) {
  var id = ele.id;
    console.log( id );

    var ticket = window.tickets[id];
    console.log(ticket['ticket'].description);
    console.log(ticket);
    $('#description').text(ticket['ticket'].description);
}

</script>



    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>admin</h1>
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
                             <!-- data-target="#detailsModal" onclick="location.href=‘ticket/show/{$ticket->id’" -->
                            @foreach($tickets as $ticket)
                            <!-- <a href="/ticket/show/{{$ticket['ticket']->id}}"> -->
                            <tr class="table-row" id="{{$ticket['ticket']->id}}" value ="1" data-toggle="modal" onclick="getid(this);" data-target="#detailsModal">
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

<div id="detailsModal" class="modal fade" role="dialog" aria-labelledby="detailsModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> تذكرة رقم:  </h4>
        <h7 class="modal-title">الحالة:  </h7>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>

    <p>
    <table class="table">
    <tr>
    <th>تاريخ الإصدار:</th>
    <td>1\1</td>
    <th>تاريخ التعديل:</th>
    <td>1\2</td>
    <th>صور البلاغ</th>
  </tr>
  <tr>
    <th>التصنيف:</th>
    <td>

    <div class="btn-group">
        <select  type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <option value="makkah" selected >1</a>
        <option value="madina">2</a>
        <option value="jeddah">3</a>
        </select>
    </div>

</td>
        <th>حجم الضرر:</th>
        <td>عالي</td>
      <th>الوصف</th>
      <td id="description"></td>
        <td rowspan="2"> الصور </td>
  </tr>
  <tr>
    <th>الموظف المسؤول:</th>
    <td>
    <div class="btn-group">
  <select  type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <option value="makkah" selected >1</a>
    <option value="madina">2</a>
    <option value="jeddah">3</a>
</select>
</div>
    </td>
    </tr>
    <tr>
    <td style="text-align:center" colspan="4">
    <a class="collapsee" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    </a>
    </td>
    </tr>
    </table>
</p>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
			<input type="submit" class="btn btn-info" value="Save">
            </div>
        </div>
      </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</html>
