<?php

include 'koneksi.php';

if (isset($_POST['simpan'])) {
    
    $nama_tugas = mysqli_real_escape_string($conn, $_POST['nama_tugas']);
    $kategori   = mysqli_real_escape_string($conn, $_POST['kategori']);
    $tanggal    = $_POST['tanggal'];
    $status     = 'belum'; 
    
    $query = "INSERT INTO tasks (nama_tugas, kategori, tanggal, status) 
              VALUES ('$nama_tugas', '$kategori', '$tanggal', '$status')";
              
    $simpan = mysqli_query($conn, $query);
    
    // Debugging & Redirect
    if ($simpan) {
        header("Location: index.php");
    } else {
        echo "Gagal menyimpan data: " . mysqli_error($conn);
    }
}
?>