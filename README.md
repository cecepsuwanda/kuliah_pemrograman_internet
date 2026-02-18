# Kuliah Pemrograman Internet

Repositori materi kuliah **Pemrograman Internet** untuk Program Studi S1 Teknik Informatika, Fakultas Teknologi Informasi, Universitas Bale Bandung. Berisi Rencana Pembelajaran Semester (RPS) berbasis OBE dan Buku Ajar yang selaras dengan silabus.

---

## Identitas Mata Kuliah

| Informasi | Keterangan |
|-----------|------------|
| Program Studi | Teknik Informatika |
| Fakultas | Teknologi Informasi |
| Universitas | Universitas Bale Bandung |
| Mata Kuliah | Pemrograman Internet |
| SKS | 2 SKS |
| Jumlah Pertemuan | 16 pertemuan |

---

## Struktur Repositori

```
kuliah_pemrograman_internet/
├── silabus_pemrograman_internet.tex   # RPS berbasis OBE
├── silabus.tex                        # Template format RPS
├── struktur_silabus_OBE.text          # Kerangka struktur silabus OBE
├── struktur_bab_buku_ajar_OBE.text    # Kerangka struktur bab buku ajar OBE
├── buku_ajar_pemrograman_internet/    # Buku ajar LaTeX
│   ├── main.tex                       # Dokumen utama
│   ├── preamble.tex                   # Pengaturan LaTeX
│   ├── frontmatter.tex                # Halaman depan, kata pengantar, identitas
│   ├── backmatter.tex                 # Daftar pustaka
│   ├── lampiran.tex                   # Lampiran (rubrik, glosarium, referensi)
│   ├── references.bib                 # Referensi BibTeX (50 sumber terbuka)
│   └── bab/                           # Bab-bab buku ajar
│       ├── bab-01/                    # Pendahuluan dan Orientasi
│       ├── bab-02/                    # Landasan Teori
│       ├── bab-03/ ... bab-14/        # Unit materi inti
│       └── bab-14/                    # Evaluasi dan Integrasi
└── README.md
```

---

## Struktur Silabus OBE (RPS)

Mengacu pada `struktur_silabus_OBE.text` dan standar BAN-PT/LAM, RPS memuat 10 bagian:

1. **Identitas Mata Kuliah** — Nama prodi, mata kuliah, kode, semester, SKS, dosen
2. **Capaian Pembelajaran Lulusan (CPL)** — Pengetahuan, keterampilan, sikap
3. **Capaian Pembelajaran Mata Kuliah (CPMK)** — Kompetensi spesifik per mata kuliah
4. **Sub-CPMK / Indikator Pencapaian** — Indikator terukur dan teruji
5. **Materi Pembelajaran** — Topik yang relevan dengan Sub-CPMK/CPMK
6. **Metode Pembelajaran** — Strategi (ceramah, PBL, praktikum, dll.)
7. **Pengalaman Belajar Mahasiswa** — Tugas dan aktivitas belajar
8. **Kriteria, Indikator, dan Bobot Penilaian** — Asesmen dan bobot
9. **Evaluasi dan Refleksi Pembelajaran** — Formatif, sumatif, perbaikan
10. **Daftar Referensi** — 50 sumber terbuka daring (MDN, OWASP, W3C, PHP, Node.js, dll.)

---

## Struktur Buku Ajar OBE

Mengacu pada `struktur_bab_buku_ajar_OBE.text`, buku ajar tersusun sebagai berikut:

### Bab I: Pendahuluan dan Orientasi Buku
- Tujuan buku ajar
- Keterkaitan dengan RPS berbasis OBE
- Cara menggunakan buku ajar
- Ringkasan konteks kurikulum OBE

### Bab II: Landasan Teori
- Arsitektur web dan protokol HTTP
- Model client-server, peran client-side dan server-side

### Bab III–XIV: Unit Materi Inti
Setiap bab inti mencakup:
- **Sub-CPMK** — Outcome pembelajaran khusus bab
- **Materi Pokok** — Materi rinci dengan contoh, gambar, tabel, diagram, kode
- **Aktivitas Pembelajaran** — Latihan, studi kasus, praktik
- **Soal Latihan & Refleksi**
- **Asesmen** — Instrumen pengukuran Sub-CPMK
- **Checklist Pencapaian Kompetensi**

### Pemetaan Bab ke Silabus

| Bab | Judul | Sub-CPMK |
|-----|-------|----------|
| I | Pendahuluan dan Orientasi | - |
| II | Landasan Teori: Arsitektur Web dan HTTP | 1.1, 1.2 |
| III | HTML5: Struktur dan Elemen Dasar | 2.1 |
| IV | HTML5: Form dan Elemen Input | 2.1, 2.3 |
| V | CSS3: Dasar dan Box Model | 2.2 |
| VI | CSS3: Flexbox, Grid, Desain Responsif | 2.2 |
| VII | JavaScript: Sintaks dan DOM | 2.3 |
| VIII | JavaScript: Event Handling dan Validasi Form | 2.3 |
| IX | Pemrograman Server-Side (PHP/Node.js) | 3.1 |
| X | Integrasi Basis Data dan CRUD | 3.1, 3.2 |
| XI | Session, Cookie, dan Autentikasi | 4.2 |
| XII | REST API dan Konsumsi dari Client | 4.1 |
| XIII | Keamanan Web | 4.2 |
| XIV | Evaluasi, Refleksi, dan Integrasi Kompetensi | Semua CPMK |

### Lampiran
- Rubrik penilaian tugas praktik web
- Template laporan tugas
- Glosarium istilah pemrograman web
- Daftar referensi tambahan

---

## Kompilasi LaTeX

### Persyaratan
- TeX Live atau MiKTeX
- Paket: `babel`, `geometry`, `hyperref`, `subfiles`, `listings`, `tikz`, `tcolorbox`, `fancyhdr`, `longtable`, `enumitem`, `xurl`

### Perintah kompilasi

```bash
cd buku_ajar_pemrograman_internet
pdflatex main.tex
bibtex main
pdflatex main.tex
pdflatex main.tex
```

Atau gunakan skrip/alat build yang tersedia (mis. `compile_main.bat` atau LaTeX Workshop di VS Code).

---

## CPL dan CPMK (Ringkasan)

**CPL:** Pengetahuan arsitektur web dan HTTP; keterampilan merancang dan mengimplementasikan aplikasi web; sikap tanggung jawab dan kerja sama.

**CPMK-1:** Memahami arsitektur web, HTTP, peran client-side dan server-side.  
**CPMK-2:** Merancang dan membangun antarmuka web dengan HTML, CSS, JavaScript (responsif, aksesibel).  
**CPMK-3:** Mengimplementasikan logika server-side dan integrasi basis data dengan front-end.  
**CPMK-4:** Membangun dan mengonsumsi API (REST), menerapkan keamanan dasar (autentikasi, validasi, HTTPS).

---

## Referensi

Buku ajar dan silabus menggunakan 50 referensi sumber terbuka dari internet, antara lain:
- MDN Web Docs (HTML, CSS, JavaScript, HTTP, Fetch API)
- OWASP (keamanan web, XSS, CSRF, SQL injection, REST, validasi)
- W3C, WHATWG (standar HTML, CSS, aksesibilitas)
- PHP Manual, Node.js, Express, MySQL
- Vue.js, React, Bootstrap
- FreeCodeCamp, web.dev, JavaScript.info, Eloquent JavaScript
- Dan sumber daring lainnya

---

## Lisensi

Materi ini digunakan untuk keperluan pembelajaran di Universitas Bale Bandung.
