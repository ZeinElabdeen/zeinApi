@extends('dashboard.layout.master')
@section('css')
    <link href="{{asset("dashboard_assets/css/pages/wizard/wizard-4.css")}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
    @include('dashboard.layout._error')
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <a href="{{route('dashboard.home')}}">
                    <h3 class="kt-subheader__title">
                        لوحة التحكم </h3>
                </a>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a  class="kt-subheader__breadcrumbs-link">
                        تعديل اعلان</a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>

        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <br>

{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--            <div class="col-lg-12">--}}

                <!--begin::Portlet-->
        <div class="kt-wizard-v4" id="kt_user_add_user" data-ktwizard-state="step-first">

            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            تعديل اعلان
                        </h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="kt-form" id="create-ad" method="post" action="{{url('dashboard/ad/update')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" hidden readonly name="id" value="{{$data->id}}">
                    <div class="kt-portlet__body">
                        <div class="kt-portlet__body kt-portlet__body--fit">
                            <div class="kt-grid">
                                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">
                                    <!--begin: Form Wizard Step 1-->

                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" style="width: 80%">
                                        <div class="kt-section kt-section--first">
                                            <div class="kt-wizard-v4__form">
                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="kt-section__body">
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">الصورة :</label>
                                                                <div class="col-lg-9 col-xl-6">
                                                                    <div class="kt-avatar kt-avatar--outline" id="kt_user_add_avatar">
                                                                        <div class="kt-avatar__holder" style="background-image: url({{config('ad_storage').$data->image}})"></div>
                                                                        <label class="kt-avatar__upload" data-toggle="kt-tooltip" title="اضافة صورة">
                                                                            <i class="fa fa-pen"></i>
                                                                            <input type="file" name="image">
                                                                        </label>
                                                                        <span class="kt-avatar__cancel" data-toggle="kt-tooltip" title="حذف الصورة">
                                                                            <i class="fa fa-times"></i>
                                                                        </span>
                                                                    </div>
                                                                    @if ($errors->has('image'))
                                                                        <span class="form-text text-danger" role="alert">
                                                                            <strong>الصورة مطلوبة و يجب أن تكون بصيغة png,jpg,jpeg</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">الاسم العربي :</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control {{ $errors->has('title_ar') ? ' is-invalid' : '' }}" name="title_ar" value="{{$data->title_ar}}" type="text" placeholder="يجب ان يكون الاسم باللغة العربية" required >
                                                                    @if ($errors->has('title_ar'))
                                                                        <span class="form-text text-danger" role="alert">
                                                                            <strong>الإسم العربي مطلوب و يجب ألا يقل عن 3 أحرف</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">الاسم الانجليزي :</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control {{ $errors->has('title_en') ? ' is-invalid' : '' }}" name="title_en" value="{{$data->title_en}}" type="text" required >
                                                                    @if ($errors->has('title_en'))
                                                                        <span class="form-text text-danger" role="alert">
                                                                            <strong>الإسم الإنجليزي مطلوب و يجب ألا يقل عن 3 أحرف</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label" for="exampleSelect1">حجم العبوة :</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <select class="form-control {{ $errors->has('size') ? ' is-invalid' : '' }}" name="size" id="exampleSelect1" style="height: auto;">
                                                                        <option selected disabled> اختر الحجم </option>
                                                                        @foreach($sizes as $size)
                                                                            <option value="{{$size->id}}" {{($data->size_id == $size->id)?'selected':''}}>{{$size->title_ar .' - '. $size->title_en}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('size'))
                                                                        <span class="form-text text-danger" role="alert">
                                                                            <strong>الحجم مطلوب</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label" for="exampleSelect1">القسم :</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <select class="form-control {{ $errors->has('category') ? ' is-invalid' : '' }}" name="category" id="exampleSelect1" style="height: auto;">
                                                                        <option selected disabled> اختر القسم </option>
                                                                        @foreach($categories as $category)
                                                                            <option value="{{$category->id}}" {{($data->category_id == $category->id)?'selected':''}}>{{$category->title_ar .' - '. $category->title_en}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('category'))
                                                                        <span class="form-text text-danger" role="alert">
                                                                            <strong>القسم مطلوب</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">الكمية :</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control {{ $errors->has('stock') ? ' is-invalid' : '' }}" name="stock" value="{{$data->stock}}" type="number" min="1" required>
                                                                    @if ($errors->has('stock'))
                                                                        <span class="form-text text-danger" role="alert">
                                                                            <strong>الكمية مطلوبة ويجب ان تكون ارقم صحيحة</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-xl-3 col-lg-3 col-form-label">السعر :</label>
                                                                <div class="col-lg-9 col-xl-9">
                                                                    <input class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{$data->price}}" type="number" min="1" required >
                                                                    @if ($errors->has('price'))
                                                                        <span class="form-text text-danger" role="alert">
                                                                            <strong>السعر مطلوب ويجب أن يكون رقم صحيح</strong>
                                                                        </span>
                                                                    @endif
                                                                    <span class="form-text text-info">هذا السعر الذي سيعرض للمستخدم و يتم الحساب عليه</span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-3 col-form-label">نوع الاعلان :</label>
                                                                <div class="col-9">
                                                                    <div class="kt-radio-inline">
                                                                        <label class="kt-radio kt-radio--brand">
                                                                            <input type="radio" id="ad-type" name="type" value="1" checked> اعلان عادي
                                                                            <span></span>
                                                                        </label>
                                                                        <label class="kt-radio kt-radio--success">
                                                                            <input type="radio" id="ad-type" name="type" value="2" {{($data->type == '2')?'checked':''}}> عرض
                                                                            <span></span>
                                                                        </label>
                                                                        </div>
{{--                                                                    <span class="form-text text-muted">Some help text goes here</span>--}}
                                                                </div>
                                                                <label id="discount-label" class="col-3 col-form-label" hidden>نسبة الخصم</label>
                                                                <div id="discount-div" class="form-inline col-6" hidden>
                                                                    <div class="form-group input-group ">
                                                                        <input class="form-control {{ $errors->has('discount') ? ' is-invalid' : '' }}" name="discount" value="{{$data->discount}}" type="number" min="1" max="100">
                                                                        <div class="input-group-append "><span class="input-group-text" id="basic-addon2">%</span></div>
                                                                    </div>
                                                                    @if ($errors->has('discount'))
                                                                        <span class="form-text text-danger" role="alert">
                                                                            <strong>السعر مطلوب ويجب أن يكون رقم صحيح</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 1-->

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-primary"> <i class="fa fa-calendar-check"></i>حفظ</button>
                        </div>
                    </div>
                </form>

                <!--end::Form-->
            </div>
        </div>


                <!--end::Portlet-->

