
@extends('dashboard.layouts.app')

<!-- ============ Body content start ============= -->
@section('content')
        <div class="breadcrumb">
            <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
            <ul>
                <li> الكوبونات</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>

        <!-- end of row -->

        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-header">
                        <div class="card-title mb-3">
                            <strong class="text-primary"> قائمة الكوبونات</strong>
                            <span class="align-baseline" style="display:inline;">
                                <a class="btn btn-primary " href="{{url('dashboard/coupon/create')}}" style="float: left">
                                <i class="i-Add align-middle" style="font-size: 17px; font-weight: 600;"></i> إضافة كوبون  </a>
                            </span>
                        </div>
                    </div>
                    @include('dashboard.layouts.message')
                    <div class="card-body">
                        @if(count($data) > 0)
                            <div class="table-responsive">
                                <table id="alternative_pagination_table" class="display table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>الكود  </th>
                                        <th>نسبة الخصم  </th>
                                        <th>البراند  </th>
                                        <th>الحالة  </th>
                                        <th>التحكم </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($data)>0 && !empty($data))
                                        @foreach($data as $item)
                                            <tr>
                                                <td>{{$item->code}}</td>
                                                <td>{{$item->discount}}%</td>
                                                <td>{{$item->title}}</td>
                                                <td>
                                                    @if( $item->status == '1')
                                                    <a  href="{{url('dashboard/coupon/suspend/'.$item->id)}}"  class="badge badge-success status-btn" style="width:80px;height: 25px;padding:auto;margin:auto;
                                                      padding-top: 7px; font-size: small">غير مستخدم</a>
                                                    @else
                                                    <a  href="{{url('dashboard/salecodes/activate/'.$item->id)}}"  class="badge badge-danger status-btn" style="width:80px;height: 25px;padding:auto;margin:auto;
                                                      padding-top: 7px; font-size: small">مستخدم</a>

                                                    @endif

                                                </td>

                                                <td style="text-align: center;">
                                                    <a href="{{url('dashboard/coupon/edit/'.$item->id)}}" class="text-info mr-2">
                                                        <i class="nav-icon i-Eye font-weight-bold " ></i>
                                                    </a>
                                                    <a href="{{url('dashboard/coupon/delete/'.$item->id)}}" class="text-danger mr-2">
                                                        <i class="nav-icon i-Close-Window font-weight-bold delete-btn"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>

                                </table>
                            </div>
                        @else
                            <p class="alert alert-danger text-danger"> لا يوجد بيانات حاليا</p>
                        @endif

                    </div>
                </div>
            </div>
            <!-- end of col -->

        </div>
        <!-- end of row -->


@endsection
<!-- ============ Body content End ============= -->
@section('js')
    <script>
        $(document).ready(function() {

            $("#alternative_pagination_table").on('click', '.status-btn', function () {
                var id = $(this).attr('id');
                var r = confirm("هل انت متاكد من تغيير الحالة");
                if (!r) {
                    return false
                }
            });

            $("#alternative_pagination_table").on('click', '.delete-btn', function () {
                var id = $(this).attr('id');
                var r = confirm("هل انت متاكد من عمليه الحذف ؟");
                if (!r) {
                    return false
                }
            });
        });
    </script>

@endsection
