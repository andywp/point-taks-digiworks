<div class="dlabnav">
    <div class="dlabnav-scroll">
        <div class="dropdown header-profile2 ">
            <a class="nav-link " href="javascript:void(0);"  role="button" data-bs-toggle="dropdown">
                <div class="header-info2 d-flex align-items-center">
                    <img src="{!! get_gravatar() !!}" alt="">
                    <div class="d-flex align-items-center sidebar-info">
                        <div>
                            <span class="font-w400 d-block">{{ auth('admin')->user()?->name }}</span>
                            <small class="text-end font-w400">{{ auth('admin')->user()?->role  }}</small>
                        </div>	
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a href="{{ route('user.logout') }}" class="dropdown-item ai-icon"  onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <svg  xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    <span class="ms-2">Logout </span>
                </a>
            </div>
        </div>
        @if(in_array(auth('admin')->user()?->role,['Developer','Admin']))
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('admin.home') }}" class="" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li>
                <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="flaticon-381-repeat-1"></i>
                    <span class="nav-text">Summary</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.summary.index') }}">Report</a></li>
                    <li><a href="{{ route('admin.summary.user') }}">User</a></li>
                    <li><a href="{{ route('admin.summary.brand') }}">Brand</a></li>
                    <li><a href="{{ route('admin.summary.manajerial') }}">Manajerial</a></li>
                </ul>
            </li>
            <!-- <li>
                <a href="{{ route('admin.home') }}" class="" aria-expanded="false">
                    <i class="flaticon-381-repeat-1"></i>
                    <span class="nav-text">Manajerial</span>
                </a>
            </li> -->
            
            <li>
                <a class="has-arrow " href="javascript:void(0);" aria-expanded="false">
                    <i class="flaticon-381-settings-5"></i>
                    <span class="nav-text">Setting</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('admin.master_task.index') }}">Master Task</a></li>
                    <li><a href="{{ route('admin.brand.index') }}">Brand</a></li>
                    <li><a href="{{ route('admin.user.index') }}">User Management</a></li>
                </ul>
            </li>
        </ul>
        @else
        <ul class="metismenu" id="menu">
            <li>
                <a href="{{ route('admin.home') }} class="" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Home</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.task.index') }}" class="" aria-expanded="false">
                    <i class="flaticon-381-edit"></i>
                    <span class="nav-text">Point Teknis</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.manajerial.index') }}" class="" aria-expanded="false">
                    <i class="flaticon-381-folder"></i>
                    <span class="nav-text">Point Manajerial</span>
                </a>
            </li>
            
        </ul>



        @endif
        <!-- <div class="plus-box">
            <p class="fs-14 font-w600 mb-2">digiworks.id<br>Your Resume Easily<br></p>
            <p class="plus-box-p">Lorem ipsum dolor sit amet</p>
        </div> -->
        <div class="copyright">
            <p><strong>App DW</strong> © <span class="current-year">{{ date('Y') }}</span> All Rights Reserved</p>
            <p class="fs-12">Made with <span class="heart"></span> by Digiworks</p>
        </div>
    </div>
</div>