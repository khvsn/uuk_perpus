<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require 'config/db.php';

$sql = "SELECT peminjaman.*, buku.judul, pengguna.username FROM peminjaman 
        JOIN buku ON peminjaman.id_buku = buku.id_buku 
        JOIN pengguna ON peminjaman.id_pengguna = pengguna.id_pengguna";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Peminjaman</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Manajemen Peminjaman</h2>
        <a href="tambah_peminjaman.php" class="btn btn-primary">Tambah Peminjaman</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID Peminjaman</th>
                    <th>Judul Buku</th>
                    <th>Username</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id_peminjaman']; ?></td>
                    <td><?php echo $row['judul']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['tanggal_pinjam']; ?></td>
                    <td><?php echo $row['tanggal_kembali']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
