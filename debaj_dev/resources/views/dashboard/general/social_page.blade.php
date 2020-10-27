
@extends('dashboard.layouts.app')

<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            <li><a> صفحات السوشيال </a></li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title mb-3"> <strong class="text-primary">تعديل</strong> </div>
                </div>
                @include('dashboard.layouts.message')

                <div class="card-body">
                    <form id="form" action="{{url('dashboard/general/social-pages')}}" method="post">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{$data->id}}" hidden readonly>
                            <div class="col-md-6 form-group mb-3">
                                <label for="facebook"> صفحة الفيس بوك:</label>
                                <input type="text" class="form-control" style="text-align: center;direction: ltr;" name="facebook" id="facebook" placeholder="صفحة الفيس بوك" value="{{$data->facebook}}" autocomplete="off">
                                @if ($errors->has('facebook'))
                                    <span class="text-danger" role="alert">
                                    <strong>مطلوب ويجب ان يكون بشكل صحيح </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="twiter">صفحة التويتر:</label>
                                <input type="text" class="form-control" style="text-align: center;direction: ltr;" name="twiter" id="twiter" placeholder="صفحة التويتر" value="{{$data->twiter}}" autocomplete="off">
                                @if ($errors->has('twiter'))
                                    <span class="text-danger" role="alert">
                                      <strong>مطلوب ويجب ان يكون بشكل صحيح </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="instgram">صفحةالانستجرام :</label>
                                <input type="text" class="form-control" style="text-align: center;direction: ltr;" name="instgram" id="instgram" placeholder="صفحةالانستجرام" value="{{$data->instgram}}" >
                                @if ($errors->has('instgram'))
                                    <span class="text-danger" role="alert">
                                    <strong>مطلوب ويجب ان يكون بشكل صحيح </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="pintrist">صفحة بينتيريست:</label>
                                <input type="text" class="form-control" style="text-align: center;direction: ltr;" name="pintrist" placeholder="صفحة بينتيريست" id="pintrist" value="{{$data->pintrist}}" >
                                @if ($errors->has('tel'))
                                    <span class="text-danger" role="alert">
                                    <strong>مطلوب ويجب ان يكون بشكل صحيح </strong>
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
