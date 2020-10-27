<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

    <title>Debaj Vendor Panel</title>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Cairo');
       *{
           font-family: 'Cairo', sans-serif ;
       }
   </style>
    <link href="{{asset('assets/images/favicon.ico')}}" rel="icon">
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link href="https://cdn.quilljs.com/1.0.5/quill.snow.css" rel="stylesheet">
    <link id="gull-theme" rel="stylesheet" href="{{asset('assets')}}/styles/css/themes/lite-blue.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/styles/vendor/perfect-scrollbar.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets')}}/styles/vendor/sweetalert2.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/styles/vendor/datatables.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/styles/css/themes/lite-blue.min.css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/monokai-sublime.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets')}}/styles/vendor/quill.bubble.css">
    <link rel="stylesheet" href="{{asset('assets')}}/styles/vendor/quill.snow.css">
    <link rel="stylesheet" href="{{asset('tagsinputs')}}/bootstrap-tagsinput.css">

{{--    <link rel="stylesheet" href="{{asset('assets')}}/styles/vendor/dropzone.min.css">--}}
    <style>
        div.dataTables_wrapper div.dataTables_filter {
            text-align: left !important;
        }

    </style>
@yield('css')
</head>
