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
            if ($id === null || !isset($cv['organisasi']['items'][$id])) {
                $errors[] = 'Item tidak ditemukan.';
            } else {
                array_splice($cv['organisasi']['items'], $id, 1);
                saveCvData($cv);
                setFlash('success', 'Organisasi dihapus.');
                redirect('organisasi.php');
            }
        } else {
            $heading = postString('section_heading');
            $teks = postString('teks');
            $mulaiDatetime = postString('mulai_datetime');
            $mulaiLabel = postString('mulai_label');
            $akhirTeks = postString('akhir_teks');

            if ($heading === '' || $teks === '' || $mulaiLabel === '' || $akhirTeks === '') {
                $errors[] = 'Field wajib belum lengkap.';
            } else {
                $cv['organisasi']['heading'] = $heading;
                $item = [
                    'teks' => $teks,
                    'periodeSegments' => buildOrganisasiPeriodeSegments($mulaiDatetime, $mulaiLabel, $akhirTeks),
                ];

                if ($id !== null && isset($cv['organisasi']['items'][$id])) {
                    $cv['organisasi']['items'][$id] = $item;
                    setFlash('success', 'Organisasi diperbarui.');
                } else {
                    $cv['organisasi']['items'][] = $item;
                    setFlash('success', 'Organisasi ditambahkan.');
                }

                saveCvData($cv);
                redirect('organisasi.php');
            }
        }
    } catch (RuntimeException $e) {
        $errors[] = $e->getMessage();
    }
}

if ($editId !== null && isset($cv['organisasi']['items'][$editId])) {
    $editItem = $cv['organisasi']['items'][$editId];
}

$mulaiDatetimeVal = '';
$mulaiLabelVal = '';
$akhirTeksVal = '';
if ($editItem) {
    foreach ($editItem['periodeSegments'] as $seg) {
        if (($seg['type'] ?? '') === 'time') {
            $mulaiDatetimeVal = $seg['datetime'] ?? '';
            $mulaiLabelVal = $seg['label'] ?? '';
        } elseif (($seg['type'] ?? '') === 'text' && str_contains($seg['value'] ?? '', '–')) {
            if (preg_match('/–\s*(.+)\)/', $seg['value'], $m)) {
                $akhirTeksVal = trim($m[1]);
            }
        }
    }
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
                <tr><th>Organisasi</th><th class="text-right">Aksi</th></tr>
            </thead>
            <tbody>
                <?php if (empty($cv['organisasi']['items'])): ?>
                <tr><td colspan="2" class="text-muted">Belum ada data.</td></tr>
                <?php else: ?>
                <?php foreach ($cv['organisasi']['items'] as $i => $item): ?>
                <tr>
                    <td><?= h($item['teks']) ?> <?= renderPeriodeSegments($item['periodeSegments']) ?></td>
                    <td class="text-right text-nowrap">
                        <a class="btn btn-sm btn-info" href="organisasi.php?id=<?= $i ?>">Edit</a>
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
            <label for="teks">Nama organisasi &amp; peran</label>
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
                <label for="akhir_teks">Teks akhir periode</label>
                <input type="text" class="form-control" id="akhir_teks" name="akhir_teks" required value="<?= h($akhirTeksVal) ?>" placeholder="Sekarang">
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
