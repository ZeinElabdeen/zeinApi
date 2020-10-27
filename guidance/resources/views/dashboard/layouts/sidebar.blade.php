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

            <li class="nav-item" data-item="car_models">
                <a class="nav-item-hold" href="#">
                    <span class="nav-text"> موديلات السيارات  </span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="car_types">
                <a class="nav-item-hold" href="#">
                    <span class="nav-text"> انواع السيارات  </span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="reasons">
                <a class="nav-item-hold" href="#">
                    <span class="nav-text"> أسباب الرفض  </span>
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

            <li class="nav-item" data-item="salecodes">
                <a class="nav-item-hold" href="#">
                    <!--<i class="nav-icon i-Flag-2"></i> -->
                    <span class="nav-text">  اكواد الشحن </span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('dashboard/contact-messages')}}">
                 
                    <span class="nav-text"> رسائل التواصل </span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('dashboard/setting/edit/rate_percent')}}">

                    <span class="nav-text"> نسبة الشركة من الطلبات </span>
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
                <a href="{{url('dashboard/setting/edit/terms_and_conditions')}}">
                    <i class="nav-icon i-Gear text-primary"></i>
                    <span class="item-name">الشروط والاحكام </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('dashboard/setting/edit/about_us')}}">
                    <i class="nav-icon i-Gear text-primary"></i>
                    <span class="item-name">من نحن </span>
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
                    <span class="item-name"> السائقين </span>
                </a>
            </li>

        </ul>
        <!--        start car_models control-->
        <ul class="childNav" data-parent="car_models">
            <li class="nav-item">
                <a href="{{url('dashboard/car_models/all')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة الموديلات </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('dashboard/car_models/create')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name"> أضافة موديل </span>
                </a>
            </li>

        </ul>
        <!--        start car_types control-->
        <ul class="childNav" data-parent="car_types">
            <li class="nav-item">
                <a href="{{url('dashboard/car_types/all')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name"> قائمة الانواع </span>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{url('dashboard/car_types/create')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name"> أضافة  نوع </span>
                </a>
            </li>

        </ul>

        <!--        start cancel reasons control-->
        <ul class="childNav" data-parent="reasons">

            <li class="nav-item">
                <a href="{{url('dashboard/reasons/1')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name"> قائمة اسباب العميل </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/reasons/2')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name"> قائمة اسباب السائقين </span>
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
                    <span class="item-name"> اضافة إعلان  </span>
                </a>
            </li>
        </ul>

        <!--        start salecodes control-->
      <ul class="childNav" data-parent="salecodes">
          <li class="nav-item">
              <a href="{{url('dashboard/salecodes/index')}}">
                  <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                  <span class="item-name"> قائمة اكواد الشحن </span>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{url('dashboard/salecodes/create')}}">
                  <i class="nav-icon i-Add text-primary"></i>
                  <span class="item-name"> اضافة كود شحن </span>
              </a>
          </li>
      </ul>

    </div>
    <div class="sidebar-overlay"></div>
</div>
