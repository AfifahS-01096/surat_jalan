<?php
include '../component/connection.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data produk berdasarkan ID
    $query = $conn->prepare("SELECT * FROM `product` WHERE id = ?");
    $query->execute([$id]);
    $product = $query->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "<script>
                alert('Produk tidak ditemukan!');
                window.location.href = 'list_product.php';
              </script>";
        exit;
    }
} else {
    echo "<script>
            alert('ID produk tidak ditemukan!');
            window.location.href = 'list_product.php';
          </script>";
    exit;
}

// Proses update data produk
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);

    $price = $_POST['price'];
    $price = filter_var($price, FILTER_SANITIZE_STRING);

    $stock = $_POST['stock'];
    $stock = filter_var($stock, FILTER_SANITIZE_STRING);

    try {
        // Query untuk memperbarui data produk
        $update_product = $conn->prepare("UPDATE `product` SET name = ?, price = ?, stock = ? WHERE id = ?");
        $update_product->execute([$name, $price, $stock, $id]);

        echo "<script>
                alert('Produk berhasil diperbarui!');
                window.location.href = 'list_product.php';
              </script>";
    } catch (PDOException $e) {
        echo "<script>
                alert('Gagal memperbarui produk: " . $e->getMessage() . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" type="text/css" href="../css/add_product.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
<div class="main-container">
<?php include '../component/header.php'; ?>
</div>

<div class="form-container">
    <div class="heading">
        <h1>Edit Produk</h1>
    </div>

    <form action="" method="post" enctype="multipart/form-data" class="register">
        <div class="input-field">
            <p>Nama Produk <span>*</span></p>
            <input type="text" name="name" maxlength="100" placeholder="Nama produk" value="<?php echo $product['name']; ?>" required class="box">
        </div>
        <div class="input-field">
            <p>Harga Produk <span>*</span></p>
            <input type="number" name="price" maxlength="100" placeholder="Harga produk" value="<?php echo $product['price']; ?>" required class="box">
        </div>
        <div class="input-field">
            <p>SKU Produk <span>*</span></p>
            <input type="text" name="sku" maxlength="100" value="<?php echo $product['SKU']; ?>" disabled class="box">
        </div>
        <div class="input-field">
            <p>Stok Produk <span>*</span></p>
            <input type="number" name="stock" maxlength="100" min="0" max="99999" placeholder="Stok produk" value="<?php echo $product['stock']; ?>" required class="box">
        </div>

        <div class="flex-btn">
            <input type="submit" name="update" value="SIMPAN" class="btn">
            <a href="admin.php" class="btn">KEMBALI</a>
        </div>
    </form>
</div>

<!-- SweetAlert CDN link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<!-- Custom JS link -->
<script src="../js/admin_script.js"></script>

</body>
</html>
