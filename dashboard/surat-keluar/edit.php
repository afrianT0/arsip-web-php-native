<?php
require_once '../../validasi/validasi_login.php';
require_once '../../validasi/validasi_user.php';
require_once '../../dashboard/surat-masuk/proses/proses_edit.php';
$dataGambar = $con->select_user($_SESSION['id']);
$page       = 'Surat Keluar';
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
                                <h4 class="page-title mb-0">Edit Data <?= $page; ?> <b><?= $data['nomor'] ?></b></h4>
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

                                    <a class="btn btn-sm btn-danger mb-3" href="./"><i class="mdi mdi-arrow-left"></i> Kembali</a>

                                    <form method="post" action="<?php echo $url; ?>" enctype="multipart/form-data" class="needs-validation" novalidate>
                                        <div class="row">
                                            <div class="mb-2 col-md-6">
                                                <label for="kategori" class="form-label">Kategori Surat</label>
                                                <select class="form-control" name="kategori" id="kategori" data-toggle="select2">
                                                    <option selected disabled>Pilih Kategori...</option>
                                                    <?php
                                                    foreach ($con->get_data_kategori() as $kategori) {
                                                        if ($data['kategori_id'] == $kategori['id']) {
                                                            echo '<option value="' . $kategori['id'] . '" selected>' . $kategori['nama'] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $kategori['id'] . '">' . $kategori['nama'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="mb-2 col-md-6">
                                                <label for="instansi" class="form-label">Nama Instansi</label>
                                                <select class="form-control" name="instansi" id="instansi" data-toggle="select2">
                                                    <option selected disabled>Pilih Instansi...</option>
                                                    <?php
                                                    foreach ($con->get_data_instansi() as $instansi) {
                                                        if ($data['instansi_id'] == $instansi['id']) {
                                                            echo '<option value="' . $instansi['id'] . '" selected>' . $instansi['nama'] . '</option>';
                                                        } else {
                                                            echo '<option value="' . $instansi['id'] . '">' . $instansi['nama'] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class=" mb-2 col-md-6">
                                                <label for="nomor" class="form-label">Nomor Surat</label>
                                                <input type="text" class="form-control <?php echo isset($pesanNomor) ? 'is-invalid' : ''; ?>" id="nomor" name="nomor" placeholder="Nomor Surat" value="<?php echo isset($_POST['nomor']) ? htmlspecialchars($_POST['nomor']) : htmlspecialchars($data['nomor']); ?>" required>
                                                <div class="invalid-feedback">
                                                    <?php echo isset($pesanNomor) ? $pesanNomor : ''; ?>
                                                </div>
                                            </div>
                                            <div class="mb-2 col-md-6">
                                                <label for="nama" class="form-label">Nama Surat</label>
                                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Surat" value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : htmlspecialchars($data['nama']); ?>" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-2 col-md-6">
                                                <label for="tanggal" class="form-label">Tanggal Surat</label>
                                                <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal Surat" value="<?php echo isset($_POST['tanggal']) ? $_POST['tanggal'] : htmlspecialchars($data['tanggal']); ?>" required>
                                            </div>
                                            <div class="mb-2 col-md-6">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi" required><?php echo isset($_POST['deskripsi']) ? $_POST['deskripsi'] : htmlspecialchars($data['deskripsi']); ?></textarea>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="mb-2 col-md-6">
                                                <label for="file" class="form-label">File</label>
                                                <input type="file" class="form-control <?php echo isset($_SESSION['gagal']) ? 'is-invalid' : ''; ?>" id="fileupload" name="fileupload" accept="application/pdf" autocomplete="off">
                                                <div class="invalid-feedback">
                                                    <?php echo isset($_SESSION['gagal']) ? $_SESSION['gagal'] : ''; ?>
                                                </div>
                                                <?php unset($_SESSION['gagal']); ?>
                                                <span>*Maks 2 MB</span>
                                            </div>
                                        </div>

                                        <button class="btn btn-sm btn-primary mt-2" type="submit" name="edit"><i class="mdi mdi-pencil"></i> Edit</button>
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
