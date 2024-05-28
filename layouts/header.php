<div class="navbar-custom">
    <div class="topbar">
        <div class="topbar-menu d-flex align-items-center gap-lg-2 gap-1">

            <!-- Brand Logo -->
            <div class="logo-box">
                <!-- Brand Logo Light -->
                <a href="/" class="logo-light">
                    <img src="../assets/images/logo-dotryn.png" alt="logo" class="logo-lg" height="22">
                    <img src="../assets/images/icon-dotryn.png" alt="small logo" class="logo-sm" height="22">
                </a>

                <!-- Brand Logo Dark -->
                <a href="/" class="logo-dark">
                    <img src="../assets/images/logo-dotryn.png" alt="dark logo" class="logo-lg" height="22">
                    <img src="../assets/images/icon-dotryn.png" alt="small logo" class="logo-sm" height="22">
                </a>
            </div>

            <!-- Sidebar Menu Toggle Button -->
            <button class="button-toggle-menu">
                <i class="mdi mdi-menu"></i>
            </button>
        </div>

        <ul class="topbar-menu d-flex align-items-center gap-4">

            <li class="nav-link" id="theme-mode">
                <i class="bx bx-moon font-size-24"></i>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <?php
                    if ($_SESSION['gambar'] == null) {
                        echo '
                        <img src="../assets/images/users/default-photo.png" alt="user-image" class="rounded-circle">
                        <span class="ms-1 d-none d-md-inline-block">
                            ' . ucfirst($_SESSION['nama']) . '<i class="mdi mdi-chevron-down"></i>
                        </span>';
                    } else {
                        echo '
                        <img src="../assets/images/users/' . $dataGambar['gambar'] . '" alt="user-image" class="rounded-circle">
                        <span class="ms-1 d-none d-md-inline-block">
                            ' . ucfirst($_SESSION['nama']) . '<i class="mdi mdi-chevron-down"></i>
                        </span>';
                    }
                    ?>

                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow"><?php echo ucfirst($_SESSION['level']); ?></h6>
                    </div>

                    <!-- item-->
                    <a href="../dashboard/profiles" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>My Profile</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="../proses/proses_logout" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </li>

        </ul>
    </div>
</div>