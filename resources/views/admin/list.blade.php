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


      <!-- heatMap -->
    
      <div id="map" style="width: 100%; height: 500px;">

        

<script>

  // This example requires the Visualization library. Include the libraries=visualization
  // parameter when you first load the API. For example:
  // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=visualization">

 var map, heatmap;

 function initMap() {
 map = new google.maps.Map(document.getElementById('map'), {
  zoom: 13,
 center: {lat:  21.42302911, lng: 39.82492447},
  // mapTypeId: 'satellite'
                   });

  heatmap = new google.maps.visualization.HeatmapLayer({
  data: getPoints(),
  map: map
  });
  }
     // Heatmap data: 500 Points
 function getPoints() {
  return [

    new google.maps.LatLng(21.44271329,39.80257362),
    new google.maps.LatLng(21.4423438, 39.80257094),
    new google.maps.LatLng(21.44196432, 39.80260313),
    new google.maps.LatLng(21.44164476, 39.80269969),
    new google.maps.LatLng(21.44128525, 39.80271041),
    new google.maps.LatLng(21.44082588, 39.80279624),
    new google.maps.LatLng(21.44086582, 39.80335414),
    new google.maps.LatLng(21.44099565, 39.8039335),
    new google.maps.LatLng(21.44063614,39.80437338),
    new google.maps.LatLng(21.44026664, 39.8044914),
    new google.maps.LatLng(21.4401468, 39.80425537),
    new google.maps.LatLng(21.43998702, 39.80448067),
    new google.maps.LatLng(21.43976732, 39.80425537),
    new google.maps.LatLng(21.43952765, 39.8043412),
    new google.maps.LatLng(21.43939283, 39.80440825),
    new google.maps.LatLng(21.44083586, 39.80622947),
    new google.maps.LatLng(21.44062615, 39.80637968),
    new google.maps.LatLng(21.44054626, 39.80652988),
    new google.maps.LatLng(21.44047635, 39.8066479),
    new google.maps.LatLng(21.44042642, 39.80674446),
    new google.maps.LatLng(21.44031657, 39.80677664),
    new google.maps.LatLng(21.44020672, 39.80681956),
    new google.maps.LatLng(21.44027163, 39.8067686),
    new google.maps.LatLng(21.44035153, 21.44035153)
      
   ];
  }
</script>
 <script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBejOPM4uDw_MrHg4SpDUM6XwFb8Pw8lrg&libraries=visualization&callback=initMap">
 </script>

</div> 

    <div class="container">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>admin</h1>
                <div class="card">
                    <div class="card-header">Dashboard {{$statistics['open']}} {{$statistics['closed']}} {{$statistics['total']}}</div>

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