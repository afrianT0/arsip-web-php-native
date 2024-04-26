<?php
session_start();

if (isset($_SESSION["id"])) {
    header('location: /dashboard');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Log In - Pengarsipan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="assets/js/config.js"></script>
</head>

<body class="d-flex justify-content-center align-items-center min-vh-100 p-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-md-5">
                <div class="card">
                    <div class="card-body p-4">

                        <div class="text-center w-75 mx-auto auth-logo mb-4">
                            <a href="/" class="logo-dark">
                                <span><img src="assets/images/logo-dotryn.png" alt="" height="22"></span>
                            </a>

                            <a href="/" class="logo-light">
                                <span><img src="assets/images/logo-dotryn.png" alt="" height="22"></span>
                            </a>
                        </div>

                        <!-- Start Notifikasi Logout -->
                        <?php
                        if (isset($_GET['pesan'])) {
                            $pesan = $_GET['pesan'];
                            if ($pesan == 'logout') {
                                echo '
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-check-all me-2"></i>
                                        Anda telah berhasil logout!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>';
                            } else if ($pesan == 'timeout') {
                                echo '
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-alert-outline me-2"></i>
                                        Waktu sesi telah habis, silakan login kembali!
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    ';
                            }
                        }
                        ?>
                        <!-- End Notifikasi Logout -->

                        <!-- Start Notifikasi Error -->
                        <?php
                        if (isset($_SESSION['sukses'])) {
                            echo '<p>' . $_SESSION['sukses'] . '</p>';
                            unset($_SESSION['sukses']);
                        } else if (isset($_SESSION['gagal'])) {
                            echo '
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="mdi mdi-block-helper me-2"></i>
                                ' . $_SESSION['gagal'] . '
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                                ';
                            unset($_SESSION['gagal']);
                        }
                        ?>
                        <!-- End Notifikasi Error -->

                        <form action="./proses/proses_login" method="post">

                            <div class="form-group mb-3">
                                <label class="form-label" for="username">Username</label>
                                <input class="form-control" type="text" name="username" id="username" required placeholder="Masukkan username">
                            </div>

                            <div class="form-group mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" type="password" name="password" id="password" required placeholder="Masukkan password">
                            </div>

                            <div class="form-group mb-3">
                                <div class="">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" checked>
                                    <label class="form-check-label ms-2" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary w-100" name="login" type="submit"> Log In </button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <span>Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            Afriyanto | Design by <a href="https://myrathemes.com/" target="_blank">MyraStudio</a>
                        </span>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    <!-- App js -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>