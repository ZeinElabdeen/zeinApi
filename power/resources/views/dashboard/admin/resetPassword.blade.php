<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Saudi Clubs | Login</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,400i,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("assets/styles/css/themes/lite-purple.min.css")}}">
</head>

<body class="text-right">
<div class="auth-layout-wrap" style="background-image: url({{asset('assets/images/photo-wide-4.jpg')}})">
    <div class="auth-content">
        <div class="card o-hidden" >
            <div class="row align-content-center">
                <div class="col-md-12 text-center">
                    <div class="p-4">
                        <div class="auth-logo text-center mb-4">
                            <img src="{{asset("assets/images/logo.png")}}" alt=""/>
                        </div>
                        <h1 class="mb-3 text-18" style="color: #5504a5;">إستعادة كلمة المرور</h1>
                        @include('dashboard.layouts.message')
                        <form action="{{route('admin.resetPassword.post')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="password" style="color: #5504a5;">كلمة المرور</label>
                                <input id="password" name="password" class="form-control form-control-rounded" type="password">
                                @if ($errors->has('password'))
                                    <span class="text-danger" role="alert">
                                        <strong>كلمه المرور مطلوبه ويجب ان لا تقل عن 8 حروف او ارقام</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password" style="color: #5504a5;">تأكيد كلمة المرور</label>
                                <input id="password" name="password_confirmation" class="form-control form-control-rounded" type="password">
                                @if ($errors->has('password_confirmation'))
                                    <span class="text-danger" role="alert">
                                        <strong>يجب تأكيدكلمة المرور</strong>
                                    </span>
                                @endif
                            </div>

                            <button class="btn btn-rounded btn-primary btn-block mt-2">تأكيد</button>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="{{asset("assets/js/vendor/jquery-3.3.1.min.js")}}"></script>
<script src="{{asset("assets/js/vendor/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("assets/js/es5/script.min.js")}}"></script>
</body>

</html>
