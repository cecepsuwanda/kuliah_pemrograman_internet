# Prompt: Perdalam Bab 5 — HTML Form, Media, dan Aksesibilitas (Visual Lengkap)

Kamu adalah asisten yang membantu memperdalam **Bab 5 (HTML Form, Media, dan Aksesibilitas)** dari buku ajar di folder **buku_ajar_pemrograman_web/**. Ikuti seluruh ketentuan di bawah ini. Gunakan **prompt_perdalam_bab2.md** sebagai referensi format dan aturan penulisan.

---

## Tujuan

Memperdalam Bab 5 dengan memanfaatkan:
1. **Referensi** dari `buku_ajar_pemrograman_web/references.bib`
2. **Sumber terbuka di internet** (MDN, web.dev, W3Schools, WHATWG, W3C Validator, dokumentasi, tutorial)
3. **Elemen visual kaya**: gambar, grafik, tabel, contoh, contoh coding, dan studi kasus
4. **Download gambar** menggunakan skrip Python jika diperlukan (screenshot form/tabel, diagram struktur HTML, ilustrasi aksesibilitas)

---

## Konteks Bab 5

Bab 5 saat ini berjudul **"HTML Form, Media, dan Aksesibilitas"** dan memiliki 13 section:

| # | Judul Section | Paragraf | Visual |
|---|---------------|----------|--------|
| 5-1 | Tabel HTML: Dasar (Baris, Sel, Header) | 2 | webcode |
| 5-2 | Tabel: Pengelompokan, Scope, dan Aksesibilitas | 2 | webcode |
| 5-3 | Form HTML: Elemen form, input, label, dan button | 2 | webcode |
| 5-4 | Form: Tipe input, select, textarea, dan validasi dasar | 2 | webcode |
| 5-5 | Struktur Halaman dengan Elemen Semantik | 2 | webcode |
| 5-6 | Media: Audio dan Video | 2 | webcode |
| 5-7 | Gambar Vektor (SVG) dalam HTML | 2 | webcode |
| 5-8 | Embedding: iframe, object, dan embed | 3 | webcode |
| 5-9 | Aksesibilitas (a11y): Prinsip dan Praktik | 2 | — |
| 5-10 | Aksesibilitas Tabel dan Form | 2 | — |
| 5-11 | Validasi HTML dan Alat Validator | 2 | — |
| 5-12 | Debugging HTML: Menemukan dan Memperbaiki Error | 2 | — |
| 5-13 | Best Practices HTML dan Standar (WHATWG / W3C) | 2 | — |

**Masalah utama:** Sebagian besar section hanya 2 paragraf; section 5-9 sampai 5-13 tidak punya elemen visual. Variasi sitasi rendah.

Bab ini mencakup **Sub-CPMK**:
- Sub-CPMK 2.1: Membuat halaman web dengan HTML5 (struktur, elemen semantik, form, media)
- Sub-CPMK 1.3: Menerapkan prinsip aksesibilitas (a11y) dan pengalaman pengguna (UX)

Baca seluruh isi Bab 5: `bab/bab-05.tex` dan semua file `bab/bab-05/section-5-*.tex`.

---

## Tugas Utama

1. **Baca** Bab 5 dan referensi di `references.bib` serta sumber terbuka di internet
2. **Perdalam** penjelasan setiap section; kembangkan menjadi 2–10 paragraf (masing-masing minimal 3 kalimat)
3. **Tambahkan** elemen visual ke dalam section (terutama 5-9 s.d. 5-13):
   - **Gambar** — screenshot form/tabel hasil render, diagram struktur HTML semantik
   - **Grafik** — flowchart submit form, diagram hierarchy elemen semantik
   - **Tabel** — perbandingan tipe input HTML5, atribut form, perbandingan media (audio/video/SVG)
   - **Contoh coding** — tabel, form, media, SVG, iframe
   - **Studi kasus** — form pendaftaran, halaman dengan tabel + media, halaman aksesibel (minimal 1–2)
4. **Boleh hapus atau tambah section baru** selama mengikuti struktur OBE dan format LaTeX
5. **Update `bab/bab-05.tex`** dan **`references.bib`** jika ada perubahan

---

## Download Gambar dengan Python

```python
# download_gambar_bab5.py
import requests
from pathlib import Path

def download_image(url, filename):
    """Download gambar dari URL dan simpan ke folder images/bab-05/"""
    folder = Path("buku_ajar_pemrograman_web/images/bab-05")
    folder.mkdir(parents=True, exist_ok=True)
    response = requests.get(url)
    response.raise_for_status()
    filepath = folder / filename
    with open(filepath, 'wb') as f:
        f.write(response.content)
    print(f"Downloaded: {filepath}")
```

Aturan: Simpan di `buku_ajar_pemrograman_web/images/bab-05/`; format PNG, JPG, SVG; LaTeX: `\includegraphics[width=0.8\textwidth]{images/bab-05/nama-file.png}`

---

## Elemen Visual yang Wajib Diterapkan

### Per Section — Minimal 2 dari daftar berikut:

| Elemen | Contoh untuk Bab 5 | LaTeX/Format |
|--------|--------------------|--------------|
| **Tabel** | Perbandingan tipe input, atribut form, elemen media | `\begin{tabular}`, kolom `P{Xcm}` |
| **Gambar** | Screenshot form/tabel, diagram struktur HTML | `\includegraphics` atau TikZ |
| **Grafik/Diagram** | Flowchart submit form, hierarchy elemen semantik | `\begin{tikzpicture}` |
| **Contoh kode** | HTML tabel, form, audio/video, SVG, iframe | `\begin{webcode}[language=HTML, caption={...}]` |
| **Studi kasus** | Form pendaftaran; halaman artikel dengan media & aksesibel | Paragraf naratif + kode + diagram |
| **Box** | Konsep penting, catatan aksesibilitas, tip validasi | `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}` |

### Seluruh Bab 5 — Wajib ada:

- Minimal **2 gambar**
- Minimal **3 tabel**
- Minimal **4 contoh kode** HTML
- Minimal **1 studi kasus** lengkap

---

## Aturan Penulisan per Section

- **Jumlah paragraf**: minimal 2, maksimal 10; setiap paragraf minimal 3 kalimat
- **Gaya**: tutorial untuk pemula; bahasa jelas; sertakan definisi, analogi, contoh konkret
- **Elemen visual**: per section minimal 2 elemen

---

## Referensi dan Sitasi

### Prioritas: gunakan dari `references.bib`

| Key | Judul | Relevansi |
|-----|-------|-----------|
| `mdnHtmlIntro` | Introduction to HTML | Tabel, form, elemen HTML |
| `mdnAccessibility` | Accessibility | WCAG, a11y, ARIA |
| `webdevAccessibility` | web.dev Learn Accessibility | Praktik a11y |
| `webdevHtml` | web.dev Learn HTML | Form, semantik, media |
| `whatwgHtml` | HTML Living Standard | Standar, atribut |
| `w3cValidator` | W3C Markup Validation Service | Validasi |
| `mdnLearn` | MDN Learn Web Development | Konteks umum |

### Sumber baru: tambahkan di `references.bib` dan gunakan `\cite{keyBaru}`

---

## Panduan Pendalaman per Section

*(Ringkasan — lihat detail di prompt asli)*

- **5-1, 5-2**: Tabel — elemen table, scope, aksesibilitas; perbandingan elemen
- **5-3, 5-4**: Form — form, input, label, button; tipe input; validasi; fieldset/legend
- **5-5**: Struktur semantik — header, nav, main, section, article, aside, footer
- **5-6, 5-7**: Media — audio, video, source, track; SVG vs raster
- **5-8**: Embedding — iframe, object, embed; sandbox, keamanan
- **5-9, 5-10**: Aksesibilitas — POUR, ARIA, form/tabel aksesibel
- **5-11, 5-12**: Validasi, debugging — W3C Validator, teknik debugging
- **5-13**: Best practices — konvensi, WHATWG, W3C

---

## Format File Output

- Section: `bab/bab-05/section-5-N.tex`; utama: `bab/bab-05.tex`
- Kode inline: `\code{...}`; tabel: `tabular` dengan `P{Xcm}`; diagram: TikZ; kode: `\begin{webcode}`; box: `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}`

---

## Contoh Pola Section

```latex
\section{Judul Section}
Paragraf pertama \cite{mdnHtmlIntro}. Paragraf kedua \cite{webdevHtml}.

\begin{webcode}[language=HTML, caption={Form login aksesibel}]
<form action="/login" method="post">
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required>
  <label for="pass">Password:</label>
  <input type="password" id="pass" name="pass" required>
  <button type="submit">Login</button>
</form>
\end{webcode}
```

---

## Contoh Studi Kasus untuk Bab 5

```latex
\begin{contoh}
\textbf{Studi Kasus: Form Pendaftaran yang Aksesibel}

Buat form pendaftaran dengan field: nama, email, password, jenis kelamin (radio), jurusan (select), persetujuan (checkbox). Persyaratan a11y:
\begin{enumerate}
  \item Setiap input memiliki \code{<label for="...">} terkait \code{id}
  \item Group radio/checkbox dengan \code{<fieldset>} dan \code{<legend>}
  \item Atribut \code{required}, \code{pattern}, \code{minlength}
  \item Pesan error via \code{aria-describedby}
\end{enumerate}
\end{contoh}
```

---

## Struktur OBE

Bab 5 adalah unit materi inti. Pastikan Sub-CPMK 2.1 dan 1.3 tercakup; update aktivitas, latihan, asesmen, checklist, rangkuman di `bab-05.tex`.

---

## Checklist Sebelum Selesai

- [ ] Setiap section memiliki 2–10 paragraf, masing-masing minimal 3 kalimat
- [ ] Setiap section memiliki minimal 2 elemen visual
- [ ] Minimal 2 gambar, 3 tabel, 4 contoh kode HTML di seluruh bab
- [ ] Minimal 1 studi kasus lengkap
- [ ] Semua `\cite{key}` merujuk ke entri di `references.bib`
- [ ] File `bab/bab-05.tex` di-update
- [ ] Gambar di `images/bab-05/`
- [ ] Kompilasi LaTeX berhasil tanpa error
