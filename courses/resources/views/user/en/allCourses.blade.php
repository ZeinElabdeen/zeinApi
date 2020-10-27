@extends('user.en.layouts.lay') @section('title','Courses ') @section('links')

<link rel="stylesheet" href="{{url('assets-en/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/courses.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

@endsection @section('content')
<!--Start Search Section-->
<header>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="banner">
            {{-- <h2>من نحن</h2> --}}
            <span  class="text-light">Home / <span>Courses</span>
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
            <h4>Search</h4>
            <input type="text" name="keyword" class="form-control b-r" placeholder=" Keyword ">
          </div>
        </div>
        <div class="col-sm-12 col-lg-2">
          <div class="form-group">
            <h4> Select Courses </h4>
            <select name="local_or_global" id="category" class="form-control">
              <option value=""> Please Choose Course </option>
              <option value="2"> Local Courses </option>
              <option value="1"> Global Courses  </option>

            </select>
          </div>
        </div>
        <div class="col-sm-12  col-lg-3">
          <div class="form-group">
            <h4> Course Type </h4>
            <select name="course_type" id="category" class="js-states form-control">
              <option value=""> Please Choose Course Type </option>
              @foreach ($totalCourseTypes as $course)
                <option value="{{$course['course_type_id']}}">{{$course['course_type_name']}}</option>
              @endforeach

            </select>
          </div>
        </div>
        <div class="col-sm-12 col-lg-2">
          <div class="form-group">
            <h4>Price</h4>
            <select name="price" id="category" class="form-control">
              <option value="">  Please Choose Price</option>
              <option value="1"> Lowest Price</option>
              <option value="2"> Highest Price</option>
            </select>
          </div>
        </div>
        <div class="col-sm-12 col-lg-2">
        <button type="submit" style="background-color: #ffae00;padding: 10px 40px;display: inline-block;margin-top: 22px;color: #fff;text-transform: uppercase;border-radius: 25px;border:0"> Search </button>      
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
              <h1>New Courses</h1>
              <p class="small-text">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis, vero.
              </p>
            </div> --}}
            @foreach ($totalCourses as $course)
              <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card">
                  <img src="{{asset('storage/images/courses/'.$course['course_photo'])}}" class="card-img-top" alt="loe">
                  <a href="{{url('addWishList/'.$course['course_id'])}}" class="add" style="{{$course['liked']== true ? 'background:#ffae00;opacity:1' : ''}}">
                    <i class="fas fa-heart"></i>
                  </a>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                          <h6 class="card-subtitle mb-2 text-muted"> <img src="{{asset('storage/images/company.png')}}"> {{$course['institute_name']}} </h6>
                    </div>
                    <div class="col-md-4">
                      <div class="rate">
                          <ul class="list-inline">
                              @for ($i = 0; $i < $course['avg_rate_c']; $i++)
                              <li class="list-inline-item active" style="color:#ffae00;margin-right: 0;"><i class="fas fa-star"></i></li>
                              @endfor
                              @for ($i = 0; $i < 5-$course['avg_rate_c'] ; $i++)
                              <li class="list-inline-item" style="margin-right: 0;"><i class="fas fa-star"></i></li>
                              @endfor
                          </ul>
                        
                      </div>
                    </div>
                    </div>
                    <h5 class="card-title"> {{$course['course_name']}}  </h5>
                    <p class="card-text">
                            @php
                              echo(substr($course['course_details'],0,150));
                            @endphp
                    </p>
                    </div>
                    <div class="card-footer">
                      <div class="row">
                        <div class="col-6 text-left">
                          <button type="button" class="btn ">
                            <a href="{{url('courses-details/'.$course['course_id'])}}" class="price">{{$course['course_price']}} SAR </a>
                          </button>
                        </div>
                        <div class="col-6 text-right">
                        <button type="button" class="btn">
                          <a href="{{url('courses-details/'.$course['course_id'])}}" class="link">  MORE <i class="fas fa-arrow-right"></i></a>
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
<script src="{{url('assets-en/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets-en/js/popper.min.js')}}"></script>
<script src="{{url('assets-en/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets-en/js/main.js')}}"></script>
@endsection
