<?php
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit;
}

$title = 'Dashboard';

require 'header.php';

require 'navPetugas.php';

?>


<div class="d-flex justify-content-center text-center py-5" data-aos="zoom-in">
  <div class="content col-8">
    <i class="fas fa-atlas fa-5x mb-2"></i>
    <h1 class="mb-3">Selamat Datang di <span class="text-success"> Pengaduan</span> Barang hilang <br>
      <span class="text-success">Selamat Bekerja </span>dan Semangat.
    </h1>
    <a href="laporan_petugas.php" class="btn btn-success btn-icon-split">
      <span class="icon text-white-50">
        <i class="fas fa-book-open"></i>
      </span>
      <span class="text">Lihat Laporan</span>
    </a>
  </div>
</div>



<?php require 'footer.php'; ?>