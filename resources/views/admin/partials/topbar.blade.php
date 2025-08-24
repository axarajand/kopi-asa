<div class="topbar-custom">
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                <li>
                    <button type="button" class="button-toggle-menu nav-link">
                        <iconify-icon icon="tabler:align-left" class="fs-20 align-middle text-dark topbar-button"></iconify-icon>
                    </button>
                </li>
            </ul>

            <ul class="list-unstyled topnav-menu mb-0 d-flex align-items-center">
                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" data-toggle="fullscreen">
                        <iconify-icon icon="tabler:maximize" class="fs-20 align-middle text-dark topbar-button fullscreen noti-icon"></iconify-icon>
                    </button>
                </li>
                <li class="d-none d-sm-flex">
                    <button type="button" class="btn nav-link" id="light-dark-mode">
                        <div class="topbar-button">
                            <iconify-icon icon="tabler:moon" class="fs-20 text-dark align-middle dark-mode"></iconify-icon>
                            <iconify-icon icon="tabler:sun-high" class="fs-20 text-dark align-middle light-mode"></iconify-icon>
                        </div>
                    </button>
                </li>
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        
                        {{-- THIS IS THE UPDATED IMAGE TAG --}}
                        <img src="{{ Auth::user()->profile_photo_path ? asset('storage/' . Auth::user()->profile_photo_path) : asset('admin-assets/images/users/user-default.jpg') }}" alt="user-image" class="" />

                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Selamat Datang, {{ Auth::user()->name }}!</h6>
                        </div>

                        <div class="dropdown-divider"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" class="dropdown-item notify-item" 
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <iconify-icon icon="tabler:logout" class="fs-18 align-middle"></iconify-icon>
                                <span>Logout</span>
                            </a>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>