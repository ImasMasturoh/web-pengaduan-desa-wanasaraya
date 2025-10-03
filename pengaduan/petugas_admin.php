<?php

$title = 'Data Petugas';

require 'app.php';

require 'header.php';

require 'navAdmin.php';



// Logic Backend

$result = mysqli_query($conn, "SELECT * FROM petugas WHERE level = 'petugas'");

?>


<table class="table table-bordered text-center shadow">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Username</th>
      <th scope="col">Password</th>
      <th scope="col">Telepon</th>
      <th scope="col">
        <a href="tambah_admin.php" class="btn btn-success">Tambah Petugas</a>
      </th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; ?>
    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
      <tr>
        <th scope="row"><?= $i; ?>.</th>
        <td><?= $row['nama_petugas']; ?></td>
        <td><?= $row['username']; ?></td>
        <td>*****</td>
        <td><?= $row['telp']; ?></td>
        <td>
          <a href="edit_admin.php?id_petugas=<?= $row['id_petugas']; ?>" class="btn btn-outline-success">Edit</a> |
          <a href="hapus_admin.php?id_petugas=<?= $row['id_petugas']; ?>" class="btn btn-outline-danger">Hapus</a>
        </td>
      </tr>
      <?php $i++; ?>
    <?php endwhile; ?>
  </tbody>
</table>

<?php 'footer.php'; ?>