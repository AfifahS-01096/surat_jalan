<?php
include '../component/connection.php';

// Mengecek apakah ID tersedia di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data surat jalan berdasarkan ID
    try {
        $query = $conn->prepare("SELECT * FROM surat_jalan WHERE id = ?");
        $query->execute([$id]);
        $data = $query->fetch(PDO::FETCH_ASSOC);

        // Jika data tidak ditemukan
        if (!$data) {
            echo "<script>
                    alert('Data tidak ditemukan!');
                    window.location.href = 'surat_jalan.php';
                  </script>";
            exit;
        }
    } catch (PDOException $e) {
        echo "<script>
                alert('Terjadi kesalahan: {$e->getMessage()}');
                window.location.href = 'surat_jalan.php';
              </script>";
        exit;
    }
} else {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href = 'surat_jalan.php';
          </script>";
    exit;
}

// Memproses pembaruan data saat form disubmit
if (isset($_POST['update'])) {
    $customer = filter_var($_POST['customer'], FILTER_SANITIZE_STRING);
    $no_referensi = filter_var($_POST['no_referensi'], FILTER_SANITIZE_STRING);
    $alamat = filter_var($_POST['alamat'], FILTER_SANITIZE_STRING);
    $no_tlp = filter_var($_POST['no_tlp'], FILTER_SANITIZE_STRING);
    $tanggal = filter_var($_POST['tanggal'], FILTER_SANITIZE_STRING);
    $pengirim = filter_var($_POST['pengirim'], FILTER_SANITIZE_STRING);
    $berat = filter_var($_POST['berat'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $kurir = filter_var($_POST['kurir'], FILTER_SANITIZE_STRING);
    $no_resi = filter_var($_POST['no_resi'], FILTER_SANITIZE_STRING);
    $keterangan = filter_var($_POST['keterangan'], FILTER_SANITIZE_STRING);

    try {
        // Query untuk memperbarui data surat jalan
        $updateQuery = $conn->prepare("UPDATE surat_jalan SET 
            customer = ?, 
            no_referensi = ?, 
            alamat = ?, 
            no_tlp = ?, 
            tanggal = ?, 
            pengirim = ?, 
            berat = ?, 
            kurir = ?, 
            no_resi = ?, 
            keterangan = ? 
            WHERE id = ?");
        $updateQuery->execute([$customer, $no_referensi, $alamat, $no_tlp, $tanggal, $pengirim, $berat, $kurir, $no_resi, $keterangan, $id]);

        echo "<script>
                alert('Data berhasil diperbarui!');
                window.location.href = 'surat_jalan.php';
              </script>";
    } catch (PDOException $e) {
        echo "<script>
                alert('Gagal memperbarui data: {$e->getMessage()}');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Surat Jalan</title>
    <link rel="stylesheet" type="text/css" href="../css/edit_suratjalan.css?v=?php echo time();>">
</head>
<body>
<div class="main-container">
    <?php include '../component/header.php'; ?>
    <div class="form-container">
        <h1>Update Data Surat Jalan</h1>
        <form action="" method="post" class="suratjalan-form">
            <div class="form-group">
                <label>Customer:</label>
                <input type="text" name="customer" value="<?php echo htmlspecialchars($data['customer']); ?>" required>
                <label>Tanggal:</label>
                <input type="date" name="tanggal" value="<?php echo htmlspecialchars($data['tanggal']); ?>" required>
            </div>
            <div class="form-group">
                <label>No Referensi:</label>
                <input type="text" name="no_referensi" value="<?php echo htmlspecialchars($data['no_referensi']); ?>" required>
                <label>Pengirim:</label>
                <input type="text" name="pengirim" value="<?php echo htmlspecialchars($data['pengirim']); ?>" required>
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <textarea name="alamat" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
                <label>Berat (Kg):</label>
                <input type="number" step="0.1" name="berat" value="<?php echo htmlspecialchars($data['berat']); ?>" required>
            </div>
            <div class="form-group">
                <label>No Tlp:</label>
                <input type="text" name="no_tlp" value="<?php echo htmlspecialchars($data['no_tlp']); ?>" required>
                <label>Kurir:</label>
                <input type="text" name="kurir" value="<?php echo htmlspecialchars($data['kurir']); ?>" required>
            </div>
            <div class="form-group">
                <label>No Resi:</label>
                <input type="text" name="no_resi" value="<?php echo htmlspecialchars($data['no_resi']); ?>" required>
            </div>
            <div class="form-group">
                <label>Keterangan:</label>
                <textarea name="keterangan"><?php echo htmlspecialchars($data['keterangan']); ?></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" name="update">Update</button>
                <a href="surat_jalan.php" class="cencel">Cancel</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
