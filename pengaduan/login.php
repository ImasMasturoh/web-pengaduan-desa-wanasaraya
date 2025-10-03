<?php
session_start(); // Jangan lupa untuk memulai session

$title = 'Login';
require 'app.php';
require 'header.php';

// logic backend
if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $login_as = $_POST['login_as'];

  if ($login_as === 'masyarakat') {
    $result = mysqli_query($conn, "SELECT * FROM masyarakat WHERE username = '$username'");

    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
        if ($row['password'] === $password) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['nama'] = $row['nama'];
        $_SESSION['nik'] = $row['nik']; 
        $_SESSION['level'] = 'masyarakat';
        header("Location: dashboard.php");
        exit;
      }

    }

  } elseif ($login_as === 'admin' || $login_as === 'petugas') {
    $result = mysqli_query($conn, "SELECT * FROM petugas WHERE username = '$username' AND level = '$login_as'");

    if (mysqli_num_rows($result) === 1) {
      $row = mysqli_fetch_assoc($result);
      if ($row['password'] === $password) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['level'] = $row['level'];

        if ($login_as === 'admin') {
          header("Location: dashboard_admin.php");
        } else {
          header("Location: dashboard_petugas.php");
        }
        exit;
      }
    }
  }

  $error = true;
}
?>

<div class="d-flex justify-content-center py-5 mt-5">
  <div class="card shadow mt-3 border-bottom-success bg-gray-100" data-aos="fade-down">
    <div class="card-body">

      <?php if (isset($error)) : ?>
        <div class="alert alert-dismissible fade show" style="background-color: #b52d2d;" role="alert">
          <h6 class="text-gray-100 mt-2">Maaf username atau password anda salah</h6>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true" class="text-light">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <h3 class="text-center text-success text-uppercase text-bold">Login</h3>
      <hr class="bg-gradient-success">
      <div class="row">
        <div class="col-6">
          <div class="image">
            <img src="assets/img/login2.png" width="320" alt="">
          </div>
        </div>
        <div class="col-6">
          <form action="" method="post">
            <div class="form-group">
              <label for="exampleInputEmail1">Username</label>
              <input type="text" class="form-control shadow" style="border: none;" id="exampleInputEmail1" placeholder="..." name="username" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control shadow" style="border: none;" id="exampleInputPassword1" placeholder="..." name="password" required>
            </div>
            <div class="form-group">
              <label for="login_as">Login Sebagai</label>
              <select class="form-control shadow" name="login_as" id="login_as" required>
                <option value="" disabled selected>-- Pilih Peran --</option>
                <option value="masyarakat">Masyarakat</option>
                <option value="admin">Admin</option>
                <option value="petugas">Petugas</option>
              </select>
            </div>
            <div>
              <button type="submit" name="submit" class="btn btn-success shadow-lg">Masuk</button>
            </div>
            <div class="text-center mt-2">
              <a href="register.php" class="text-gray-600" style="text-decoration: none;">Belum Punya Akun?</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require 'footer.php'; ?>
