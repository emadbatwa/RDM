<html lang="fa" dir="rtl">


@extends('layouts.app' )

@section('head')

@endsection

@section('content')
    <div class="wrapper">


        <div class="sidebar shadow-sm ">
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
                    <li class="nav-item">
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
            $(document).ready(function () {
                var tickets = @json($tickets);
                console.log(tickets);
                $('#tableBody').append(tickets);
                window.table = $('#example').DataTable({
                    "language": {
                        "lengthMenu": "عرض _MENU_ تذكرة لكل صفحة",
                        "zeroRecords": "لا توجد تذاكر",
                        "info": "عرض صفحة _PAGE_ من _PAGES_",
                        "infoEmpty": "لا يوجد تذاكر",
                        "infoFiltered": "(ترتيب من _MAX_ كل التذاكر)",
                        "search": "البحث:",
                        "paginate": {
                            "previous": "السابق",
                            "next": "التالي",
                        }
                    }
                });
            });
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
                                    <tbody id="tableBody">
                                    <!-- data-target="#detailsModal" onclick="location.href=‘ticket/show/{$ticket->id’" -->

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
                                                                aria-hidden="true">
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

                                                        <div class="btn-group">
                                                            <select id="classifications" type="button" class="btn"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false">
                                                            </select>
                                                        </div>
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="updateClassification();">
                                                            تغيير التصنيف
                                                        </button>
                                                    </td>
                                                    <th>حجم الضرر:</th>
                                                    <td id="degree_ar"></td>
                                                    <th>الوصف</th>
                                                    <td id="description"></td>


                                                </tr>
                                                <tr>

                                                    <th>اسم المبلغ:</th>
                                                    <td id="username"></td>
                                                    <th>رقم المبلغ:</th>
                                                    <td id="userphone"></td>

                                                    <th>الشركة:</th>

                                                    <td>
                                                        <div class="btn-group">
                                                            <select id="companies" type="button"
                                                                    class="btn  dropdown-toggle"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <!-- <option id="assigned_company" selected>1</a> -->
                                                                <!-- @@@@@@@ -->
                                                            </select>
                                                        </div>
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="assignTicket();">
                                                            اسناد
                                                        </button>
                                                    </td>
                                                    <th>صور الاصلاح</th>
                                                    <td id="fixPhotos">
                                                        <img src="{{url('/images/defaultPhoto.png')}}"
                                                             alt="ticket photo" height="100" width="100">
                                                        <img src="{{url('/images/defaultPhoto.png')}}"
                                                             alt="ticket photo" height="100" width="100">
                                                        <img src="{{url('/images/defaultPhoto.png')}}"
                                                             alt="ticket photo" height="100" width="100">
                                                        <img src="{{url('/images/defaultPhoto.png')}}"
                                                             alt="ticket photo" height="100" width="100">
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
                                                <button type="button" class="btn btn-primary" onclick="closeTicket();">
                                                    إغلاق التذكرة
                                                </button>
                                                <button type="button" class="btn btn-primary"
                                                        onclick="excludeTicket();">
                                                    استبعاد التذكرة
                                                </button>
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
            $('#classifications').children().remove();
            $('#companies').children().remove();

            var fixPhotos = document.getElementById('fixPhotos');
            var problemPhotos = document.getElementById('problemPhotos');
            for (i = 0; i <= 3; i++) {
                problemPhotos.children[i].src = "{{url('/images/defaultPhoto.png')}}";
            }
            for (i = 0; i <= 3; i++) {
                fixPhotos.children[i].src = "{{url('/images/defaultPhoto.png')}}";
            }
        }

        function getid(ele) {
            window.id = ele.id;
            console.log(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                url: '{{ route('ticket.show') }}',
                data: {ticketId: window.id},
                success: function (data) {
                    console.log(data);
                    $('#description').text(data['ticket']['ticket'].description);
                    $('#assigned_company').text(data['ticket']['assignedCompany'].name);
                    $('#classification_ar').text(data['ticket']['ticket'].classification_ar);
                    if (data['ticket']['ticket'].degree_ar === null) {
                        $('#degree_ar').text('لا يوجد');
                    } else {
                        $('#degree_ar').text(data['ticket']['ticket'].degree_ar);
                    }
                    $('#status_ar').text(data['ticket']['ticket'].status_ar);
                    $('#username').text(data['ticket']['ticket'].userName);
                    $('#userphone').text(data['ticket']['ticket'].userPhone);
                    $('#created_at').text(data['ticket']['ticket'].created_at);
                    $('#updated_at').text(data['ticket']['ticket'].updated_at);
                    $('#id').text(window.id);
                    var classifications = '';
                    for (i = 0; i <= data['classifications'].length - 1; i++) {
                        if (data['classifications'][i].classification_ar === data['ticket']['ticket'].classification_ar) {
                            classifications += '<option selected value="' + data['classifications'][i].id + '">' + data['classifications'][i].classification_ar + '</option>';
                        } else {
                            classifications += '<option value="' + data['classifications'][i].id + '">' + data['classifications'][i].classification_ar + '</option>';
                        }
                        var companies = '';

                    }
                    console.log(data['ticket']['assignedCompany'].id);
                    if (data['ticket']['assignedCompany'].id === undefined) {
                        companies += '<option selected value="">لا يوجد</option>';
                        for (i = 0; i <= data['companies'].length - 1; i++) {
                            companies += '<option value="' + data['companies'][i].id + '">' + data['companies'][i].name + '</option>';
                        }
                    } else {
                        for (i = 0; i <= data['companies'].length - 1; i++) {
                            if (data['companies'][i].id === data['ticket']['assignedCompany'].id) {
                                companies += '<option selected value="' + data['companies'][i].id + '">' + data['companies'][i].name + '</option>';
                            } else {
                                companies += '<option value="' + data['companies'][i].id + '">' + data['companies'][i].name + '</option>';
                            }
                        }
                    }
                    $('#classifications').append(classifications);
                    $('#companies').append(companies);
                    var photos = data['ticket']['photos'];
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
                error: function (data) {
                    console.log('failed');
                }
            });
        }

        function updateTable() {
            console.log(window.id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'get',
                url: '{{ route('ticket.list') }}',
                data: {},
                success: function (data) {
                    window.table.destroy();
                    $('#tableBody').children().remove();
                    $('#tableBody').append(data);
                    window.table = $('#example').DataTable({
                        "language": {
                            "lengthMenu": "عرض _MENU_ تذكرة لكل صفحة",
                            "zeroRecords": "لا توجد تذاكر",
                            "info": "عرض صفحة _PAGE_ من _PAGES_",
                            "infoEmpty": "لا يوجد تذاكر",
                            "infoFiltered": "(ترتيب من _MAX_ كل التذاكر)",
                            "search": "البحث:",
                            "paginate": {
                                "previous": "السابق",
                                "next": "التالي",
                            }
                        }
                    });
                },
                error: function (data) {
                    console.log('failed');
                }
            });
        }

        function updateClassification() {
            var classification = $("#classifications").val();
            var ticketId = window.id;
            Swal.fire({
                title: 'هل أنت متأكد?',
                text: "سيتم تغيير تصنيف التذكرة",
                type: 'warning',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'تراجع',
                confirmButtonText: 'تغيير التصنيف'
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: '{{ route('ticket.updateClassification') }}',
                        data: {ticket_id: ticketId, classification: classification},
                        success: function (data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'تم تغيير التصنيف بنجاح',
                                timer: 1500,
                                showConfirmButton: false,
                                confirmButtonText: 'حسنا',

                            })
                        },
                        error: function (data) {
                            console.log('failed');
                            Swal.fire({
                                icon: 'error',
                                title: 'فشل تغيير التصنيف...',
                                text: 'الرجاء التأكد من حالة التذكرة ',
                                footer: ' التذاكر المفتوحة يمكن تغيير تصنيفها فقط',
                                confirmButtonText: 'حسنا'
                            })
                        }
                    });
                }
            });
            console.log(classification);

        }

        function assignTicket() {
            var classification = $("#classifications").val();
            var ticketId = window.id;
            var company = $("#companies").val();
            console.log(classification);
            //
            Swal.fire({
                title: 'هل أنت متأكد?',
                text: "سيتم إسناد التذكرة إلى الشركة المختارة",
                type: 'warning',
                showCancelButton: true,
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'تراجع',
                confirmButtonText: 'إسناد التذكرة'
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: '{{ route('ticket.update') }}',
                        data: {
                            ticket_id: ticketId,
                            classification: classification,
                            company_id: company,
                            status: 'ASSIGNED'
                        },
                        success: function (data) {
                            console.log('okay');
                            Swal.fire({
                                icon: 'success',
                                title: 'تم إسناد التذكرة بنجاح',
                                timer: 1500,
                                showConfirmButton: false,
                                confirmButtonText: 'حسنا',

                            });
                            $('#detailsModal').modal('hide');
                            updateTable();
                        },
                        error: function (data) {
                            console.log('failed');
                            Swal.fire({
                                icon: 'error',
                                title: 'فشل إسناد التذكرة...',
                                text: 'الرجاء التأكد من حالة التذكرة ',
                                footer: ' التذاكر المفتوحة أو المقبولة يمكن إسنادها فقط',
                                confirmButtonText: 'حسنا'
                            })
                        }
                    });
                }
            });
            //

        }


        function closeTicket() {
            var ticketId = window.id;

            //
            Swal.fire({
                title: 'هل أنت متأكد?',
                text: "سيتم إغلاق التذكرة",
                type: 'warning',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'تراجع',
                confirmButtonText: 'إغلاق التذكرة'
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: '{{ route('ticket.update') }}',
                        data: {ticket_id: ticketId, status: 'CLOSED'},
                        success: function (data) {
                            console.log('okay');
                            Swal.fire({
                                icon: 'success',
                                title: 'تم إغلاق التذكرة بنجاح',
                                timer: 1500,
                                showConfirmButton: false,
                                confirmButtonText: 'حسنا',

                            });
                            $('#detailsModal').modal('hide');
                            updateTable();
                        },
                        error: function (data) {
                            console.log('failed');
                            Swal.fire({
                                icon: 'error',
                                title: 'فشل إغلاق التذكرة...',
                                text: 'الرجاء التأكد من حالة التذكرة ',
                                footer: ' التذاكر المقبولة يمكن إغلاقها فقط',
                                confirmButtonText: 'حسنا'
                            })
                        }
                    });
                }
            });
        }

        function excludeTicket() {
            var ticketId = window.id;
            Swal.fire({
                title: 'هل أنت متأكد?',
                text: "سيتم استبعاد التذكرة",
                type: 'warning',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'تراجع',
                confirmButtonText: 'استبعاد التذكرة'
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: '{{ route('ticket.update') }}',
                        data: {ticket_id: ticketId, status: 'EXCLUDED'},
                        success: function (data) {
                            console.log('okay');
                            Swal.fire({
                                icon: 'success',
                                title: 'تم استبعاد التذكرة بنجاح',
                                timer: 1500,
                                showConfirmButton: false,
                                confirmButtonText: 'حسنا',

                            });
                            $('#detailsModal').modal('hide');
                            updateTable();
                        },
                        error: function (data) {
                            console.log('failed');
                            Swal.fire({
                                icon: 'error',
                                title: 'فشل استبعاد التذكرة...',
                                text: 'الرجاء التأكد من حالة التذكرة ',
                                footer: ' التذاكر المفتوحة يمكن استبعادها فقط',
                                confirmButtonText: 'حسنا'
                            })
                        }
                    });

                }
            });
        }

    </script>
@endsection
</html>
