<?php
include 'config.php';
$msg = '';
if (isset($_SESSION['admin'])) {
    header('Location: admin.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
    $p = $_POST['password'] ?? '';
    $q = "SELECT * FROM admin WHERE username='$u' AND password='$p' LIMIT 1";
    $r = mysqli_query($conn, $q);
    if ($r && mysqli_num_rows($r) > 0) {
        $row = mysqli_fetch_assoc($r);
        $_SESSION['admin'] = $row['username'];
        header('Location: admin.php');
        exit;
    }
    $msg = 'Login gagal, coba lagi';
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body style="background:#f1f1f1;">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center">Admin Login</h3>
                    <?php if ($msg) { echo '<div class="alert alert-danger">' . $msg . '</div>'; } ?>
                    <form method="post" action="login.php">
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $_POST['username'] ?? ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                    </form>
                    <p class="mt-3 text-muted">Gunakan admin/admin123</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
