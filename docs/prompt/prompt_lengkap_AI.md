# Prompt Lengkap: Persiapan Materi dan Silabus Pemrograman Internet

Kamu adalah asisten yang membantu menyusun materi pembelajaran dan silabus mata kuliah **Pemrograman Internet** untuk Program Studi S1 Teknik Informatika, Fakultas Teknologi Informasi, Universitas Bale Bandung. Kerjakan dalam **dua fase** berikut secara berurutan.

---

## FASE 1: Pencarian dan Dokumentasi Sumber Terbuka

**Tujuan:** Mengumpulkan sumber belajar terbuka (open source) dari internet untuk setiap topik di bawah ini, lalu menuliskan semua sumber ke file **sumber_materi.md**.

**Aturan umum:**
- Cari hanya sumber yang **terbuka** (gratis, dokumentasi resmi, tutorial daring, repositori edukatif).
- Setiap sumber harus dilengkapi: **judul/nama**, **URL lengkap**, dan **ringkasan singkat** (1–2 kalimat) tentang isi sumber.
- Untuk poin yang mensyaratkan "minimal N sumber", pastikan jumlah sumber yang tercatat **≥ N**.
- Gunakan pencarian web atau pengetahuan terkini untuk menemukan URL yang valid dan relevan.

**Daftar pencarian (lakukan satu per satu):**

| No | Topik | Minimal jumlah sumber |
|----|--------|------------------------|
| 1  | Silabus OBE mengenai pemrograman internet | 2 |
| 2  | Materi pemrograman internet (umum) | 10 |
| 3  | Tutorial HTML untuk pemula | 10 |
| 4  | Tutorial CSS untuk pemula | 10 |
| 5  | Tutorial JavaScript untuk pemula | 10 |
| 6  | Tutorial PHP untuk pemula | 10 |
| 7  | Tutorial MySQL untuk pemula | 10 |
| 8  | Tutorial OOP PHP untuk pemula | 10 |
| 9  | Tutorial framework PHP untuk pemula | 10 |
| 10 | Tutorial framework JavaScript untuk pemula | 10 |
| 11 | Tutorial XAMPP untuk pemula | 10 |
| 12 | Tutorial Windsurf untuk pemula | 10 |
| 13 | Tutorial jQuery untuk pemula | 10 |
| 14 | Tutorial AdminLTE untuk pemula | 10 |
| 15 | Materi KKNI dari APTIKOM | Cari dan cantumkan sumber yang tersedia |
| 16 | Tutorial sistem informasi akademik perguruan tinggi sederhana | 10 |

**Output Fase 1:**  
Buat atau perbarui file **sumber_materi.md** di root proyek. Format disarankan:

```markdown
# Sumber Materi Pemrograman Internet

## 1. Silabus OBE – Pemrograman Internet
- [Judul Sumber](URL) — Ringkasan singkat.

## 2. Pemrograman Internet (Umum)
...

## 3. Tutorial HTML untuk Pemula
...
```

(Urutan dan penomoran sesuaikan dengan tabel di atas; pastikan setiap bagian memenuhi jumlah minimal sumber.)

---

## FASE 2: Penulisan Ulang Silabus (RPS) Pemrograman Internet

**Tujuan:** Menggunakan **hanya** sumber yang sudah tercatat di **sumber_materi.md** untuk menulis ulang file **silabus_pemrograman_internet.tex** agar konsisten dengan silabus OBE dan format yang ditetapkan.

**Ketentuan wajib:**

1. **Mata kuliah:** Silabus mata kuliah **Pemrograman Internet**.
2. **Institusi:** Program Studi **S1 Teknik Informatika**, **Fakultas Teknologi Informasi**, **Universitas Bale Bandung**.
3. **Pertemuan:** Terdiri dari **16 pertemuan**.
4. **Komposisi:** **70% praktik**, **30% teori** (tampilkan eksplisit di identitas dan di metode pembelajaran).
5. **Struktur isi:** Ikuti urutan dan poin dari **struktur_silabus_OBE.text**:
   - Identitas Mata Kuliah  
   - Capaian Pembelajaran Lulusan (CPL)  
   - Capaian Pembelajaran Mata Kuliah (CPMK)  
   - Sub-CPMK / Indikator Pencapaian  
   - Materi Pembelajaran (Bahan Kajian)  
   - Metode Pembelajaran  
   - Pengalaman Belajar Mahasiswa  
   - Kriteria, Indikator, dan Bobot Penilaian  
   - Evaluasi dan Refleksi Pembelajaran (opsional)  
   - Daftar Referensi  
6. **Format LaTeX:** Gunakan format dan paket dari **silabus.tex** (documentclass, paket, section, longtable, dll.). Judul RPS, nama program studi, fakultas, dan universitas harus: **Teknik Informatika**, **Fakultas Teknologi Informasi**, **Universitas Bale Bandung**.
7. **Daftar referensi:** Hanya cantumkan sumber yang **sudah tercantum di sumber_materi.md**. Format referensi mengikuti gaya yang dipakai di **silabus.tex** (mis. \textit{}, \url{}, penomoran daftar).

**Langkah yang harus dilakukan:**
1. Baca **sumber_materi.md** untuk memastikan daftar referensi yang boleh dipakai.
2. Baca **struktur_silabus_OBE.text** untuk urutan dan nama bagian.
3. Baca **silabus.tex** untuk format dokumen LaTeX (preamble, section, tabel penilaian, dll.).
4. Tulis ulang **silabus_pemrograman_internet.tex** sehingga:
   - Semua bagian struktur OBE terpenuhi,
   - Konten (CPL, CPMK, Sub-CPMK, materi per pertemuan, metode, pengalaman belajar, penilaian) selaras dengan mata kuliah Pemrograman Internet dan sumber di **sumber_materi.md**,
   - Rencana perkuliahan 16 pertemuan jelas (boleh gunakan tabel seperti di silabus_pemrograman_internet.tex yang ada),
   - Komposisi 70% praktik dan 30% teori tercermin di identitas dan metode pembelajaran,
   - Bagian "10. Daftar Referensi" hanya berisi sumber dari **sumber_materi.md**, diformat dalam LaTeX.

**Output Fase 2:**  
File **silabus_pemrograman_internet.tex** yang utuh dan dapat dikompilasi (mis. dengan pdflatex).

---

## Ringkasan Alur Kerja

1. **Fase 1:** Cari sumber terbuka untuk 16 topik → tulis ke **sumber_materi.md** (penuhi jumlah minimal per topik).
2. **Fase 2:** Berdasarkan **sumber_materi.md**, **struktur_silabus_OBE.text**, dan **silabus.tex**, tulis ulang **silabus_pemrograman_internet.tex** (OBE, 16 pertemuan, 70% praktik/30% teori, referensi hanya dari sumber_materi.md).

Jika ada poin yang kurang jelas, prioritaskan konsistensi dengan struktur OBE dan format **silabus.tex**, serta penggunaan hanya sumber yang tercatat di **sumber_materi.md**.
