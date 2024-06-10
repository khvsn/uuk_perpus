<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require 'config/db.php';

$id_buku = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $penulis = $_POST['penulis'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $isbn = $_POST['isbn'];
    $jumlah = $_POST['jumlah'];

    $sql = "UPDATE buku SET judul='$judul', penulis='$penulis', penerbit='$penerbit', tahun='$tahun', isbn='$isbn', jumlah='$jumlah' WHERE id_buku=$id_buku";
    if ($conn->query($sql) === TRUE) {
        header("Location: buku.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $sql = "SELECT * FROM buku WHERE id_buku=$id_buku";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        header("Location: buku.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Edit Buku</h2>
        <form method="post">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $row['judul']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" value="<?php echo $row['penulis']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?php echo $row['penerbit']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="tahun" class="form-label">Tahun</label>
                <input type="number" class="form-control" id="tahun" name="tahun" value="<?php echo $row['tahun']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="isbn" class="form-label">ISBN</label>
                <input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo $row['isbn']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $row['jumlah']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
