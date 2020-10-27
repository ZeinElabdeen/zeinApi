<div class="main-header">
    <div class="logo">
        <img src="{{asset('assets/images')}}/logo.png" alt="">
    </div>

    <div class="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <div>
      <a href="{{url('/')}}" target="_blank" >
        تصفح الموقع
      </a>
    </div>



    <div style="margin: auto"></div>

    <div class="header-part-right">
        <!-- Full screen toggle -->
        <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
        <!-- Grid menu Dropdown -->

        <!-- User avatar dropdown -->
        <div class="dropdown">
            <div class="user col align-self-end">
                <i class="i-Gear-2" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 23px;cursor: pointer;"></i>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <div class="dropdown-header">
                      <a href="{{url('vendor/dashboard/my-profile')}}">
                        <i class="i-Lock-User mr-1"></i> {{auth('users')->user()->username}}
                      </a>  
                    </div>
                    <a class="dropdown-item" href="{{url('vendor/dashboard/change-password')}}">تعديل كلمة المرور</a>
                    <a class="dropdown-item" href="{{url('vendor/dashboard/logout')}}">تسجيل خروج</a>
                </div>
            </div>
        </div>
    </div>

</div>
