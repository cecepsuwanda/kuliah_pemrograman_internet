<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/config.php';

function install_h(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
