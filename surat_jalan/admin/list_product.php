<?php
include '../component/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/product.css?v=?php echo time();>">
    <!-- font awesome cdn link -->
     <link rel="stylesheet" href="https:cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
<div class="main-container">
<?php include '../component/header.php';?>

    <h2 class="judul"> Data Produk</h2>

        <div class="isi-produk">
        
        <div class="search-box">

            <input type="text" id="searchInput" placeholder="Cari...">
            <button onclick="searchTable()">Cari</button>
        </div>

        <div class="flex-btn">
                    <a href="add_product.php">
                    <input type="submit" name="add" value="Tambah produk" class="produk">
                    </a>
        </div>

        <table class="tabel">
        <tr>
            <th>No</th>
            <th>SKU</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Stock</th>   
            <th>Aksi</th>
        </tr>
        <tbody>
        <?php
        // Ambil data dari tabel produk
            $ambil_data = $conn->query("SELECT * FROM product");
            $no = 1;

            while ($row = $ambil_data->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row['SKU'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>Rp " . number_format($row['price'], 0, ',', '.') . "</td>";
                echo "<td>" . $row['stock'] . "</td>";
                echo "<td>
                        <!-- Edit Button -->
                    <form action='edit_product.php' method='get' style='display:inline;'>
                    <input type='hidden' name='id' value='" . $row['id'] . "' />
                    <button type='submit' class='btn btn-primary'>Edit</button>
                    </form>
                    
                    <!-- Hapus Button -->
                    <form action='hapus_product.php' method='get' style='display:inline;'>
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
