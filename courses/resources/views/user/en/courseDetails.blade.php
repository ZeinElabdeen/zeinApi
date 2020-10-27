@extends('user.en.layouts.lay') @section('title',' Course details ') @section('links')

<link rel="stylesheet" href="{{url('assets-en/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/premium.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/course-info.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />


@endsection @section('content')
<!--Start Header Section -->

<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="banner">
                    {{-- <h2>{{$courseDetails->course_name}}</h2> --}}
                    <span class="text-light">Home / Courses / <span> {{$courseDetails->course_name}} </span>
                </div>
            </div>
        </div>
    </div>
</header>

<!--END Header Section -->

<!--Section COURS-INFO -->

<section class="cours-info">

    <div class="container">
    <img src="{{asset('storage/images/company.png')}}">
        <span>{{$courseDetails->institute_name}}</span>
          <div class="row">
            <div class=" col-sm-12 col-md-6 col-lg-4">
              <h4>{{$courseDetails->course_name}}</h4>
                </div>
                <div class=" col-sm-12 col-md-6 col-lg-4">
                    <span> <a href="{{url('addWishList/'.$courseDetails->course_id)}}" class="add text-warning"><i class="{{$courseDetails->liked== true ? ' fas fa-heart' : 'far fa-heart'}} "></i></a> Add to favorite </span>
                </div>
                  <div class="col-md-12">
                  <div class="rate">
                    <ul class="list-inline">
                        @for ($i = 0; $i < $courseDetails->avg_rate_c; $i++)
                        <li class="list-inline-item active" style="color:#ffae00"><i class="fas fa-star"></i></li>
                        @endfor
                        @for ($i = 0; $i < 5-$courseDetails->avg_rate_c ; $i++)
                        <li class="list-inline-item"><i class="fas fa-star"></i></li>
                        @endfor
                        <li class="list-inline-item">  <span>({{$courseDetails->countRateInstitute}} Rates)</span></li>
                  </ul>
      </div>
    </div>

      <div class=" col-sm-12 col-md-8">
      <img src="{{asset('storage/images/courses/'.$courseDetails->course_photo)}}" class="img-nav" style="width:100%">
      <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
          <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"> Course details </a>
          <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"> Academy details</a>

      </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <p>
            {{$courseDetails->course_details}}
          </p>

      </div>

      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          <div class="col-md-12">
              <h3>
                {{$courseDetails->institute_name}}
            </h3>
          </div>
          <div class="col-md-12">
              <div class="rate">
                  <ul class="list-inline">
                    @for ($i = 0; $i < $courseDetails->avg_rate_i; $i++)
                    <li class="list-inline-item active" style="color:#ffae00"><i class="fas fa-star"></i></li>
                    @endfor
                    @for ($i = 0; $i < 5-$courseDetails->avg_rate_i ; $i++)
                    <li class="list-inline-item"><i class="fas fa-star"></i></li>
                    @endfor
                    <li class="list-inline-item">  <span>({{$courseDetails->countRateCourse}} Rates)</span></li>
                    </ul>
              </div>
              </div>

        <p>
            {{$courseDetails->institute_details}}
        </p>
  </div>
  </div>
  </div>
  <div class="col-sm-12 col-md-4 side-bar">

      <form action="{{url('add-reservation/'.$courseDetails->course_id)}}" method="post">
        @csrf

          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <span class="my-0 text-warning">Discount</span>

              </div>
              <div>
                  <span class="my-0 text-warning">%0</span>
                </div>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <span class="my-0"> Start date</span>
              </div>
              <div>
              <span class="text-muted">
                  <input type="date" id="date" name="startDate" class="@error('start_at') is-invalid @enderror" value="{{old('startDate')}}"></span>
                  @if ($errors->has('start_at'))
                     <p class="text-danger text-right">{{$errors->first('start_at')}}</p>
                  @endif
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <div>
                <span class="my-0"> Weeks number </span>
              </div>
              <div>
                <span class="text-muted">
                      <select name="weeksNumber" class="custom-select @error('weeks_number') is-invalid @enderror" id="weeks_number">
                          @for ($i=1; $i<=$courseDetails->weeks_number;$i++)
                      <option value="{{$i}}" {{old('weeksNumber') == $i ? 'selected' : ''}} price="{{($courseDetails->course_price/$courseDetails->weeks_number)*$i}}">{{$i}} Week</option>
                          @endfor
                      </select>
                      @if ($errors->has('weeks_number'))
                        <p class="text-danger text-right">{{$errors->first('weeks_number')}}</p>
                      @endif
                </span>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <span class="text-muted">
                  <select  name="residence" class="custom-select @error('living_id') is-invalid @enderror" id="living">
                    <option selected value="4" price="0"> I do not want residence </option>
                     @foreach ($totalLivings as $living)
                        <option value="{{$living['living_id']}}" price="{{$living['living_price']}}" >{{$living['living_name']}}</option>
                     @endforeach
                    </select>
                    @if ($errors->has('living_id'))
                    <p class="text-danger text-right">{{$errors->first('living_id')}}</p>
                    @endif
              </span>
              <div>
                <span class="my-0" id="living_price">0.00</span>
              </div>

            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <span class="text-muted">
                  <select name="reception" class="custom-select @error('airport_rec_id') is-invalid @enderror" id="reception">
                        <option selected value="13" price="0"> I do not want airport reception</option>
                        @foreach ($totalReceptions as $receptions)
                            <option value="{{$receptions['airport_rec_id']}}" price="{{$receptions['airport_rec_price']}}">{{$receptions['airport_rec_name']}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('airport_rec_id'))
                    <p class="text-danger text-right">{{$errors->first('airport_rec_id')}}</p>
                    @endif
              </span>
              <div>
                <span class="my-0" id="reception_price">0.00</span>
              </div>

            </li>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
              <span class="text-muted">
                  <select name="insurance" class="custom-select @error('medical_insurance_id') is-invalid @enderror" id="insurance">
                        <option selected value="13" price="0"> I do not need medical insurance</option>
                        @foreach ($totalInsurances as $insurance)
                            <option value="{{$insurance['medical_insurance_id']}}" price="{{$insurance['medical_insurance_price']}}">{{$insurance['medical_insurance_name']}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('medical_insurance_id'))
                    <p class="text-danger text-right">{{$errors->first('medical_insurance_id')}}</p>
                    @endif
              </span>
              <div>
                <span class="my-0" id="insurance_price">0.00</span>
              </div>

            </li>
          </ul>

          <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <span class="my-0" > Course Price </span>
                  </div>
                  <div>
                      <span class="my-0" id="course_price" >{{$courseDetails->course_price}}</span> SAR
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <span class="my-0" > Week Price </span>
                  </div>
                  <div>
                      <span class="my-0" id="course_week_price" >{{round($courseDetails->course_price/$courseDetails->weeks_number,2)}}</span> SAR
                    </div>
                </li>
              <li class="list-group-item d-flex justify-content-between bg-light">
                  <div>
                      <span class="my-0"> Registeration Fees </span>

                    </div>
                    <div>
                        <span class="my-0" id="registration_fees">{{$courseDetails->registration_fees}}</span> SAR
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <span class="my-0"> Residence Fees </span>

                  </div>
                  <div>
                    <span class="my-0" id="living_fees">{{$courseDetails->living_fees}}</span>  SAR
                </div>
                </li>
                <li class="list-group-item d-flex justify-content-between bg-light">
                  <div>
                      <span class="my-0">Express Mail Fees</span>

                    </div>
                    <div>
                        <span class="my-0" id="mail_fees">{{$courseDetails->mail_fees}}</span> SAR
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <span class="my-0" > Book Fees </span>

                  </div>
                  <div>
                    <span class="my-0" id="book_fees">{{$courseDetails->book_fees}}</span> SAR
                </div>
                </li>
              <li class="list-group-item d-flex justify-content-between bg-light">
                  <div>
                      <span class="my-0">  Extra Fees In Summer </span>

                    </div>
                    <div>
                        <span class="my-0" id="summer_fees">{{$courseDetails->summer_fees}}</span> SAR
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <span class="my-0"> Vat </span>

                  </div>
                  <div>
                    <span class="my-0" id="tax_fees">{{$courseDetails->tax_fees * 100}}</span>%
                </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">

                  <div>

                    <label> Coupon </label>
                    <div class="input-group">
                    <input type="text"  name="coupon" class="form-control @error('coupon_number') is-invalid @enderror" placeholder=" Insert Coupon " value="{{old('coupon')}}">
                      <div class="input-group-append">
                          <a href="" class="btn btn-warning">
                            Verify
                          </a>
                      </div>
                    </div>
                    @if ($errors->has('coupon_number'))
                        <p class="text-danger text-right">{{$errors->first('coupon_number')}}</p>
                    @endif
                  </div>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                      <span class="text-warning">  Total </span>
                    </div>
                    <div class="text-warning">
                      <span class="text-warning" id="total">00.00</span> SAR
                    </div>
                             {{-- round(
		(`courses`.`registration_fees` + `courses`.`summer_fees` + `courses`.`course_price` + `courses`.`book_fees` + `courses`.`living_fees` + `courses`.`mail_fees` + `medical_insurance`.`medical_insurance_price` + `living`.`living_price` + `airport_rec`.`airport_rec_price`)+((`courses`.`registration_fees` + `courses`.`summer_fees` + `courses`.`course_price` + `courses`.`book_fees` + `courses`.`living_fees` + `courses`.`mail_fees` + `medical_insurance`.`medical_insurance_price` + `living`.`living_price` + `airport_rec`.`airport_rec_price`)*`courses`.`tax_fees`),
		2
	) AS `total`, --}}
                </li>
          </ul>
          <ul>
              <li class="list-group-item "><button type="submit"  class="form-control button2" style="border:0;color:white;"> Book Now! </button></li>
          </ul>
        </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</section>

  <!--END COURS-INFO SECTION-->





@endsection @section('scripts')
<script src="{{url('assets-en/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets-en/js/popper.min.js')}}"></script>
<script src="{{url('assets-en/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets-en/js/main.js')}}"></script>

@endsection
