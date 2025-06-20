<style>
    .hospital-name {
    font-size: 1.2rem; /* Ukuran teks */
    font-weight: bold; /* Tebal teks */
    margin-left: 10px; /* Jarak dari gambar */
    vertical-align: middle; /* Posisi vertikal tengah */
}
</style>
<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link sidebartoggler nav-icon-hover ms-n3" id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item d-none d-lg-block">
                <span class="badge fw-semibold py-1 w-85 bg-light-primary text-primary mt-4">
                    <div id="clock"></div>
                </span>
            </li>
        </ul>
        <div class="d-block d-lg-none">
            <img src="{{ asset('icons/itsk-logo.png') }}" class="dark-logo" width="70" alt="" />
            <img src="{{ asset('icons/itsk-logo.png') }}" class="light-logo" width="70" alt="" />
            <span class="hospital-name">RS ITSK Dr.Soepraoen</span>
        </div>
        <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
            </span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <div class="d-flex align-items-center justify-content-between">
                <a href="javascript:void(0)" class="nav-link d-flex d-lg-none align-items-center justify-content-center"
                    type="button" data-bs-toggle="offcanvas" data-bs-target="#mobilenavbar"
                    aria-controls="offcanvasWithBothOptions">
                    <i class="ti ti-align-justified fs-7"></i>
                </a>
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link pe-0" href="javascript:void(0)" id="drop1" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="d-flex align-items-center">
                                <div class="user-profile-img">
                                    <img src="{{ asset('images/profile/user-1.jpg') }}" class="rounded-circle"
                                        width="35" height="35" alt="" />
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                            aria-labelledby="drop1">
                            <div class="profile-dropdown position-relative" data-simplebar>
                                <div class="py-3 px-7 pb-0">
                                    <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                </div>
                                <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                    <img src="{{ asset('images/profile/user-1.jpg') }}" class="rounded-circle"
                                        width="80" height="80" alt="" />
                                    <div class="ms-3">
                                        <h5 class="mb-1 fs-3">{{ Auth::user()->name }}</h5>
                                        <span class="mb-1 d-block text-dark">{{ Auth::user()->role }}</span>
                                        <p class="mb-0 d-flex text-dark align-items-center gap-2">
                                            <i class="ti ti-mail fs-4"></i> {{ Auth::user()->email }}
                                        </p>
                                    </div>
                                </div>
                                {{-- <div class="message-body">
                                    <a href="{{route('v-my-profile')}}" class="py-8 px-7 mt-8 d-flex align-items-center">
                                        <span
                                            class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-account.svg"
                                                alt="" width="24" height="24">
                                        </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h6 class="mb-1 bg-hover-primary fw-semibold"> My Profile </h6>
                                            <span class="d-block text-dark">Account Settings</span>
                                        </div>
                                    </a>
                                    <a href="app-email.html" class="py-8 px-7 d-flex align-items-center">
                                        <span
                                            class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-inbox.svg"
                                                alt="" width="24" height="24">
                                        </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h6 class="mb-1 bg-hover-primary fw-semibold">My Inbox</h6>
                                            <span class="d-block text-dark">Messages & Emails</span>
                                        </div>
                                    </a>
                                    <a href="app-notes.html" class="py-8 px-7 d-flex align-items-center">
                                        <span
                                            class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6">
                                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/svgs/icon-tasks.svg"
                                                alt="" width="24" height="24">
                                        </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h6 class="mb-1 bg-hover-primary fw-semibold">My Task</h6>
                                            <span class="d-block text-dark">To-do and Daily Tasks</span>
                                        </div>
                                    </a>
                                </div> --}}
                                <div class="d-grid py-4 px-7 pt-8">
                                    <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                                        @csrf <!-- CSRF token untuk keamanan -->
                                        <button type="button" class="btn btn-outline-primary" onclick="confirmLogout()">Log Out</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<script>
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0
        const year = now.getFullYear();

        // Format tampilan waktu dan tanggal
        const clock = `${hours}:${minutes}:${seconds}`;
        const date = `${day}/${month}/${year}`;

        // Gabungkan waktu dan tanggal
        const dateTime = `${date} ${clock}`;

        // Tampilkan di elemen dengan id "clock"
        document.getElementById('clock').textContent = dateTime;
    }

    // Update waktu setiap detik
    setInterval(updateClock, 1000);

    // Panggil fungsi pertama kali untuk menghindari delay 1 detik
    updateClock();
</script>
