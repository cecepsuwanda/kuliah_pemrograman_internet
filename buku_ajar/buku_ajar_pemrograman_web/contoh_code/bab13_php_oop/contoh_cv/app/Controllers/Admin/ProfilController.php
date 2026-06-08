<?php

declare(strict_types=1);

namespace App\Controllers\Admin;

use App\Support\Request;

class ProfilController extends AdminController
{
    public function handle(): void
    {
        $this->requireAuth();
        $errors = [];

        if (Request::isPost()) {
            try {
                $fields = [
                    'documentTitle' => Request::postString('documentTitle'),
                    'metaDescription' => Request::postString('metaDescription'),
                    'name' => Request::postString('name'),
                    'role' => Request::postString('role'),
                    'location' => Request::postString('location'),
                    'email' => Request::postString('email'),
                    'phoneE164' => Request::postString('phoneE164'),
                    'phoneDisplay' => Request::postString('phoneDisplay'),
                    'website' => Request::postString('website'),
                    'address' => Request::postString('address'),
                    'footer_year' => Request::postString('footer_year', (string) date('Y')),
                    'footer_text' => Request::postString('footer_text'),
                ];

                if ($fields['documentTitle'] === '' || $fields['name'] === '') {
                    $errors[] = 'Judul dokumen dan nama wajib diisi.';
                } else {
                    $this->cvModel->updateProfil($fields);
                    $this->flash('success', 'Profil dan meta dokumen berhasil disimpan.');
                    $this->redirectAdmin('profil.php');
                }
            } catch (\RuntimeException $e) {
                $errors[] = $e->getMessage();
            }
        }

        $cv = $this->cvModel->load();
        $this->renderAdmin('profil', ['cv' => $cv, 'errors' => $errors], 'Profil & Meta', 'profil');
    }
}
