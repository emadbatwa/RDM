<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>سالك | الرئيسية</title>
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
              <li class="nav-item"><a class="nav-link" href="{{route('contact')}}">تواصل معنا</a></li>
              <li class="nav-item"><a class="nav-link" href="#team">فريق العمل</a>
              <li class="nav-item"><a class="nav-link" href="#about">عن سالك</a></li>
              <li class="nav-item"><a class="nav-link" href="#map">الخريطة العامة</a></li>
              <li class="nav-item active"><a class="nav-link" href="{{route('index')}}">الرئيسية</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <!--================Header Menu Area =================-->

  <main class="side-main">
    <!--================ Hero sm Banner start =================-->
    <section class="hero-banner mb-30px">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <div class="hero-banner__img">
              <img class="img-fluid" src="AboutProjectFiles/img/screens1.png" alt="">
            </div>
          </div>
          <div class="col-lg-7 pt-5">
            <div class="hero-banner__content">
              <h1>نظام سالك</h1>
              <p>نظام للكشف عن أضرار الطرق يربط  بين المستخدمين والبلديات لإدارة مشاكل الطرق</p>
              <a class="button bg" href="#about">المزيد عن سالك</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero sm Banner end =================-->

    <!--================ About section start =================-->

    <section id="about" class="section-padding--small">
      <div class="container">
        <!-- <div class="section-intro pb-85px text-center">
          <h2 class="section-intro__title">نظام سالك</h2>
        </div> -->
        <div class="row no-gutters align-items-center">
          <div class="col-lg-6 center">
              <iframe class="video-frame"
                src="https://www.youtube.com/embed/NWAOImQGswc?modestbranding=1&autohide=1&showinfo=0&controls=0&autoplay=1&playlist=NWAOImQGswc&loop=1">
              </iframe>
          </div>
          <div class="col-lg-6">
            <div class="about__content">
              <p>أنشئ نظام سالك تحت مظلة جامعة أم القرى وكلية الحاسب الآلي ونظم المعلومات بالتعاون مع كلية الهندسة والعمارة الإسلامية بهدف تحسين طرق العاصمة المقدسة والمساهمة في تحقيق رؤية 2030</p>
              <div class="row center">
                <div class="col-sm-6">
                    <img width="100" src="AboutProjectFiles/img/home/eng_logo.jpg" alt="">
                </div>
                <div class="col-sm-6">
                    <img style="margin-top: 20px;" width="200" src="AboutProjectFiles/img/home/cis_logo.jpg" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--================ About section end =================-->

    <!--================ Objectives section start =================-->
    <section class="section-padding--small bg-magnolia">
      <div class="container">
        <div class="section-intro pb-85px text-center">
          <h2 class="section-intro__title">أهداف سالك</h2>
          <p class="section-intro__subtitle">يهدف سالك من خلال التعاون مع أمانة العاصمة المقدسة لعدة أهداف  منها</p>
        </div>
        <div class="row">
          <div class="col-lg-3">
            <div class="card offer-single__content text-center">
              <span class="offer-single__icon">
                <i class="ti-link"></i>
              </span>
              <h5>تضمين المستخدمين في تحسين طرق مكة المكرمة</h5>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card offer-single__content text-center">
              <span class="offer-single__icon">
                <i class="ti-comments-smiley"></i>
              </span>
              <h5>تسهيل التواصل بين المستخدمين والبلديات</h5>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card offer-single__content text-center">
              <span class="offer-single__icon">
                <i class="ti-settings"></i>
              </span>
              <h5>تطوير إدارة أضرار طرق مكة المكرمة</h5>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card offer-single__content text-center">
              <span class="offer-single__icon">
                <i class="ti-check-box"></i>
              </span>
              <h5>تحقيق أهداف رؤية 2030 في تطوير وتحسين المدن</h5>
            </div>
          </div>
        </div>
    </section>
    <!--================ Objectives section end =================-->

    <!--================ Features section start =================-->
    <section class="section-margin">
      <div class="container">
        <div class="section-intro pb-85px text-center">
          <h2 class="section-intro__title">لماذا سالك؟</h2>
          <!-- <p class="section-intro__subtitle">Vel aliquam quis, nulla pede mi commodo tristique nam hac. Luctus torquent velit felis commodo pellentesque nulla cras. Tincidunt hacvel alivquam quis nulla pede mi commodo tristique nam hac  luctus torquent</p> -->
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div class="row offer-single-wrapper">
              <div class="col-lg-6 offer-single">
                <div class="card offer-single__content text-center">
                  <span class="offer-single__icon">
                    <i class="ti-pencil-alt"></i>
                  </span>
                  <h4>سهل الإدارة</h4>
                  <p>يوفر سالك منصة للموظفين والشركات لإدارة البلاغات بيسر وسهولة/p>
                </div>
              </div>

              <div class="col-lg-6 offer-single">
                <div class="card offer-single__content text-center">
                  <span class="offer-single__icon">
                    <i class="ti-target"></i>
                  </span>
                  <h4>يعمل  بواسطة الذكاء الاصطناعي</h4>
                  <p>يسهل نموذج الذكاء الاصطناعي مهمة تصنيف التذاكر حسب نوع الضرر</p>
                </div>
              </div>
            </div>

            <div class="row offer-single-wrapper">
              <div class="col-lg-6 offer-single">
                <div class="card offer-single__content text-center">
                  <span class="offer-single__icon">
                    <i class="ti-ruler-pencil"></i>
                  </span>
                  <h4>إحصائيات البلاغات</h4>
                  <p>باستطاعة المسؤول الاطلاع على إحصائيات التذاكر في النظام</p>
                </div>
              </div>

              <div class="col-lg-6 offer-single">
                <div class="card offer-single__content text-center">
                  <span class="offer-single__icon">
                    <i class="ti-map-alt"></i>
                  </span>
                  <h4>بيانات عامة</h4>
                  <p>يوفر سالك منصة للاطلاع على التذاكر المغلقة والمفتوحة وتفاصيل كل تذكرة</p>
                </div>
              </div>
            </div>

          </div>
          <div class="col-lg-6">
            <div class="offer-single__img">
              <img class="img-fluid" src="AboutProjectFiles/img/home/features.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ Features section end =================-->

    <!--================ Parts section start =================-->
    <section class="section-padding--small bg-magnolia">
      <div class="container">
        <div class="section-intro pb-85px text-center">
          <h2 class="section-intro__title">نظام متكامل</h2>
          <p class="section-intro__subtitle">سالك هو نظام متكامل يعمل بعدة أجزاء مترابطة</p>
        </div>
        <div class="row align-items-center pt-xl-3 pb-xl-5">
          <div class="col-lg-4">
            <div class="solution__img mb-4 mb-lg-0">
              <img class="img-fluid center-img" style="margin-bottom: 30px; margin-top: 30px;" src="AboutProjectFiles/img/home/web.png" alt="">
              <p class="center">لوحة تحكم للإدارة لمتابعة تذاكر المستخدمين والتحكم بها</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="solution__img mb-4 mb-lg-0">
              <img class="img-fluid center-img1" style="margin-bottom: 20px; margin-top: 20px;" height="200" width="200" src="AboutProjectFiles/img/home/ml.png" alt="">
              <p class="center">نموذج للكشف عن أضرار الطرق باستخدام تقنيات الذكاء الاصطناعي وتعلم الآلة</p>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="solution__img mb-4 mb-lg-0">
              <img class="img-fluid center-img1" height="200" width="200" src="AboutProjectFiles/img/home/mobiles_no_bg.png" alt="">
              <p class="center">تطبيق للمستخدم للتبليغ عن أضرار الطرق ومتابعة تذاكره الخاصة </p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ Parts section end =================-->

    <!--================ Mobile section start =================-->
    <section class="section-margin">
      <div class="container">
        <div class="row align-items-center pt-xl-3 pb-xl-5">
          <div class="col-lg-6">
            <div class="solution__img text-center text-lg-left mb-4 mb-lg-0">
              <img class="img-fluid" src="AboutProjectFiles/img/home/mobiles.png" alt="">
            </div>
          </div>
          <div class="col-lg-6">
            <div class="solution__content">
              <h2>جدنا على المتاجر</h2>
              <p>يتوفر تطبيق سالك على أجهزة الجوال المحمولة ويمكنكم تنزيله من خلال الروابط التالية</p>
              <div class="right">
                <a href="#"><img width="120" height="40" src="AboutProjectFiles/img/home/android_ar.png"></a>
                <a href="#"><img class="" src="AboutProjectFiles/img/home/ios_ar.png"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ Mobile section end =================-->

    <!--================ Map section start =================-->
    <section id="map" class="section-padding--small bg-magnolia">
      <div class="container">
        <div class="row align-items-center pt-xl-3 pb-xl-5">
          <div class="col-lg-6">
            <div class="about__content">
              <h2>الخريطة العامة</h2>
              <p>يوفر سالك منصة عامة للمستخدمين تعرض فيها التذاكر المفتوحة والمغلقة وتفاصيل كل تذكرة كبيانات مفتوحة وذلك لأغراض مشاركتها مع الباحثين وريادي المشاريع والمهتمين في المجال</p>
              <a class="button button-light" href="#">اذهب إلى الخريطة العامة</a>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="about__img">
              <img class="img-fluid" style="margin-top: 30px;" src="AboutProjectFiles/img/home/map.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ Map section end =================-->


    <!--================ Team Logo Area =================-->
    <section id="team" class="clients_logo_area section-padding">
      <div class="container">
        <div class="section-intro pb-5 text-center">
            <h2 class="section-intro__title">فريق العمل</h2>
       </div>
        <div class="clients_slider owl-carousel">
          <div class="item">
            <img width="200" height="200" src="AboutProjectFiles/img/home/avatar.png" alt="">
            <p>د. أحمد الهندي</p>
          </div>
          <div class="item">
            <img width="200" height="200" src="AboutProjectFiles/img/home/avatar.png" alt="">
            <p>م. طارق الجابري</p>
          </div>
          <div class="item">
            <img width="200" height="200" src="AboutProjectFiles/img/home/avatar.png" alt="">
            <p>حنان الحربي</p>
          </div>
          <div class="item">
            <img width="200" height="200" src="AboutProjectFiles/img/home/avatar.png" alt="">
            <p>أروى محمد</p>
          </div>
          <div class="item">
            <img width="200" height="200" src="AboutProjectFiles/img/home/avatar.png" alt="">
            <p>عماد بتوا</p>
          </div>
          <div class="item">
            <img width="200" height="200" src="AboutProjectFiles/img/home/avatar.png" alt="">
            <p>دينا بالقاسم</p>
          </div>
          <div class="item">
            <img width="200" height="200" src="AboutProjectFiles/img/home/avatar.png" alt="">
            <p>سلمى مرسل</p>
          </div>
          <div class="item">
            <img width="200" height="200" src="AboutProjectFiles/img/home/avatar.png" alt="">
            <p>محمد الغامدي</p>
          </div>
          <div class="item">
            <img width="200" height="200" src="AboutProjectFiles/img/home/avatar.png" alt="">
            <p>ذكرى أبوحيمد</p>
          </div>
          <div class="item">
            <img width="200" height="200" src="AboutProjectFiles/img/home/avatar.png" alt="">
            <p>محمد الزهراني</p>
          </div>
        </div>
      </div>
    </section>
    <!--================ End team Area =================-->
  </main>


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
