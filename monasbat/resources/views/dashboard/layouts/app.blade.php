@include('dashboard.layouts.head')
@include('dashboard.layouts.header')
@include('dashboard.layouts.sidebar')

<div class="main-content-wrap sidenav-open d-flex flex-column">

@yield('content')
</div>

@include('dashboard.layouts.footer')
