@extends('front.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')

<div class="page-header">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i> {{ __('front.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('front.my_account') }}</li>
          </ol>
        </nav>
        <h2>{{ __('front.login') }}</h2>
      </div>
    </div>
  </header>

  <section>
    <div class="container">
      <form id="login_form" onsubmit="login(event);" class="form">
        <div class="row align-items-center justify-content-center">
          <div class="col-lg-5 col-md-6">

            <label for="username"> {{ __('front.username') }}*</label>
            <input type="email" name="username" id="username" class="form-control">

            <label for="password">{{ __('front.password') }} *</label>
            <input type="password" name="password" id="password" class="form-control">

            <div class="input-form d-flex justify-content-between">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="remember" name="remember" >
                <label class="custom-control-label" for="remember">{{ __('front.remember') }}</label>
              </div>
              <div><a href="">{{ __('front.password_forget') }}</a></div>
            </div>

            <button class="btn btn-second btn-block mt-4 mb-4" type="submit">{{ __('front.login') }}</button>
            <div class="text-center">
              <a class="btn btn-second" href="{{url('register')}}">{{ __('front.register') }}</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>
  <script>
    function login(event)
    {
        if( $("#username").val().trim() == '' || $("#password").val().trim() == '')
        {
          Swal.fire(" {{ __('front.alert_empty_data') }}");
          event.preventDefault();
          return false;
        }
        else
        {
           var data = $('#login_form').serializeArray();
           data.push({name: "_token", value: "{{ csrf_token() }}"});
           $.ajax({
            url: '{{url("login")}}',
            type: 'POST',
            data:data,
            async: false,
            success: function (data) {
              if($.isEmptyObject(data.error)){
                  if($.isEmptyObject(data.red_url)){
                    Swal.fire(data.success);
                  }else{
                    location.href ='{{url("")}}'+data.red_url;
                  }
                }else{
                  var error_msg = '';
                  $.each( data.error, function( key, value ) {
                    error_msg = error_msg+value+'<br/><br/>';
                  });
                  Swal.fire(error_msg);
                }
              } ,
              error:function (xhr, ajaxOptions, thrownError){
                var ret = JSON.parse(xhr.responseText);
                Swal.fire(ret);
              }
          });

           //$('#login_form').trigger("reset");
           event.preventDefault();
           return true;
        }
    }
  </script>
@endsection
