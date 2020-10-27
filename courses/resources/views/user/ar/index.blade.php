@extends('user.ar.layouts.lay') @section('title','الرئيسيه')
@section('links')
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/Base.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/premium.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/home.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/courses.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/academy.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
@endsection
@section('home','active')
@section('content')
<!--Start carousel-->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        @foreach ($slider as $key => $slide)
      <div class="carousel-item {{ $loop->first ? 'active' : '' }} ">


          <div class="image-banner" style="background-image: url({{ url('storage/images/sliders/'. $slide['slider_photo'] )}});"></div>
          <div class="carousel-caption">
            <h2>{{ $slide['slider_title'] }}</h2>
            <p >{{$slide['slider_details']}}
              </p>
            <a href="{{ $slide['slider_link'] }}">إظهار المزيد</a>
          </div>

      </div>
      @endforeach

    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

  <!--End carousel-->

  <!--Search Section-->

  <section class="overlay-top">
    {{--  --}}
    <form action="{{url('courses-search')}}" method="get">
      <div class="container">
        <div class="light">
        <div class="row">
          <div class="col-sm-12 col-lg-3">
            <div class="form-group">
                <h4>ابحث</h4>
                <input type="text" name="keyword" class="form-control b-r" placeholder="أكتب كلمة بحثك">
            </div>
          </div>
          <div class="col-sm-12 col-lg-2">
           
              
              <div class="form-group">
                <h4>تحديد الدورات</h4>
                <select name="local_or_global" id="category" class="form-control">
                  <option value="" class="selectBox">برجاء تحديد الدورة</option>
                  <option value="2">دورات محلية</option>
                  <option value="1">دورات عالمية </option>

                </select>
              </div>
          </div>
          <div class="col-sm-12  col-lg-3">
            <div class="form-group">
              <h4>نوع الدورة</h4>
              <select name="course_type" id="category" class="js-states form-control">
                <option value="">برجاء أختيار نوع الدورة</option>
                @foreach ($totalCourseTypes as $course)
                  <option value="{{$course['course_type_id']}}">{{$course['course_type_name']}}</option>
                @endforeach

              </select>
            </div>
          </div>
          <div class="col-sm-12 col-lg-2">
            <div class="form-group">
              <h4>السعر</h4>
              <select name="price" id="category" class="form-control">
                <option value="">برجاء أختيار السعر</option>
                <option value="1">الأقل سعرا</option>
                <option value="2">الأعلى سعرا</option>
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-lg-2">
          <button type="submit" style="background-color: #ffae00;padding: 10px 40px;display: inline-block;margin-top: 22px;color: #fff;text-transform: uppercase;border-radius: 25px;border:0"> ابحث الان </button>
          </div>
          </div>
        </div>
      </div>
    </form>
  </section>

  <!--END Search Section -->

  <!--Start about Section-->

  <section class="about">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <h1 class="head-1"> من نحن</h1>
                <h2 class="head-2">{{$about->title}}</h2>
                <p class="large-text">
                      @php
                  echo(substr($about->details,0,1300));
                  @endphp
                </p>

            </div>
            <div class="col-sm-12  col-lg-6">
                <img src="{{asset('storage/images/'.$about->page_photo	)}}" alt="about" width="100%">
            </div>
        </div>
    </div>
