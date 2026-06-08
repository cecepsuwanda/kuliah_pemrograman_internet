<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once __DIR__ . '/layout.php';

requireLogin();

$cv = loadCvData();
$errors = [];
$editId = isset($_GET['id']) ? (int) $_GET['id'] : null;
$editRow = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = postString('action', 'save');
    $id = isset($_POST['id']) ? (int) $_POST['id'] : null;

    try {
        $cv = loadCvData();

        if ($action === 'delete') {
            if ($id === null || !isset($cv['pendidikan']['rows'][$id])) {
                $errors[] = 'Baris tidak ditemukan.';
            } else {
                array_splice($cv['pendidikan']['rows'], $id, 1);
                saveCvData($cv);
                setFlash('success', 'Baris pendidikan dihapus.');
                redirect('pendidikan.php');
            }
        } else {
            $heading = postString('section_heading');
            $caption = postString('caption');
            $jenjang = postString('jenjang');
            $institusi = postString('institusi');
            $program = postString('program');
            $mulaiDatetime = postString('mulai_datetime');
            $mulaiLabel = postString('mulai_label');
            $selesaiLabel = postString('selesai_label');

            if ($heading === '' || $jenjang === '' || $institusi === '' || $program === '' || $mulaiLabel === '') {
                $errors[] = 'Field wajib belum lengkap.';
            } else {
                $cv['pendidikan']['heading'] = $heading;
                $cv['pendidikan']['caption'] = $caption;
                $row = [
                    'jenjang' => $jenjang,
                    'institusi' => $institusi,
                    'program' => $program,
                    'periodeSegments' => buildEducationPeriodeSegments($mulaiDatetime, $mulaiLabel, $selesaiLabel),
                ];

                if ($id !== null && isset($cv['pendidikan']['rows'][$id])) {
                    $cv['pendidikan']['rows'][$id] = $row;
                    setFlash('success', 'Pendidikan diperbarui.');
                } else {
                    $cv['pendidikan']['rows'][] = $row;
                    setFlash('success', 'Pendidikan ditambahkan.');
                }

                saveCvData($cv);
                redirect('pendidikan.php');
            }
        }
    } catch (RuntimeException $e) {
        $errors[] = $e->getMessage();
    }
}

if ($editId !== null && isset($cv['pendidikan']['rows'][$editId])) {
    $editRow = $cv['pendidikan']['rows'][$editId];
}

$mulaiDatetimeVal = '';
$mulaiLabelVal = '';
$selesaiLabelVal = '';
if ($editRow) {
    foreach ($editRow['periodeSegments'] as $seg) {
        if (($seg['type'] ?? '') === 'time' && $mulaiLabelVal === '') {
            $mulaiDatetimeVal = $seg['datetime'] ?? '';
            $mulaiLabelVal = $seg['label'] ?? '';
        } elseif (($seg['type'] ?? '') === 'time' && $mulaiLabelVal !== '') {
            $selesaiLabelVal = $seg['label'] ?? '';
        } elseif (($seg['type'] ?? '') === 'text' && str_contains($seg['value'] ?? '', 'Sekarang')) {
            $selesaiLabelVal = 'Sekarang';
        }
    }
}

adminLayoutStart('Pendidikan', 'pendidikan');
?>
<?php foreach ($errors as $err): ?>
<div class="alert alert-danger"><?= h($err) ?></div>
<?php endforeach; ?>

<div class="card card-primary card-outline mb-3">
    <div class="card-header"><h3 class="card-title">Daftar pendidikan</h3></div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr><th>Jenjang</th><th>Institusi</th><th>Program</th><th class="text-right">Aksi</th></tr>
            </thead>
            <tbody>
                <?php if (empty($cv['pendidikan']['rows'])): ?>
                <tr><td colspan="4" class="text-muted">Belum ada data.</td></tr>
                <?php else: ?>
                <?php foreach ($cv['pendidikan']['rows'] as $i => $row): ?>
                <tr>
                    <td><?= h($row['jenjang']) ?></td>
                    <td><?= h($row['institusi']) ?></td>
                    <td><?= h($row['program']) ?></td>
                    <td class="text-right text-nowrap">
                        <a class="btn btn-sm btn-info" href="pendidikan.php?id=<?= $i ?>">Edit</a>
                        <form method="post" class="d-inline" onsubmit="return confirm('Hapus baris ini?');">
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
        <h3 class="card-title"><?= $editRow ? 'Edit pendidikan' : 'Tambah pendidikan' ?></h3>
    </div>
    <div class="card-body">
        <?php if ($editId !== null): ?>
        <input type="hidden" name="id" value="<?= $editId ?>">
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="section_heading">Judul bagian</label>
                <input type="text" class="form-control" id="section_heading" name="section_heading" required value="<?= h($cv['pendidikan']['heading']) ?>">
            </div>
            <div class="col-md-6 form-group">
                <label for="caption">Caption tabel</label>
                <input type="text" class="form-control" id="caption" name="caption" value="<?= h($cv['pendidikan']['caption']) ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label for="jenjang">Jenjang</label>
                <input type="text" class="form-control" id="jenjang" name="jenjang" required value="<?= h($editRow['jenjang'] ?? '') ?>">
            </div>
            <div class="col-md-4 form-group">
                <label for="institusi">Institusi</label>
                <input type="text" class="form-control" id="institusi" name="institusi" required value="<?= h($editRow['institusi'] ?? '') ?>">
            </div>
            <div class="col-md-4 form-group">
                <label for="program">Program/Jurusan</label>
                <input type="text" class="form-control" id="program" name="program" required value="<?= h($editRow['program'] ?? '') ?>">
            </div>
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
                <label for="selesai_label">Selesai (label atau "Sekarang")</label>
                <input type="text" class="form-control" id="selesai_label" name="selesai_label" value="<?= h($selesaiLabelVal) ?>" placeholder="2024 atau Sekarang">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary"><?= $editRow ? 'Simpan perubahan' : 'Tambah' ?></button>
        <?php if ($editRow): ?>
        <a href="pendidikan.php" class="btn btn-secondary">Batal</a>
        <?php endif; ?>
    </div>
</form>
<?php
adminLayoutEnd();
