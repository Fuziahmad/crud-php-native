<?php
include "../config/connect.php";

function ubah($data){
    global $conn;

    $harga = str_replace(".", "", $data["harga"]);
    $stok = str_replace(".", "", $data["stok"]);

    $idBarang = htmlspecialchars($data["idBarang"]);
    $idJBarang = htmlspecialchars($data["idJbarang"]);
    $model = htmlspecialchars($data["model"]);
    $harga = htmlspecialchars($harga);
    $ukuran = htmlspecialchars($data["ukuran"]);
    $stok = htmlspecialchars($stok);



    $query = "UPDATE barang SET id_Jbarang = '$idJBarang', model = '$model', harga = '$harga', ukuran = '$ukuran', stok = '$stok' WHERE id_barang = $idBarang";
    mysqli_query($conn,$query);

    return mysqli_affected_rows($conn);
}
?>