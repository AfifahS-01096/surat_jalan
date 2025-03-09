<?php
include '../component/connection.php';

// Pastikan ID tersedia di URL
if (isset($_GET['id'])) {
    // Ambil ID yang akan dihapus
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan ID
    $query = "DELETE FROM surat_jalan WHERE id = :id";
    $stmt = $conn->prepare($query);

    // Bind parameter ID
    $stmt->bindParam(':id', $id);

    // Eksekusi query
    if ($stmt->execute()) {
        // Redirect ke halaman utama setelah berhasil menghapus
        echo "<script>
                alert('Data Surat Jalan berhasil dihapus');
                window.location.href = 'surat_jalan.php'; 
              </script>";
    } else {
        // Jika gagal menghapus, tampilkan pesan error
        echo "<script>
                alert('Gagal menghapus data Surat Jalan');
                window.location.href = 'surat_jalan.php'; 
              </script>";
    }
} else {
    // Jika ID tidak tersedia, kembali ke halaman data surat jalan
    echo "<script>
            alert('ID tidak ditemukan');
            window.location.href = 'surat_jalan.php'; 
          </script>";
}
?>
