<div class="sidebar-container shadow-sm bg-white h-100" id="main-sidebar">
    <div class="d-flex flex-column flex-shrink-0 h-100 position-relative">
        <div class="position-absolute top-0 start-100 translate-middle mt-5">
            <div class="position-relative sidebar-hide-btn" id="toggleSidebar">
                <i class="fa-solid fa-chevron-left"></i>
            </div>
        </div>
        <div class="position-absolute top-0 end-0 mt-3 me-3">
            <div class="position-relative sidebar-close-btn" id="closeSidebar">
                <i class="fa-solid fa-xmark fs-5"></i>
            </div>
        </div>
        <div class="sidebar-logo-container col-10 d-flex mt-4 align-items-center mx-auto justify-content-center mb-3">
            <img src="{{ URL::asset('assets/images/logo/laravel-full-logo.png') }}" alt="" class="uncollapse-image-sidebar w-100 mx-auto">

            <img src="{{ URL::asset('assets/images/logo/laravel-logo.png') }}" alt="" class="collapse-image-sidebar w-75" style="width:50px;">
        </div>
        <h4 class="px-3 mb-2"> </h4>
        <div class="side-bar-controls-container px-3 mb-auto sidebar-scrollarea">
            <ul class="list-unstyled ">
                <li class="fs-6 mb-2">
                    <a href="{{ route('dashboard.index') }}"
                        class="sidebar-menu-item {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-house"></i>
                        <span class="ms-2 sidebar-text">Dashboard</span>
                    </a>
                </li>

                <li class="fs-6 mb-2">
                    <a href="{{ route('artist.index') }}"
                        class="sidebar-menu-item {{ Request::is('artist') ? 'active' : '' }}">
                        <i class="fa-solid fa-headphones"></i>
                        <span class="ms-2 sidebar-text">Artist</span>
                    </a>
                </li>

                <li class="fs-6 mb-2">
                    <a href="{{ route('dashboard.index') }}"
                        class="sidebar-menu-item {{ Request::is('album') ? 'active' : '' }}">
                        <i class="fa-solid fa-headphones"></i>
                        <span class="ms-2 sidebar-text">Albums</span>
                    </a>
                </li>


                <li class="fs-6 mb-2">
                    <a href="{{ route('profile.index') }}" class="sidebar-menu-item {{ Request::is('profile*', 'profile') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-gear"></i>
                        <span class="ms-2 sidebar-text">Profile Settings</span>
                    </a>
                </li>

                <li class="fs-6 mb-2">
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <button class="sidebar-menu-item w-100 text-start" type="submit">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span class="ms-2 sidebar-text">Logout</span>
                        </button>
                    </form>
                </li>
            </ul>

            {{-- Notification + Drop Down --}}
            {{-- <li class="fs-6 mb-2 ">
                <div class="sidebar-menu-item sidebar-menu-link py-2 px-3 rounded d-flex justify-content-between ">
                    <a class="nav-link col" href="">
                        <i class="fa-solid fa-house"></i>
                        <span class="sidebar-menu-item-text ms-1">Dashboard</span>
                    </a>
                    <div class="d-flex justify-content-end">
                        <span class="sidebar-menu-notification rounded px-1 me-2"><small><b>29</b></small></span>
                        <span class="pe-auto sidebar-menu-dropdown-button"><i class="fa-solid fa-chevron-right"></i></span>
                    </div>
                </div>
                <div class="w-100 mb-2 bg-primary dropdown-sidebar-menu bg-barangay-secondary-darker rounded-bottom collapse p-2 px-3">
                    <a href="nav-link col ">
                        <div class="sidebar-menu-item sidebar-menu-link py-2 px-3 rounded d-flex justify-content-between">
                            <a class="nav-link col" href="">
                                <i class="fa-solid fa-house"></i>
                                <span class="sidebar-menu-item-text ms-1"><small>Dashboard</small></span>
                            </a>
                            <div class="d-flex justify-content-end">
                                <!--<span class="sidebar-menu-notification rounded px-1"><small><b>29</b></small></span>-->
                            </div>
                        </div>
                    </a>
                    <a href="nav-link col ">
                        <div class="sidebar-menu-item sidebar-menu-link py-2 px-3 rounded d-flex justify-content-between">
                            <a class="nav-link col" href="">
                                <i class="fa-solid fa-house"></i>
                                <span class="sidebar-menu-item-text ms-1"><small>Dashboard</small></span>
                            </a>
                            <div class="d-flex justify-content-end">
                                <!--<span class="sidebar-menu-notification rounded px-1"><small><b>29</b></small></span>-->
                            </div>
                        </div>
                    </a>

                    <a href="nav-link col ">
                        <div class="sidebar-menu-item sidebar-menu-link py-2 px-3 rounded d-flex justify-content-between">
                            <a class="nav-link col" href="">
                                <i class="fa-solid fa-house"></i>
                                <span class="sidebar-menu-item-text ms-1"><small>Dashboard</small></span>
                            </a>
                            <div class="d-flex justify-content-end">
                                <!--<span class="sidebar-menu-notification rounded px-1"><small><b>29</b></small></span>-->
                            </div>
                        </div>
                    </a>
                    <a href="nav-link col ">
                        <div class="sidebar-menu-item sidebar-menu-link py-2 px-3 rounded d-flex justify-content-between">
                            <a class="nav-link col" href="">
                                <i class="fa-solid fa-house"></i>
                                <span class="sidebar-menu-item-text ms-1"><small>Dashboard</small></span>
                            </a>
                            <div class="d-flex justify-content-end">
                                <!--<span class="sidebar-menu-notification rounded px-1"><small><b>29</b></small></span>-->
                            </div>
                        </div>
                    </a>
                </div>
            </li> --}}
        </div>
    </div>
</div>
