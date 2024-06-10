<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require 'config/db.php';

$id_buku = $_GET['id'];

$sql = "DELETE FROM buku WHERE id_buku=$id_buku";
if ($conn->query($sql) === TRUE) {
    header("Location: buku.php");
} else {
    echo "Error: " . $conn->error;
}
?>