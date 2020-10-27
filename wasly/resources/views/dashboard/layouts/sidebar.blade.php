<body class="text-left">
<div class="app-admin-wrap layout-sidebar-large clearfix">
<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item active" data-item="">
                <a class="nav-item-hold" href="{{url('dashboard')}}">
                    <i class="nav-icon i-Bar-Chart"></i>
                    <span class="nav-text">الرئيسية</span>
                </a>
                <div class="triangle"></div>
            </li>
            @if(auth('admin')->user()->role == 1)
                <li class="nav-item" data-item="admins">
                    <a class="nav-item-hold" href="#">
                        <i class="nav-icon i-Add-UserStar"></i>
                        <span class="nav-text">المديرين  </span>
                    </a>
                    <div class="triangle"></div>
                </li>

            <li class="nav-item" data-item="users">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Find-User"></i>
                    <span class="nav-text">المستخدمين  </span>
                </a>
                <div class="triangle"></div>
            </li>
       @endif
            <li class="nav-item" data-item="order">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Split-Horizontal-2-Window"></i>
                    <span class="nav-text">الطلبات  </span>
                </a>
                <div class="triangle"></div>
            </li>
      @if(auth('admin')->user()->role == 1)
            <li class="nav-item" data-item="brands">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Library"></i>
                    <span class="nav-text">  البراندات </span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="categories">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Library"></i>
                    <span class="nav-text">  الأقسام </span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="cities">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Flag-2"></i>
                    <span class="nav-text">  العناوين </span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="ads">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Flag-2"></i>
                    <span class="nav-text">  الإعلانات </span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="coupons">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Flag-2"></i>
                    <span class="nav-text">  كوبونات الخصم </span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item active" data-item="">
                <a class="nav-item-hold" href="{{url('dashboard/notification/create')}}">
                    <i class="nav-icon i-Mail"></i>
                    <span class="nav-text">الإشعارات</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('dashboard/contact-messages')}}">
                    <i class="nav-icon i-Flag-2"></i>
                    <span class="nav-text">  رسائل التواصل </span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="settings">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Gear"></i>
                    <span class="nav-text">  الاعدادات العامة</span>
                </a>
                <div class="triangle"></div>
            </li>
       @endif
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->

        <!--        start settings control-->
        <ul class="childNav" data-parent="settings">
          <!--  <li class="nav-item">
                <a href="{{url('dashboard/setting/contacts')}}">
                    <i class="nav-icon i-Gear text-primary"></i>
                    <span class="item-name"> ارقام التواصل </span>
                </a>
            </li> -->
            <li class="nav-item">
                <a href="{{url('dashboard/setting/about_us')}}">
                    <i class="nav-icon i-Gear text-primary"></i>
                    <span class="item-name">عن التطبيق  </span>
                </a>

                <a href="{{url('dashboard/setting/terms_and_conditions')}}">
                    <i class="nav-icon i-Gear text-primary"></i>
                    <span class="item-name">الشروط والاحكام </span>
                </a>

                <a href="{{url('dashboard/setting/contacts')}}">
                    <i class="nav-icon i-Gear text-primary"></i>
                    <span class="item-name"> معلومات التواصل </span>
                </a>

            </li>

        </ul>
<!--        start admin control-->
        @if(auth('admin')->user()->role == 1)

            <ul class="childNav" data-parent="admins">
                <li class="nav-item">
                    <a href="{{url('dashboard/admin/create')}}">
                        <i class="nav-icon i-Add-User text-primary"></i>
                        <span class="item-name">اضافة مدير </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('dashboard/admin/index')}}">
                        <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                        <span class="item-name">قائمة المديرين </span>
                    </a>
                </li>
            </ul>

        <!--        start user control-->
        <ul class="childNav" data-parent="users">
            <li class="nav-item">
                <a href="{{url('dashboard/user/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة المستخدمين </span>
                </a>
            </li>


        </ul>
  @endif
        <!--        start order control-->
        <ul class="childNav" data-parent="order">
            <li class="nav-item">
                <a href="{{url('dashboard/order/new')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">طلبات جديدة </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('dashboard/order/confirmed')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">تم تأكيدها </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('dashboard/order/underway')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">تم شحنها </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('dashboard/order/delivered')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">تم توصيلها </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('dashboard/order/canceled')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">طلبات ملغية</span>
                </a>
            </li>

        </ul>
    @if(auth('admin')->user()->role == 1)
        <!--        start categories control-->
        <ul class="childNav" data-parent="categories">
            <li class="nav-item">
                <a href="{{url('dashboard/category/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة الأقسام  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/category/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة قسم  </span>
                </a>
            </li>
        </ul>
        <!--        start brands control-->

        <ul class="childNav" data-parent="brands">
            <li class="nav-item">
                <a href="{{url('dashboard/brand/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة البراندات  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/brand/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة براند  </span>
                </a>
            </li>
            <!--        start classifications control-->
            <li class="nav-item">
                <a href="{{url('dashboard/classification/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة التصنيفات  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/classification/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة تصنيف  </span>
                </a>
            </li>

            <!--        start items control-->
            <li class="nav-item">
                <a href="{{url('dashboard/item/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة المنتجات  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/item/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة منتج  </span>
                </a>
            </li>
        </ul>
        <!--        start cities control-->
        <ul class="childNav" data-parent="cities">
            <li class="nav-item">
                <a href="{{url('dashboard/state/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة المحافظات  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/state/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة محافظة  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/city/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة المدن  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/city/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة مدينة  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/village/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة القرى  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/village/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة قرية  </span>
                </a>
            </li>
        </ul>
        <!--        start cities control-->
        <ul class="childNav" data-parent="ads">
            <li class="nav-item">
                <a href="{{url('dashboard/ad/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة الإعلانات  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/ad/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة إعلان  </span>
                </a>
            </li>
        </ul>

        <!--        start cities control-->
        <ul class="childNav" data-parent="coupons">
            <li class="nav-item">
                <a href="{{url('dashboard/coupon/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة الكوبونات  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/coupon/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة كوبون  </span>
                </a>
            </li>
        </ul>
      @endif
    </div>
    <div class="sidebar-overlay"></div>
</div>
