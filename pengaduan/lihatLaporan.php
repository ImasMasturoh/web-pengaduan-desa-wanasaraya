<?php
session_start(); // Harus di baris paling atas!

$title = 'Laporan';

require 'app.php';
require 'header.php';
require 'navUser.php';

// Cek login
if (!isset($_SESSION['username'])) {
  header("Location: login_user.php");
  exit;
}

// Ambil laporan berdasarkan NIK
$nik = mysqli_real_escape_string($conn, $_SESSION['nik']);
$result = mysqli_query($conn, "SELECT * FROM pengaduan WHERE nik = '$nik' ORDER BY id_pengaduan DESC");
?>

<div class="row" data-aos="fade-up">
  <div class="col-6">
    <h3 class="text-gray-800">Daftar Laporan Anda</h3>
  </div>
  <div class="col-6 d-flex justify-content-end">
    <a href="buatLaporan.php" class="btn btn-success btn-icon-split">
      <span class="icon text-white-50">
        <i class="fas fa-plus"></i>
      </span>
      <span class="text">Buat Laporan</span>
    </a>
  </div>
</div>

<hr>

<table class="table table-bordered shadow-sm text-center" data-aos="fade-up" data-aos-duration="700">
  <thead>
  <tr class="text-center">
    <th>No</th>
    <th>Tanggal</th>
    <th>NIK</th>
    <th>Isi Laporan</th>
    <th>Foto</th>
    <th>Status</th>
    <th>Action</th> 
  </tr>
</thead>
 <tbody>
  <?php $i = 1; ?>
  <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <tr>
      <td><?= $i++; ?></td>
      <td class="text-nowrap"><?= $row["tgl_pengaduan"]; ?></td>
      <td><?= $row["nik"]; ?></td>
      <td><?= $row["isi_laporan"]; ?></td>
     <td>
  <?php
    $foto = $row["foto"];
    $path = "assets/img/" . $foto;

    if (!empty($foto) && file_exists($path)) {
      echo '<img src="' . $path . '" width="50" style="cursor:pointer;" onclick="showImage(\'' . $path . '\')">';
    } else {
      echo '<span class="text-danger">Foto tidak tersedia</span>';
    }
  ?>
</td>
      <td>
        <?php
        $status = $row['status'];
        if ($status == '0') {
          echo '<span class="badge bg-secondary text-white">Belum Diverifikasi</span>';
        } elseif ($status == 'proses') {
          echo '<span class="badge bg-warning text-white">Sedang Diproses</span>';
        } elseif ($status == 'selesai') {
          echo '<span class="badge bg-success text-white">Selesai</span>';
        }
        ?>
      </td>
      <td>
        <?php if ($status == '0') : ?>
          <a href="editLaporan.php?id_pengaduan=<?= $row['id_pengaduan']; ?>" class="btn btn-sm btn-primary">
            Edit
          </a>
        <?php else : ?>
          <span class="text-muted">Terkunci</span>
        <?php endif; ?>
      </td>
    </tr>
  <?php endwhile; ?>
</tbody>
</table>

<!-- Modal Preview Gambar -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center">
        <img id="modalImage" src="" class="img-fluid" alt="Preview Gambar">
      </div>
    </div>
  </div>
</div>

<script>
  function showImage(src) {
    document.getElementById('modalImage').src = src;
    const modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
  }
</script>

<?php require 'footer.php'; ?>
