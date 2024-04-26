<?php
require_once '../../validasi/validasi_login.php';

include '../../db/koneksi_db.php';
$con = new koneksi_db;
$dataPicture   = $con->select_user($_SESSION['id']);
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="dark" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Data Surat Masuk - Pengarsipan</title>
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
                                <h4 class="page-title mb-0">Data Surat Masuk</h4>
                            </div>
                            <div class="col-lg-6">
                                <div class="d-none d-lg-block">
                                    <ol class="breadcrumb m-0 float-end">
                                        <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Surat Masuk</li>
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
                                    <a class="btn btn-sm btn-primary mb-3" href="./create"><i class="mdi mdi-plus"></i> Tambah</a>

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
                                                    <th>Petugas</th>
                                                    <th>File</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>


                                            <tbody>
                                                <?php
                                                $counter = 1;
                                                foreach ($con->get_data_inArchives() as $data) {
                                                ?>
                                                    <tr>
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= $data['category_name']; ?></td>
                                                        <td><?= $data['nomor']; ?></td>
                                                        <td><?= $data['nama']; ?></td>
                                                        <td><?= $data['instansi_name']; ?></td>
                                                        <td><?= date('d/m/Y', strtotime($data['tanggal'])); ?></td>
                                                        <td><?= ucfirst($data['user_name']); ?></td>
                                                        <td>
                                                            <a class="btn btn-xs btn-soft-danger" href="./file/<?= $data["file"]; ?>" target="_blank"><i class="mdi mdi-file-outline" style="font-size: 16px;"></i></a>
                                                        <td>
                                                            <a class="btn btn-xs btn-soft-info" href="./detail?id=<?= $data["id"]; ?>">
                                                                <i class="mdi mdi-information-outline" style="font-size: 16px;"></i>
                                                            </a>
                                                            <?php
                                                            if ($_SESSION['username'] === $data['user_name'] || $_SESSION['level'] === 'Administrator') {
                                                                echo '
                                                                <a class="btn btn-xs btn-soft-warning" href="./edit?id=' . $data["id"] . '">
                                                                    <i class="mdi mdi-square-edit-outline" style="font-size: 16px;"></i>
                                                                </a>
                                                                <a class="btn btn-xs btn-soft-danger" onclick="hapus(this)" href="javascript:void(0);" data-id="' . $data["id"] . '" data-key="' . $data['nomor'] . '">
                                                                    <i class="mdi mdi-trash-can-outline" style="font-size: 16px;"></i>
                                                                </a>
                                                                ';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

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
                html: "Data yang dihapus adalah <strong>" + dataKey + "</strong>",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                }
            });
        }
    </script>

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