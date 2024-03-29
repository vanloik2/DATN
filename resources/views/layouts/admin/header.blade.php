<div class="header">
    <div class="logo logo-dark">
        <a href="{{ route('index') }}" class="text-center">
            <img src="{{ asset('assets/images/logo/BeeFood.png') }}" class="mx-auto" width="60%" alt="Logo">
            <img class="logo-fold" src="{{ asset('assets/images/logo/BeeFood.png') }}" alt="Logo">
        </a>
    </div>
    <div class="logo logo-white">
        <a href="{{ route('index') }}">
            <img src="{{ asset('assets/images/logo/BeeFood.png') }}" width="60%" alt="Logo">
            <img class="logo-fold" src="{{ asset('assets/images/logo/BeeFood.png') }}}" alt="Logo">
        </a>
    </div>
    <div class="nav-wrap">
        <ul class="nav-left">
            <li class="desktop-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
            <li class="mobile-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#search-drawer">
                    <i class="anticon anticon-search"></i>
                </a>
            </li>
        </ul>
        <ul class="nav-right">
            <li class="dropdown dropdown-animated scale-left">
                <a class="toggle-notify" href="javascript:void(0);" data-toggle="dropdown">
                    <i class="anticon anticon-bell notification-badge"></i>
                    <div class="show-notify" style="display:none;position: absolute;top: 10px;font-size: 14px;background-color: #34c4fe;color: #fff;height: 10px;width: 10px;border-radius: 50%;right: 17px;"></div>
                </a>
                <div class="dropdown-menu pop-notification" style="width:450px">
                    <div class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
                        <p class="text-dark font-weight-semibold m-b-0">
                            <i class="anticon anticon-bell"></i>
                            <span class="m-l-10">Thông báo</span>
                        </p>
                        <a class="btn-sm btn-default btn" href="/notifies">
                            <small>Tất cả</small>
                        </a>
                    </div>
                    <div class="relative">
                        <div class="overflow-y-auto relative scrollable" style="max-height: 300px" id="innerNotify">
                            {!! \App\Helpers\Helper::notifies() !!}
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown dropdown-animated scale-left">
                <div class="pointer" data-toggle="dropdown">
                    <div class="avatar avatar-image  m-h-10 m-r-15">
                        <img src="{{ Auth::user()->avatar }}" alt="">
                    </div>
                </div>
                <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                    <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                        <div class="d-flex m-r-50">
                            <div class="avatar avatar-lg avatar-image">
                                <img src="{{ Auth::user()->avatar }}" alt="">
                            </div>
                            <div class="m-l-10">
                                <p class="m-b-0 text-dark font-weight-semibold"></p>
                                <p class="m-b-0 opacity-07">{{ Auth::user()->name }}</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('logout') }}" class="dropdown-item d-block p-h-15 p-v-10">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                <span class="m-l-10">Đăng xuất</span>
                            </div>
                            <i class="anticon font-size-10 anticon-right"></i>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>
