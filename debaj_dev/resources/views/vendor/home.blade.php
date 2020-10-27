
@extends('vendor.layouts.app')

<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{url('vendor/dashboard')}}"><h1>الرئيسية</h1></a>
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
                @include('vendor.layouts.message')
                <div class="card-body ">
                    <div class="row justify-content-center">

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Library"></i>
                                    <div class="content">
                                        <p class="text-muted mt-2 mb-0"> عدد منتجات المضافة  </p><br/>
                                        <p class="text-primary text-24 line-height-1 mb-2">{{$data['added_produect']}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Car-Items"></i>
                                    <div class="content">
                                        <p class="text-muted mt-2 mb-0" style="width: 90px;">طلبات في انتظار الرد</p>
                                        <p class="text-primary text-24 line-height-1 mb-2">{{$data['waitingOrders']}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Financial"></i>
                                    <div class="content">
                                        <p class="text-muted mt-2 mb-0"> طلبات تمت</p>
                                        <p class="text-primary text-24 line-height-1 mb-2">{{$data['doneOrders']}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Clock-4"></i>
                                    <div class="content">
                                        <p class="text-muted mt-2 mb-0" style="width: 90px;">طلبات في انتظار الشحن</p>
                                        <p class="text-primary text-24 line-height-1 mb-2">{{$data['confirmedOrders']}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Car"></i>
                                    <div class="content">
                                        <p class="text-muted mt-2 mb-0" style="width: 90px;">طلبات في الشحن</p>
                                        <p class="text-primary text-24 line-height-1 mb-2">{{$data['inshippingOrders']}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Remove-Cart"></i>
                                    <div class="content">
                                        <p class="text-muted mt-2 mb-0" style="width: 90px;">طلبات  تم الغاءها</p>
                                        <p class="text-primary text-24 line-height-1 mb-2">{{$data['canceldOrders']}}</p>
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
