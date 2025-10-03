<?php
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit;
}

$title = 'Dashboard';

require 'header.php';
require 'navUser.php';
?>


<div class="row py-5">
  <div class="col-6 py-5 mt-3">
    <div class="desc ml-5">
      <h2 class="text-gray-800" data-aos="fade-down">Selamat Datang Di Website <span class="text-success"> Pengaduan Barang Hilang Desa Wanasaraya</h2>
      <p data-aos="fade-down">Website ini dibuat untuk melihat laporan atau keluh kesah masyarakat dan menjawab
        nya dengan satu platform.</p>
      <a href="buatLaporan.php" class="btn btn-success shadow" data-aos="fade-up">Buat Laporan</a>
      <a href="lihatLaporan.php" class="btn btn-outline-success ml-2" data-aos="fade-up" data-aos-duration="500">Lihat Laporan</a>
    </div>
  </div>
  <div class="col-6">
    <div class="image" data-aos="fade-left">
      <img src="assets/img/awal.png" width="330" alt="">
    </div>
  </div>
</div>



<?php require 'footer.php'; ?>