</section>

  <!--END about Section-->

  <!--Start Courses Section-->

  <section class="new-courses">
  <div class="container">
  <div class="row">

    <div class="col-sm-12 col-md-12 col-lg-12">
        <h1>احدث الدورات المضافة</h1>
        <p class="small-text">
          هذا النص هو مثال لنص يمكن أن يستبدل بنص اخر في نفس المساحة
        </p>
    </div>

    @foreach ($recentCourses as $course)
    <div class="col-sm-12 col-md-6 col-lg-4">
      <div class="card">
          <img src="{{asset('storage/images/courses/'.$course['course_photo'])}}" class="card-img-top" alt="loe">
          <a href="{{url('addWishList/'.$course['course_id'])}}" class="add" style="{{$course['liked']== true ? 'background:#ffae00;opacity:1' : ''}}">
              <i class="fas fa-heart"></i>
          </a>
          <div class="card-body">
              <div class="row">
                  <div class="col-md-6">
                      <h6 class="card-subtitle mb-2 text-muted"> <img src="{{asset('storage/images/company.png')}}"> {{$course['institute_name']}} </h6>
                  </div>
                  <div class="col-md-6">
                      <div class="rate">
                          <ul class="list-inline">

                              @for ($i = 0; $i < $course['avg_rate_c']; $i++)
                              <li class="list-inline-item active" style="color:#ffae00"><i class="fas fa-star"></i></li>
                              @endfor
                              @for ($i = 0; $i < 5-$course['avg_rate_c'] ; $i++)
                              <li class="list-inline-item"><i class="fas fa-star"></i></li>
                              @endfor

                          </ul>
                      </div>
                  </div>
              </div>
              <h5 class="card-title"> {{$course['course_name']}}  </h5>
            <p class="card-text"> @php
              echo(substr($course['course_details'],0,150));
              @endphp
            </p>
          </div>
          <div class="card-footer">
              <div class="row">
                  <div class="col-6 text-right">
                      <button type="button" class="btn ">
                          <a href="#" class="price">{{$course['course_price']}} رس </a>
                      </button>
                  </div>
                  <div class="col-6 text-left">
                      <button type="button" class="btn">
                          <a href="{{url('courses-details/'.$course['course_id'])}}" class="link">إظهار المزيد<i class="fas fa-arrow-left"></i></a>
                      </button>
                  </div>
              </div>
          </div>
      </div>
    </div>
    @endforeach

    <div class="col-sm-12 col-md-12 col-lg-12 text-center">
    <a href="{{url('all-courses')}}"  class="btn btn-warning">إظهار المزيد<i class="fas fa-angle-double-left"></i></a>
    </div>

  </div>
  </div>
  </section>

  <!--END Courses Section-->

  <!--Start Academy Section-->

  <section class="new-academy">
   <div class="container">
    <div class="row">
     <div class="col-sm-12 col-md-12 col-lg-12">
          <h1>احدث المعاهد المضافة </h1>
          <p class="small-text">
            هذا النص هو مثال لنص يمكن أن يستبدل بنص اخر في نفس المساحة</p>
      </div>

      @foreach ($recentInsts as $inst)
      <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="card">
            <img src="{{asset('storage/images/institutes/'.$inst['institutes_photo'])}}" class="card-img-top" alt="loe">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                    <h6 class="card-subtitle mb-2 text-muted"> <img src="{{asset('storage/images/pin (1).png')}}"> {{$inst['country'].','.$inst['city_name']}} </h6>
                    </div>
                    <div class="col-md-6">
                        <div class="rate">
                            <ul class="list-inline">

                                @for ($i = 0; $i < $inst['avg_rate_i']; $i++)
                                <li class="list-inline-item active" style="color:#ffae00"><i class="fas fa-star"></i></li>
                                @endfor
                                @for ($i = 0; $i < 5-$inst['avg_rate_i'] ; $i++)
                                <li class="list-inline-item"><i class="fas fa-star"></i></li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
                <h5 class="card-title"> {{$inst['institute_name']}} </h5>
                <p class="card-text">
                  @php
                  echo(substr($inst['institute_details'],0,150));
                  @endphp
                </p>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-6 text-right">
                        <button type="button" class="btn ">
                            <a href="#" class="price">{{ $inst['courses_count'] }} دورات </a>
                        </button>
                    </div>
                    <div class="col-6 text-left">
                        <button type="button" class="btn">
                            <a href="{{url('institute-details/'.$inst['institute_id'])}}" class="link">إظهار المزيد<i class="fas fa-arrow-left"></i></a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
      </div>
      @endforeach

      <div class="col-sm-12 col-md-12 col-lg-12 text-center">
        <a href="{{url('all-institutes')}}" class="btn btn-warning">إظهار المزيد<i class="fas fa-angle-double-left"></i></a>
      </div>
    </div>
  </div>
  </section>

  <!--End Academy Section-->

  <!--Start App Section-->

  <section class="app" style="background-image: url({{ url('storage/images/'. $ads->ads_cover_photo )}});">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="app-store">
          <div class="row">
            <div class="col-sm-12 col-lg-12">
             <h3>{{ $ads->ads_title }}</h3>
             <p>{{ $ads->ads_details }}</p>
            </div>
            <div class=" col-sm-12 col-md-3 col-lg-6">
                <a href="{{ $ads->ads_ios_link }}" target="blank"><img src="{{asset('storage/images/appstore.png')}}"></a>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-6">
                <a href="{{ $ads->ads_andriod_link }}" target="blank"><img src="{{asset('storage/images/googleplay.png')}}"></a>
            </div>
          </div>
        </div>
        <div class="col-lg-6"></div>
      </div>
      </div>
    </div>
  </section>

  <!--END bannars Section-->
@endsection

@section('scripts')
    <script src="{{url('assets/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{url('assets/js/popper.min.js')}}"></script>
    <script src="{{url('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{url('assets/js/main.js')}}"></script>
@endsection
