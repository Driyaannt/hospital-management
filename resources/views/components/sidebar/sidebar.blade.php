<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="#" class="text-nowrap logo-img d-block px-2 py-3 w-100">
                <img src="{{ asset('icons/itsk-logo.png') }}" width="60" alt="" />
                <span class="ms-2 fw-bold text-dark">RS ITSK Dr.Soepraoen</span>
                <!-- <h1>Logo</h1> -->
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <!-- ============================= -->
                <!-- Home -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                <li class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-aperture"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('dashboard*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-calendar-event"></i>
                        </span>
                        <span class="hide-menu">Jadwal Dokter</span>
                    </a>
                </li>


                <!-- ============================= -->
                <!-- Apps -->
                <!-- ============================= -->
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Apps</span>
                </li>
                <li class="sidebar-item {{ request()->is('v-history-rm*') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('v-history-rm') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-clipboard-plus"></i>
                        </span>
                        <span class="hide-menu">Rekam Medis</span>
                    </a>
                </li>


                <!-- ============================= -->
                <!-- Master Data -->
                @if (auth()->user()->role === 'admin')
                    <!-- ============================= -->
                    <li class="nav-small-cap">
                        <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        <span class="hide-menu">Master Data</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link has-arrow" href="#" aria-expanded="false">
                            <span class="d-flex">
                                <i class="ti ti-database"></i>
                            </span>
                            <span class="hide-menu">Master Data</span>
                        </a>
                        <ul aria-expanded="false" class="collapse first-level">
                            <li class="sidebar-item {{ request()->is('v-data-user*') ? 'active' : '' }}">
                                <a class="sidebar-link" href="{{ route('v-data-user') }}">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Data User</span>
                                </a>
                            </li>

                            <li class="sidebar-item {{ request()->is('v-data-patients*') ? 'active' : '' }}">
                                <a class="sidebar-link" href="{{ route('v-data-patients') }}">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Data Pasien</span>
                                </a>
                            </li>
                            <li class="sidebar-item {{ request()->is('v-data-bed*') ? 'active' : '' }}">
                                <a class="sidebar-link" href="{{ route('v-data-bed') }}">
                                    <div class="round-16 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-circle"></i>
                                    </div>
                                    <span class="hide-menu">Data Bed</span>
                                </a>
                            </li>
                            {{-- <li class="sidebar-item">
                            <a href="pages-gallery.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Gallery</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="pages-treeview.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Treeview</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="pages-block-ui.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Block-Ui</span>
                            </a>
                        </li>
                        <li class="sidebar-item mb-3">
                            <a href="pages-session-timeout.html" class="sidebar-link">
                                <div class="round-16 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-circle"></i>
                                </div>
                                <span class="hide-menu">Session Timeout</span>
                            </a>
                        </li> --}}
                        </ul>
                    </li>
                @endif
        </nav>
        <div class="fixed-profile p-3 bg-light-secondary rounded sidebar-ad mt-3">
            <div class="hstack gap-3">
                <div class="john-img">
                    <img src="../../dist/images/profile/user-1.jpg" class="rounded-circle" width="40" height="40"
                        alt="">
                </div>
                <div class="john-title">
                    <h6 class="mb-0 fs-4 fw-semibold">Mathew</h6>
                    <span class="fs-2 text-dark">Designer</span>
                </div>
                <button class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button"
                    aria-label="logout" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                    <i class="ti ti-power fs-6"></i>
                </button>
            </div>
        </div>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
