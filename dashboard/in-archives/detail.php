<?php
require_once '../../validasi/validasi_login.php';
require_once '../../dashboard/in-archives/proses/proses_detail.php';
$dataPicture   = $con->select_user($_SESSION['id']);
$page = 'Surat Masuk';
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="dark" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Data <?= $page; ?> - Detail</title>
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
                                <h4 class="page-title mb-0">Detail Data <?= $page; ?> <b><?php echo htmlspecialchars(ucfirst($data['nomor'])); ?></b></h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="./"><?= $page; ?> </a></li>
                                        <li class="breadcrumb-item active">Detail</li>
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

                                    <a class="btn btn-sm btn-danger mb-3" href="./"><i class="mdi mdi-arrow-left"></i> Kembali</a>

                                    <form>
                                        <div class="row">
                                            <div class="mb-2 col-md-6">
                                                <label class="form-label">Kategori Surat</label>
                                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['category_name']); ?>" readonly>
                                            </div>
                                            <div class="mb-2 col-md-6">
                                                <label for="Nama Instansi" class="form-label">Nama Instansi</label>
                                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['instansi_name']); ?>" readonly>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class=" mb-2 col-md-6">
                                                <label for="Nomor Surat" class="form-label">Nomor Surat</label>
                                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['nomor']); ?>" readonly>
                                            </div>
                                            <div class="mb-2 col-md-6">
                                                <label for="Nama Surat" class="form-label">Nama Surat</label>
                                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($data['nama']); ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-2 col-md-6">
                                                <label for="Tanggal Surat" class="form-label">Tanggal Surat</label>
                                                <input class="form-control" type="text" value="<?php echo htmlspecialchars(date('d/m/Y', strtotime($data['tanggal']))); ?>" readonly>
                                            </div>
                                            <div class="mb-2 col-md-6">
                                                <label for="Deskripsi" class="form-label">Deskripsi</label>
                                                <textarea class="form-control" type="text" rows="3" readonly><?php echo htmlspecialchars($data['deskripsi']); ?></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-2 col-md-6">
                                                <label for="Petugas" class="form-label">Petugas</label>
                                                <input class="form-control" type="text" value="<?php echo htmlspecialchars(ucfirst($data['user_name'])); ?>" readonly>
                                            </div>
                                            <div class="mb-2 col-md-6">
                                                <label for="File" class="form-label">File</label>
                                                <div class="form-control">
                                                    <a class="btn btn-xs btn-outline-secondary rounded-pill" href="../in-archives/file/<?php echo $data['file']; ?>" target="_blank"><i class="mdi mdi-link"></i> Lampiran</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-2 col-md-6">
                                                <label for="created_at" class="form-label">Waktu Pembuatan</label>
                                                <input class="form-control" type="text" value="<?php echo htmlspecialchars(date('d/m/Y H:i:s', strtotime($data['created_at']))); ?>" readonly>
                                            </div>
                                            <div class="mb-2 col-md-6">
                                                <label for="updated_at" class="form-label">Waktu Perubahan</label>
                                                <input class="form-control" type="text" value="<?php echo htmlspecialchars(date('d/m/Y H:i:s', strtotime($data['updated_at']))); ?>" readonly>
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