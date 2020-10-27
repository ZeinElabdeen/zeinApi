<body class="text-left">
<div class="app-admin-wrap layout-sidebar-large clearfix">
<div class="side-content-wrap">
    <div class="sidebar-left open rtl-ps-none" data-perfect-scrollbar data-suppress-scroll-x="true">
        <ul class="navigation-left">
            <li class="nav-item active" data-item="">
                <a class="nav-item-hold" href="{{url('dashboard/home')}}">
                    <!--<i class="nav-icon i-Bar-Chart"></i> -->
                    <span class="nav-text">الرئيسية</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="categories">
                <a class="nav-item-hold" href="#">
                    <!--<i class="nav-icon i-Library"></i>-->
                    <span class="nav-text">  الأقسام </span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="colors">
                <a class="nav-item-hold" href="#">
                    <span class="nav-text">  الالوان </span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('dashboard/product/index')}}">
                    <!--<i class="nav-icon i-Flag-2"></i>  -->
                    <span class="nav-text">  المنتجات </span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="salecodes">
                <a class="nav-item-hold" href="#">
                    <!--<i class="nav-icon i-Flag-2"></i> -->
                    <span class="nav-text">  اكواد الخصم </span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('dashboard/ad/index')}}">
                     <span class="nav-text"> سليدر الاعلانات</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('dashboard/faq/index')}}">
                    <!--<i class="nav-icon i-Bar-Chart"></i>-->
                    <span class="nav-text"> الأسئلة الشائعة </span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="">
                <a class="nav-item-hold" href="{{url('dashboard/contact-messages')}}">
                    <span class="nav-text">  رسائل التواصل </span>
                </a>
                <div class="triangle"></div>
            </li>
            <li class="nav-item" data-item="users">
                <a class="nav-item-hold" href="#">
                  <!--  <i class="nav-icon i-Find-User"></i>-->
                    <span class="nav-text">المستخدمين </span>
                </a>
                <div class="triangle"></div>
            </li>


            <li class="nav-item" data-item="general">
                <a class="nav-item-hold" href="#">
                    <!--<i class="nav-icon i-Gear"></i>-->
                    <span class="nav-text"> اعدادات الموقع</span>
                </a>
                <div class="triangle"></div>
            </li>

            <li class="nav-item" data-item="admins">
                <a class="nav-item-hold" href="#">
                    <!--<i class="nav-icon i-Add-UserStar"></i>-->
                    <span class="nav-text">المديرين  </span>
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

      <!--  start admin control-->
              <ul class="childNav" data-parent="general">

                  <li class="nav-item">
                      <a href="{{url('dashboard/general/settings')}}">
                          <i class="nav-icon i-Add-User text-primary"></i>
                          <span class="item-name">اعدات السيو</span>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{url('dashboard/general/contact-data')}}">
                          <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                          <span class="item-name">بيانات اتصل بنا </span>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{url('dashboard/general/social-pages')}}">
                          <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                          <span class="item-name">صفحات السوشيال </span>
                      </a>
                  </li>

                  <li class="nav-item">
                      <a href="{{url('dashboard/general/about-us')}}">
                          <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                          <span class="item-name"> من نحن </span>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="{{url('dashboard/general/terms-and-conditions')}}">
                          <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                          <span class="item-name">  الشروط والاحكام </span>
                      </a>
                  </li>

              </ul>


        <!--        start user control-->
        <ul class="childNav" data-parent="users">
            <li class="nav-item">
                <a href="{{url('dashboard/users/clients')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">العملاء </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/users/vendors')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name"> مقدمين الخدمات </span>
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
        <ul class="childNav" data-parent="colors">
            <li class="nav-item">
                <a href="{{url('dashboard/colors/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة الألوان </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/colors/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة لون </span>
                </a>
            </li>
        </ul>
        <!--        start proudects control-->
      <!--  <ul class="childNav" data-parent="proudects">
            <li class="nav-item">
                <a href="{{url('dashboard/product/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة المنتجات  </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/product/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة منتج  </span>
                </a>
            </li>
        </ul> -->

        <!--        start salecodes control-->
        <ul class="childNav" data-parent="salecodes">
            <li class="nav-item">
                <a href="{{url('dashboard/salecodes/index')}}">
                    <i class="nav-icon i-Split-Horizontal-2-Window text-primary"></i>
                    <span class="item-name">قائمة اكواد الخصم </span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('dashboard/salecodes/create')}}">
                    <i class="nav-icon i-Add text-primary"></i>
                    <span class="item-name">اضافة كود خصم</span>
                </a>
            </li>
        </ul>

    </div>
    <div class="sidebar-overlay"></div>
</div>
