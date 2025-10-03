<?php
session_start();

$title = 'Tanggapan';

require 'app.php';
require 'header.php';
require 'navUser.php';

// Cek login & nik session
if (!isset($_SESSION['nik'])) {
  header("Location: login_user.php");
  exit;
}

$nik = $_SESSION['nik'];

// Ambil data tanggapan hanya milik user yg login
$query = "SELECT * FROM (
            (tanggapan 
            INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan)
            INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas
          ) WHERE pengaduan.nik = '$nik'
          ORDER BY id_tanggapan DESC";

$result = mysqli_query($conn, $query);
?>
<h3 class="text-gray-900" data-aos="fade-left">Tanggapan Laporan Anda</h3>
<table class="table table-bordered shadow text-center" data-aos="fade-up" data-aos-duration="900">
  <thead>
    <tr>
      <th>No</th>
      <th>NIK</th>
      <th>Tanggal Laporan</th>
      <th>Laporan</th>
      <th>Tanggal Tanggapan</th>
      <th>Tanggapan</th>
      <th>Nama Petugas</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; ?>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <tr>
        <td><?= $i++; ?>.</td>
        <td><?= $row["nik"]; ?></td>
        <td class="text-nowrap"><?= $row["tgl_pengaduan"]; ?></td>
        <td><?= $row["isi_laporan"]; ?></td>
        <td><?= $row["tgl_tanggapan"]; ?></td>
        <td><?= $row["tanggapan"]; ?></td>
        <td><?= $row["nama_petugas"]; ?></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<?php require 'footer.php'; ?>
