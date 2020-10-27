@extends('user.ar.layouts.lay') @section('title',' تفاصيل الحجز ') @section('links')

<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/premium.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
<link rel="stylesheet" href="{{url('assets/css/course-info.css')}}" />


@endsection
@section('reservations','active')
@section('content')

<header>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 text-center">
        <div class="banner">
            <h2>من نحن</h2>
            <span class="text-light">الرئيسية / الدورات / <span> {{$reservationDetails->course_name}}</span>

        </div>
      </div>
    </div>
  </div>
</header>

<section class="cours-info">
    <div class="container">
            <img src="{{asset('storage/images/company.png')}}">
            <span>{{$reservationDetails->institute_name}}</span>
            <div class="row">
                <div class=" col-sm-12 col-md-6 col-lg-4">
                <h4>{{$reservationDetails->course_name}}</h4>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-4">

                </div>
                 <div class="col-md-12">
                    <div class="rate">

                    </div>
                </div>


                <div class=" col-sm-12 col-md-8">
                    <img src="{{asset('storage/images/courses/'.$reservationDetails->course_photo)}}" class="img-nav" style="width:100%">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">تفاصيل الدورة</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">تفاصيل المعهد</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <p>
                            {{$reservationDetails->course_details}}
                            </p>
                        </div>

                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class="col-md-12">
                                <h3>
                                {{$reservationDetails->institute_name}}
                                </h3>
                            </div>
                            <div class="col-md-12">
                                <div class="rate">

                                </div>
                            </div>

                            <p>
                                {{$reservationDetails->institute_details}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 side-bar">
                   
                   
                        <ul class="list-group mb-3">
                          <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                              <h6 class="my-0 text-warning">رقم الحجز</h6>

                            </div>
                            <div>
                                <h6 class="my-0 text-warning">{{$reservationDetails->reservation_id }}</h6>
                              </div>
                          </li>

                          <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                              <h6 class="my-0"> الخصم</h6>
                            </div>
                            <div>
                                <span class="text-muted">
                                   0%
                                </span>
                            </div>
                          </li>

                          <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                              <h6 class="my-0">تاريخ بداية الدورة</h6>
                            </div>
                            <div>
                                <span class="text-muted">
                                    {{ $reservationDetails->start_at }}
                                </span>
                            </div>
                          </li>
                          <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                              <h6 class="my-0"> عدد الاسابيع</h6>
                            </div>
                            <div>
                              <span class="text-muted">
                                {{ $reservationDetails->reserved_weeks_number }}

                              </span>
                            </div>
                          </li>
                          <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ $reservationDetails->living_name }}</h6>
                            </div>
                            <div>
                                <h6 class="my-0"> {{$reservationDetails->living_price}} رس</h6>
                            </div>

                          </li>
                          <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ $reservationDetails->airport_rec_name }}</h6>
                            </div>
                            {{-- <span class="text-muted">

                            </span> --}}
                            <div>
                              <h6 class="my-0">{{ $reservationDetails->airport_rec_price }} رس</h6>
                            </div>

                          </li>
                          <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ $reservationDetails->medical_insurance_name }}</h6>
                            </div>
                            {{-- <span class="text-muted">
                                {{ $reservationDetails->medical_insurance_name }}
                            </span> --}}
                            <div>
                              <h6 class="my-0">{{ $reservationDetails->medical_insurance_price }} رس</h6>
                            </div>

                          </li>
                        </ul>

                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                  <h6 class="my-0">سعر الأسبوع</h6>
                                </div>
                                <div>
                                    <h6 class="my-0">{{$reservationDetails->course_price}} رس</h6>
                                  </div>
                              </li>
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div>
                                    <h6 class="my-0">رسوم التسجيل</h6>

                                  </div>
                                  <div>
                                      <h6 class="my-0">{{$reservationDetails->registration_fees}} رس</h6>
                                  </div>
                              </li>
                              <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                  <h6 class="my-0">رسوم الأقامة</h6>

                                </div>
                                <div>
                                  <h6 class="my-0">{{$reservationDetails->living_fees}} رس</h6>
                              </div>
                              </li>
                              <li class="list-group-item d-flex justify-content-between bg-light">
                                <div>
                                    <h6 class="my-0">رسوم البريد السريع</h6>

                                  </div>
                                  <div>
                                      <h6 class="my-0">{{$reservationDetails->mail_fees}} رس</h6>
                                  </div>
                              </li>
                              <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                  <h6 class="my-0">رسوم الكتب </h6>

                                </div>
                                <div>
                                  <h6 class="my-0">{{$reservationDetails->book_fees}} رس</h6>
                              </div>
                              </li>
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div>
                                    <h6 class="my-0">رسوم الأـضافية في الصيف</h6>

                                  </div>
                                  <div>
                                      <h6 class="my-0">{{$reservationDetails->summer_fees}} رس</h6>
                                  </div>
                              </li>
                              <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                  <h6 class="my-0">ضريبة القيمة المضافة</h6>

                                </div>
                                <div>
                                  <h6 class="my-0">{{$reservationDetails->tax_fees * 100}}%</h6>
                              </div>
                              </li>

                              <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="text-warning">  الاجمالي </h6>
                                </div>
                                  <span class="text-warning">{{$reservationDetails->total}} رس</span>
                              </li>
                        </ul>
                        <form action="{{url('sendInvoice/'.$reservationDetails->student_id.'/'.$reservationDetails->reservation_id)}}" method="post">
                          @csrf
                          <ul>
                              <li class="list-group-item "><button type="submit"  class="form-control button2" style="border:0;color:white;"> ارسال الفاتورة</button></li>
                          </ul>
                      </form>
                </div>
            </div>
    </div>
    </div>
</section>

@endsection @section('scripts')
<script src="{{url('assets/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets/js/popper.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets/js/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
@if(Session::has('Success'))
  {!! Session::get('Success') !!}
@endif
@php
if(Session::has('Success')){
    Session::forget('Success');
}
@endphp

@if(Session::has('Error'))
  {!! Session::get('Error') !!}
@endif
@php
if(Session::has('Error')){
    Session::forget('Error');
}
@endphp

@endsection
