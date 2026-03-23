# Prompt: Perdalam Bab 6 — CSS Dasar: Selector dan Box Model (Visual Lengkap)

Kamu adalah asisten yang membantu memperdalam **Bab 6 (CSS Dasar: Selector dan Box Model)** dari buku ajar di folder **buku_ajar_pemrograman_web/**. Ikuti seluruh ketentuan di bawah ini. Gunakan **prompt_perdalam_bab2.md** sebagai referensi format dan aturan penulisan.

---

## Tujuan

Memperdalam Bab 6 dengan memanfaatkan:
1. **Referensi** dari `buku_ajar_pemrograman_web/references.bib`
2. **Sumber terbuka di internet** (MDN CSS, web.dev Learn CSS, W3Schools, CSS-Tricks, dokumentasi, dll.)
3. **Elemen visual kaya**: gambar, grafik, tabel, contoh, contoh coding, dan studi kasus
4. **Download gambar** menggunakan skrip Python jika diperlukan (diagram box model, screenshot DevTools, ilustrasi selector)

---

## Konteks Bab 6

Bab 6 berjudul **"CSS Dasar: Selector dan Box Model"** dan memiliki 12 section. Urutan: pengenalan, sintaks dan selector, warna dan teks, box model dan display, link serta list/tabel, satuan dan nilai.

| # | File | Judul |
|---|------|-------|
| 1 | section-6-1.tex | Pengenalan CSS dan Perannya dalam Styling |
| 2 | section-6-2.tex | Cara Menyisipkan CSS: Inline, Internal, Eksternal |
| 3 | section-6-3.tex | Sintaks Dasar CSS: Selector, Properti, dan Nilai |
| 4 | section-6-4.tex | Selector Dasar: Elemen, Class, dan Id |
| 5 | section-6-5.tex | Warna dan Background |
| 6 | section-6-6.tex | Teks dan Tipografi |
| 7 | section-6-7.tex | Box Model: Margin, Padding, dan Border |
| 8 | section-6-8.tex | Lebar, Tinggi, dan box-sizing |
| 9 | section-6-9.tex | Display: block, inline, dan inline-block |
| 10 | section-6-10.tex | Link dan Styling Tautan (state: hover, visited, active) |
| 11 | section-6-11.tex | Daftar (list) dan Tabel: Styling Dasar |
| 12 | section-6-12.tex | Satuan dan Nilai (px, em, rem, %, warna) |

**Sub-CPMK:** Sub-CPMK 2.2: Menerapkan CSS3 untuk styling, layout, dan desain responsif.

Baca seluruh isi Bab 6: `bab/bab-06.tex` dan `bab/bab-06/section-6-*.tex`.

---

## Tugas Utama

1. **Baca** Bab 6 dan referensi di `references.bib` serta sumber terbuka di internet
2. **Perdalam** penjelasan setiap section; kembangkan menjadi 2–10 paragraf (masing-masing minimal 3 kalimat)
3. **Tambahkan** elemen visual:
   - **Gambar** — diagram box model, screenshot DevTools (Computed), ilustrasi selector
   - **Grafik** — flowchart cascade CSS, diagram margin vs padding, content-box vs border-box
   - **Tabel** — perbandingan inline/internal/eksternal, pseudo-class link, satuan px/em/rem
   - **Contoh coding** — snippet CSS dan HTML
   - **Studi kasus** — card produk, menu navigasi dari list (minimal 1–2)
4. **Boleh hapus atau tambah section baru** selama mengikuti struktur OBE dan format buku_ajar
5. **Update `bab/bab-06.tex`** dan **`references.bib`** jika ada perubahan

---

## Download Gambar dengan Python

```python
# download_gambar_bab6.py
import requests
from pathlib import Path

def download_image(url, filename):
    folder = Path("buku_ajar_pemrograman_web/images/bab-06")
    folder.mkdir(parents=True, exist_ok=True)
    response = requests.get(url)
    response.raise_for_status()
    filepath = folder / filename
    with open(filepath, 'wb') as f:
        f.write(response.content)
    print(f"Downloaded: {filepath}")
```

Aturan: Simpan di `images/bab-06/`; format PNG, JPG, SVG; LaTeX: `\includegraphics[width=\textwidth]{images/bab-06/nama-file.png}`

---

## Elemen Visual yang Wajib Diterapkan

### Per Section — Minimal 2 dari daftar berikut:

| Elemen | Contoh untuk Bab 6 | LaTeX/Format |
|--------|-------------------|--------------|
| **Tabel** | Perbandingan inline/internal/eksternal, komponen box model, satuan px/em/rem | `\begin{tabular}`, kolom `P{Xcm}` |
| **Gambar** | Diagram box model, screenshot Computed di DevTools | `\includegraphics` atau TikZ |
| **Grafik/Diagram** | content-box vs border-box, flowchart cascade, display block/inline | `\begin{tikzpicture}` |
| **Contoh kode** | Snippet CSS (selector, box model, tipografi, gradient) | `\begin{webcode}[language=CSS|HTML, ...]` |
| **Studi kasus** | Card produk, menu navigasi dari list | Paragraf naratif + kode + hasil |
| **Box** | Konsep box model, catatan aksesibilitas tautan | `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}` |

### Seluruh Bab 6 — Wajib ada:

- Minimal **2 gambar**
- Minimal **3 tabel**
- Minimal **4 contoh kode** (CSS + HTML)
- Minimal **1 studi kasus** lengkap

---

## Aturan Penulisan per Section

- **Jumlah paragraf**: minimal 2, maksimal 10; setiap paragraf minimal 3 kalimat
- **Gaya**: tutorial untuk pemula; sertakan definisi, analogi, contoh konkret
- **Elemen visual**: per section minimal 2 elemen

---

## Referensi dan Sitasi

### Prioritas: gunakan dari `references.bib`

| Key | Judul |
|-----|-------|
| `mdnCss` | Styling the Web with CSS |
| `webdevCss` | web.dev Learn CSS |
| `w3cCss` | W3C CSS Specifications |
| `cssTricks` | CSS-Tricks Guides |
| `mdnLearn` | MDN Learn Web Development |
| `webdevLearn` | web.dev Learn Web Development |
| `mdnAccessibility` | Accessibility |

### Sumber baru: tambahkan di `references.bib` dan gunakan `\cite{keyBaru}`

---

## Saran Perdalaman per Section

- 6-1: Sejarah singkat CSS, cascading, specificity, sebelum/sesudah CSS
- 6-2: Kelebihan/kekurangan inline/internal/eksternal, atribut media
- 6-3: Blok aturan, komentar, shorthand, valid vs invalid
- 6-4: Selector majemuk, descendant vs child, class vs id
- 6-5: rgba, hsla, background-repeat, gradient
- 6-6: font-stack, web fonts, text-transform, text-overflow
- 6-7: Diagram box model (wajib), margin collapse, shorthand
- 6-8: content-box vs border-box, overflow
- 6-9: Perbandingan block/inline/inline-block, display: none vs visibility
- 6-10: Urutan LVHA, :focus/:focus-visible untuk a11y
- 6-11: list-style-image, border-spacing, zebra striping
- 6-12: px vs em vs rem vs vw/vh, calc(), auto, inherit

---

## Format File Output

- Section: `bab/bab-06/section-6-N.tex`; utama: `bab/bab-06.tex`
- Kode inline: `\code{...}`; tabel: `tabular`; diagram: TikZ; kode: `\begin{webcode}`; box: `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}`

---

## Contoh Studi Kasus (Bab 6)

```latex
\begin{contoh}
\textbf{Studi Kasus: Membuat Card Produk dengan Box Model}

Tujuan: card produk dengan box model, warna, tipografi, border.
\begin{enumerate}
  \item HTML: \code{<div class="card">} berisi gambar, judul, harga
  \item Box model: padding 16px, border 1px solid, border-radius 8px
  \item box-sizing: border-box
\end{enumerate}
\begin{webcode}[language=CSS,caption={Styling card}]
.card {
  box-sizing: border-box;
  width: 280px;
  padding: 16px;
  border: 1px solid #ddd;
  border-radius: 8px;
}
\end{webcode}
\end{contoh}
```

---

## Struktur OBE

Bab 6 adalah unit materi inti (Sub-CPMK 2.2). Pastikan aktivitas, latihan, asesmen, checklist, rangkuman di `bab-06.tex` selaras dengan section.

---

## Checklist Sebelum Selesai

- [ ] Setiap section memiliki 2–10 paragraf, masing-masing minimal 3 kalimat
- [ ] Setiap section memiliki minimal 2 elemen visual
- [ ] Minimal 2 gambar, 3 tabel, 4 contoh kode di seluruh bab
- [ ] Minimal 1 studi kasus lengkap
- [ ] Semua `\cite{key}` merujuk ke entri di `references.bib`
- [ ] File `bab/bab-06.tex` di-update
- [ ] Gambar di `images/bab-06/`
- [ ] Kompilasi LaTeX berhasil tanpa error
