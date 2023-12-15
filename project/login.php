<?php
include "config/connect.php";
session_start();

if (isset($_COOKIE['YGD232SA']) && isset($_COOKIE['key'])) {
  $idAdmin = $_COOKIE['YGD232SA'];
  $username = $_COOKIE['key'];

  //ambil username berdasarkan id
  $result = mysqli_query($conn, "SELECT username FROM user WHERE id_admin = $idAdmin");
  $row = mysqli_fetch_assoc($result);

  //cek cookie dan username
  if ($username === hash('sha256', $row['username'])) {
    $_SESSION['login'] = true;
  }
}
//redirect ke halaman index.php
if (isset($_SESSION["login"])) {
  header("Location: index.php");
  exit;
}

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

  //cek username
  if (mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row["password"])) {
      //set session
      $_SESSION["login"] = true;
      $_SESSION["username"] = $username;
      //set cookie
      if (isset($_POST["remember"])) {
        setcookie('YGD232SA', $row['id_admin'], time() + 120);
        setcookie('key', hash('sha256', $row['username']), time() + 120);
      }
      header("Location: index.php");
      exit;
    }
  }


  $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="jquery-ui-1.13.2.custom/external/jquery/jquery.js"></script>
  <script src="views/js/showHidepass.js"></script>
  <link rel="stylesheet" href="views/fontawesome-free-6.2.1-web/fontawesome-free-6.2.1-web/css/all.css">
</head>

<body>
  <div class="container-fluid bg-dark" style="height: 100vh;">
    <div class="row">
      <div class="col-sm-5 col-md-5 col-lg-4 mx-auto">
        <div class="card border-0 shadow rounded-3 my-5">
          <div class="card-body p-4 p-sm-5">
            <h3 class="card-title text-center mb-5 fw-light"><b>Log In</b></h3>
            <?php if (isset($error)) : ?>
              <p class="fst-italic text-danger align-center">*Username atau Password Salah!</p>
            <?php endif ?>
            <form action="" method="POST">
              <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username" required>
                <label for="floatingInput">Username</label>
              </div>
              <div class="form-floating mb-3 d-flex">
                <input type="password" name="password" id="pass" class="form-control flex-grow-1" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
                <span id="showHide" onclick="change()" class="input-group-text">
                  <!-- icon mata  -->
                  <i class="fa-sharp fa-solid fa-eye-slash"></i>
                </span>
              </div>
              <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="rememberPasswordCheck" name="remember">
                <label class="form-check-label" for="rememberPasswordCheck">
                  Ingat Saya
                </label>
              </div>
              <div class="d-grid">
                <button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="login">Log In</button>
              </div>
              <hr class="my-3">
              <div class="text-muted small text-center">Copyright &copy; Fuzi Ahmad Fahreza 2023</div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>