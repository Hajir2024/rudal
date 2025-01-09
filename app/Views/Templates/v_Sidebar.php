<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('/') ?>">
        <div class="sidebar-brand-icon">
            <img src="<?= base_url('public/') ?>img/rudal_1.png" alt="rudal" width="60px">
        </div>
        <!-- <div class="sidebar-brand-text mx-2">
            <img src="<?= base_url('public/') ?>img/rudal-text-only.png" alt="rudal" width="100px" height="40px" class="mt-1">
        </div> -->
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= ($title == 'Dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('/') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Nav Item - Pages Collapse Menu -->
    <!-- Nav Item - Charts -->
    <li class="nav-item <?= ($title == 'Dokumen') ? 'active' : '' ?> ">
        <a class="nav-link" href="<?= base_url('Dokumen') ?>">
            <i class="fas fa-fw fa-book"></i>
            <span>Dokumen</span></a>
    </li>

    <!-- Nav Item - Charts
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Peminjaman</span>
        </a>
    </li> -->

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= ($title == 'Peminjaman') ? 'active' : '' ?> ">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePeminjaman"
            aria-expanded="true" aria-controls="collapsePeminjaman">
            <i class="fas fa-fw fa-hand-holding"></i>
            <span>Peminjaman</span>
        </a>
        <div id="collapsePeminjaman" class="collapse" aria-labelledby="headingPeminjaman" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('Pinjam') ?>">Pinjam</a>
                <a class="collapse-item" href="<?= base_url('DaftarPeminjam') ?>">Daftar Peminjam</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= ($title == 'Data Master') ? 'active' : '' ?> "">
        <a class=" nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataMaster"
        aria-expanded="true" aria-controls="collapseDataMaster">
        <i class="fas fa-fw fa-folder"></i>
        <span>Data Master</span>
        </a>
        <div id="collapseDataMaster" class="collapse" aria-labelledby="headingDataMaster" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('Bidang') ?>">Bidang</a>
                <a class="collapse-item" href="<?= base_url('SubKegiatan') ?>">Sub Kegiatan</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <!-- Topbar Search -->
            <form
                class="d-none d-sm-inline-block form-inline ">
                <h5>RUDAL - Ruang Arsip Digital</h5>
                <i>Pengarsipan yang Membawa Keamanan dan Kemudahan dalam Penyimpanan Dokumen</i>
            </form>
            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">
                <small class="mt-auto mb-auto mr-1"><?= hari_ini(); ?>, </small><small id="time" class="font-weight-bold mt-auto mb-auto"></small>
                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <li class="nav-item dropdown no-arrow d-sm-none">
                    <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-search fa-fw"></i>
                    </a>
                    <!-- Dropdown - Messages -->
                    <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                        aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto w-100 navbar-search">
                            <div class="input-group">
                                <input type="text" class="form-control bg-light border-0 small"
                                    placeholder="Search for..." aria-label="Search"
                                    aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                        <img class="img-profile rounded-circle"
                            src="<?= base_url('public/') ?>img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid mb-5 pb-5">