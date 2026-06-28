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
                deleteOrganisasi($id);
                setFlash('success', 'Organisasi dihapus.');
                redirect('organisasi.php');
            }
        } else {
            $heading = postString('section_heading');
            $teks = postString('teks');
            $periode = [
                'mulai_datetime' => postString('mulai_datetime'),
                'mulai_label' => postString('mulai_label'),
                'akhir_teks' => postString('akhir_teks'),
            ];

            if ($heading === '' || $teks === '' || $periode['mulai_label'] === '' || $periode['akhir_teks'] === '') {
                $errors[] = 'Field wajib belum lengkap.';
            } else {
                saveOrganisasi($id, $heading, $teks, $periode);
                setFlash('success', $id !== null ? 'Organisasi diperbarui.' : 'Organisasi ditambahkan.');
                redirect('organisasi.php');
            }
        }
    } catch (RuntimeException $e) {
        $errors[] = $e->getMessage();
    }
}

if ($editId !== null) {
    $editItem = findCvItemById($cv['organisasi']['items'], $editId);
}

$mulaiDatetimeVal = '';
$mulaiLabelVal = '';
$akhirTeksVal = '';
if ($editItem) {
    [$mulaiDatetimeVal, $mulaiLabelVal, $akhirTeksVal] = parseOrganisasiPeriode($editItem);
}

adminLayoutStart('Organisasi', 'organisasi');
?>
<?php foreach ($errors as $err): ?>
<div class="alert alert-danger"><?= h($err) ?></div>
<?php endforeach; ?>

<div class="card card-primary card-outline mb-3">
    <div class="card-header"><h3 class="card-title">Daftar organisasi</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr><th>Teks</th><th class="text-right">Aksi</th></tr>
            </thead>
            <tbody>
                <?php if (empty($cv['organisasi']['items'])): ?>
                <tr><td colspan="2" class="text-muted">Belum ada data.</td></tr>
                <?php else: ?>
                <?php foreach ($cv['organisasi']['items'] as $item): ?>
                <tr>
                    <td><?= h($item['teks']) ?></td>
                    <td class="text-right text-nowrap">
                        <a class="btn btn-sm btn-info" href="organisasi.php?id=<?= (int) $item['id'] ?>">Edit</a>
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
        <h3 class="card-title"><?= $editItem ? 'Edit organisasi' : 'Tambah organisasi' ?></h3>
    </div>
    <div class="card-body">
        <?php if ($editId !== null): ?>
        <input type="hidden" name="id" value="<?= $editId ?>">
        <?php endif; ?>
        <div class="form-group">
            <label for="section_heading">Judul bagian</label>
            <input type="text" class="form-control" id="section_heading" name="section_heading" required value="<?= h($cv['organisasi']['heading']) ?>">
        </div>
        <div class="form-group">
            <label for="teks">Teks keanggotaan</label>
            <input type="text" class="form-control" id="teks" name="teks" required value="<?= h($editItem['teks'] ?? '') ?>">
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="mulai_datetime">Mulai (datetime)</label>
                <input type="text" class="form-control" id="mulai_datetime" name="mulai_datetime" value="<?= h($mulaiDatetimeVal) ?>" placeholder="2024">
            </div>
            <div class="col-md-4 form-group">
                <label for="mulai_label">Mulai (label)</label>
                <input type="text" class="form-control" id="mulai_label" name="mulai_label" required value="<?= h($mulaiLabelVal) ?>">
            </div>
            <div class="col-md-4 form-group">
                <label for="akhir_teks">Akhir (teks, mis. Sekarang)</label>
                <input type="text" class="form-control" id="akhir_teks" name="akhir_teks" required value="<?= h($akhirTeksVal) ?>">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary"><?= $editItem ? 'Simpan perubahan' : 'Tambah' ?></button>
        <?php if ($editItem): ?>
        <a href="organisasi.php" class="btn btn-secondary">Batal</a>
        <?php endif; ?>
    </div>
</form>
<?php
adminLayoutEnd();
