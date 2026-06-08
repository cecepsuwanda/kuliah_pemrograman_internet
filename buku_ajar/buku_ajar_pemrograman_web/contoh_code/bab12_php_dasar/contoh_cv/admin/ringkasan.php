<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once __DIR__ . '/layout.php';

requireLogin();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $cv = loadCvData();
        $cv['ringkasan']['heading'] = postString('heading');
        $cv['ringkasan']['text'] = postString('text');

        if ($cv['ringkasan']['heading'] === '' || $cv['ringkasan']['text'] === '') {
            $errors[] = 'Judul dan teks ringkasan wajib diisi.';
        } else {
            saveCvData($cv);
            setFlash('success', 'Ringkasan berhasil disimpan.');
            redirect('ringkasan.php');
        }
    } catch (RuntimeException $e) {
        $errors[] = $e->getMessage();
    }
}

$cv = loadCvData();
$r = $cv['ringkasan'];

adminLayoutStart('Ringkasan', 'ringkasan');
?>
<?php foreach ($errors as $err): ?>
<div class="alert alert-danger"><?= h($err) ?></div>
<?php endforeach; ?>

<form method="post" class="card card-primary card-outline">
    <div class="card-header"><h3 class="card-title">Ringkasan profesional</h3></div>
    <div class="card-body">
        <div class="form-group">
            <label for="heading">Judul bagian</label>
            <input type="text" class="form-control" id="heading" name="heading" required value="<?= h($r['heading']) ?>">
        </div>
        <div class="form-group">
            <label for="text">Teks ringkasan</label>
            <textarea class="form-control" id="text" name="text" rows="6" required><?= h($r['text']) ?></textarea>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
<?php
adminLayoutEnd();
