<?php
if (isset($_GET['no_pegawai'])) {
    // Koneksi ke database
    $conn = new mysqli('localhost', 'root', '', 'uas_web');

    // Periksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Ambil no_member dari URL
    $no_member = $_GET['no_pegawai'];

    // Query untuk menghapus data
    $sql = "DELETE FROM pegawai WHERE no_pegawai = '$no_member'";

    // Eksekusi query
    if ($conn->query($sql) === TRUE) {
        header("Location: dataj.php"); // Redirect ke halaman datam.php setelah berhasil menghapus
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Hapus Data Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 500px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #d32f2f;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Konfirmasi Hapus Data</h1>
        <p>Apakah Anda yakin ingin menghapus data pegawai dengan nomor Pegawai <?= htmlspecialchars($no_pegawai) ?>?</p>
        <form action="" method="get">
            <input type="hidden" name="no_member" value="<?= htmlspecialchars($no_pegawai) ?>">
            <button type="submit" class="btn">Hapus Data</button>
        </form>
        <a href="datap.php">Kembali ke Data Member</a>
    </div>
</body>
</html>
