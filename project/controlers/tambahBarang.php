<?php
include "../config/connect.php";

function tambahBarang($data){
    global $conn;

    $harga = str_replace(".", "", $data["harga"]);
    $stok = str_replace(".", "", $data["stok"]);

    $idJBarang = htmlspecialchars($data["idJbarang"]);
    $model = htmlspecialchars($data["model"]);
    $harga = htmlspecialchars($harga);
    $ukuran = htmlspecialchars($data["ukuran"]);
    $stok = htmlspecialchars($stok);

    $query = "INSERT INTO barang VALUES ('','$idJBarang', '$model', $harga, '$ukuran', $stok)";
    mysqli_query($conn,$query);


    return mysqli_affected_rows($conn);
}

?>