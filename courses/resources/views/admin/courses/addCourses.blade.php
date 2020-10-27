@extends('admin.layouts.nav')
@section('title','add student')
@section('links')
    <script src="{{url("adminAssests/plugins/jquery/jquery.min.js")}}"></script>

@endsection
@section('content')
<section class="content my-2">
    <div class="container-fluid">
        <div class="row">
        <!-- left column -->
            <div class="col-md-8 mx-auto">
                <div class="form-group text-center">
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
                <!-- general form elements -->
                <div class="card card-primary">
                <form role="form" method="POST" action="{{ url('admin/course') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-header">
                        <nav class="w-100">
                            <div class="nav nav-tabs" id="product-tab" role="tablist">
                              <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">
                                  Basic Data 
                                    @if ($errors->has('course_name') || $errors->has('course_name_ar') || $errors->has('weeks_number') || $errors->has('course_price') || $errors->has('local_or_global') || $errors->has('course_type_id') || $errors->has('institute_id'))
                                    <i class="fas fa-exclamation-triangle text-danger"></i>
                                    @endif
                                  
                                </a>
                              <a class="nav-item nav-link" id="details" data-toggle="tab" href="#course-details" role="tab" aria-controls="course-details" aria-selected="false">
                                  Details 
                                  @if ($errors->has('course_details') || $errors->has('course_details') )
                                  <i class="fas fa-exclamation-triangle text-danger"></i>
                                  @endif
                                </a>
                              <a class="nav-item nav-link" id="living-tab" data-toggle="tab" href="#living" role="tab" aria-controls="living" aria-selected="false">
                                  Fees 
                                  @if ($errors->has('book_fees') || $errors->has('living_fees') || $errors->has('mail_fees') || $errors->has('registration_fees') || $errors->has('summer_fees') || $errors->has('tax_fees'))
                                  <i class="fas fa-exclamation-triangle text-danger"></i>
                                  @endif
                                </a>
                              <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">
                                  Residence 
                                  @if ($errors->has('living_name') || $errors->has('living_name_ar') || $errors->has('living_price') )
                                  <i class="fas fa-exclamation-triangle text-danger"></i>
                                  @endif
                                </a>
                              <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">
                                  Insurances 
                                  @if ($errors->has('medical_insurance_name') || $errors->has('medical_insurance_name_ar') || $errors->has('medical_insurance_price') )
                                  <i class="fas fa-exclamation-triangle text-danger"></i>
                                  @endif
                                </a>
                              <a class="nav-item nav-link" id="rates" data-toggle="tab" href="#user-rating" role="tab" aria-controls="user-rating" aria-selected="false">
                                  Reception 
                                  @if ($errors->has('airport_rec_name') || $errors->has('airport_rec_name_ar') || $errors->has('airport_rec_price') )
                                  <i class="fas fa-exclamation-triangle text-danger"></i>
                                  @endif
                                </a>
                              <a class="nav-item nav-link" id="photo" data-toggle="tab" href="#course-photo" role="tab" aria-controls="course-photo" aria-selected="false">
                                  Upload 
                                  @if ($errors->has('course_photo') )
                                  <i class="fas fa-exclamation-triangle text-danger"></i>
                                  @endif
                                </a>

                            </div>
                          </nav>
                    </div>




                    <div class="row mt-4">
                        
                        <div class="tab-content p-3 w-100" id="nav-tabContent">
              
                          <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">
                                
                            
                            
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Course Name (EN)</label>
                                    <input type="text" class="form-control @error('course_name') is-invalid @enderror"  name="course_name" value="{{old('course_name')}}">
                                    @if ($errors->has('course_name'))
                                    <p class='text-danger'>{{$errors->first('course_name')}}</p>
                                    @endif
                                </div>

                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Course Name (AR)</label>
                                    <input type="text" class="form-control @error('course_name_ar') is-invalid @enderror"  name="course_name_ar" value="{{old('course_name_ar')}}">
                                    @if ($errors->has('course_name_ar'))
                                    <p class='text-danger'>{{$errors->first('course_name_ar')}}</p>
                                    @endif
                                </div>
                                
        
        
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Weeks</label>
                                            <input type="number" class="form-control @error('weeks_number') is-invalid @enderror"  name="weeks_number" value="{{old('weeks_number')}}">
                                            @if ($errors->has('weeks_number'))
                                            <p class='text-danger'>{{$errors->first('weeks_number')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Price</label>
                                            <input type="number" class="form-control @error('course_price') is-invalid @enderror"  name="course_price" value="{{old('course_price')}}">
                                            @if ($errors->has('course_price'))
                                            <p class='text-danger'>{{$errors->first('course_price')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Origin</label>

                                            <select name="local_or_global" id="" class="form-control">
                                                <option value="1" {{ 1 ==  old('local_or_global') ? 'selected' :''}}>International</option>
                                                <option value="2" {{ 2 ==  old('local_or_global') ? 'selected' :''}}>Local</option>
                                            </select>
                                            @if ($errors->has('local_or_global'))
                                                <p class="text-danger">{{$errors->first('local_or_global')}}</p>
                                            @endif

                                        </div>
                                    </div>
                                </div>
        
        
        
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Category</label>
                                            <select name="course_type_id" id="" class="form-control">
                                                @foreach ($courseTypes as $type)
                                                    <option value="{{$type->course_type_id}}" {{ $type->course_type_id ==  old('local_or_global') ? 'selected' :''}}>{{$type->course_type_name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('course_type_id'))
                                                <p class="text-danger">{{$errors->first('course_type_id')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Institute</label>
                                            <select name="institute_id" id="" class="form-control">
                                                @foreach ($institutes as $inst)
                                                    <option value="{{$inst->institute_id}}" {{ $type->course_type_id ==  old('local_or_global') ? 'selected' :''}}>{{$inst->institute_name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('institute_id'))
                                                <p class="text-danger">{{$errors->first('institute_id')}}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                 
                        </div>
              
                           <div class="tab-pane fade " id="living" role="tabpanel" aria-labelledby="living-tab"> 
                           

                            <tr>
                                <label class="align-middle">Book Fees</label>
                                <td style="text-transform: capitalize;">
                                    <div class="input-group mb-2">
                                        <input  type="number"  step="0.01" name="book_fees" class="form-control  @error('book_fees') is-invalid @enderror" id="inlineFormInputGroup"  value="{{old('book_fees')}}">
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
                                <label class="align-middle">Residence Fees</label>
                                <td style="text-transform: capitalize;">
                                    <div class="input-group mb-2">
                                        <input  type="number"  step="0.01" name="living_fees" class="form-control  @error('living_fees') is-invalid @enderror" id="inlineFormInputGroup" value="{{old('living_fees')}}">
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
                                <label class="align-middle">Delivery Charge</label>
                                <td style="text-transform: capitalize;">
                                    <div class="input-group mb-2">
                                        <input  type="number"  step="0.01" name="mail_fees" class="form-control @error('mail_fees') is-invalid @enderror" id="inlineFormInputGroup"   value="{{old('mail_fees')}}">
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
                                <label class="align-middle">Summer Fees</label>
                                <td style="text-transform: capitalize;">
                                    <div class="input-group mb-2">
                                        <input  type="number"  step="0.01" name="summer_fees" class="form-control @error('summer_fees') is-invalid @enderror" id="inlineFormInputGroup"   value="{{old('summer_fees')}}">
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
                                <label class="align-middle">Registeration Fees</label>
                                <td style="text-transform: capitalize;">
                                    <div class="input-group mb-2">
                                        <input  type="number"  step="0.01" name="registration_fees" class="form-control @error('registration_fees') is-invalid @enderror" id="inlineFormInputGroup"   value="{{old('registration_fees')}}">
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
                                <label class="align-middle">VAT</label>
                                <td style="text-transform: capitalize;">
                                    <div class="input-group mb-2">
                                        <input  type="number"  step="0.01" name="tax_fees" class="form-control @error('tax_fees') is-invalid @enderror" id="inlineFormInputGroup" value="{{old('tax_fees')}}">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">SAR</div>
                                        </div>
                                    </div>
                                    <small><strong>Ex: </strong> 0.14 , 0.3 </small>
                                    @if ($errors->has('tax_fees'))
                                        <p class="text-danger">{{$errors->first('tax_fees')}}</p>
                                    @endif
                                </td>
                            </tr>

                              
                          </div>
              
                          <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                            <div class="text-left">
                                <div class="form-group form-check">
                                    {{-- <label class="form-check-label" for="exampleCheck1"></label> --}}
                                   
                                    <div class="pl-2 alert alert-dark" id="alertRes" >

                                        <input type="checkbox" class="" id="checkboxRes" name="isResidence" value="1"  checked>

                                       <b>There is no residence </b> 
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            <div class="callout callout-success py-1 borderd">
                                <h4> Residence</h4>


                                <label for="living_name">Residence Name (EN)</label>
                                <input type="text" name="living_name[]" class="form-control my-1 " id="living_name"  value="">
                                
                                @if ($errors->has('living_name[]'))
                                    <p class="text-danger">{{$errors->first('living_name')}}</p>
                                @endif
                                
                                <label for="living_name_ar">Residence Name (AR)</label>
                                <input type="text" name="living_name_ar[]" class="form-control my-1 " id="living_name_ar" value="">
                                
                                @if ($errors->has('living_name_ar[]'))
                                    <p class="text-danger">{{$errors->first('living_name_ar')}}</p>
                                @endif

                                <label for="inlineFormInputGroup">Residence Price</label>
                                <div class="input-group mb-2">
                                    <input  type="number"  step="0.01" name="living_price[]" class="form-control my-1 " id="inlineFormInputGroup"   value="">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">SAR</div>
                                    </div>
                                </div>
                                @if ($errors->has('living_price[]'))
                                <p class="text-danger">{{$errors->first('living_price[]')}}</p>
                                @endif

                                {{-- @foreach ($errors->all() as $e)
                                    <p class="text-danger">{{$e}}</p>
                                @endforeach --}}

                            </div>
                            
                            <div id="dynamic">

                            </div>
                            <div class="text-left">
                                <div class="btn btn-dark" onclick="addLiving()" style="cursor:pointer">Add anthor Residence</div>
                            </div>
                            
                            
                            

                          </div>
              
                          <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab"> 
                                <div class="callout callout-success">
                                    <h4></h4>
                                    
                                    {{-- <label for="medical_insurance_name">Insurances Name (EN)</label> --}}
                                    <input type="hidden" name="medical_insurance_name" class="form-control my-1" id="medical_insurance_name" value="i want medical insurance"  readonly>
            
                                    @if ($errors->has('medical_insurance_name'))
                                        <p class="text-danger">{{$errors->first('medical_insurance_name')}}</p>
                                    @endif
            
                                    {{-- <label for="medical_insurance_name_ar">Insurances Name (AR)</label> --}}
                                    <input type="hidden" name="medical_insurance_name_ar" class="form-control my-1" id="medical_insurance_name_ar" value="اريد تامين طبي"  readonly>
                                    
                                    @if ($errors->has('medical_insurance_name_ar'))
                                        <p class="text-danger">{{$errors->first('medical_insurance_name_ar')}}</p>
                                    @endif
            
                                    <label for="medical_insurance_price">Insurances Price</label>
                                    <div class="input-group mb-2">
                                        <input  type="number"  step="0.01" name="medical_insurance_price" class="form-control my-1 @error('medical_insurance_price') is-invalid @enderror" id="medical_insurance_price" value="{{old('medical_insurance_price')}}">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">SAR</div>
                                        </div>
                                    </div>
                                    @if ($errors->has('medical_insurance_price'))
                                    <p class="text-danger">{{$errors->first('medical_insurance_price')}}</p>
                                    @endif
            
            
                                </div>
                          </div>
              
                          <div class="tab-pane fade" id="user-rating" role="tabpanel" aria-labelledby="rates">
              
                             
                            <div class="callout callout-success">
                                <h4></h4>
                                
                                {{-- <label for="airport_rec_name">Reception Name (EN)</label> --}}
                                <input type="hidden" name="airport_rec_name" class="form-control my-1" id="airport_rec_name" value="i want airport reception"   readonly>
        
                                @if ($errors->has('airport_rec_name'))
                                    <p class="text-danger">{{$errors->first('airport_rec_name')}}</p>
                                @endif
        
                                {{-- <label for="airport_rec_name_ar">Reception Name (AR)</label> --}}
                                <input type="hidden" name="airport_rec_name_ar" class="form-control my-1" id="airport_rec_name_ar" value="اريد استقبال في المطار"  readonly>
                                
                                @if ($errors->has('airport_rec_name_ar'))
                                    <p class="text-danger">{{$errors->first('airport_rec_name_ar')}}</p>
                                @endif
        
                                <label for="airport_rec_price">Reception Price</label>
                                <div class="input-group mb-2">
                                    <input  type="number"  step="0.01" name="airport_rec_price" class="form-control my-1 @error('airport_rec_price') is-invalid @enderror" id="airport_rec_price" value="{{old('airport_rec_price')}}">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">SAR</div>
                                    </div>
                                </div>
                                @if ($errors->has('airport_rec_price'))
                                <p class="text-danger">{{$errors->first('airport_rec_price')}}</p>
                                @endif
        
                            </div>
                           

                             
                          </div>

                            <div class="tab-pane fade" id="course-photo" role="tabpanel" aria-labelledby="photo">
                                <img id="img" class="w-100" src="{{url('storage/images/courses/default.jpg')}}" alt="course_photo" style="cursor:pointer">
                                <input type="file" name="course_photo" id="imginput" onchange="showPhoto()" style="display:none">
                                @if ($errors->has('course_photo'))
                                <p class="text-danger">{{$errors->first('course_photo')}}</p>
                                @endif
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="course-details" role="tabpanel" aria-labelledby="details">
                                <label for="course_details">Course Details (EN)</label>
                                <textarea   name="course_details" id="course_details" class=" form-control @error('course_details') is-invalid @enderror" style="resize: none" rows="5">{{old('course_details')}}</textarea>
                                @if ($errors->has('course_details'))
                                    <p class="text-danger">{{$errors->first('course_details')}}</p>
                                @endif
                                <label for="course_details_ar">Course Details (AR)</label>
                                <textarea   name="course_details_ar" id="course_details_ar" class=" form-control @error('course_details_ar') is-invalid @enderror" style="resize: none" rows="5">{{old('course_details_ar')}}</textarea>
                                @if ($errors->has('course_details_ar'))
                                    <p class="text-danger">{{$errors->first('course_details_ar')}}</p>
                                @endif
                            </div>
                        </div>
                      </div>






                    <!-- /.card-header -->
                    <!-- form start -->
                    

                    
                    </form>
                </div>
                <!-- /.card -->
            </div>

      </div>
    </div>
</section>
@section('scripts')
<script>

    // institute upload photo function
        // document.getElementById("clik").addEventListener("click", function(){
        // document.getElementById("imginput").click();
        // });
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
<script>
    function addLiving() { 
        var data = '<div class="callout callout-success py-1 borderd">'+'<h4> Residence</h4>'+
        '<label for="living_name">Residence Name (EN)</label>'+
        '<input type="text" name="living_name[]" class="form-control my-1" id="living_name"  >'+
        '<label for="living_name_ar">Residence Name (AR)</label>'+
        '<input type="text" name="living_name_ar[]" class="form-control my-1" id="living_name_ar" >'+
        '<label for="inlineFormInputGroup">Residence Price</label>'+
        '<div class="input-group mb-2">'+
        '<input  type="number"  step="0.01" name="living_price[]" class="form-control my-1" id="inlineFormInputGroup"   >'+
        '<div class="input-group-prepend">'+
        '<div class="input-group-text">SAR</div>'+
        '</div>'+' </div>'+'</div>';
            
        
        document.getElementById('dynamic').innerHTML += data;
     }
</script>
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
@endsection
