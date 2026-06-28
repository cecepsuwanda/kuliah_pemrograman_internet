<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once __DIR__ . '/layout.php';
cv_boot_app();
requireLogin();

$cv = loadCvData();
$errors = [];
$editId = isset($_GET['id']) ? (int) $_GET['id'] : null;
$editItem = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = postString('action', 'save');
    $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

    try {
        if ($action === 'delete') {
            if ($id === null) {
                $errors[] = 'Item tidak ditemukan.';
            } else {
                deletePengalaman($id);
                setFlash('success', 'Pengalaman dihapus.');
                redirect('pengalaman.php');
            }
        } else {
            $heading = postString('section_heading');
            $judul = postString('judul');
            $mulaiDatetime = postString('mulai_datetime');
            $mulaiLabel = postString('mulai_label');
            $selesaiDatetime = postString('selesai_datetime');
            $selesaiLabel = postString('selesai_label');
            $poinText = postString('poin');

            if ($heading === '' || $judul === '' || $mulaiLabel === '' || $selesaiLabel === '') {
                $errors[] = 'Field wajib belum lengkap.';
            } elseif (parsePoinText($poinText) === []) {
                $errors[] = 'Minimal satu poin pengalaman diisi.';
            } else {
                savePengalaman($id, $heading, [
                    'judul' => $judul,
                    'mulai_datetime' => $mulaiDatetime,
                    'mulai_label' => $mulaiLabel,
                    'selesai_datetime' => $selesaiDatetime,
                    'selesai_label' => $selesaiLabel,
                    'poin' => $poinText,
                ]);
                setFlash('success', $id !== null ? 'Pengalaman diperbarui.' : 'Pengalaman ditambahkan.');
                redirect('pengalaman.php');
            }
        }
    } catch (RuntimeException $e) {
        $errors[] = $e->getMessage();
    }
}

if ($editId !== null) {
    $editItem = findCvItemById($cv['pengalaman']['items'], $editId);
}

adminLayoutStart('Pengalaman', 'pengalaman');
?>
<?php foreach ($errors as $err): ?>
<div class="alert alert-danger"><?= h($err) ?></div>
<?php endforeach; ?>

<div class="card card-primary card-outline mb-3">
    <div class="card-header"><h3 class="card-title">Daftar pengalaman</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr><th>Judul</th><th>Periode</th><th class="text-right">Aksi</th></tr>
            </thead>
            <tbody>
                <?php if (empty($cv['pengalaman']['items'])): ?>
                <tr><td colspan="3" class="text-muted">Belum ada data.</td></tr>
                <?php else: ?>
                <?php foreach ($cv['pengalaman']['items'] as $item): ?>
                <tr>
                    <td><?= h($item['judul']) ?></td>
                    <td><?= h($item['mulai']['label']) ?> – <?= h($item['selesai']['label']) ?></td>
                    <td class="text-right text-nowrap">
                        <a class="btn btn-sm btn-info" href="pengalaman.php?id=<?= (int) $item['id'] ?>">Edit</a>
                        <form method="post" class="d-inline" onsubmit="return confirm('Hapus item ini?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= (int) $item['id'] ?>">
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
        <h3 class="card-title"><?= $editItem ? 'Edit pengalaman' : 'Tambah pengalaman' ?></h3>
    </div>
    <div class="card-body">
        <?php if ($editId !== null): ?>
        <input type="hidden" name="id" value="<?= $editId ?>">
        <?php endif; ?>
        <div class="form-group">
            <label for="section_heading">Judul bagian</label>
            <input type="text" class="form-control" id="section_heading" name="section_heading" required value="<?= h($cv['pengalaman']['heading']) ?>">
        </div>
        <div class="form-group">
            <label for="judul">Judul posisi / proyek</label>
            <input type="text" class="form-control" id="judul" name="judul" required value="<?= h($editItem['judul'] ?? '') ?>">
        </div>
        <div class="row">
            <div class="col-md-3 form-group">
                <label for="mulai_datetime">Mulai (datetime)</label>
                <input type="text" class="form-control" id="mulai_datetime" name="mulai_datetime" value="<?= h($editItem['mulai']['datetime'] ?? '') ?>" placeholder="2026-02">
            </div>
            <div class="col-md-3 form-group">
                <label for="mulai_label">Mulai (label)</label>
                <input type="text" class="form-control" id="mulai_label" name="mulai_label" required value="<?= h($editItem['mulai']['label'] ?? '') ?>">
            </div>
            <div class="col-md-3 form-group">
                <label for="selesai_datetime">Selesai (datetime)</label>
                <input type="text" class="form-control" id="selesai_datetime" name="selesai_datetime" value="<?= h($editItem['selesai']['datetime'] ?? '') ?>">
            </div>
            <div class="col-md-3 form-group">
                <label for="selesai_label">Selesai (label)</label>
                <input type="text" class="form-control" id="selesai_label" name="selesai_label" required value="<?= h($editItem['selesai']['label'] ?? '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="poin">Poin (satu baris per poin)</label>
            <textarea class="form-control" id="poin" name="poin" rows="5" required><?= h(isset($editItem['poin']) ? poinToText($editItem['poin']) : '') ?></textarea>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary"><?= $editItem ? 'Simpan perubahan' : 'Tambah' ?></button>
        <?php if ($editItem): ?>
        <a href="pengalaman.php" class="btn btn-secondary">Batal</a>
        <?php endif; ?>
    </div>
</form>
<?php
adminLayoutEnd();
