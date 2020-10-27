
@extends('dashboard.layouts.app')

<!-- ============ Body content start ============= -->
@section('content')
        <div class="breadcrumb">
            <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
            <ul>
                <li> المنتجات</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>

        <!-- end of row -->

        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-header">
                        <div class="card-title mb-3">
                            <strong class="text-primary"> قائمة المنتجات</strong>
                            <span class="align-baseline" style="display:inline;">
                                <a class="btn btn-primary " href="{{url('dashboard/item/create')}}" style="float: left">
                                <i class="i-Add align-middle" style="font-size: 17px; font-weight: 600;"></i> إضافة منتج  </a>
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
                                        <th>الاسم  </th>
                                        <th>البراند   </th>
                                        <th>السعر   </th>
                                        <th>الوصف   </th>
                                        <th>الصورة   </th>
                                        <th>التفاصيل   </th>
                                        <th>التحكم </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($data)>0 && !empty($data))
                                        @foreach($data as $item)
                                            <tr>
                                                <td>{{$item->title}}</td>
                                                <td>{{$item->brand->title}}</td>
                                                <td>{{$item->price}}</td>
                                                <td>{{$item->description}}</td>

                                                <td>
                                                    <img src="{{config('attach_storage'). $item->firstAttach->image}}" width="200" height="100" alt="">
                                                </td>
                                                <td>
                                                    <button class="btn btn-outline-primary mt-3 mb-3 m-sm-0 btn-rounded btn-sm" data-toggle="modal" data-target="#exampleModalCenter-{{$item->id}}">عرض التفاصيل</button>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModalCenter-{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">

                                                                    <h5 class="modal-title" id="exampleModalCenterTitle-2">تفاصيل {{$item->title}}</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <table class="table-responsive table-striped" style="table-layout: fixed;">
                                                                        <tbody style="width: 100%">
                                                                        @if(count($item->details) > 0)
                                                                            @foreach($item->details as $detail)
                                                                                <tr style="width: 100%">
                                                                                    <td>{{$detail->key}}</td>
                                                                                    <td>{{$detail->value}}</td>
                                                                                </tr>
                                                                            @endforeach
                                                                            @else
                                                                            <tr>
                                                                                <td> <p> لا يوجد تفاصيل لهذا المنتج</p> </td>
                                                                            </tr>
                                                                        @endif

                                                                        </tbody>

                                                                    </table>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="{{url('dashboard/item/edit/'.$item->id)}}" class="text-info mr-2">
                                                        <i class="nav-icon i-Eye font-weight-bold " ></i>
                                                    </a>
                                                    <a href="{{url('dashboard/item/delete/'.$item->id)}}" class="text-danger mr-2">
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
