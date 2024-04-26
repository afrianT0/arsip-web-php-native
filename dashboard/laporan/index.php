<?php
require_once '../../validasi/validasi_login.php';
require_once '../../dashboard/laporan/proses/proses_print.php';

$dataPicture   = $con->select_user($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="dark" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Data Laporan - Pengarsipan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">

    <!-- Style -->
    <!-- third party css -->
    <link href="../../assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="../../assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

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
                                <h4 class="page-title mb-0">Data Laporan</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Laporan</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <form action="">
                                        <div class="row mb-3">
                                            <label for="surat" class="col-sm-2 col-form-label">Jenis Surat</label>
                                            <div class="col-sm-3">
                                                <select class="form-control <?php echo isset($pesan) ? 'is-invalid' : ''; ?>" name="surat" id="surat" data-toggle="select2">
                                                    <option disabled selected>Pilih Jenis Surat</option>
                                                    <option value="0" <?php echo (isset($_GET['surat']) && $_GET['surat'] == 0) ?  'selected' : ''; ?>>Semua Surat</option>
                                                    <option value="1" <?php echo (isset($_GET['surat']) && $_GET['surat'] == 1) ?  'selected' : ''; ?>>Surat Masuk</option>
                                                    <option value="2" <?php echo (isset($_GET['surat']) && $_GET['surat'] == 2) ?  'selected' : ''; ?>>Surat Keluar</option>
                                                </select>
                                                <?php
                                                if (empty($_POST['surat'])) {
                                                    echo '<div class="invalid-feedback">';
                                                    echo isset($pesan) ? $pesan : '';
                                                    echo '</div>';
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="tanggal_awal" class="col-sm-2 col-form-label">Tanggal Awal</label>
                                            <div class="col-sm-3">
                                                <input class="form-control" type="date" name="tanggal_awal" id="tanggal_awal" placeholder="Tanggal Awal" value="<?= isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : '' ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="tanggal_akhir" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                                            <div class="col-sm-3">
                                                <input class="form-control" type="date" name="tanggal_akhir" id="tanggal_akhir" placeholder="Tanggal Akhir" value="<?= isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '' ?>" required>
                                            </div>
                                        </div>

                                        <div class="mb-2">
                                            <button class="btn btn-sm btn-primary" type="submit" name="filter">Filter</button>
                                            <?php
                                            if (!isset($_GET['filter'])) {
                                                echo '<a class="btn btn-sm btn-info disabled me-1" href="' . $url_cetak . '" target="_blank">Cetak</a>';
                                            } elseif (isset($_GET['surat'])) {
                                                echo '<a class="btn btn-sm btn-danger me-1" href="./">Reset</a>';
                                                echo '<a class="btn btn-sm btn-info me-1" href="' . $url_cetak . '" target="_blank">Cetak</a>';
                                            } else {
                                                echo '<a class="btn btn-sm btn-danger me-1" href="./">Reset</a>';
                                                echo '<a class="btn btn-sm btn-info disabled me-1" href="' . $url_cetak . '" target="_blank">Cetak</a>';
                                            };
                                            ?>
                                        </div>

                                    </form>
                                </div> <!-- end card header-->

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="scroll-horizontal-datatable" class="table w-100 nowrap">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Kategori</th>
                                                    <th>Nomor</th>
                                                    <th>Nama Surat</th>
                                                    <th>Nama Instansi</th>
                                                    <th>Tanggal</th>
                                                    <th>Deskripsi</th>
                                                    <th>Petugas</th>
                                                    <th>Surat</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php
                                                $counter = 1;

                                                if ($query->num_rows > 0) {
                                                    while ($data = $query->fetch_assoc()) {
                                                ?>
                                                        <tr>
                                                            <td><?= $counter++; ?></td>
                                                            <td><?= $data['category_name']; ?></td>
                                                            <td><?= $data['nomor']; ?></td>
                                                            <td><?= $data['nama']; ?></td>
                                                            <td><?= $data['instansi_name']; ?></td>
                                                            <td><?= date('d/m/Y', strtotime($data['tanggal'])); ?></td>
                                                            <td><?= $data['deskripsi']; ?></td>
                                                            <td><?= ucfirst($data['user_name']); ?></td>
                                                            <td><?= $data['tipe_surat'] == 1 ? 'Masuk' : 'Keluar'; ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>

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

    <!-- third party js -->
    <script src="../../assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../../assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="../../assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="../../assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="../../assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../../assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../../assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../../assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../../assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="../../assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="../../assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <!-- third party js ends -->

    <!-- Datatables js -->
    <script src="../../assets/js/pages/datatables.js"></script>

    <!-- Sweet Alerts js -->
    <script src="../../assets/libs/sweetalert2/sweetalert2.all.min.js"></script>

    <!-- Custom -->
    <script>
        function hapus(elem) {
            var dataId = elem.getAttribute("data-id");
            var deleteUrl = "./delete?id=" + dataId;
            var dataKey = elem.getAttribute("data-key");

            Swal.fire({
                title: "Yakin ingin menghapus ini?",
                text: "Data " + dataKey,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Terhapus!",
                        text: "Data berhasil dihapus.",
                        icon: "success"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = deleteUrl;
                        }
                    });
                }
            });
        }
    </script>

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