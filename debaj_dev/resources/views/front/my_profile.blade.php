@extends('front.layouts.app')
<!-- ============ Body content start ============= -->
@section('content')

<div class="page-header">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i> {{ __('front.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('front.my_profile') }}</li>
          </ol>
        </nav>
        <h2>{{ __('front.my_profile') }}</h2>
      </div>
    </div>
  </header>

  <section>
    <div class="container">
      <form id="update_form" onsubmit="update(event);" method="post" enctype="multipart/form-data" class="form">

        <div class="row align-items-center justify-content-center">
          <div class="col-lg-5 col-md-6">
            <div class="avatar">
              <span class="icon"><i class="fas fa-camera"></i></span>
              <input type="file" name="profile_img" id="profile_img" class="input-img">
              @if(empty($user_data->image))
              <img src="{{asset('assets/front/'.app()->getLocale() )}}/img/dynamic/user.png" alt="{{$user_data->username}}" >
              @else
              <img src="{{config('user_storage').$user_data->image}}" alt="{{$user_data->username}}">
              @endif
            </div>
            <label for="full_name">{{ __('front.full_name') }} *</label>
            <input type="text" name="full_name" id="full_name" value="{{$user_data->full_name}}" required class="form-control">

            <label for="user_name">{{ __('front.user_name') }} </label>
            <input type="text" readonly value="{{$user_data->username}}" class="form-control">

            <label for="mail">{{ __('front.mail') }} </label>
            <input type="email"  readonly value="{{$user_data->email}}" class="form-control">

            <label for="phone">{{ __('front.phone') }} *</label>
            <input type="tel" name="phone" id="phone" pattern="[0-9]{11}" value="{{$user_data->phone}}" placeholder="XXX XXX XXX XX" required class="form-control">

            <label for="adress">{{ __('front.adress') }} *</label>
            <input type="text" name="adress" id="adress" required value="{{$user_data->address}}" class="form-control">

            <label for="password">{{ __('front.password') }} </label>
            <input type="password" name="password" id="password"  class="form-control">

            <label for="password_confirmation">{{ __('front.confirm_password') }} *</label>
            <input type="password" name="password_confirmation" id="password_confirmation"  class="form-control">


            <button class="btn btn-second btn-block mt-4 mb-4" type="submit">{{ __('front.update_profile') }}</button>

          </div>
        </div>
      </form>
    </div>
  </section>


<script>
  function update(event)
  {
    if( $("#full_name").val().trim() == ''|| $("#phone").val().trim() == ''
        || $("#adress").val().trim() == '')
    {
      Swal.fire(" {{ __('front.alert_empty_data') }}");
      event.preventDefault();
      return false;
    }
    if($("#password").val().trim() != '')
    {
      if($("#password").val() != $("#password_confirmation").val())
      {

      Swal.fire(" {{ __('front.similar_pass_error') }}");
      event.preventDefault();
      return false;
      }
    }
  //else{
   var formdata = new FormData();
   var fileInput = document.getElementById("profile_img");
   formdata.append("profile_img", fileInput.files[0]);
   formdata.append("_token", "{{ csrf_token() }}");
   var other_data = $("#update_form").serializeArray();
   other_data.forEach(function(fields){
   	formdata.append(fields.name, fields.value);
   });

         $.ajax({
          url: '{{url("update-profile")}}',
          type: 'POST',
          data:formdata,
          async: true,
					cache:false,
					processData: false,
					contentType: false,
          success: function (data) {
            if($.isEmptyObject(data.error)){
                  Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: data.success,
                        showConfirmButton: false,
                        timer: 1500
                      });
                location.href ='{{url("my-profile")}}';
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
        event.preventDefault();
        return true;
  // }
}
</script>
@endsection
