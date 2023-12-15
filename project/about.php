<?php
include "controlers/query.php";
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

$about = query("SELECT * FROM user");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang Kami</title>
    <!-- bootstrap 5 css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="views/fontawesome-free-6.2.1-web/fontawesome-free-6.2.1-web/css/all.css">
    <script src="views/jquery-ui-1.13.2.custom/external/jquery/jquery.js"></script>
    <link href="views/css/style.css" rel="stylesheet" />
    <script src="views/js/script.js"></script>
</head>

<body>
    <nav class="sb-topnav fixed-top navbar navbar-expand navbar-dark bg-dark ">
        <!-- Navbar Brand-->
        <a class="navbar-brand mx-3" href="index.php"><b class="brand">Fuzi Ahmad Fahreza</b></a>
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
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i><span class="mx-2">Data Barang</span><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link mx-2" href="barang.php"><i class="fa-solid fa-bag-shopping"></i></i><span>Barang</span></a>
                    <a class="nav-link mx-2" href="JenisBarang.php"><i class="fa-solid fa-filter"></i><span>Jenis Barang</span></a>
                </nav>
            </div>
            <a class="nav-link" href="register.php">
                <div class="sb-nav-link-icon"><i class="fa-solid fa-user-plus"></i><span>Tambah Admin</span></div>
            </a>
            <div class="fw-bold my-3 text-secondary">Tentang Kami</div>
            <a class="nav-link active" href="about.php">
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
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tentang Kami</li>
                    </ol>
                    <div class="team4">
  <div class="container" style="margin-top: -20px;">
    <div class="row justify-content-center mb-4">
      <div class="col-md-7 text-center">
        <h3 class="mb-3 f-bold">About</h3>
      </div>
    </div>
    <div class="row">
      <?php foreach($about as $row) : ?>
      <div class="col-lg-3 mb-4 my-3">
        <!-- Row -->
        <div class="row shadow">
          <div class="col-md-12">
            <img src="asset/img/<?= $row["photo"] ?>" alt="wrapkit" class="img-fluid mx-auto d-block" style="width: 150px;" />
          </div>
          <div class="col-md-12 text-center">
            <div class="pt-2">
              <h5 class="mt-4 font-weight-medium mb-0"><?= $row["nama_lengkap"] ?></h5>
              <p>Nim.<?= $row["nip"] ?></p>
            </div>
          </div>
        </div>
    </div>
    <?php endforeach ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>