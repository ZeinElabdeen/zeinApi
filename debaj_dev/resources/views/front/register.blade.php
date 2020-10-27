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
        <h2>{{ __('front.register') }}</h2>
      </div>
    </div>
  </header>

  <section>
    <div class="container">
      <form id="register_form" onsubmit="register(event);" method="post" class="form">

        <div class="row align-items-center justify-content-center">
          <div class="col-lg-5 col-md-6">

            <label for="full_name">{{ __('front.full_name') }} *</label>
            <input type="text" name="full_name" id="full_name" required class="form-control">

            <label for="user_name">{{ __('front.user_name') }} *</label>
            <input type="text" name="user_name" id="user_name" required class="form-control">

            <label for="mail">{{ __('front.mail') }} *</label>
            <input type="email" name="mail" id="mail" required class="form-control">

            <label for="phone">{{ __('front.phone') }} *</label>
            <input type="tel" name="phone" id="phone" pattern="[0-9]{11}" placeholder="XXX XXX XXX XX" required class="form-control">

            <label for="adress">{{ __('front.adress') }} *</label>
            <input type="text" name="adress" id="adress" required class="form-control">

            <label for="password">{{ __('front.password') }} *</label>
            <input type="password" name="password" id="password" required class="form-control">

            <label for="password_confirmation">{{ __('front.confirm_password') }} *</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required class="form-control">

            <div class="input-form">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" value="1" id="is_seller" name="is_seller" >
                <label class="custom-control-label" for="is_seller">{{ __('front.is_seller') }}</label>
              </div>
            </div>

            <button class="btn btn-second btn-block mt-4 mb-4" type="submit">{{ __('front.register') }}</button>
            <div class="text-center">
              <a class="btn" href="{{url('my-account')}}">{{ __('front.login') }}</a>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>


<script>
  function register(event)
  {
    if( $("#full_name").val().trim() == '' || $("#user_name").val().trim() == ''
     || $("#mail").val().trim() == ''
     || $("#phone").val().trim() == '' || $("#adress").val().trim() == ''
     || $("#password").val().trim() == '' || $("#password_confirmation").val().trim() == '')
    {
      Swal.fire(" {{ __('front.alert_empty_data') }}");
      event.preventDefault();
      return false;
    }
    else if( $("#password").val() != $("#password_confirmation").val() )
    {
      Swal.fire(" {{ __('front.similar_pass_error') }}");
      event.preventDefault();
      return false;
    }
     else{
        var data = $("#register_form").serializeArray();
        data.push({name: "_token", value: "{{ csrf_token() }}"});
         $.ajax({
          url: '{{url("register")}}',
          type: 'POST',
          data:data,
          async: false,
          success: function (data) {
            if($.isEmptyObject(data.error)){
                //  Swal.fire(data.success);
                  Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: data.success,
                        showConfirmButton: false,
                        timer: 1500
                      });
                location.href ='{{url("my-account")}}';
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
              //console.log(ret.errors.submail);
              Swal.fire(ret);
            }
        });

        $('#register_form').trigger("reset");
        event.preventDefault();
        return true;
   }
}
</script>
@endsection
