<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Konfigurasi database
    $conn = new mysqli('localhost', 'root', '', 'uas_web');

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Tangkap data dari form
    $no_member = $_POST['no_member'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];

    // Masukkan data ke database
    $sql = "INSERT INTO members (no_member, nama, email, phone, alamat) VALUES ('$no_member', '$nama', '$email', '$phone', '$alamat')";
    if ($conn->query($sql) === TRUE) {
        header("Location: datam.php"); // Redirect ke halaman data.php setelah berhasil menyimpan
        exit();
    } else {
        // Tampilkan alert jika ada error
        echo "<script>alert('Terjadi kesalahan saat memasukkan data. Silakan coba lagi!');</script>";
    }

    // Tutup koneksi
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Member</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF0D1;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color : #7e572b;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input, .form-group textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        form button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        form button:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #007BFF;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
    <script>
        // Fungsi validasi form
        function validateForm() {
            let noMember = document.getElementById("no_member").value;
            let nama = document.getElementById("nama").value;
            let email = document.getElementById("email").value;
            let phone = document.getElementById("phone").value;
            let alamat = document.getElementById("alamat").value;

            // Periksa jika ada kolom yang kosong
            if (noMember == "" || nama == "" || email == "" || phone == "" || alamat == "") {
                alert("Semua kolom harus diisi!");
                return false;
            }

            // Validasi format email
            let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!emailPattern.test(email)) {
                alert("Format email tidak valid!");
                return false;
            }

            // Validasi nomor telepon (hanya angka)
            let phonePattern = /^[0-9]+$/;
            if (!phonePattern.test(phone)) {
                alert("Nomor telepon hanya boleh berisi angka!");
                return false;
            }

            return true; // Form valid
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h1>Tambah Data Member</h1>
        <form method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="no_member">Nomor Member:</label>
                <input type="text" name="no_member" id="no_member" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" id="nama" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Telepon:</label>
                <input type="text" name="phone" id="phone" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea name="alamat" id="alamat" rows="3" required></textarea>
            </div>

            <button type="submit">Simpan</button>
        </form>
        <a href="datam.php">Kembali</a>
    </div>
</body>
</html>
