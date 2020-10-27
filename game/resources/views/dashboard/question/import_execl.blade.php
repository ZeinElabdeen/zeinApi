
@extends('dashboard.layouts.app')
@section('css')
    <link id="gull-theme" rel="stylesheet" href="{{asset('assets')}}/styles/css/image.css">
@endsection

<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            <li><a> الأسئلة</a></li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title mb-3">  <strong class="text-primary">إضافة سؤال</strong></div>
                </div>
                @include('dashboard.layouts.message')

                <div class="card-body">
                    <form id="change-pwd" action="{{url('dashboard/question/import-execl-save')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="col-md-6 form-group mb-3">
                                <label for="category"> القسم</label>
                                <select class="form-control attribute" name="category" id="category" >
                                    <option selected disabled>اختر القسم </option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category'))
                                    <span class="text-danger" role="alert">
                                        <strong>هذا الحقل مطلوب </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="type"> النوع</label>
                                <select class="form-control attribute" name="type" id="type" >
                                    <option selected disabled>اختر النوع </option>
                                        <option value="1">النوع الأول</option>
                                        <option value="2">النوع الثاني</option>
                                </select>
                                @if ($errors->has('type'))
                                    <span class="text-danger" role="alert">
                                        <strong>هذا الحقل مطلوب </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="answers">ملف الاسئله excel</label>
                                <input type="file" class="form-control"  accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" name="fileup" id="fileup"  autocomplete="off">
                            
                                @if ($errors->has('fileup'))
                                    <span class="text-danger" role="alert">
                                        <strong>مطلوب بضيغة اكسل</strong>
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


@endsection
