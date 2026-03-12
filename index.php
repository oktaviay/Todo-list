<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo-List App</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Todo-List App</h2>
        </div>
        
        <div class="row align-items-start">    
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4">
                        <h5 class="card-title fw-bold mb-4">Tambah Tugas Baru</h5>
                        
                        <form action="tambah.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label text-secondary fw-semibold">Nama Tugas</label>
                                <input type="text" name="nama_tugas" class="form-control bg-light border-0" required placeholder="Contoh: Belajar Laravel">
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label text-secondary fw-semibold">Kategori</label>
                                <select name="kategori" class="form-select bg-light border-0" required>
                                    <option value="">Pilih Kategori...</option>
                                    <option value="Belajar">Belajar</option>
                                    <option value="Hobi">Hobi</option>
                                    <option value="Tugas">Tugas</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label text-secondary fw-semibold">Tenggat Waktu</label>
                                <input type="date" name="tanggal" class="form-control bg-light border-0" required min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            
                            <button type="submit" name="simpan" class="btn btn-primary w-100 fw-bold py-2 rounded-3">Simpan Tugas</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <h5 class="card-title fw-bold mb-4">Daftar Tugas</h5>
            
            <?php
            $query = mysqli_query($conn, "SELECT * FROM tasks ORDER BY status ASC, tanggal ASC");
            
            if(mysqli_num_rows($query) == 0){
                echo "<div class='alert alert-info'>Belum ada tugas. Silakan tambah tugas baru.</div>";
            }

            while($data = mysqli_fetch_array($query)) {
                
                if($data['status'] == 'belum') {
                    // Tampilan jika belum selesai
                    $border_color = 'border-warning';
                    $bg_color = 'bg-white';
                    $text_style = 'text-dark';
                    $opacity = '1';
                } else {
                    // Tampilan jika sudah selesai
                    $border_color = 'border-success';
                    $bg_color = 'bg-light';
                    $text_style = 'text-secondary text-decoration-line-through';
                    $opacity = '0.7';
                }
            ?>
            
            <div class="task-card p-3 mb-3 <?php echo $bg_color; ?> rounded-3 shadow-sm border-start <?php echo $border_color; ?> border-4" style="opacity: <?php echo $opacity; ?>;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1 fw-bold <?php echo $text_style; ?>">
                            <?php echo htmlspecialchars($data['nama_tugas']); ?>
                        </h6>
                        <small class="text-muted">
                            <span class="badge bg-secondary me-2"><?php echo htmlspecialchars($data['kategori']); ?></span> 
                            📅 <?php echo date('d M Y', strtotime($data['tanggal'])); ?>
                        </small>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <?php if($data['status'] == 'belum') { ?>
                            <a href="update.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-outline-success fw-bold">Selesai</a>
                        <?php } else { ?>
                            <span class="badge bg-success d-flex align-items-center px-3">Tuntas</span>
                        <?php } ?>
                        
                        <a href="hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-sm btn-outline-danger fw-bold" onclick="return confirm('Yakin ingin menghapus tugas ini?');">Hapus</a>
                    </div>
                </div>
            </div>
            <?php }  ?>
          </div>
        </div>
    </div>
</div>

</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>