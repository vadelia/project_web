<?php
// Konfigurasi database
$host = 'localhost';
$dbname = 'uas_web'; // Nama database Anda
$user = 'root';        // Username database Anda
$pass = '';            // Password database Anda

// Koneksi ke database
$conn = new mysqli($host, $user, $pass, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Tangkap data dari form
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

// Validasi input kosong
if (empty($username) || empty($password)) { 
    header("Location: login_page.html?error=Username atau password tidak boleh kosong");
    exit();
}

// Periksa data di database
$sql = "SELECT * FROM login_page WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

// Validasi login
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    // Periksa password tanpa hash
    if ($password === $user['password']) { 
        // Login berhasil
        session_start(); // Mulai sesi untuk menjaga login
        $_SESSION['username'] = $user['username']; // Simpan data sesi pengguna
        header("Location: ../dashboard.html");
        exit();
    } else {
        // Password salah
        header("Location: login_page.html?error=Password salah");
        exit();
    }
} else {
    // Username tidak ditemukan
    header("Location: login_page.html?error=Username tidak ditemukan");
    exit();
}

// Tutup koneksi
$stmt->close();
$conn->close();
?>
