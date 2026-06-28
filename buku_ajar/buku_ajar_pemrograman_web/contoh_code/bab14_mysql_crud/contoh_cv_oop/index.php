<?php

declare(strict_types=1);

require_once __DIR__ . '/includes/bootstrap.php';

if (!cv_is_installed()) {
    header('Location: /install.php');
    exit;
}

cv_boot_app();

\App\Core\Router::dispatch('/index.php');
