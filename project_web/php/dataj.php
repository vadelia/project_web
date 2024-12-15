<?php
// Koneksi ke database
$conn = new mysqli('localhost', 'root', '', 'uas_web');

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil semua data member
$sql = "SELECT * FROM pegawai";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pegawai</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF0D1;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        h1 {
            margin-bottom: 20px;
            color: #654520;
        }

        .table-container {
            width: 90%;
            max-width: 800px;
            margin: 20px 0;
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            position: relative;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            text-align: left;
            padding: 15px;
        }

        th {
            background-color: #654520;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 12px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }

        .btn-edit {
            background-color: #4CAF50;
            color: white;
        }

        .btn-edit:hover {
            background-color: #45a049;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
        }

        .btn-delete:hover {
            background-color: #d32f2f;
        }

        .btn-add {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0A3981;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            margin-top: 10px;
        }

        .btn-add:hover {
            background-color: #0056b3;
        }
        /* Tambahkan class untuk tombol keluar */
        .btn-add:hover {
            background-color: #0056b3;
        }

        /* Tombol keluar dengan warna merah */
        .btn-add[style*="background-color: #d32f2f"] {
            background-color: #d32f2f;
        }

        .btn-add[style*="background-color: #d32f2f"]:hover {
            background-color: #c62828;
        }

    </style>
</head>
<body>
    <h1>Data Pegawai</h1>
    <div class="table-container">
        <table>
            <tr>
                <th>No Pegawai</th>
                <th>Nama</th>
                <th>Phone</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['no_pegawai'] ?></td>
                        <td><?= $row['nama_pegawai'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td>
                            <div class="action-buttons">
                                <form style="display: inline;" action="edit.php" method="get">
                                    <input type="hidden" name="no_pegawai" value="<?= $row['no_pegawai'] ?>">
                                    <button type="submit" class="btn btn-edit">Edit</button>
                                </form>
                                <form style="display: inline;" action="deletep.php" method="get" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    <input type="hidden" name="no_pegawai" value="<?= $row['no_pegawai'] ?>">
                                    <button type="submit" class="btn btn-delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada data.</td>
                </tr>
            <?php endif; ?>
        </table>
        <a href="addp.php" class="btn-add">Tambah Data</a>
        <!-- Tombol Keluar -->
        <a href="logout.php" class="btn-add" style="background-color: #d32f2f; text-align: center;">Keluar</a>
    </div>
</body>
</html>
<?php $conn->close(); ?>
