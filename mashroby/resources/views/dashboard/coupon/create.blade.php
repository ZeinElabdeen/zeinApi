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

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <br>
        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
												<span class="kt-portlet__head-icon">
													<i class="kt-font-brand flaticon2-line-chart"></i>
												</span>
                    <h3 class="kt-portlet__head-title">
                      إضافة كوبون
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <div class="kt-portlet__head-actions">


                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__body">


    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-state mb-3">  <strong class="text-primary">إضافة كوبون</strong></div>
                </div>

                <div class="card-body">
                    <form id="change-pwd" action="{{url('dashboard/coupon/store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                          <div class="col-md-6 form-group mb-3">
                               <label for="code">كود الخصم</label>
                               <input type="text" class="form-control" name="codeview" id="codeview" placeholder="كود الخصم" value="{{old('code')}}" autocomplete="off" disabled >
                               @if ($errors->has('code'))
                                   <span class="text-danger" role="alert">
                                       <strong>هذا الحقل مطلوب </strong>
                                   </span>
                               @endif
                           </div>
                           <input type="hidden" name="code" id="code" >

                           <div class="col-md-3 form-group mb-3">
                             <label for="code_gen"></label>
                               <span class="form-control btn btn-primary" id="code_gen"> انشاء كود</span>
                           </div>


                            <div class="col-md-6 form-group mb-3">
                                <label for="discount">نسبة الخصم %</label>
                                <input type="number" min="1" max="100" class="form-control" name="discount" id="discount" placeholder="% " value="{{old('discount')}}" autocomplete="off">
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
    <script>
      $( "#code_gen" ).click(function() {
        $.ajax({
         url: "{{url('dashboard/coupon/randomId')}}"
       }).done(function(data) {
         $( "#code" ).val(data)
         $( "#codeview" ).val(data)
       });
      });
    </script>

    {{--    <script src="{{asset("dashboard_assets/js/pages/crud/datatables/advanced/column-rendering.js")}}" type="text/javascript"></script>--}}
    {{--<script src="{{asset("dashboard_assets/js/pages/crud/datatables/basic/headers.js")}}" type="text/javascript"></script>--}}
    {{--<script src="{{asset("dashboard_assets/js/datatables.bundle.js")}}" type="text/javascript"></script>--}}

    {{--    <script type="text/javascript" charset="utf8"--}}
    {{--            src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>--}}
    {{--    <script>--}}
    {{--        $(document).ready(function () {--}}
    {{--            $("#kt_table_1").DataTable();--}}
    {{--        });--}}

    {{--    </script>--}}
    {{--<script src="{{asset("dashboard_assets/js/pages/crud/datatables/basic/paginations.js")}}" type="text/javascript"></script>--}}

    @endsection
