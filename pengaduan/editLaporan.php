<?php
session_start();
require 'app.php';

$title = 'Edit Laporan';
require 'header.php';
require 'navUser.php';

// Cek login
if (!isset($_SESSION['username'])) {
  header("Location: login_user.php");
  exit;
}

// Ambil ID pengaduan dari URL
if (!isset($_GET['id_pengaduan'])) {
  echo "<script>alert('ID Laporan tidak ditemukan.'); window.location.href='lihatLaporan.php';</script>";
  exit;
}

$id_pengaduan = mysqli_real_escape_string($conn, $_GET['id_pengaduan']);

// Ambil data laporan
$query = "SELECT * FROM pengaduan WHERE id_pengaduan = '$id_pengaduan'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Cek status agar tidak bisa edit jika bukan status '0'
if ($data['status'] != '0') {
  echo "<script>alert('Laporan tidak dapat diedit karena sudah diverifikasi.'); window.location.href='lihatLaporan.php';</script>";
  exit;
}

// Proses form update
if (isset($_POST['update'])) {
  $isi_laporan = mysqli_real_escape_string($conn, $_POST['isi_laporan']);

  // Cek apakah user upload gambar baru
  if ($_FILES['foto']['name']) {
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $path = "assets/img/";

    // Hapus foto lama jika ada
    if (file_exists($path . $data['foto']) && $data['foto'] != '') {
      unlink($path . $data['foto']);
    }

    // Simpan foto baru dengan nama unik
    $newName = uniqid() . '-' . $foto;
    move_uploaded_file($tmp, $path . $newName);
  } else {
    $newName = $data['foto']; // gunakan foto lama jika tidak upload baru
  }

  // Update data di database
  $update = mysqli_query($conn, "UPDATE pengaduan SET isi_laporan='$isi_laporan', foto='$newName' WHERE id_pengaduan='$id_pengaduan'");

  if ($update) {
    echo "<script>alert('Laporan berhasil diperbarui!'); window.location.href='lihatLaporan.php';</script>";
  } else {
    echo "<script>alert('Gagal memperbarui laporan.');</script>";
  }
}
?>

<div class="container mt-4" data-aos="fade-up">
  <h3 class="text-gray-800 mb-4">Edit Laporan Anda</h3>
  <form action="" method="POST" enctype="multipart/form-data" class="shadow-sm p-4 bg-white rounded">

    <div class="mb-3">
      <label for="isi_laporan" class="form-label">Isi Laporan</label>
      <textarea name="isi_laporan" id="isi_laporan" rows="5" class="form-control" required><?= $data['isi_laporan']; ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Foto Saat Ini</label><br>
      <?php if ($data['foto']): ?>
        <img src="assets/img/<?= $data['foto']; ?>" width="120" class="img-thumbnail">
      <?php else: ?>
        <span class="text-muted">Tidak ada foto</span>
      <?php endif; ?>
    </div>

    <div class="mb-3">
      <label for="foto" class="form-label">Upload Foto Baru (Opsional)</label>
      <input type="file" name="foto" id="foto" class="form-control">
    </div>

    <div class="d-flex justify-content-between">
      <a href="lihatLaporan.php" class="btn btn-secondary">Kembali</a>
      <button type="submit" name="update" class="btn btn-success">Update Laporan</button>
    </div>
  </form>
</div>

<?php require 'footer.php'; ?>
