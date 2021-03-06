
@extends('dashboard.layouts.app')
@section('css')
    <link id="gull-theme" rel="stylesheet" href="{{asset('assets')}}/styles/css/image.css">
@endsection
<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
              <li> أسباب الرفض </li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title mb-3">  <strong class="text-primary"> إضافة سبب </strong></div>
                </div>
                @include('dashboard.layouts.message')

                <div class="card-body">
                    <form id="insert-form" action="{{url('dashboard/reasons/store')}}" method="post" >
                        @csrf
                        <div class="row">

                            <div class="col-md-6 form-group mb-3">
                                <label for="reasons"> السبب   </label>
                                <input type="text"   class="form-control" name="reasons" id="reasons" placeholder="السبب" value="{{old('reasons')}}" autocomplete="off">
                                @if ($errors->has('reasons'))
                                    <span class="text-danger" role="alert">
                                        <strong> هذا الحقل مطلوب</strong>
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

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

@endsection
