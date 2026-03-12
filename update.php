<?php

include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query update status
    $query = "UPDATE tasks SET status = 'selesai' WHERE id = '$id'";
    $update = mysqli_query($conn, $query);
    
    if ($update) {
        header("Location: index.php");
    } else {
        echo "Gagal mengupdate status.";
    }
}
?>