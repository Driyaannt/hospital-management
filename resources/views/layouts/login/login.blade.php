<!DOCTYPE html>
<html lang="en">

<head>
    <!--  Title -->
    <title>Mordenize</title>
    <!--  Required Meta Tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="handheldfriendly" content="true" />
    <meta name="MobileOptimized" content="width" />
    <meta name="description" content="Mordenize" />
    <meta name="author" content="" />
    <meta name="keywords" content="Mordenize" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--  Favicon -->
    <link rel="shortcut icon" type="image/png"
        href="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico" />
    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('dist/js/owl.carousel/owl.carousel.min.css') }}">
    <!-- Core Css -->
    <link id="themeColors" rel="stylesheet" href="{{ asset('dist/css/style.min.css') }}" />
    <link id="themeColors" rel="stylesheet" href="{{ asset('dist/css/prism-okaidia.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        {{-- <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico"
            alt="loader" class="lds-ripple img-fluid" /> --}}
        <img src="{{ asset('icons/icon-loader.gif') }}" alt="loader" class="lds-ripple img-fluid"
            style="width: 200px; height: 150px; margin-top: -80px;" />
    </div>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100">
            <div class="position-relative z-index-5">
                <div class="row">
                    <div class="col-xl-7 col-xxl-8">
                        <a href="#" class="text-nowrap logo-img d-block px-4 py-9 w-100">
                            <img src="{{ asset('icons/itsk-logo.png') }}" width="60" alt="" />
                            <span class="ms-2 fw-bold text-dark">RS ITSK Dr.Soepraoen</span>
                        </a>
                        <div class="d-none d-xl-flex align-items-center justify-content-center"
                            style="height: calc(100vh - 80px)">
                            <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/backgrounds/login-security.svg"
                                alt="" class="img-fluid" width="500" />
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-4">
                        <div
                            class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
                            <div class="col-sm-8 col-md-6 col-xl-9">
                                <h2 class="mb-3 fs-6 fw-bolder">
                                    Welcome to RS ITSK Dr.Soepraoen
                                </h2>
                                <form id="loginForm" action="{{ route('login.post') }}" method="POST">
                                    @csrf <!-- Tambahkan CSRF token -->
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label> <!-- Ubah label -->
                                        <input type="text" class="form-control" id="username" name="username"
                                            required /> <!-- Ubah name dan type -->
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required />
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox"
                                                id="flexCheckChecked" />
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Remember this Device
                                            </label>
                                        </div>
                                        <a class="text-primary fw-medium"
                                            href="authentication-forgot-password.html">Forgot Password ?</a>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 mb-4 rounded-2">Sign
                                        In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--  Import Js Files -->
    <script src="{{ asset('dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.init.js') }}"></script>
    <script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('dist/js/custom.js') }}"></script>

    <!-- Axios untuk AJAX -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Mencegah form dari reload halaman

            const username = document.getElementById('username').value; // Ambil nilai username
            const password = document.getElementById('password').value;

            // Handle Remember Me
            if (document.getElementById('flexCheckChecked').checked) {
                localStorage.setItem('rememberMe', 'true'); // Simpan status "Remember Me"
                localStorage.setItem('savedUsername', username); // Simpan username (opsional)
            } else {
                localStorage.removeItem('rememberMe'); // Hapus status "Remember Me"
                localStorage.removeItem('savedUsername'); // Hapus username yang disimpan (opsional)
            }

            // Kirim data login ke server
            axios.post('/login', {
                    username: username, // Kirim username, bukan email
                    password: password
                })
                .then(function(response) {
                    // Jika login berhasil, tampilkan pesan sukses dan redirect
                    if (response.data.redirect) {
                        Swal.fire({
                            icon: 'success', // Icon sukses
                            title: 'Login Successful', // Judul pesan
                            text: 'You will be redirected to the dashboard.', // Pesan sukses
                            showConfirmButton: false, // Sembunyikan tombol OK
                            timer: 1500 // Auto-close setelah 1.5 detik
                        }).then(() => {
                            window.location.href = response.data.redirect; // Redirect ke dashboard
                        });
                    }
                })
                .catch(function(error) {
                    // Jika login gagal, tampilkan pesan error menggunakan SweetAlert
                    Swal.fire({
                        icon: 'error', // Icon error
                        title: 'Login Failed', // Judul pesan
                        text: error.response.data.message, // Pesan error dari server
                        confirmButtonText: 'OK' // Teks tombol
                    });
                });
        });
    </script>
</body>

</html>
