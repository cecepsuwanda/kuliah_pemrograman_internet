<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('CV_APP_ROOT', dirname(__DIR__));
define('CV_DATA_FILE', CV_APP_ROOT . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'cv-data.json');

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/cv_repository.php';
require_once __DIR__ . '/auth.php';
