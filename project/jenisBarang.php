<?php
include "controlers/query.php";
session_start();

if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

if (isset($_POST["cari"]) && !empty($_POST["keyword"])) {
  $keyword = $_POST["keyword"];
    $_SESSION["keyword"] = $keyword; 
} elseif(isset($_SESSION["keyword"])) {
    $keyword = $_SESSION["keyword"];
} else {
  $keyword= '';
  $_SESSION["keyword"]= '';
}

if(!isset($_GET["page"] )){
  unset($_SESSION['keyword']);
}

if(isset($_POST['reset'])){
  unset($_SESSION['keyword']);
}

$sizeDataPage = 5;
$totalData = count(query("SELECT * FROM jenis_barang"));
$totalPage = ceil($totalData / $sizeDataPage);
$pageActive = (isset($_GET["page"])) ? $_GET["page"] : 1;
$firstData = ($sizeDataPage * $pageActive) - $sizeDataPage;

$totalLink = 2;
if($pageActive > $totalLink){
  $startNumber = $pageActive - $totalLink; 
}else{
  $startNumber = 1;
}

if($pageActive < ($totalPage -  $totalLink)){
  $endNumber = $pageActive + $totalLink; 
}else{
  $endNumber = $totalPage;
}

$dataPage = query("SELECT* FROM jenis_barang WHERE id_Jbarang LIKE '%$keyword%' OR jenis_barang LIKE '%$keyword%' LIMIT $firstData,$sizeDataPage");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Jenis Barang</title>
  <!-- bootstrap 5 css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="views/fontawesome-free-6.2.1-web/fontawesome-free-6.2.1-web/css/all.css">
  <script src="views/jquery-ui-1.13.2.custom/external/jquery/jquery.js"></script>
  <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
  <link href="views/css/style.css" rel="stylesheet" />
  <script src="views/js/script.js"></script>
  <script src="views/js/rupiah.js"></script>
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
    <na
    v class="nav d-block">
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
          <a class="nav-link mx-2" href="barang.php"><i class="fa-solid fa-bag-shopping"></i></i><span>Barang</span></a>
          <a class="nav-link active mx-2" href="JenisBarang.php"><i class="fa-solid fa-filter"></i><span>Jenis Barang</span></a>
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
            <li class="breadcrumb-item active">Jenis Barang</li>
          </ol>
          <div class="card shadow mb-4" style="margin-top: -20px;">
            <div class="card-header">
              <i class="fas fa-table me-1"></i>
              Data Jenis Barang
            </div>
            <form action="" method="post">
              <div class="d-flex justify-content-between ">
                <div class="p-2 mx-2 mt-2"><a href="tambahJBarang.php" class="btn btn-sm btn-primary"><i class="fa-solid fa-plus"></i><span class="d-none d-sm-inline mx-1">Tambah Jenis Barang</span></a></div>
                <div class="p-2 mx-2 mt-2">
                  <div class="input-group input-group-sm">
                    <input type="text" name="keyword" class="form-control" placeholder="Kata Kunci" aria-describedby="button-addon2">
                    <button class="btn btn-primary px-2" type="submit" id="button-addon2" name="cari"><i class="fa-solid fa-magnifying-glass"></i><span class="px-1">Cari</span></button>
                    <button class="btn btn-warning" type="submit" id="button-addon2" name="reset"><i class="fa-solid fa-arrows-rotate px-2"></i></button>
                  </div>
                </div>
              </div>
            </form>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm text-center ">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Id</th>
                      <th>Jenis Barang</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($dataPage as $row) : ?>
                      <tr>
                        <td class="col-md-1"><?= $i++ + $firstData; ?></td>
                        <td class="col-md-2"><?= $row["id_Jbarang"]; ?></td>
                        <td ><?= $row["jenis_barang"]; ?></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
                <nav style="margin-top: -15px; margin-bottom: -15px;">
                  <ul class="pagination pagination-sm justify-content-end">
                    <li class="page-item">
                      <?php if ($pageActive == 1) : ?>
                        <a class="page-link disabled" href="?page=<?= $pageActive - 1; ?>" tabindex="-1">Previous</a>
                      <?php else : ?>
                        <a class="page-link" href="?page=<?= $pageActive - 1; ?>" tabindex="-1">Previous</a>
                      <?php endif ?>
                    </li>
                    <?php for ($i = $startNumber; $i <= $endNumber; $i++) : ?>
                      <?php if ($i == $pageActive) : ?>
                        <li class="page-item"><a class="page-link active" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                      <?php else : ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a></li>
                      <?php endif ?>
                    <?php endfor ?>
                    <li class="page-item">
                      <?php if ($pageActive == $totalPage) : ?>
                        <a class="page-link disabled" href="?page=<?= $pageActive + 1; ?>">Next</a>
                      <?php else : ?>
                        <a class="page-link" href="?page=<?= $pageActive + 1; ?>">Next</a>
                      <?php endif ?>
                    </li>
                  </ul>
                </nav>
              </div>
            </div>

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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>