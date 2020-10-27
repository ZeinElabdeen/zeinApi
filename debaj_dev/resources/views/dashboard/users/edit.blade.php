
@extends('dashboard.layouts.app')

<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            <li><a> تعديل مستخدم</a></li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title mb-3"> تعديل {{$data->username}}</div>
                </div>
                <div class="card-body">
                    <form id="change-pwd" action="{{url('dashboard/users/update')}}"  method="post">
                        <input type="hidden" hidden  required name="id" value="{{$data->id}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 form-group mb-3">
                                <label for="full_name">الإسم كامل</label>
                                <input type="text" class="form-control"  name="full_name" id="full_name" placeholder="الإسم بالكامل" value="{{$data->full_name}}" >
                                @if ($errors->has('full_name'))
                                    <span class="text-danger" role="alert">
                                        <strong>الإسم كامل مطلوب</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-4 form-group mb-3">
                                <label for="username">اسم الدخول</label>
                                <input type="text" class="form-control"  name="username" id="username" placeholder="اسم الدخول" value="{{$data->username}}" autocomplete="off" >
                                @if ($errors->has('username'))
                                    <span class="text-danger" role="alert">
                                        <strong>اسم الدخول</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="email">البريد الإلكتروني</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="البريد الإلكتروني"  value="{{$data->email}}" autocomplete="off" >
                                @if ($errors->has('email'))
                                    <span class="text-danger" role="alert">
                                        <strong>البريد الإلكتروني مطلوب</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="phone">رقم الجوال</label>
                                <input type="number" class="form-control" name="phone" id="phone" value="{{$data->phone}}" placeholder="رقم الجوال " >
                                @if ($errors->has('phone'))
                                    <span class="text-danger" role="alert">
                                        <strong>رقم الجوال مطلوب ويجب أن يكون صحيح</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="address">العنوان</label>
                                <input type="text" class="form-control" name="address" id="address" value="{{$data->address}}" placeholder="العنوان" >
                                @if ($errors->has('address'))
                                    <span class="text-danger" role="alert">
                                        <strong>العنوان مطلوب</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="col-md-6 form-group mb-3">
                                <label for="password">كلمة المرور</label>
                                <input type="password" class="form-control" autocomplete="off" name="password" id="password" placeholder="كلمة المرور ">
                                @if ($errors->has('password'))
                                    <span class="text-danger" role="alert">
                                        <strong>كلمه المرور مطلوبه ويجب ان لا تقل عن 8 حروف او ارقام</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="password_confirmation">تأكيد كلمة المرور</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="تأكيد كلمة المرور ">
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger" role="alert">
                                        <strong>يجب تأكيد كلمة المرور</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary">حفظ</button>
                            </div>
                        </div>
                    </form>
                  <hr/>
                    @if($data->status == '1')
                        <div style="text-align: left;"><a  href="{{url('dashboard/users/suspend/'.$data->id)}}"  id="status_chang" class="badge badge-success status-btn" style="width:80px;height: 25px;padding:auto;margin:auto;
                            padding-top: 7px; font-size: small">نشط</a></div>
                    @else
                        <div style="text-align: left;"><a  href="{{url('dashboard/users/suspend/'.$data->id)}}" id="status_chang"  class="badge badge-danger status-btn" style="width:80px;height: 25px;padding:auto;margin:auto;
                            padding-top: 7px; font-size: small">غير نشط</a></div>
                    @endif
                </div>
            </div>
        </div>
    </div>


@endsection
<!-- ============ Body content End ============= -->
@section('js')
<script>
    $(document).ready(function() {

      //  $("#status_chang").on('click', '.status-btn', function () {
          $("#status_chang").click(function(){
            var id = $(this).attr('id');
            var r = confirm("هل انت متاكد من تغير فعالية العميل؟\n قبل الموافقه تاكد من حفظ التغيرات!");
            if (!r) {
                return false
            }
        });
      });
</script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
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
