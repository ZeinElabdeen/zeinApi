<!DOCTYPE html>

<html direction="rtl" dir="rtl" style="direction: rtl">

<!-- begin::Head -->
<head>
    <base href="../../../">
    <meta charset="utf-8" />
    <title>Mashroby | تسجيل الدخول </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Asap+Condensed:500">

    <!--end::Fonts -->

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="{{asset("dashboard_assets/css/pages/login/login-3.rtl.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{asset("dashboard_assets/css/style.bundle.rtl.css")}}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles -->

    <!--begin::Layout Skins(used by all pages) -->

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="{{asset("dashboard_assets/media/logos/favicon.ico")}}" />
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-page-content-white kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url({{asset("dashboard_assets/media/bg/bg-3.jpg")}});">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                <div class="kt-login__container">
                    <div class="kt-login__logo">
                        <a href="#">
                            <img src="{{asset("dashboard_assets/media/logos/logo-5.png")}}">
                        </a>
                    </div>
                    <div class="kt-login__signin">
                        <div class="kt-login__head">
                            <h3 class="kt-login__title">الدخول الى لوحة التحكم</h3>
                        </div>
                        <!--display login errors-->
                        @if(session()->has('message'))

                            <span class="invalid-feedback" role="alert" style="display:inline-block">
                                <strong>{{ session()->get('message') }}</strong>
                            </span>
                        @elseif(session()->has('success'))
                            <span class="valid-feedback" role="alert" style="display:inline-block">
                                <strong>{{ session()->get('success') }}</strong>
                            </span>
                        @endif
                        <form class="kt-form" method="post" action="{{url('admin/login_post')}}">
                            @csrf
                            <div class="input-group">
                                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" placeholder="البريد الإلكتروني" name="email" autocomplete="off">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>البريد الالكتروني مطلوب ويجب ان يكون صالح</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-group">
                                <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="كلمة المرور" name="password">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>كلمه المرور مطلوبه ويجب ان لا تقل عن 8 حروف او ارقام</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row kt-login__extra">
                                <div class="col">
                                    <label class="kt-checkbox">
                                        <input type="checkbox" name="remember"> تذكرني
                                        <span></span>
                                    </label>
                                </div>
                                <div class="col kt-align-right">
                                    <a href="{{url('admin/forget-password')}}" id="kt_login_forgot" class="kt-login__link">نسيت كلمة المرور</a>
                                </div>
                            </div>
                            <div class="kt-login__actions">
                                <button type="submit" id="kt_login_signin_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">تسجيل الدخول</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "light": "#ffffff",
                "dark": "#282a3c",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin::Global Theme Bundle(used by all pages) -->

<!--begin:: Vendor Plugins -->
<script src="{{asset("dashboard_assets/plugins/general/jquery/dist/jquery.js")}}" type="text/javascript"></script>
<script src="{{asset("dashboard_assets/plugins/general/popper.js/dist/umd/popper.js")}}" type="text/javascript"></script>
<script src="{{asset("dashboard_assets/plugins/general/bootstrap/dist/js/bootstrap.min.js")}}" type="text/javascript"></script>

<!--begin::Page Scripts(used by this page) -->
{{--<script src="{{asset("dashboard_assets/js/pages/custom/login/login-general.js")}}" type="text/javascript"></script>--}}

<!--end::Page Scripts -->
</body>

<!-- end::Body -->
</html>
