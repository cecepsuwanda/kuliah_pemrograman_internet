<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Support\Request;

class KeterampilanController extends AdminController
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
                        $this->cvModel->deleteKeterampilan($id);
                        $this->flash('success', 'Keterampilan dihapus.');
                        $this->redirectAdmin('keterampilan.php');
                    }
                } else {
                    $heading = Request::postString('section_heading');
                    $judul = Request::postString('judul');
                    $deskripsi = Request::postString('deskripsi');

                    if ($heading === '' || $judul === '' || $deskripsi === '') {
                        $errors[] = 'Semua field wajib diisi.';
                    } else {
                        $this->cvModel->saveKeterampilan($id, $heading, $judul, $deskripsi);
                        $this->flash('success', $id !== null ? 'Keterampilan diperbarui.' : 'Keterampilan ditambahkan.');
                        $this->redirectAdmin('keterampilan.php');
                    }
                }
            } catch (\RuntimeException $e) {
                $errors[] = $e->getMessage();
            }
        }

        $cv = $this->cvModel->load();
        if ($editId !== null) {
            $editItem = findCvItemById($cv['keterampilan']['items'], $editId);
        }

        $this->renderAdmin('keterampilan', compact('cv', 'errors', 'editId', 'editItem'), 'Keterampilan', 'keterampilan');
    }
}
