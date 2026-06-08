<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once __DIR__ . '/layout.php';

requireLogin();

$cv = loadCvData();
$errors = [];
$editId = isset($_GET['id']) ? (int) $_GET['id'] : null;
$editItem = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = postString('action', 'save');
    $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

    try {
        $cv = loadCvData();

        if ($action === 'delete') {
            if ($id === null || !isset($cv['portofolio']['items'][$id])) {
                $errors[] = 'Item tidak ditemukan.';
            } else {
                array_splice($cv['portofolio']['items'], $id, 1);
                saveCvData($cv);
                setFlash('success', 'Portofolio dihapus.');
                redirect('portofolio.php');
            }
        } else {
            $heading = postString('section_heading');
            $judul = postString('judul');
            $linkHref = postString('linkHref');
            $linkText = postString('linkText');

            if ($heading === '' || $judul === '' || $linkHref === '' || $linkText === '') {
                $errors[] = 'Semua field wajib diisi.';
            } else {
                $cv['portofolio']['heading'] = $heading;
                $item = ['judul' => $judul, 'linkHref' => $linkHref, 'linkText' => $linkText];

                if ($id !== null && isset($cv['portofolio']['items'][$id])) {
                    $cv['portofolio']['items'][$id] = $item;
                    setFlash('success', 'Portofolio diperbarui.');
                } else {
                    $cv['portofolio']['items'][] = $item;
                    setFlash('success', 'Portofolio ditambahkan.');
                }

                saveCvData($cv);
                redirect('portofolio.php');
            }
        }
    } catch (RuntimeException $e) {
        $errors[] = $e->getMessage();
    }
}

if ($editId !== null && isset($cv['portofolio']['items'][$editId])) {
    $editItem = $cv['portofolio']['items'][$editId];
}

adminLayoutStart('Portofolio', 'portofolio');
?>
<?php foreach ($errors as $err): ?>
<div class="alert alert-danger"><?= h($err) ?></div>
<?php endforeach; ?>

<div class="card card-primary card-outline mb-3">
    <div class="card-header"><h3 class="card-title">Daftar portofolio</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr><th>Judul</th><th>Tautan</th><th class="text-right">Aksi</th></tr>
            </thead>
            <tbody>
                <?php if (empty($cv['portofolio']['items'])): ?>
                <tr><td colspan="3" class="text-muted">Belum ada data.</td></tr>
                <?php else: ?>
                <?php foreach ($cv['portofolio']['items'] as $i => $item): ?>
                <tr>
                    <td><?= h($item['judul']) ?></td>
                    <td><a href="<?= h($item['linkHref']) ?>" target="_blank" rel="noopener"><?= h($item['linkText']) ?></a></td>
                    <td class="text-right text-nowrap">
                        <a class="btn btn-sm btn-info" href="portofolio.php?id=<?= $i ?>">Edit</a>
                        <form method="post" class="d-inline" onsubmit="return confirm('Hapus item ini?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= $i ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<form method="post" class="card card-secondary card-outline">
    <div class="card-header">
        <h3 class="card-title"><?= $editItem ? 'Edit portofolio' : 'Tambah portofolio' ?></h3>
    </div>
    <div class="card-body">
        <?php if ($editId !== null): ?>
        <input type="hidden" name="id" value="<?= $editId ?>">
        <?php endif; ?>
        <div class="form-group">
            <label for="section_heading">Judul bagian</label>
            <input type="text" class="form-control" id="section_heading" name="section_heading" required value="<?= h($cv['portofolio']['heading']) ?>">
        </div>
        <div class="form-group">
            <label for="judul">Judul proyek</label>
            <input type="text" class="form-control" id="judul" name="judul" required value="<?= h($editItem['judul'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="linkHref">URL tautan</label>
            <input type="text" class="form-control" id="linkHref" name="linkHref" required value="<?= h($editItem['linkHref'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="linkText">Teks tautan</label>
            <input type="text" class="form-control" id="linkText" name="linkText" required value="<?= h($editItem['linkText'] ?? '') ?>">
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary"><?= $editItem ? 'Simpan perubahan' : 'Tambah' ?></button>
        <?php if ($editItem): ?>
        <a href="portofolio.php" class="btn btn-secondary">Batal</a>
        <?php endif; ?>
    </div>
</form>
<?php
adminLayoutEnd();
