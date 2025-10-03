<?php

$title = 'Tanggapan';

require 'app.php';

require 'header.php';

require 'navPetugas.php';

// logic backend
$id = (int)$_GET["id_pengaduan"];
$result = mysqli_query($conn, "SELECT * FROM pengaduan WHERE id_pengaduan = $id");

if (isset($_POST["submit"])) {
    // Validasi input kosong
    if (empty($_POST['tgl_tanggapan']) || empty($_POST['tanggapan']) || empty($_POST['id_petugas'])) {
        $form_kosong = true;
    } else {
       $hasil = tanggapan($_POST);
			if ($hasil !== false) {
				$sukses = true;
			} else {
				$error = true;
			}
    }
}

?>

<div class="d-flex justify-content-center mt-4">
    <div class="card w-75 shadow">
        <div class="card-body">
            <?php if (isset($sukses)) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil!</strong> Tanggapan telah dikirim.
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php endif; ?>

            <?php if (isset($error)) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Gagal!</strong> Laporan sudah ditanggapi sebelumnya.
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php endif; ?>

            <?php if (isset($form_kosong)) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Perhatian!</strong> Tanggal, tanggapan, dan petugas harus diisi.
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                </div>
            <?php endif; ?>

            <div class="row">
                <div class="col-md-5">
                    <img src="assets/img/tanggap.jpeg" class="img-fluid" alt="Ilustrasi">
                </div>

                <div class="col-md-7">
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <form action="" method="POST">
                            <input type="hidden" name="id_pengaduan" value="<?= $row['id_pengaduan']; ?>">
                            <input type="hidden" name="status" value="selesai">

                            <div class="form-group">
                                <label>NIK Pengadu</label>
                                <input type="text" class="form-control" name="nik" value="<?= $row['nik']; ?>" readonly>
                            </div>

                            <div class="form-group">
                                <label>Tanggal Tanggapan</label>
                                <input type="date" class="form-control" name="tgl_tanggapan" required>
                            </div>

                            <div class="form-group">
                                <label>Isi Laporan</label>
                                <textarea class="form-control" name="isi_laporan" readonly><?= $row['isi_laporan']; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label>Tanggapan</label>
                                <textarea class="form-control" name="tanggapan" rows="3" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>Pilih Petugas</label>
                                <select name="id_petugas" class="form-control" required>
                                    <option value="" disabled selected>-- Pilih Petugas --</option>
                                    <option value="1">Alan Hisyam Maulana</option>
                                    <option value="2">Susanti</option>
                                    <option value="3">Rifki Ananta</option>
                                </select>
                            </div>

                            <button type="submit" name="submit" class="btn btn-success">Kirim Tanggapan</button>
                        </form>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require 'footer.php'; ?>
