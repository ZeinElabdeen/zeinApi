
@extends('dashboard.layouts.app')
@section('css')
    <link id="gull-theme" rel="stylesheet" href="{{asset('assets')}}/styles/css/image.css">
@endsection

<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            <li><a> المدن</a></li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title mb-3">  <strong class="text-primary">إضافة مدينة</strong></div>
                </div>
                @include('dashboard.layouts.message')

                <div class="card-body">
                    <form id="change-pwd" action="{{url('dashboard/city/store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 form-group mb-3">
                                <label for="city">الإسم </label>
                                <input type="text" class="form-control" name="city" id="city" placeholder="الإسم " value="{{old('city')}}" autocomplete="off">
                                @if ($errors->has('city'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{$errors->first('city')}} </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="state"> المحافظة</label>
                                <select class="form-control attribute" name="state" id="state" >
                                    <option selected disabled>اختر المحافظة </option>
                                    @foreach($states as $state)
                                        <option value="{{$state->id}}">{{$state->state}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('state'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{$errors->first('state')}} </strong>
                                    </span>
                                @endif
                            </div>
{{--                            <div class="col-md-6 form-group mb-3">--}}
{{--                                <label for="title_en">الإسم الانجليزي</label>--}}
{{--                                <input type="text" class="form-control" name="title_en" id="title_en" placeholder="الإسم الإنجليزي" value="{{old('title_en')}}" autocomplete="off">--}}
{{--                                @if ($errors->has('title_en'))--}}
{{--                                    <span class="text-danger" role="alert">--}}
{{--                                        <strong>هذا الحقل مطلوب و يجب أن يكون باللغة الإنجليزية</strong>--}}
{{--                                    </span>--}}
{{--                                @endif--}}
{{--                            </div>--}}


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
    <script src="{{asset('assets')}}/js/image.js"></script>
    <script>
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
