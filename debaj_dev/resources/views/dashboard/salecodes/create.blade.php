
@extends('dashboard.layouts.app')
@section('css')
    <link id="gull-theme" rel="stylesheet" href="{{asset('assets')}}/styles/css/image.css">
@endsection
<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            <li><a> أكواد الخصم</a></li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title mb-3">  <strong class="text-primary">إضافة كود خصم</strong></div>
                </div>
                @include('dashboard.layouts.message')

                <div class="card-body">
                    <form id="insert-form" action="{{url('dashboard/salecodes/store')}}" method="post" >
                        @csrf
                        <div class="row">

                            <div class="col-md-6 form-group mb-3">
                                <label for="title_ar"> قيمة الخصم </label>%
                                <input type="number" min="1" max="100" class="form-control" name="salevalue" id="salevalue" placeholder="قيمه الخصم" value="{{old('salevalue')}}" autocomplete="off">
                                @if ($errors->has('salevalue'))
                                    <span class="text-danger" role="alert">
                                        <strong>هذا الحقل مطلوب و يجب أن يكون بالارقام</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-3 form-group mb-3">
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
<script>
    $( "#code_gen" ).click(function() {
      $.ajax({
       url: "{{url('dashboard/salecodes/randomId')}}"
     }).done(function(data) {
       $( "#code" ).val(data)
       $( "#codeview" ).val(data)
     });
    });
  </script>
@endsection
