<?php
include "../config/connect.php";
function hapusBarang($id){
    global $conn;

    mysqli_query($conn,"DELETE FROM barang WHERE id_barang=$id");

    return mysqli_affected_rows($conn);
}
