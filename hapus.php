<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "DELETE FROM tasks WHERE id = '$id'";
    $hapus = mysqli_query($conn, $query);
    
    if ($hapus) {
        header("Location: index.php");
    } else {
        echo "Gagal menghapus data.";
    }
}
?>