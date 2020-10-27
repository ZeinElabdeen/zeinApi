@include('vendor.layouts.head')
@include('vendor.layouts.header')
@include('vendor.layouts.sidebar')

<div class="main-content-wrap sidenav-open d-flex flex-column">

@yield('content')
</div>

@include('vendor.layouts.footer')
