<?php
include "config/connect.php";

function register($data)
{
    global $conn;
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

      //memeriksa apakah file foto sudah diupload
      if(isset($_FILES['photo']['name']) && $_FILES['photo']['name'] != ""){
        $fileName = $_FILES['photo']['name'];
        $fileTmpName = $_FILES['photo']['tmp_name'];
        $fileSize = $_FILES['photo']['size'];
        $fileError = $_FILES['photo']['error'];
        $fileType = $_FILES['photo']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        //mengecek ekstensi file yang diizinkan
        if(in_array($fileActualExt, $allowed)){
            //memeriksa kesalahan saat mengupload
            if($fileError === 0){
                //mengecek ukuran file
                if($fileSize < 1000000){
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = 'asset/img/'.$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    //file telah berhasil diupload, tambahkan kode untuk menyimpan informasi file foto (nama file, lokasi, dll) ke database
                } else {
                    echo "File Terlalu Besar!";
                }
            } else {
                echo "Terjadi Kesalahan Saat Mengunggah File!";
            }
        } else {
            echo "Hanya File JPG, JPEG, PNG Yang Diizinkan!";
        }
    }

    //cek apakah username sudah terdaftar sebelumnya
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username ='$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script> alert('Username sudah terdaftar');</script>";
        return false; //agar semua kode dibawah tidak dijalankan
    }

    //cek apakah password dan konfirmasi password itu sama
    if ($password1 != $password2) {
        return false;
    }

    //enkripsi password
    $password1 = password_hash($password1, PASSWORD_DEFAULT);

    //tambahkan data
    $query = "INSERT INTO user VALUES('','$namaLengkap','$nip','$fileNameNew','$jenisKelamin','$tempatLahir','$tglLahir','$alamat','$username','$password1')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
