<?php
include '../component/connection.php'; // Memuat koneksi ke database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Surat Jalan</title>
    <link rel="stylesheet" type="text/css" href="../css/laporan.css?v=?php echo time();>">
</head>
<body>
<div class="main-container">
    <?php include '../component/header.php'; // Menyertakan header ?>

    <div class="form-container">
        <h2>CETAK LAPORAN SURAT JALAN</h2>
        <form action="process.php" method="POST">
            <div class="form-group">
                <label for="periode_awal">Periode Awal:</label>
                <input type="date" id="periode_awal" name="periode_awal">
            </div>
            <div class="form-group">
                <label for="periode_akhir">Periode Akhir:</label>
                <input type="date" id="periode_akhir" name="periode_akhir">
            </div>
            <div class="button-group">
            <button type="submit" class="btn">Cetak</button>
                <button type="reset" class="btn">Reset</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
