<?php
require 'app.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = mysqli_real_escape_string($conn, $_POST['id_pengaduan']);

  // Ambil nama file foto
  $query = mysqli_query($conn, "SELECT foto FROM pengaduan WHERE id_pengaduan = '$id'");
  $data = mysqli_fetch_assoc($query);
  $foto = $data['foto'];

  // Hapus foto jika ada
  if ($foto && file_exists("assets/img/$foto")) {
    unlink("assets/img/$foto");
  }

  // Hapus data tanggapan terlebih dahulu
  mysqli_query($conn, "DELETE FROM tanggapan WHERE id_pengaduan = '$id'");

  // Baru hapus pengaduan
  $delete = mysqli_query($conn, "DELETE FROM pengaduan WHERE id_pengaduan = '$id'");

  if ($delete) {
    echo "<script>alert('Laporan berhasil dihapus.'); window.location.href = 'laporan_admin.php';</script>";
  } else {
    echo "<script>alert('Gagal menghapus laporan.'); window.location.href = 'laporan_admin.php';</script>";
  }
} else {
  header("Location: laporan_admin.php");
}
