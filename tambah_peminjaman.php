<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_buku = $_POST['id_buku'];
    $id_pengguna = $_POST['id_pengguna'];
    $tanggal_pinjam = date('Y-m-d');
    $status = 'dipinjam';

    $sql = "INSERT INTO peminjaman (id_buku, id_pengguna, tanggal_pinjam, status) VALUES ('$id_buku', '$id_pengguna', '$tanggal_pinjam', '$status')";
    if ($conn->query($sql) === TRUE) {
        header("Location: peminjaman.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_buku = "SELECT * FROM buku";
$result_buku = $conn->query($sql_buku);

$sql_pengguna = "SELECT * FROM pengguna WHERE role = 'siswa'";
$result_pengguna = $conn->query($sql_pengguna);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Peminjaman</h2>
        <form method="post">
            <div class="mb-3">
                <label for="id_buku" class="form-label">Judul Buku</label>
                <select class="form-control" id="id_buku" name="id_buku" required>
                    <?php while($row = $result_buku->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id_buku']; ?>"><?php echo $row['judul']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="id_pengguna" class="form-label">Username Siswa</label>
                <select class="form-control" id="id_pengguna" name="id_pengguna" required>
                    <?php while($row = $result_pengguna->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id_pengguna']; ?>"><?php echo $row['username']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Peminjaman</button>
            <a href="buku.php" class="btn btn-danger">Kembali</a>
        </form>
    </div>
</body>
</html>
