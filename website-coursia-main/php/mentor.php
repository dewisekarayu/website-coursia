<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coursia Mentor</title>
  <link rel="stylesheet" href="../css/mentor.css">
</head>
<body>
  <div class="container">
    <h2 class="title">Coursia Instruktur</h2>
    <p class="subtitle">Pilih level kemampuanmu agar belajar lebih efektif</p>

    <div class="level-buttons">
      <button onclick="showMentor('beginner')">Beginner</button>
      <button onclick="showMentor('intermediate')">Intermediate</button>
      <button onclick="showMentor('advanced')">Advanced</button>
    </div>

    <div id="mentor-section" class="hidden">
      <div class="mentor-card">
        <img id="mentor-img" src="" alt="Mentor">
        <h3 id="mentor-name"></h3>
        <div class="stars">⭐⭐⭐⭐⭐</div>
        <button class="info-btn" onclick="toggleInfo()">Info Lebih Lanjut</button>
        <div id="info-text" class="info-text"></div>
      </div>
    </div>
  </div>

  <script src="../js/mentor.js"></script>
</body>
</html>
