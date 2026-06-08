<?php

declare(strict_types=1);

function adminLayoutStart(string $title, string $active = ''): void
{
    $flash = getFlash();
    ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($title) ?> — Admin CV</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../index.php" target="_blank"><i class="fas fa-external-link-alt mr-1"></i> Lihat CV</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt mr-1"></i> Logout</a>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="index.php" class="brand-link">
            <span class="brand-text font-weight-light">Admin CV</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column">
                    <?php
                    $links = [
                        'index' => ['index.php', 'Dashboard', 'fa-tachometer-alt'],
                        'profil' => ['profil.php', 'Profil & Meta', 'fa-user'],
                        'ringkasan' => ['ringkasan.php', 'Ringkasan', 'fa-align-left'],
                        'keterampilan' => ['keterampilan.php', 'Keterampilan', 'fa-tools'],
                        'pengalaman' => ['pengalaman.php', 'Pengalaman', 'fa-briefcase'],
                        'pendidikan' => ['pendidikan.php', 'Pendidikan', 'fa-graduation-cap'],
                        'portofolio' => ['portofolio.php', 'Portofolio', 'fa-folder-open'],
                        'sertifikasi' => ['sertifikasi.php', 'Sertifikasi', 'fa-certificate'],
                        'organisasi' => ['organisasi.php', 'Organisasi', 'fa-users'],
                        'kontak' => ['kontak.php', 'Kontak', 'fa-envelope'],
                    ];
                    foreach ($links as $key => [$href, $label, $icon]):
                    ?>
                    <li class="nav-item">
                        <a href="<?= h($href) ?>" class="nav-link <?= $active === $key ? 'active' : '' ?>">
                            <i class="nav-icon fas <?= h($icon) ?>"></i>
                            <p><?= h($label) ?></p>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <h1 class="m-0"><?= h($title) ?></h1>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <?php if ($flash): ?>
                <div class="alert alert-<?= h($flash['type']) ?> alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <?= h($flash['message']) ?>
                </div>
                <?php endif; ?>
    <?php
}

function adminLayoutEnd(): void
{
    ?>
            </div>
        </section>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
    <?php
}
