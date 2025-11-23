<?php
require_once 'db.php';

$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $conn->real_escape_string(trim($_POST['nama_lengkap']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $no_hp = $conn->real_escape_string(trim($_POST['no_hp']));
    $program = $conn->real_escape_string(trim($_POST['program_kursus']));
    $jadwal = $conn->real_escape_string(trim($_POST['jadwal_kursus']));

    $sql_user_check = "SELECT id_user FROM user WHERE email = '$email'";
    $result_user = $conn->query($sql_user_check);
    $id_user = 0;

    if ($result_user->num_rows > 0) {
        $row = $result_user->fetch_assoc();
        $id_user = $row['id_user'];
    } else {
        $sql_insert_user = "INSERT INTO user (email, no_hp) VALUES ('$email', '$no_hp')";
        if ($conn->query($sql_insert_user) === TRUE) {
            $id_user = $conn->insert_id;
        } else {
            $error_message = "Error tambah user: " . $conn->error;
            goto end_process;
        }
    }

    if ($id_user > 0) {
        $sql_insert_kursus = "INSERT INTO daftar_kursus (id_user, nama, email, no_hp, program, jadwal) 
                              VALUES ('$id_user', '$nama', '$email', '$no_hp', '$program', '$jadwal')";
        if ($conn->query($sql_insert_kursus) === TRUE) {
            $success_message = "Pendaftaran berhasil.";
        } else {
            $error_message = "Error daftar kursus: " . $conn->error;
        }
    }

    end_process:
}

if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulir Pendaftaran Kursus</title>
  <link rel="stylesheet" href="../css/daftar.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <div class="form-container">
    <div class="form-header">
      <img src="../assets/logo.png" alt="Logo Coursia" class="logo">
      <h2>Daftar Sekarang</h2>
      <p>Isi formulir untuk mendaftarkan diri Anda.</p>
    </div>

    <?php 
      if (!empty($success_message)) echo '<div class="message success">'.$success_message.'</div>';
      if (!empty($error_message)) echo '<div class="message error">'.$error_message.'</div>';
    ?>

    <form class="register-form" method="POST" action="">
      <label for="nama_lengkap">Nama Lengkap</label>
      <input type="text" id="nama_lengkap" name="nama_lengkap" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>

      <label for="no_hp">No. Handphone</label>
      <input type="tel" id="no_hp" name="no_hp" required>

      <label for="program_kursus">Pilih Program</label>
      <select id="program_kursus" name="program_kursus" required> 
        <option value="">Pilih Program</option>
        <option value="English for Kids">English for Kids</option>
        <option value="English for Teens">English for Teens</option>
        <option value="Adults & Professionals">Adults & Professionals</option>
        <option value="TOEFL & IELTS Intensive">TOEFL & IELTS Intensive</option>
      </select>

      <label for="jadwal_kursus">Pilih Jadwal</label>
      <select id="jadwal_kursus" name="jadwal_kursus" required> 
        <option value="">Pilih Jadwal</option>
        <option value="Senin & Rabu (16:00 - 17:00)">Senin & Rabu (16:00 - 17:00)</option>
        <option value="Sabtu (09:00 - 10:30)">Sabtu (09:00 - 10:30)</option>
        <option value="Selasa & Kamis (15:30 - 17:00)">Selasa & Kamis (15:30 - 17:00)</option>
        <option value="Jumat (16:00 - 17:30)">Jumat (16:00 - 17:30)</option>
        <option value="Minggu (10:00 - 11:30)">Minggu (10:00 - 11:30)</option>
      </select>

      <button type="submit" class="btn-submit">Mendaftar</button>
    </form>
  </div>
</body>
</html>
