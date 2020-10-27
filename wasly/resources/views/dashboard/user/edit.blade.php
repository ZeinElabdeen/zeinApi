
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
                  @include('dashboard.layouts.message')
                <div class="card-body">
                    <form id="change-pwd" action="{{url('dashboard/user/update')}}" method="post">
                        <input type="hidden" hidden readonly required name="id" value="{{$data->id}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 form-group mb-3">
                                <label for="username">الإسم الاول</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="الإسم الاول" value="{{$data->first_name}}" autocomplete="off">
                                @if ($errors->has('first_name'))
                                    <span class="text-danger" role="alert">
                                        <strong>الإسم مطلوب</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="username">الإسم الاخير</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="الإسم الاخير" value="{{$data->last_name}}" autocomplete="off">
                                @if ($errors->has('last_name'))
                                    <span class="text-danger" role="alert">
                                        <strong>الإسم مطلوب</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="col-md-4 form-group mb-3">
                                <label for="phone">رقم الجوال</label>
                                <input type="number" class="form-control" name="phone" id="phone" value="{{$data->phone}}" placeholder="رقم الجوال ">
                                @if ($errors->has('phone'))
                                    <span class="text-danger" role="alert">
                                        <strong>رقم الجوال مطلوب ويجب أن يكون صحيح</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="password">كلمة المرور</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="كلمة المرور ">
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

                </div>
            </div>
        </div>
    </div>


@endsection
<!-- ============ Body content End ============= -->
@section('js')
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
