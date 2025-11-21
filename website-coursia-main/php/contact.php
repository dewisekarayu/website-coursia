<?php
$host = 'localhost';
$dbname = 'db_coursia';
$username = 'root';
$password = '0000';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Koneksi database gagal. Silakan coba beberapa saat lagi.");
}

$successMessage = '';
$errorMessage = '';
$fullName = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$topic = isset($_POST['topic']) ? trim($_POST['topic']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = trim($_POST['fullName']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $topic = trim($_POST['topic']);
    $message = trim($_POST['message']);
    
    if (empty($fullName) || empty($email) || empty($phone) || empty($topic) || empty($message)) {
        $errorMessage = "Semua field harus diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = "Format email tidak valid!";
    } else {
        try {
            $sql = "INSERT INTO contact_messages (full_name, email, phone, topic, message, sent_at, status) 
                    VALUES (:full_name, :email, :phone, :topic, :message, NOW(), 'unread')";
            
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([
                ':full_name' => $fullName,
                ':email' => $email,
                ':phone' => $phone,
                ':topic' => $topic,
                ':message' => $message
            ]);
            
            if ($result) {
                $successMessage = "Terima kasih, " . htmlspecialchars($fullName) . "! Pesan Anda telah terkirim. Tim Coursia akan segera menghubungi Anda melalui email: " . htmlspecialchars($email) . " atau telepon: " . htmlspecialchars($phone);
                
                $fullName = $email = $phone = $topic = $message = '';
            }
            
        } catch(PDOException $e) {
            if ($e->getCode() == '42S02') {
                try {
                    $createTable = "CREATE TABLE IF NOT EXISTS contact_messages (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        full_name VARCHAR(100) NOT NULL,
                        email VARCHAR(100) NOT NULL,
                        phone VARCHAR(20) NOT NULL,
                        topic VARCHAR(200) NOT NULL,
                        message TEXT NOT NULL,
                        sent_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        status ENUM('unread', 'read', 'replied') DEFAULT 'unread',
                        INDEX idx_email (email),
                        INDEX idx_sent_at (sent_at),
                        INDEX idx_status (status)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
                    
                    $pdo->exec($createTable);
                    
                    $stmt = $pdo->prepare($sql);
                    $result = $stmt->execute([
                        ':full_name' => $fullName,
                        ':email' => $email,
                        ':phone' => $phone,
                        ':topic' => $topic,
                        ':message' => $message
                    ]);
                    
                    if ($result) {
                        $successMessage = "Terima kasih, " . htmlspecialchars($fullName) . "! Pesan Anda telah terkirim. Tim Coursia akan segera menghubungi Anda melalui email: " . htmlspecialchars($email) . " atau telepon: " . htmlspecialchars($phone);
                        $fullName = $email = $phone = $topic = $message = '';
                    }
                } catch(PDOException $e2) {
                    $errorMessage = "Gagal mengirim pesan: " . $e2->getMessage();
                }
            } else {
                $errorMessage = "Gagal mengirim pesan: " . $e->getMessage();
            }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* --- GLOBAL & CONTAINER STYLING --- */
        body {
            font-family: Arial, sans-serif;
            background-color: #e6f0ff; 
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        /* PERUBAHAN CLASS NAME DI SINI */
        .contact-form-container {
            background-color: #fff;
            padding: 35px 40px; 
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1); 
            max-width: 600px;
            width: 100%;
        }
        
        /* --- HEADER & TAGLINE STYLING --- */
        .logo-group { display: flex; align-items: center; font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem; }
        .logo-group .logo-icon { color: #1a73e8; margin-right: 8px; font-size: 1.8rem; }
        .logo-group .logo-text { color: #1a73e8; }
        .logo-group .contact-text { color: #111; margin-left: 5px; }
        .tagline strong { font-size: 1.2rem; display: block; margin-bottom: 5px; color: #111; }
        .tagline p { font-size: 0.9rem; color: #333; line-height: 1.5; margin-bottom: 25px !important; }

        /* --- INFO CONTAINER (IKON RAPI DAN BERJARAK) --- */
        .info-container {
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .info-card {
            background-color: #fff;
            border: 1px solid #ddd; 
            border-radius: 8px;
            padding: 10px; 
            height: 75px; 
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .info-card .icon-group {
            display: flex;
            align-items: center; 
        }

        .info-card .info-icon {
            font-size: 1.5rem; 
            color: #333;
            margin-right: 15px; 
            vertical-align: top;
        }
        
        .info-card .text-group {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding-top: 2px; 
            padding-bottom: 2px;
        }

        .info-card .label {
            font-size: 0.8rem;
            color: #555;
            margin: 0;
            padding: 0;
            font-weight: normal;
        }

        .info-card .value {
            font-weight: bold;
            font-size: 1rem;
            color: #111;
        }
        
        .address-item {
            font-size: 0.95rem;
            color: #333;
            text-align: center;
            font-weight: normal;
            margin-top: 15px; 
        }

        /* --- FORM STYLING --- */
        h3 { font-size: 1.25rem; font-weight: bold; margin-top: 10px; margin-bottom: 1.5rem; }
        .form-control { padding: 10px 12px; border-radius: 4px; background-color: #fff; height: 40px; border: 1px solid #ccc; }
        textarea.form-control { min-height: 150px; resize: none; }
        .form-label { display: none; } 
        
        /* Buttons */
        .btn-send { background-color: #e0f0ff; color: #1a73e8; border: 1px solid #1a73e8; font-weight: bold; padding: 8px 20px; border-radius: 4px; min-width: 80px; }
        .btn-clear { background-color: #f0f0f0; color: #333; border: 1px solid #ccc; font-weight: bold; padding: 8px 20px; border-radius: 4px; min-width: 80px; }
    </style>
</head>
<body>

    <div class="contact-form-container"> <div class="logo-group">
            <i class="fa-solid fa-graduation-cap logo-icon"></i> 
            <span class="logo-text">Coursia</span> 
            <span class="contact-text">Contact</span>
        </div>

        <div class="tagline">
            <strong style="font-size: 1.2rem;">Need help? Send a message to the Coursia team.</strong>
            <p class="m-0">We are ready to assist you with registration, curriculum, payment, and trial classes. An automatic reply will appear on this page as proof of sending.</p>
        </div>
        
        <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check-circle me-2"></i>
                <strong>Berhasil!</strong> <?php echo $successMessage; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-exclamation-circle me-2"></i>
                <strong>Error!</strong> <?php echo $errorMessage; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
        
        <div class="info-container">
            <div class="row gx-3"> 
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="info-card">
                        <div class="icon-group">
                            <i class="fa-solid fa-envelope info-icon"></i>
                            <div class="text-group">
                                <div class="label">Email:</div>
                                <div class="value">Halo@Coursia.id</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="info-card">
                        <div class="icon-group">
                            <i class="fa-solid fa-phone info-icon"></i>
                            <div class="text-group">
                                <div class="label">Phone Number:</div>
                                <div class="value">1234-5678-90</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
                <div class="address-item">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    <strong>Alamat:</strong> Jl. Pendidikan No. 123, Jakarta
                </div>
            </div>
        </div>

        <h3><i class="fa-solid fa-paper-plane me-2"></i>Send Message</h3>
        
        <form action="" method="POST" id="contactForm">
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="fullName" class="form-label">Full Name: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="fullName" name="fullName" 
                            placeholder="Enter your full name" required
                            value="<?php echo htmlspecialchars($fullName); ?>">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">Email: <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" 
                            placeholder="Enter your email" required
                            value="<?php echo htmlspecialchars($email); ?>">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone Number: <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control" id="phone" name="phone" 
                            placeholder="Enter your phone number" required
                            value="<?php echo htmlspecialchars($phone); ?>">
                </div>
                <div class="col-md-6">
                    <label for="topic" class="form-label">Topic: <span class="text-danger">*</span></label>
                    <select class="form-control" id="topic" name="topic" required>
                        <option value="">Select topic...</option>
                        <option value="Registration" <?php echo ($topic == 'Registration') ? 'selected' : ''; ?>>Registration</option>
                        <option value="Curriculum" <?php echo ($topic == 'Curriculum') ? 'selected' : ''; ?>>Curriculum</option>
                        <option value="Payment" <?php echo ($topic == 'Payment') ? 'selected' : ''; ?>>Payment</option>
                        <option value="Trial Class" <?php echo ($topic == 'Trial Class') ? 'selected' : ''; ?>>Trial Class</option>
                        <option value="General Inquiry" <?php echo ($topic == 'General Inquiry') ? 'selected' : ''; ?>>General Inquiry</option>
                        <option value="Other" <?php echo ($topic == 'Other') ? 'selected' : ''; ?>>Other</option>
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-12">
                    <label for="message" class="form-label">Message: <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="message" name="message" 
                                placeholder="Write your message here..." required><?php echo htmlspecialchars($message); ?></textarea>
                </div>
            </div>

            <div class="d-flex">
                <button type="submit" class="btn btn-send me-2">
                    <i class="fa-solid fa-paper-plane me-2"></i>Send Message
                </button>
                <button type="reset" class="btn btn-clear">
                    <i class="fa-solid fa-eraser me-2"></i>Clear Form
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
        
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            let phone = document.getElementById('phone').value;
            if (!/^\d+$/.test(phone.replace(/[\s\-\(\)]/g, ''))) {
                e.preventDefault();
                alert('Please enter a valid phone number (numbers only)');
                return false;
            }
        });
    </script>
</body>
</html>