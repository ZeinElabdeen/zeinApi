
@extends('dashboard.layouts.app')
@section('css')
    <link id="gull-theme" rel="stylesheet" href="{{asset('assets')}}/styles/css/image.css">
@endsection

<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            <li><a> اكواد الشحن</a></li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title mb-3">  <strong class="text-primary">تعديل كود الشحن</strong></div>
                </div>
                @include('dashboard.layouts.message')

                <div class="card-body">
                    <form id="form-update" action="{{url('dashboard/salecodes/update')}}" method="post" >
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="row">

                          <div class="col-md-6 form-group mb-3">
                              <label for="title_ar">قيمة الشحن </label>
                              <input type="number" min="1"  class="form-control" name="salevalue" id="salevalue" placeholder="قيمه الشحن" value="{{$data->salevalue}}" autocomplete="off">
                              @if ($errors->has('salevalue'))
                                  <span class="text-danger" role="alert">
                                      <strong>هذا الحقل مطلوب و يجب أن يكون بالارقام</strong>
                                  </span>
                              @endif
                          </div>

                          <div class="col-md-3 form-group mb-3">
                              <label for="code">كود الشحن</label>
                              <input type="text" class="form-control" name="codeview" id="codeview" placeholder="كود الشحن" value="{{$data->code}}" autocomplete="off" disabled >
                              @if ($errors->has('code'))
                                  <span class="text-danger" role="alert">
                                      <strong>هذا الحقل مطلوب </strong>
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
<!-- ============ Body content End ============= -->
@section('js')


@endsection
