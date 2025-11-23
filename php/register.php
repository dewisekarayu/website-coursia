<?php
ob_start();
require_once '../php/db.php';

$pesan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $konfirmasi = trim($_POST['konfirmasi']);

    if ($nama === '' || $email === '' || $password === '' || $konfirmasi === '') {
        $pesan = "Semua field wajib diisi";
    } elseif ($password !== $konfirmasi) {
        $pesan = "Password tidak sama";
    } else {
        $cek = mysqli_query($conn, "SELECT * FROM daftar WHERE email='$email'");
        if (mysqli_num_rows($cek) > 0) {
            $pesan = "Email sudah terdaftar";
        } else {
            $insert = mysqli_query($conn,
                "INSERT INTO daftar (nama, email, password, konfirmasi_password)
                 VALUES ('$nama', '$email', '$password', '$konfirmasi')"
            );

            if ($insert) {
                $id = mysqli_insert_id($conn);

                mysqli_query($conn,
                    "INSERT INTO tb_login (id_daftar, email, password)
                     VALUES ($id, '$email', '$password')"
                );

                header("Location: login.php");
                echo "<script>window.location='login.php';</script>";
                exit;
            } else {
                $pesan = "Gagal membuat akun";
            }
        }
    }
}

ob_end_flush();
?>

<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <title>Daftar — Coursia</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="../css/register.css">
</head>

<body>

  <div class="register-page">
    <div class="register-card">
      <div class="register-header">
        <img src="../assets/logo.png" alt="Coursia" class="logo">
        <h1>Buat Akun Baru</h1>
        <p>Isi data lengkap kamu untuk melanjutkan</p>
      </div>

      <?php 
      if ($pesan !== "") {
        echo "<p style='color:red;text-align:center;margin-bottom:10px;'>$pesan</p>";
      }
      ?>

      <form method="POST" action="">
        <div class="form-group">
          <label for="nama">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" placeholder="Nama lengkap">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="email@domain.com">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="********">
        </div>

        <div class="form-group">
          <label for="konfirmasi">Konfirmasi Password</label>
          <input type="password" id="konfirmasi" name="konfirmasi" placeholder="********">
        </div>

        <button type="submit" class="btn-submit">Daftar Sekarang</button>
      </form>

      <p class="login-link">
        Sudah punya akun? <a href="login.php">Masuk</a>
      </p>
    </div>
  </div>

</body>
</html>
