<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/bootstrap.php';
require_once __DIR__ . '/layout.php';
cv_boot_app();
requireLogin();

$cv = loadCvData();
$itemCount = static function (array $section, string $key): int {
    return count($section[$key] ?? []);
};

adminLayoutStart('Dashboard', 'index');
?>
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
                <span class="info-box-number"><?= $itemCount($cv['keterampilan'], 'items') ?> item</span>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="fas fa-briefcase"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Pengalaman</span>
                <span class="info-box-number"><?= $itemCount($cv['pengalaman'], 'items') ?> item</span>
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
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="profil.php">Kelola</a></td>
                </tr>
                <tr>
                    <td>Ringkasan</td>
                    <td><?php $t = $cv['ringkasan']['text']; echo h(strlen($t) > 60 ? substr($t, 0, 60) . '…' : $t); ?></td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="ringkasan.php">Kelola</a></td>
                </tr>
                <tr>
                    <td>Keterampilan</td>
                    <td><?= $itemCount($cv['keterampilan'], 'items') ?> item</td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="keterampilan.php">Kelola</a></td>
                </tr>
                <tr>
                    <td>Pengalaman</td>
                    <td><?= $itemCount($cv['pengalaman'], 'items') ?> item</td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="pengalaman.php">Kelola</a></td>
                </tr>
                <tr>
                    <td>Pendidikan</td>
                    <td><?= $itemCount($cv['pendidikan'], 'rows') ?> baris</td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="pendidikan.php">Kelola</a></td>
                </tr>
                <tr>
                    <td>Portofolio</td>
                    <td><?= $itemCount($cv['portofolio'], 'items') ?> item</td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="portofolio.php">Kelola</a></td>
                </tr>
                <tr>
                    <td>Sertifikasi</td>
                    <td><?= $itemCount($cv['sertifikasi'], 'items') ?> item</td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="sertifikasi.php">Kelola</a></td>
                </tr>
                <tr>
                    <td>Organisasi</td>
                    <td><?= $itemCount($cv['organisasi'], 'items') ?> item</td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="organisasi.php">Kelola</a></td>
                </tr>
                <tr>
                    <td>Kontak</td>
                    <td><?= h($cv['kontak']['heading']) ?></td>
                    <td class="text-right"><a class="btn btn-sm btn-primary" href="kontak.php">Kelola</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
adminLayoutEnd();
