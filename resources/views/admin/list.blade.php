<html lang="fa" dir="rtl">


@extends('layouts.app' )

@section('head')
    <style>

      .w{
          width: 20%;
      }
    </style>
@endsection

@section('content')
    <div class="wrapper">


        <div class="sidebar shadow-sm w">
            <!--
              Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

              Tip 2: you can also add an image using data-image tag
          -->
            <div class="logo ">
                <a href="http://gp.test/public/home" class="simple-text logo-normal">
                    <img src="/images/logo.png" alt="Smiley" height="42" width="42">
                </a>
            </div>


            <div class="sidebar-wrapper w">
                <ul class="nav ">
                    <li class="nav-item" >
                        <a class="nav-link" href="#map">
                            <i class="material-icons">map</i>
                            <p>الخريطة</p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="#table">  <!--  need to be  -->
                            <i class="material-icons">list_alt</i>
                            <p>التذاكر</p>
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

        <script>
            $(document).on('hidden.bs.modal', '#detailsModal', function () {
                clearr();
            });

            function clearr() {
                console.log("dd");
                $('#description').text("");
                $('#assigned_company').text(""); // @@@@@@@
                $('#classification_ar').text("");
                $('#degree_ar').text("");
                $('#status_ar').text("");
                $('#created_at').text("");
                $('#updated_at').text("");
                $('#id').text("");

                var fixPhotos = document.getElementById('fixPhotos');
                var problemPhotos = document.getElementById('problemPhotos');
                for (i = 0; i <= 3; i++) {
                    problemPhotos.children[i].src = "{{url('/images/defaultPhoto.png')}}";
                }
                for (i = 0; i <= 3; i++) {
                    fixPhotos.children[i].src = "{{url('/images/defaultPhoto.png')}}";
                }
            }

            $(document).ready(function () {
                var table = $('#example').DataTable({});
            });


            function getid(ele) {
                var id = ele.id;
                console.log(id);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: '{{ route('ticket.show') }}',
                    data: {ticketId: id},
                    success: function (data) {
                        console.log(data);
                        $('#description').text(data['ticket'].description);
                        $('#assigned_company').text(data['assignedCompany'].name);
                        $('#classification_ar').text(data['ticket'].classification_ar);
                        $('#degree_ar').text(data['ticket'].degree_ar);
                        $('#status_ar').text(data['ticket'].status_ar);
                        $('#created_at').text(data['ticket'].created_at);
                        $('#updated_at').text(data['ticket'].updated_at);
                        $('#id').text(data['ticket'].id);
                        var photos = data['photos'];
                        var fixPhotos = document.getElementById('fixPhotos');
                        var problemPhotos = document.getElementById('problemPhotos');
                        var childrenCounter = 0;
                        for (i = 0; i <= photos.length - 1; i++) {
                            if (photos[i].role_id === 1) {
                                problemPhotos.children[childrenCounter++].src = "http://www.ai-rdm.website/storage/photos/" + photos[i].photo_name;
                            }
                        }
                        childrenCounter = 0;
                        for (i = 0; i <= photos.length - 1; i++) {
                            if (photos[i].role_id === 3) {
                                fixPhotos.children[childrenCounter++].src = "http://www.ai-rdm.website/storage/photos/" + photos[i].photo_name;
                            }
                        }

                    },
                    fail: function (data) {
                        console.log('failed');
                    }
                });
            }

        </script>
        <div class="main-panel">
            <!-- heatMap -->

            <div id="map" style="width: 100%; height: 400px;">


                <script>

                    // This example requires the Visualization library. Include the libraries=visualization
                    // parameter when you first load the API. For example:
                    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=visualization">

                    var map, heatmap;

                    function initMap() {
                        map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 13,
                            center: {lat: 21.42302911, lng: 39.82492447},
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

                            new google.maps.LatLng(21.44271329, 39.80257362),
                            new google.maps.LatLng(21.4423438, 39.80257094),
                            new google.maps.LatLng(21.44196432, 39.80260313),
                            new google.maps.LatLng(21.44164476, 39.80269969),
                            new google.maps.LatLng(21.44128525, 39.80271041),
                            new google.maps.LatLng(21.44082588, 39.80279624),
                            new google.maps.LatLng(21.44086582, 39.80335414),
                            new google.maps.LatLng(21.44099565, 39.8039335),
                            new google.maps.LatLng(21.44063614, 39.80437338),
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
                    <div class="">

                        <div class="">
                            <div class="card-header" id="table">
                                Dashboard {{$statistics['open']}} {{$statistics['closed']}} {{$statistics['total']}}</div>

                            <div class="card-body">
                                <table id="example" class="display " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>رقم التذكرة</th>
                                        <th>الوصف</th>
                                        <th>الحالة</th>
                                        <th>الدرجة</th>
                                        <th>التصنيف</th>
                                        <th>الشركة</th>
                                        <th>تاريخ الإنشاء</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <!-- data-target="#detailsModal" onclick="location.href=‘ticket/show/{$ticket->id’" -->
                                    @foreach($tickets as $ticket)
                                        <!-- <a href="/ticket/show/{{$ticket['ticket']->id}}"> -->
                                        <tr class="table-row" id="{{$ticket['ticket']->id}}" data-toggle="modal"
                                            onclick="getid(this);" data-target="#detailsModal">
                                            <td>{{$ticket['ticket']->id}}</td>
                                            <td>{{$ticket['ticket']->description}}</td>
                                            <td>{{$ticket['ticket']->status_ar}}</td>
                                            <td>{{$ticket['ticket']->degree_ar}}</td>
                                            <td>{{$ticket['ticket']->classification_ar}}</td>
                                            @if($ticket['assignedCompany'] != null)
                                                <td>{{$ticket['assignedCompany']->name}}</td>
                                            @else
                                                <td>لا يوجد</td>
                                            @endif
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
                                        <th>الشركة</th>
                                        <th>تاريخ الإنشاء</th>
                                    </tr>
                                    </tfoot>
                                </table>


                                <div id="detailsModal" class="modal fade bd-example-modal-lg" role="dialog"
                                     aria-labelledby="detailsModal"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header" style="text-align:center">
                                                <table>

                                                    <tr>
                                                        <th class="modal-title text-right"> تذكرة رقم:</th>
                                                        <td id="id"></td>
                                                        <th class="modal-title">الحالة:</th>
                                                        <td id="status_ar"></td>

                                                        <button type="button" id="closeWindow" class="close"
                                                                data-dismiss="modal"
                                                                aria-hidden="true" onclick="clearr();">
                                                            &times;
                                                        </button>
                                                    </tr>
                                                </table>
                                            </div>

                                            <p>
                                            <table class="table">
                                                <tr>
                                                    <th>تاريخ الإنشاء:</th>
                                                    <td id="created_at"></td>
                                                    <th>تاريخ التعديل:</th>
                                                    <td id="updated_at"></td>
                                                    <th>صور البلاغ</th>


                                                    <td id="problemPhotos">
                                                        <img src="" alt="ticket photo" height="100" width="100">
                                                        <img src="" alt="ticket photo" height="100" width="100">
                                                        <img src="" alt="ticket photo" height="100" width="100">
                                                        <img src="" alt="ticket photo" height="100" width="100">
                                                    </td>


                                                </tr>
                                                <tr>
                                                    <th>التصنيف:</th>

                                                    <td>

                                                        <div class="dropdown">
                                                            <select type="button" class="btn dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <option selected>1</a>
                                                                <option>2</a>
                                                                <option>3</a>
                                                            </select>
                                                        </div>

                                                    </td>
                                                    <th>حجم الضرر:</th>
                                                    <td id="degree_ar"></td>
                                                    <th>الوصف</th>
                                                    <td id="description"></td>


                                                </tr>
                                                <tr>
                                                    <th>التصنيف:</th>

                                                    <td>

                                                        <div class="btn-group">
                                                            <select type="button" class="btn"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                @foreach($classifications as $classification)
                                                                    <option
                                                                        value="{{$classification->id}}">{{$classification->classification_ar}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                    </td>
                                                    <th>الشركة:</th>

                                                    <td>
                                                        <div class="btn-group">
                                                            <select type="button" class="btn  dropdown-toggle"
                                                                    data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <!-- <option id="assigned_company" selected>1</a> -->
                                                                <!-- @@@@@@@ -->
                                                                @foreach($companies as $company)
                                                                    <option
                                                                        value="{{$company->id}}">{{$company->name}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </td>
                                                    <th>صور الاصلاح</th>
                                                    <td id="fixPhotos">
                                                        <img src="" alt="ticket photo" height="100" width="100">
                                                        <img src="" alt="ticket photo" height="100" width="100">
                                                        <img src="" alt="ticket photo" height="100" width="100">
                                                        <img src="" alt="ticket photo" height="100" width="100">
                                                    </td>
                                                </tr>
                                                <!-- <tr>
                                                    <td style="text-align:center" colspan="4">
                                                        <a class="collapsee" data-toggle="collapse"
                                                           href="#collapseExample"
                                                           role="button" aria-expanded="false"
                                                           aria-controls="collapseExample">
                                                        </a>
                                                    </td>
                                                </tr> -->
                                            </table>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
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
</html>
