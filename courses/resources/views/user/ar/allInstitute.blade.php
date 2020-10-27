@extends('user.ar.layouts.lay') @section('title','المعاهد ') @section('links')

<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/premium.css')}}" />
{{-- <link rel="stylesheet" href="{{url('assets/css/courses.css')}}" /> --}}
<link rel="stylesheet" href="{{url('assets/css/academy.css')}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

@section('institutes','active')

@endsection @section('content')
<header>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="banner">
              <h2>المعاهد</h2>
              <span>الرئيسية / <span>المعاهد</span>
          </div>
        </div>
      </div>
    </div>
</header>
    
 

<!--Start Search Section-->

<section class="search">
  <form action="{{url('institute-search')}}" method="get"> 

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
            <h4>تحديد الدول</h4>
            <select name="country" id="category" class="form-control">
              <option value="">برجاء أختيار الدولة </option>
              @foreach ($totalCountries as $country)
                <option value="{{$country['location_id']}}">{{$country['country']}}</option>
              @endforeach

            </select>
          </div>
        </div>
        <div class="col-sm-12  col-lg-3">
          <div class="form-group">
            <h4>تحديد المدن</h4>
            <select name="city" id="category" class="js-states form-control">
              <option value="">برجاء أختيار المدينة </option>
              @foreach ($totalCities as $city)
                <option value="{{$city['city_id']}}">{{$city['city_name']}}</option>
              @endforeach

            </select>
          </div>
        </div>
        <div class="col-sm-12 col-lg-2">
          <div class="form-group">
            <h4>التقيم</h4>
            <select name="rate" id="category" class="form-control">
              <option value="">برجاء أختيار التقيم</option>
              <option value="1">الأقل تقيما</option>
              <option value="2">الأعلى تقيما</option>
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

<!--Start Academy Section-->

<section class="new-academy">
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
         @foreach ($totalInstitute as $inst)
            <div class="col-sm-12 col-md-6 col-lg-4">
                <div class="card">
                <img src="{{asset('storage/images/institutes/'.$inst['institutes_photo'])}}" class="card-img-top" alt="loe">
                <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="card-subtitle mb-2 text-muted">
                        <img src="{{asset('storage/images/pin (1).png')}}">
                        {{ $inst['country'] }} , {{ $inst['city_name'] }}
                        </h6>
                    </div>
                    <div class="col-md-6">
                        <div class="rate">
                            <ul class="list-inline">

                                @for ($i = 0; $i < $inst['avg_rate_i']; $i++)
                                <li class="list-inline-item active" style="color:#ffae00;margin-right:0;"><i class="fas fa-star"></i></li>
                                @endfor
                                @for ($i = 0; $i < 5-$inst['avg_rate_i'] ; $i++)
                                <li class="list-inline-item" style="margin-right:0;"><i class="fas fa-star"></i></li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                    </div>
                    <h5 class="card-title"> {{ $inst['institute_name'] }}</h5>

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
                        <a href="{{url('institute-details/'.$inst['institute_id'])}}"class="price">{{$inst['courses_count']}} دورات </a> 
                        </button>
                    </div>
                    <div class="col-6 text-left">
                        <button type="button" class="btn">
                        <a href="{{url('institute-details/'.$inst['institute_id'])}}"class="link">إظهار المزيد<i class="fas fa-arrow-left"></i></a>
                        </button>
                    </div>
                    </div>
                </div>
                </div>
            </div>
       @endforeach
       <div class="col-sm-12 col-md-12 col-lg-12">
        {{ $allInstitutes->links() }}
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
