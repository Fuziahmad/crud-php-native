<?php
include "config/connect.php";

function query($query){
    global $conn;
    //ambil data dari database
    $result = mysqli_query($conn,$query);
    $rows = [];
    while($row =  mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

//cari berdasarkan keyword yang di masukan
function cari($keyword){
    $query = "SELECT b.id_barang, b.merk, b.harga, b.ukuran, b.stok, jb.jenis_barang FROM barang b JOIN jenis_barang jb ON b.id_Jbarang = jb.id_Jbarang WHERE jb.jenis_barang LIKE '%$keyword%'";

    return query($query);
}

?>