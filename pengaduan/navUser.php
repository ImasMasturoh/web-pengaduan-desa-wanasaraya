<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-atlas"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Pengaduan</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item <?php if ($title === "Dashboard") echo "active"; ?>">
            <a class="nav-link" href="dashboard.php">
                <i class="fas fa-users"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Fiture
        </div>


        <!-- Nav Item - Buat Laporan -->
        <li class="nav-item <?php if ($title === "Buat Laporan") echo "active"; ?>">
            <a class="nav-link" href="buatLaporan.php">
                <i class="fas fa-edit"></i>
                <span>Buat Laporan</span></a>
        </li>

        <!-- Nav Item - Laporan masyarakat -->
        <li class="nav-item <?php if ($title === "Laporan") echo "active"; ?>">
            <a class="nav-link" href="lihatLaporan.php">
                <i class="fas fa-book-open"></i>
                <span>Laporan masyarakat</span></a>
        </li>

        <!-- Nav Item - Tanggapan -->
        <li class="nav-item <?php if ($title === "Tanggapan") echo "active"; ?>">
            <a class="nav-link" href="tanggapan_user.php">
                <i class="fas fa-bookmark"></i>
                <span>Tanggapan</span></a>
        </li>

        <!-- Nav Item - Generate -->
        <li class="nav-item <?php if ($title === "Generate Laporan") echo "active"; ?>">
            <a class="nav-link" href="generate_user.php">
                <i class="fas fa-folder-open"></i>
                <span>Generate Laporan</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>


    </ul>
    <!-- End of Sidebar -->



    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
               <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none ">
                    <i class="fa fa-bars"></i>
                </button>

               <?php if (isset($_SESSION['nama'])) : ?>
                <span class="text-success ml-3 mt-1 d-none d-md-inline-block">
                    Hallo, <?= htmlspecialchars($_SESSION['nama']); ?>!
                </span>
            <?php endif; ?>


                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">

                        <!-- Dropdown - User Information -->
                        <a href="index.php" class="btn btn-outline-danger">Logout</a>

                    </li>

                </ul>

            </nav>

            <!-- End of Topbar -->

            <div class="container">