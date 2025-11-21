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
        <p>Isi data berikut untuk membuat akun</p>
      </div>

      <form>
        <div class="form-group">
          <label for="fullname">Nama Lengkap</label>
          <input type="text" id="fullname" placeholder="Nama lengkap">
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="email@domain.com">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" placeholder="********">
        </div>

        <div class="form-group">
          <label for="confirm-password">Konfirmasi Password</label>
          <input type="password" id="confirm-password" placeholder="********">
        </div>

        <button type="submit" class="btn-submit">Daftar</button>
      </form>

      <div class="divider">
        <hr><span>atau</span><hr>
      </div>

      <div class="social-buttons">
        <button class="btn-social">
          <img src="https://www.svgrepo.com/show/355037/google.svg" alt=""> Google
        </button>
        <button class="btn-social">
          <img src="https://www.svgrepo.com/show/448224/facebook.svg" alt=""> Facebook
        </button>
      </div>

      <p class="login-link">
        Sudah punya akun? <a href="login.html">Masuk di sini</a>
      </p>
    </div>
  </div>
</body>
</html>
