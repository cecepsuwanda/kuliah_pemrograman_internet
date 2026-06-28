<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';

if (isLoggedIn()) {
    redirect('index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = postString('username');
    $password = postString('password');

    if ($username === '' || $password === '') {
        $error = 'Username dan password wajib diisi.';
    } elseif (attemptLogin($username, $password)) {
        redirect('index.php');
    } else {
        $error = 'Username atau password salah.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin CV</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <span class="h4 mb-0">Admin CV</span>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Masuk untuk mengelola data CV</p>
            <?php if ($error !== ''): ?>
            <div class="alert alert-danger py-2"><?= h($error) ?></div>
            <?php endif; ?>
            <form method="post" action="login.php">
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required autocomplete="username" value="<?= h(postString('username')) ?>">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="current-password">
                    <div class="input-group-append">
                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
