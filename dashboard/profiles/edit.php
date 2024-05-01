<?php
require_once '../../validasi/validasi_login.php';
require_once '../../dashboard/profiles/proses/proses_edit.php';
$page = 'Profil';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="dark" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Data <?= $page; ?> - Edit</title>
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
                                <h4 class="page-title mb-0">Edit <?= $page; ?> <b><?php echo htmlspecialchars(ucfirst($data['username'])); ?></b></h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="./"><?= $page; ?></a></li>
                                        <li class="breadcrumb-item active">Edit</li>
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

                                                <div class="text-center mt-3">
                                                    <label class="btn btn-sm btn-outline-primary rounded-pill" for="fileupload"><i class="mdi mdi-upload"></i> Ganti Foto</label>
                                                    <input type="file" class="form-control mb-3 <?php echo isset($_SESSION['gagal']) ? 'is-invalid' : ''; ?>" id="fileupload" name="fileupload" hidden="" accept="image/png,image/jpeg,image/jpg" autocomplete="off">
                                                    <div class="invalid-feedback">
                                                        <?php echo isset($_SESSION['gagal']) ? $_SESSION['gagal'] : ''; ?>
                                                    </div>
                                                    <?php unset($_SESSION['gagal']); ?>

                                                </div>
                                            </div>

                                            <div class="col-md-3 mt-3">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control mb-3 <?php echo isset($pesanUser) ? 'is-invalid' : ''; ?>" id="username" name="username" placeholder="Username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : htmlspecialchars($data['username']); ?>" required>
                                                <div class=" invalid-feedback">
                                                    <?php echo isset($pesanUser) ? $pesanUser : ''; ?>
                                                </div>

                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control mb-3 <?php echo isset($pesanEmail) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : htmlspecialchars($data['email']); ?>" required>
                                                <div class="invalid-feedback">
                                                    <?php echo isset($pesanEmail) ? $pesanEmail : ''; ?>
                                                </div>

                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control mb-3" id="password" name="password" placeholder="Password">

                                                <div class="row mb-5">
                                                    <div class="col mt-3">
                                                        <div class="d-grid">
                                                            <button class="btn btn-sm btn-primary" type="submit" name="Edit">Simpan</button>
                                                        </div>
                                                    </div>
                                                    <div class="col mt-3">
                                                        <div class="d-grid">
                                                            <a class="btn btn-sm btn-danger" type="submit" href="./">Cancel</a>
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


</body>

</html>