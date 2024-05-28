<div class="main-menu">
    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="/" class="logo-light">
            <img src="../../assets/images/logo-dotryn.png" alt="logo" class="logo-lg" height="28">
            <img src="../../assets/images/icon-dotryn.png" alt="small logo" class="logo-sm" height="28">
        </a>

        <!-- Brand Logo Dark -->
        <a href="/" class="logo-dark">
            <img src="../../assets/images/logo-dotryn.png" alt="dark logo" class="logo-lg" height="28">
            <img src="../../assets/images/icon-dotryn.png" alt="small logo" class="logo-sm" height="28">
        </a>
    </div>

    <!--- Menu -->
    <div data-simplebar>
        <ul class="app-menu">

            <li class="menu-title">Main</li>

            <li class="menu-item <?php echo $page === 'Dashboard' ? 'active' : ''; ?>">
                <a href="../../dashboard/" class="menu-link waves-effect waves-light <?php echo $page === 'Dashboard' ? 'bg-dark active' : ''; ?>">
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Dashboard </span>
                </a>
            </li>

            <?php
            if ($_SESSION['level'] === 'Administrator' || $_SESSION['level'] === 'User') {
                echo '
                <li class="menu-item ' . ($page === 'Surat Masuk' ? 'active' : '') . '">
                    <a href="../../dashboard/surat-masuk/" class="menu-link waves-effect waves-light ' . ($page === 'Surat Masuk' ? 'bg-dark active' : '') . '">
                        <span class="menu-icon"><i class="mdi mdi-email-receive-outline"></i></span>
                        <span class="menu-text"> Surat Masuk </span>
                    </a>
                </li>
                <li class="menu-item ' . ($page === 'Surat Keluar' ? 'active' : '') . '">
                    <a href="../../dashboard/surat-keluar/" class="menu-link waves-effect waves-light ' . ($page === 'Surat Keluar' ? 'bg-dark active' : '') . '">
                        <span class="menu-icon"><i class="mdi mdi-email-send-outline"></i></span>
                        <span class="menu-text"> Surat Keluar </span>
                    </a>
                </li>
                <li class="menu-item ' . ($page === 'Instansi' ? 'active' : '') . '">
                    <a href="../../dashboard/instansi/" class="menu-link waves-effect waves-light ' . ($page === 'Instansi' ? 'bg-dark active' : '') . '">
                        <span class="menu-icon"><i class="mdi mdi-office-building-outline"></i></span>
                        <span class="menu-text"> Instansi </span>
                    </a>
                </li>
                <li class="menu-item ' . ($page === 'Laporan' ? 'active' : '') . '">
                    <a href="../../dashboard/laporan/" class="menu-link waves-effect waves-light ' . ($page === 'Laporan' ? 'bg-dark active' : '') . '">
                        <span class="menu-icon"><i class="mdi mdi-printer"></i></span>
                        <span class="menu-text"> Laporan </span>
                    </a>
                </li>';
            }
            ?>


            <?php
            if ($_SESSION['level'] === 'Administrator' || $_SESSION['level'] === 'Validator') {
                echo '
                <li class="menu-title">Validator</li>

                <li class="menu-item ' . ($page === 'Pending' ? 'active' : '') . '">
                    <a href="../../dashboard/pending/" class="menu-link waves-effect waves-light ' . ($page === 'Pending' ? 'bg-dark active' : '') . '">
                        <span class="menu-icon"><i class="mdi mdi-email-alert-outline"></i></span>
                        <span class="menu-text"> Pending </span>';

                $data = $con->total_surat_pending();
                if ($data != null) {
                    echo '<span class="badge bg-secondary rounded ms-auto">' . $data . '</span>';
                }

                echo '   
                    </a>
                </li>

                <li class="menu-item ' . ($page === 'Valid' ? 'active' : '') . '">
                    <a href="../../dashboard/valid/" class="menu-link waves-effect waves-light ' . ($page === 'Valid' ? 'bg-dark active' : '') . '">
                        <span class="menu-icon"><i class="mdi mdi-email-check-outline"></i></span>
                        <span class="menu-text"> Valid </span>
                    </a>
                </li>

                <li class="menu-item ' . ($page === 'Tidak Valid' ? 'active' : '') . '">
                    <a href="../../dashboard/invalid/" class="menu-link waves-effect waves-light ' . ($page === 'Tidak Valid' ? 'bg-dark active' : '') . '">
                        <span class="menu-icon"><i class="mdi mdi-email-remove-outline"></i></span>
                        <span class="menu-text"> Tidak Valid </span>
                    </a>
                </li>';
            }
            ?>


            <?php
            if ($_SESSION['level'] === 'Administrator') {
                echo '
                <li class="menu-title">Administrator</li>
                
                <li class="menu-item ' . ($page === 'Kategori Dokumen' ? 'active' : '') . '">
                    <a href="../../dashboard/kategori/" class="menu-link waves-effect waves-light ' . ($page === 'Kategori Dokumen' ? 'bg-dark active' : '') . '">
                        <span class="menu-icon"><i class="mdi mdi-format-list-bulleted"></i></span>
                        <span class="menu-text"> Kategori Dokumen </span>
                    </a>
                </li>

                <li class="menu-item ' . ($page === 'Pengguna' ? 'active' : '') . '">
                    <a href="../../dashboard/users/" class="menu-link waves-effect waves-light ' . ($page === 'Pengguna' ? 'bg-dark active' : '') . '">
                        <span class="menu-icon"><i class="mdi mdi-account-multiple-outline"></i></span>
                        <span class="menu-text"> Users </span>
                    </a>
                </li>
                ';
            }
            ?>

        </ul>
    </div>
</div>