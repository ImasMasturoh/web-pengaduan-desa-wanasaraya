<?php

require 'config.php';


function tambahAduan($data)
{
    global $conn;

    $tgl = htmlspecialchars($data["tgl_pengaduan"]);
    $nik = htmlspecialchars($data["nik"]);
    $isi = htmlspecialchars($data["isi_laporan"]);
    $status = htmlspecialchars($data["status"]);

    // Ambil data gambar
    $namaFile = $_FILES['foto']['name'];
    $tmpName = $_FILES['foto']['tmp_name'];
    $folder = 'assets/img/';
    
    // Cek apakah user upload foto
    if (!empty($namaFile)) {
        // Rename untuk hindari duplikat nama
        $newName = uniqid() . '-' . basename($namaFile);
        move_uploaded_file($tmpName, $folder . $newName);
    } else {
        $newName = ''; // atau bisa diganti default seperti 'noimage.png'
    }

    // Simpan ke DB
    $query = "INSERT INTO pengaduan (tgl_pengaduan, nik, isi_laporan, foto, status)
              VALUES ('$tgl', '$nik', '$isi', '$newName', '$status')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}



function verify($data)
{

    global $conn;

    $id = htmlspecialchars($data["id_pengaduan"]);
    $tgl = htmlspecialchars($data["tgl_pengaduan"]);
    $nik = htmlspecialchars($data["nik"]);
    $isi = htmlspecialchars($data["isi_laporan"]);
    $foto = htmlspecialchars($data["foto"]);
    $status = htmlspecialchars($data["status"]);

    $query = "UPDATE pengaduan SET
                id_pengaduan = '$id',
                tgl_pengaduan = '$tgl',
                nik = '$nik',
                isi_laporan = '$isi',
                foto = '$foto',
                status = '$status'
                WHERE id_pengaduan = '$id' ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tanggapan($data)
{
    global $conn;

    $id_pengaduan   = (int)$data["id_pengaduan"];
    $tgl_tanggapan  = mysqli_real_escape_string($conn, $data["tgl_tanggapan"]);
    $tanggapan      = htmlspecialchars($data["tanggapan"]);
    $id_petugas     = (int)$data["id_petugas"];
    $status         = isset($data["status"]) ? mysqli_real_escape_string($conn, $data["status"]) : 'proses';

    // Cek apakah sudah pernah ditanggapi
    $cek = mysqli_query($conn, "SELECT * FROM tanggapan WHERE id_pengaduan = $id_pengaduan");

    if (mysqli_num_rows($cek) > 0) {
        // Sudah ada → update tanggapan
        $query1 = "UPDATE tanggapan SET 
                      tgl_tanggapan = '$tgl_tanggapan',
                      tanggapan = '$tanggapan',
                      id_petugas = $id_petugas
                   WHERE id_pengaduan = $id_pengaduan";
    } else {
        // Belum ada → insert tanggapan baru
        $query1 = "INSERT INTO tanggapan (id_pengaduan, tgl_tanggapan, tanggapan, id_petugas)
                   VALUES ($id_pengaduan, '$tgl_tanggapan', '$tanggapan', $id_petugas)";
    }

    // Ubah status pengaduan
    $query2 = "UPDATE pengaduan SET status = '$status' WHERE id_pengaduan = $id_pengaduan";

    mysqli_query($conn, $query1);
    mysqli_query($conn, $query2);

    return mysqli_affected_rows($conn);
}

function regisUser($data)
{

    global $conn;

    $nik = htmlspecialchars($data["nik"]);
    $nama = htmlspecialchars($data["nama"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $telp = htmlspecialchars($data["telp"]);

   $query = "INSERT INTO masyarakat (nik, nama, username, password, telp) 
          VALUES ('$nik', '$nama', '$username', '$password', '$telp')";
          mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}


function addPetugas($data)
{

    global $conn;

    $nama = htmlspecialchars($data["nama_petugas"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $telp = htmlspecialchars($data["telp"]);
    $level = htmlspecialchars($data["level"]);

    mysqli_query($conn, "INSERT INTO petugas VALUES ('', '$nama', '$username', '$password', '$telp', '$level')");

    return mysqli_affected_rows($conn);
}

function editPetugas($data)
{

    global $conn;

    $id = htmlspecialchars($data["id_petugas"]);
    $nama = htmlspecialchars($data["nama_petugas"]);
    $username = htmlspecialchars($data["username"]);
    $password = htmlspecialchars($data["password"]);
    $telp = htmlspecialchars($data["telp"]);
    $level = htmlspecialchars($data["level"]);

    $query = "UPDATE petugas SET
                nama_petugas = '$nama',
                username = '$username',
                password = '$password',
                telp = '$telp',
                level = '$level'
                WHERE id_petugas = '$id'
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function deletePetugas($id)
{

    global $conn;

    mysqli_query($conn, "DELETE FROM petugas WHERE id_petugas = $id");

    return mysqli_affected_rows($conn);
}
