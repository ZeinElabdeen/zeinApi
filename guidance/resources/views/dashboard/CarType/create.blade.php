
@extends('dashboard.layouts.app')
@section('css')
    <link id="gull-theme" rel="stylesheet" href="{{asset('assets')}}/styles/css/image.css">
@endsection
<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            <li> أنواع السيارات </li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title mb-3">  <strong class="text-primary">إضافة نوع</strong></div>
                </div>
                @include('dashboard.layouts.message')

                <div class="card-body">
                    <form id="insert-form" action="{{url('dashboard/car_types/store')}}" method="post" >
                        @csrf
                        <div class="row">

                            <div class="col-md-6 form-group mb-3">
                                <label for="title_ar"> الاسم بالعربية </label>
                                <input type="text"   class="form-control" name="title_ar" id="title_ar" placeholder="الاسم بالعربية" value="{{old('title_ar')}}" autocomplete="off">
                                @if ($errors->has('title_ar'))
                                    <span class="text-danger" role="alert">
                                        <strong> هذا الحقل مطلوب بالعربية </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="title_en"> الاسم بالانجليزية </label>
                                <input type="text" class="form-control" name="title_en" id="title_en" placeholder="الاسم بالانجليزية" value="{{old('title_en')}}" autocomplete="off" >
                                @if ($errors->has('title_en'))
                                    <span class="text-danger" role="alert">
                                        <strong>هذا الحقل مطلوب  بالانجليزية</strong>
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

@endsection
