<?php
session_start();

require_once 'db.php';

$successMessage = $_SESSION['successMessage'] ?? '';
unset($_SESSION['successMessage']);

$errorMessage = ''; 

$fullName = trim($_POST['fullName'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$topic = trim($_POST['topic'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (empty($fullName) || empty($email) || empty($phone) || empty($topic) || empty($message)) {
        $errorMessage = "Semua field harus diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Format email tidak valid.";
    } else {
        try {
            $createTable = "CREATE TABLE IF NOT EXISTS contact_messages (
                id INT AUTO_INCREMENT PRIMARY KEY,
                full_name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                phone VARCHAR(20) NOT NULL,
                topic VARCHAR(200) NOT NULL,
                message TEXT NOT NULL,
                sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                status ENUM('unread','read','replied') DEFAULT 'unread'
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

            $conn->query($createTable); 

            $stmt = $conn->prepare(
                "INSERT INTO contact_messages 
                (full_name, email, phone, topic, message, sent_at, status)
                VALUES (?, ?, ?, ?, ?, NOW(), 'unread')"
            );

            if ($stmt) {
                $stmt->bind_param("sssss", $fullName, $email, $phone, $topic, $message);
                $ok = $stmt->execute();

                if ($ok) {
                    $_SESSION['successMessage'] = "Terima kasih, " . htmlspecialchars($fullName) . ". Pesan Anda berhasil terkirim.";
                    
                    header("Location: " . basename(__FILE__));
                    exit();
                } else {
                    $errorMessage = "Gagal mengirim pesan: " . $stmt->error;
                }

                $stmt->close();
            } else {
                $errorMessage = "Gagal menyiapkan query: " . $conn->error;
            }
        } catch (Exception $e) {
            $errorMessage = "Terjadi kesalahan saat memproses permintaan.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coursia Contact</title>
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<div class="contact-form-container">
    <div class="logo-header">
        <i class="fa-solid fa-graduation-cap logo-icon"></i>
        <span class="logo-text">Coursia</span>
        <span class="page-title-text">Contact</span>
    </div>

    <div class="tagline">
        <strong>Need help? Send a message to the Coursia team.</strong>
        <p class="tagline-description">Kami siap membantu Anda.</p>
    </div>

    <?php if ($successMessage): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fa-solid fa-check-circle icon-margin-right"></i>
            <strong>Berhasil!</strong> <?= $successMessage ?>
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if ($errorMessage): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fa-solid fa-exclamation-circle icon-margin-right"></i>
            <strong>Error!</strong> <?= $errorMessage ?>
            <button class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="info-container">
        <div class="row info-row-gap">
            <div class="col-md-6 info-card-col info-card-margin info-card-margin--md">
                <div class="info-card">
                    <div class="info-card__icon-group">
                        <i class="fa-solid fa-envelope info-icon"></i>
                        <div class="info-card__text-group">
                            <div class="info-card__label">Email</div>
                            <div class="info-card__value">Halo@Coursia.id</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 info-card-col info-card-margin info-card-margin--md">
                <div class="info-card">
                    <div class="info-card__icon-group">
                        <i class="fa-solid fa-phone info-icon"></i>
                        <div class="info-card__text-group">
                            <div class="info-card__label">Phone</div>
                            <div class="info-card__value">1234-5678-90</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="address-item">
                <i class="fa-solid fa-location-dot icon-margin-right"></i>
                <strong>Alamat:</strong> Jl. Pendidikan No. 123, Jakarta
            </div>
        </div>
    </div>

    <h3><i class="fa-solid fa-paper-plane icon-margin-right"></i>Send Message</h3>

    <form action="" method="POST" id="contactForm">
        <div class="row form-row form-row--medium-spacing">
            <div class="col-md-6 form-input-col">
                <input type="text" class="form-control" name="fullName" placeholder="Enter your full name" required value="<?= htmlspecialchars($fullName) ?>">
            </div>
            <div class="col-md-6 form-input-col">
                <input type="email" class="form-control" name="email" placeholder="Enter your email" required value="<?= htmlspecialchars($email) ?>">
            </div>
        </div>

        <div class="row form-row form-row--medium-spacing">
            <div class="col-md-6 form-input-col">
                <input type="tel" class="form-control" name="phone" placeholder="Enter your phone number" required value="<?= htmlspecialchars($phone) ?>">
            </div>
            <div class="col-md-6 form-input-col">
                <select class="form-control" name="topic" required>
                    <option value="">Select topic...</option>
                    <option value="Registration" <?= $topic == 'Registration' ? 'selected' : '' ?>>Registration</option>
                    <option value="Curriculum" <?= $topic == 'Curriculum' ? 'selected' : '' ?>>Curriculum</option>
                    <option value="Payment" <?= $topic == 'Payment' ? 'selected' : '' ?>>Payment</option>
                    <option value="Trial Class" <?= $topic == 'Trial Class' ? 'selected' : '' ?>>Trial Class</option>
                    <option value="General Inquiry" <?= $topic == 'General Inquiry' ? 'selected' : '' ?>>General Inquiry</option>
                    <option value="Other" <?= $topic == 'Other' ? 'selected' : '' ?>>Other</option>
                </select>
            </div>
        </div>

        <div class="row form-row--large-spacing">
            <div class="col-12">
                <textarea class="form-control" name="message" placeholder="Write your message here..." required><?= htmlspecialchars($message) ?></textarea>
            </div>
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-send">
                <i class="fa-solid fa-paper-plane icon-margin-right"></i>Send Message
            </button>
            <button type="reset" class="btn btn-clear">
                <i class="fa-solid fa-eraser icon-margin-right"></i>Clear Form
            </button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            let bs = new bootstrap.Alert(alert)
            bs.close()
        })
    }, 5000)

    document.getElementById('contactForm').addEventListener('submit', e => {
        let phone = document.querySelector('input[name="phone"]').value
        if (!/^\d+$/.test(phone.replace(/[\s\-\(\)]/g, ''))) {
            e.preventDefault()
            alert('Please enter a valid phone number')
        }
    })
</script>
</body>
</html>
