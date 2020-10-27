@extends('admin.layouts.nav')
@php
    $flag = 0 ;
    if(isset($showAcc))
    $flag = 1;
@endphp
@section('title',$flag ? 'edit account':'add account')

@section('content')
<section class="content my-2">
    <div class="container-fluid">
        <div class="row">
        <!-- left column -->
            <div class="col-md-6 mx-auto">
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
                <!-- general form elements -->
                <div class="card card-primary">

                    <div class="card-header">
                    <h3 class="card-title">{{ $flag ? 'Edit Bank Account' :  'Add Bank Account' }} </h3>
                    </div>

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" method="POST" action="{{ $flag ? url('admin/bankAccount/'.$showAcc->account_id) : url('admin/bankAccount') }}" enctype="multipart/form-data">
                        @csrf
                        @if ($flag)
                            @method('put')
                        @endif

                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="exampleInputEmail1">Account Name</label>
                                <input type="text" class="form-control @error('account_name') is-invalid @enderror" id="exampleInputEmail1" name="account_name" placeholder="Enter account name" value="{{$flag ? $showAcc->account_name : old('account_name')}}">
                                @if ($errors->has('account_name'))
                                <p class='text-danger'>{{$errors->first('account_name')}}</p>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Account Number</label>
                            <input type="number" class="form-control @error('account_number') is-invalid @enderror" id="exampleInputEmail1" name="account_number" placeholder="Enter account number" value="{{$flag ? $showAcc->account_number : old('account_number')}}">
                            @if ($errors->has('account_number'))
                                <p class='text-danger'>{{$errors->first('account_number')}}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Bank Name</label>
                            <input type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" placeholder="Enter Bank Name" value="{{ $flag ? $showAcc->bank_name : old('bank_name')}}">
                            @if ($errors->has('bank_name'))
                            <p class='text-danger'>{{$errors->first('bank_name')}}</p>
                            @endif
                        </div>
                        <div class="form_group">
                            <label for="exampleInputPassword1" class="d-block"> Statement </label>
                            <input type="number" class="form-control @error('statement') is-invalid @enderror" name="statement" placeholder="Enter Statement" value="{{ $flag ? $showAcc->statement : old('statement')}}">
                            @if ($errors->has('statement'))
                            <p class='text-danger'>{{$errors->first('statement')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer {{ $flag ? 'text-right' : '' }}">
                        <button type="submit" class="btn {{ $flag ? 'btn-success' : 'btn-primary' }} ">{{ $flag ? 'Update' : 'Submit' }}</button>
                    </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
      </div>
    </div>
</section>

@endsection
