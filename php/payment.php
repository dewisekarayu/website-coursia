<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembayaran — Coursia</title>
  <link rel="stylesheet" href="../css/payment.css">
</head>
<body>
  <div class="container">
    <h1 class="title">Pembayaran Kursus</h1>
    <p class="subtitle">Silakan lengkapi data dan pilih metode pembayaran</p>

    <form class="payment-form">
      <label for="name">Nama Lengkap</label>
      <input type="text" id="name" placeholder="Nama sesuai akun">

      <label for="email">Email</label>
      <input type="email" id="email" placeholder="email@domain.com">

      <label for="method">Metode Pembayaran</label>
      <select id="method">
        <option value="">Pilih Metode</option>
        <option value="transfer">Transfer Bank</option>
        <option value="ewallet">E-Wallet</option>
        <option value="credit">Kartu Kredit</option>
      </select>

      <label for="amount">Jumlah Pembayaran</label>
      <input type="number" id="amount" placeholder="Masukkan nominal">

      <button type="submit" class="pay-btn">Bayar Sekarang</button>
    </form>

    <div class="note">
      <p>Setelah pembayaran, bukti transaksi akan dikirim ke email Anda.</p>
    </div>
  </div>
</body>
</html>
