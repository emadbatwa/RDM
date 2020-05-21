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

        <script>
            $(document).ready(function () {
                var tickets = @json($tickets);
                console.log('good', tickets);
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
                <div class="justify-content-center">
                    <div class="">

                        <div class="">


                            <div class="card-body">
                                <table id="example" class="display " style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>رقم التذكرة</th>
                                        <th>الوصف</th>
                                        <th>الحالة</th>
                                        <th>الدرجة</th>
                                        <th>التصنيف</th>
                                        <th>الموظف</th>
                                        <th>تاريخ الإنشاء</th>
                                    </tr>
                                    </thead>
                                    <div id="result"></div>
                                    <tbody id="tableBody">


                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>رقم التذكرة</th>
                                        <th>الوصف</th>
                                        <th>الحالة</th>
                                        <th>الدرجة</th>
                                        <th>التصنيف</th>
                                        <th>الموظف</th>
                                        <th>تاريخ الإنشاء</th>
                                    </tr>
                                    </tfoot>
                                </table>


                                <div id="detailsModal" class="modal fade bd-example-modal-lg" role="dialog"
                                     aria-labelledby="detailsModal"
                                     aria-hidden="true">
                                    <div class="modal-dialog modal-lg" style="width:5000px;">
                                        <div class="modal-content">
                                            <div class="modal-header"  style="text-align:center; display: inline;">
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
                                                <!-- <div class="container">
                                                 <div class="row">
                                                   <div class="col">1</div>
                                                   <div class="col">2</div>
                                                   <div class="w-100"></div>
                                                   <div class="col">3</div>
                                                   <div class="col">4</div>
                                                 </div>
                                                </div> -->
                                            <table class="table">
                                                <tr>


                                                    <th>تاريخ الإنشاء:</th>
                                                    <td id="created_at"></td>
                                                    <th>تاريخ التعديل:</th>
                                                    <td id="updated_at"></td>
                                                </tr>
                                                <tr>

                                                    <th>الوصف</th>
                                                    <td id="description"></td>
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

                                                    <td id="classification_ar">

                                                        <!-- <div class="btn-group">
                                                            <select id="classifications" type="button" class="btn"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false">
                                                            </select>
                                                        </div>
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="updateClassification();">
                                                            تغيير التصنيف
                                                        </button> -->
                                                    </td>
                                                    <th>حجم الضرر:</th>
                                                    <td id="degree_ar"></td>


                                                </tr>
                                                <tr>


                                                    <th>الموظف:</th>

                                                    <td>
                                                        <div class="btn-group">
                                                            <select id="employees" type="button"
                                                                    class="btn  dropdown-toggle"
                                                                    aria-haspopup="true"
                                                                    aria-expanded="false">
                                                                <!-- <option id="assigned_company" selected>1</a> -->
                                                                <!-- @@@@@@@ -->
                                                            </select>
                                                        </div>
                                                        <button type="button" class="btn btn-primary"
                                                                onclick="assignTicketE();">
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

                                            <div class="modal-footer shosho"
                                                 style="text-align: center; margin: 0 auto;  border-top: none;">
                                                <button type="button" class="btn btn-primary" onclick="DoneTicket();">
                                                    رفع حل التذكرة
                                                </button>

                                                <button type="button" class="btn btn-danger " id="closeWindow"
                                                        data-dismiss="modal"
                                                        aria-hidden="true">
                                                    إغلاق النافذة
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
        <script>

            $(document).on('hidden.bs.modal', '#detailsModal', function () {
                clearr();
            });

            function clearr() {
                console.log("dd");
                $('#description').text("");
                $('#assigned_employee').text(""); // @@@@@@@
                $('#classification_ar').text("");
                $('#degree_ar').text("");
                $('#status_ar').text("");
                $('#created_at').text("");
                $('#updated_at').text("");
                $('#id').text("");
                $('#classifications').children().remove();
                $('#employees').children().remove();

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
                        console.log('show ticket', data);

                        // function getPointss() {
                        //    return [ new google.maps.LatLng(data['ticket']['location'].latitude,data['ticket']['location'].longitud)
                        //    new google.maps.LatLng(21.44164476, 39.80269969)
                        //  ];}

                        $('#description').text(data['ticket']['ticket'].description);
                        $('#assigned_employee').text(data['ticket']['assignedEmployee'].name);
                        $('#classification_ar').text(data['ticket']['ticket'].classification_ar);
                        if (data['ticket']['ticket'].degree_ar == null) {
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
                        // var classifications = '';
                        // for (i = 0; i <= data['classifications'].length - 1; i++) {
                        //     if (data['classifications'][i].classification_ar == data['ticket']['ticket'].classification_ar) {
                        //         classifications += '<option selected value="' + data['classifications'][i].id + '">' + data['classifications'][i].classification_ar + '</option>';
                        //     } else {
                        //         classifications += '<option value="' + data['classifications'][i].id + '">' + data['classifications'][i].classification_ar + '</option>';
                        //     }


                        // }
                        var employees = '';
                        console.log(data['ticket']['assignedEmployee'].id);
                        if (data['ticket']['assignedEmployee'].id == undefined) {
                            employees += '<option selected value="">لا يوجد</option>';
                            for (i = 0; i <= data['employees'].length - 1; i++) {
                                employees += '<option value="' + data['employees'][i].id + '">' + data['employees'][i].name + '</option>';
                            }
                        } else {
                            for (i = 0; i <= data['employees'].length - 1; i++) {
                                if (data['employees'][i].id == data['ticket']['assignedEmployee'].id) {
                                    employees += '<option selected value="' + data['employees'][i].id + '">' + data['employees'][i].name + '</option>';
                                } else {
                                    employees += '<option value="' + data['employees'][i].id + '">' + data['employees'][i].name + '</option>';
                                }
                            }
                        }
                        // $('#classifications').append(classifications);
                        $('#employees').append(employees);
                        var photos = data['ticket']['photos'];
                        var fixPhotos = document.getElementById('fixPhotos');
                        var problemPhotos = document.getElementById('problemPhotos');
                        var childrenCounter = 0;
                        for (i = 0; i <= photos.length - 1; i++) {
                            if (photos[i].role_id == 1) {
                                problemPhotos.children[childrenCounter++].src = "http://www.ai-rdm.website/storage/photos/" + photos[i].photo_name;
                            }
                        }
                        childrenCounter = 0;
                        for (i = 0; i <= photos.length - 1; i++) {
                            if (photos[i].role_id == 3) {
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


            function assignTicketE() {
                //var classification = $("#classifications").val();
                var ticketId = window.id;
                var employee = $("#employees").val();
                //console.log(classification);
                //
                Swal.fire({
                    title: 'هل أنت متأكد?',
                    text: "سيتم إسناد التذكرة الموظف ",
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
                                //  classification: classification,
                                employee_id: employee,
                                status: 'IN_PROGRESS'
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
                                    footer: ' فقط التذاكر المسندة ',
                                    confirmButtonText: 'حسنا'
                                })
                            }
                        });
                    }
                });
                //

            }


            function DoneTicket() {
                var ticketId = window.id;

                //
                Swal.fire({
                    title: 'هل أنت متأكد?',
                    text: "سيتم رفع حل التذكرة",
                    type: 'warning',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'تراجع',
                    confirmButtonText: 'رفع حل التذكرة'
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
                            data: {ticket_id: ticketId, status: 'DONE'},
                            success: function (data) {
                                console.log('okay');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'تم رفع حل التذكرة بنجاح',
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
                                    title: 'فشل رفع حل التذكرة...',
                                    text: 'الرجاء التأكد من حالة التذكرة ',
                                    footer: ' التذاكر محلوله يمكن رفع حلها فقط',
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
