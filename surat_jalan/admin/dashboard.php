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
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css?v=?php echo time();>">
    <!-- font awesome cdn link -->
     <link rel="stylesheet" href="https:cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>
<?php include '../component/header.php';?>
    