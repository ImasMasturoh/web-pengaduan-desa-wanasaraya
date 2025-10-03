<?php
$title = 'Laporan Masyarakat';

require 'app.php';

require 'header.php';

require 'navAdmin.php';


// Query berdasarkan status laporan
$pending = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = '0' ORDER BY id_pengaduan DESC");
$processing = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = 'proses' ORDER BY id_pengaduan DESC");
$completed = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = 'selesai' ORDER BY id_pengaduan DESC");
?>


<!-- LAPORAN BELUM DIVERIFIKASI -->
<div class="row mt-4" data-aos="fade-up">
  <div class="col-12">
    <h4 class="text-grey">🔍 Laporan Belum Diverifikasi</h4>
    <hr>
    <table class="table table-bordered shadow-sm text-center">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>NIK</th>
          <th>Isi Laporan</th>
          <th>Foto</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($pending)) : ?>
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
              <form action="verify_admin.php" method="POST">
                <input type="hidden" name="id_pengaduan" value="<?= $row["id_pengaduan"]; ?>">
                <button type="submit" class="btn btn-success btn-sm">Verifikasi</button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<!-- LAPORAN DIPROSES -->
<div class="row mt-5" data-aos="fade-up">
  <div class="col-12">
    <h4 class="text-warning">🔄 Laporan Sedang Diproses</h4>
    <hr>
    <?php if (mysqli_num_rows($processing) > 0): ?>
    <table class="table table-bordered shadow-sm text-center">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>NIK</th>
          <th>Isi Laporan</th>
          <th>Foto</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $j = 1; ?>
        <?php while ($row = mysqli_fetch_assoc($processing)) : ?> 
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
            <td><span class="badge bg-warning text-white">Diproses</span></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
    <?php else: ?>
      <div class="alert alert-info text-center">Tidak ada laporan yang sedang diproses.</div>
    <?php endif; ?>
  </div>
</div>

<!-- HISTORY LAPORAN SELESAI -->
<div class="row mt-5" data-aos="fade-up">
  <div class="col-12">
    <h4 class="text-primary">📁 Laporan Selesai</h4>
    <hr>
    <?php
    $selesai = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = 'selesai' ORDER BY id_pengaduan DESC");
    ?>
    <?php if (mysqli_num_rows($selesai) > 0): ?>
      <table class="table table-bordered shadow-sm text-center">
        <thead>
          <tr>
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
          <?php $k = 1; ?>
          <?php while ($row = mysqli_fetch_assoc($selesai)) : ?>
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
                <span class="badge bg-success text-white">Selesai</span>
              </td>
              <td>
                <form action="hapusLaporan_admin.php" method="POST" onsubmit="return confirm('Yakin ingin menghapus laporan ini?');">
                  <input type="hidden" name="id_pengaduan" value="<?= $row["id_pengaduan"]; ?>">
                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <div class="alert alert-info text-center">Belum ada laporan selesai.</div>
    <?php endif; ?>
  </div>
</div>

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
