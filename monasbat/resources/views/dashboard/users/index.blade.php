
@extends('dashboard.layouts.app')

<!-- ============ Body content start ============= -->
@section('content')
        <div class="breadcrumb">
            <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
            <ul>
                <li>قائمة {{$user}}</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>

        <!-- end of row -->

        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-header">
                        <div class="card-title mb-3">
                            <strong class="text-primary"> قائمة {{$user}}</strong>
                        </div>
                    </div>
                    @include('dashboard.layouts.message')
                    <div class="card-body">
                        @if(count($data) > 0)
                            <div class="table-responsive">
                                <table id="alternative_pagination_table" class="display table table-striped table-bordered" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>الإسم </th>
                                        <th>البريد الإلكتروني </th>
                                        <th>رقم الجوال  </th>
                                        <th> تاريخ التسجيل </th>
                                        <th> الحالة  </th>
                                        @if($user_type == 'vendors')
                                        <th> أظهار بالاعلانات  </th>
                                        @endif
                                        <th>التحكم </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($data)>0 && !empty($data))
                                        @foreach($data as $item)
                                            <tr>
                                                <td>{{$item->username}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>{{$item->phone}}</td>
                                                <td>{{$item->created_at}}</td>
                                                @if($item->status == '1')
                                                    <td style="text-align: center;"><a  href="{{url('dashboard/users/suspend/'.$item->id)}}"  class="badge badge-success status-btn" style="width:80px;height: 25px;padding:auto;margin:auto;
                                                        padding-top: 7px; font-size: small">نشط</a></td>
                                                @else
                                                    <td style="text-align: center;"><a  href="{{url('dashboard/users/suspend/'.$item->id)}}"  class="badge badge-danger status-btn" style="width:80px;height: 25px;padding:auto;margin:auto;
                                                        padding-top: 7px; font-size: small">غير نشط</a></td>
                                                @endif
                                                @if($user_type == 'vendors')
                                                @if($item->is_ad == '1')
                                                    <td style="text-align: center;"><a  href="{{url('dashboard/users/show_ad/'.$item->id)}}"  class="badge badge-success status-btn" style="width:100%;height: 25px;padding:auto;margin:auto;
                                                        padding-top: 7px; font-size: small">ظاهر بالاعلانات</a></td>
                                                @else
                                                    <td style="text-align: center;"><a  href="{{url('dashboard/users/show_ad/'.$item->id)}}"  class="badge badge-danger status-btn" style="width:100%;height: 25px;padding:auto;margin:auto;
                                                        padding-top: 7px; font-size: small">غير ظاهر</a></td>
                                                @endif
                                                @endif
                                                <td style="text-align: center;">
                                                    <a href="{{url('dashboard/users/delete/'.$item->id)}}" class="text-danger mr-2">
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
