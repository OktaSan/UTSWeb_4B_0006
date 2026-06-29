<?php
include 'config.php';
requireAdmin();
$countQ = mysqli_query($conn, 'SELECT COUNT(*) as total FROM products');
$countRow = mysqli_fetch_assoc($countQ);
$total = $countRow['total'] ?? 0;
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body style="background:#eee;">
<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1>Welcome <?php echo $_SESSION['admin']; ?></h1>
            <p>Jumlah produk: <?php echo $total; ?></p>
            <div class="list-group">
                <a class="list-group-item list-group-item-action" href="products.php">Kelola Produk</a>
                <a class="list-group-item list-group-item-action" href="logout.php">Logout</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
