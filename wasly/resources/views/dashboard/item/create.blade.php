
@extends('dashboard.layouts.app')
@section('css')
    <link id="gull-theme" rel="stylesheet" href="{{asset('assets')}}/styles/css/image.css">
    <style>
        #cd-header-top{
            background: #8e0ede;
            color:darkwhite;
            text-align:left;
            width: 100%;
            height:90px;
            position:relative;
        }

        footer {
            background-color: #607D8B;
            width: 100%;
            bottom: 0;
            padding: 0px 0px 0px 6px;
            position: fixed;
            font-family: ‘Lucida Console’, Monaco, monospace;
            color: #CFD8DC;
        }

        section{
            height: 100%;
        }
        .cd-top-line{
            background: #639;
            heigth: 25px;

        }

        .cd-input-button {
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }

        .cd-buttons {
            width: 140px;
            display: table;
            text-align: center;
            float:left;
            margin: 0px 6px 0px 5px ;
            font-size: 13px;

        }

        .cd-buttons > .cd-button {
            display: table-cell;
            vertical-align: middle;
            height:17px;
            overflow: hidden;
            cursor: pointer;
            color:#727272;
            background-color: #CFD8DC;
            text-align: center;
            padding:5px;
        }

        .clear:hover{
            background-color: #ff0515;
            color: #FFFFFF;
        }

        .add:hover{
            background-color: #1506ff;
            color: #FFFFFF;
        }

        .cd-file-input {
            cursor: pointer;
            height: 100%;
            position:absolute;
            top: 0;
            right: 0;
            font-size:50px;
        }

        .hidden {
            opacity: 0;
            -moz-opacity: 0;
            filter:progid:DXImageTransform.Microsoft.Alpha(opacity=0)
        }

        .cd-img-container{
            min-width: 650px;
            position: relative;
            border-color: #B6B6B6;
        }

        .cd-upload-button{
            float: right;
        }
        li {
            display: inline-block !important;
            margin: 10px;
        }

        .cd-dropzone-highlighted {
            border: 4px solid #FF5722 !important;
        }

        progress:not([value]) {

        }


        .dark-primary-color    { background: #455A64; }
        .default-primary-color { background: #607D8B; }
        .light-primary-color   { background: #CFD8DC; }
        .text-primary-color    { color: #FFFFFF; }
        .accent-color          { background: #FF5722; }
        .primary-text-color    { color: #212121; }
        .secondary-text-color  { color: #727272; }
        .divider-color         { border-color: #B6B6B6; }

        .custom-input {
            margin-left: 5px !important;
        }
    </style>
@endsection

<!-- ============ Body content start ============= -->
@section('content')
    <div class="breadcrumb">
        <a href="{{route('dashboard.home')}}"><h1>الرئيسية</h1></a>
        <ul>
            <li><a> المنتجات</a></li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="card-title mb-3">  <strong class="text-primary">إضافة منتج</strong></div>
                </div>
                @include('dashboard.layouts.message')

                <div class="card-body">
                    <form id="form" action="{{url('dashboard/item/store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <!-- upload multiple images -->

                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

                                <div id="cd-header-top" class="body">
                                    <div class="cd-top-line" >&nbsp</div>

                                    <h1></h1>

                                    <div class="cd-buttons ">
                                        <div class="cd-button clear" id="cd-clear-bnt" >حذف الكل</div>
                                    </div>
                                    <div class="cd-buttons cd-upload-button">
                                        <div class="cd-button cd-input-button add">
                                            إضافة صور
                                            <input class="cd-file-input hidden" type="file" name="images[]" id="cd-file-field" multiple="true" />
                                        </div>
                                    </div>

                                </div>

                                <div class="cd-img-container" >
                                    <ul id="cd-img-list" class="text-center"></ul>
                                </div>
                                <!--end upload multiple images-->
                                @if ($errors->has('images'))
                                    <span class="text-danger" role="alert">
                                        <strong>الصور مطلوبة ويجب ان تكون بصيغة jpg,jpeg,png</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="title">الإسم </label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="الإسم " value="{{old('title')}}" autocomplete="off">
                                @if ($errors->has('title'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{$errors->first('title')}} </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="price">السعر </label>
                                <input type="text" class="form-control" name="price" id="price" placeholder="السعر " value="{{old('price')}}" autocomplete="off">
                                @if ($errors->has('price'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{$errors->first('price')}} </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="brand"> البراند</label>
                                <select class="form-control attribute" name="brand" id="brand" >
                                    <option selected disabled>اختر البراند </option>
                                    @foreach($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->title}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('brand'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{$errors->first('brand')}} </strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 form-group mb-3">
                                <label for="classification"> التصنيف</label>
                                <select class="form-control attribute" name="classification" id="classification" >
                                    <option selected disabled>اختر البراند أولا </option>

                                </select>
                                @if ($errors->has('classification'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{$errors->first('classification')}} </strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-8 form-group mb-3">
                                <label for="description">وصف المنتج :</label>
                                <textarea  class="form-control" name="description" rows="5" id="description" >{{old('description')}}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger" role="alert">
                                        <strong>{{$errors->first('description')}}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class=" col-md-12 ">

                                <div class="card-header">
                                    <div class=" mb-3"><strong class="text-primary">تفاصيل المنتج </strong></div>
                                </div>

                                <div class="card-body">
                                    <div class="input-group control-group after-add-more">
                                      <div id="add_new" class="input-group control-group after-add-more" ></div>
                                        <input type="text" name="details['0'][key]" class="form-control custom-input" placeholder=" الصفة " >
                                        <input type="text" name="details['0'][value]" class="form-control custom-input" placeholder="القيمة ">

                                        <div class="input-group-btn">
                                            <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> إضافة</button>
                                        </div>

                                    </div>

                                </div>
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
    <!-- Copy Fields -->
    <script type="text/javascript">
        $(document).ready(function() {
            $(".add-more").click(function(){
                let rand = Math.floor(Math.random()*(999999 - 1)) + 1;
                var html = '<div class="control-group input-group" style="margin-top:10px;padding: 10px;">\n' +
                    '            <input type="text" name="details['+rand+'][key]" class="form-control custom-input" placeholder="الصفة">\n' +
                    '            <input type="text" name="details['+rand+'][value]" class="form-control custom-input" placeholder="القيمة ">\n' +
                    '\n' +
                    '            <div class="input-group-btn">\n' +
                    '                <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> حذف</button>\n' +
                    '            </div>\n' +
                    '        </div>';
                $("#add_new").append(html);
            });

            $("body").on("click",".remove",function(){
                $(this).parents(".control-group").remove();
            });
        });


    </script>

    <script src="{{asset('assets')}}/js/image.js"></script>
    <script>

        /* get brand classifications*/

        $(document).ready(function () {
            'use strict';

            $(document).on('change','#brand',function (event) {

                event.preventDefault();
                var id = $(this).val();
                var url = "{{url('dashboard/brand/classifications')}}"+'/'+id;
                $.ajax({
                    url:url,
                    dataType:'json',
                    type:'get',
                    // data:{id:id},
                    // mimeType: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend:function(){
                        // alert(url);
                    },
                    success:function (data) {
                        if (data.status == 1){
                            $('#classification option').remove();
                            $('#classification').append("<option selected disabled>اختر التصنيف</option>");
                            $.each(data.data,function (index,value) {
                                // console.log(data.data);
                                $('#classification').append("<option value="+value.id+">"+value.title +"</option>");
                            });
                        }
                    }
                });
            });
        });


        /*multiple upload*/
        $(function() {
            var fileInput = $('#cd-file-field');
            var imgList = $('ul#cd-img-list');
            var dropBox = $('.cd-dropzone');
            var footerBox = $('.cd-footer');
            var imgBox = $('.cd-img-container');

            var clearButton = $('#cd-clear-bnt');
            var createButton = $('#cd-upload-bnt');
            var cancelButton = $('#cd-cancel-bnt');

            var fileList = [];

            fileInput.bind({
                change: function() {
                    $('#cd-img-list > li').remove();
                    fileList = [];
                    displayFiles(fileList);
                    displayFiles(this.files);
                }
            });

            imgBox.bind({
                dragover: function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    return false;
                },
                drop: function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    var dt = e.originalEvent.dataTransfer;
                    displayFiles(dt.files);
                    return false;
                }
            });

            dropBox.bind({
                dragenter: function() {
                    dropBox.addClass('cd-dropzone-highlighted');
                    return false;
                },
                dragover: function(e) {
                    e.stopPropagation();
                    e.preventDefault();
                    return false;
                },
                dragleave: function() {
                    dropBox.removeClass('cd-dropzone-highlighted');
                    return false;
                },
                drop: function(e) {
                    dropBox.removeClass('cd-dropzone-highlighted');
                    e.stopPropagation();
                    e.preventDefault();
                    var dt = e.originalEvent.dataTransfer;
                    displayFiles(dt.files);
                    return false;
                }
            });

            clearButton.bind({
                click: function(e){
                    e.stopPropagation();
                    $('#cd-img-list > li').remove();
                    fileList = [];
                    displayFiles(fileList);
                }
            });

            createButton.bind({
                click: function(e){
                    e.stopPropagation();
                    alert("Operation started");
                }
            });

            cancelButton.bind({
                click: function(e){
                    e.stopPropagation();
                    alert("Operation canceled");
                }
            });

            function displayFiles(files) {

                $.each(files, function(i, file) {
                    //Check for file type
                    if (!file.type.match(/image.*/)) {
                        return true;
                    }

                    fileList[fileList.length] = file;

                    var li = $('<li/>').appendTo(imgList);
                    var img = $('<img/>').appendTo(li);
                    $('<div/>').text(file.name).appendTo(li);
                    // $('<progress/>').appendTo(li);



                    var reader = new FileReader();
                    reader.onload = (function(aImg) {
                        return function(e) {
                            aImg.attr('src', e.target.result);
                            aImg.attr('max-width', 100);
                            aImg.attr('height', 150);
                        };
                    })(img);

                    reader.readAsDataURL(file);
                });

                var filesSize = 0;
                var fileCount = 0;
                //Count total file size
                $.each(fileList, function(i, file) {
                    filesSize  = filesSize + file.size;
                    fileCount  = fileCount + 1;
                });
                if(filesSize === 0){
                    footerBox.text('No files selected');
                }else{
                    footerBox.text('Selected '+fileCount+' files, total size is ' + (filesSize/(1024*1024)).toFixed(2) + ' MB');
                }
            }

            $(".cd-buttons").mousedown(function() {
                var button = $(this);
                button.addClass('clicked');
                setTimeout(function(){
                    button.removeClass('clicked');
                },50);
            });


        });

    </script>


    <script src="{{asset('assets')}}/js/form.validation.script.js"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $("#form").validate({
            // Specify the validation rules
            rules: {
                title: {
                    required: true,
                    alpha: true
                },
                price: {
                    required: true,
                    number:true,
                    isNull:false,
                },

            },
            // Specify the validation error messages
            messages: {
                title: {
                    required: 'يرجى إدخال اسم المنتج ',
                    alpha: 'يجب ان يتكون اسم الموقع من حروف فقط ',
                },
                price: {
                    required: 'يرجى إدخال السعر  ',
                    isNull: 'يرجى إدخال السعر  ',
                    number: 'يرجى إدخال رقم صحيح'
                },

            },
            submitHandler: function (form) {
                form.submit();
            },
            highlight: function (element) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                $(element).closest('.form-group').find('.glyphicon').removeClass('glyphicon-ok').addClass('glyphicon-remove');
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                $(element).closest('.form-group').find('.glyphicon').removeClass('glyphicon-remove').addClass('glyphicon-ok');
            },
            errorElement: 'span',
            errorClass: 'text-danger',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.closest('.form-group').find('.cke').length) {
                    error.appendTo(element.closest('.form-group'));
                } else {
                    error.insertAfter(element);
                }
            }
        });
    </script>

@endsection
