
@extends('dashboard.layouts.app')

<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            <li><a> {{str_replace($title,'_',' ') }}</a></li>
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
                    @foreach($data as $data)
                    <form id="change-pwd" action="{{url('dashboard/setting/updateContact')}}" method="post">
                        @csrf
                        <div class="row">

                            <input type="hidden" name="id" value="{{$data->id}}" hidden readonly>
                            <div class="col-md-6 form-group mb-3">
                                <label for="value" style="font-size: 16px;">{{$data->key}} </label>
                                <input type="text" class="form-control" name="value" id="value" placeholder="" value="{{$data->value_ar}}" autocomplete="off">
                                @if ($errors->has('value'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{$errors->first('value')}}</strong>
                                    </span>
                                @endif
                            </div>

                          <div class="col-md-6 form-group mb-3" style="margin-top: 27px;">
                            <button class="btn btn-success" style="width: 20%;" >حفظ</button>
                          </div>

{{--                            <div class="col-md-4">--}}
{{--                                <button class="btn btn-primary" style="margin-top: 28px;">حفظ</button>--}}
{{--                            </div>--}}
                        </div>
                    </form>
                        @endforeach

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
