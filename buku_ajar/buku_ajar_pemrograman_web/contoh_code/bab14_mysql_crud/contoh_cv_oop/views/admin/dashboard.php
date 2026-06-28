<div class="row">
    <div class="col-md-4 col-sm-6">
        <div class="info-box">
            <span class="info-box-icon bg-info"><i class="fas fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Profil</span>
                <span class="info-box-number"><?= h($cv['person']['name']) ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="info-box">
            <span class="info-box-icon bg-success"><i class="fas fa-tools"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Keterampilan</span>
                <span class="info-box-number"><?= (int) $counts['keterampilan'] ?> item</span>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-briefcase"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pengalaman</span>
                <span class="info-box-number"><?= (int) $counts['pengalaman'] ?> item</span>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Kelola bagian CV</h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>Bagian</th>
                    <th>Ringkasan</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Profil &amp; Meta</td>
                    <td><?= h($cv['person']['role']) ?></td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="<?= admin_url('profil.php') ?>">Kelola</a></td>
                </tr>
                <tr>
                    <td>Ringkasan</td>
                    <td><?php $t = $cv['ringkasan']['text']; echo h(strlen($t) > 60 ? substr($t, 0, 60) . '…' : $t); ?></td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="<?= admin_url('ringkasan.php') ?>">Kelola</a></td>
                </tr>
                <tr>
                    <td>Keterampilan</td>
                    <td><?= (int) $counts['keterampilan'] ?> item</td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="<?= admin_url('keterampilan.php') ?>">Kelola</a></td>
                </tr>
                <tr>
                    <td>Pengalaman</td>
                    <td><?= (int) $counts['pengalaman'] ?> item</td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="<?= admin_url('pengalaman.php') ?>">Kelola</a></td>
                </tr>
                <tr>
                    <td>Pendidikan</td>
                    <td><?= (int) $counts['pendidikan'] ?> baris</td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="<?= admin_url('pendidikan.php') ?>">Kelola</a></td>
                </tr>
                <tr>
                    <td>Portofolio</td>
                    <td><?= (int) $counts['portofolio'] ?> item</td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="<?= admin_url('portofolio.php') ?>">Kelola</a></td>
                </tr>
                <tr>
                    <td>Sertifikasi</td>
                    <td><?= (int) $counts['sertifikasi'] ?> item</td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="<?= admin_url('sertifikasi.php') ?>">Kelola</a></td>
                </tr>
                <tr>
                    <td>Organisasi</td>
                    <td><?= (int) $counts['organisasi'] ?> item</td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="<?= admin_url('organisasi.php') ?>">Kelola</a></td>
                </tr>
                <tr>
                    <td>Kontak</td>
                    <td><?= h($cv['kontak']['heading']) ?></td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="<?= admin_url('kontak.php') ?>">Kelola</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
