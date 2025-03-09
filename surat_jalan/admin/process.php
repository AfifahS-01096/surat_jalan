<?php
include '../component/connection.php'; // Memuat koneksi ke database

$data = []; // Inisialisasi array data

// Cek jika ada data POST yang dikirim dari form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $periode_awal = filter_var($_POST['periode_awal'], FILTER_SANITIZE_STRING);
    $periode_akhir = filter_var($_POST['periode_akhir'], FILTER_SANITIZE_STRING);

    // Jika periode awal dan akhir tidak kosong, ambil data dari database
    if (!empty($periode_awal) && !empty($periode_akhir)) {
        try {
            // Query untuk mengambil data berdasarkan periode
            $query = $conn->prepare("SELECT * FROM surat_jalan WHERE tanggal BETWEEN ? AND ?");
            $query->execute([$periode_awal, $periode_akhir]);
            $data = $query->fetchAll(PDO::FETCH_ASSOC);

            if (!$data) {
                echo "<script>alert('Tidak ada data pada periode ini!');</script>";
            }
        } catch (PDOException $e) {
            echo "<script>alert('Terjadi kesalahan: {$e->getMessage()}');</script>";
        }
    } else {
        echo "<script>alert('Periode awal dan akhir harus diisi!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Surat Jalan</title>
    <link rel="stylesheet" type="text/css" href="../css/process.css?v=?php echo time();>">
</head>

<?php if (!empty($data)): ?>
    <div class="report-container">
        <h3>Laporan Surat Jalan</h3>
        <h4>Periode : <?php echo htmlspecialchars($periode_awal); ?> Hingga : <?php echo htmlspecialchars($periode_akhir); ?></h4>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Customer</th>
                    <th>No Referensi</th>
                    <th>Tanggal</th>
                    <th>Pengirim</th>
                    <th>Kurir</th>
                    <th>No Resi</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($data as $row) {
                    echo "<tr>
                        <td>{$no}</td>
                        <td>" . htmlspecialchars($row['customer']) . "</td>
                        <td>" . htmlspecialchars($row['no_referensi']) . "</td>
                        <td>" . htmlspecialchars($row['tanggal']) . "</td>
                        <td>" . htmlspecialchars($row['pengirim']) . "</td>
                        <td>" . htmlspecialchars($row['kurir']) . "</td>
                        <td>" . htmlspecialchars($row['no_resi']) . "</td>
                        <td>" . htmlspecialchars($row['keterangan']) . "</td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <div class="print-button">
            <button onclick="window.print()">Cetak Laporan</button>
        </div>
    </div>
</div>
    <?php endif; ?>