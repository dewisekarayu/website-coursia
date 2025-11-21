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

      <form>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="email@domain.com">
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" placeholder="********">
        </div>

        <div class="form-remember">
          <label>
            <input type="checkbox"> Ingat saya
          </label>
          <a href="#">Lupa password?</a>
        </div>

        <button type="submit" class="btn-submit">Masuk</button>
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

      <p class="register-link">
        Belum punya akun? <a href="daftar.html">Daftar sekarang</a>
      </p>
    </div>
  </div>
</body>
</html>
