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
                        إضافة مدير</a>

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
                                إضافة مدير
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" method="post" action="{{url('dashboard/admin/store')}}">
                        @csrf
                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control" name="username" placeholder="الإسم" autocomplete="off">
                                        @if ($errors->has('username'))
                                        <span class="form-text text-muted">
                                            <strong class="text text-danger">الإسم مطلوب و يجب ألا يقل عن 3 أحرف</strong>
                                        </span>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="text" class="form-control" name="email" placeholder="البريد الإلكتروني" autocomplete="off">
                                    @if ($errors->has('email'))
                                        <span class="form-text text-muted">
                                            <strong class="text text-danger">البريد الإلكتروني مطلوب و يجب أن يكون صحيح</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="password" class="form-control" name="password" placeholder="كلمة المرور ">
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
                                            <strong class="text text-danger">يجب تأكيد كلمة </strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-calendar-check"></i>إضافة</button>
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

