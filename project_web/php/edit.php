<?php
$conn = new mysqli('localhost', 'root', '', 'uas_web');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Jika ada data yang diambil untuk pengeditan
if (isset($_GET['no_member'])) {
    $no_member = $conn->real_escape_string($_GET['no_member']);
    $result = $conn->query("SELECT * FROM members WHERE no_member = '$no_member'");
    if ($result) {
        $data = $result->fetch_assoc();
    } else {
        die("Data tidak ditemukan.");
    }
}

// Proses pembaruan data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $old_no_member = $conn->real_escape_string($_POST['old_no_member']);
    $no_member = $conn->real_escape_string($_POST['no_member']);
    $nama = $conn->real_escape_string($_POST['nama']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $alamat = $conn->real_escape_string($_POST['alamat']);

    $sql = "UPDATE members 
            SET no_member = '$no_member', nama = '$nama', email = '$email', phone = '$phone', alamat = '$alamat' 
            WHERE no_member = '$old_no_member'";

    if ($conn->query($sql) === TRUE) {
        header("Location: datam.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Member</title>
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

        .container {
            background-color: #fff;
            padding: 20px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #654520;
        }

        label {
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
            color: #555;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #0A3981;
            font-weight: bold;
            text-align: center;
        }

        a:hover {
            color: #1F509A;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Data Member</h1>
        <form method="POST">
            <input type="hidden" name="old_no_member" value="<?= htmlspecialchars($data['no_member']) ?>">
            <label>No Member:</label>
            <input type="text" name="no_member" value="<?= htmlspecialchars($data['no_member']) ?>" required>

            <label>Nama:</label>
            <input type="text" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>

            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>

            <label>Phone:</label>
            <input type="text" name="phone" value="<?= htmlspecialchars($data['phone']) ?>" required>

            <label>Alamat:</label>
            <input type="text" name="alamat" value="<?= htmlspecialchars($data['alamat']) ?>" required>

            <button type="submit">Simpan</button>
        </form>
        <a href="data.php">Kembali ke Daftar</a>
    </div>
</body>
</html>
