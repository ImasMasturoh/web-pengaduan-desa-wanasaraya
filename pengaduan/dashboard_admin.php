<?php
session_start();

if (!isset($_SESSION['nama'])) {
    header("Location: login.php");
    exit;
}

$title = 'Dashboard';

require 'app.php';

require 'header.php';

require 'navAdmin.php';


// logic backend


// menghitung total pengaduan
$pengaduan = mysqli_query($conn, "SELECT COUNT(*) as total FROM pengaduan");

// menghitung total tanggapan
$tanggapan = mysqli_query($conn, "SELECT COUNT(*) as total FROM tanggapan");

// menghitung total akun masyarakat
$masyarakat = mysqli_query($conn, "SELECT COUNT(*) as total FROM masyarakat");

// query untuk menjalankan looping generate
$query = "SELECT * FROM (( tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan = pengaduan.id_pengaduan )
                          INNER JOIN petugas ON tanggapan.id_petugas = petugas.id_petugas )";

$result = mysqli_query($conn, $query);

?>


<!-- Card -->
<?php while ($row = mysqli_fetch_assoc($pengaduan)) : ?>
  <div class="row mb-3">
  <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="300">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col ml-3">
            <div class="h5 mb-0 font-weight-bold text-info"><?= $row['total']; ?> Pengaduan</div>
          </div>
          <i class="fas fa-comment fa-2x text-gray-500"></i>
        </div>
      </div>
    </div>
  </div>
  <?php endwhile; ?>

  <?php while ($row = mysqli_fetch_assoc($tanggapan)) : ?>
     <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="700">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col ml-3">
            <div class="h5 mb-0 font-weight-bold text-success"><?= $row['total']; ?> Tanggapan</div>
          </div>
          <i class="fas fa-comments fa-2x text-gray-500"></i>
        </div>
      </div>
    </div>
  </div>
  <?php endwhile; ?>

  <?php while ($row = mysqli_fetch_assoc($masyarakat)) : ?>
     <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="700">
    <div class="card border-left-dark shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col ml-3">
            <div class="h5 mb-0 font-weight-bold text-dark"><?= $row['total']; ?> Akun masyarakat</div>
          </div>
          <i class="fas fa-users fa-2x text-gray-500"></i>
        </div>
      </div>
    </div>
  </div>
</div>
  <?php endwhile ?>

<div class="row">
  <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <div class="col-md-4 mb-4">
      <div class="card shadow" data-aos="fade-up">
        <!-- Card Content - Collapse -->
        <div class="card-header">
          <div class="row">
            <div class="col-6">
              <h6 class="m-0 font-weight-bold text-success mt-2">NIK : <?= $row['nik']; ?></h6>
            </div>
            <div class="col-6">
              <div class="d-sm-flex align-items-center justify-content-end">
                <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
              </div>
            </div>
          </div>
        </div>
        <div class="collapse show" id="generate">
          <div class="card-body">
            <div class="row">
               <div class="col-4">
              <h6 class="text-success font-weight-bold">Foto :<img src="../../assets/img/<?= $row['foto']; ?>" width="80" alt="Foto Laporan" style="cursor:pointer;"
                  onclick="showImage('assets/img/<?= $row['foto']; ?>')"></h6>
            </div>
              <div class="col-8">
                <h6> <span class="text-success font-weight-bold">Tanggal Pengaduan :</span> <?= $row['tgl_pengaduan']; ?></h6>
                <h6> <span class="text-success font-weight-bold">Tanggal Tanggapan :</span> <?= $row['tgl_tanggapan']; ?></h6>
              </div>
            </div>
            <hr class="bg-primary">
            <h6><span class="text-success font-weight-bold">Laporan :</span> <?= $row['isi_laporan']; ?></h6>
            <h6><span class="text-success font-weight-bold">Tanggapan :</span> <?= $row['tanggapan']; ?></h6>
            <hr class="bg-success">
            <div class="row">
              <div class="col-8 mt-2">
                <h6> <span class="text-succes font-weight-bold">Di tanggapi dari :</span> <?= $row['nama_petugas']; ?></h6>
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