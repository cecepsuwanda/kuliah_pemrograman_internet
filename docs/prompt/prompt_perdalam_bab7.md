# Prompt: Perdalam Bab 7 — CSS Layout Responsif (Visual Lengkap)

Kamu adalah asisten yang membantu memperdalam **Bab 7 (CSS Layout Responsif)** dari buku ajar di folder **buku_ajar_pemrograman_web/**. Ikuti seluruh ketentuan di bawah ini. Gunakan **prompt_perdalam_bab2.md** sebagai referensi format dan aturan penulisan.

---

## Tujuan

Memperdalam Bab 7 dengan memanfaatkan:
1. **Referensi** dari `buku_ajar_pemrograman_web/references.bib`
2. **Sumber terbuka di internet** (MDN CSS, web.dev Learn CSS, W3Schools, CSS-Tricks, W3C, dll.)
3. **Elemen visual kaya**: gambar, grafik, tabel, contoh, contoh coding, dan studi kasus
4. **Download gambar** menggunakan skrip Python jika diperlukan (diagram Flexbox/Grid, screenshot layout, ilustrasi breakpoint)

---

## Konteks Bab 7

Bab 7 berjudul **"CSS Layout Responsif"** dan memiliki **22 section**:

| # | File | Judul Section |
|---|------|---------------|
| 1 | section-7-1.tex | Normal Flow dan Positioning (static, relative, absolute, fixed, sticky) |
| 2-3 | 7-2, 7-3 | Flexbox: Konsep Container/Item, Arah, Alignment, Wrap; Praktik Layout |
| 4-5 | 7-4, 7-5 | CSS Grid: Grid Container, Track, Area; Praktik Layout |
| 6-7 | 7-6, 7-7 | Float dan clear; Overflow |
| 8-10 | 7-8, 7-9, 7-10 | Media Queries, Viewport/Unit Responsif, Mobile-First dan Breakpoint |
| 11-12 | 7-11, 7-12 | Form: Styling input/button; Navigasi dan Menu |
| 13-16 | 7-13–7-16 | Transition, Animasi/keyframes, Transform, Custom Properties |
| 17-22 | 7-17–7-22 | Spesifisitas, Pseudo-class/element, Aksesibilitas CSS, BEM, Best Practices, Referensi |

**Sub-CPMK:** Sub-CPMK 2.2: Menerapkan CSS3 untuk styling, layout (Flexbox/Grid), dan desain responsif.

Baca seluruh isi Bab 7: `bab/bab-07.tex` dan `bab/bab-07/section-7-*.tex`.

---

## Tugas Utama

1. **Baca** Bab 7 dan referensi di `references.bib` serta sumber terbuka di internet
2. **Perdalam** penjelasan setiap section; kembangkan menjadi 2–10 paragraf (masing-masing minimal 3 kalimat)
3. **Tambahkan** elemen visual:
   - **Gambar** — diagram Flexbox axis, diagram CSS Grid area, screenshot layout before/after responsif
   - **Grafik** — flowchart Flexbox vs Grid, diagram breakpoint
   - **Tabel** — perbandingan position, properti Flexbox/Grid, media query umum, unit viewport
   - **Contoh coding** — snippet CSS layout navbar, Grid card, media query
   - **Studi kasus** — navbar responsif, card grid, form responsif (minimal 1–2)
4. **Boleh hapus, gabung, atau tambah section baru** selama mengikuti struktur OBE dan format buku_ajar
5. **Update `bab/bab-07.tex`** dan **`references.bib`** jika ada perubahan

---

## Download Gambar dengan Python

```python
# download_gambar_bab7.py
import requests
from pathlib import Path

def download_image(url, filename):
    folder = Path("buku_ajar_pemrograman_web/images/bab-07")
    folder.mkdir(parents=True, exist_ok=True)
    response = requests.get(url)
    response.raise_for_status()
    filepath = folder / filename
    with open(filepath, 'wb') as f:
        f.write(response.content)
    print(f"Downloaded: {filepath}")
```

Aturan: Simpan di `images/bab-07/`; format PNG, JPG, SVG; LaTeX: `\includegraphics[width=\textwidth]{images/bab-07/nama-file.png}`

---

## Elemen Visual yang Wajib Diterapkan

### Per Section — Minimal 2 dari daftar berikut:

| Elemen | Contoh untuk Bab 7 | LaTeX/Format |
|--------|-------------------|--------------|
| **Tabel** | Perbandingan position, properti Flexbox/Grid, breakpoint | `\begin{tabular}`, kolom `P{Xcm}` |
| **Gambar** | Diagram Flexbox axis, area CSS Grid, screenshot layout | `\includegraphics` atau TikZ |
| **Grafik/Diagram** | Flowchart Flexbox vs Grid, diagram media query | `\begin{tikzpicture}` |
| **Contoh kode** | Snippet CSS navbar, Grid, media query, keyframes | `\begin{webcode}[language=CSS, caption={...}]` |
| **Studi kasus** | Navbar responsif, grid kartu, form multi-kolom | Paragraf naratif + HTML+CSS + diagram |
| **Box** | Konsep Flexbox axis, catatan browser support | `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}` |

### Seluruh Bab 7 — Wajib ada:

- Minimal **2 gambar**
- Minimal **4 tabel**
- Minimal **5 contoh kode** CSS
- Minimal **1 studi kasus** lengkap (komponen responsif)

---

## Aturan Penulisan per Section

- **Jumlah paragraf**: minimal 2, maksimal 10; setiap paragraf minimal 3 kalimat
- **Gaya**: tutorial untuk pemula; sertakan definisi, analogi, contoh konkret
- **Elemen visual**: per section minimal 2 elemen

---

## Referensi dan Sitasi

### Prioritas: gunakan dari `references.bib`

| Key | Judul | Relevansi |
|-----|-------|-----------|
| `mdnCss` | Styling the Web with CSS | Layout, Flexbox, Grid, responsif |
| `webdevCss` | web.dev Learn CSS | Flexbox, Grid, performa |
| `cssTricks` | CSS-Tricks Guides | Tips layout, pattern |
| `w3cCss` | W3C CSS Specifications | Spesifikasi resmi |
| `mdnAccessibility` | Accessibility | Focus, reduced motion, kontras |
| `webdevAccessibility` | web.dev Learn Accessibility | Aksesibilitas CSS |
| `mdnLearn` | MDN Learn Web Development | Konteks umum |

### Sumber baru: tambahkan di `references.bib` dan gunakan `\cite{keyBaru}`

---

## Panduan Perdalaman per Grup Section

- **Grup 1 (7-1–7-7)**: Normal flow, positioning; Flexbox (justify-content vs align-items); Grid (track, area); Float, overflow
- **Grup 2 (7-8–7-10)**: Media queries; viewport/unit; mobile-first, breakpoint umum
- **Grup 3 (7-11–7-16)**: Form, navigasi; transition, animation; transform; custom properties
- **Grup 4 (7-17–7-22)**: Spesifisitas, cascade; pseudo-class/element; aksesibilitas; BEM; best practices

---

## Format File Output

- Section: `bab/bab-07/section-7-N.tex`; utama: `bab/bab-07.tex`
- Kode inline: `\code{...}`; tabel: `tabular`; diagram: TikZ; kode: `\begin{webcode}[language=CSS, caption={...}]`; box: `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}`

---

## Contoh Studi Kasus untuk Bab 7

```latex
\begin{contoh}
\textbf{Studi Kasus: Navbar Responsif dari Desktop ke Mobile}

Navbar: desktop = menu horizontal; mobile = tombol hamburger + menu vertikal.

\textbf{Langkah 1:} HTML dengan \code{nav}, \code{ul}, tombol toggle.
\textbf{Langkah 2:} CSS Desktop: Flexbox \code{justify-content: space-between}.
\textbf{Langkah 3:} Media query \code{max-width: 768px}; menu vertikal \code{flex-direction: column}.
\textbf{Langkah 4:} Transition pada menu.
\end{contoh}
```

---

## Struktur OBE

Bab 7 adalah Unit Materi Inti. Pastikan aktivitas, latihan, asesmen, checklist, rangkuman di `bab-07.tex` selaras dengan section.

---

## Checklist Sebelum Selesai

- [ ] Setiap section memiliki 2–10 paragraf, masing-masing minimal 3 kalimat
- [ ] Setiap section memiliki minimal 2 elemen visual
- [ ] Minimal 2 gambar, 4 tabel, 5 contoh kode CSS di seluruh bab
- [ ] Minimal 1 studi kasus lengkap
- [ ] Semua `\cite{key}` merujuk ke entri di `references.bib`
- [ ] File `bab/bab-07.tex` di-update
- [ ] Gambar di `images/bab-07/`
- [ ] Kompilasi LaTeX berhasil tanpa error
