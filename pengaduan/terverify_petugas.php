<?php

$title = 'Laporan Terverifikasi';

require 'app.php';

require 'header.php';

require 'navPetugas.php';

// Ambil NIK dari form pencarian (GET)
$filter_nik = isset($_GET['nik']) ? $_GET['nik'] : '';

// Query laporan sudah ditanggapi
$ditanggapi = mysqli_query($conn, "
  SELECT p.*, t.id_tanggapan 
  FROM pengaduan p 
  INNER JOIN tanggapan t ON p.id_pengaduan = t.id_pengaduan 
  WHERE p.status = 'selesai'
  " . ($filter_nik ? "AND p.nik LIKE '%$filter_nik%'" : "") . "
  ORDER BY p.id_pengaduan DESC
");

// Query laporan belum ditanggapi
$belum_ditanggapi = mysqli_query($conn, "
  SELECT * FROM pengaduan 
  WHERE status = 'selesai' 
  AND id_pengaduan NOT IN (SELECT id_pengaduan FROM tanggapan)
  " . ($filter_nik ? "AND nik LIKE '%$filter_nik%'" : "") . "
  ORDER BY id_pengaduan DESC
");

?>

<div class="row" data-aos="fade-up">
  <div class="col-6">
    <h3 class="text-gray-800">Daftar Laporan Terverifikasi</h3>
  </div>
  <div class="col-6 d-flex justify-content-end">
    <form class="form-inline" method="get">
      <input class="form-control mr-1 col-8" type="search" name="nik" placeholder="Cari NIK" value="<?= htmlspecialchars($filter_nik); ?>" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit">
        <i class="fas fa-search"></i>
      </button>
    </form>
  </div>
</div>

<?php if ($filter_nik): ?>
  <div class="col-12 mt-2">
    <div class="alert alert-info">Hasil pencarian untuk NIK: <strong><?= htmlspecialchars($filter_nik); ?></strong></div>
  </div>
<?php endif; ?>

<hr>

<!-- Tabel Belum Ditanggapi -->
<h4 class="mt-4 text-danger">Laporan Belum Ditanggapi</h4>
<table class="table table-bordered shadow-sm text-center" data-aos="fade-up">
  <thead>
    <tr>
      <th>No</th>
      <th class="text-nowrap">Tanggal</th>
      <th>NIK</th>
      <th>Isi Laporan</th>
      <th>Foto</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; while ($row = mysqli_fetch_assoc($belum_ditanggapi)) : ?>
      <tr>
        <td><?= $no++; ?>.</td>
        <td class="text-nowrap"><?= $row["tgl_pengaduan"]; ?></td>
        <td><?= $row["nik"]; ?></td>
        <td><?= $row["isi_laporan"]; ?></td>
        <td><img src="assets/img/<?= $row["foto"]; ?>" width="50"></td>
        <td><a href="tanggapi_petugas.php?id_pengaduan=<?= $row["id_pengaduan"]; ?>" class="btn btn-outline-success">Tanggapi</a></td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

<!-- Tabel Sudah Ditanggapi -->
<h4 class="mt-5 text-success">Laporan Sudah Ditanggapi</h4>
<table class="table table-bordered shadow-sm text-center" data-aos="fade-up">
  <thead>
    <tr>
      <th>No</th>
      <th class="text-nowrap">Tanggal</th>
      <th>NIK</th>
      <th>Isi Laporan</th>
      <th>Foto</th>
      <th>Keterangan</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; while ($row = mysqli_fetch_assoc($ditanggapi)) : ?>
      <tr>
        <td><?= $no++; ?>.</td>
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
        <td><span class="badge badge-success">Sudah Ditanggapi</span></td>
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
