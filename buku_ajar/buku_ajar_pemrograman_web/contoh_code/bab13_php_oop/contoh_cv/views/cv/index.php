<?php use App\Support\CvFormatter; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= h($cv['metaDescription'] ?? '') ?>">
    <meta name="keywords" content="CV, Curriculum Vitae, PHP, AdminLTE, Mahasiswa">
    <meta name="author" content="<?= h($person['name']) ?>">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= h($cv['documentTitle']) ?>">
    <meta property="og:description" content="Contoh CV Bab 13: arsitektur MVC OOP PHP, data JSON, AdminLTE.">
    <meta property="og:locale" content="id_ID">
    <title><?= h($cv['documentTitle']) ?></title>
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Crect width='32' height='32' rx='4' fill='%231a365d'/%3E%3Ctext x='16' y='22' font-size='14' fill='white' text-anchor='middle' font-family='system-ui,sans-serif'%3ECV%3C/text%3E%3C/svg%3E" type="image/svg+xml">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="cv.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button" aria-label="Buka/tutup menu samping"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <span class="navbar-brand m-0 d-none d-sm-inline font-weight-light">Curriculum Vitae — Bab 13 (PHP OOP + MVC)</span>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4" aria-label="Profil dan navigasi">
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">CV</span>
            </a>
            <div class="sidebar">
                <div class="user-panel pb-3 mb-3 border-bottom border-secondary">
                    <div class="info text-white">
                        <h1 class="h5 mb-1"><?= h($person['name']) ?></h1>
                        <p class="mb-1 small"><strong><?= h($person['role']) ?></strong></p>
                        <p class="mb-2 small text-muted"><?= h($person['location']) ?></p>
                        <address class="small text-muted mb-0 cv-address-plain">
                            <span>Email: <a href="mailto:<?= h($person['email']) ?>"><?= h($person['email']) ?></a></span><br>
                            <span>Telepon: <a href="tel:<?= h($phoneHref) ?>"><?= h($person['phoneDisplay']) ?></a></span><br>
                            <span>Situs: <a href="<?= h($person['website']) ?>"><?= h($person['website']) ?></a></span><br>
                            <span>Alamat: <?= h($person['address']) ?></span>
                        </address>
                    </div>
                </div>
                <nav class="mt-2" aria-label="Navigasi CV">
                    <p class="nav-header text-uppercase text-xs text-muted px-3 mb-2">Isi halaman</p>
                    <ul class="nav nav-pills nav-sidebar flex-column">
                        <?php foreach ($cv['navItems'] as $item): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#<?= h($item['hash']) ?>"><?= h($item['label']) ?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Curriculum Vitae</h1>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <main id="cv-main">
                        <section id="ringkasan" class="card card-primary card-outline mb-3" aria-labelledby="judul-ringkasan">
                            <div class="card-header">
                                <h2 class="card-title h5 mb-0" id="judul-ringkasan"><?= h($cv['ringkasan']['heading']) ?></h2>
                            </div>
                            <div class="card-body">
                                <p class="mb-0"><?= h($cv['ringkasan']['text']) ?></p>
                            </div>
                        </section>

                        <section id="keterampilan" class="card card-primary card-outline mb-3" aria-labelledby="judul-keterampilan">
                            <div class="card-header">
                                <h2 class="card-title h5 mb-0" id="judul-keterampilan"><?= h($cv['keterampilan']['heading']) ?></h2>
                            </div>
                            <div class="card-body">
                                <dl id="cv-skills" class="mb-0">
                                    <?php foreach ($cv['keterampilan']['items'] as $item): ?>
                                    <dt><?= h($item['judul']) ?></dt>
                                    <dd><?= h($item['deskripsi']) ?></dd>
                                    <?php endforeach; ?>
                                </dl>
                            </div>
                        </section>

                        <section id="pengalaman" class="card card-primary card-outline mb-3" aria-labelledby="judul-pengalaman">
                            <div class="card-header">
                                <h2 class="card-title h5 mb-0" id="judul-pengalaman"><?= h($cv['pengalaman']['heading']) ?></h2>
                            </div>
                            <div class="card-body">
                                <div id="cv-experience">
                                    <?php foreach ($cv['pengalaman']['items'] as $i => $item): ?>
                                    <?php $hid = 'judul-pengalaman-' . ($i + 1); ?>
                                    <article class="<?= $i < count($cv['pengalaman']['items']) - 1 ? 'border-bottom pb-3 mb-3' : '' ?>" aria-labelledby="<?= h($hid) ?>">
                                        <h3 id="<?= h($hid) ?>"><?= h($item['judul']) ?></h3>
                                        <p>
                                            <time datetime="<?= h($item['mulai']['datetime']) ?>"><?= h($item['mulai']['label']) ?></time>
                                            –
                                            <time datetime="<?= h($item['selesai']['datetime']) ?>"><?= h($item['selesai']['label']) ?></time>
                                        </p>
                                        <ul>
                                            <?php foreach ($item['poin'] as $poin): ?>
                                            <li><?= h($poin) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </article>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </section>

                        <section id="pendidikan" class="card card-primary card-outline mb-3" aria-labelledby="judul-pendidikan">
                            <div class="card-header">
                                <h2 class="card-title h5 mb-0" id="judul-pendidikan"><?= h($cv['pendidikan']['heading']) ?></h2>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped table-bordered mb-0">
                                        <caption class="px-3 pt-2"><?= h($cv['pendidikan']['caption']) ?></caption>
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Jenjang</th>
                                                <th scope="col">Institusi</th>
                                                <th scope="col">Program/Jurusan</th>
                                                <th scope="col">Periode</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($cv['pendidikan']['rows'] as $row): ?>
                                            <tr>
                                                <td><?= h($row['jenjang']) ?></td>
                                                <td><?= h($row['institusi']) ?></td>
                                                <td><?= h($row['program']) ?></td>
                                                <td><?= CvFormatter::renderPeriodeSegments($row['periodeSegments']) ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </section>

                        <section id="portofolio" class="card card-primary card-outline mb-3" aria-labelledby="judul-portofolio">
                            <div class="card-header">
                                <h2 class="card-title h5 mb-0" id="judul-portofolio"><?= h($cv['portofolio']['heading']) ?></h2>
                            </div>
                            <div class="card-body">
                                <ul id="cv-portfolio-list" class="mb-0">
                                    <?php foreach ($cv['portofolio']['items'] as $item): ?>
                                    <li>
                                        <strong><?= h($item['judul']) ?></strong><br>
                                        <a href="<?= h($item['linkHref']) ?>"><?= h($item['linkText']) ?></a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </section>

                        <section id="sertifikasi" class="card card-primary card-outline mb-3" aria-labelledby="judul-sertifikasi">
                            <div class="card-header">
                                <h2 class="card-title h5 mb-0" id="judul-sertifikasi"><?= h($cv['sertifikasi']['heading']) ?></h2>
                            </div>
                            <div class="card-body">
                                <ul id="cv-sertifikasi-list" class="mb-0">
                                    <?php foreach ($cv['sertifikasi']['items'] as $item): ?>
                                    <li>
                                        <?= h($item['nama']) ?> —
                                        <time datetime="<?= h($item['datetime']) ?>"><?= h($item['tahun']) ?></time>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </section>

                        <section id="organisasi" class="card card-primary card-outline mb-3" aria-labelledby="judul-organisasi">
                            <div class="card-header">
                                <h2 class="card-title h5 mb-0" id="judul-organisasi"><?= h($cv['organisasi']['heading']) ?></h2>
                            </div>
                            <div class="card-body">
                                <ul id="cv-organisasi-list" class="mb-0">
                                    <?php foreach ($cv['organisasi']['items'] as $item): ?>
                                    <li>
                                        <?= h($item['teks']) ?>
                                        <?= CvFormatter::renderPeriodeSegments($item['periodeSegments']) ?>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </section>

                        <section id="kontak" class="card card-primary card-outline mb-3" aria-labelledby="judul-kontak">
                            <div class="card-header">
                                <h2 class="card-title h5 mb-0" id="judul-kontak"><?= h($cv['kontak']['heading']) ?></h2>
                            </div>
                            <div class="card-body">
                                <p class="mb-0">
                                    <?= h($cv['kontak']['intro']) ?>
                                    <a href="mailto:<?= h($person['email']) ?>"><?= h($person['email']) ?></a>.
                                </p>
                            </div>
                        </section>
                    </main>
                </div>
            </section>
        </div>

        <footer class="main-footer text-sm">
            <div class="container-fluid text-center">
                <p class="mb-0 text-muted">
                    &copy; <time datetime="<?= h((string) $cv['footer']['year']) ?>"><?= h((string) $cv['footer']['year']) ?></time>
                    <?= h($cv['footer']['text']) ?>
                    <code>data/cv-data.json</code> + MVC PHP (<code>CvModel</code>, <code>CvController</code>).
                </p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
