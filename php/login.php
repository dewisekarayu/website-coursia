<?php
session_start();
require_once 'db.php'; // pastikan path benar

$pesan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($email === '' || $password === '') {
        $pesan = "Email dan password wajib diisi";
    } else {
        $query = mysqli_query($conn,
            "SELECT * FROM tb_login WHERE email='$email' AND password='$password' LIMIT 1"
        );

        if (mysqli_num_rows($query) === 1) {
            $data = mysqli_fetch_assoc($query);
            $_SESSION['id_daftar'] = $data['id_daftar'];
            $_SESSION['email'] = $data['email'];

            header("Location: homepage.php");
            exit;
        } else {
            $pesan = "Email atau password salah";
        }
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <title>Login — Coursia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../css/login.css">
</head>

<body>

  <div class="login-page">
    <div class="login-card">
      <div class="login-header">
        <img src="../assets/logo.png" alt="Coursia" class="logo">
        <h1>Masuk ke Akun</h1>
        <p>Gunakan email & password untuk melanjutkan</p>
      </div>

      <?php 
      if ($pesan !== "") {
        echo "<p style='color:red;text-align:center;margin-bottom:10px;'>$pesan</p>";
      }
      ?>

      <form method="POST" action="">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="email@domain.com">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="********">
        </div>

        <div class="form-remember">
          <label>
            <input type="checkbox"> Ingat saya
          </label>
          <a href="#">Lupa password?</a>
        </div>

        <button type="submit" class="btn-submit">Masuk</button>
      </form>




      <p class="register-link">
        Belum punya akun? <a href="daftar.php">Daftar sekarang</a>
      </p>
    </div>
  </div>

</body>
</html>
