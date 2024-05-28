<?php
require_once '../validasi/validasi_login.php';

include '../db/koneksi_db.php';
$con = new koneksi_db;
$dataGambar   = $con->select_user($_SESSION['id']);
$page = 'Dashboard';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="dark" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title><?= $page; ?> - Pengarsipan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!-- Style -->
    <!-- Sweet Alert-->
    <link href="../assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <?php
    include('../layouts/css.php');
    ?>
</head>

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">

        <!-- ========== Left Sidebar ========== -->
        <?php
        include('../layouts/sidebar.php');
        ?>

        <!-- Start Page Content here -->
        <div class="page-content">

            <!-- ========== Topbar Start ========== -->
            <?php
            include('../layouts/header.php');
            ?>
            <!-- ========== Topbar End ========== -->

            <div class="px-3">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="py-3 py-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="page-title mb-0">Welcome back, <b><?php echo htmlspecialchars(ucfirst($_SESSION['username'])); ?></b></h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                                        <li class="breadcrumb-item active">/li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">

                        <?php
                        if ($_SESSION['level'] === 'Administrator') {
                            echo '
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Total Pengguna</h5>
                                        </div>
                                        <div class="row d-flex align-items-center mb-4">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    ' . $con->total_user() . '
                                                </h2>
                                            </div>
                                            <div class="col-4 text-end">
                                                <a class="btn btn-sm btn-outline-success rounded-pill" href="./users/">Lihat</a>
                                            </div>
                                        </div>

                                        <div class="progress shadow-sm" style="height: 5px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card body-->
                                </div><!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Total Kategori Surat</h5>
                                        </div>
                                        <div class="row d-flex align-items-center mb-4">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    ' . $con->total_kategori() . '
                                                </h2>
                                            </div>
                                            <div class="col-4 text-end">
                                                <a class="btn btn-sm btn-outline-danger rounded-pill" href="./kategori/">Lihat</a>
                                            </div>
                                        </div>

                                        <div class="progress shadow-sm" style="height: 5px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card body-->
                                </div><!-- end card-->
                            </div> <!-- end col-->';
                        }; ?>

                        <?php
                        if ($_SESSION['level'] === 'Administrator' || $_SESSION['level'] === 'User') {
                            echo '
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Total Instansi</h5>
                                        </div>
                                        <div class="row d-flex align-items-center mb-4">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    ' . ($con->total_instansi()) . '
                                                </h2>
                                            </div>
                                            <div class="col-4 text-end">
                                                <a class="btn btn-sm btn-outline-primary rounded-pill" href="./instansi/">Lihat</a>
                                            </div>
                                        </div>

                                        <div class="progress shadow-sm" style="height: 5px;">
                                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card body-->
                                </div><!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Total Surat Masuk</h5>
                                        </div>
                                        <div class="row d-flex align-items-center mb-4">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    ' . ($con->total_surat_masuk()) . '
                                                </h2>
                                            </div>
                                            <div class="col-4 text-end">
                                                <a class="btn btn-sm btn-outline-warning rounded-pill" href="./surat-masuk/">Lihat</a>
                                            </div>
                                        </div>

                                        <div class="progress shadow-sm" style="height: 5px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card body-->
                                </div>
                                <!--end card-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Total Surat Keluar</h5>
                                        </div>
                                        <div class="row d-flex align-items-center mb-4">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    ' . ($con->total_surat_keluar()) . '
                                                </h2>
                                            </div>
                                            <div class="col-4 text-end">
                                                <a class="btn btn-sm btn-outline-info rounded-pill" href="./surat-keluar/">Lihat</a>
                                            </div>
                                        </div>

                                        <div class="progress shadow-sm" style="height: 5px;">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                    <!--end card body-->
                                </div><!-- end card-->
                            </div> <!-- end col-->';
                        }; ?>

                        <?php
                        if ($_SESSION['level'] === 'Administrator' || $_SESSION['level'] === 'Validator') {
                            echo '
                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Total Surat Pending</h5>
                                        </div>
                                        <div class="row d-flex align-items-center mb-4">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    ' . ($con->total_surat_pending()) . '
                                                </h2>
                                            </div>
                                            <div class="col-4 text-end">
                                                <a class="btn btn-sm btn-outline-warning rounded-pill" href="./pending/">Lihat</a>
                                            </div>
                                        </div>

                                        <div class="progress shadow-sm" style="height: 5px;">
                                            <div class="progress-bar bg-warning" role="progressbar" style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card body-->
                                </div><!-- end card-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Total Surat Valid</h5>
                                        </div>
                                        <div class="row d-flex align-items-center mb-4">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    ' . ($con->total_surat_valid()) . '
                                                </h2>
                                            </div>
                                            <div class="col-4 text-end">
                                                <a class="btn btn-sm btn-outline-success rounded-pill" href="./valid/">Lihat</a>
                                            </div>
                                        </div>

                                        <div class="progress shadow-sm" style="height: 5px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <!--end card body-->
                                </div>
                                <!--end card-->
                            </div> <!-- end col-->

                            <div class="col-md-6 col-xl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-4">
                                            <h5 class="card-title mb-0">Total Surat Tidak Valid</h5>
                                        </div>
                                        <div class="row d-flex align-items-center mb-4">
                                            <div class="col-8">
                                                <h2 class="d-flex align-items-center mb-0">
                                                    ' . ($con->total_surat_tidak_valid()) . '
                                                </h2>
                                            </div>
                                            <div class="col-4 text-end">
                                                <a class="btn btn-sm btn-outline-danger rounded-pill" href="./invalid/">Lihat</a>
                                            </div>
                                        </div>

                                        <div class="progress shadow-sm" style="height: 5px;">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                    <!--end card body-->
                                </div><!-- end card-->
                            </div> <!-- end col-->';
                        }; ?>

                    </div>
                    <!-- end row-->

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <?php
            include('../layouts/footer.php');
            ?>
            <!-- end Footer -->

        </div>
        <!-- End Page content -->


    </div>
    <!-- END wrapper -->

    <!-- Scripts -->
    <?php
    require_once '../layouts/script.php';
    ?>

    <!-- Sweet Alerts js -->
    <script src="../assets/libs/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Custom -->
    <?php
    if (isset($_SESSION['sukses'])) {
        $pesanSukses = htmlspecialchars($_SESSION['sukses'], ENT_QUOTES, 'UTF-8');
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: '{$pesanSukses}',
                showConfirmButton: true,
                timer: 1500
            });
        </script>
        ";
        unset($_SESSION['sukses']);
    } elseif (isset($_SESSION['gagal'])) {
        $pesanGagal = htmlspecialchars($_SESSION['gagal'], ENT_QUOTES, 'UTF-8');
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{$pesanGagal}',
                showConfirmButton: true
            });
        </script>
        ";
        unset($_SESSION['gagal']);
    }
    ?>

</body>

</html>