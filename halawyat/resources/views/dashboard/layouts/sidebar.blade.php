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

            <li class="nav-item" data-item="categories">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Library"></i>
                    <span class="nav-text">  الأقسام </span>
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

        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->

        <!--        start settings control-->
        <ul class="childNav" data-parent="settings">

            <li class="nav-item">
                <a href="{{url('dashboard/setting/edit/about_us')}}">
                    <i class="nav-icon i-Gear text-primary"></i>
                    <span class="item-name">عن التطبيق  </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('dashboard/setting/edit/terms_and_conditions')}}">
                    <i class="nav-icon i-Gear text-primary"></i>
                    <span class="item-name"> الشروط والاحكام </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('dashboard/setting/edit/contact')}}">
                    <i class="nav-icon i-Gear text-primary"></i>
                    <span class="item-name"> معلومات التواصل </span>
                </a>
            </li>

        </ul>
<!--        start admin control-->
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
                <a href="{{url('dashboard/user/all')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">المستخدمين </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('dashboard/vendors/all')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">مقدمين الخدمة </span>
                </a>
            </li>

        </ul>

        <!--        start categories control-->
        <ul class="childNav" data-parent="categories">
            <li class="nav-item">
                <a href="{{url('dashboard/category/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة الأقسام الرئيسية  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/category/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة قسم رئيسي </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/category/minors/all')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة الأقسام الفرعية </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/category/minors/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة قسم فرعي </span>
                </a>
            </li>
        </ul>


    </div>
    <div class="sidebar-overlay"></div>
</div>
