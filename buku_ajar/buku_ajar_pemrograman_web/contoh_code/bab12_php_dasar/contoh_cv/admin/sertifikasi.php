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
            if ($id === null || !isset($cv['sertifikasi']['items'][$id])) {
                $errors[] = 'Item tidak ditemukan.';
            } else {
                array_splice($cv['sertifikasi']['items'], $id, 1);
                saveCvData($cv);
                setFlash('success', 'Sertifikasi dihapus.');
                redirect('sertifikasi.php');
            }
        } else {
            $heading = postString('section_heading');
            $nama = postString('nama');
            $tahun = postString('tahun');
            $datetime = postString('datetime');

            if ($heading === '' || $nama === '' || $tahun === '') {
                $errors[] = 'Field wajib belum lengkap.';
            } else {
                $cv['sertifikasi']['heading'] = $heading;
                $item = [
                    'nama' => $nama,
                    'tahun' => $tahun,
                    'datetime' => $datetime !== '' ? $datetime : $tahun,
                ];

                if ($id !== null && isset($cv['sertifikasi']['items'][$id])) {
                    $cv['sertifikasi']['items'][$id] = $item;
                    setFlash('success', 'Sertifikasi diperbarui.');
                } else {
                    $cv['sertifikasi']['items'][] = $item;
                    setFlash('success', 'Sertifikasi ditambahkan.');
                }

                saveCvData($cv);
                redirect('sertifikasi.php');
            }
        }
    } catch (RuntimeException $e) {
        $errors[] = $e->getMessage();
    }
}

if ($editId !== null && isset($cv['sertifikasi']['items'][$editId])) {
    $editItem = $cv['sertifikasi']['items'][$editId];
}

adminLayoutStart('Sertifikasi', 'sertifikasi');
?>
<?php foreach ($errors as $err): ?>
<div class="alert alert-danger"><?= h($err) ?></div>
<?php endforeach; ?>

<div class="card card-primary card-outline mb-3">
    <div class="card-header"><h3 class="card-title">Daftar sertifikasi</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr><th>Nama</th><th>Tahun</th><th class="text-right">Aksi</th></tr>
            </thead>
            <tbody>
                <?php if (empty($cv['sertifikasi']['items'])): ?>
                <tr><td colspan="3" class="text-muted">Belum ada data.</td></tr>
                <?php else: ?>
                <?php foreach ($cv['sertifikasi']['items'] as $i => $item): ?>
                <tr>
                    <td><?= h($item['nama']) ?></td>
                    <td><?= h($item['tahun']) ?></td>
                    <td class="text-right text-nowrap">
                        <a class="btn btn-sm btn-info" href="sertifikasi.php?id=<?= $i ?>">Edit</a>
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
        <h3 class="card-title"><?= $editItem ? 'Edit sertifikasi' : 'Tambah sertifikasi' ?></h3>
    </div>
    <div class="card-body">
        <?php if ($editId !== null): ?>
        <input type="hidden" name="id" value="<?= $editId ?>">
        <?php endif; ?>
        <div class="form-group">
            <label for="section_heading">Judul bagian</label>
            <input type="text" class="form-control" id="section_heading" name="section_heading" required value="<?= h($cv['sertifikasi']['heading']) ?>">
        </div>
        <div class="form-group">
            <label for="nama">Nama sertifikasi</label>
            <input type="text" class="form-control" id="nama" name="nama" required value="<?= h($editItem['nama'] ?? '') ?>">
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="tahun">Tahun (tampilan)</label>
                <input type="text" class="form-control" id="tahun" name="tahun" required value="<?= h($editItem['tahun'] ?? '') ?>">
            </div>
            <div class="col-md-6 form-group">
                <label for="datetime">Datetime (atribut time)</label>
                <input type="text" class="form-control" id="datetime" name="datetime" value="<?= h($editItem['datetime'] ?? '') ?>" placeholder="2025">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary"><?= $editItem ? 'Simpan perubahan' : 'Tambah' ?></button>
        <?php if ($editItem): ?>
        <a href="sertifikasi.php" class="btn btn-secondary">Batal</a>
        <?php endif; ?>
    </div>
</form>
<?php
adminLayoutEnd();
