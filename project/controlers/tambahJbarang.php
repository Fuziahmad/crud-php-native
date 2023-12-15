<?php
include "../config/connect.php";

function tambahJbarang($data){
    global $conn;

    $jenis_barang = htmlspecialchars($data["jenis_barang"]);

    $query = "INSERT INTO jenis_barang VALUES ('', '$jenis_barang')";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}

?>