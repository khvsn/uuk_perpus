<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require 'config/db.php';

$id_peminjaman = $_GET['id'];

$sql = "DELETE FROM peminjaman WHERE id_peminjaman=$id_peminjaman";
if ($conn->query($sql) === TRUE) {
    header("Location: peminjaman.php");
} else {
    echo "Error: " . $conn->error;
}
?>
