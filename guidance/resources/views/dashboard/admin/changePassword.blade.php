
@extends('dashboard.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            <li><a> تغير كلمة المرور</a></li>
        </ul>
    </div>


    <div class="separator-breadcrumb border-top"></div>

        <div class="row">
        <div class="col-md-10">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title mb-3"><strong class="text-primary">تغير كلمة المرور</strong> </div>
                </div>
                <div class="card-body">
                    <form id="change-pwd" action="{{route('dashboard.changePassword.post')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="old_password">كلمة المرور القديمة</label>
                                <input type="text" class="form-control" name="old_password" id="old_password" placeholder="كلمة المرور القديمة" autocomplete="off">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="password">كلمة المرور الجديدة</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="كلمة المرور الجديدة">
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="password_confirmation">تأكيد كلمة المرور الجديدة</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="تأكيد كلمة المرور الجديدة">
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
        $("#change-pwd").validate({
            // Specify the validation rules
            rules: {
                old_password: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength:8,
                },
                password_confirmation: {
                    required: true,
                },

            },
            // Specify the validation error messages
            messages: {
                old_password: {
                    required: 'يرجى ادخال كلمة المرور القديمة ',
                },
                password: {
                    required: 'يرجى ادخال كلمة المرور الجديدة ',
                    minlength:'كلمة المرور يجب أن تكون 8 حروف على الأقل',
                },
                password_confirmation: {
                    required: 'يرجى تأكيد كلمة المرور الجديدة ',
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
            errorClass: 'text-danger',
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

