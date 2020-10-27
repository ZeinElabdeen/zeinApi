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

            <li class="nav-item" data-item="categories">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Library"></i>
                    <span class="nav-text">  الأقسام </span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="questions">
                <a class="nav-item-hold" href="#">
                    <i class="nav-icon i-Library"></i>
                    <span class="nav-text">  الأسئلة </span>
                </a>
                <div class="triangle"></div>
            </li>
        </ul>
    </div>

    <div class="sidebar-left-secondary rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <!-- Submenu Dashboards -->
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

        <!--        start categories control-->
        <ul class="childNav" data-parent="questions">
            <li class="nav-item">
                <a href="{{url('dashboard/question/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة الأسئلة  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/question/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة سؤال  </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('dashboard/question/import-execl')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name"> اضافة الاسئله من ملف excel  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/question/import-images')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name"> رفع صور الاسئله </span>
                </a>
            </li>
        </ul>

    </div>
    <div class="sidebar-overlay"></div>
</div>
