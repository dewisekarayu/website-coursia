<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Jadwal Kelas Coursia</title>
  <link href="../css/jadwalkelas.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet" />
</head>

<body>
  <section id="jadwal" class="container">
    <h2 class="title">Jadwal Kelas Reguler (Online)</h2>
    <p class="subtitle">Pilihan jadwal kelas kelompok untuk semua level. Jadwal Privat lebih fleksibel.</p>

    <div class="tab-container">
      <button class="tab-button active" data-target="kids">Kids (4-12)</button>
      <button class="tab-button" data-target="teens">Teens (13-17)</button>
      <button class="tab-button" data-target="adults">Adults (18+)</button>
    </div>

    <div id="jadwal-content">
      <div id="kids" class="jadwal-tab active">
        <div class="card blue">
          <h3>Kids (4-12 Tahun) - Starter Level</h3>
          <table>
            <thead>
              <tr>
                <th>Hari</th><th>Waktu (WIB)</th><th>Pengajar</th><th>Durasi</th><th>Sisa Slot</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>Senin & Rabu</td><td>15:00 - 16:00</td><td>Ms. Anna</td><td>60 Menit</td><td class="green">4/8</td></tr>
              <tr><td>Selasa & Kamis</td><td>16:30 - 17:30</td><td>Mr. John</td><td>60 Menit</td><td class="orange">1/8</td></tr>
              <tr><td>Sabtu (Intensif)</td><td>09:00 - 10:30</td><td>Ms. Maya</td><td>90 Menit</td><td class="gray">Penuh</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div id="teens" class="jadwal-tab">
        <div class="card green">
          <h3>Teens (13-17 Tahun) - Elementary Level</h3>
          <table>
            <thead>
              <tr>
                <th>Hari</th><th>Waktu (WIB)</th><th>Pengajar</th><th>Durasi</th><th>Sisa Slot</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>Senin & Rabu</td><td>18:00 - 19:30</td><td>Ms. Anna</td><td>90 Menit</td><td class="green">5/10</td></tr>
              <tr><td>Selasa & Kamis</td><td>17:00 - 18:30</td><td>Mr. Rizky</td><td>90 Menit</td><td class="green">7/10</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div id="adults" class="jadwal-tab">
        <div class="card orange">
          <h3>Adults & Professionals (18+) - Intermediate Level</h3>
          <table>
            <thead>
              <tr>
                <th>Hari</th><th>Waktu (WIB)</th><th>Pengajar</th><th>Durasi</th><th>Sisa Slot</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>Selasa & Kamis</td><td>19:30 - 21:00</td><td>Mr. Rizky</td><td>90 Menit</td><td class="green">6/10</td></tr>
              <tr><td>Jumat (Business Focus)</td><td>20:00 - 21:30</td><td>Mr. John</td><td>90 Menit</td><td class="orange">2/10</td></tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="cta">
      <a href="#">Pesan Kursi Anda Sekarang</a>
      <p>Untuk jadwal kelas offline atau privat, silakan hubungi admin.</p>
    </div>
  </section>

  <script>
    const tabs = document.querySelectorAll('.tab-button');
    const contents = document.querySelectorAll('.jadwal-tab');

    tabs.forEach(tab => {
      tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        contents.forEach(c => c.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById(tab.dataset.target).classList.add('active');
      });
    });
  </script>
</body>
</html>
