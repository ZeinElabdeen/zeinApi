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
                        تعديل {{$data->username}} </a>

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
                              تعديل {{$data->username}}
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" action="{{url('dashboard/admin/update')}}"  method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="text" hidden readonly name="id" value="{{$data->id}}">
                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">
                                <div class="form-group">
                                    <label>اسم الدخول</label>
                                    <input type="text" class="form-control" name="username" value="{{$data->username}}" placeholder="اسم الدخول ">
                                    @if ($errors->has('username'))
                                    <span class="form-text text-muted">
                                        <strong class="text text-danger">اسم الدخول مطلوب </strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>البريد الالكتروني</label>
                                    <input type="email" class="form-control" name="email" value="{{$data->email}}" placeholder="رقم الهاتف">
                                    @if ($errors->has('email'))
                                        <span class="form-text text-muted">
                                            <strong class="text text-danger"> البريد الالكتروني مطلوب </strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                  <label for="password"></label>

                                    <input type="password" class="form-control" name="password"   placeholder="كلمة المرور">
                                    @if ($errors->has('password'))
                                        <span class="form-text text-muted">
                                            <strong>كلمه المرور مطلوبه ويجب ان لا تقل عن 8 حروف او ارقام</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                  <label for="password_confirmation"></label>
                                    <input type="password" class="form-control" name="password_confirmation"  placeholder="تأكيد كلمة المرور">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="form-text text-muted"  >
                                            <strong class="text text-danger" >يجب تأكيد كلمة المرور</strong>
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

    @endsection
