<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;
use App\Models\CvModel;

class CvController extends Controller
{
    private CvModel $cvModel;

    public function __construct()
    {
        $this->cvModel = new CvModel();
    }

    public function index(): void
    {
        try {
            $cv = $this->cvModel->load();
        } catch (\RuntimeException $e) {
            http_response_code(500);
            echo '<!DOCTYPE html><html lang="id"><head><meta charset="UTF-8"><title>Error CV</title></head><body>';
            echo '<p>Gagal memuat data CV: ' . h($e->getMessage()) . '</p></body></html>';
            return;
        }

        $person = $cv['person'];
        $phoneHref = preg_replace('/\s+/', '', $person['phoneE164'] ?? '');

        $this->render('cv/index', compact('cv', 'person', 'phoneHref'));
    }
}
