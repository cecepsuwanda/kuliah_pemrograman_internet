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
            if ($id === null || !isset($cv['keterampilan']['items'][$id])) {
                $errors[] = 'Item tidak ditemukan.';
            } else {
                array_splice($cv['keterampilan']['items'], $id, 1);
                saveCvData($cv);
                setFlash('success', 'Keterampilan dihapus.');
                redirect('keterampilan.php');
            }
        } else {
            $heading = postString('section_heading');
            $judul = postString('judul');
            $deskripsi = postString('deskripsi');

            if ($heading === '' || $judul === '' || $deskripsi === '') {
                $errors[] = 'Semua field wajib diisi.';
            } else {
                $cv['keterampilan']['heading'] = $heading;
                $item = ['judul' => $judul, 'deskripsi' => $deskripsi];

                if ($id !== null && isset($cv['keterampilan']['items'][$id])) {
                    $cv['keterampilan']['items'][$id] = $item;
                    setFlash('success', 'Keterampilan diperbarui.');
                } else {
                    $cv['keterampilan']['items'][] = $item;
                    setFlash('success', 'Keterampilan ditambahkan.');
                }

                saveCvData($cv);
                redirect('keterampilan.php');
            }
        }
    } catch (RuntimeException $e) {
        $errors[] = $e->getMessage();
    }
}

if ($editId !== null && isset($cv['keterampilan']['items'][$editId])) {
    $editItem = $cv['keterampilan']['items'][$editId];
}

adminLayoutStart('Keterampilan', 'keterampilan');
?>
<?php foreach ($errors as $err): ?>
<div class="alert alert-danger"><?= h($err) ?></div>
<?php endforeach; ?>

<div class="card card-primary card-outline mb-3">
    <div class="card-header"><h3 class="card-title">Daftar keterampilan</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr><th>Judul</th><th>Deskripsi</th><th class="text-right">Aksi</th></tr>
            </thead>
            <tbody>
                <?php if (empty($cv['keterampilan']['items'])): ?>
                <tr><td colspan="3" class="text-muted">Belum ada data.</td></tr>
                <?php else: ?>
                <?php foreach ($cv['keterampilan']['items'] as $i => $item): ?>
                <tr>
                    <td><?= h($item['judul']) ?></td>
                    <td><?= h($item['deskripsi']) ?></td>
                    <td class="text-right text-nowrap">
                        <a class="btn btn-sm btn-info" href="keterampilan.php?id=<?= $i ?>">Edit</a>
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
        <h3 class="card-title"><?= $editItem ? 'Edit keterampilan' : 'Tambah keterampilan' ?></h3>
    </div>
    <div class="card-body">
        <?php if ($editId !== null): ?>
        <input type="hidden" name="id" value="<?= $editId ?>">
        <?php endif; ?>
        <div class="form-group">
            <label for="section_heading">Judul bagian</label>
            <input type="text" class="form-control" id="section_heading" name="section_heading" required value="<?= h($cv['keterampilan']['heading']) ?>">
        </div>
        <div class="form-group">
            <label for="judul">Judul keterampilan</label>
            <input type="text" class="form-control" id="judul" name="judul" required value="<?= h($editItem['judul'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?= h($editItem['deskripsi'] ?? '') ?></textarea>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary"><?= $editItem ? 'Simpan perubahan' : 'Tambah' ?></button>
        <?php if ($editItem): ?>
        <a href="keterampilan.php" class="btn btn-secondary">Batal</a>
        <?php endif; ?>
    </div>
</form>
<?php
adminLayoutEnd();
