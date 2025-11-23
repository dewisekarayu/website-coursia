const mentors = {
  beginner: {
    name: "Mrs. Hana",
    img: "https://images.unsplash.com/photo-1607746882042-944635dfe10e?auto=format&fit=crop&w=500&q=80",
    desc: "Mrs. Hana adalah tutor ramah yang fokus membangun dasar grammar dan kosakata untuk pemula. Gaya mengajarnya interaktif dan menyenangkan."
  },
  intermediate: {
    name: "Mr. hans",
    img: "../assets/hans.jpeg",
    desc: "Mr. Jonathan membantu siswa meningkatkan kemampuan berbicara dan menulis melalui diskusi, storytelling, dan latihan nyata yang menarik."
  },
  advanced: {
    name: "Ms. Keysha",
    img: "../assets/keke.jpeg",
    desc: "Ms. Keysha melatih siswa untuk komunikasi profesional dan ujian tingkat lanjut dengan fokus pada struktur argumen dan pelafalan."
  }
};

function showMentor(level) {
  const mentor = mentors[level];
  document.getElementById('mentor-section').classList.remove('hidden');
  document.getElementById('mentor-img').src = mentor.img;
  document.getElementById('mentor-name').textContent = mentor.name;
  document.getElementById('info-text').style.display = "none";
  document.getElementById('info-text').textContent = mentor.desc;
}

function toggleInfo() {
  const info = document.getElementById('info-text');
  info.style.display = info.style.display === "none" ? "block" : "none";
}
