<?php
if (isset($_COOKIE['seller_id'])) {
    $seller_id = $_COOKIE['seller_id'];
} else {
    // Jika cookie tidak ada, arahkan ke halaman login
    header('Location: login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" type="text/css" href="../css/header.css?v=?php echo time();>">
    <!-- font awesome cdn link -->
     <link rel="stylesheet" href="https:cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
<div class="sidebar">
    

    <!--- dashboard -->
    <div class="list-item">
    <a href="dashboard.php">
        <img src="../image/dashboard.png" alt="" class="icon"> 
        <span class="deskripsi">DASHBOARD</span>
    </a>
        </div>

    <!--- inputan -->
    <div class="list-item">
    <a href="surat_jalan.php">
        <img src="../image/file.png" alt="" class="icon"> 
        <span class="deskripsi">SURAT JALAN</span>
    </a>
        </div>

    <!--- stok opname -->
    <div class="list-item">
    <a href="list_product.php">
        <img src="../image/stok.png" alt="" class="icon"> 
        <span class="deskripsi">PRODUK</span>
    </a>
        </div>

    <!--- Laporan -->
    <div class="list-item">
    <a href="laporan.php">
        <img src="../image/laporan.png" alt="" class="icon"> 
        <span class="deskripsi">LAPORAN</span>
    </a>
        </div>

    <!--- keluar -->
    
    
                 

        </div>
</div>

<div class="main-content">
<nav class="navbar">
    <div class="logo">
    <img src="../image/logo.png" width="200" />
    </div>

    <div class="logo2">
        <img src="../image/user.png" width="40" alt="" class="admin"/>
        <span class="text"></span>
    </div>

</nav>
</div>
</div>