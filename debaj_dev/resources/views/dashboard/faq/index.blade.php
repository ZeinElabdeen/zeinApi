
@extends('dashboard.layouts.app')

<!-- ============ Body content start ============= -->
@section('content')
        <div class="breadcrumb">
            <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
            <ul>
                <li>قائمة الاسئلة</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>

        <!-- end of row -->

        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-header">
                        <div class="card-title mb-3">
                            <strong class="text-primary"> قائمة الأسئلة الشائعة</strong>
                            <span class="align-baseline" style="display:inline;">
                                <a class="btn btn-primary " href="{{url('dashboard/faq/create')}}" style="float: left">
                                <i class="i-Add align-middle" style="font-size: 17px; font-weight: 600;"></i> إضافة سؤال  </a>
                            </span>

                        </div>
                    </div>
                    @include('dashboard.layouts.message')
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="alternative_pagination_table" class="display table table-striped table-bordered" style="width:100%">
                                <thead>
                                <tr>
                                    <td>#</td>
                                    <th>السؤال </th>
                                    <th>الإجابة  </th>
                                    <th>التحكم </th>

                                </tr>
                                </thead>
                                <tbody>
                                @if(count($data)>0 && !empty($data))
                                    @foreach($data as $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{$item->question_ar}}</td>
                                            <td>{{$item->answer_ar}}</td>

                                            <td style="text-align: center;">
                                                <a href="{{url('dashboard/faq/edit/'.$item->id)}}" class="text-success mr-2">
                                                    <i class="nav-icon i-Edit font-weight-bold " ></i>
                                                </a>
                                                <a href="{{url('dashboard/faq/delete/'.$item->id)}}" class="text-danger mr-2">
                                                    <i class="nav-icon i-Close-Window font-weight-bold delete-btn"></i>
                                                </a>
                                            </td>

                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>

                            </table>
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
