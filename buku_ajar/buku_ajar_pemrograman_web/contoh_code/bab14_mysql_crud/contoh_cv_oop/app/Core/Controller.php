<?php

declare(strict_types=1);

namespace App\Core;

use App\Support\Flash;
use App\Support\Url;

abstract class Controller
{
    protected function redirect(string $url): never
    {
        header('Location: ' . $url);
        exit;
    }

    protected function redirectAdmin(string $script): never
    {
        $this->redirect(Url::admin($script));
    }

    protected function render(string $view, array $data = []): void
    {
        View::render($view, $data);
    }

    protected function flash(string $type, string $message): void
    {
        Flash::set($type, $message);
    }
}
