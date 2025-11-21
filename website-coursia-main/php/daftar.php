<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Formulir Pendaftaran Kursus</title>
  <link rel="stylesheet" href="../css/daftar.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="form-container">
    <div class="form-header">
      <img src="../assets/logo.png" alt="Logo Coursia" class="logo">
      <h2>Daftar Sekarang</h2>
      <p>Isi formulir untuk mendaftarkan diri Anda.</p>
    </div>

    <form class="register-form">
      <label>Nama Lengkap</label>
      <input type="text" placeholder="Nama Lengkap" required>

      <label>Email</label>
      <input type="email" placeholder="email@domain.com" required>

      <label>No.Handphone</label>
      <input type="tel" placeholder="No. Handphone" required>

      <label>Pilih Program</label>
      <select required>
        <option value="">---Pilih Program---</option>
        <option>Bahasa Inggris Dasar</option>
        <option>Bahasa Inggris Bisnis</option>
        <option>Speaking Class</option>
      </select>

      <label>Pilih Jadwal</label>
      <select required>
        <option value="">---Pilih Jadwal---</option>
        <option>Pagi</option>
        <option>Siang</option>
        <option>Malam</option>
      </select>

      <button type="submit" class="btn-submit">Mendaftar</button>
    </form>
  </div>
</body>
</html>
