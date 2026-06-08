<?php foreach ($errors as $err): ?>
<div class="alert alert-danger"><?= h($err) ?></div>
<?php endforeach; ?>

<form method="post" action="<?= admin_url('kontak.php') ?>" class="card card-primary card-outline">
    <div class="card-header"><h3 class="card-title">Bagian kontak</h3></div>
    <div class="card-body">
        <div class="form-group">
            <label for="heading">Judul bagian</label>
            <input type="text" class="form-control" id="heading" name="heading" required value="<?= h($k['heading']) ?>">
        </div>
        <div class="form-group">
            <label for="intro">Teks intro (email diambil dari profil)</label>
            <textarea class="form-control" id="intro" name="intro" rows="3" required><?= h($k['intro']) ?></textarea>
        </div>
        <p class="text-muted small mb-0">Email kontak menggunakan data di menu <a href="<?= admin_url('profil.php') ?>">Profil &amp; Meta</a>.</p>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>
<?php
