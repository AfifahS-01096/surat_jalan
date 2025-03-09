<?php
include '../component/connection.php';

    //add product in database//
    if(isset($_POST['publish'])){
        $id = unique_id();
        $name = $_POST['name'];
        $name = filter_var($name , FILTER_SANITIZE_STRING);

        $price = $_POST['price'];
        $price = filter_var($price , FILTER_SANITIZE_STRING);

        $stock = $_POST['stock'];
        $stock = filter_var($stock , FILTER_SANITIZE_STRING);

        // Generate SKU unik
        $prefix = "SKU"; // Prefix untuk SKU, bisa disesuaikan
        $timestamp = time(); // Timestamp untuk memastikan keunikan
        $randomNumber = rand(100, 999); // Angka random tambahan

        // SKU format: SKU-TIMESTAMP-RANDOM_NUMBER
        $sku = $prefix . '-' . $timestamp . '-' . $randomNumber;
      
        try {
            // Query untuk menambahkan produk
            $insert_product = $conn->prepare("INSERT INTO `product` (id, SKU, name, price, stock) VALUES (?, ?, ?, ?, ?)");
            $insert_product->execute([$id, $sku, $name, $price, $stock]);
    
            // Pesan sukses
            $success_msg[] = 'Product inserted successfully!';
        } catch (PDOException $e) {
            // Tangani kesalahan
            $error_msg[] = 'Failed to insert product: ' . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/add_product.css?v=?php echo time();>">
    <!-- font awesome cdn link -->
     <link rel="stylesheet" href="https:cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
    <div class="main-container">
<?php include '../component/header.php';?>
    </div>
            
        <div class="form-container">
        <div class="heading">
            <h1>"ADD PRODUCT"</h1>
        </div>

            <form action="" method="post" enctype="multipart/form-data" class="register">
                <div class="input-field">
                    <p>product name <span>*</span></p>
                    <input type="text" name="name" maxlength="100" placeholder="add product name"
                    required class="box">
                </div>
                <div class="input-field">
                <p>product price <span>*</span></p>
                    <input type="number" name="price" maxlength="100" placeholder="add product price"
                    required class="box">
                </div>
                <div class="input-field">
                    <p>SKU product <span>*</span></p>
                    <input type="text" name="id" maxlength="100" placeholder="add product SKU"
                    required class="box">
                </div>
                <div class="input-field">
                <p>product stock <span>*</span></p>
                    <input type="number" name="stock" maxlength="100"  min="0" max="99999" placeholder="add product stock"
                    required class="box">
                </div>

                <div class="flex-btn">
                    <input type="submit" name="publish" value="SAVE" class="btn">
                    <a href="../admin/list_product.php" onclick="return confirm('yakin hapus?')">
                    <input type="submit" name="hapus" value="HAPUS" class="btn">
                </div>
            </form>
        </div>

    </div>



    <!-- sweetalert cdn link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <!-- custom js link -->
    <script src="../js/admin_script.js></script>

    <?php include '..components/index.php';?>
</body>
</html>