<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Support\Request;

class SertifikasiController extends AdminController
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
                        $this->cvModel->deleteSertifikasi($id);
                        $this->flash('success', 'Sertifikasi dihapus.');
                        $this->redirectAdmin('sertifikasi.php');
                    }
                } else {
                    $heading = Request::postString('section_heading');
                    $nama = Request::postString('nama');
                    $tahun = Request::postString('tahun');
                    $datetime = Request::postString('datetime');

                    if ($heading === '' || $nama === '' || $tahun === '') {
                        $errors[] = 'Field wajib belum lengkap.';
                    } else {
                        $this->cvModel->saveSertifikasi($id, $heading, $nama, $tahun, $datetime);
                        $this->flash('success', $id !== null ? 'Sertifikasi diperbarui.' : 'Sertifikasi ditambahkan.');
                        $this->redirectAdmin('sertifikasi.php');
                    }
                }
            } catch (\RuntimeException $e) {
                $errors[] = $e->getMessage();
            }
        }

        $cv = $this->cvModel->load();
        if ($editId !== null) {
            $editItem = findCvItemById($cv['sertifikasi']['items'], $editId);
        }

        $this->renderAdmin('sertifikasi', compact('cv', 'errors', 'editId', 'editItem'), 'Sertifikasi', 'sertifikasi');
    }
}
