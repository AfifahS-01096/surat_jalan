<?php
include '../component/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/suratjalan.css?v=?php echo time();>">
    <!-- font awesome cdn link -->
     <link rel="stylesheet" href="https:cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
<div class="main-container">
<?php include '../component/header.php';?>

    <h2 class="judul"> Data Surat Jalan</h2>

        <div class="isi-suratjalan">
        
        <div class="search-box">

            <input type="text" id="searchInput" placeholder="Cari...">
            <button onclick="searchTable()">Cari</button>
        </div>

        <div class="flex-btn">
                    <a href="add_suratjalan.php">
                    <input type="submit" name="add" value="Tambah produk" class="produk">
                    </a>
        </div>

        <table class="tabel">
        <tr>
            <th>No</th>
            <th>customer</th>
            <th>no referensi</th>
            <th>tanggal</th>
            <th>kurir</th>
            <th>no resi</th>
            <th>aksi</th>   
        </tr>
        <tbody>
        <?php
        // Ambil data dari tabel produk
            $ambil_data = $conn->query("SELECT * FROM surat_jalan");
            $no = 1;

            while ($row = $ambil_data->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row['customer'] . "</td>";
                echo "<td>" . $row['no_referensi'] . "</td>";
                echo "<td>" . $row['tanggal'] . "</td>";
                echo "<td>" . $row['kurir'] . "</td>";
                echo "<td>" . $row['no_resi'] . "</td>";
                echo "<td>
                        <!-- Edit Button -->
                    <form action='edit_suratjalan.php' method='get' style='display:inline;'>
                    <input type='hidden' name='id' value='" . $row['id'] . "' />
                    <button type='submit' class='btn btn-primary'>Edit</button>
                    </form>
                    
                    <!-- Hapus Button -->
                    <form action='hapus_suratjalan.php' method='get' style='display:inline;'>
                    <input type='hidden' name='id' value='" . $row['id'] . "' />
                    <button type='submit' class='btn btn-danger' onclick='return confirm(\"Are you sure you want to delete?\");'>Hapus</button>
                    </form>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
        </table>
        </div>
</div>
</body>
</html>
