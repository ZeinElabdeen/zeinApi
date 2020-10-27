@extends('user.en.layouts.lay') @section('title',' My Reservations ') @section('links')

<link rel="stylesheet" href="{{url('assets-en/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/reservation.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />



@endsection 
@section('content')

<header>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="banner">
            {{-- <h2>من نحن</h2> --}}
            <span class="text-light">Home / <span> My Reservations  </span>
        </div>
      </div>
    </div>
  </div>
</header>


<!--Start RESERVATION SECTION-->

<section class="reservation">
    <div class="container">
     <div class="row">
     <div class="col-sm-12">
      <ul class="nav nav-pills nav-button mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link  active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Current </a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Previous </a>
          </li>
      </ul>
    </div>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="row">
                @isset($totalCurrentReservations)
                    @foreach ($totalCurrentReservations as $reservation)
                        <div class="col-md-12">
                            <div class="card " >
                                <div class="row no-gutters">
                                    <div class="col-sm-12 col-md-3 col-lg-3">
                                        <a href="{{url('reservation-details/'.Session::get('user_id').'/'.$reservation['reservation_id'])}}">
                                            <img src="{{asset('storage/images/courses/'.$reservation['course_photo'])}}" class="card-img" alt="..." style="cursor: pointer" onclick="submit()">
                                        </a>
                                    </div>
                                
                                    <div class="col-sm-12 col-md-9 co-lg-8">
                                        <div class="card-body">
                                        <h6> Reservation Number: <span>{{$reservation['reservation_id']}}</span></h6>
                                            <span class="top">From  : <span>{{$reservation['from']}}</span></span>
                                        <h5 class="card-title">{{$reservation['course_name']}}</h5>
                                        <p class="card-text">
                                            @php
                                                echo(substr($reservation['course_details'],0,150));
                                            @endphp
                                        </p>
                                        <h6>Price: <span>{{$reservation['total']}} SAR</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-sm-12 col-md-12 col-lg-12">
                    
                        {{ $currentReservations->links() }}
            
                    </div>
                @endisset
                @empty($totalCurrentReservations)
                    
                @endempty
               
               

            </div>
            
          
        
      </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <div class="row">

                @isset($totalPerviousReservations)
                @foreach ($totalPerviousReservations as $reservation)
                    <div class="col-md-12">
                        <div class="card " >
                            <div class="row no-gutters">
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <img src="{{asset('storage/images/courses/'.$reservation['course_photo'])}}" class="card-img" alt="...">
                                </div>
                            
                                <div class="col-sm-12 col-md-9 co-lg-8">
                                    <div class="card-body">
                                    <h6> Reservation Number: <span>{{$reservation['reservation_id']}}</span></h6>
                                        <span class="top">From : <span>{{$reservation['from']}}</span></span>
                                    <h5 class="card-title">{{$reservation['course_name']}}</h5>
                                    <p class="card-text">
                                        @php
                                            echo(substr($reservation['course_details'],0,150));
                                        @endphp
                                    </p>
                                    <h6>Price: <span>{{$reservation['total']}} ٍSAR</span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                @endforeach
                <div class="col-sm-12 col-md-12 col-lg-12">
                
                    {{ $perviousReservations->links() }}
        
                </div>
            @endisset
            @empty($totalPerviousReservations)
                
            @endempty
                
            </div>
           
          
        </div>
        
       
      </div>
    
    </div>
    </div>
  </section>
  
  <!--END RESERVATION Section -->


@endsection @section('scripts')
<script src="{{url('assets-en/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets-en/js/popper.min.js')}}"></script>
<script src="{{url('assets-en/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets-en/js/main.js')}}"></script>
<script>
    function submit() {
        $('#sub').click();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@if (Session::has('Success'))
    {!! Session::get('Success') !!}
@endif

@endsection
