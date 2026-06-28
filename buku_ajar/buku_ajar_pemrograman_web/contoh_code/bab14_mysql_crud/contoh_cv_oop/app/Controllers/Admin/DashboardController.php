<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

class DashboardController extends AdminController
{
    public function index(): void
    {
        $cv = $this->cvModel->load();
        $counts = [
            'keterampilan' => count($cv['keterampilan']['items'] ?? []),
            'pengalaman' => count($cv['pengalaman']['items'] ?? []),
            'pendidikan' => count($cv['pendidikan']['rows'] ?? []),
            'portofolio' => count($cv['portofolio']['items'] ?? []),
            'sertifikasi' => count($cv['sertifikasi']['items'] ?? []),
            'organisasi' => count($cv['organisasi']['items'] ?? []),
        ];
        $this->renderAdmin('dashboard', ['cv' => $cv, 'counts' => $counts], 'Dashboard', 'index');
    }
}
