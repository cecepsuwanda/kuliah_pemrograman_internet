<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Support\Request;

class RingkasanController extends AdminController
{
    public function handle(): void
    {
        $this->requireAuth();
        $errors = [];

        if (Request::isPost()) {
            try {
                $heading = Request::postString('heading');
                $text = Request::postString('text');

                if ($heading === '' || $text === '') {
                    $errors[] = 'Judul dan teks ringkasan wajib diisi.';
                } else {
                    $this->cvModel->updateRingkasan($heading, $text);
                    $this->flash('success', 'Ringkasan berhasil disimpan.');
                    $this->redirectAdmin('ringkasan.php');
                }
            } catch (\RuntimeException $e) {
                $errors[] = $e->getMessage();
            }
        }

        $cv = $this->cvModel->load();
        $this->renderAdmin('ringkasan', ['cv' => $cv, 'errors' => $errors], 'Ringkasan', 'ringkasan');
    }
}
