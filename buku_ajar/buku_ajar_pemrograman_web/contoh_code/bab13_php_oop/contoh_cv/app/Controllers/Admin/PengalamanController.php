<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Support\CvFormatter;
use App\Support\Request;

class PengalamanController extends AdminController
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
                        $this->cvModel->deletePengalaman($id);
                        $this->flash('success', 'Pengalaman dihapus.');
                        $this->redirectAdmin('pengalaman.php');
                    }
                } else {
                    $heading = Request::postString('section_heading');
                    $fields = [
                        'judul' => Request::postString('judul'),
                        'mulai_datetime' => Request::postString('mulai_datetime'),
                        'mulai_label' => Request::postString('mulai_label'),
                        'selesai_datetime' => Request::postString('selesai_datetime'),
                        'selesai_label' => Request::postString('selesai_label'),
                        'poin' => Request::postString('poin'),
                    ];

                    if ($heading === '' || $fields['judul'] === '' || $fields['mulai_label'] === '' || $fields['selesai_label'] === '') {
                        $errors[] = 'Field wajib belum lengkap.';
                    } elseif (CvFormatter::parsePoinText($fields['poin']) === []) {
                        $errors[] = 'Minimal satu poin pengalaman diisi.';
                    } else {
                        $this->cvModel->savePengalaman($id, $heading, $fields);
                        $this->flash('success', $id !== null ? 'Pengalaman diperbarui.' : 'Pengalaman ditambahkan.');
                        $this->redirectAdmin('pengalaman.php');
                    }
                }
            } catch (\RuntimeException $e) {
                $errors[] = $e->getMessage();
            }
        }

        $cv = $this->cvModel->load();
        if ($editId !== null && isset($cv['pengalaman']['items'][$editId])) {
            $editItem = $cv['pengalaman']['items'][$editId];
        }

        $this->renderAdmin('pengalaman', compact('cv', 'errors', 'editId', 'editItem'), 'Pengalaman', 'pengalaman');
    }
}
