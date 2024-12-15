<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Konfigurasi database
    $conn = new mysqli('localhost', 'root', '', 'uas_web');

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Tangkap data dari form
    $no_member = $_POST['no_pegawai'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $phone = $_POST['phone'];
    $alamat = $_POST['alamat'];

    // Masukkan data ke database
    $sql = "INSERT INTO pegawai (no_pegawai, nama_pegawai, phone, alamat) VALUES ('$no_member', '$nama_pegawai', '$phone', '$alamat')";
    if ($conn->query($sql) === TRUE) {
        header("Location: dataj.php"); // Redirect ke halaman data.php setelah berhasil menyimpan
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
    <title>Tambah Data Pegawai</title>
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
            let noPegawai = document.getElementById("no_pegawai").value;
            let namaPegawai = document.getElementById("nama_pegawai").value;
            let phone = document.getElementById("phone").value;
            let alamat = document.getElementById("alamat").value;

            // Periksa jika ada kolom yang kosong
            if (noPegawai == "" || namaPegawai == "" ||  phone == "" || alamat == "") {
                alert("Semua kolom harus diisi!");
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
        <h1>Tambah Data Pegawai</h1>
        <form method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="no_pegawai">Nomor Pegawai:</label>
                <input type="text" name="no_pegawai" id="no_pegawai" required>
            </div>

            <div class="form-group">
                <label for="nama_pegawai">Nama:</label>
                <input type="text" name="nama_pegawai" id="nama_pegawai" required>
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
        <a href="dataj.php">Kembali</a>
    </div>
</body>
</html>
