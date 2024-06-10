<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require 'config/db.php';

$sql = "SELECT * FROM buku";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Buku</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Manajemen Buku</h2>
        <a href="tambah_buku.php" class="btn btn-primary">Tambah Buku</a>
        <a href="index.php" class="btn btn-danger">Kembali</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>ISBN</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id_buku']; ?></td>
                    <td><?php echo $row['judul']; ?></td>
                    <td><?php echo $row['penulis']; ?></td>
                    <td><?php echo $row['penerbit']; ?></td>
                    <td><?php echo $row['tahun']; ?></td>
                    <td><?php echo $row['isbn']; ?></td>
                    <td><?php echo $row['jumlah']; ?></td>
                    <td>
                        <a href="edit_buku.php?id=<?php echo $row['id_buku']; ?>" class="btn btn-warning">Edit</a>
                        <a href="hapus_buku.php?id=<?php echo $row['id_buku']; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
