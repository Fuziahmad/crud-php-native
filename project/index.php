<?php
include 'controlers/query.php';
@include "controlers/hapusAdmin.php";
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

$jumlahBarang = count(query("SELECT * FROM barang"));
$jumlahJbarang = count(query("SELECT * FROM jenis_barang"));
$jumlahAdmin = count(query("SELECT * FROM user"));
$user = query("SELECT * FROM user");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <!-- bootstrap 5 css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="views/fontawesome-free-6.2.1-web/fontawesome-free-6.2.1-web/css/all.css">
  <script src="views/jquery-ui-1.13.2.custom/external/jquery/jquery.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
      <a class="nav-link active" href="index.php">
        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></div>
      </a>
      <hr class="text-secondary">
      <div class="fw-bold my-3 text-secondary">Tabel Data</div>
      <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i><span class="mx-2">Data Barang</span><i class="fas fa-angle-down"></i></div>
      </a>
      <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
        <nav class="sb-sidenav-menu-nested nav">
          <a class="nav-link mx-2" href="barang.php"><i class="fa-solid fa-bag-shopping"></i><span>Barang</span></a>
          <a class="nav-link mx-2" href="jenisBarang.php"><i class="fa-solid fa-filter"></i><span>Jenis Barang</span></a>
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
          <h1>Dashboard</h1>
          <ol class="breadcrumb mb-3">
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
          <div class="row">
            <div class="col-xl-3 col-md-6">
              <div class="card shadow bg-primary text-white mb-4">
                <div class="card-body">
                  <b>Barang</b>
                  <div class="iconTotalBarang"><i class="fa-solid fa-bag-shopping"></i></div>
                  <h1 class="countData"><?= $jumlahBarang ?></h1>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="barang.php">View Details</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card shadow bg-warning text-white mb-4">
                <div class="card-body">
                  <b>Jenis Barang</b>
                  <div class="iconTotalJb"><i class="fa-solid fa-filter"></i>
                  </div>
                  <h1 class="countData"><?= $jumlahJbarang ?></h1>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="jenisBarang.php">View Details</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card shadow bg-success text-white mb-4">
                <div class="card-body">
                  <b>Admin</b>
                  <div class="iconTotalAdmin"><i class="fa-solid fa-user"></i>
                  </div>
                  <h1 class="countData"><?= $jumlahAdmin ?></h1>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link disabeld" href="about.php">View Details</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-md-6">
              <div class="card shadow bg-danger text-white mb-4" style="height: 163px;">
                <div class="card-body">
                  <b>Profil</b>
                  <div class="iconSettingProfil"><i class="fa-solid fa-gear"></i>
                  </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                  <a class="small text-white stretched-link" href="profil.php">View Details</a>
                  <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
              </div>
            </div>
          </div>
          <div class="card shadow mb-4">
            <div class="card-header">
              <i class="fa-solid fa-people-group me-1"></i>
              Fuzi Ahmad Fahreza
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped  text-center">
                  <thead class="table-dark">
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Nim</th>
                      <th scope="col">Tempat Lahir</th>
                      <th scope="col">Tanggal Lahir</th>
                      <th scope="col">Alamat</th>
                      <th scope="col">Photo</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($user as $row) : ?>
                      <tr>
                        <td scope="row"><?= $i++ ?></td>
                        <td><?= $row["nama_lengkap"] ?></td>
                        <td><?= $row["nip"] ?></td>
                        <td><?= $row["tempat_lahir"] ?></td>
                        <td><?= $row["tgl_lahir"] ?></td>
                        <td><?= $row["alamat"] ?></td>
                        <td> <img src="asset/img/<?= $row["photo"] ?>" alt="" style="width: 60px;"></td>
                        <td><a href="index.php?id=<?= $row["id_admin"]; ?>" class="btn btn-danger btn-sm" type="button"><i class="fa-solid fa-trash"></i></i></a></td>
                      </tr>
                    <?php endforeach ?>
                  </tbody>
                </table>
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
  </div>

  <?php
  if (isset($_GET["id"])) {
    if (hapusAdmin($_GET["id"]) > 0) {
      echo "<script>
    swal({
        title: 'Berhasil',
        text: 'Data Berhasil Di Hapus',
        icon: 'success',
    });
    setTimeout(function(){
        window.location = 'index.php';
    }, 2000);
    </script>";
    } else {
      echo "<script>
    swal({
        title: 'Gagal',
        text: 'Data Gagal Di Hapus',
        icon: 'error',
    });
    setTimeout(function(){
        window.location = 'index.php';
    }, 2000);
    </script>";
    }
  }
  
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>