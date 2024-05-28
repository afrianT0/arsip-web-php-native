<?php
require_once '../../validasi/validasi_login.php';
require_once '../../validasi/validasi_user.php';

include '../../db/koneksi_db.php';
$con = new koneksi_db;

$surat          = isset($_GET['surat']) ? $_GET['surat'] : '';
$tanggal_awal   = isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : '';
$tanggal_akhir  = isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : '';

if (empty($tanggal_awal) || empty($tanggal_akhir) || empty($surat)) {
    $query      = $con->get_all_surat();
    $url_cetak  = "print.php";
    $label      = "Semua Data Arsip";
    $tanggal    = date('d/m/Y', strtotime($tanggal_awal)) . " s/d " . date('d/m/Y', strtotime($tanggal_akhir));
} else {
    $url_cetak  = "print?surat=$surat&tanggal_awal=$tanggal_awal&tanggal_akhir=$tanggal_akhir&filter=true";
    $tanggal    = date('d/m/Y', strtotime($tanggal_awal)) . " s/d " . date('d/m/Y', strtotime($tanggal_akhir));

    if ($surat == 1) {
        $label      = "Data Arsip Masuk";
    } elseif ($surat == 2) {
        $label      = "Data Arsip Keluar";
    }

    switch ($surat) {
        case 0:
            $query = $con->cetak_semua_surat($tanggal_awal, $tanggal_akhir);
            break;
        case 1:
            $query = $con->cetak_semua_surat_masuk($surat, $tanggal_awal, $tanggal_akhir);
            break;
        case 2:
            $query = $con->cetak_semua_surat_keluar($surat, $tanggal_awal, $tanggal_akhir);
            break;
        default:
            $query = $con->get_all_surat();
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="dark" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Laporan <?= $label ?> - Print</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico">

    <!-- Style -->
    <?php
    require_once '../../dashboard/layouts/css.php';
    ?>
</head>

<body>
    <!-- Begin page -->
    <div class="layout-wrapper">

        <!-- Start Page Content here -->
        <div class="page-content">

            <div class="px-3">

                <!-- Start Content-->
                <div class="container-fluid">

                    <div class="row">
                        <div class="col">

                            <div class="text-center my-4">
                                <h3 class="text-dark">PT. SATU DUA TIGA</h3>
                                <h4 class="text-dark">Laporan <?= $label ?></h4>
                                <h5 class="text-dark">Periode : <?= $tanggal ?></h5>
                            </div>

                            <div class="d-flex justify-content-center">
                                <table class="table-sm table-bordered">
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
                                            <th>Status</th>
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
                                                    <td><?= $data['kategori_nama']; ?></td>
                                                    <td><?= $data['nomor']; ?></td>
                                                    <td><?= $data['nama']; ?></td>
                                                    <td><?= $data['instansi_nama']; ?></td>
                                                    <td><?= date('d/m/Y', strtotime($data['tanggal'])); ?></td>
                                                    <td><?= $data['deskripsi']; ?></td>
                                                    <td><?= $data['user_nama']; ?></td>
                                                    <td><?= $data['status'] == 1 ? 'Pending' : ($data['status'] == 2 ? 'Valid' : 'Tidak Valid'); ?></td>
                                                    <td><?= $data['tipe_surat'] == 1 ? 'Masuk' : 'Keluar'; ?></td>
                                                </tr>
                                        <?php
                                            }
                                        } else {
                                            echo "<tr><td colspan='9'>Data tidak ada</td></tr>";
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>

                        </div><!-- end col-->
                    </div>
                    <!-- end row-->

                </div> <!-- container -->

            </div> <!-- content -->

        </div>
        <!-- End Page content -->


    </div>
    <!-- END wrapper -->

    <!-- Scripts -->
    <?php
    require_once '../../dashboard/layouts/script.php';
    ?>

    <script type="text/javascript">
        // window.print();
        // window.onafterprint = function() {
        //     window.close();
        // };
    </script>

</body>

</html>