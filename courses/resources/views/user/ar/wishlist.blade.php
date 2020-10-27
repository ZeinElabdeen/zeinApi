@extends('user.ar.layouts.lay') @section('title',' المفضلة ') @section('links')

<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/fav-course.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />



@endsection 
@section('wishlist','active')
@section('content')

<header>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="banner">
            {{-- <h2>من نحن</h2> --}}
            <span class="text-light">الرئيسية / <span>  الملف الشخصي  </span>
        </div>
      </div>
    </div>
  </div>
</header>

<!--Start Courses Section-->

<section class="fav-course">
    <div class="container">
      <div class="row">
         <div class="col-sm-12 col-md-12 col-lg-12">
            <h1>قائمة المفضلة </h1>
            {{-- <p class="small-text">
              هذا النص هو مثال لنص يمكن أن يستبدل بنص اخر في نفس المساحة
            </p> --}}
        </div>
        @isset($totalWishCourses)
            @foreach ($totalWishCourses as $wish)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card">
                    <img src="{{asset('storage/images/courses/'.$wish['course_photo'])}}" class="card-img-top" alt="loe" />

                    <a href="{{url('addWishList/'.$wish['course_id'])}}" class="add">
                        <i class="fas fa-heart"></i>
                    </a>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <img src="{{asset('storage/images/company.png')}}" />
                                    {{$wish['institute_name']}}
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <div class="rate">
                                    <ul class="list-inline">
                                        @for ($i = 0; $i < $wish['avg_rate_c']; $i++)
                                        <li class="list-inline-item active" style="color:#ffae00"><i class="fas fa-star"></i></li>
                                        @endfor
                                        @for ($i = 0; $i < 5-$wish['avg_rate_c'] ; $i++)
                                        <li class="list-inline-item"><i class="fas fa-star"></i></li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title"> {{$wish['course_name']}} </h5>
                        <p class="card-text">
                            @php
                            echo(substr($wish['course_details'],0,150));
                            @endphp
                        </p>
                    </div>
                    <div class="card-footer">
                            <div class="row">
                                <div class="col-6 text-right">
                                    <button type="button" class="btn">
                                        <a href="#" class="price">{{$wish['course_price']}} رس </a>
                                    </button>
                                </div>
                                <div class="col-6 text-left">
                                    <button type="button" class="btn">
                                        <a href="{{url('courses-details/'.$wish['course_id'])}}" class="link">إظهار المزيد<i class="fas fa-arrow-left"></i></a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endisset
        @empty($totalWishCourses)
        <div class="text-center m-auto">
            <h3 class="muted text-danger my-5">عفوا لايوجد قائمة مفضلة لديك<h3>
        </div>
        @endempty
        
        <div class="col-sm-12 col-md-12 col-lg-12">
            {{ $allWishlist->links() }}
        </div>

        
      </div>
      </div>
  </section>
      
  <!--END Courses Section-->
  


</section>
@endsection @section('scripts')
<script src="{{url('assets/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets/js/popper.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/main.js')}}"></script>

@endsection
