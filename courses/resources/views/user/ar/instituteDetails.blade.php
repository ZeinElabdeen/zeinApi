@extends('user.ar.layouts.lay') @section('title','المعاهد ') @section('links')

<link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/courses.css')}}" />
<link rel="stylesheet" href="{{url('assets/css/academy-info.css')}}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />

@section('institutes','active')


@endsection @section('content')
<header>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="banner">
             <h3>دورة تعليمية لبرمجة الجوال</h3>
             <span>الرئيسية / الدورات / <span>{{ $InstitutesDetails->institute_name}}</span>

          </div>
        </div>
      </div>
    </div>
  </header>
<section class="academy-info">
    <div class="container">
      <div class="row">
        <div class=" col-sm-12 col-md-6 col-lg-12">
            <h4>{{ $InstitutesDetails->institute_name}}</h4>
        </div>
        <div class="col-sm-12 col-md-6 col-md-12">
            <div class="rate">
                <ul class="list-inline">
                    @for ($i = 0; $i <  $InstitutesDetails->avg_rate_i ; $i++)
                    <li class="list-inline-item active" style="color:#ffae00"><i class="fas fa-star"></i></li>
                    @endfor
                    @for ($i = 0; $i < 5- $InstitutesDetails->avg_rate_i  ; $i++)
                    <li class="list-inline-item"><i class="fas fa-star"></i></li>
                    @endfor
                <li class="list-inline-item"><span>( تقيمات : {{ $InstitutesDetails->countRateInstitute }} )</span></li>
                </ul>
            </div>
            </div>
            <div class="col-lg-12">
                <img src="{{asset('storage/images/institutes/'.$InstitutesDetails->institutes_photo)}}" class="img-nav">
            </div>
            <div class="col-sm-12 col-lg-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">تفاصيل المعهد</a>
                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">الدورات</a>
                      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">دورات اونلاين</a>
                    </div>
                  </nav>
                  <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <p>{{ $InstitutesDetails->institute_details}}
                        </p>
                    </div>

                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="new-courses">
                        <div class="row">
                            @if($instituteCousre != null)
                            @foreach ($instituteCousre as $inst_c)
                                <div class="col-sm-12 col-md-6 col-lg-4">
                                    <div class="card">
                                    <img src="{{asset('storage/images/courses/'.$inst_c['course_photo'])}}" class="card-img-top" alt="loe">

                                    <a href="دورة تعليمية .html" class="add">
                                        <i class="fas fa-heart"></i>
                                        </a>
                                    <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="card-subtitle mb-2 text-muted">
                                            <img src="{{asset('storage/images/company.png')}}">
                                            {{ $inst_c['institute_name'] }}
                                            </h6>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="rate">
                                            <ul class="list-inline">
                                                @for ($i = 0; $i < $inst_c['avg_rate_c']; $i++)
                                                <li class="list-inline-item active" style="color:#ffae00"><i class="fas fa-star"></i></li>
                                                @endfor
                                                @for ($i = 0; $i < 5-$inst_c['avg_rate_c'] ; $i++)
                                                <li class="list-inline-item"><i class="fas fa-star"></i></li>
                                                @endfor
                                                </ul>
                                        </div>
                                        </div>
                                        </div>
                                            <h5 class="card-title">{{ $inst_c['course_name']}}</h5>
                                            <p class="card-text">@php
                                                echo(substr($inst_c['course_details'],0,150));
                                                @endphp</p></p>
                                        </div>
                                        <div class="card-footer">
                                        <div class="row">
                                            <div class="col-6 text-right">
                                            <button type="button" class="btn ">
                                                <a href="#"class="price">{{ $inst_c['course_price']}} رس </a>
                                            </button>
                                            </div>
                                            <div class="col-6 text-left">
                                            <button type="button" class="btn">
                                            <a href="{{url('courses/'. $inst_c['course_id'] )}}"class="link">إظهار المزيد<i class="fas fa-arrow-left"></i></a>
                                            </button>
                                            </div>
                                        </div>
                                        </div>
                                </div>
                                </div>
                        @endforeach
                        @else
                        <p class="text-center">لايوجد كورسات</p>
                        @endif
                    </div>
                  </div>
                  </div>

                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="new-courses">
                            <div class="row">
                                @if($instituteCourseOnline != null)
                                @foreach ($instituteCourseOnline as $inst_on)
                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <div class="card">
                                            <img src="{{asset('storage/images/onlineCourse/'.$inst_on['online_course_photo'])}}" class="card-img-top" alt="loe">

                                            <a href="{{ $inst_on['online_course_link'] }}" class="add">
                                                <i class="fas fa-heart"></i>
                                                </a>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6 class="card-subtitle mb-2 text-muted">
                                                        <img src="{{asset('storage/images/company.png')}}">
                                                        {{ $inst_on['institute_name']}}
                                                        </h6>
                                                    </div>

                                                </div>
                                                <h5 class="card-title">{{ $inst_on['online_course_name']}}</h5>
                                                <p class="card-text">@php
                                                    echo(substr($inst_on['online_course_details'],0,150));
                                                    @endphp</p>
                                            </div>

                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                <p class="text-center">لايوجد كورسات اونلاين  </p>
                                @endif
                          </div>
                          </div>
                          </div>
                    </div>
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
@endsection
