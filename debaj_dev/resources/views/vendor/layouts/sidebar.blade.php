<body class="text-left">
<div class="app-admin-wrap layout-sidebar-large clearfix">
<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item active" data-item="">
                <a class="nav-item-hold" href="{{url('vendor/dashboard')}}">
                    <!--<i class="nav-icon i-Bar-Chart"></i> -->
                    <span class="nav-text">الرئيسية</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="proudects">
                <a class="nav-item-hold" href="#">
                    <!--<i class="nav-icon i-Flag-2"></i>  -->
                    <span class="nav-text">  المنتجات </span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('vendor/dashboard/product/orders/new')}}">
                    <span class="nav-text"> الطلبات الجديدة </span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('vendor/dashboard/product/orders/confirmed')}}">
                    <span class="nav-text"> طلبات تم تاكيدها </span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('vendor/dashboard/product/orders/inshipping')}}">
                    <span class="nav-text"> طلبات في الشحن </span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('vendor/dashboard/product/orders/delivered')}}">
                    <span class="nav-text"> طلبات تم توصيلها</span>
                </a>
                <div class="triangle"></div>
            </li>


            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('vendor/dashboard/product/comments')}}">
                    <span class="nav-text"> التقيمات</span>
                </a>
                <div class="triangle"></div>
            </li>

          <!--  <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('vendor/dashboard/orders/new')}}">
                    <span class="nav-text">طلبات جديدة</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('vendor/dashboard/orders/confirmed')}}">
                    <span class="nav-text">طلبات  في  انتظار الشحن</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('vendor/dashboard/orders/inshipping')}}">
                    <span class="nav-text">طلبات  في الشحن</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('vendor/dashboard/orders/done')}}">
                    <span class="nav-text">طلبات  تم تسليمها</span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('vendor/dashboard/orders/canceled')}}">
                    <span class="nav-text">طلبات  تم الغاءها</span>
                </a>
                <div class="triangle"></div>
            </li> -->

        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->

        <!--        start proudects control-->
        <ul class="childNav" data-parent="proudects">
            <li class="nav-item">
                <a href="{{url('vendor/dashboard/product/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة المنتجات  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('vendor/dashboard/product/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة منتج  </span>
                </a>
            </li>
        </ul>



    </div>
    <div class="sidebar-overlay"></div>
</div>
