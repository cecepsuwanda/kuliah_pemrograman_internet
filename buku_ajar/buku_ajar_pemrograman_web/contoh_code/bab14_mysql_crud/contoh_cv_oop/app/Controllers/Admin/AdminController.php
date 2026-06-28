<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Core\Controller;
use App\Core\View;
use App\Models\AuthModel;
use App\Models\CvModel;
use App\Support\Flash;

abstract class AdminController extends Controller
{
    protected CvModel $cvModel;
    protected AuthModel $authModel;

    public function __construct()
    {
        $this->cvModel = new CvModel();
        $this->authModel = new AuthModel();
    }

    protected function requireAuth(): void
    {
        $this->authModel->requireLogin();
    }

    protected function renderAdmin(string $view, array $data, string $title, string $active): void
    {
        $this->requireAuth();
        View::render('admin/partials/layout_start', [
            'title' => $title,
            'active' => $active,
            'flash' => Flash::pull(),
        ]);
        View::render('admin/' . $view, $data);
        View::render('admin/partials/layout_end');
    }
}
