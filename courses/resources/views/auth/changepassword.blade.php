@extends('admin.layouts.nav')
@section('title','Chamge Password')
@section('links')

   {{-- {{$add == 1 ? '':''}} --}}
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card my-5">
                
                <div class="card-header bg-primary " >{{  __('Change Password') }}</div>
                <div class="form-group text-center">
                    @if(Session::has('Success'))
                        <div class="alert alert-success text-center">{{Session::get('Success')}}</div>
                    @endif
                    @php
                    if(Session::get('Success')){
                        Session::forget('Success');
                    }
                    @endphp
        
                    @if(Session::has('Error'))
                        <div class="alert alert-danger text-center">{{Session::get('Error')}}</div>
                    @endif
                    @php
                    if(Session::get('Error')){
                        Session::forget('Error');
                    }
                    @endphp
                </div>
                <form class="form-horizontal " method="POST" action="{{ route('changePassword') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                        <div class="row ">
                            <label for="new-password" class="col-md-4 control-label text-md-right">Current Password</label>

                            <div class="col-md-6 text-left">
                                <input id="current-password" type="password" class="form-control" name="current-password" required>
    
                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                    </div>

                    <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                        <div class="row ">

                            <label for="new-password" class="col-md-4 control-label text-md-right">New Password</label>

                            <div class="col-md-6">
                                <input id="new-password" type="password" class="form-control" name="new-password" required>

                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong class="text-danger">{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="row ">
                            <label for="new-password-confirm" class="col-md-4 control-label text-md-right">Confirm New Password</label>

                            <div class="col-md-6">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-md-10 col-md-offset-2 text-right">
                            <button type="submit" class="btn btn-primary">
                                Change Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')

@endsection
