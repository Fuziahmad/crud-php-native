<?php
@include "controlers/ubahBarang.php";
include "controlers/query.php";
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$jenis_barang = query("SELECT * FROM jenis_barang");

//ambil data dari url
$id = $_GET["id"];

//query data berdasarkan id
$barang = query("SELECT barang.id_barang, jenis_barang.id_Jbarang, jenis_barang.jenis_barang, barang.model, barang.harga, barang.ukuran, barang.stok FROM barang INNER JOIN jenis_barang ON barang.id_jbarang = jenis_barang.id_jbarang WHERE id_barang = $id")[0];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ubah Barang</title>
    <!-- bootstrap 5 css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="views/fontawesome-free-6.2.1-web/fontawesome-free-6.2.1-web/css/all.css">
    <script src="views/jquery-ui-1.13.2.custom/external/jquery/jquery.js"></script>
    <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="views/css/style.css" rel="stylesheet" />
    <script src="views/js/script.js"></script>
    <script src="views/js/rupiah.js"></script>
</head>
<style>
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<body>
    <nav class="sb-topnav fixed-top navbar navbar-expand navbar-dark bg-dark ">
        <!-- Navbar Brand-->
        <a class="navbar-brand mx-3" href="index.php"><b class="brand">About</b></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-dark" id="button-toggle">
            <i class="fas fa-bars"></i>
        </button>
        <marquee class="marquee text-light" behavior="scroll" direction="left" loop="infinite">🚀 Crud PHP Native 🚀<span style="margin-left: 960px;">Project Ini Diajukan Untuk Memenuhi Tugas Praktikum Pemrograman Web 1 </span></marquee>
    </nav>
    <div class="sidebar fixed-top mt-5 p-4 bg-dark" id="sidebar">
        <nav class="nav d-block">
            <a class="nav-link" href="profil.php">
                <div class="sb-nav-link-icon"><i class="fas fa-user fa-fw"></i><span>Profil</span></div>
            </a>
            <a class="nav-link" href="index.php">
                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></div>
            </a>
            <hr class="text-secondary">
            <div class="fw-bold my-3 text-secondary">Tabel Data</div>
            <a class="nav-link collapsed active" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i><span class="mx-2">Data Barang</span><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link active mx-2" href="barang.php"><i class="fa-solid fa-bag-shopping"></i></i><span>Barang</span></a>
                    <a class="nav-link mx-2" href="JenisBarang.php"><i class="fa-solid fa-filter"></i><span>Jenis Barang</span></a>
                </nav>
            </div>
            <a class="nav-link" href="register.php">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-plus"></i><span>Tambah Admin</span></div>
            </a>
            <div class="fw-bold my-3 text-secondary">Tentang Kami</div>
            <a class="nav-link" href="about.php">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-info"></i><span>About</span></div>
            </a>
            <hr class="text-secondary">
            <a class="nav-link" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
        </nav>
    </div>
    <div class="main-content p-3 mt-1" id="main-content">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 mt-5">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item "><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="index.php">Data Barang</a></li>
                        <li class="breadcrumb-item "><a href="barang.php">Barang</a></li>
                        <li class="breadcrumb-item active">Ubah Barang</li>
                    </ol>
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <i class="fa-solid fa-pen-to-square me-1"></i>
                            Edit Data Barang
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="row g-3">
                                    <input type="hidden" name="idBarang" value="<?= $barang["id_barang"] ?>">
                                    <div class="col-md-6 col-sm-6">
                                        <label for="jenis_barang" class="form-label">Jenis Barang</label>
                                        <select class="form-select" name="idJbarang" required>
                                            <option value="<?= $barang["id_Jbarang"] ?>" selected ><?= $barang["jenis_barang"] ?></option>
                                            <?php foreach ($jenis_barang as $row) : ?>
                                                <option value="<?= $row["id_Jbarang"] ?>"><?= $row["jenis_barang"] ?>
                                                </option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label for="model" class="form-label">model</label>
                                        <input type="text" name="model" class="form-control" aria-label="model" value="<?= $barang["model"] ?>" required autocomplete="off">
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label for="harga" class="form-label">Harga</label>
                                        <input type="text" name="harga" class="form-control f-num" aria-label="harga" value="<?= $barang["harga"] ?>" required autocomplete="off">
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <label for="ukuran" class="form-label">Ukuran</label>
                                        <input type="text" name="ukuran" class="form-control" aria-label="ukuran" value="<?= $barang["ukuran"] ?>" required autocomplete="off">
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <label for="stok" class="form-label">Stok</label>
                                        <input type="text" name="stok" class="form-control f-num" aria-label="stok" value="<?= $barang["stok"] ?>" required>
                                    </div>
                                </div>
                                <button type="submit" name="ubahBarang" class="btn btn-primary mt-3">
                                    Tambah
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex  justify-content-center small">
                        <div class="text-muted">Copyright &copy; Fuzi Ahmad Fahreza 2023</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <?php
    if (isset($_POST["ubahBarang"])) {
        if (ubah($_POST) > 0 || ubah($_POST) == 0) {
            echo "<script>
        swal({
            title: 'Berhasil',
            text: 'Data Berhasil Di Ubah',
            icon: 'success',
        });
        setTimeout(function(){
            window.location = 'barang.php';
        }, 2000);
        </script>";
        } else {
            echo "<script>
    swal({
        title: 'Gagal',
        text: 'Data Gagal Di Ubah',
        icon: 'error',
    });
    setTimeout(function(){
        window.location = 'barang.php';
    }, 2000);
    </script>";
        }
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>