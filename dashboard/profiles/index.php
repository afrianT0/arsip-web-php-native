<?php
require_once '../../validasi/validasi_login.php';
include '../../db/koneksi_db.php';
$con            = new koneksi_db;
$dataPicture    = $con->select_user($_SESSION['id']);
$data           = $con->select_user($_SESSION['id']);
$page = 'Profil';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="dark" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Data <?= $page; ?> - Pengarsipan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">

    <!-- Style -->
    <!-- Plugins css -->
    <link href="../../assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/libs/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css" />
    <!-- Sweet Alert-->
    <link href="../../assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />

    <?php
    require_once '../../dashboard/layouts/css.php';
    ?>
</head>

<body>

    <!-- Begin page -->
    <div class="layout-wrapper">

        <!-- ========== Left Sidebar ========== -->
        <?php
        require_once '../../dashboard/layouts/sidebar.php';
        ?>

        <!-- Start Page Content here -->
        <div class="page-content">

            <!-- ========== Topbar Start ========== -->
            <?php
            require_once '../../dashboard/layouts/header.php';
            ?>
            <!-- ========== Topbar End ========== -->

            <div class="px-3">

                <!-- Start Content-->
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="py-3 py-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <h4 class="page-title mb-0">Data <?= $page; ?> <b><?php echo htmlspecialchars(ucfirst($data['username'])); ?></b></h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
                                        <li class="breadcrumb-item active"><?= $page; ?></li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <form method="post" action="<?php echo $url; ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
                                        <div class="row mt-3">
                                            <div class="col-md-3 mt-3">
                                                <div class="text-center position-relative">
                                                    <?php
                                                    if ($_SESSION['picture'] == null) {
                                                        echo '
                                                        <img src="../../assets/images/users/default-photo.png" alt="image" class="img-fluid rounded-circle border border-secondary" width="120" />
                                                        ';
                                                    } else {
                                                        echo '
                                                        <img src="../../assets/images/users/' . $data["picture"] . '" alt="image" class="img-fluid rounded-circle border border-secondary" width="200" />
                                                        ';
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="col-md-3 mt-3">
                                                <label for="username" class="form-label">Username</label>
                                                <p><?php echo htmlspecialchars($data['username']); ?></p>


                                                <label for="email" class="form-label">Email</label>
                                                <p><?php echo htmlspecialchars($data['email']); ?></p>

                                                <label for="created_at" class="form-label">Dibuat pada</label>
                                                <p><?php echo htmlspecialchars(date('d/m/Y H:i:s', strtotime($data['created_at']))); ?></p>

                                                <label for="" class="form-label">Diubah pada</label>
                                                <p><?php echo htmlspecialchars(date('d/m/Y H:i:s', strtotime($data['updated_at']))); ?></p>


                                                <div class="row mb-5">
                                                    <div class="col mt-3">
                                                        <div class="d-grid">
                                                            <a class="btn btn-sm btn-danger" type="submit" href="./edit?id=<?= $data["id"]; ?>"><i class="mdi mdi-pencil"></i> Edit Profile</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </form>

                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>
                    <!-- end row-->

                </div> <!-- container -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <?php
            require_once '../../dashboard/layouts/footer.php';
            ?>
            <!-- end Footer -->

        </div>
        <!-- End Page content -->


    </div>
    <!-- END wrapper -->

    <!-- Scripts -->
    <?php
    require_once '../../dashboard/layouts/script.php';
    ?>

    <!-- Plugins Js -->
    <script src="../../assets/libs/selectize/js/standalone/selectize.min.js"></script>
    <script src="../../assets/libs/mohithg-switchery/switchery.min.js"></script>
    <script src="../../assets/libs/multiselect/js/jquery.multi-select.js"></script>
    <script src="../../assets/libs/jquery.quicksearch/jquery.quicksearch.min.js"></script>
    <script src="../../assets/libs/select2/js/select2.min.js"></script>
    <script src="../../assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="../../assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>

    <!-- Demo js -->
    <script src="../../assets/js/pages/form-advanced.js"></script>

    <!-- Sweet Alerts js -->
    <script src="../../assets/libs/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Custom -->
    <?php
    if (isset($_SESSION['sukses'])) {
        $pesanSukses = htmlspecialchars($_SESSION['sukses'], ENT_QUOTES, 'UTF-8');
        $pesanGagal = htmlspecialchars($_SESSION['gagal'], ENT_QUOTES, 'UTF-8');
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: '{$pesanSukses}',
                showConfirmButton: true,
                timer: 1500
            });
        </script>
        ";
        unset($_SESSION['sukses']);
    } else if (isset($_SESSION['gagal'])) {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: '{$pesanGagal}',
                showConfirmButton: true
            });
        
        ";
        unset($_SESSION['gagal']);
    }
    ?>


</body>

</html>