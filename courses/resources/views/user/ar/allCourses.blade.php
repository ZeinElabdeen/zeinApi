@extends('user.ar.layouts.lay') @section('title','الدورات ') @section('links')

<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/courses.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

@section('courses','active')

@endsection @section('content')
<!--Start Search Section-->
<header>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="banner">
            <h2>من نحن</h2>
            <span>الرئيسية / <span>الدورات</span>
        </div>
      </div>
    </div>
  </div>
</header>


<!--Start Search Section-->

<section class="search">
  <form action="{{url('courses-search')}}" method="get"> 

  <div class="container">
    <div class="search-bar">
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
            {{-- <select name="local_or_global" id="category" class="form-control">
              <option value="">برجاء تحديد الدورة</option>
              <option value="2">دورات محلية</option>
              <option value="1">دورات عالمية </option>

            </select> --}}
            <style>
              .selectBox{
                padding: .5rem 1rem !important;
                margin: 0 !important;
                color: #495057 !important;
                background-color: transparent !important;
                border: 1px solid #ced4da !important;
              }
              /* .selectBoxOption{
                padding: .5rem 1rem !important;
                margin: 0 !important;
                color: black !important;
                background-color: transparent !important;
                border: 1px solid #ced4da !important;
                border-radius: 0 !important;
              } */
            </style>
            <div class="nav-item dropdown">
                <a class="selectBox nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  برجاء تحديد الدورة
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="selectBoxOption dropdown-item" href="{{url('photoGallery')}}"> دورات محلية </a>
                  <a class="selectBoxOption dropdown-item" href="{{url('vedioGallery')}}"> دورات عالمية</a>
                </div>
              </div>
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

<!--END Search Section -->
<section class="new-courses">
    <div class="container">
        <div class="row">
            
            @if (Session::has('Error'))
            <div class="col-sm-12 col-md-12 col-lg-12">
              <p class="alert alert-warning"> {{Session::get('Error')}}  </p>
            </div>
              @php
                  Session::forget('Error')
              @endphp
            @else
            {{-- <div class="col-sm-12 col-md-12 col-lg-12">
              <h1>احدث الدورات المضافة</h1>
              <p class="small-text">
                  هذا النص هو مثال لنص يمكن أن يستبدل بنص اخر في نفس المساحة
              </p>
            </div> --}}
            @foreach ($totalCourses as $course)
           
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card">
                    <img src="{{asset('storage/images/courses/'.$course['course_photo'])}}" class="card-img-top" alt="loe" />

                    <a href="{{url('addWishList/'.$course['course_id'])}}" class="add" style="{{$course['liked']== true ? 'background:#ffae00;opacity:1' : ''}}">
                        <i class="fas fa-heart"></i>
                    </a>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <img src="{{asset('storage/images/company.png')}}" />
                                    {{$course['institute_name']}}
                                </h6>
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
                        <h5 class="card-title"> {{$course['course_name']}} </h5>
                        <p class="card-text">
                            @php
                            echo(substr($course['course_details'],0,150));
                            @endphp
                        </p>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-6 text-right">
                                <button type="button" class="btn">
                                    <a href="{{url('courses-details/'.$course['course_id'])}}" class="price">{{$course['course_price']}} رس </a>
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
            <div class="col-sm-12 col-md-12 col-lg-12">
                {{ $allCourses->links() }}
            </div>

            @endif
           
            

        </div>
    </div>
</section>
@endsection @section('scripts')
<script src="{{url('assets/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets/js/popper.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/main.js')}}"></script>
@endsection
