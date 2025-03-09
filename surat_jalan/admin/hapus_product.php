<?php
// Menghubungkan ke database
include '../component/connection.php';

// Periksa apakah parameter 'id' ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id']; // Ambil ID unik dari parameter GET

    try {
        // Siapkan query untuk menghapus data berdasarkan ID unik
        $query = $conn->prepare("DELETE FROM `product` WHERE id = :id");
        $query->bindParam(':id', $id, PDO::PARAM_STR); // Gunakan PDO::PARAM_STR karena unique_id biasanya string

        // Eksekusi query
        if ($query->execute()) {
            // Jika berhasil, kembali ke halaman admin dengan pesan sukses
            echo "<script>
                    alert('Produk berhasil dihapus!');
                    window.location.href = 'list_product.php';
                  </script>";
        } else {
            // Jika gagal, kembali ke halaman admin dengan pesan error
            echo "<script>
                    alert('Gagal menghapus produk!');
                    window.location.href = 'list_product.php';
                  </script>";
        }
    } catch (PDOException $e) {
        // Tampilkan pesan error jika terjadi masalah
        echo "Error: " . $e->getMessage();
    }
} else {
    // Jika parameter 'id' tidak ada, kembali ke halaman admin
    echo "<script>
            alert('ID produk tidak ditemukan!');
            window.location.href = 'list_product.php';
          </script>";
}
?>
