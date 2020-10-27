أنواع
@extends('dashboard.layouts.app')
@section('css')
    <link id="gull-theme" rel="stylesheet" href="{{asset('assets')}}/styles/css/image.css">
@endsection

<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            @if($data->type == 1)
              <li> أسباب رفض العميل </li>
            @else
              <li> أسباب رفض السائقين </li>
            @endif
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title mb-3">  <strong class="text-primary"> تعديل سبب</strong></div>
                </div>
                @include('dashboard.layouts.message')

                <div class="card-body">
                    <form id="form-update" action="{{url('dashboard/reasons/update')}}" method="post" >
                        @csrf
                        <input type="hidden" name="id" value="{{$data->id}}">
                        <div class="row">

                          <div class="col-md-6 form-group mb-3">
                              <label for="reason_ar"> السبب  بالعربية </label>
                              <input type="text"   class="form-control" name="reason_ar" id="reason_ar" placeholder="السبب  بالعربية" value="{{$data->reason_ar}}" autocomplete="off">
                              @if ($errors->has('reason_ar'))
                                  <span class="text-danger" role="alert">
                                      <strong> هذا الحقل مطلوب بالعربية </strong>
                                  </span>
                              @endif
                          </div>

                          <div class="col-md-6 form-group mb-3">
                              <label for="reason_en"> السبب  بالانجليزية </label>
                              <input type="text" class="form-control" name="reason_en" id="reason_en" placeholder="السبب  بالانجليزية" value="{{$data->reason_en}}" autocomplete="off" >
                              @if ($errors->has('reason_en'))
                                  <span class="text-danger" role="alert">
                                      <strong>هذا الحقل مطلوب  بالانجليزية</strong>
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
