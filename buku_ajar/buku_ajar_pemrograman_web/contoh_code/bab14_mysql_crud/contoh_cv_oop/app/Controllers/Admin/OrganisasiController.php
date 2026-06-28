<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Support\CvFormatter;
use App\Support\Request;

class OrganisasiController extends AdminController
{
    public function handle(): void
    {
        $this->requireAuth();
        $errors = [];
        $editId = Request::editId();
        $editItem = null;
        $mulaiDatetimeVal = '';
        $mulaiLabelVal = '';
        $akhirTeksVal = '';

        if (Request::isPost()) {
            $action = Request::postString('action', 'save');
            $id = Request::postInt('id');

            try {
                if ($action === 'delete') {
                    if ($id === null) {
                        $errors[] = 'Item tidak ditemukan.';
                    } else {
                        $this->cvModel->deleteOrganisasi($id);
                        $this->flash('success', 'Organisasi dihapus.');
                        $this->redirectAdmin('organisasi.php');
                    }
                } else {
                    $heading = Request::postString('section_heading');
                    $teks = Request::postString('teks');
                    $periode = [
                        'mulai_datetime' => Request::postString('mulai_datetime'),
                        'mulai_label' => Request::postString('mulai_label'),
                        'akhir_teks' => Request::postString('akhir_teks'),
                    ];

                    if ($heading === '' || $teks === '' || $periode['mulai_label'] === '' || $periode['akhir_teks'] === '') {
                        $errors[] = 'Field wajib belum lengkap.';
                    } else {
                        $this->cvModel->saveOrganisasi($id, $heading, $teks, $periode);
                        $this->flash('success', $id !== null ? 'Organisasi diperbarui.' : 'Organisasi ditambahkan.');
                        $this->redirectAdmin('organisasi.php');
                    }
                }
            } catch (\RuntimeException $e) {
                $errors[] = $e->getMessage();
            }
        }

        $cv = $this->cvModel->load();
        if ($editId !== null) {
            $editItem = findCvItemById($cv['organisasi']['items'], $editId);
            if ($editItem) {
                [$mulaiDatetimeVal, $mulaiLabelVal, $akhirTeksVal] = CvFormatter::parseOrganisasiPeriode($editItem);
            }
        }

        $this->renderAdmin('organisasi', compact('cv', 'errors', 'editId', 'editItem', 'mulaiDatetimeVal', 'mulaiLabelVal', 'akhirTeksVal'), 'Organisasi', 'organisasi');
    }
}
