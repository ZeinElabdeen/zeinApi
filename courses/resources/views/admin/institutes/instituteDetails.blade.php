@extends('admin.layouts.nav')
@section('title','Institute Details')
@section('links')
    <style>
        #img{
            cursor: pointer;
        }
    </style>
@endsection
@section('content')
<form action="{{url('admin/institute/'.$institutes->institute_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-3">
          <h1>Institute</h1>
        </div>
        <div class="col-6">
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
        </div>
        <div class="col-sm-3">
          <ol class="breadcrumb float-sm-right">
            {{-- <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li> --}}
            <li class="breadcrumb-item active">Institute Details</li>
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
            <div class="col-12 col-sm-6">
                <h3 class="d-inline-block d-sm-none">{{$institutes->institute_name}}</h3>
                <div class="col-12">
                    <img src="{{url('storage/images/institutes/'.$institutes->institutes_photo)}}" class="product-image" id="img" alt="{{$institutes->institute_name}}">
                    <input type="file" name="institutes_photo" id="imginput" style="display: none;" onchange="showPhoto()">
                    @if ($errors->has('institutes_photo'))
                        <p class='text-danger'>{{$errors->first('institutes_photo')}}</p>
                    @endif
                </div>

            </div>
            <div class="col-12 col-sm-6">
                <h3 class="my-3"  style="text-transform: capitalize;" >{{$institutes->institute_name}}</h3>
                <div class="rate">
                    <ul class="list-inline">
                        @foreach ($Instrate  as $rate)
                            @for ($i = 0; $i < $rate->avg_rate_i; $i++)
                            <li class="list-inline-item active" style="color:#ffae00"><i class="fas fa-star"></i></li>
                            @endfor
                            @for ($i = 0; $i < 5-$rate->avg_rate_i ; $i++)
                            <li class="list-inline-item"><i class="fas fa-star"></i></li>
                            @endfor
                        @endforeach
                    </ul>
                </div>


                <table class="table">
                    <tbody>

                    <tr>
                        <th class="align-middle">Institute Name (EN)</th>
                        <td style="text-transform: capitalize;">
                            <input type="text" name="institute_name" class="form-control" id="" value="{{$institutes->institute_name}}" >
                            @if ($errors->has('institute_name'))
                                <p class='text-danger'>{{$errors->first('institute_name')}}</p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle">Institute Name (AR)</th>
                        <td style="text-transform: capitalize;">
                            <input type="text" name="institute_name_ar" class="form-control" id="" value="{{$institutes->institute_name_ar}}" >
                            @if ($errors->has('institute_name_ar'))
                                <p class='text-danger'>{{$errors->first('institute_name_ar')}}</p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle">Institute Email </th>
                        <td style="text-transform: capitalize;">
                            <input type="text" name="institute_email" class="form-control" id="" value="{{$institutes->institute_email}}" min="1">
                            @if ($errors->has('institute_email'))
                                <p class='text-danger'>{{$errors->first('institute_email')}}</p>
                            @endif
                        </td>
                    </tr>

                    
                    </tbody>
                </table>

            </div>
        </div>
        <div class="row mt-4">
          <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
              <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Description</a>
              <a class="nav-item nav-link" id="courses-tab" data-toggle="tab" href="#courses" role="tab" aria-controls="courses" aria-selected="false">Courses</a>
              <a class="nav-item nav-link" id="courseOnline-tab" data-toggle="tab" href="#courseOnline" role="tab" aria-controls="courseOnline" aria-selected="false">Courses Online</a>
              <a class="nav-item nav-link" id="location-tab" data-toggle="tab" href="#location" role="tab" aria-controls="location" aria-selected="false">Location</a>
              <a class="nav-item nav-link" id="rates" data-toggle="tab" href="#user-rating" role="tab" aria-controls="user-rating" aria-selected="false">Rates</a>
            </div>
          </nav>
          <div class="tab-content p-3 w-100" id="nav-tabContent">

            <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                <div>
                    <label for="">Details (EN)</label>
                    <textarea name="institute_details" id="" class=" form-control" style="resize: none" rows="5">{{$institutes->institute_details}}</textarea>
                    @if ($errors->has('institute_details'))
                        <p class='text-danger'>{{$errors->first('institute_details')}}</p>
                    @endif
                </div>
                <div>
                    <label for="">Details (AR)</label>
                    <textarea name="institute_details_ar" id="" style="direction:rtl" class=" form-control" style="resize: none" rows="5">{{$institutes->institute_details_ar}}</textarea>
                    @if ($errors->has('institute_details_ar'))
                        <p class='text-danger'>{{$errors->first('institute_details_ar')}}</p>
                    @endif
                </div>
            </div>

             <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                 <div class="row ">
                    @isset($instCourse)
                        @foreach ($instCourse as $inst)
                            <div class="col-5 mx-1 ">
                                <div class="callout callout-success py-1 borderd">
                                    <h4>{{$loop->iteration}} Courses</h4>
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="living_name">Course Name (EN)</label>
                                            <input type="text" name="course_name[]" class="form-control my-1" id="living_name" value="{{$inst->course_name}}" min="1" readonly>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="living_name_ar">Course Name (AR)</label>
                                            <input type="text" name="course_name_ar[]" class="form-control my-1" id="living_name_ar" value="{{$inst->course_name_ar}}" min="1" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="inlineFormInputGroup">Course Details (EN)</label>
                                        <textarea name="course_details[]" id="" cols="50" rows="5" disabled>{{$inst->course_details}}</textarea>
                                    </div>
                                    <div class="form-group col-12">
                                        <label for="inlineFormInputGroup">Course Details (AR)</label >
                                        <textarea name="course_details_ar[]" id="" cols="50" rows="5" disabled>{{$inst->course_details_ar}}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                    @empty($instCourse)
                        <p class="text-center">No courses yet</p>
                    @endempty
                </div>



            </div>

            <div class="tab-pane fade" id="courseOnline" role="tabpanel" aria-labelledby="courseOnline-tab">
                <div class="row">
                    <div class="col-5 mx-1 ">
                        @isset($onlineCourse)
                        @foreach ($onlineCourse as $on)

                        <div class="card" style="display: inline">
                            <div class="callout callout-success">
                                <h4>{{$loop->iteration}} online Course</h4>
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="airport_rec_name">Course Name (EN)</label>
                                        <input type="text" name="" class="form-control my-1" id="airport_rec_name" value="{{$on->online_course_name}}" min="1" readonly>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="airport_rec_name_ar">Course Name (AR)</label>
                                        <input type="text" name="" class="form-control my-1" id="airport_rec_name_ar" style="direction:rtl" value="{{$on->online_course_name_ar}}" min="1" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group ">
                                            <label for="airport_rec_name" >Course Details (EN)</label>
                                            <textarea name="online_course_details" id="" cols="65" rows="7" disabled>{{$on->online_course_details}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group ">
                                            <label for="airport_rec_name" >Course Details (AR)</label>
                                            <textarea name="online_course_details_ar" id="" style="direction:rtl" cols="65" rows="7" disabled>{{$on->online_course_details_ar}}</textarea>
                                        </div>
                                    </div>
                                   
                                    
                                    <div class="col-12 ">
                                        <label for="">Course Link: </label>&nbsp;
                                        <a href="{{$on->online_course_link}}" class="text-info">{{$on->online_course_link}}</a>
                                    </div>
                                </div>
                                
                            </div>

                        </div>
                        @endforeach
                @endisset
                @empty($onlineCourse)
                    <p class="text-center">No Online Course yet</p>
                @endempty
                    </div>
                </div>
               
            </div>

            <div class="tab-pane fade" id="location" role="tabpanel" aria-labelledby="location-tab">
                {{-- @foreach ($institutes as $Ins) --}}

                <div class="card" style="display: inline">
                    <div class="callout callout-success">
                        <div class="row">
                            <div class="col-6">
                                <label>Select City</label>
                                <select class="form-control @error('city_id') is-invalid @enderror" name="city_id">
                                    @foreach ($cities as $c)
                                    <option value="{{ $c->city_id }}" {{ $c->city_id == $institutes->city_id ? 'selected' : ''}}>{{ $c->city_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('city_id'))
                                <p class='text-danger'>{{$errors->first('city_id')}}</p>
                                @endif
                            </div>
                            <div class="col-6">
                                <label>Select Country</label>
                                <select class="form-control @error('location_id') is-invalid @enderror" name="location_id">
                                    @foreach ($location as $country)
                                    <option value="{{ $country->location_id }}" {{ $country->location_id == $institutes->location_id ? 'selected' : ''}}>{{ $country->country }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('location_id'))
                                <p class='text-danger'>{{$errors->first('location_id')}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- @endforeach --}}
                
            </div>

            <div class="tab-pane fade" id="user-rating" role="tabpanel" aria-labelledby="rates">


                @isset($rateUser)
                    @foreach ($rateUser as $rate)

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
                                    @for ($i = 0; $i < $rate->institute_rate_value; $i++)
                                    <li class="list-inline-item active" style="color:#ffae00"><i class="fas fa-star"></i></li>
                                    @endfor
                                    @for ($i = 0; $i < 5-$rate->institute_rate_value ; $i++)
                                    <li class="list-inline-item"><i class="fas fa-star"></i></li>
                                    @endfor
                            </div>
                        </div>

                        <!-- /.user-block -->

                    </div>
                    <!-- /.post -->

                    @endforeach
                @endisset
                @empty($rateUser)
                    <p>No Rates Yet</p>
                @endempty



            </div>
            <div class="text-right my-3">
                <button type="submit" class="btn btn-outline-success"><b>Save Changes</b></button>
            </div>
          </div>
        </div>
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
@endsection