{{--            </div>--}}
{{--        </div>--}}
{{--        </div>--}}
    </div>

    <!-- end:: Content -->
{{--    <div class="form-group">--}}
{{--        <label></label>--}}
{{--        <input type="text" class="form-control" name="title_ar" value="{{old('title_ar')}}" placeholder="الإسم العربي ">--}}
{{--        @if ($errors->has('title_ar'))--}}
{{--            <span class="form-text text-muted">--}}
{{--                                        <strong class="text text-danger">الإسم العربي مطلوب </strong>--}}
{{--                                    </span>--}}
{{--        @endif--}}
{{--    </div>--}}
@endsection

@section('js')
    <script src="{{asset("dashboard_assets/js/pages/custom/user/add-user.js")}}" type="text/javascript"></script>

    <script>
        $(document).ready(function () {
            var val = $('input[name=type]:checked', '#create-ad').val();
            if (val == '2') {
                $("#discount-label").removeAttr('hidden');
                $("#discount-div").removeAttr('hidden');
            }
        });

        $('#create-ad input[name=type]').on('change', function() {
            var val = $('input[name=type]:checked', '#create-ad').val();
            if (val == '2') {
                $("#discount-label").removeAttr('hidden');
                $("#discount-div").removeAttr('hidden');
            }
            else {
                $("#discount-label").attr('hidden','hidden');
                $("#discount-div").attr('hidden','hidden');
                $("#discount-div input[name=discount]").val('');

            }
        });
    </script>


    @endsection
