@extends('dashboard.layout.master')

@section('content')
    @include('dashboard.layout._error')
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-container  kt-container--fluid ">
            <div class="kt-subheader__main">
                <a href="{{route('dashboard.home')}}">
                    <h3 class="kt-subheader__title">
                        لوحة التحكم </h3>
                </a>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a  class="kt-subheader__breadcrumbs-link">
                        تعديل {{$title}} </a>

                    <!-- <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Active link</span> -->
                </div>
            </div>

        </div>
    </div>

    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
        <br>
        <div class="container">
            <div class="row">
            <div class="col-lg-12">

                <!--begin::Portlet-->
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                تعديل {{$title}}
                            </h3>
                        </div>
                    </div>

                    <!--begin::Form-->
                    <form class="kt-form" method="post" action="{{url('dashboard/faq/update')}}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" hidden readonly name="id" value="{{$data->id}}">
                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">

                                <div class="form-group">
                                    <label>سؤال اللغة العربية</label>
                                    <textarea class="form-control" name="question_ar" id="">{{$data->question_ar}}</textarea>
                                    @if ($errors->has('question_ar'))
                                        <span class="form-text text-muted">
                                        <strong class="text text-danger">سؤال اللغة العربية مطلوب </strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>اجابة اللغة العربية</label>
                                    <textarea class="form-control" name="answer_ar" id="">{{$data->answer_ar}}</textarea>
                                    @if ($errors->has('answer_ar'))
                                        <span class="form-text text-muted">
                                        <strong class="text text-danger">اجابة اللغة العربية مطلوبة </strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>سؤال اللغة الانجليزية</label>
                                    <textarea class="form-control" name="question_en" id="">{{$data->question_en}}</textarea>
                                    @if ($errors->has('question_en'))
                                        <span class="form-text text-muted">
                                        <strong class="text text-danger">سؤال اللغة الانجليزية مطلوب </strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label>اجابة اللغة الانجليزية</label>
                                    <textarea class="form-control" name="answer_en" id="">{{$data->answer_en}}</textarea>
                                    @if ($errors->has('answer_en'))
                                        <span class="form-text text-muted">
                                        <strong class="text text-danger">اجابة اللغة الانجليزية مطلوبة </strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <button type="submit" class="btn btn-primary"> <i class="fa fa-calendar-check"></i>حفظ</button>
                            </div>
                        </div>
                    </form>

                    <!--end::Form-->
                </div>

                <!--end::Portlet-->

            </div>
        </div>
        </div>
    </div>

    <!-- end:: Content -->

@endsection

@section('js')
    <!-- CK editor -->
    <script src="//cdn.ckeditor.com/4.12.1/full/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('editor1');
            CKEDITOR.replace('editor2')
        });
    </script>
    @endsection
