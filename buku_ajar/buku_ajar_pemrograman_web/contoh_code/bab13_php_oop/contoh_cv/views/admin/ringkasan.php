<?php foreach ($errors as $err): ?>
<div class="alert alert-danger"><?= h($err) ?></div>
<?php endforeach; ?>

<form method="post" action="<?= admin_url('ringkasan.php') ?>" class="card card-primary card-outline">
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
