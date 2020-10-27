
@extends('dashboard.layouts.app')

<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            <li><a> صفحة من نحن </a></li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title mb-3"> <strong class="text-primary">تعديل</strong> </div>
                </div>
                @include('dashboard.layouts.message')

                <div class="card-body">
                    <form id="form" action="{{url('dashboard/general/about-us')}}" method="post">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{$data->id}}" hidden readonly>
                            <div class="col-md-8 form-group mb-3">
                                <label for="title_ar">العنوان بالعربيه:</label>
                                <input type="text" class="form-control" name="title_ar" id="title_ar" placeholder="العنوان بالعربيه" value="{{$data->title_ar}}" autocomplete="off">
                                @if ($errors->has('title_ar'))
                                    <span class="text-danger" role="alert">
                                    <strong>مطلوب ويجب ان يكون بالعربيه </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-8 form-group mb-3">
                                <label for="title_en">العنوان بالانجليزية:</label>
                                <input type="text" class="form-control" name="title_en" id="title_en" placeholder="العنوان بالانجليزية" value="{{$data->title_en}}" autocomplete="off">
                                @if ($errors->has('title_en'))
                                    <span class="text-danger" role="alert">
                                    <strong>مطلوب ويجب ان يكون بالانجليزية </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-8 form-group mb-3">
                                <label for="content_ar">المحتوي بالعربية :</label>
                                <textarea class="form-control" id="content_ar" name="content_ar">{{$data->content_ar}}</textarea>
                                @if ($errors->has('content_ar'))
                                    <span class="text-danger" role="alert">
                                    <strong>مطلوب ويجب ان يكون بالعربية</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-8 form-group mb-3">
                                <label for="content_en">المحتوي بالانجليزية :</label>
                                <textarea class="form-control" id="content_en" name="content_en">{{$data->content_en}}</textarea>
                                @if ($errors->has('content_en'))
                                    <span class="text-danger" role="alert">
                                    <strong>مطلوب ويجب ان يكون بالانجليزية</strong>
                                    </span>
                                @endif
                            </div>

<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content_ar' );
    CKEDITOR.replace( 'content_en' );
</script>
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
