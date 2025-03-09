<?php
include '../component/connection.php';

if (isset($_POST['save'])) {
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
        // Simpan data surat jalan ke tabel `surat_jalan`
        $insert_suratjalan = $conn->prepare("INSERT INTO surat_jalan (customer, no_referensi, alamat, no_tlp, tanggal, pengirim, berat, kurir, no_resi, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_suratjalan->execute([$customer, $no_referensi, $alamat, $no_tlp, $tanggal, $pengirim, $berat, $kurir, $no_resi, $keterangan]);
        
        // Ambil ID surat jalan yang baru saja dimasukkan
        $surat_jalan_id = $conn->lastInsertId();

        // Iterasi data produk yang diinputkan
        if (!empty($_POST['sku_produk'])) {
            $sku_produk = $_POST['sku_produk'];
            $nama_produk = $_POST['nama_produk'];
            $qty = $_POST['qty'];
            $harga = $_POST['harga'];

            $insert_produk = $conn->prepare("INSERT INTO surat_jalan_produk (surat_jalan_id, sku_produk, nama_produk, qty, harga, total_harga) VALUES (?, ?, ?, ?, ?, ?)");

            for ($i = 0; $i < count($sku_produk); $i++) {
                $total_harga = intval($qty[$i]) * floatval($harga[$i]);
                $insert_produk->execute([$surat_jalan_id, $sku_produk[$i], $nama_produk[$i], $qty[$i], $harga[$i], $total_harga]);
            }
        }

        echo "<script>alert('Surat Jalan dan produk berhasil disimpan.');</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Gagal menambahkan Surat Jalan: {$e->getMessage()}');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Surat Jalan</title>
    <link rel="stylesheet" type="text/css" href="../css/add_suratjalan.css?v=?php echo time();>">
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Tambah baris produk
            document.querySelector('.add-product').addEventListener('click', () => {
                const tableBody = document.querySelector('.form-table tbody');
                const rowCount = tableBody.rows.length + 1;

                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${rowCount}</td>
                    <td><input type="text" name="sku_produk[]" required></td>
                    <td><input type="text" name="nama_produk[]" required></td>
                    <td><input type="number" name="qty[]" required></td>
                    <td><input type="number" name="harga[]" required></td>
                    <td><input type="number" name="total_harga[]" readonly></td>
                    <td><button type="button" class="hapus-btn">Hapus</button></td>
                `;
                tableBody.appendChild(newRow);

                // Hapus baris
                newRow.querySelector('.hapus-btn').addEventListener('click', () => {
                    tableBody.removeChild(newRow);
                });
            });

            // Hitung total harga setiap baris
            document.addEventListener('input', (event) => {
                if (event.target.name === 'qty[]' || event.target.name === 'harga[]') {
                    const row = event.target.closest('tr');
                    const qty = row.querySelector('input[name="qty[]"]').value;
                    const harga = row.querySelector('input[name="harga[]"]').value;
                    const totalField = row.querySelector('input[name="total_harga[]"]');
                    totalField.value = qty * harga || 0;
                }
            });
        });
    </script>
</head>
<body>
<div class="main-container">
<?php include '../component/header.php';?>
    </div>
    <div class="form-container">
        <h1>Masukkan Data Baru</h1>
        <form action="" method="post" class="suratjalan-form">
            <div class="form-group">
                <label>Customer:</label>
                <input type="text" name="customer" required>
                <label>Tanggal:</label>
                <input type="date" name="tanggal" required>
            </div>
            <div class="form-group">
                <label>No Referensi:</label>
                <input type="text" name="no_referensi" required>
                <label>Pengirim:</label>
                <input type="text" name="pengirim" required>
            </div>
            <div class="form-group">
                <label>Alamat:</label>
                <textarea name="alamat" required></textarea>
                <label>Berat (Kg):</label>
                <input type="number" step="0.1" name="berat" required>
            </div>
            <div class="form-group">
                <label>No Tlp:</label>
                <input type="text" name="no_tlp" required>
                <label>Kurir:</label>
                <input type="text" name="kurir" required>
            </div>
            <div class="form-group">
                <label>No Resi:</label>
                <input type="text" name="no_resi" required>
            </div>
            <div class="form-table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>SKU Produk</th>
                            <th>Nama Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Total Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><input type="text" name="sku_produk[]" required></td>
                            <td><input type="text" name="nama_produk[]" required></td>
                            <td><input type="number" name="qty[]" required></td>
                            <td><input type="number" name="harga[]" required></td>
                            <td><input type="number" name="total_harga[]" readonly></td>
                            <td><button type="button" class="hapus-btn">Hapus</button></td>
                        </tr>
                    </tbody>
                </table>
                <button type="button" class="add-product">Tambah Produk</button>
            </div>
            <div class="form-group">
                <label>Keterangan:</label>
                <textarea name="keterangan"></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" name="save">SAVE</button>
                <a href="surat_jalan.php" class="cencel">Cancel</button>
            </div>
        </form>
    </div>
</body>
</html>
