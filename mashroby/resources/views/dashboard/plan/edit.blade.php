@extends('dashboard.layout.master')

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
                        تعديل الباقة </a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>

        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <br>
        <div class="container">
            <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                تعديل الباقة
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" method="post" action="{{url('dashboard/plan/update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" hidden readonly name="id" value="{{$data->id}}">
                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">

                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control" name="title_ar" value="{{$data->title_ar}}" placeholder="الإسم العربي ">
                                    @if ($errors->has('title_ar'))
                                    <span class="form-text text-muted">
                                        <strong class="text text-danger">الإسم العربي مطلوب </strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control" name="title_en" value="{{$data->title_en}}" placeholder="الإسم الإنجليزي">
                                    @if ($errors->has('title_en'))
                                        <span class="form-text text-muted">
                                            <strong class="text text-danger">الإسم الإنجليزي مطلوب </strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control" name="price" value="{{$data->price}}" placeholder="سعر الاشتراك">
                                    @if ($errors->has('price'))
                                        <span class="form-text text-muted">
                                            <strong class="text text-danger">هذا الحقل مطلوب و يجب ان يكون رقم صحيح</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control" name="ads_count" value="{{$data->ads_count}}" placeholder="عدد الاعلانات">
                                    @if ($errors->has('ads_count'))
                                        <span class="form-text text-muted">
                                            <strong class="text text-danger">هذا الحقل مطلوب و يجب ان يكون رقم صحيح</strong>
                                        </span>
                                    @endif
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

                <!--end::Portlet-->

            </div>
        </div>
        </div>
    </div>

    <!-- end:: Content -->

@endsection

@section('js')
    <script>
        $("#image").change(function() {
            filename = this.files[0].name;
            $("#imageName").text(filename);
        });
    </script>
    @endsection
