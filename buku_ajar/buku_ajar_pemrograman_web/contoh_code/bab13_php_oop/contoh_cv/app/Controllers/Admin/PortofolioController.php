<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Support\Request;

class PortofolioController extends AdminController
{
    public function handle(): void
    {
        $this->requireAuth();
        $errors = [];
        $editId = Request::editId();
        $editItem = null;

        if (Request::isPost()) {
            $action = Request::postString('action', 'save');
            $id = Request::postInt('id');

            try {
                if ($action === 'delete') {
                    if ($id === null) {
                        $errors[] = 'Item tidak ditemukan.';
                    } else {
                        $this->cvModel->deletePortofolio($id);
                        $this->flash('success', 'Portofolio dihapus.');
                        $this->redirectAdmin('portofolio.php');
                    }
                } else {
                    $heading = Request::postString('section_heading');
                    $judul = Request::postString('judul');
                    $linkHref = Request::postString('linkHref');
                    $linkText = Request::postString('linkText');

                    if ($heading === '' || $judul === '' || $linkHref === '' || $linkText === '') {
                        $errors[] = 'Semua field wajib diisi.';
                    } else {
                        $this->cvModel->savePortofolio($id, $heading, $judul, $linkHref, $linkText);
                        $this->flash('success', $id !== null ? 'Portofolio diperbarui.' : 'Portofolio ditambahkan.');
                        $this->redirectAdmin('portofolio.php');
                    }
                }
            } catch (\RuntimeException $e) {
                $errors[] = $e->getMessage();
            }
        }

        $cv = $this->cvModel->load();
        if ($editId !== null && isset($cv['portofolio']['items'][$editId])) {
            $editItem = $cv['portofolio']['items'][$editId];
        }

        $this->renderAdmin('portofolio', compact('cv', 'errors', 'editId', 'editItem'), 'Portofolio', 'portofolio');
    }
}
