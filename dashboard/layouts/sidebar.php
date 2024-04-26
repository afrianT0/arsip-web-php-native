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

            <li class="menu-item <?php echo $_SERVER['REQUEST_URI'] == "/dashboard/" ? 'active' : ''; ?>">
                <a href="/dashboard/" class="menu-link waves-effect waves-light <?php echo $_SERVER['REQUEST_URI'] == "/dashboard/" ? 'bg-dark active' : ''; ?>">
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Dashboard </span>
                </a>
            </li>
            <li class="menu-item <?php echo strpos($_SERVER['REQUEST_URI'], "/dashboard/in-archives/") === 0 ? 'active' : ''; ?>">
                <a href="/dashboard/in-archives/" class="menu-link waves-effect waves-light <?php echo strpos($_SERVER['REQUEST_URI'], "/dashboard/in-archives/") === 0 ? 'bg-dark active' : ''; ?>">
                    <span class="menu-icon"><i class="mdi mdi-email-receive-outline"></i></span>
                    <span class="menu-text"> Surat Masuk </span>
                </a>
            </li>
            <li class="menu-item <?php echo strpos($_SERVER['REQUEST_URI'], "/dashboard/out-archives/") === 0 ? 'active' : ''; ?>">
                <a href="/dashboard/out-archives/" class="menu-link waves-effect waves-light <?php echo strpos($_SERVER['REQUEST_URI'], "/dashboard/out-archives/") === 0 ? 'bg-dark active' : ''; ?>">
                    <span class="menu-icon"><i class="mdi mdi-email-send-outline"></i></span>
                    <span class="menu-text"> Surat Keluar </span>
                </a>
            </li>
            <li class="menu-item <?php echo strpos($_SERVER['REQUEST_URI'], "/dashboard/instansi/") === 0 ? 'active' : ''; ?>">
                <a href="/dashboard/instansi/" class="menu-link waves-effect waves-light <?php echo strpos($_SERVER['REQUEST_URI'], "/dashboard/instansi/") === 0 ? 'bg-dark active' : ''; ?>">
                    <span class="menu-icon"><i class="mdi mdi-office-building-outline"></i></span>
                    <span class="menu-text"> Instansi </span>
                </a>
            </li>
            <li class="menu-item <?php echo strpos($_SERVER['REQUEST_URI'], "/dashboard/laporan/") === 0 ? 'active' : ''; ?>">
                <a href="/dashboard/laporan/" class="menu-link waves-effect waves-light <?php echo strpos($_SERVER['REQUEST_URI'], "/dashboard/laporan/") === 0 ? 'bg-dark active' : ''; ?>">
                    <span class="menu-icon"><i class="mdi mdi-printer"></i></span>
                    <span class="menu-text"> Laporan </span>
                </a>
            </li>

            <?php
            if ($_SESSION['level'] === 'Administrator') {
                echo '
                <li class="menu-title">Administrator</li>
                
                <li class="menu-item ' . (strpos($_SERVER['REQUEST_URI'], "/dashboard/categories/") === 0 ? 'active' : '') . '">
                    <a href="/dashboard/categories/" class="menu-link waves-effect waves-light ' . (strpos($_SERVER['REQUEST_URI'], "/dashboard/categories/") === 0 ? 'bg-dark active' : '') . '">
                        <span class="menu-icon"><i class="mdi mdi-format-list-bulleted"></i></span>
                        <span class="menu-text"> Kategori Dokumen </span>
                    </a>
                </li>

                <li class="menu-item ' . (strpos($_SERVER['REQUEST_URI'], "/dashboard/users/") === 0 ? 'active' : '') . '">
                    <a href="/dashboard/users/" class="menu-link waves-effect waves-light ' . (strpos($_SERVER['REQUEST_URI'], "/dashboard/users/") === 0 ? 'bg-dark active' : '') . '">
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