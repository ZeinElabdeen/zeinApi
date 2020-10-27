
@extends('dashboard.layouts.app')

<!-- ============ Body content start ============= -->
@section('content')
        <div class="breadcrumb">
            <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
            <a href="{{url('dashboard/brand/index')}}"><h1>البراندات</h1></a>
            <ul>
                <li> تقرير البراندات : {{ $data->title }}</li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>

        <!-- end of row -->

        <div class="row mb-4">
            <div class="col-md-12 mb-4">
                <div class="card text-left">
                    <div class="card-header">
                        <div class="card-title mb-3">
                            <strong class="text-primary"> قائمة المنتجات تم طلبها</strong>
                          </br>
                            <button class="btn btn-primary mb-sm-0 mb-3 " onclick="print_rep()">طباعة التقرير</button>
                        </div>
                    </div>
                    @include('dashboard.layouts.message')
                    <div class="card-body" id="rep_print">
                        @if(count($orders_items) > 0)
                            <div class="table-responsive">
                                <table class="table" >
                                    <thead>
                                    <tr>
                                        <th> اسم المنتج</th>
                                        <th> الكمية   </th>
                                        <th> السعر   </th>
                                        <th> الاجمالي  </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $total = 0;
                                      $total_pro = 0;
                                      ?>
                                    @if(count($orders_items)>0 && !empty($data))
                                        @foreach($orders_items as $item)
                                            <tr>
                                                <td>{{$item->title}}</td>
                                                <td>{{$item->count}}</td>
                                                <td>{{$item->price}}</td>
                                                <td>{{$item->count * $item->price}}</td>
                                                <?php
                                                $total = $total + ($item->count * $item->price) ;
                                                $total_pro = $total_pro + $item->count;
                                                ?>

                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>

                                </table>
                                <div class="col-md-12">
                                <div class="invoice-summary">
                                    <p>أجمالي المنتجات: <span>{{$total_pro}} منتج</span></p>
                                    <p class="font-weight-bold">أجمالي التقرير: <span>{{$total}}</span></p>
                                </div>
                            </div>
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
    function print_rep()
    {
       var divContents = document.getElementById("rep_print").innerHTML;
           var a = window.open('', '', 'height=1000, width=1000');
           a.document.write('<html><head><title></title>');
           a.document.write('<link rel="stylesheet" href="{{asset('assets')}}/styles/vendor/datatables.min.css"/><link rel="stylesheet" href="{{asset('assets')}}/styles/css/themes/lite-purple.min.css"/><link id="gull-theme" rel="stylesheet" href="{{asset('assets')}}/styles/css/themes/lite-purple.min.css"/>');
           a.document.write('</head><body >');
           a.document.write(divContents);
           a.document.write('</body></html>');
           a.document.close();
           a.print();
    }
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
