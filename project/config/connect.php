<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_project";

$conn = mysqli_connect($host,$username,$password,$dbname);

if(!$conn){
    die("koneksi ke database gagal: " . mysqli_connect_error());
}


?>