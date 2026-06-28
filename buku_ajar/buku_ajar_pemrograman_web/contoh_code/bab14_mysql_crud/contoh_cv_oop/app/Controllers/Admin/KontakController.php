<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Support\Request;

class KontakController extends AdminController
{
    public function handle(): void
    {
        $this->requireAuth();
        $errors = [];

        if (Request::isPost()) {
            try {
                $heading = Request::postString('heading');
                $intro = Request::postString('intro');

                if ($heading === '' || $intro === '') {
                    $errors[] = 'Judul dan teks intro wajib diisi.';
                } else {
                    $this->cvModel->updateKontak($heading, $intro);
                    $this->flash('success', 'Bagian kontak berhasil disimpan.');
                    $this->redirectAdmin('kontak.php');
                }
            } catch (\RuntimeException $e) {
                $errors[] = $e->getMessage();
            }
        }

        $cv = $this->cvModel->load();
        $this->renderAdmin('kontak', ['cv' => $cv, 'errors' => $errors], 'Kontak', 'kontak');
    }
}
