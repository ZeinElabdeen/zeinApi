@extends('dashboard.layout.master')

@section('content')
    @include('dashboard.layout._error')

<!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <span style="margin: 5px;">
                    <i class="la la-home la-lg"></i>
                </span>
                <h3 class="kt-subheader__title">
                    لوحة التحكم </h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>

        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

        <!--Begin::Dashboard 4-->
<div class="container-fluid">
        <div class="kt-portlet kt-portlet--fit kt-portlet--head-lg kt-portlet--head-overlay kt-portlet--skin-solid kt-portlet--height-fluid">
            <div class="kt-portlet__head kt-portlet__head--noborder kt-portlet__space-x">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        الاحصائيات
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">
                <div class="kt-widget17">
                    <div class="kt-widget17__visual kt-widget17__visual--chart kt-portlet-fit--top kt-portlet-fit--sides" style="background-color: #fd397a">
                        <div class="kt-widget17__chart" style="height:120px;">
                            <canvas id="kt_chart_activities"></canvas>
                        </div>
                    </div>
                    <div class="kt-widget17__stats">
                        <div class="kt-widget17__items">
{{--                            <div class="kt-widget17__item">--}}
{{--                                <span class="kt-widget17__icon">--}}
{{--                                    <i class="fa fa-user-check" style="color: #6167e6;"></i>--}}
{{--                                </span>--}}
{{--                                <span class="kt-widget17__subtitle">--}}
{{--                                    المشتركون--}}
{{--                                </span>--}}
{{--                                <span class="kt-widget17__desc">--}}
{{--                                     {{$data['vendors']}}   مستخدم--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                            <div class="kt-widget17__item">--}}
{{--                                <span class="kt-widget17__icon">--}}
{{--                                    <i class="fa fa-user-friends" style="color: #6167e6;"></i>--}}

{{--                                </span>--}}
{{--                                <span class="kt-widget17__subtitle">--}}
{{--                                    المستخدمون--}}
{{--                                </span>--}}
{{--                                <span class="kt-widget17__desc">--}}
{{--                                    {{$data['normalUser']}} مستخدم--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                            <div class="kt-widget17__item">--}}
{{--                                <span class="kt-widget17__icon">--}}
{{--                                    <i class="fa fa-user-clock" style="color: #6167e6;"></i>--}}
{{--                                 </span>--}}
{{--                                <span class="kt-widget17__subtitle">--}}
{{--                                    طلبات الاشتراك--}}
{{--                                </span>--}}
{{--                                <span class="kt-widget17__desc">--}}
{{--                                    {{$data['vendorsWaitingForAccept']}} مستخدم--}}
{{--                                </span>--}}
{{--                            </div>--}}
                        </div>

                        <div class="kt-widget17__items">
{{--                            <div class="kt-widget17__item">--}}
{{--                                <span class="kt-widget17__icon">--}}
{{--                                    <i class="fa fa-ad" style="color: #6167e6;"></i>--}}
{{--                                 </span>--}}
{{--                                <span class="kt-widget17__subtitle">--}}
{{--                                    الاعلانات--}}
{{--                                </span>--}}
{{--                                <span class="kt-widget17__desc">--}}
{{--                                    {{$data['ads']}} اعلانات--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                            <div class="kt-widget17__item">--}}
{{--                                <span class="kt-widget17__icon">--}}
{{--                                    <i class="fa fa-layer-group" style="color: #6167e6;"></i>--}}
{{--                                 </span>--}}
{{--                                <span class="kt-widget17__subtitle">--}}
{{--                                    الاقسام--}}
{{--                                </span>--}}
{{--                                <span class="kt-widget17__desc">--}}
{{--                                    {{$data['categories']}} أقسام--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                            <div class="kt-widget17__item">--}}
{{--                                <span class="kt-widget17__icon">--}}

{{--                                    <i class="fa fa-list" style="color: #6167e6;"></i>--}}
{{--                                 </span>--}}
{{--                                <span class="kt-widget17__subtitle">--}}
{{--                                    الاقسام الفرعية--}}
{{--                                </span>--}}
{{--                                <span class="kt-widget17__desc">--}}
{{--                                    {{$data['subcategories']}} أقسام فرعية--}}
{{--                                </span>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>


        <!--End::Dashboard 4-->
    </div>

    <!-- end:: Content -->

@endsection

