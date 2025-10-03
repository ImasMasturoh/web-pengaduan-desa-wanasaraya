<?php

$title = 'Laporan Masyarakat';

require 'app.php';

require 'header.php';

require 'navPetugas.php';


// logic backend   

$result = mysqli_query($conn, "SELECT * FROM pengaduan WHERE status = 'proses' ORDER BY id_pengaduan DESC");

?>

<div class="row" data-aos="fade-up">
  <div class="col-6">
    <h3 class="text-gray-800">Daftar Laporan Masyarakat</h3>
  </div>

<hr>


<table class="table table-bordered shadow-sm text-center" data-aos="fade-up" data-aos-duration="700">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Tanggal</th>
      <th scope="col">NIK</th>
      <th scope="col">Isi Laporan</th>
      <th scope="col">Foto</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  ...
<tbody>
  <?php $i = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
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
          <a href="verify_petugas.php?id_pengaduan=<?= $row["id_pengaduan"]; ?>" class="btn btn-success">Verify</a>
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