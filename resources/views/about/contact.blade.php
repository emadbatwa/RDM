<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>سالك | تواصل معنا</title>
	<link rel="icon" href="AboutProjectFiles/img/salik_logo.png" type="image/png">

  <link rel="stylesheet" href="AboutProjectFiles/vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="AboutProjectFiles/vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="AboutProjectFiles/vendors/themify-icons/themify-icons.css">
  <link rel="stylesheet" href="AboutProjectFiles/vendors/linericon/style.css">
  <link rel="stylesheet" href="AboutProjectFiles/vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="AboutProjectFiles/vendors/owl-carousel/owl.carousel.min.css">

  <link rel="stylesheet" href="AboutProjectFiles/css/style.css">
</head>
<body>
  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="{{route('index')}}"><img src="AboutProjectFiles/img/logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav justify-content-end">
              <li class="nav-item active"><a class="nav-link" href="{{route('contact')}}">تواصل معنا</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('index')}}#team">فريق العمل</a>
              <li class="nav-item"><a class="nav-link" href="{{route('index')}}#about">عن سالك</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('index')}}#map">الخريطة العامة</a></li>
              <li class="nav-item"><a class="nav-link" href="{{route('index')}}">الرئيسية</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <!--================Header Menu Area =================-->

  <!--================ Hero sm Banner start =================-->
  <section class="hero-banner hero-banner--sm mb-30px">
    <div class="container">
      <div class="hero-banner--sm__content">
        <h1>تواصل معنا</h1>
      </div>
    </div>
  </section>
  <!--================ Hero sm Banner end =================-->

  <!-- ================ contact section start ================= -->
  <section class="section-margin">
    <div class="container">
      <!-- <div class="d-none d-sm-block mb-5 pb-4">
        <div id="map" style="height: 420px;"></div>
        <script>
          function initMap() {
            var uluru = {lat: -25.363, lng: 131.044};
            var grayStyles = [
              {
                featureType: "all",
                stylers: [
                  { saturation: -90 },
                  { lightness: 50 }
                ]
              },
              {elementType: 'labels.text.fill', stylers: [{color: '#A3A3A3'}]}
            ];
            var map = new google.maps.Map(document.getElementById('map'), {
              center: {lat: -31.197, lng: 150.744},
              zoom: 9,
              styles: grayStyles,
              scrollwheel:  false
            });
          }

        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&callback=initMap"></script>

      </div> -->

      <div class="row">
        <div class="col-md-8 col-lg-8">
          <!-- <form action="#/" class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
            <div class="row">
              <div class="col-lg-5">
                <div class="form-group">
                  <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name">
                </div>
                <div class="form-group">
                  <input class="form-control" name="email" id="email" type="email" placeholder="Enter email address">
                </div>
                <div class="form-group">
                  <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter Subject">
                </div>
              </div>
              <div class="col-lg-7">
                <div class="form-group">
                    <textarea class="form-control different-control w-100" name="message" id="message" cols="30" rows="5" placeholder="Enter Message"></textarea>
                </div>
              </div>
            </div>
            <div class="form-group text-center text-md-right mt-3">
              <button type="submit" class="button button-contactForm">Send Message</button>
            </div>
          </form> -->
        </div>

        <div class="col-md-4 col-lg-4 mb-4 mb-md-0">
          <div class="media contact-info">
            <div class="media-body right" style="margin-right: 20px;">
              <h3>كلية الحاسب الآلي ونظم المعلومات | جامعة أم القرى</h3>
              <p>مكة المكرمة، المملكة العربية السعودية</p>
            </div>
            <span class="contact-info__icon"><i class="ti-home"></i></span>
          </div>
          <!-- <div class="media contact-info">
            <div class="media-body right" style="margin-right: 20px;">
              <h3><a href="tel:454545654">00 (440) 9865 562</a></h3>
              <p>Mon to Fri 9am to 6pm</p>
            </div>
            <span class="contact-info__icon"><i class="ti-headphone"></i></span>
          </div> -->
          <div class="media contact-info">
            <div class="media-body right" style="margin-right: 20px;">
              <h3><a href="mailto:support@colorlib.com">ai.rdm2020@gmail.com</a></h3>
              <p>فريق سالك </p>
            </div>
            <span class="contact-info__icon"><i class="ti-email"></i></span>
          </div>
        </div>
      </div>
    </div>
  </section>
	<!-- ================ contact section end ================= -->






  <!-- ================ start footer Area ================= -->
  <footer class="footer-area section-gap">
    <div class="container">
      <div class="footer-bottom row align-items-center text-center text-lg-left">
        <p class="footer-text m-0 col-lg-12 col-md-12 center">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | SALIK - سالك</p>
      </div>
    </div>
  </footer>
  <!-- ================ End footer Area ================= -->

  <script src="AboutProjectFiles/vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="AboutProjectFiles/vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="AboutProjectFiles/vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="AboutProjectFiles/js/jquery.ajaxchimp.min.js"></script>
  <script src="AboutProjectFiles/js/mail-script.js"></script>
  <script src="AboutProjectFiles/js/main.js"></script>
</body>
</html>
