<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> @yield('title') </title>
    @yield('links')
</head>
<body>
<!--Start Upper Bar-->
<form action="{{ url('change-lang') }}" method="post">
@csrf
<div class="upper-bar">
    <div class="container">
      <div class="row">
        <div class="info col-sm text-center text-sm-right">
            <img src="{{asset('storage/images/phone-volume.png')}}"><span>{{ \App\Http\Controllers\controller::socialMedia()->info->info_phone }}</span>
            <span class="border"></span>
            <img src="{{asset('storage/images/envelopes.png')}}"><span>{{ \App\Http\Controllers\controller::socialMedia()->info->info_mail }}</span>
        </div>
        <div class="info col-sm text-center text-sm-left">

            <img src="{{asset('storage/images/global.png')}}" alt="global">
              <select name="language" class="btn" data-placeholder="اللغة" data-toggle="dropdown" id="menu1">
                <option value="ar" class="text-dark">اللغة العربية</option>
                <option value="en"  class="text-dark">English</option>
              </select>
              <button type="submit" style="display: none" id='submitLang'>  </button>
          </a>
          <span class="border"></span>
          <img src="{{asset('storage/images/noun_profile_3144506.png')}}" alt="profile">
          {{-- <a href="{{ url('account') }}"> --}}
          @if(Session::has('user'))
          <a href="{{ url('account') }} "style="text-transform: capitalize;color:white">{{Session::get('user')}} </a>
          @else
          <a href="{{ url('account') }}" style="color:white">حسابي</a>
          @endif
          {{-- <a href="">
            <img src="{{asset('storage/images/noun_profile_3144506.png')}}" alt="profile">
            <span>حسابي</span> --}}

        </div>
      </div>
    </div>
</div>
</form>


<!--End Upper Bar-->

<!--Start Nav Bar-->

  <nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="{{url('/')}}">
    <img src="{{asset('storage/images/logo/'.\App\Http\Controllers\controller::socialMedia()->info->logo)}}" alt="" style="width:150px;height:50px">
  </a>
  <div class="collapse navbar-collapse" id="main-nav">
    <ul class="navbar-nav mr-auto">
    <li class="nav-item  {{Request::is('/') ? 'active' : ''}}">
        <a class="nav-link" href="{{url('/')}}"> الرئيسية</a>
      </li>
      <li class="nav-item {{Request::is('about-us') ? 'active' : ''}}">
        <a class="nav-link" href="{{url('about-us')}}">من نحن</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('all-courses')}}">الدورات</a>
      </li>
      <li class="nav-item {{Request::is('all-institutes') ? 'active' : ''}}">
        <a class="nav-link" href="{{url('all-institutes')}}">المعاهد</a>
      </li>
      <li class="nav-item dropdown {{Request::is('photoGallery') || Request::is('vedioGallery')? 'active' : ''}}">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          المعرض
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{url('photoGallery')}}">معرض الصور</a>
          <a class="dropdown-item" href="{{url('vedioGallery')}}">معرض الفيديو</a>

        </div>
      </li>

      <li class="nav-item {{Request::is('my-reservations') ? 'active' : ''}}">
        <a class="nav-link" href="{{url('my-reservations')}}">حجوزاتي</a>
      </li>
      @if(Session::has('user_id'))
      <li class="nav-item ">
        <a class="nav-link" id="{{Request::is('all-notes') ? 'active-notes' : ''}}" href="{{url('all-notes')}}">ملاحظاتي</a>
      </li>
      @endif
      <li class="nav-item {{Request::is('wishlist') ? 'active' : ''}}">
        <a class="nav-link" href="{{url('wishlist')}}">المفضلة</a>
      </li>
      <li class="nav-item {{Request::is('conact_us') ? 'active' : ''}}">
        <a class="nav-link" href="{{url('conact_us')}}">اتصل بنا</a>
      </li>
      <li>
        {{-- <img src="{{asset('storage/images/search.png')}}"> --}}
      </li>
    </ul>
  </div>

</div>
</nav>



@yield('content')




<!--End Nav Bar-->

