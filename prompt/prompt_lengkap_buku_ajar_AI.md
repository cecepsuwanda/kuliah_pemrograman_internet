# Prompt Lengkap: Penulisan Ulang Buku Ajar Pemrograman Internet

Kamu adalah asisten yang membantu menulis ulang **Buku Ajar Pemrograman Internet** untuk mata kuliah Pemrograman Internet, Program Studi S1 Teknik Informatika, Fakultas Teknologi Informasi, Universitas Bale Bandung. Gunakan referensi yang ada dan ikuti ketentuan berikut.

---

## Tujuan

Menulis ulang seluruh buku yang ada di folder **buku_ajar_pemrograman_internet** dengan memanfaatkan:
1. **sumber_materi.md** — daftar sumber belajar terbuka (referensi, tutorial, dokumentasi)
2. **silabus_pemrograman_internet.tex** — RPS mata kuliah (CPMK, Sub-CPMK, materi per pertemuan, metode pembelajaran)

---

## Ketentuan Wajib

### 1. Struktur Buku

Ikuti **struktur_bab_buku_ajar_OBE.text**:

| Bagian | Isi Utama |
|--------|-----------|
| **Bab I: Pendahuluan** | Tujuan buku, keterkaitan dengan RPS OBE, petunjuk belajar, konteks kurikulum OBE |
| **Bab II: Landasan Teori** | Konsep dan definisi kunci, teori utama, peta konsep/struktur materi |
| **Bab III–XIV: Materi Inti** | Outcome pembelajaran bab (Sub-CPMK), materi pokok, aktivitas pembelajaran, latihan, asesmen, checklist kompetensi |
| **Bab Akhir** | Asesmen akhir, rubrik penilaian, tinjauan pencapaian kompetensi, rekomendasi tindak lanjut |
| **Lampiran** | Rubrik penilaian, contoh tugas, glosarium, daftar referensi tambahan |

Setiap bab inti harus memuat: **Judul Bab**, **Outcome Pembelajaran Khusus (Sub-CPMK)**, **Materi Pokok**, **Aktivitas Pembelajaran**, **Soal Latihan & Refleksi**, **Asesmen**, **Checklist Pencapaian Kompetensi**.

### 2. Format Teknis

Ikuti format dokumen yang ada di folder **buku_ajar** (bukan buku_ajar_pemrograman_internet):
- Struktur file: `main.tex`, `preamble.tex`, `frontmatter.tex`, `backmatter.tex`, `lampiran.tex`, `bab/bab-NN.tex`, `bab/bab-NN/section-NN-MM.tex`
- Gunakan lingkungan LaTeX yang sama: `\section`, `\subsection`, `\begin{konsep}`, `\begin{figure}`, `\begin{table}`, `\begin{lstlisting}` atau sejenisnya untuk kode
- Gunakan `\cite{}` untuk referensi dari **references.bib**; pastikan semua referensi berasal dari **sumber_materi.md**
- Layout, font, dan paket LaTeX mengikuti **preamble.tex** dan contoh bab di **buku_ajar**

### 3. Fleksibilitas Struktur

Struktur bab (urutan, penamaan, atau pembagian subbab) **boleh diubah** selama:
- Ketentuan 1 (struktur OBE) tetap terpenuhi
- Ketentuan 2 (format mengikuti buku_ajar) tetap terpenuhi
- Konten selaras dengan **silabus_pemrograman_internet.tex** (CPMK, Sub-CPMK, materi 16 pertemuan)

---

## Karakteristik Konten

### 4. Buku Tutorial untuk Pemula

- Buku bersifat **tutorial** dan diperuntukkan bagi **pemula**
- Sediakan **banyak contoh** konkret: kode, langkah-langkah, studi kasus
- Gunakan bahasa yang jelas, bertahap, dan mudah diikuti
- Hindari penjelasan abstrak tanpa contoh

### 5. Kedalaman Penjelasan per Section

Untuk setiap **section** (atau subsection):

- **Jumlah paragraf:** minimal 2, maksimal 10
- **Jumlah kalimat per paragraf:** minimal 3
- Perjelas konsep dengan definisi, analogi, dan contoh
- Gunakan poin-poin atau daftar bila membantu pemahaman

### 6. Elemen Visual dan Contoh

Per section, tambahkan **minimal salah satu** (atau lebih bila relevan):

- **Gambar** — diagram, screenshot, ilustrasi konsep
- **Grafik** — flowchart, bagan alur proses
- **Tabel** — perbandingan, ringkasan, daftar istilah
- **Contoh kode** — snippet HTML, CSS, JavaScript, PHP, MySQL dengan penjelasan
- **Studi kasus** — contoh aplikasi atau masalah sederhana beserta solusinya

**Catatan:** Jika diperlukan gambar dari internet, boleh menggunakan skrip Python (misalnya `requests`, `urllib`, atau pustaka lain) untuk mengunduh gambar. Pastikan sumber gambar terbuka dan atribusi diberikan jika wajib.

---

## Referensi dan Pemetaan

1. **sumber_materi.md**  
   Gunakan hanya sumber yang tercantum di sini untuk referensi dan kutipan. Update **references.bib** agar sesuai dengan sumber_materi.md.

2. **silabus_pemrograman_internet.tex**  
   Gunakan sebagai acuan:
   - CPMK dan Sub-CPMK
   - Materi per pertemuan (16 pertemuan)
   - Urutan topik: Pengenalan web → HTML → CSS → JavaScript → PHP → MySQL → Integrasi → Keamanan → Proyek

3. **buku_ajar** (folder referensi format)  
   Contoh struktur bab, penggunaan lingkungan LaTeX, gaya penulisan, dan format gambar/tabel/kode.

---

## Ringkasan Langkah Kerja

1. Baca **struktur_bab_buku_ajar_OBE.text** — pastikan struktur bab sesuai OBE
2. Baca **buku_ajar** (main.tex, preamble, sample bab) — pastikan format LaTeX konsisten
3. Baca **sumber_materi.md** dan **silabus_pemrograman_internet.tex** — pastikan konten dan referensi selaras
4. Tulis ulang tiap file di **buku_ajar_pemrograman_internet** sesuai ketentuan di atas
5. Per section: 2–10 paragraf, minimal 3 kalimat/paragraf; tambahkan gambar/tabel/contoh kode/studi kasus
6. Update **references.bib** agar hanya memuat sumber dari **sumber_materi.md**

---

## Output yang Diharapkan

- Folder **buku_ajar_pemrograman_internet** berisi buku ajar yang utuh, konsisten dengan OBE, format LaTeX mengikuti buku_ajar, dan siap dikompilasi ke PDF
- Buku bersifat tutorial untuk pemula, kaya contoh, dan setiap section memenuhi syarat paragraf serta elemen visual
