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
                <?php foreach ($cv['portofolio']['items'] as $item): ?>
                <tr>
                    <td><?= h($item['judul']) ?></td>
                    <td><a href="<?= h($item['linkHref']) ?>" target="_blank" rel="noopener"><?= h($item['linkText']) ?></a></td>
                    <td class="text-right text-nowrap">
                        <a class="btn btn-sm btn-info" href="<?= admin_url('portofolio.php') ?>?id=<?= (int) $item['id'] ?>">Edit</a>
                        <form method="post" action="<?= admin_url('portofolio.php') ?>" class="d-inline" onsubmit="return confirm('Hapus item ini?');">
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

<form method="post" action="<?= admin_url('portofolio.php') ?>" class="card card-secondary card-outline">
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
        <a href="<?= admin_url('portofolio.php') ?>" class="btn btn-secondary">Batal</a>
        <?php endif; ?>
    </div>
</form>
<?php
