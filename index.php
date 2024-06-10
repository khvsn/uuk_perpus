<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Selamat datang, <?php echo $_SESSION['username']; ?></h1>
        <a href="logout.php" class="btn btn-danger">Logout</a>
        <a href="buku.php" class="btn btn-primary">Manajemen Buku</a>
        <a href="peminjaman.php" class="btn btn-primary">Peminjaman Buku</a>
        <a href="pengembalian.php" class="btn btn-primary">Pengembalian Buku</a>
    </div>
</body>
</html>

