
@extends('dashboard.layouts.app')
@section('css')
    <link id="gull-theme" rel="stylesheet" href="{{asset('assets')}}/styles/css/image.css">
@endsection

<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            <li><a> الكوبونات</a></li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-state mb-3">  <strong class="text-primary">إضافة كوبون</strong></div>
                </div>
                @include('dashboard.layouts.message')

                <div class="card-body">
                    <form id="change-pwd" action="{{url('dashboard/coupon/store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                          <div class="col-md-6 form-group mb-3">
                               <label for="code">كود الخصم</label>
                               <input type="text" class="form-control" name="codeview" id="codeview" placeholder="كود الخصم" value="{{old('code')}}" autocomplete="off" disabled >
                               @if ($errors->has('code'))
                                   <span class="text-danger" role="alert">
                                       <strong>هذا الحقل مطلوب </strong>
                                   </span>
                               @endif
                           </div>
                           <input type="hidden" name="code" id="code" >

                           <div class="col-md-3 form-group mb-3">
                             <label for="code_gen"></label>
                               <span class="form-control btn btn-primary" id="code_gen"> انشاء كود</span>
                           </div>


                            <div class="col-md-6 form-group mb-3">
                                <label for="discount">نسبة الخصم %</label>
                                <input type="text" class="form-control" name="discount" id="discount" placeholder="% " value="{{old('discount')}}" autocomplete="off">
                                @if ($errors->has('discount'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{$errors->first('discount')}} </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="brand_id"> البراند</label>
                                <select class="form-control attribute" name="brand_id" id="brand_id" >
                                    <option value="" >اختر البراند </option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('brand_id'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{$errors->first('brand')}} </strong>
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

    <script>
    $( "#code_gen" ).click(function() {
      $.ajax({
       url: "{{url('dashboard/coupon/randomId')}}"
     }).done(function(data) {
       $( "#code" ).val(data)
       $( "#codeview" ).val(data)
     });
    });
  </script>

@endsection
