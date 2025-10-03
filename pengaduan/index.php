<?php
$title = 'Pengaduan Barang Hilang';
require 'app.php';
require 'header.php';


// Logic backend
$pengaduan = mysqli_query($conn, "SELECT COUNT(*) as total FROM pengaduan");
$tanggapan = mysqli_query($conn, "SELECT COUNT(*) as total FROM tanggapan");
$masyarakat = mysqli_query($conn, "SELECT COUNT(*) as total FROM masyarakat");
?>

<!-- Tambahkan style untuk mencegah overflow -->
<style>
  body {
    overflow-x: hidden;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-success py-3 shadow">
  <div class="container" data-aos="fade-down">
    <a class="navbar-brand" href="#">
      <i class="fas fa-atlas"></i> Pengaduan Barang Hilang
    </a>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <a href="login.php" class="btn btn-light mr-3">Login</a>
        <a href="register.php" class="btn btn-outline-light">Registrasi</a>
      </ul>
    </div>
  </div>
</nav>

<div class="bg-gradient-success"
     style="border-bottom-right-radius: 100px;
            border-bottom-left-radius: 100px;
            padding: 150px 0;
            background-image: url('assets/img/wns.webp');
            background-size: cover;
            background-position: center;
            width: 100vw;
            overflow: hidden;">
  <div class="container d-flex justify-content-center" data-aos="zoom-in">
    <div class="text-center col-lg-8 col-md-10 col-sm-12 text-light">
      <h1>Pengaduan Barang Hilang</h1>
      <p>Selamat Datang Di Sistem Pengaduan Barang Hilang Desa Wanasaraya.
        Layanan ini disediakan untuk membantu warga dalam melaporkan barang-barang yang hilang dengan cepat dan mudah.
        Laporkan kehilangan Anda dan bantu mempercepat proses pencarian bersama masyarakat desa.</p>
      <a href="login_user.php" class="btn btn-outline-light">Buat laporan sekarang!</a>
    </div>
  </div>
</div>

<div class="container mt-n4">
  <div class="row">
    <?php while ($row = mysqli_fetch_assoc($pengaduan)) : ?>
      <div class="col-md-4 mb-4" data-aos="fade-up">
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
      <div class="col-md-4 mb-4" data-aos="fade-up">
        <div class="card border-left-success shadow h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col ml-3">
                <div class="h5 mb-0 font-weight-bold text-primary"><?= $row['total']; ?> Tanggapan</div>
              </div>
              <i class="fas fa-comments fa-2x text-gray-500"></i>
            </div>
          </div>
        </div>
      </div>
    <?php endwhile; ?>

    <?php while ($row = mysqli_fetch_assoc($masyarakat)) : ?>
      <div class="col-md-4 mb-4" data-aos="fade-up">
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
    <?php endwhile; ?>
  </div>
</div>

<div class="container py-5">
  <div class="row align-items-center">
    <div class="col-md-6 mb-4" data-aos="fade-right">
      <h4 class="text-gray-900">Buat laporan, aduan barang hilang anda di website aduan masyarakat ini dan jangan meyebarkan berita hoax!</h4>
    </div>
    <div class="col-md-6 mb-4" data-aos="fade-left">
      <img src="assets/img/page11.png" class="img-fluid" alt="">
    </div>

    <div class="col-md-6 mb-4" data-aos="fade-right">
      <img src="assets/img/page2.png" class="img-fluid" alt="">
    </div>
    <div class="col-md-6 mb-4" data-aos="fade-left">
      <h4 class="text-gray-900">Jangan lupa mengirimkan foto barang yang hilang saat menyampaikan laporan atau aduan anda di web ini.</h4>
    </div>

    <div class="col-md-6 mb-4" data-aos="fade-right">
      <h4 class="text-gray-900">Terima kasih telah menyampaikan pengaduan Anda. Kami akan menindaklanjuti secepat mungkin sesuai prosedur yang berlaku. Harap menunggu tanggapan dengan tenang.</h4>
    </div>
    <div class="col-md-6 mb-4" data-aos="fade-left">
      <img src="assets/img/page3.png" class="img-fluid" alt="">
    </div>
  </div>
</div>

<!-- Info Section -->
<div class="bg-gradient-success py-5">
  <div class="container text-center text-light">
    <h1 class="mb-3">Info Aduan Masyarakat</h1>
    <a href="https://wa.me/6285523607834" class="btn btn-light mr-1" target="_blank">Chat Admin via WhatsApp</a>
  </div>
</div>

<!-- Testimonial -->
<div class="container py-5">
  <h2 class="text-center text-uppercase text-gray-900" data-aos="zoom-in-up">Testimonial</h2>
  <hr>
  <div class="row">
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm" data-aos="fade-up" data-aos-duration="500">
        <div class="card-body">
          <img src="assets/img/pns.jpg" width="35" class="rounded-circle" alt="">
          <span>M Abdul</span> | <span>Warga Dusun Manis</span>
          <hr>
          <p class="text-justify">Saya kehilangan dompet saat pulang dari pasar. Lewat website ini, saya langsung buat laporan. Alhamdulillah, dua hari kemudian ada warga yang menemukannya dan menghubungi saya. Terima kasih untuk website ini, sangat membantu!</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm" data-aos="fade-up" data-aos-duration="700">
        <div class="card-body">
          <img src="assets/img/lisa.jpg" width="35" class="rounded-circle" alt="">
          <span>Yuli Kartika</span> | <span>Ibu Rumah Tangga</span>
          <hr>
          <p class="text-justify">Waktu anak saya kehilangan sepeda, kami coba lapor di website ini. Ternyata cepat sekali ditanggapi oleh admin dan warga lain. Sekarang saya selalu cek website ini kalau ada informasi barang hilang</p>
        </div>
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <div class="card shadow-sm" data-aos="fade-up" data-aos-duration="900">
        <div class="card-body">
          <img src="assets/img/rm.jpeg" width="35" class="rounded-circle" alt="">
          <span>Muhammad Taufan</span> | <span>Pegawai</span>
          <hr>
          <p class="text-justify">Website pengaduan ini sangat praktis. Saya bisa melaporkan kehilangan laptop hanya lewat HP. Fitur upload foto dan deskripsi barang sangat memudahkan.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Peta -->
<div class="container py-5">
  <h2 class="text-center text-uppercase text-gray-900" data-aos="zoom-in-up">Peta Desa Wanasaraya</h2>
  <hr>
  <div class="row justify-content-center" data-aos="fade-up">
    <div class="col-md-10">
      <div class="embed-responsive embed-responsive-16by9 shadow rounded">
        <iframe class="embed-responsive-item"
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.323078370174!2d108.48925871477536!3d-7.309117774205614!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6e2587a9c09955%3A0xe2527d232d20571b!2sWanasaraya%2C%20Kec.%20Kalimanggis%2C%20Kabupaten%20Kuningan%2C%20Jawa%20Barat!5e0!3m2!1sid!2sid!4v1718927000000!5m2!1sid!2sid"
          width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </div>
</div>

<!-- Footer -->
<div class="bg-gray-400 py-3">
  <footer>
    <div class="text-center mt-2 text-gray-700">
      <h6>Copyright &copy;2025 - Imas Masturoh.</h6>
    </div>
  </footer>
</div>

<?php require 'footer.php'; ?>
