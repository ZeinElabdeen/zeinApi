
@extends('dashboard.layouts.app')

<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
    </div>
    <div class="separator-breadcrumb border-top"></div>

    <!-- end of row -->

    <div class="row mb-4">
        <div class="col-md-12 mb-4">
            <div class="card text-left">
                <div class="card-header">
                    <div class="card-title mb-3">
                        <strong class="text-primary"> الإحصائيات</strong>
                    </div>
                </div>
                @include('dashboard.layouts.message')
                <div class="card-body ">
                    <div class="row justify-content-center">

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Add-User"></i>
                                    <div class="content">
                                        <p class="text-muted mt-2 mb-0"> العملاء  </p><br/>
                                        <p class="text-primary text-24 line-height-1 mb-2">{{$data['normalUsers']}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Add-User"></i>
                                    <div class="content">
                                        <p class="text-muted mt-2 mb-0" style="width: 90px;">العملاء بإنتظار التفعيل</p>
                                        <p class="text-primary text-24 line-height-1 mb-2">{{$data['waitingUsers']}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Financial"></i>
                                    <div class="content">
                                        <p class="text-muted mt-2 mb-0"> مقدمين الخدمة</p>
                                        <p class="text-primary text-24 line-height-1 mb-2">{{$data['vendorUsers']}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Financial"></i>
                                    <div class="content">
                                        <p class="text-muted mt-2 mb-0" style="width: 90px;">مقدمين الخدمة  بإنتظار التفعيل</p>
                                        <p class="text-primary text-24 line-height-1 mb-2">{{$data['waitingvendorUsers']}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end of col -->

    </div>
    <!-- end of row -->


@endsection
<!-- ============ Body content End ============= -->
@section('js')

@endsection
