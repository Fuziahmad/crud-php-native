<?php
include "../config/connect.php";
function hapusAdmin($id){
    global $conn;

    mysqli_query($conn,"DELETE FROM user WHERE id_admin=$id");

    return mysqli_affected_rows($conn);
}
