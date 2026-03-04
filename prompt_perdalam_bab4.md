# Prompt: Perdalam Bab 4 — HTML Dasar dan Struktur Dokumen (Visual Lengkap)

Kamu adalah asisten yang membantu memperdalam **Bab 4 (HTML Dasar dan Struktur Dokumen)** dari buku ajar di folder **buku_ajar_pemrograman_web/**. Ikuti seluruh ketentuan di bawah ini. Gunakan **prompt_perdalam_bab2.md** sebagai referensi format dan aturan penulisan.

---

## Tujuan

Memperdalam Bab 4 dengan memanfaatkan:
1. **Referensi** dari `buku_ajar_pemrograman_web/references.bib`
2. **Sumber terbuka di internet** (MDN HTML, web.dev, WHATWG, W3C, tutorial, dll.)
3. **Elemen visual kaya**: gambar, grafik, tabel, contoh, contoh coding, dan studi kasus
4. **Download gambar** menggunakan skrip Python jika diperlukan (screenshot browser, diagram DOM, ilustrasi struktur HTML)

---

## Konteks Bab 4

Bab 4 saat ini berjudul **"HTML Dasar dan Struktur Dokumen"** dan memiliki 12 section:
- Section 4-1: Pengenalan HTML dan Perannya di Web
- Section 4-2: Memulai: Editor, Browser, dan File HTML
- Section 4-3: Sintaks Dasar HTML: Tag, Elemen, dan Atribut
- Section 4-4: Struktur Dokumen HTML5
- Section 4-5: Bagian Head dan Metadata Halaman
- Section 4-6: Heading dan Paragraf
- Section 4-7: Teks: Emphasis, Importance, dan Format Dasar
- Section 4-8: Daftar: Unordered, Ordered, dan Description List
- Section 4-9: Fitur Teks Lanjutan: Kutipan, Kode, Subscript, Superscript
- Section 4-10: Membuat Link (Hyperlink) dan Praktik Terbaik
- Section 4-11: Gambar: Elemen img dan figure
- Section 4-12: Elemen Semantik dan Struktur Halaman

**Masalah saat ini:** Setiap section hanya berisi **2 paragraf pendek** (6–28 baris) dan sangat dangkal. Sebagian besar section hanya memiliki 1 elemen visual (webcode), beberapa bahkan tidak memiliki elemen visual sama sekali (section 4-1, 4-2, 4-5).

Bab ini mencakup **Sub-CPMK**:
- Sub-CPMK 2.1: Membuat halaman web dengan HTML5 (struktur, elemen semantik, form, media).

Menurut **struktur_bab_buku_ajar_OBE.text**, Bab III–XV adalah unit materi inti yang harus mencakup: Judul Bab, Sub-CPMK, Materi Pokok (rinci dengan contoh, ilustrasi, grafik, atau kasus), Aktivitas Pembelajaran, Soal Latihan & Refleksi, Asesmen, Checklist Pencapaian Kompetensi.

Baca seluruh isi Bab 4: `bab/bab-04.tex` dan semua file `bab/bab-04/section-4-*.tex`.

---

## Tugas Utama

1. **Baca** Bab 4 dan referensi di `references.bib` serta sumber terbuka di internet
2. **Perdalam** penjelasan setiap section; kembangkan menjadi 2–10 paragraf (masing-masing minimal 3 kalimat) dengan definisi, contoh, analogi, dan elemen visual
3. **Tambahkan** elemen visual ke dalam section (distribusikan secara merata):
   - **Gambar** — screenshot browser menampilkan HTML, diagram struktur DOM, ilustrasi hierarki heading, contoh tampilan elemen (boleh didownload dengan Python)
   - **Grafik** — flowchart alur render HTML, diagram pohon elemen (parent-child), bagan perbandingan elemen
   - **Tabel** — perbandingan tag vs elemen vs atribut, daftar elemen semantik, atribut penting `img` dan `a`, perbandingan `em` vs `i`, `strong` vs `b`
   - **Contoh** — contoh konkret penggunaan setiap elemen
   - **Contoh coding** — snippet HTML lengkap yang dapat dijalankan
   - **Studi kasus** — halaman profil lengkap, artikel blog dengan struktur semantik, atau halaman landing dengan link dan gambar (minimal 1–2 studi kasus)
4. **Boleh hapus, gabung, atau tambah section baru** selama mengikuti struktur OBE dan format di **buku_ajar/** (jumlah section akhir 10–15)
5. **Update `bab/bab-04.tex`** jika ada perubahan section; update `\begin{aktivitas}`, `\begin{latihan}`, `\begin{asesmen}`, `\begin{checklist}`, `\begin{rangkuman}`
6. **Update `references.bib`** jika menggunakan sumber baru; sertakan sitasi `\cite{key}` di section yang mengutip

---

## Download Gambar dengan Python

Jika memerlukan gambar (screenshot konsep, diagram struktur HTML, ilustrasi), buat skrip Python untuk mengunduhnya:

```python
# download_gambar_bab4.py
import requests
from pathlib import Path

def download_image(url, filename):
    """Download gambar dan simpan ke folder images/bab-04/"""
    folder = Path("buku_ajar_pemrograman_web/images/bab-04")
    folder.mkdir(parents=True, exist_ok=True)
    response = requests.get(url)
    response.raise_for_status()
    filepath = folder / filename
    with open(filepath, 'wb') as f:
        f.write(response.content)
    print(f"Downloaded: {filepath}")
```

Aturan: Simpan di `buku_ajar_pemrograman_web/images/bab-04/`; format PNG, JPG, atau SVG; pastikan sumber terbuka. LaTeX: `\includegraphics[width=\textwidth]{images/bab-04/nama-file.png}`

---

## Elemen Visual yang Wajib Diterapkan

### Per Section — Minimal 2 dari daftar berikut:

| Elemen | Contoh untuk Bab 4 | LaTeX/Format |
|--------|-------------------|--------------|
| **Tabel** | Perbandingan elemen heading, atribut link/gambar, elemen semantik | `\begin{tabular}`, kolom `P{Xcm}` |
| **Gambar** | Screenshot browser, diagram struktur HTML, ilustrasi DOM | `\includegraphics` atau TikZ |
| **Grafik/Diagram** | Pohon elemen HTML, flowchart struktur dokumen | `\begin{tikzpicture}` |
| **Contoh kode** | Snippet HTML (struktur, daftar, link, gambar, semantik) | `\begin{webcode}[language=HTML, caption={...}]` |
| **Studi kasus** | Halaman profil/artikel/landing lengkap dengan semua elemen | Paragraf naratif + kode + diagram |
| **Box** | Konsep penting, catatan aksesibilitas, praktik terbaik | `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}` |

### Seluruh Bab 4 — Wajib ada:

- Minimal **2 gambar** (screenshot, diagram, atau TikZ)
- Minimal **4 tabel** (elemen, atribut, perbandingan, ringkasan)
- Minimal **5 contoh kode** HTML
- Minimal **1 studi kasus** lengkap (misalnya: "Membangun halaman profil dengan HTML5")

---

## Aturan Penulisan per Section

- **Jumlah paragraf**: minimal 2, maksimal 10; setiap paragraf minimal 3 kalimat
- **Gaya**: tutorial untuk pemula; bahasa jelas, bertahap; sertakan definisi, analogi, contoh konkret; jelaskan *mengapa* sesuatu penting
- **Elemen visual**: per section minimal 2 elemen (tabel/gambar/grafik/kode/studi kasus/box)

---

## Referensi dan Sitasi

### Prioritas: gunakan dari `references.bib`

| Key | Judul | Relevansi |
|-----|-------|-----------|
| `mdnHtmlIntro` | Introduction to HTML | Sintaks, struktur, elemen dasar |
| `webdevHtml` | web.dev Learn HTML | Praktik terbaik, semantik |
| `whatwgHtml` | HTML Living Standard | Spesifikasi resmi |
| `mdnLearn` | MDN Learn Web Development | Konteks umum |
| `mdnAccessibility` | Accessibility | Elemen semantik, alt text |
| `w3cValidator` | W3C Markup Validation | Validasi HTML |
| `webdevAccessibility` | web.dev Learn Accessibility | Aksesibilitas HTML |
| `mdnCss` | Styling the Web with CSS | Konteks styling |
| `aptikomObe` | Panduan Kurikulum Berbasis OBE | Konteks OBE |

### Sumber baru dari internet

Jika menambahkan sumber baru: tambahkan entri di `references.bib` dan gunakan `\cite{key}`.

---

## Saran Topik Section untuk Bab 4

1. **Pengenalan HTML dan Sejarah Singkat** — apa itu HTML, sejarah hingga HTML5, peran di ekosistem web
2. **Memulai: Editor, Browser, dan File HTML Pertama** — editor, file `.html`, workflow dasar
3. **Sintaks Dasar HTML: Tag, Elemen, dan Atribut** — anatomi elemen, void elements, nesting
4. **Struktur Dokumen HTML5** — doctype, html, head, body; contoh dokumen minimal
5. **Bagian Head: Metadata, Title, dan Link Eksternal** — meta, title, link, charset, viewport, SEO dasar
6. **Heading, Paragraf, dan Hierarki Konten** — h1–h6, p; hierarki untuk aksesibilitas dan SEO
7. **Pemformatan Teks: Emphasis, Strong, dan Elemen Inline** — em, strong, mark, code; perbedaan semantik vs visual
8. **Daftar: Ordered, Unordered, dan Description List** — ul, ol, dl; nesting, atribut type, start, reversed
9. **Fitur Teks Lanjutan: Kutipan, Kode, dan Karakter Khusus** — blockquote, q, pre, code, sub, sup; entity HTML
10. **Hyperlink: Navigasi dan Penghubung Dokumen** — a, href, target, rel; link internal/eksternal/anchor
11. **Gambar dan Media Dasar** — img, src, alt, figure, figcaption; format gambar
12. **Elemen Semantik HTML5 dan Struktur Halaman** — header, nav, main, article, section, aside, footer

---

## Format File Output

- Setiap section: `bab/bab-04/section-4-N.tex`; file utama: `bab/bab-04.tex`
- Kode inline: `\code{...}`; tabel: `tabular` dengan `\hline`, kolom `P{Xcm}`
- Diagram: `tikzpicture` dengan style dari preamble
- Kode program: `\begin{webcode}[language=HTML, caption={...}]`
- Box: `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}`

---

## Contoh Pola Section

```latex
\section{Judul Section}
Paragraf pertama dengan penjelasan konsep utama dan sitasi \cite{mdnHtmlIntro}.

Paragraf kedua dengan detail tambahan \cite{webdevHtml}.

\begin{webcode}[language=HTML, caption={Contoh kode}]
<!DOCTYPE html>
<html lang="id">
<head><title>Contoh</title></head>
<body><p>Halo dunia!</p></body>
</html>
\end{webcode}
```

---

## Contoh Studi Kasus untuk Bab 4

```latex
\begin{contoh}
\textbf{Studi Kasus: Halaman Profil Sederhana dengan HTML5}

Buat halaman profil yang memuat: judul (h1), deskripsi (paragraf), daftar keahlian (ul), link ke media sosial (a), foto profil (img dengan figure), dan struktur semantik (header, main, footer).

\begin{enumerate}
  \item Struktur: doctype, html lang="id", head (charset, viewport, title), body
  \item Header: judul h1 dan nav dengan link
  \item Main: section berisi paragraf, daftar, dan figure (img + figcaption)
  \item Footer: copyright dan link eksternal (rel="noopener noreferrer")
\end{enumerate}
\end{contoh}
```

---

## Struktur OBE

Bab 4 adalah **unit materi inti**. Pastikan Sub-CPMK 2.1 tercakup; update aktivitas, latihan, asesmen, checklist, rangkuman di `bab-04.tex`.

---

## Checklist Sebelum Selesai

- [ ] Setiap section memiliki 2–10 paragraf, masing-masing minimal 3 kalimat
- [ ] Setiap section memiliki minimal 2 elemen visual
- [ ] Minimal 2 gambar, 4 tabel, 5 contoh kode di seluruh bab
- [ ] Minimal 1 studi kasus lengkap
- [ ] Semua `\cite{key}` merujuk ke entri di `references.bib`
- [ ] Sumber baru (jika ada) ditambahkan ke `references.bib` dan disitasi
- [ ] File `bab/bab-04.tex` di-update: `\input`, aktivitas, latihan, asesmen, checklist, rangkuman
- [ ] Gambar disimpan di `images/bab-04/` dan path di LaTeX benar
- [ ] Format mengikuti buku_ajar
- [ ] Tidak ada overfull/underfull hbox yang parah
- [ ] Kompilasi LaTeX berhasil tanpa error
