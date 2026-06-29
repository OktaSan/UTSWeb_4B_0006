<?php
include 'config.php';
requireAdmin();
$action = $_GET['action'] ?? '';
if ($action == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
    header('Location: products.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $t = $_POST['title'];
        $d = $_POST['description'];
        $i = $_POST['image'];
        $p = $_POST['price'];
        mysqli_query($conn, "INSERT INTO products (title, description, image, price) VALUES ('$t', '$d', '$i', $p)");
        header('Location: products.php');
        exit;
    }
    if (isset($_POST['update']) && isset($_POST['id'])) {
        $id = $_POST['id'];
        $t = $_POST['title'];
        $d = $_POST['description'];
        $i = $_POST['image'];
        $p = $_POST['price'];
        mysqli_query($conn, "UPDATE products SET title='$t', description='$d', image='$i', price=$p WHERE id=$id");
        header('Location: products.php');
        exit;
    }
}
$product = null;
if ($action == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $res = mysqli_query($conn, "SELECT * FROM products WHERE id=$id LIMIT 1");
    $product = mysqli_fetch_assoc($res);
}
$list = mysqli_query($conn, 'SELECT * FROM products ORDER BY id DESC');
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Kelola Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body style="background:#fafafa;">
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>CRUD Produk</h2>
        <a href="admin.php" class="btn btn-secondary">Kembali</a>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h5><?php echo $product ? 'Edit Produk' : 'Tambah Produk'; ?></h5>
                    <form method="post" action="products.php">
                        <?php if ($product) { echo '<input type="hidden" name="id" value="'.$product['id'].'">'; } ?>
                        <div class="mb-3">
                            <label>Judul</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $product['title'] ?? ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <textarea name="description" class="form-control"><?php echo $product['description'] ?? ''; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label>URL gambar</label>
                            <input type="text" name="image" class="form-control" value="<?php echo $product['image'] ?? ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label>Harga</label>
                            <input type="number" name="price" class="form-control" value="<?php echo $product['price'] ?? ''; ?>">
                        </div>
                        <?php if ($product) { ?>
                            <button type="submit" name="update" class="btn btn-warning">Simpan Perubahan</button>
                        <?php } else { ?>
                            <button type="submit" name="add" class="btn btn-primary">Tambah</button>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5>Daftar Produk</h5>
                    <table class="table table-sm">
                        <thead><tr><th>ID</th><th>Judul</th><th>Aksi</th></tr></thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_assoc($list)) { ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td>
                                    <a href="products.php?action=edit&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                                    <a href="products.php?action=delete&id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus?')">Hapus</a>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
