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
<form action="{{url('admin/course/'.$courseDetails->course_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-3">
          <h1>Course</h1>
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
            <li class="breadcrumb-item active">Course Details</li>
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
                <h3 class="d-inline-block d-sm-none">{{$courseDetails->course_name}}</h3>
                <div class="col-12">
                    <img src="{{url('storage/images/courses/'.$courseDetails->course_photo)}}" class="product-image" id="img" alt="{{$courseDetails->course_name}}">
                    <input type="file" name="course_photo" id="imginput" style="display: none;" onchange="showPhoto()">
                </div>
                
            </div>
            <div class="col-12 col-sm-6">
                <h3 class="my-3"  style="text-transform: capitalize;" >{{$courseDetails->course_name}}</h3>
                <div class="rate">
                    <ul class="list-inline">
                        @foreach ($courseAvgRates  as $rate)
                            @for ($i = 0; $i < $rate->avg_rate; $i++)
                            <li class="list-inline-item active" style="color:#ffae00"><i class="fas fa-star"></i></li>
                            @endfor
                            @for ($i = 0; $i < 5-$rate->avg_rate ; $i++)
                            <li class="list-inline-item"><i class="fas fa-star"></i></li>
                            @endfor
                        @endforeach
                    </ul>
                </div>


                <table class="table">  
                    <tbody>
                        
                    <tr>
                        <th class="align-middle">Course Name (EN)</th>
                        <td style="text-transform: capitalize;">
                            <input type="text" name="course_name" class="form-control" id="" value="{{$courseDetails->course_name}}" >
                            @if ($errors->has('course_name'))
                                <p class="text-danger">{{$errors->first('course_name')}}</p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle">Course Name (AR)</th>
                        <td style="text-transform: capitalize;">
                            <input type="text" name="course_name_ar" class="form-control" id="" value="{{$courseDetails->course_name_ar}}" >
                            @if ($errors->has('course_name_ar'))
                                <p class="text-danger">{{$errors->first('course_name_ar')}}</p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle">Institute</th>
                        <td style="text-transform: capitalize;">
                            <select name="institute_id" id="" class="form-control">
                                @foreach ($institutes as $inst)
                                    <option value="{{$inst->institute_id}}" {{$inst->institute_id == $courseDetails->institute_id ? 'selected':''}}>{{$inst->institute_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('institute_id'))
                                <p class="text-danger">{{$errors->first('institute_id')}}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">Category</th>
                        <td style="text-transform: capitalize;">
                            <select name="course_type_id" id="" class="form-control">
                                @foreach ($courseTypes as $type)
                                    <option value="{{$type->course_type_id}}" {{$type->course_type_id == $courseDetails->course_type_id ? 'selected':''}}>{{$type->course_type_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('course_type_id'))
                                <p class="text-danger">{{$errors->first('course_type_id')}}</p>
                            @endif
                        </td>
                    </tr>
                    
                    <tr>
                        <th class="align-middle">Weeks</th>
                        <td style="text-transform: capitalize;">
                            <input  type="number"   name="weeks_number" class="form-control" id="" value="{{$courseDetails->weeks_number}}" >
                            @if ($errors->has('weeks_number'))
                                <p class="text-danger">{{$errors->first('weeks_number')}}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">Origin</th>
                    
                        <td style="text-transform: capitalize;">

                            <select name="local_or_global" id="" class="form-control">
                              	<option value="1" {{ 1 ==  $courseDetails->local_or_global ? 'selected' :''}} >International</option>
                                <option value="2" {{ 2 == $courseDetails->local_or_global ? 'selected':''}}>Local</option>
                            </select>
                            @if ($errors->has('local_or_global'))
                                <p class="text-danger">{{$errors->first('local_or_global')}}</p>
                            @endif
                            
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">Course Price</th>
                        <td style="text-transform: capitalize;">
                            <div class="input-group mb-2">
                                <input  type="number"  step="0.01" name="course_price" class="form-control" id="inlineFormInputGroup"  value="{{$courseDetails->course_price}}" >
                                <div class="input-group-prepend">
                                    <div class="input-group-text">SAR</div>
                                </div>
                            </div>
                            @if ($errors->has('course_price'))
                                <p class="text-danger">{{$errors->first('course_price')}}</p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle">Book Fees</th>
                        <td style="text-transform: capitalize;">
                            <div class="input-group mb-2">
                                <input  type="number"  step="0.01" name="book_fees" class="form-control" id="inlineFormInputGroup"  value="{{$courseDetails->book_fees}}" >
                                <div class="input-group-prepend">
                                    <div class="input-group-text">SAR</div>
                                </div>
                            </div>
                            @if ($errors->has('book_fees'))
                                <p class="text-danger">{{$errors->first('book_fees')}}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">Residence Fees</th>
                        <td style="text-transform: capitalize;">
                            <div class="input-group mb-2">
                                <input  type="number"  step="0.01" name="living_fees" class="form-control" id="inlineFormInputGroup"  value="{{$courseDetails->living_fees}}" >
                                <div class="input-group-prepend">
                                    <div class="input-group-text">SAR</div>
                                </div>
                            </div>
                            @if ($errors->has('living_fees'))
                                <p class="text-danger">{{$errors->first('living_fees')}}</p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle">Delivery Charge</th>
                        <td style="text-transform: capitalize;">
                            <div class="input-group mb-2">
                                <input  type="number"  step="0.01" name="mail_fees" class="form-control" id="inlineFormInputGroup"  value="{{$courseDetails->mail_fees}}" >
                                <div class="input-group-prepend">
                                    <div class="input-group-text">SAR</div>
                                </div>
                            </div>
                            @if ($errors->has('mail_fees'))
                                <p class="text-danger">{{$errors->first('mail_fees')}}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">Summer Fees</th>
                        <td style="text-transform: capitalize;">
                            <div class="input-group mb-2">
                                <input  type="number"  step="0.01" name="summer_fees" class="form-control" id="inlineFormInputGroup"  value="{{$courseDetails->summer_fees}}" >
                                <div class="input-group-prepend">
                                    <div class="input-group-text">SAR</div>
                                </div>
                            </div>
                            @if ($errors->has('summer_fees'))
                                <p class="text-danger">{{$errors->first('summer_fees')}}</p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle">Registeration Fees</th>
                        <td style="text-transform: capitalize;">
                            <div class="input-group mb-2">
                                <input  type="number"  step="0.01" name="registration_fees" class="form-control" id="inlineFormInputGroup"  value="{{$courseDetails->registration_fees}}" >
                                <div class="input-group-prepend">
                                    <div class="input-group-text">SAR</div>
                                </div>
                            </div>
                            @if ($errors->has('registration_fees'))
                                <p class="text-danger">{{$errors->first('registration_fees')}}</p>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">VAT</th>
                        <td style="text-transform: capitalize;">
                            <div class="input-group mb-2">
                                <input  type="number"  step="0.01" name="tax_fees" class="form-control" id="inlineFormInputGroup"  value="{{$courseDetails->tax_fees}}">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">SAR</div>
                                </div>
                            </div>
                            @if ($errors->has('tax_fees'))
                                <p class="text-danger">{{$errors->first('tax_fees')}}</p>
                            @endif
                        </td>
                    </tr>

                    {{-- <tr>
                        <th>housing_price</th>
                        <td style="text-transform: capitalize;">{{$courseDetails->housing_price}} SAR</td>
                    </tr>
                    <tr>
                        <th>insurance_price</th>
                        <td style="text-transform: capitalize;">{{$courseDetails->insurance_price}} SAR</td>
                    </tr>

                    <tr>
                        <th>reception_price</th>
                        <td style="text-transform: capitalize;">{{$courseDetails->reception_price}} SAR</td>
                    </tr> --}}
                    <tr >
                        <th class="align-middle">created_at</th>
                    <td style="text-transform: capitalize;">{{$courseDetails->c_created_at}}</td>
                    </tr>
                    </tbody>
                </table>
             
            </div>
        </div>
        <div class="row mt-4">
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
                <textarea  class="form-control" name="course_details" id="course_details" class=" form-control" style="resize: none" rows="5">{{$courseDetails->course_details}}</textarea>
                @if ($errors->has('course_details'))
                    <p class="text-danger">{{$errors->first('course_details')}}</p>
                @endif
                <label for="course_details_ar">Course Details (AR)</label>
                <textarea  class="form-control" name="course_details_ar" id="course_details_ar" class=" form-control" style="resize: none" rows="5">{{$courseDetails->course_details_ar}}</textarea>
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
                                
                                {{-- <label for="airport_rec_name">Reception Name (EN)</label> --}}
                                <input type="hidden" name="" class="form-control my-1" id="airport_rec_name" value="{{$Rec->airport_rec_name}}"  readonly>

                                @if ($errors->has('airport_rec_name'))
                                    <p class="text-danger">{{$errors->first('airport_rec_name')}}</p>
                                @endif

                                {{-- <label for="airport_rec_name_ar">Reception Name (AR)</label> --}}
                                <input type="hidden" name="" class="form-control my-1" id="airport_rec_name_ar" value="{{$Rec->airport_rec_name_ar}}"  readonly>
                                
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
                        
                        {{-- <label for="medical_insurance_name">Insurances Name (EN)</label> --}}
                        <input type="hidden" name="" class="form-control my-1" id="medical_insurance_name" value="{{$Ins->medical_insurance_name}}"  readonly>

                        @if ($errors->has('medical_insurance_name'))
                            <p class="text-danger">{{$errors->first('medical_insurance_name')}}</p>
                        @endif

                        {{-- <label for="medical_insurance_name_ar">Insurances Name (AR)</label> --}}
                        <input type="hidden" name="" class="form-control my-1" id="medical_insurance_name_ar" value="{{$Ins->medical_insurance_name_ar}}"  readonly>
                        
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
    <script src="../../plugins/summernote/summernote-bs4.min.js"></script>
    <script>
      $(function () {
        // Summernote
        $('.textarea').summernote()
      })
    </script>
@endsection
