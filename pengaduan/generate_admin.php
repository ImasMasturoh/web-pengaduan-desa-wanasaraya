<?php

$title = 'Generate Laporan';

require 'app.php';

require 'header.php';

require 'navAdmin.php';


// Tangkap pencarian NIK jika ada
$search_nik = isset($_GET['nik']) ? $_GET['nik'] : '';

// Query dengan filter NIK (jika ada)
$query = "SELECT * FROM (
            (tanggapan 
            INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan)
            INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas
          )";

if ($search_nik) {
  $query .= " WHERE pengaduan.nik LIKE '%$search_nik%'";
}

$query .= " ORDER BY id_tanggapan DESC";
$result = mysqli_query($conn, $query);
?>

<div class="row">
  <div class="col-6">
    <form class="form-inline" method="get" data-aos="zoom-in">
      <div class="input-group mt-2">
        <input type="text" name="nik" class="form-control bg-gray-300 border-0 small" placeholder="Search NIK..." value="<?= htmlspecialchars($search_nik); ?>">
        <div class="input-group-append">
          <button class="btn btn-success" type="submit">
            <i class="fas fa-search fa-sm"></i>
          </button>
        </div>
      </div>
    </form>
  </div>
  <div class="col-6">
    <div class="d-flex justify-content-end">
      <div class="card shadow col-6 py-2" data-aos="zoom-in">
        <a href="#generate" class="d-block card-header" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="generate">
          <h6 class="m-0 font-weight-bold text-success">Tutup Laporan</h6>
        </a>
      </div>
    </div>
  </div>
</div>

<?php if ($search_nik): ?>
  <div class="col-12 mt-2">
    <div class="alert alert-info">Hasil pencarian untuk NIK: <strong><?= htmlspecialchars($search_nik); ?></strong></div>
  </div>
<?php endif; ?>

<hr>

<div class="row">
  <?php while ($row = mysqli_fetch_assoc($result)) : ?>
    <div class="col-md-4 mb-4">
      <div class="card shadow" data-aos="fade-up">
        <div class="card-header">
          <div class="row">
            <div class="col-6">
              <h6 class="m-0 font-weight-bold text-success mt-2">NIK : <?= $row['nik']; ?></h6>
            </div>
            <div class="col-6">
              <div class="d-sm-flex align-items-center justify-content-end">
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
                  <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
                </a>
              </div>
            </div>
          </div>
        </div>
        <div class="collapse show" id="generate">
          <div class="card-body">
            <div class="row">
              <div class="col-4">
                <h6 class="text-success font-weight-bold">Foto :
                  <img src="assets/img/<?= $row['foto']; ?>" width="80" alt="Foto Laporan" style="cursor:pointer;" onclick="showImage('../../assets/img/<?= $row['foto']; ?>')">
                </h6>
              </div>
              <div class="col-8">
                <h6><span class="text-success font-weight-bold">Tanggal Pengaduan :</span> <?= $row['tgl_pengaduan']; ?></h6>
                <h6><span class="text-success font-weight-bold">Tanggal Tanggapan :</span> <?= $row['tgl_tanggapan']; ?></h6>
              </div>
            </div>
            <hr class="bg-success">
            <h6><span class="text-success font-weight-bold">Laporan :</span> <?= $row['isi_laporan']; ?></h6>
            <h6><span class="text-success font-weight-bold">Tanggapan :</span> <?= $row['tanggapan']; ?></h6>
            <hr class="bg-success">
            <div class="row">
              <div class="col-8 mt-2">
                <h6><span class="text-success font-weight-bold">Ditanggapi oleh :</span> <?= $row['nama_petugas']; ?></h6>
              </div>
              <div class="col-4">
                <div class="d-flex justify-content-end">
                  <a href="preview_admin.php?id_tanggapan=<?= $row['id_tanggapan']; ?>" class="btn btn-outline-success">Preview</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
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
