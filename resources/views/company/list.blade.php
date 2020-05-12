<html lang="fa" dir="rtl">
@extends('layouts.app')

@section('content')
    <script>
        $(document).ready(function () {
             window.tickets = @json($tickets);
           var table =  $('#example').DataTable({});
});


function getid (ele) {
  var id = ele.id;
    console.log( id );

    var ticket = window.tickets[id];
    console.log(ticket['ticket'].description);
    console.log(ticket);
    $('#description').text(ticket['ticket'].description);
    $('#assigned_company').text(ticket['ticket'].assigned_company); // @@@@@@@
    $('#classification_ar').text(ticket['ticket'].classification_ar);
    $('#degree_ar').text(ticket['ticket'].degree_ar);
    $('#status_ar').text(ticket['ticket'].status_ar);
    $('#created_at').text(ticket['ticket'].created_at);
    $('#updated_at').text(ticket['ticket'].updated_at);
    $('#id').text(ticket['ticket'].id);
   
}
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
                                <tr class="table-row" id="{{$ticket['ticket']->id-1}}" data-toggle="modal" onclick="getid(this);" data-target="#detailsModal">
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
        <h4 id="id">  </h4>
        <h7 class="modal-title">الحالة:  </h7>
        <h7 id="status_ar"> </h7> 

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>

    <p>
    <table class="table">
    <tr>
    <th>تاريخ الإنشاء:</th>
    <td id="created_at"></td>
    <th>تاريخ التعديل:</th>
    <td id="updated_at"></td>
    <th>صور البلاغ</th>
  </tr>
  <tr>
    <th>التصنيف:</th>
    <td id="classification_ar"></td>
    <td>

    <div class="btn-group">
        <select  type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <option  selected >1</a>
        <option >2</a>
        <option >3</a>
        </select>
    </div>

</td>
        <th>حجم الضرر:</th>
        <td id="degree_ar"></td>
      <th>الوصف</th>
      <td id="description"></td>
        <td rowspan="2"> الصور </td>
  </tr>
  <tr>
    <th>الشركة:</th>
    <td id="assigned_company"></td>
    <td>
    <div class="btn-group">
  <select  type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <option id="assigned_company" selected >1</a>  <!-- @@@@@@@ -->
    <option >2</a>
    <option >3</a>
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
