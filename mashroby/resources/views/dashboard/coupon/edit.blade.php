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
                      قائمة الكوبونات </a>

                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-state mb-3">  <strong class="text-primary">تعديل </strong></div>
                </div>


                <div class="card-body">
                    <form id="change-pwd" action="{{url('dashboard/coupon/update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="code">الكود</label>
                                <input type="text" class="form-control" name="code" id="code" placeholder="الكود " value="{{$data->code}}" disabled autocomplete="off">
                                @if ($errors->has('code'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{$errors->first('code')}} </strong>
                                    </span>
                                @endif
                            </div>


                            <div class="col-md-6 form-group mb-3">
                                <label for="discount">نسبة الخصم %</label>
                                <input type="number" min="1" max="100" class="form-control" name="discount" id="discount" placeholder="% " value="{{$data->discount}}" autocomplete="off">
                                @if ($errors->has('discount'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{$errors->first('discount')}} </strong>
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
    @section('js')
