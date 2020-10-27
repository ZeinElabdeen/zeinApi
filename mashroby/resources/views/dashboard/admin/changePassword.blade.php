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
                        تغيير كلمة المرور </a>

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
                                تغير كلمه المرور
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" method="post" action="{{route('dashboard.changePassword.post')}}">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control" name="old_password" placeholder="كلمة المرور القديمة" autocomplete="off">
                                        @if ($errors->has('old_password'))
                                        <span class="form-text text-muted">
                                            <strong class="text text-danger">كلمة المرور القديمة مطلوبة و يجب ان تكون صحيحة</strong>
                                        </span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="password" class="form-control" name="password" placeholder="كلمة المرور الجديدة">
                                    @if ($errors->has('password'))
                                    <span class="form-text text-muted">
                                        <strong class="text text-danger">كلمه المرور الجديدة مطلوبه ويجب ان تكون متشابهه</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="تأكيد كلمة المرور الجديدة">
                                    @if ($errors->has('password'))
                                        <span class="form-text text-muted">
                                            <strong class="text text-danger">يجب تأكيد كلمة المرور</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-calendar-check"></i>تغير كلمة المرور</button>
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

