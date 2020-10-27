
@extends('dashboard.layouts.app')

<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            <li><a> عرض البيانات </a></li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title mb-3"> بيانات {{$data->username}}</div>
                </div>
                <div class="card-body">
                    <form>
                        @csrf
                        <div class="row">

                          <div class="col-md-12">

                              <div class="avatar-upload">
                                  <div class="avatar-preview">
                                      <div id="imagePreview" style="background-image: url({{config('driver_storage').$data->image}});">
                                      </div>
                                  </div>
                              </div>
                          </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="username">الإسم</label>
                                <input type="text" class="form-control" name="username" id="username" readonly value="{{$data->username}}" autocomplete="off">
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="phone">رقم الجوال</label>
                                <input type="text" class="form-control" name="phone" id="phone" value="{{$data->phone}}" readonly >
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="email">البريد الالكتروني</label>
                                <input type="text" class="form-control" name="email" id="email" value="{{$data->email}}" readonly >
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="id_number">رقم الهوية</label>
                                <input type="text" class="form-control" name="id_number" id="id_number" value="{{$data->id_number}}" readonly >
                            </div>

                            <div class="col-md-2 form-group mb-3">
                                <label for="gender">الجنس</label>
                                <input type="text" class="form-control" name="gender" id="gender" value="{{$genders[$data->gender]}}" readonly >
                            </div>

                            <div class="col-md-2 form-group mb-3">
                                <label for="service"> نوع الخدمة </label>
                                <input type="text" class="form-control" name="service" id="service" value="{{$services[$data->service]}}" readonly >
                            </div>

                            <div class="col-md-2 form-group mb-3">
                                <label for="wallet">رصيد المحفظة</label>
                                <input type="text" class="form-control" name="wallet" id="wallet" value="{{$data->wallet}}" readonly >
                            </div>

                            <div class="col-md-2 form-group mb-3">
                                <label for="rate"> التقيم </label>
                                <input type="text" class="form-control" name="rate" id="rate" value="{{$data->rate}}" readonly >
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="car_model"> موديل السيارة </label>
                                <input type="text" class="form-control" id="car_model" value="{{$data->car_model->title_ar}}" readonly >
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="car_type">نوع السيارة </label>
                                <input type="text" class="form-control" id="car_type" value="{{$data->car_type->title_ar}}" readonly >
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="car_color"> لون السيارة  </label>
                                <input type="text" class="form-control" id="car_color" value="{{$data->car_color}}" readonly >
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <div class="avatar-upload" style="text-align: left;margin: 30px;">
                                  <label for="id_image"> صورة الهوية </label>
                                  </br>
                                  <span>اضغط للعرض</span>
                                  <a href="{{config('driver_storage').$data->id_image}}" target="_blank" >
                                    <div class="avatar-preview" style="width: 350px; height: 200px;border: dotted;border-radius: 10%;border-color: rebeccapurple;" >
                                        <div id="imagePreview" style="background-image: url({{config('driver_storage').$data->id_image}});border-radius: 10%;">
                                        </div>
                                    </div>
                                   <a>
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <div class="avatar-upload" style="text-align: left;margin: 30px;">
                                  <label for="car_form_image"> صورة أستمارة السيارة </label>
                                  </br>
                                  <span>اضغط للعرض</span>
                                  <a href="{{config('driver_storage').$data->car_form_image}}" target="_blank" >
                                    <div class="avatar-preview" style="width: 350px; height: 200px;border: dotted;border-radius: 10%;border-color: rebeccapurple;" >
                                        <div id="imagePreview" style="background-image: url({{config('driver_storage').$data->car_form_image}});border-radius: 10%;">
                                        </div>
                                    </div> <a>
                                </div>
                            </div>



                            <div class="col-md-6 form-group mb-4">
                                <div class="avatar-upload" style="text-align: left;margin: 30px;">
                                  <label for="car_front_image"> صورة أمامية للسيارة</label>
                                  </br>
                                  <span>اضغط للعرض</span>
                                  <a href="{{config('driver_storage').$data->car_front_image}}" target="_blank" >
                                    <div class="avatar-preview" style="width: 350px; height: 200px;border: dotted;border-radius: 10%;border-color: rebeccapurple;" >
                                        <div id="imagePreview" style="background-image: url({{config('driver_storage').$data->car_front_image}});border-radius: 10%;">
                                        </div>
                                    </div>
                                   <a>
                                </div>
                            </div>

                            <div class="col-md-4 form-group mb-4">
                                <div class="avatar-upload" style="text-align: left;margin: 30px;">
                                  <label for="car_back_image"> صورة خلفية للسيارة</label>
                                  </br>
                                  <span>اضغط للعرض</span>
                                  <a href="{{config('driver_storage').$data->car_back_image}}" target="_blank" >
                                    <div class="avatar-preview" style="width: 350px; height: 200px;border: dotted;border-radius: 10%;border-color: rebeccapurple;" >
                                        <div id="imagePreview" style="background-image: url({{config('driver_storage').$data->car_back_image}});border-radius: 10%;">
                                        </div>
                                    </div>
                                   <a>
                                </div>
                            </div>

                            <div class="col-md-6 form-group mb-4">
                                <div class="avatar-upload" style="text-align: left;margin: 30px;">
                                  <label for="driving_license_image"> صورة الرخصة </label>
                                  </br>
                                  <span>اضغط للعرض</span>
                                  <a href="{{config('driver_storage').$data->driving_license_image}}" target="_blank" >
                                    <div class="avatar-preview" style="width: 350px; height: 200px;border: dotted;border-radius: 10%;border-color: rebeccapurple;" >
                                        <div id="imagePreview" style="background-image: url({{config('driver_storage').$data->driving_license_image}});border-radius: 10%;">
                                        </div>
                                    </div>
                                   <a>
                                </div>
                            </div>



                            <div class="col-md-12 form-group mb-4" id="status_div">
                              <label for="status">حالة الحساب </label>
                              @if($data->status == '1')
                                    <a  href="{{url('dashboard/vendors/suspend/'.$data->id)}}"  id="status" class="badge badge-success status-btn" style="width:80px;height: 25px;padding:auto;margin:auto;
                                      padding-top: 7px; font-size: small">نشط
                                    </a>
                              @else
                                    <a  href="{{url('dashboard/vendors/activate/'.$data->id)}}"  id="status" class="badge badge-danger status-btn" style="width:80px;height: 25px;padding:auto;margin:auto;
                                      padding-top: 7px; font-size: small">غير نشط
                                    </a>

                              @endif
                            </div>






                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection
<!-- ============ Body content End ============= -->
@section('js')
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="{{asset('assets')}}/js/image.js"></script>
    <script>

    $("#status_div").on('click', '.status-btn', function () {
        var id = $(this).attr('id');
        var r = confirm("هل انت متاكد من تغيير الحالة");
        if (!r) {
            return false
        }
    });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });

    </script>
    <script>
        $("#form").validate({
            // Specify the validation rules
            rules: {
                name: {
                    required: true,
                    alpha: true
                },
                url: {
                    required: true,
                    url:true,
                },

            },
            // Specify the validation error messages
            messages: {
                name: {
                    required: 'يرجى إدخال اسم الموقع ',
                    alpha: 'يجب ان يتكون اسم الموقع من حروف فقط ',
                },
                url: {
                    required: 'يرجى إدخال رابط الموقع  ',
                    url:'برجاء ادخال رابط صحيح',
                },
            },
            submitHandler: function (form) {
                form.submit();
            },
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                $(element).closest('.form-group').find('.glyphicon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                $(element).closest('.form-group').find('.glyphicon').removeClass('glyphicon-remove').addClass('glyphicon-ok');
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.closest('.form-group').find('.cke').length) {
                    error.appendTo(element.closest('.form-group'));
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>

@endsection
