
@extends('user.en.layouts.lay') @section('title','banks account') @section('links')

<link rel="stylesheet" href="{{url('assets-en/css/bootstrap.min.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/Base.css')}}" />
<link rel="stylesheet" href="{{url('assets-en/css/premium.css')}}" />
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" />
<link rel="stylesheet" href="{{url('assets-en/css/reservation.css')}}" />


@endsection
@section('content')


<header>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="banner">
              {{-- <h2>About-US</h2> --}}
              <span class="text-light">Home / <span>Bank Account</span>
          </div>
        </div>
      </div>
    </div>
  </header>
<section class="reservation">
    <div class="container">
        <div class="row">
            <div class="col-md-9 mx-auto">
                @foreach ($accounts as $account)
                    <div class="card my-3" >
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th class="text-warning" scope="col">Bank Name</th>
                                <td scope="col">{{ $account->bank_name }}</td>
                            </tr>
                            <tr>
                                <th class="text-warning" scope="col">Account Name</th>
                                <td scope="col">{{ $account->account_name }}</td>
                            </tr>
                            <tr>
                                <th class="text-warning" scope="col">Account Number</th>
                                <td scope="col">{{ $account->account_number }}</td>
                            </tr>
                            <tr>
                                <th class="text-warning" scope="col">Statement</th>
                                <td scope="col">{{ $account->statement }}</td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

@endsection @section('scripts')
<script src="{{url('assets-en/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{url('assets-en/js/popper.min.js')}}"></script>
<script src="{{url('assets-en/js/bootstrap.min.js')}}"></script>
<script src="{{url('assets-en/js/main.js')}}"></script>

@endsection
