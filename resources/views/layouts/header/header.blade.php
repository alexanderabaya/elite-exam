<div class="navigation-bar-all navigation-with-sidebar desktop-header">
    <div class="navigation-content-container d-flex justify-content-between h-100 px-4">
        <div class="align-self-center">
            <div class="header-breadcrumb ">
                @yield('header')
            </div>
            <div class="header-burger" >
                <i class="fa-solid fa-bars fs-3 text-muted" id="openSidebar">
                </i>
            </div>
        </div>
        <div class="header-profile-container d-flex align-self-center">
            <div class="dropdown dropdown-secondary">
                <div class="d-flex cursor-pointer" data-bs-toggle="dropdown" data-bs-target="#profile-expand" aria-expanded="false">
                    <div class="me-3 text-end header-profile-information">
                        <h6 class="align-self-center mb-0 fw-semibold">{{ Auth::user()->name }}</h6>
                        @if ( Auth::user()->roles->first()->id == 3)
                            <small class="text-muted">{{ Auth::user()->member->position->name}}</small>
                        @else
                            <small class="text-muted">{{ Auth::user()->roles->first()->name }}</small>
                        @endif
                    </div>
                    <div class="profile-image-container border rounded-circle align-self-center me-3">
                        @if(Auth::user()->profile_photo_path)
                            <img src="{{ asset('database-image/profile-image/'.Auth::user()->profile_photo_path) }}" class="w-100" alt="">
                        @else
                            <img src="{{ asset('assets/images/user.png') }}" class="w-100" alt="">
                        @endif
                    </div>
                    <span class="align-self-center" >
                        <i class="bi bi-chevron-down fs-6"></i>
                    </span>
                </div>
                <div class=" border dropdown-menu shadow-sm rounded profile-expand" id="profile-expand">
                    <div class="d-flex pb-3 mb-3 border-bottom">
                        <div class="profile-image-expand border rounded-circle align-self-center me-2">
                            @if(Auth::user()->profile_photo_path)
                                <img src="{{ asset('database-image/profile-image/'.Auth::user()->profile_photo_path) }}" class="w-100" alt="">
                            @else
                                <img src="{{ asset('assets/images/user.png') }}" class="w-100" alt="">
                            @endif
                        </div>
                        <div class="me-3 text-start">
                            <h6 class="align-self-center mb-0 fw-bold ">{{ Auth::user()->name }}</h6>
                            <small class="bg-primary-custom text-white rounded px-2">{{ Auth::user()->roles->first()->name }}</small>
                        </div>
                    </div>
                    <a href="{{ route('profile.index') }}" class="profile-link d-flex">
                        <div class="profile-link-icon bg-primary-custom me-3">
                            <i class="fa-solid fa-user-gear"></i>
                        </div>
                        <span class="align-self-center">Profile Settings</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <button class="profile-link d-flex w-100" type="submit">
                            <div class="profile-link-icon bg-primary-custom me-3">
                                <i class="fa-solid fa-right-from-bracket"></i>
                            </div>
                            <span class="align-self-center">Logout</span>
                        </button>
                    </form>

                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
