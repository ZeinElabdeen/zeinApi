@extends('user.en.layouts.lay') @section('title','Academy Page ') @section('links')

<link rel="stylesheet" href="{{url('assets-en/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/academy.css')}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

@endsection @section('content')
<header>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="banner">
              {{-- <h2>Academy</h2> --}}
              <span class="text-light">Home / <span>Academy</span>
          </div>
        </div>
      </div>
    </div>
</header>


<section class="search">
  <form action="{{url('institute-search')}}" method="get"> 

    <div class="container">
      <div class="search-bar">
        <div class="row">
          <div class="col-sm-12 col-lg-3">
            <div class="form-group">
                <h4>Keywords</h4>
                <input type="text" name="keyword" class="form-control b-r" placeholder="Write keyword">
            </div>
          </div>
          <div class="col-sm-12 col-lg-2">
            <div class="form-group">
              <h4>Countries</h4>
              <select name="country" id="category" class="form-control">
                <option value="">Choose country</option>
                @foreach ($totalCountries as $country)
                  <option value="{{$country['location_id']}}">{{$country['country']}}</option>
                @endforeach
  
              </select>
            </div>
          </div>
          <div class="col-sm-12  col-lg-3">
            <div class="form-group">
              <h4>Cities</h4>
              <select name="city" id="category" class="js-states form-control">
                <option value="">Choose city</option>
                @foreach ($totalCities as $city)
                  <option value="{{$city['city_id']}}">{{$city['city_name']}}</option>
                @endforeach
  
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-lg-2">
            <div class="form-group">
              <h4>Rate</h4>
              <select name="rate" id="category" class="form-control">
                <option value="">Choose rate</option>
                <option value="1">Lowest rate</option>
                <option value="2">Highest rate</option>
              </select>
            </div>
          </div>
          <div class="col-sm-12 col-lg-2">
          <button type="submit" style="background-color: #ffae00;padding: 10px 10px;display: inline-block;margin-top: 22px;color: #fff;text-transform: uppercase;border-radius: 25px;border:0">Search</button>      
          </div>
          </div>
        </div>
    </div>
    </form>
</section>

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
                    <div class="col-md-8">
                        <h6 class="card-subtitle mb-2 text-muted">
                        <img src="{{asset('storage/images/pin (1).png')}}">
                        {{ $inst['country'] }} , {{ $inst['city_name'] }}
                        </h6>
                    </div>
                    <div class="col-md-4">
                        <div class="rate">
                            <ul class="list-inline">

                                @for ($i = 0; $i < $inst['avg_rate_i']; $i++)
                                <li class="list-inline-item active" style="color:#ffae00;margin-right:0"><i class="fas fa-star"></i></li>
                                @endfor
                                @for ($i = 0; $i < 5-$inst['avg_rate_i'] ; $i++)
                                <li class="list-inline-item" style="margin-right:0"><i class="fas fa-star"></i></li>
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
                    <div class="col-7 text-left">
                        <button type="button" class="btn ">
                            <a href="{{url('institute-details/'.$inst['institute_id'])}}" class="price">{{$inst['courses_count']}} courses </a>

                        </button>
                    </div>
                    <div class="col-5 text-right">
                        <button type="button" class="btn">
                            <a href="{{url('institute-details/'.$inst['institute_id'])}}"class="link"> More  <i class="fas fa-arrow-right"></i></a>
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
<script src="{{url('assets-en/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets-en/js/popper.min.js')}}"></script>
<script src="{{url('assets-en/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets-en/js/main.js')}}"></script>
@endsection
