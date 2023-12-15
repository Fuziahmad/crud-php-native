<?php
include "controlers/registrasiAdmin.php";
session_start();

if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}

if (isset($_POST["register"])) {
  if ($_POST["password1"] != $_POST["password2"]) {
    $error = true;
}
  if (register($_POST) > 0) {
    $berhasil = true;
  } else {
    echo mysqli_error($conn);
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Admin</title>
  <!-- bootstrap 5 css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="views/fontawesome-free-6.2.1-web/fontawesome-free-6.2.1-web/css/all.css">
  <script src="views/jquery-ui-1.13.2.custom/external/jquery/jquery.js"></script>
  <script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <link href="views/css/style.css" rel="stylesheet" />
  <script src="views/js/rupiah.js"></script>
  <script src="views/js/script.js"></script>
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
      <a class="nav-link active" href="register.php">
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
          <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Tambah Admin</li>
          </ol>
          <div class="register-card">
            <div class="card mb-4 shadow bg-white">
              <div class="card-header">
                <i class="fa-solid fa-user-plus"></i>
                Tambah Admin
              </div>
              <div class="card-body">
                <form class="mx-3" action="" method="POST" enctype="multipart/form-data">
                  <div class="form-group row mb-4 my-3">
                    <label for="full_name" class="col-md-4 col-form-label text-md-right">Nama Lengkap</label>
                    <div class="col-md-6">
                      <input type="text" id="full_name" class="form-control" name="namaLengkap" required>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label for="nip" class="col-md-4 col-form-label text-md-right">Nim</label>
                    <div class="col-md-6">
                      <input type="number" id="nip" class="form-control" name="nip" required>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label for="photo" class="col-md-4 col-form-label text-md-right">Photo</label>
                    <div class="col-md-6">
                      <input type="file" accept="image/jpeg,image/png" name="photo" id="photo" class="form-control" required> 
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label for="jenisKelamin" class="col-md-4 col-form-label text-md-right">Jenis Kelamin</label>
                    <div class="col-md-6">
                      <select class="form-select" name="jenisKelamin" required>
                        <option selected>Jenis Kelamin</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label for="tempatLahir" class="col-md-4 col-form-label text-md-right">Tempat Lahir</label>
                    <div class="col-md-6">
                      <input type="text" id="tempatLahir" class="form-control" name="tempatLahir" required>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label for="tglLahir" class="col-md-4 col-form-label text-md-right">Tanggal Lahir</label>
                    <div class="col-md-6">
                      <input type="date" id="tglLahir" class="form-control" name="tglLahir" required>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label for="alamat" class="col-md-4 col-form-label text-md-right">Alamat</label>
                    <div class="col-md-6">
                      <input type="text" id="alamat" class="form-control" name="alamat" required>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                    <div class="col-md-6">
                      <input type="text" id="username" class="form-control" name="username" required>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label for="password1" class="col-md-4 col-form-label text-md-right">Password</label>
                    <div class="col-md-6">
                      <input type="password" id="password1" class="form-control" name="password1" required>
                    </div>
                  </div>

                  <div class="form-group row mb-4">
                    <label for="password2" class="col-md-4 col-form-label text-md-right">Konfirmasi Password</label>
                    <div class="col-md-6">
                      <input type="password" id="password2" class="form-control" name="password2" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <button type="submit" name="register" class="btn btn-primary">
                      Register
                    </button>
                  </div>
                </form>
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
if(isset($berhasil)){
  echo "<script>
  swal({
      title: 'Berhasil',
      text: 'User Baru Berhasil Ditambahkan',
      icon: 'success',
  });
  setTimeout(function(){
    window.location = 'index.php';
}, 2000);
 
  </script>";
}

if(isset($error)){
  echo "<script>
  swal({
      title: 'Gagal',
      text: 'Konfirmasi Passord Tidak Sesuai',
      icon: 'error',
  });
  setTimeout(function(){
    window.location = 'register.php';
}, 2000);
 
  </script>";
}
?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>