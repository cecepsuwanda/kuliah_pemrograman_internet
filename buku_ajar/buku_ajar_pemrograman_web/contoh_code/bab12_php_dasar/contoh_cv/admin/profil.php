<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once __DIR__ . '/layout.php';

requireLogin();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $cv = loadCvData();
        $cv['documentTitle'] = postString('documentTitle');
        $cv['metaDescription'] = postString('metaDescription');
        $cv['person']['name'] = postString('name');
        $cv['person']['role'] = postString('role');
        $cv['person']['location'] = postString('location');
        $cv['person']['email'] = postString('email');
        $cv['person']['phoneE164'] = postString('phoneE164');
        $cv['person']['phoneDisplay'] = postString('phoneDisplay');
        $cv['person']['website'] = postString('website');
        $cv['person']['address'] = postString('address');
        $cv['footer']['year'] = (int) postString('footer_year', (string) date('Y'));
        $cv['footer']['text'] = postString('footer_text');

        if ($cv['documentTitle'] === '' || $cv['person']['name'] === '') {
            $errors[] = 'Judul dokumen dan nama wajib diisi.';
        } else {
            saveCvData($cv);
            setFlash('success', 'Profil dan meta dokumen berhasil disimpan.');
            redirect('profil.php');
        }
    } catch (RuntimeException $e) {
        $errors[] = $e->getMessage();
    }
}

$cv = loadCvData();
$p = $cv['person'];

adminLayoutStart('Profil & Meta', 'profil');
?>
<?php foreach ($errors as $err): ?>
<div class="alert alert-danger"><?= h($err) ?></div>
<?php endforeach; ?>

<form method="post" class="card card-primary card-outline">
    <div class="card-header"><h3 class="card-title">Data profil</h3></div>
    <div class="card-body">
        <div class="form-group">
            <label for="documentTitle">Judul dokumen (title)</label>
            <input type="text" class="form-control" id="documentTitle" name="documentTitle" required value="<?= h($cv['documentTitle']) ?>">
        </div>
        <div class="form-group">
            <label for="metaDescription">Meta description</label>
            <textarea class="form-control" id="metaDescription" name="metaDescription" rows="2"><?= h($cv['metaDescription']) ?></textarea>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control" id="name" name="name" required value="<?= h($p['name']) ?>">
            </div>
            <div class="col-md-6 form-group">
                <label for="role">Peran / jabatan</label>
                <input type="text" class="form-control" id="role" name="role" value="<?= h($p['role']) ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="location">Lokasi</label>
            <input type="text" class="form-control" id="location" name="location" value="<?= h($p['location']) ?>">
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= h($p['email']) ?>">
            </div>
            <div class="col-md-6 form-group">
                <label for="website">Website</label>
                <input type="url" class="form-control" id="website" name="website" value="<?= h($p['website']) ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="phoneE164">Telepon (E.164)</label>
                <input type="text" class="form-control" id="phoneE164" name="phoneE164" value="<?= h($p['phoneE164']) ?>">
            </div>
            <div class="col-md-6 form-group">
                <label for="phoneDisplay">Telepon (tampilan)</label>
                <input type="text" class="form-control" id="phoneDisplay" name="phoneDisplay" value="<?= h($p['phoneDisplay']) ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="address">Alamat</label>
            <input type="text" class="form-control" id="address" name="address" value="<?= h($p['address']) ?>">
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 form-group">
                <label for="footer_year">Tahun footer</label>
                <input type="number" class="form-control" id="footer_year" name="footer_year" value="<?= h((string) $cv['footer']['year']) ?>">
            </div>
            <div class="col-md-9 form-group">
                <label for="footer_text">Teks footer</label>
                <input type="text" class="form-control" id="footer_text" name="footer_text" value="<?= h($cv['footer']['text']) ?>">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
<?php
adminLayoutEnd();
