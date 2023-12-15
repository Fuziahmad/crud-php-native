<?php
include "controlers/query.php";
@include "controlers/editProfil.php";
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
$user = strtolower($_SESSION["username"]);

$profil = query("SELECT * FROM user WHERE username = '$user' ")[0];

if (isset($_POST["editProfil"])) {
    // apakah pengguna telah memasukkan kata sandi baru
    if (!empty($_POST['password1'])) {
        // apakah kata sandi pengguna saat ini sudah benar
        if (password_verify($_POST['password1'], $profil["password"])) {
            // Update profil dan kata sandi baru
            if (editProfil($_POST) > 0) {
                $berhasil = true;
            } else {
                $error = true;
                echo mysqli_error($conn);
            }
        } else {
            $passLamaSalah = true;
        }
    } else {
        // Update tanpa memperbarui sandi baru
        if (editProfil($_POST, false) > 0) {
            $profil = query("SELECT * FROM user WHERE username = '$user' ")[0];
            if ($profil["username"] != $user) {
                header("Location: logout.php");
                exit;
            }
            $berhasil = true;
        } else {
            $error = true;
            echo mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profil</title>
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
        <a class="navbar-brand mx-3" href="index.php"><b class="brand">About</b></a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-dark" id="button-toggle">
            <i class="fas fa-bars"></i>
        </button>
        <marquee class="marquee text-light" behavior="scroll" direction="left" loop="infinite">🚀 Crud PHP Native 🚀<span style="margin-left: 960px;">Project Ini Diajukan Untuk Memenuhi Tugas Praktikum Pemrograman Web 1 </span></marquee>
    </nav>
    <div class="sidebar fixed-top mt-5 p-4 bg-dark" id="sidebar">
        <nav class="nav d-block">
            <a class="nav-link active" href="profil.php">
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
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                    <div class="container-xl px-4" style="margin-top: -20px;">
                        <form action="" method="post">
                            <div class="row">
                                <div class="col-xl-4">
                                    <!-- Profile picture card-->
                                    <div class="card mb-4 mb-xl-0 shadow">
                                        <div class="card-header">Foto Profil</div>
                                        <div class="card-body text-center">
                                            <!-- Profile picture image-->
                                            <img class="img-account-profile mb-2" src="asset/img/<?= $profil["photo"] ?>" id="img" alt="" style="height: 10rem;">
                                            <div class="small font-italic text-muted mb-4"><?= $profil["photo"] ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8">
                                    <!-- Account details card-->
                                    <div class="card mb-4 shadow">
                                        <div class="card-header">Detail Akun</div>
                                        <div class="card-body">
                                            <form action="" method="post">
                                                <input class="form-control" type="hidden" name="idAdmin" value="<?= $profil["id_admin"] ?>">
                                                <!-- Form Group (username)-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="namaLengkap">Nama Lengkap</label>
                                                    <input class="form-control" id="namaLengkap" type="text" name="namaLengkap" value="<?= $profil["nama_lengkap"] ?>">
                                                </div>
                                                <!-- Form Row        -->
                                                <div class="row gx-3 mb-3">
                                                    <!-- Form Group -->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="nip">Nim</label>
                                                        <input class="form-control" id="nip" type="text" name="nip" value="<?= $profil["nip"] ?>">
                                                    </div>
                                                    <!-- Form Group -->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="jenisKelamin">Jenis Kelamin</label>
                                                        <select class="form-select" name="jenisKelamin" required>
                                                            <?php if (isset($profil["jenis_kelamin"]) && $profil["jenis_kelamin"] == 'L') : ?>
                                                                <option value="L" selected>Laki-Laki</option>
                                                                <option value="P">Perempuan</option>
                                                            <?php elseif (isset($profil["jenis_kelamin"]) && $profil["jenis_kelamin"] == 'P') : ?>
                                                                <option value="L">Laki-Laki</option>
                                                                <option value="P" selected>Perempuan</option>
                                                            <?php else : ?>
                                                                <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                                                <option value="L">Laki-Laki</option>
                                                                <option value="P">Perempuan</option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Form Group-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="tempatLahir">Tempat Lahir</label>
                                                    <input class="form-control" id="tempatLahir" type="text" name="tempatLahir" value="<?= $profil["tempat_lahir"] ?>">
                                                </div>
                                                  <!-- Form Group-->
                                                  <div class="mb-3">
                                                    <label class="small mb-1" for="tglLahir">Tanggal Lahir</label>
                                                    <input class="form-control" id="tglLahir" type="date" name="tglLahir" value="<?= $profil["tgl_lahir"] ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="alamat">Alamat</label>
                                                    <input class="form-control" id="alamat" type="text" name="alamat" value="<?= $profil["alamat"] ?>">
                                                </div>
                                                <!-- Form Group-->
                                                <div class="mb-3">
                                                    <label class="small mb-1" for="username">Username</label>
                                                    <input class="form-control" id="username" type="text" name="username" value="<?= $profil["username"] ?>">
                                                </div>
                                                <!-- Form Row-->
                                                <div class="row gx-3 mb-3">
                                                    <p><b>Ubah Password</b></p>
                                                    <hr>
                                                    <!-- Form Group -->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="Password1">Pasword Lama</label>
                                                        <input class="form-control" id="Password1" type="password" name="password1">
                                                    </div>
                                                    <!-- Form Group (birthday)-->
                                                    <div class="col-md-6">
                                                        <label class="small mb-1" for="password2">Password Baru</label>
                                                        <input class="form-control" id="password2" type="text" name="password2">
                                                    </div>
                                                </div>
                                                <!-- Save changes button-->
                                                <button class="btn btn-primary" name="editProfil" type="submit">Simpan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    if (isset($berhasil)) {
        echo "<script>
        swal({
            title: 'Berhasil',
            text: 'Data Berhasil Di Ubah',
            icon: 'success',
        });
        setTimeout(function(){
            window.location = 'profil.php';
        }, 2000);
        </script>";
    }

    if (isset($passLamaSalah)) {
        echo "<script>
        swal({
            title: 'Gagal',
            text: 'Password Lama Salah !',
            icon: 'error',
        });
        </script>";
    }

    if (isset($error)) {
        echo "<script>
        swal({
            title: 'Gagal',
            text: 'Data Gagal Diubah',
            icon: 'error',
        });
        </script>";
    }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>