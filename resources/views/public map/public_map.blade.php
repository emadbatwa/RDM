
        <!DOCTYPE html>
        <html lang="fa" dir="rtl">
        <!--الخريطة العامة-->
        <head>
          <title>
              {{ __('سالك') }}
          </title>
          <!-- Markazi Text font include just for persian demo purpose, don't include it in your project -->
          <link href="https://fonts.googleapis.com/css?family=Cairo&amp;subset=arabic" rel="stylesheet">
          <!-- CSS Files -->
          <link href="{{ asset('material') }}/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
          <link href="{{ asset('material') }}/css/material-dashboard-rtl.css?v=1.1" rel="stylesheet" />
          <!-- CSS Just for demo purpose, don't include it in your project -->
          <link href="{{ asset('material') }}/demo/demo.css" rel="stylesheet" />
        </head>
        <body class="container-fluid">
<div class="wrapper ">
    <div class="sidebar">
              <div class="logo">
                <a href="{{ route('table') }}" class="simple-text logo-normal">
                  <img src="{{ asset('material') }}/img/logo.png" alt="Smiley" height="45" width="45" >
                </a>
              </div>
              
              <div class="sidebar-wrapper">
        <div class="container">
              <ul class="nav">
                       <label for="statuses">حالة البلاغ</label> </p>
                      <select class="container-fluid" name="status" id="statuses">
                <option value="all" selected >الكل</option>
                <option value="open"  >مفتوحة</option>
                <option value="closed">مغلقة</option>
                      </select>        
        </ul>
        </div>
        <div class="container-fluid">  </p> 
           <!-- من هنا تتمرر للداتابيس-->
          <button class="button" name="filter_update"> ابحث </button>  
          </div>
         </div>  
        </div>
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top">
                <div class="container-fluid">
                  <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                  </button>
                  <div class="collapse navbar-collapse justify-content-end">
                  <i class="container-fluid-right">قاعدة بيانات تذاكر منصة سالك</i>
              </nav>
             
            <div class="main-panel">
            <div id="map" >

 <script type="text/javascript"
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBejOPM4uDw_MrHg4SpDUM6XwFb8Pw8lrg&callback=initMap">
</script>
<script type="text/javascript">
// سحب بيانات من الداتابيس بالاضافة للصور
var markers = [
    {
        "title": 'Aksa Beach',
        "lat": '21.44271329',
        "lng": '39.80599992',
        "description": 'Aksa Beach is a popular beach and a vacation spot in Aksa village at Malad, Mumbai.'
    },
    {
        "title": 'Juhu Beach',
        "lat": '21.44196432',
        "lng": '39.80260913',
        "description": 'Juhu Beach is one of favourite tourist attractions situated in Mumbai.'
    },
    {
        "title": 'Girgaum Beach',
        "lat": '21.44000582',
        "lng": '39.80995414',
        "description": 'Girgaum Beach commonly known as just Chaupati is one of the most famous public beaches in Mumbai.'
    },
    {
        "title": 'Jijamata Udyan',
        "lat": '21.44271329',
        "lng": '39.90599992',
        "description": 'Jijamata Udyan is situated near Byculla station is famous as Mumbai (Bombay) Zoo.'
    },
    {
        "title": 'Sanjay Gandhi National Park',
        "lat": '21.44082588',
        "lng": '39.80279624',
        "description": 'Sanjay Gandhi National Park is a large protected area in the northern part of Mumbai city.'
    }
    ];
    window.onload = function () {
        LoadMap();
    }
    function LoadMap() {
        var mapOptions = {
            center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
            zoom: 13,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
        var infoWindow = new google.maps.InfoWindow();
        for (var i = 0; i < markers.length; i++) {
            var data = markers[i];
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.title
            });
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    //تعديل حجم البوب اب مع المعلومات 
                    infoWindow.setContent("<div style = 'width:12%;min-height:20%'>" + data.description + "</div>");
                    infoWindow.open(map, marker);
                });
            })(marker, data);
        }
    }
</script>
<div id="dvMap" style="width:100%; height:100%">
</div>
  </div></div>
            <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBejOPM4uDw_MrHg4SpDUM6XwFb8Pw8lrg&callback=initMap">
            </script>
            <!--   Core JS Files   -->
            <script src="{{ asset('material') }}/js/core/jquery.min.js"></script>
            <script src="{{ asset('material') }}/js/core/popper.min.js"></script>
            <script src="{{ asset('material') }}/js/core/bootstrap-material-design.min.js"></script>
            <script src="{{ asset('material') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
            
            <!-- Google Maps Plugin   
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBejOPM4uDw_MrHg4SpDUM6XwFb8Pw8lrg'"></script> -->
            <!-- Chartist JS -->
            <script src="{{ asset('material') }}/js/plugins/chartist.min.js"></script>
            <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
            <script src="{{ asset('material') }}/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
        </body>
        </html>
