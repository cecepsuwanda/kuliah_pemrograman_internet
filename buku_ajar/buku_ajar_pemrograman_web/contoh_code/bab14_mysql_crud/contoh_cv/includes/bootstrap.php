<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('CV_APP_ROOT', dirname(__DIR__));

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/auth.php';

function cv_require_installed(): void
{
    require_once dirname(__DIR__) . '/config.php';
    if (!cv_is_installed()) {
        header('Location: install.php');
        exit;
    }
}

function cv_boot_app(): void
{
    cv_require_installed();
    require_once __DIR__ . '/database.php';
    require_once __DIR__ . '/cv_repository.php';
}
