@extends('admin.layouts.nav')
@section('title','Course Details')
@section('links')
    <link rel="stylesheet" href="{{url('adminAssests/plugins/summernote/summernote-bs4.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style>
        #img{
            cursor: pointer;
        }
    </style>

@endsection
@section('content')
<form action="{{url('admin/reservation/'.$reservationDetails->reservation_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-3">
          <h1>Reservations</h1>
        </div>
        <div class="col-6">
            {{-- Errors :
            @foreach ($errors as $e)
                <li>{{$e}}</li>
            @endforeach --}}
            @if(Session::has('Success'))
                <div class="alert alert-success text-center">{{Session::get('Success')}}</div>
            @endif
            @php
             if(Session::get('Success')){
                 Session::forget('Success');
             }
            @endphp

            @if(Session::has('Error'))
                <div class="alert alert-danger text-center">{{Session::get('Error')}}</div>
            @endif
            @php
             if(Session::get('Error')){
                Session::forget('Error');
             }
            @endphp

            @foreach ($errors as $e)
            <li>{{$e}}</li>
            @endforeach
        </div>
        <div class="col-sm-3">
          <ol class="breadcrumb float-sm-right">
            {{-- <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li> --}}
            <li class="breadcrumb-item active">Reservation Details</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card card-solid">
      <div class="card-body">
        <div class="row">
            {{-- <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none">{{$reservationDetails->reservation_id}}</h3>
                <div class="col-12">
                    <img src="{{url('storage/images/courses/'.$courseDetails->course_photo)}}" class="product-image" id="img" alt="{{$courseDetails->course_name}}">
                    <input type="file" name="course_photo" id="imginput" style="display: none;" onchange="showPhoto()">
                </div>

            </div> --}}
            <div class="col-12 col-sm-6">
                <h3 class="my-3"  style="text-transform: capitalize;" > Reservation #{{$reservationDetails->reservation_id}}</h3>



                <table class="table">
                    <tbody>

                    <tr>
                        <th class="align-middle">Course</th>
                        <td style="text-transform: capitalize;">
                            {{-- <input type="text" name="course_name" class="form-control" id="" value="{{$courseDetails->course_name}}" > --}}
                            <select name="course_id" id="" class="form-control">
                                @foreach ($courses as $course)
                                    <option value="{{$course->course_id}}" {{$course->course_id == $reservationDetails->course_id ? 'selected':''}}>{{$course->course_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('course_id'))
                                <p class="text-danger">{{$errors->first('course_id')}}</p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle">Student</th>
                        <td style="text-transform: capitalize;">
                            {{-- <input type="text" name="course_name_ar" class="form-control" id="" value="{{$courseDetails->course_name_ar}}" > --}}
                            <select name="student_id" id="" class="form-control">
                                @foreach ($students as $student)
                                    <option value="{{$student->student_id}}" {{$student->student_id == $reservationDetails->student_id ? 'selected':''}}>{{$student->student_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('student_id'))
                                <p class="text-danger">{{$errors->first('student_id')}}</p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle">Residence</th>
                        <td style="text-transform: capitalize;">
                            <select name="living_id" id="" class="form-control">
                                @foreach ($residences as $residence)
                                    <option value="{{$residence->living_id}}" {{$residence->living_id == $reservationDetails->living_id ? 'selected':''}}>{{$residence->living_name}}</option>
                                    @if ($loop->last)
                                    @if ($residence->living_id !== 4)
                                    <option value="{{$reservationDetails->living_id}}" >i dont want Residence</option>
                                    @endif

                                @endif
                                @endforeach
                                @if ($reservationDetails->living_id == 4)
                                    <option value="{{$reservationDetails->living_id}}" selected>i dont want Residence</option>
                                @endif

                            </select>
                            @if ($errors->has('living_id'))
                                <p class="text-danger">{{$errors->first('living_id')}}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">Reception</th>
                        <td style="text-transform: capitalize;">
                            <select name="airport_rec_id" id="" class="form-control">
                                @foreach ($receptions as $reception)
                                    <option value="{{$reception->airport_rec_id}}" {{$reception->airport_rec_id == $reservationDetails->airport_rec_id ? 'selected':''}}>{{$reception->airport_rec_name}}</option>
                                    @if ($loop->last)
                                        @if ($reception->airport_rec_id !== 13)
                                            @if ($reservationDetails->airport_rec_id == 13)
                                                <option value="{{$reservationDetails->airport_rec_id}}" selected>i dont want Reception</option>
                                            @else
                                                <option value="{{$reservationDetails->airport_rec_id}}" >i dont want Reception</option>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach


                            </select>
                            @if ($errors->has('airport_rec_id'))
                                <p class="text-danger">{{$errors->first('airport_rec_id')}}</p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle">Medical insurance</th>
                        <td style="text-transform: capitalize;">
                            <select name="medical_insurance_id" id="" class="form-control">
                                @foreach ($insurances as $insurance)
                                    <option value="{{$insurance->medical_insurance_id}}" {{$insurance->medical_insurance_id == $reservationDetails->medical_insurance_id ? 'selected':''}}>{{$insurance->medical_insurance_name}}</option>
                                    @if ($loop->last)
                                        @if ($insurance->medical_insurance_id !== 13)
                                            @if ($reservationDetails->medical_insurance_id == 13)
                                                <option value="{{$reservationDetails->medical_insurance_id}}" selected>i dont want Medical insurance</option>
                                            @else
                                                <option value="{{$reservationDetails->medical_insurance_id}}" >i dont want Medical insurance</option>

                                            @endif
                                        @endif
                                         {{-- @if ($reservationDetails->medical_insurance_id == 13)
                                            <option value="{{$reservationDetails->medical_insurance_id}}" selected>i dont want Medical insurance</option>
                                        @endif --}}
                                     @endif
                                @endforeach

                            </select>
                            @if ($errors->has('medical_insurance_id'))
                                <p class="text-danger">{{$errors->first('medical_insurance_id')}}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">Start</th>

                        <td style="text-transform: capitalize;">

                        <input type="date" name="start_at" class="form-control"  id="" value="{{$reservationDetails->start_at}}">
                            @if ($errors->has('start_at'))
                                <p class="text-danger">{{$errors->first('start_at')}}</p>
                            @endif

                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">Number of weeks </th>
                        <td style="text-transform: capitalize;">
                            <div class="input-group mb-2">
                                <input  type="number"  name="reserved_weeks_number" class="form-control" id="inlineFormInputGroup"  value="{{$reservationDetails->reserved_weeks_number}}" >
                                <div class="input-group-prepend">
                                    <div class="input-group-text">SAR</div>
                                </div>
                            </div>
                            @if ($errors->has('reserved_weeks_number'))
                                <p class="text-danger">{{$errors->first('reserved_weeks_number')}}</p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle">Coupon</th>

                        <td style="text-transform: capitalize;">

                        <input type="number" name="coupon" class="form-control"  id="" value="{{$reservationDetails->coupon}}">

                            @if ($errors->has('coupon'))
                                <p class="text-danger">{{$errors->first('coupon')}}</p>
                            @endif

                        </td>
                    </tr>

                    <tr >
                        <th class="align-middle">created_at</th>
                    <td style="text-transform: capitalize;">{{$reservationDetails->created_at}}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="text-right">
                    <button class="btn btn-success" type="submit">Save Changes</button>
                </div>

            </div>
        </div>

        {{-- <div class="row mt-4">
          <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
              <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
              <a class="nav-item nav-link" id="living-tab" data-toggle="tab" href="#living" role="tab" aria-controls="living" aria-selected="false">Residence</a>
              <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Reception</a>
              <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Medical Insurances</a>
              <a class="nav-item nav-link" id="rates" data-toggle="tab" href="#user-rating" role="tab" aria-controls="user-rating" aria-selected="false">Rates</a>
            </div>
          </nav>
          <div class="tab-content p-3 w-100" id="nav-tabContent">

            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">

                <label for="course_details">Course Details (EN)</label>
                <textarea  class="textarea" name="course_details" id="course_details" class=" form-control" style="resize: none" rows="5">{{$courseDetails->course_details}}</textarea>
                @if ($errors->has('course_details'))
                    <p class="text-danger">{{$errors->first('course_details')}}</p>
                @endif
                <label for="course_details_ar">Course Details (AR)</label>
                <textarea  class="textarea" name="course_details_ar" id="course_details_ar" class=" form-control" style="resize: none" rows="5">{{$courseDetails->course_details_ar}}</textarea>
                @if ($errors->has('course_details_ar'))
                    <p class="text-danger">{{$errors->first('course_details_ar')}}</p>
                @endif
            </div>

             <div class="tab-pane fade " id="living" role="tabpanel" aria-labelledby="living-tab">
                 <div class="row">
                    @isset($courseResidences)
                        @foreach ($courseResidences as $Res)
                            <div class="col-3 mx-1 ">

                                <div class="callout callout-success py-1 borderd">
                                    <h4>{{$loop->iteration}} Residence</h4>
                                    <input type="hidden" name="living_id[]" id="" value="{{$Res->living_id}}">
                                    @if ($errors->has('living_id'))
                                        <p class="text-danger">{{$errors->first('living_id')}}</p>
                                    @endif
                                    <label for="living_name">Residence Name (EN)</label>
                                    <input type="text" name="living_name[]" class="form-control my-1" id="living_name" value="{{$Res->living_name}}" >

                                    @if ($errors->has('living_name'))
                                        <p class="text-danger">{{$errors->first('living_name')}}</p>
                                    @endif

                                    <label for="living_name_ar">Residence Name (AR)</label>
                                    <input type="text" name="living_name_ar[]" class="form-control my-1" id="living_name_ar" value="{{$Res->living_name_ar}}" >

                                    @if ($errors->has('living_name_ar'))
                                        <p class="text-danger">{{$errors->first('living_name_ar')}}</p>
                                    @endif

                                    <label for="inlineFormInputGroup">Residence Price</label>
                                    <div class="input-group mb-2">
                                        <input  type="number"  step="0.01" name="living_price[]" class="form-control my-1" id="inlineFormInputGroup"  value="{{$Res->living_price}}" >
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">SAR</div>
                                        </div>
                                    </div>
                                    @if ($errors->has('living_price'))
                                        <p class="text-danger">{{$errors->first('living_price')}}</p>
                                    @endif

                                </div>

                            </div>

                        @endforeach
                    @endisset
                    @empty($courseResidences)
                        <p class="text-center">No Residence yet</p>
                    @endempty
                </div>



            </div>

            <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                @isset($courseReceptions)
                        @foreach ($courseReceptions as $Rec)

                        <div class="card" style="display: inline">
                            <div class="callout callout-success">
                                <h4>{{$loop->iteration}} Reception</h4>

                                <label for="airport_rec_name">Reception Name (EN)</label>
                                <input type="text" name="" class="form-control my-1" id="airport_rec_name" value="{{$Rec->airport_rec_name}}"  readonly>

                                @if ($errors->has('airport_rec_name'))
                                    <p class="text-danger">{{$errors->first('airport_rec_name')}}</p>
                                @endif

                                <label for="airport_rec_name_ar">Reception Name (AR)</label>
                                <input type="text" name="" class="form-control my-1" id="airport_rec_name_ar" value="{{$Rec->airport_rec_name_ar}}"  readonly>

                                @if ($errors->has('airport_rec_name_ar'))
                                    <p class="text-danger">{{$errors->first('airport_rec_name_ar')}}</p>
                                @endif

                                <label for="airport_rec_price">Reception Price</label>
                                <div class="input-group mb-2">
                                    <input  type="number"  step="0.01" name="airport_rec_price" class="form-control my-1" id="airport_rec_price"  value="{{$Rec->airport_rec_price}}" >
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">SAR</div>
                                    </div>
                                </div>
                                @if ($errors->has('airport_rec_price'))
                                    <p class="text-danger">{{$errors->first('airport_rec_price')}}</p>
                                @endif

                            </div>

                        </div>
                        @endforeach
                @endisset
                @empty($courseReceptions)
                    <p class="text-center">No Receptions yet</p>
                @endempty
            </div>

            <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">
                @isset($courseInsurances)
                @foreach ($courseInsurances as $Ins)

                <div class="card" style="display: inline">
                    <div class="callout callout-success">
                        <h4>{{$loop->iteration}} Reception</h4>

                        <label for="medical_insurance_name">Insurances Name (EN)</label>
                        <input type="text" name="" class="form-control my-1" id="medical_insurance_name" value="{{$Ins->medical_insurance_name}}"  readonly>

                        @if ($errors->has('medical_insurance_name'))
                            <p class="text-danger">{{$errors->first('medical_insurance_name')}}</p>
                        @endif

                        <label for="medical_insurance_name_ar">Insurances Name (AR)</label>
                        <input type="text" name="" class="form-control my-1" id="medical_insurance_name_ar" value="{{$Ins->medical_insurance_name_ar}}"  readonly>

                        @if ($errors->has('medical_insurance_name_ar'))
                            <p class="text-danger">{{$errors->first('medical_insurance_name_ar')}}</p>
                        @endif

                        <label for="medical_insurance_price">Insurances Price</label>
                        <div class="input-group mb-2">
                            <input  type="number"  step="0.01" name="medical_insurance_price" class="form-control my-1" id="medical_insurance_price"  value="{{$Ins->medical_insurance_price}}" >
                            <div class="input-group-prepend">
                                <div class="input-group-text">SAR</div>
                            </div>
                        </div>
                        @if ($errors->has('medical_insurance_price'))
                        <p class="text-danger">{{$errors->first('medical_insurance_price')}}</p>
                        @endif

                    </div>

                </div>
                @endforeach
                @endisset
                @empty($courseInsurances)
                    <p class="text-center">No Insurances yet</p>
                @endempty
            </div>

            <div class="tab-pane fade" id="user-rating" role="tabpanel" aria-labelledby="rates">


                @isset($courseRates)
                    @foreach ($courseRates as $rate)

                    <!-- Post -->
                    <div class="post" >

                        <div class="row">
                            <div class="col-4">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="{{url('storage/images/passports/'.$rate->passport_photo)}}" alt="{{$rate->student_name}}">
                                    <span class="username">
                                        <a href="#">{{$rate->student_name}}</a>
                                        <a href="#" class="float-right btn-tool"></a>
                                    </span>
                                    <span class="description">{{\Illuminate\Support\Carbon::parse($rate->rate_created_at)->diffForHumans()}}</span>

                                </div>
                            </div>
                            <div class="col-8">
                                    @for ($i = 0; $i < $rate->course_rate_value; $i++)
                                    <li class="list-inline-item active" style="color:#ffae00"><i class="fas fa-star"></i></li>
                                    @endfor
                                    @for ($i = 0; $i < 5-$rate->course_rate_value ; $i++)
                                    <li class="list-inline-item"><i class="fas fa-star"></i></li>
                                    @endfor
                            </div>
                        </div>

                        <!-- /.user-block -->

                    </div>
                    <!-- /.post -->

                    @endforeach
                @endisset
                @empty($courseRates)
                    <p>No Rates Yet</p>
                @endempty



            </div>
            <div class="text-right my-3">
                <button type="submit" class="btn btn-outline-success"><b>Save Changes</b></button>
            </div>
          </div>
        </div> --}}


      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </section>
</form>
@endsection
@section('scripts')
<script>

        document.getElementById("img").addEventListener("click", function(){
            document.getElementById("imginput").click();
        });

        function showPhoto() {
        var file = document.getElementById('imginput').files[0];
        console.log(file);
        reader = new FileReader();
        // console.log(reader);
        reader.onloadend = function () {
            document.getElementById('img').setAttribute("src",reader.result);
            // console.log(reader.result);
        };
        reader.readAsDataURL(file);
        }

    </script>
    <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
    <script>
      $(function () {
        // Summernote
        $('.textarea').summernote()
      })
    </script>
@endsection
