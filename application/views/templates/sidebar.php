<!-- Sidebar -->
<?php
    $role = $this->session->userdata('login_session')['role'];
?>
<ul class="navbar-nav bg-white sidebar sidebar-light accordion shadow-sm" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex text-white align-items-center bg-primary justify-content-center" href="">
        <div class="sidebar-brand-icon">
            <i class="fas fa-university"></i>
        </div>
        <div class="sidebar-brand-text mx-3">CV.VICTORY ABADI</div>
    </a>
    <?php if ($role == 'admin') { ?>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('supplier'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Supplier</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('customer'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Data Customer</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseMaster">
            <i class="fas fa-fw fa-folder"></i>
            <span>Barang</span>
        </a>
        <div id="collapseMaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-light py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Barang:</h6>
                <a class="collapse-item" href="<?= base_url('satuan'); ?>">Satuan Barang</a>
                <a class="collapse-item" href="<?= base_url('jenis'); ?>">Jenis Barang</a>
                <a class="collapse-item" href="<?= base_url('barang'); ?>">Data Barang</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('penjualan'); ?>">
            <i class="fas fa-fw fa-upload"></i>
            <span>Penjualan</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Settings
    </div>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user'); ?>">
            <i class="fas fa-fw fa-user-plus"></i>
            <span>User Management</span>
        </a>
    </li>
    
    <?php } else if ($role == 'gudang') { ?>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Master
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('supplier'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Supplier</span>
        </a>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseMaster">
            <i class="fas fa-fw fa-folder"></i>
            <span>Barang</span>
        </a>
        <div id="collapseMaster" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-light py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Barang:</h6>
                <a class="collapse-item" href="<?= base_url('satuan'); ?>">Satuan Barang</a>
                <a class="collapse-item" href="<?= base_url('jenis'); ?>">Jenis Barang</a>
                <a class="collapse-item" href="<?= base_url('barang'); ?>">Data Barang</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('barangmasuk'); ?>">
            <i class="fas fa-fw fa-download"></i>
            <span>Barang Masuk</span>
        </a>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link pb-0" href="<?= base_url('barangkeluar'); ?>">
            <i class="fas fa-fw fa-upload"></i>
            <span>Barang Keluar</span>
        </a>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('requestbarang/index_gudang'); ?>">
            <i class="fas fa-fw fa-upload"></i>
            <span>Request Barang</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Report
    </div>

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('laporan'); ?>">
            <i class="fas fa-fw fa-print"></i>
            <span>Cetak Laporan</span>
        </a>
    </li>
    <?php } else if ($role == 'supervisor') { ?>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Transaksi
    </div>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('requestbarang/index_admin'); ?>">
            <i class="fas fa-fw fa-upload"></i>
            <span>List Request Barang</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Settings
    </div>

    <!-- Nav Item -->
    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('user'); ?>">
            <i class="fas fa-fw fa-user-plus"></i>
            <span>User Management</span>
        </a>
    </li>
    <?php } ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->