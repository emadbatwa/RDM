
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
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
  var markers = @json($tickets);
  console.log(markers);
      window.onload = function () {
          LoadMap();
      }
      function LoadMap() {
          var mapOptions = {
              center: new google.maps.LatLng(21.44271329, 39.80599992),
              zoom: 13,
              mapTypeId: google.maps.MapTypeId.ROADMAP
          };
          var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
          var infoWindow = new google.maps.InfoWindow();
          for (var i = 0; i < markers.length; i++) {
              var data = markers[i];
              var myLatlng = new google.maps.LatLng(data['location'].latitude , data['location'].longitude);

              if(data['ticket'].status == 'OPEN'){
                var marker = new google.maps.Marker({
                  position: myLatlng,
                  icon: {
        url: "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
        //url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
      },
                  map: map,
              //    title: data.title
              });
              }else{
                var marker = new google.maps.Marker({
                  position: myLatlng,
                  icon: {
        //url: "http://maps.google.com/mapfiles/ms/icons/green-dot.png"
        url: "http://maps.google.com/mapfiles/ms/icons/red-dot.png"
      },
                  map: map,
                // title: data.title
              });
              }
              (function (marker, data) {
                  google.maps.event.addListener(marker, "click", function (e) {
                      //تعديل حجم البوب اب مع المعلومات 
                      "<div style = 'width:12%;min-height:20%'>" + data.description + "</div>"
                      infoWindow.setContent(Swal.fire({
                        position: 'center',
    title: data.title ,
    text: data.description + data.description ,
    imageUrl: 'https://unsplash.it/400/200',
    imageWidth: 400,
    imageHeight: 200,
    imageAlt: 'Custom image',
  }));
                    //  infoWindow.open(map, marker);
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
