# Prompt: Perdalam Bab 2 — Landasan Teori dan Konsep Dasar

Kamu adalah asisten yang membantu memperdalam **Bab 2 (Landasan Teori dan Konsep Dasar)** dari buku ajar di folder **buku_ajar_pemrograman_web/**. Ikuti seluruh ketentuan di bawah ini.

---

## Tujuan

Memperdalam Bab 2 dengan memanfaatkan:
1. **Referensi** dari `buku_ajar_pemrograman_web/references.bib`
2. **Sumber terbuka di internet** (MDN, web.dev, W3Schools, dokumentasi resmi, tutorial, dll.)
3. **Elemen visual kaya**: gambar, grafik, tabel, contoh, contoh coding, dan studi kasus
4. **Download gambar** menggunakan skrip Python jika diperlukan (misalnya diagram dari sumber online, screenshot ilustrasi)

---

## Konteks Bab 2

Bab 2 berjudul **"Landasan Teori dan Konsep Dasar"** dan mencakup **Sub-CPMK**:
- Sub-CPMK 1.1: Mengidentifikasi kebutuhan fungsional dan non-fungsional pengguna untuk solusi web.
- Sub-CPMK 2.1: Membuat halaman web dengan HTML5 (struktur, elemen semantik, form, media).

Menurut **struktur_bab_buku_ajar_OBE.text**, isi utama Bab II harus mencakup:
1. Konsep dan definisi kunci materi pokok mata kuliah
2. Teori utama yang menjadi basis pembelajaran
3. Peta konsep atau bagan struktur materi

Baca seluruh isi Bab 2 saat ini: `bab/bab-02.tex` dan semua file di `bab/bab-02/section-2-N.tex`.

---

## Tugas

1. **Baca** Bab 2 dan referensi di `references.bib` serta sumber terbuka di internet
2. **Perdalam** penjelasan setiap section yang sudah ada; kembangkan menjadi minimal 2 paragraf (maksimal 10), masing-masing minimal 3 kalimat
3. **Tambahkan** elemen visual ke dalam section (distribusikan secara merata):
   - **Gambar** — diagram arsitektur, screenshot browser/DevTools, ilustrasi konsep (boleh didownload dengan Python)
   - **Grafik** — flowchart, bagan alur, diagram hubungan (gunakan TikZ atau gambar)
   - **Tabel** — perbandingan teknologi, ringkasan status code HTTP, daftar alat, perbandingan front-end vs back-end
   - **Contoh** — contoh konkret penggunaan konsep
   - **Contoh coding** — snippet HTML, CSS, JavaScript, PHP yang dapat dijalankan
   - **Studi kasus** — contoh aplikasi atau masalah nyata beserta solusinya
4. **Boleh hapus atau tambah section baru** selama:
   - Mengikuti struktur OBE di **struktur_bab_buku_ajar_OBE.text** (Bab II = Landasan Teori)
   - Format LaTeX mengikuti pola di **buku_ajar/** dan **buku_ajar_pemrograman_web/**
5. **Update `bab/bab-02.tex`** jika ada section baru: tambahkan `\input{bab/bab-02/section-2-N}`. Juga update bagian `\begin{aktivitas}`, `\begin{latihan}`, `\begin{asesmen}`, `\begin{checklist}`, dan `\begin{rangkuman}` agar selaras dengan isi section yang baru/diubah
6. **Update `references.bib`** jika menggunakan sumber baru; sertakan sitasi `\cite{key}` di section yang mengutip

---

## Aturan Penulisan per Section

### Jumlah Paragraf
- **Minimal 2 paragraf**, **maksimal 10 paragraf** per section.
- Setiap paragraf terdiri dari **minimal 3 kalimat**.

### Gaya Penulisan
- Buku bersifat **tutorial untuk pemula**; gunakan bahasa jelas, bertahap, dan mudah diikuti.
- Sertakan definisi, analogi, dan contoh konkret.
- Gunakan poin-poin atau daftar bila membantu pemahaman.

### Elemen Visual — Per Section Minimal 2 dari daftar berikut:

| Elemen | Contoh | LaTeX/Format |
|--------|--------|--------------|
| **Tabel** | Perbandingan metode HTTP, daftar status code, perbandingan teknologi | `\begin{tabular}`, kolom `P{Xcm}` |
| **Gambar** | Diagram arsitektur, screenshot DevTools, ilustrasi request-response | `\includegraphics` atau TikZ |
| **Grafik/Diagram** | Flowchart siklus HTTP, peta konsep teknologi web | `\begin{tikzpicture}` dengan style dari preamble |
| **Contoh kode** | Snippet HTML, CSS, JS, PHP, atau perintah Bash | `\begin{webcode}[language=..., caption={...}]` |
| **Studi kasus** | Contoh: "Aplikasi toko online—bagaimana request dari browser sampai ke database" | Paragraf naratif + diagram/flow |
| **Box** | Konsep penting, catatan, contoh | `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}` |

### Seluruh Bab 2 — Wajib ada:
- Minimal **2 gambar** (dapat berupa TikZ atau file gambar)
- Minimal **3 tabel**
- Minimal **3 contoh kode** (HTML, CSS, JS, atau kombinasi)
- Minimal **1 studi kasus** lengkap (masalah → solusi → implementasi)

---

## Download Gambar dengan Python

Jika memerlukan gambar dari internet (diagram, ilustrasi, screenshot konsep), buat skrip Python untuk mengunduhnya. Contoh skrip:

```python
# download_gambar.py
import requests
from pathlib import Path

def download_image(url, filename):
    """Download gambar dari URL dan simpan ke folder images/bab-02/"""
    folder = Path("buku_ajar_pemrograman_web/images/bab-02")
    folder.mkdir(parents=True, exist_ok=True)
    response = requests.get(url)
    response.raise_for_status()
    filepath = folder / filename
    with open(filepath, 'wb') as f:
        f.write(response.content)
    print(f"Downloaded: {filepath}")

# Contoh: download gambar jika ada URL sumber terbuka
# download_image("https://example.com/diagram.png", "arsitektur-client-server.png")
```

Aturan penggunaan gambar:
- Simpan di `buku_ajar_pemrograman_web/images/bab-02/` (buat folder jika belum ada)
- Gunakan format PNG, JPG, atau SVG
- Pastikan sumber gambar terbuka dan berhak digunakan (lisensi permissive, public domain, atau fair use)
- Jika wajib, sertakan atribusi/caption sumber
- Dalam LaTeX: `\includegraphics[width=\textwidth]{images/bab-02/nama-file.png}`

---

## Referensi dan Sitasi

### Referensi yang sudah ada di `references.bib`

Gunakan `\cite{key}` dari daftar berikut yang relevan:

| Key | Judul |
|-----|-------|
| `mdnLearn` | MDN Learn Web Development |
| `w3schoolsTutorials` | W3Schools Tutorials |
| `webdevLearn` | web.dev Learn Web Development |
| `mdnHtmlIntro` | Introduction to HTML |
| `webdevHtml` | web.dev Learn HTML |
| `mdnCss` | Styling the Web with CSS |
| `webdevCss` | web.dev Learn CSS |
| `jsInfo` | The Modern JavaScript Tutorial |
| `mdnJsGuide` | JavaScript Guide |
| `eloquentJs` | Eloquent JavaScript |
| `phpManual` | PHP Manual |
| `phpRightWay` | PHP The Right Way |
| `mysqlDocs` | MySQL Documentation |
| `mdnAccessibility` | Accessibility (Learn web development) |
| `webdevAccessibility` | web.dev Learn Accessibility |
| `whatwgHtml` | HTML Living Standard |
| `w3cCss` | W3C CSS Specifications |
| `w3cValidator` | W3C Markup Validation Service |
| `mdnToolsTesting` | Tools and testing (Learn web development) |
| `mdnDeploy` | Deploying to production |
| `owaspXss` | Cross Site Scripting Prevention Cheat Sheet |
| `owaspCsrf` | Cross-Site Request Forgery Prevention Cheat Sheet |
| `aptikomObe` | Panduan Kurikulum Berbasis OBE/KKNI/SKKNI |

### Sumber baru dari internet

Jika ada konsep yang perlu referensi tambahan di luar daftar di atas, **boleh** menggunakan sumber terbuka lain dari internet. Jika menambahkan sumber baru:
1. **Tambahkan entri baru di `references.bib`** dengan format yang sama (lihat contoh entri yang sudah ada).
2. **Gunakan `\cite{keyBaru}`** di section yang mengutipnya.

Contoh format entri baru di `references.bib`:
```bibtex
@misc{keyBaru,
  author = {Nama Penulis/Organisasi},
  title = {Judul Halaman atau Dokumen},
  year = {2026},
  howpublished = {\url{https://url-lengkap}}
}
```

---

## Saran Topik Section untuk Bab 2

Berikut saran topik section yang dapat digunakan (boleh disesuaikan, ditambah, atau dikurangi):

1. **Arsitektur Web: Client-Server dan Komunikasi HTTP** — konsep client-server, request-response cycle, URL, DNS
2. **Protokol HTTP: Metode, Status Code, dan Header** — GET, POST, PUT, DELETE; kode status 1xx–5xx; header penting; HTTPS
3. **Teknologi Front-End: HTML, CSS, dan JavaScript** — peran masing-masing, hubungan antar teknologi, contoh sederhana
4. **Teknologi Back-End: Server-Side Scripting dan Basis Data** — peran PHP, MySQL sebagai RDBMS, konsep API
5. **Siklus Pengembangan Web (SDLC untuk Web)** — tahapan: analisis → desain → implementasi → pengujian → deployment → pemeliharaan
6. **Alat Pengembangan Web** — editor kode, browser DevTools, server lokal (XAMPP), version control (Git), terminal
7. **Standar Web dan Organisasi Terkait** — W3C, WHATWG, IETF/RFC, ECMA; peran standar dalam interoperabilitas
8. **Peta Konsep: Hubungan Antar Teknologi Web** — diagram/bagan yang menghubungkan HTML, CSS, JS, PHP, MySQL, HTTP, browser, server
9. **Keamanan Web: Pengenalan Konsep Dasar** — ancaman umum (XSS, SQL injection, CSRF); prinsip defense in depth
10. **Aksesibilitas dan Performa: Prinsip Dasar** — WCAG, HTML semantik; metrik performa dasar

---

## Format File Output

- Setiap section ditulis dalam file terpisah: `bab/bab-02/section-2-N.tex`
- File utama bab: `bab/bab-02.tex` — harus di-update dengan `\input{bab/bab-02/section-2-N}` untuk setiap section
- Kode inline: `\code{...}` (didefinisikan di preamble sebagai `\texttt`)
- Tabel: `tabular` dengan `\hline` dan kolom `P{Xcm}` (ragged right)
- Gambar: `\begin{figure}[ht] \centering \includegraphics[width=...]{path} \caption{...} \end{figure}`
- Diagram: `tikzpicture` dengan style `class`, `object`, `arrow` dari preamble
- Kode program: `\begin{webcode}[language=HTML|CSS|JavaScript|PHP|SQL|Bash, caption={...}]`
- Box highlight: `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}`

---

## Contoh Pola Section (Referensi)

```latex
\section{Judul Section}
Paragraf pertama dengan penjelasan konsep utama dan sitasi \cite{mdnLearn}.

Paragraf kedua dengan detail tambahan, contoh, atau penjelasan lebih lanjut \cite{webdevLearn}.

\begin{table}[ht]
\centering
\begin{tabular}{|P{4cm}|P{8cm}|}
\hline
\textbf{Kolom 1} & \textbf{Kolom 2} \\
\hline
Item 1 & Deskripsi 1 \\
\hline
Item 2 & Deskripsi 2 \\
\hline
\end{tabular}
\caption{Judul tabel}
\end{table}
```

```latex
\section{Judul Section dengan Kode}
Paragraf penjelasan konsep \cite{mdnHtmlIntro}.

Paragraf detail tambahan.

\begin{webcode}[language=HTML, caption={Contoh kode}]
<!DOCTYPE html>
<html lang="id">
<head><title>Contoh</title></head>
<body><p>Halo dunia!</p></body>
</html>
\end{webcode}
```

---

## Contoh Studi Kasus

Format studi kasus yang disarankan:

```latex
\begin{contoh}
\textbf{Studi Kasus: Memahami Alur Request dari Browser ke Database}

Seorang pengguna membuka halaman daftar produk di toko online. Berikut alur yang terjadi:

\begin{enumerate}
  \item Browser mengirim HTTP GET ke \code{https://toko.com/produk}
  \item Server web (Apache) menerima request dan meneruskan ke skrip PHP
  \item PHP menjalankan query SELECT ke MySQL untuk mengambil data produk
  \item PHP merender HTML dengan data tersebut dan mengirim response ke browser
  \item Browser menerima HTML, mengunduh CSS/JS, lalu menampilkan halaman
\end{enumerate}

Diagram berikut mengilustrasikan alur tersebut.
\begin{center}
% TikZ diagram atau \includegraphics
\end{center}
\end{contoh}
```

---

## Struktur OBE (struktur_bab_buku_ajar_OBE.text)

Bab 2 adalah **Bab II: Landasan Teori dan Konsep Dasar**. Pastikan:

- Materi mencakup konsep dan definisi kunci, teori utama, dan peta konsep
- Tetap ada: Sub-CPMK, materi pokok, aktivitas pembelajaran, latihan, asesmen, checklist, rangkuman
- Update `\begin{aktivitas}`, `\begin{latihan}`, `\begin{asesmen}`, `\begin{checklist}`, `\begin{rangkuman}` di `bab-02.tex` agar selaras dengan section yang ditambah/diubah

---

## Checklist Sebelum Selesai

- [ ] Setiap section memiliki 2–10 paragraf, masing-masing minimal 3 kalimat
- [ ] Setiap section memiliki minimal 2 elemen visual (tabel/diagram/kode/studi kasus/box)
- [ ] Minimal 2 gambar, 3 tabel, 3 contoh kode, 1 studi kasus di seluruh bab
- [ ] Semua `\cite{key}` merujuk ke entri yang ada di `references.bib`
- [ ] Jika ada sumber baru, entri baru sudah ditambahkan ke `references.bib` dan disitasi
- [ ] File `bab/bab-02.tex` sudah di-update: daftar `\input`, aktivitas, latihan, asesmen, checklist, rangkuman
- [ ] Gambar (jika didownload) disimpan di `images/bab-02/` dan path di LaTeX benar
- [ ] Tidak ada overfull/underfull hbox yang parah (hindari kalimat inline code yang terlalu panjang; pecah jika perlu)
- [ ] Format mengikuti buku_ajar (preamble, struktur bab)
- [ ] Kompilasi LaTeX berhasil tanpa error