<section class="partner">
    <div class="container">
    <h1>شركاء النجاح  </h1>
            {{-- <p class="small-text">هذا النص هو مثال لنص يمكن أن يستبدل بنص أخر في نفس المساحة</p> --}}
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <!--slider 1-->
         @for ($i=0; $i<\App\Http\Controllers\controller::getPartnerCount()->iterationsOfParent;$i++)
          <div class="carousel-item {{$i == 0 ? 'active': ''}}">
              <div class="row">
                  @foreach (\App\Http\Controllers\controller::partners($i)->partner as $key => $part)
                    <div class="col-3">
                      <img src="{{asset('storage/images/partners/'.$part->partner_photo)}}" class="d-block w-100" alt="...">
                    </div>
                   
                  @endforeach
              </div>
            </div>
         @endfor

       
          <!-- / end of slider-->

        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
      </div>
    </section>

  <!--END Partner Section-->

  <!--Start NEWS Section-->

  <section class="overlay-bottom">

    <div class="container">
      <div class="news">
      <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-6">
          <h1>اشترك في نشرة الأخبارية الجديدة</h1>
        </div>
        <div class="col-sm-12 col-md-8 col-lg-6">
         <div class="input-group ">
          <input type="text" class="form-control" placeholder="برجاء ادخال البريد الألكتروني" aria-label="Example text with button addon" aria-describedby="button-addon1">
        <div class="input-group-prepend">
          <a href="#">تأكيد</a>
        </div>

       </div>
        </div>
      </div>
    </div>
  </div>
  </section>

  <!--END NEWS Section-->

  <!--Start Footer Section-->

  <footer>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-3">
          <h3>{{ \App\Http\Controllers\controller::socialMedia()->about->title }}</h3>
          <hr class="hr-md">
          <p style="overflow: hidden;display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;">
            {{ \App\Http\Controllers\controller::socialMedia()->about->details }}
          </p>
          <ul class="list-inline">
            @foreach (\App\Http\Controllers\controller::socialMedia()->social as $s)
            <li class="list-icon"><a href="{{ $s->social_link }}" target="blank"><img src="{{asset('storage/images/'.$s->social_photo)}}"></a></li>
            @endforeach
          </ul>
        </div>
      <div class="col-sm-4 col-md-6 col-lg-3">
        <h3>روابط سريعة</h3>
        <hr class="hr-md">
        <ul>
          <li class="list-item">
            <i class="fas fa-angle-double-left"></i>
            <a href="{{url('banksAcc')}}">الحسابات البنكية</a>
          </li>
          <li class="list-item">
            <i class="fas fa-angle-double-left"></i>
          <a href="{{url('wishlist')}}">المفضلة</a>
          </li>
          <li class="list-item">
            <i class="fas fa-angle-double-left"></i>
            <a href="{{url('my-reservations')}}">حجوزاتي</a>
          </li>
          <li class="list-item">
            <i class="fas fa-angle-double-left"></i>
            <a href="{{url('conact_us')}}">تواصل معنا</a>
          </li>
        </ul>
      </div>
      <div class="col-sm-4 col-md-6 col-lg-3">
         <h3>روابط سريعة</h3>
        <hr class="hr-md">
        <ul>
          <li class="list-item">
            <i class="fas fa-angle-double-left"></i>
            <a href="{{ url('account') }}">حسابي</a>
          </li>
          <li class="list-item">
            <i class="fas fa-angle-double-left"></i>
            <a href="{{url('about-us')}}">من نحن</a>
          </li>
          <li class="list-item">
            <i class="fas fa-angle-double-left"></i>
            <a href="{{url('terms_and_condition')}}">الشروط والأحكام</a>
          </li>
          {{-- <li class="list-item">
            <i class="fas fa-angle-double-left"></i>
            <a href="الأسئلة الشائعة.html">الأسئلة الشائعة</a>
          </li> --}}
        </ul>
      </div>
      <div class="col-sm-4 col-md-6 col-lg-3">
        <h3>تواصل معنا</h3>
        <hr class="hr-md">
        <ul>
          <li class="list-item">
            <img src="{{asset('storage/images/pin (1).png')}}">
            <span>
            {{ \App\Http\Controllers\controller::socialMedia()->info->info_city }},
            {{ \App\Http\Controllers\controller::socialMedia()->info->info_country }}
            </span>
          </li>
          <li class="list-item">
            <img src="{{asset('storage/images/phone (2).png')}}">
            <span>{{ \App\Http\Controllers\controller::socialMedia()->info->info_phone }}</span>
          </li>
          <li class="list-item">
            <img src="{{asset('storage/images/mail (1).png')}}">
            <span>{{ \App\Http\Controllers\controller::socialMedia()->info->info_mail }}</span>
          </li>
        </ul>
      </div>
      <hr class="hr-footer">
    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
      <h5 style="color: #fff;">جميع الحقوق محفوظة لموقع <span style="color: #ffae00;"> URIALLAB </span></h5>
    </div>
    </div>
    </div>
  </footer>
  <!--END Footer Section-->

  <!--SCRIPTS-->

 @yield('scripts')
  <script>
    $('#menu1').change(function(){
      $('#submitLang').click();
    })

  </script>
  </body>
  </html>
