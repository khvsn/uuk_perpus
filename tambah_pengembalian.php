<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_peminjaman = $_POST['id_peminjaman'];
    $tanggal_pengembalian = $_POST['tanggal_pengembalian'];
    $denda = $_POST['denda'];

    $sql = "INSERT INTO pengembalian (id_peminjaman, tanggal_pengembalian, denda) VALUES ('$id_peminjaman', '$tanggal_pengembalian', '$denda')";
    if ($conn->query($sql) === TRUE) {
        $updateStatus = "UPDATE peminjaman SET status='dikembalikan' WHERE id_peminjaman=$id_peminjaman";
        $conn->query($updateStatus);
        header("Location: pengembalian.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql_peminjaman = "SELECT peminjaman.*, buku.judul, pengguna.username FROM peminjaman 
                   JOIN buku ON peminjaman.id_buku = buku.id_buku 
                   JOIN pengguna ON peminjaman.id_pengguna = pengguna.id_pengguna
                   WHERE peminjaman.status='dipinjam'";
$result_peminjaman = $conn->query($sql_peminjaman);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengembalian</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Pengembalian</h2>
        <form method="post">
            <div class="mb-3">
                <label for="id_peminjaman" class="form-label">ID Peminjaman</label>
                <select class="form-control" id="id_peminjaman" name="id_peminjaman" required>
                    <?php while($row = $result_peminjaman->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id_peminjaman']; ?>"><?php echo $row['id_peminjaman'] . " - " . $row['judul'] . " - " . $row['username']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
            </div>
            <div class="mb-3">
                <label for="denda" class="form-label">Denda</label>
                <input type="number" class="form-control" id="denda" name="denda">
            </div>
            <button type="submit" class="btn btn-primary">Tambah Pengembalian</button>
        </form>
    </div>
</body>
</html>
