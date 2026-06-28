<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Support\CvFormatter;
use App\Support\Request;

class PendidikanController extends AdminController
{
    public function handle(): void
    {
        $this->requireAuth();
        $errors = [];
        $editId = Request::editId();
        $editRow = null;
        $mulaiDatetimeVal = '';
        $mulaiLabelVal = '';
        $selesaiLabelVal = '';

        if (Request::isPost()) {
            $action = Request::postString('action', 'save');
            $id = Request::postInt('id');

            try {
                if ($action === 'delete') {
                    if ($id === null) {
                        $errors[] = 'Baris tidak ditemukan.';
                    } else {
                        $this->cvModel->deletePendidikan($id);
                        $this->flash('success', 'Baris pendidikan dihapus.');
                        $this->redirectAdmin('pendidikan.php');
                    }
                } else {
                    $heading = Request::postString('section_heading');
                    $caption = Request::postString('caption');
                    $fields = [
                        'jenjang' => Request::postString('jenjang'),
                        'institusi' => Request::postString('institusi'),
                        'program' => Request::postString('program'),
                        'mulai_datetime' => Request::postString('mulai_datetime'),
                        'mulai_label' => Request::postString('mulai_label'),
                        'selesai_label' => Request::postString('selesai_label'),
                    ];

                    if ($heading === '' || $fields['jenjang'] === '' || $fields['institusi'] === '' || $fields['program'] === '' || $fields['mulai_label'] === '') {
                        $errors[] = 'Field wajib belum lengkap.';
                    } else {
                        $this->cvModel->savePendidikan($id, $heading, $caption, $fields);
                        $this->flash('success', $id !== null ? 'Pendidikan diperbarui.' : 'Pendidikan ditambahkan.');
                        $this->redirectAdmin('pendidikan.php');
                    }
                }
            } catch (\RuntimeException $e) {
                $errors[] = $e->getMessage();
            }
        }

        $cv = $this->cvModel->load();
        if ($editId !== null) {
            $editRow = findCvItemById($cv['pendidikan']['rows'], $editId);
            if ($editRow) {
                [$mulaiDatetimeVal, $mulaiLabelVal, $selesaiLabelVal] = CvFormatter::parseEducationPeriode($editRow);
            }
        }

        $this->renderAdmin('pendidikan', compact('cv', 'errors', 'editId', 'editRow', 'mulaiDatetimeVal', 'mulaiLabelVal', 'selesaiLabelVal'), 'Pendidikan', 'pendidikan');
    }
}
