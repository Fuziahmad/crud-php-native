<?php
include "../config/connect.php";

function editProfil($data)
{
    global $conn;
    $idAdmin = htmlspecialchars($data["idAdmin"]);
    $namaLengkap = htmlspecialchars($data["namaLengkap"]);
    $nip = htmlspecialchars($data["nip"]);
    $jenisKelamin = $data["jenisKelamin"];
    $tempatLahir = htmlspecialchars($data["tempatLahir"]);
    $tglLahir = htmlspecialchars($data["tglLahir"]);
    $alamat = htmlspecialchars($data["alamat"]);

    //membersihkan userame agar tidak ada backspace dan memaksa menjadi huruf kecil
    $username = strtolower(stripslashes(($data["username"])));

    $password1 = mysqli_real_escape_string($conn, $data["password1"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    //cek apakah username sudah terdaftar sebelumnya
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username ='$username' AND id_admin != '$idAdmin' ");
    if (mysqli_fetch_assoc($result)) {
        echo "<script> alert('Username sudah terdaftar');</script>";
        return false; //agar semua kode dibawah tidak dijalankan
    }

    if(!empty($_POST['password2'])) {
        // enkripsi password
        $password2 = password_hash($password2, PASSWORD_DEFAULT);
        //update password di query
        $query = "UPDATE user SET nama_lengkap = '$namaLengkap', nip = '$nip', jenis_kelamin ='$jenisKelamin', tempat_lahir = '$tempatLahir', tgl_lahir = '$tglLahir', alamat = '$alamat', username='$username', password = '$password2' WHERE id_admin = '$idAdmin'";
    } else {
        //update tanpa mengubah password
        $query = "UPDATE user SET nama_lengkap = '$namaLengkap', nip = '$nip', jenis_kelamin ='$jenisKelamin', tempat_lahir = '$tempatLahir', tgl_lahir = '$tglLahir', alamat = '$alamat',username='$username' WHERE id_admin = '$idAdmin'";
    }

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
