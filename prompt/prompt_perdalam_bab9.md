# Prompt: Perdalam Bab 9 — Event Handling, Validasi, dan Library Front-End (Visual Lengkap)

Kamu adalah asisten yang membantu memperdalam **Bab 9 (Event Handling, Validasi, dan Library Front-End)** dari buku ajar di folder **buku_ajar_pemrograman_web/**. Ikuti seluruh ketentuan di bawah ini. Gunakan **prompt_perdalam_bab2.md** sebagai referensi format dan aturan penulisan.

---

## Tujuan

Memperdalam Bab 9 dengan memanfaatkan:
1. **Referensi** dari `buku_ajar_pemrograman_web/references.bib`
2. **Sumber terbuka di internet** (MDN, web.dev, JavaScript.info, dokumentasi, tutorial, dll.)
3. **Elemen visual kaya**: gambar, grafik, tabel, contoh, contoh coding, dan studi kasus
4. **Download gambar** menggunakan skrip Python jika diperlukan (diagram event flow, screenshot DevTools, ilustrasi DOM tree)

---

## Konteks Bab 9

Bab 9 berjudul **"Event Handling, Validasi, dan Library Front-End"** dan memiliki **29 section** meliputi: fungsi lanjutan, array/objek lanjutan, Number/Math/Date, JSON, error handling, DOM traversing, event (addEventListener, propagation), form dan validasi, timer, Promise, async/await, Fetch API, ES6+, class, RegExp, closure, prototype, pola desain, debugging, pengujian, performa, keamanan XSS, library/framework, tooling, proyek praktik.

**Sub-CPMK:**
- Sub-CPMK 2.3: Mengimplementasikan interaktivitas dengan JavaScript (DOM, event handling, validasi form)
- Sub-CPMK 2.4: Menggunakan library atau framework front-end untuk antarmuka dinamis

Baca seluruh isi Bab 9: `bab/bab-09.tex` dan `bab/bab-09/section-9-*.tex`.

---

## Tugas Utama

1. **Baca** Bab 9 dan referensi di `references.bib` serta sumber terbuka di internet
2. **Perdalam** penjelasan setiap section; kembangkan menjadi 2–10 paragraf (masing-masing minimal 3 kalimat)
3. **Tambahkan** elemen visual:
   - **Gambar** — diagram DOM tree, screenshot DevTools, ilustrasi event propagation, diagram Promise flow
   - **Grafik** — flowchart event (capturing → target → bubbling), diagram state Promise, bagan async/await
   - **Tabel** — perbandingan map/filter/reduce, daftar event type, callback vs Promise vs async/await
   - **Contoh coding** — event handler, validasi form, Fetch API, Promise
   - **Studi kasus** — form registrasi dengan validasi real-time; aplikasi yang fetch API dan render (minimal 2)
4. **Boleh menggabungkan, memecah, menghapus, atau menambah section baru** selama mengikuti struktur OBE dan format buku_ajar
5. **Update `bab/bab-09.tex`** dan **`references.bib`** jika ada perubahan

---

## Download Gambar dengan Python

```python
# download_gambar_bab9.py
import requests
from pathlib import Path

def download_image(url, filename):
    folder = Path("buku_ajar_pemrograman_web/images/bab-09")
    folder.mkdir(parents=True, exist_ok=True)
    response = requests.get(url)
    response.raise_for_status()
    filepath = folder / filename
    with open(filepath, 'wb') as f:
        f.write(response.content)
    print(f"Downloaded: {filepath}")
```

Aturan: Simpan di `images/bab-09/`; LaTeX: `\includegraphics[width=\textwidth]{images/bab-09/nama-file.png}`

---

## Elemen Visual yang Wajib Diterapkan

### Per Section — Minimal 2 dari daftar berikut:

| Elemen | Contoh untuk Bab 9 | LaTeX/Format |
|--------|-------------------|--------------|
| **Tabel** | map/filter/reduce, event type, callback vs Promise vs async/await | `\begin{tabular}`, kolom `P{Xcm}` |
| **Gambar** | Diagram DOM tree, screenshot DevTools, event propagation | `\includegraphics` atau TikZ |
| **Grafik/Diagram** | Flowchart event propagation, Promise lifecycle, alur Fetch | `\begin{tikzpicture}` |
| **Contoh kode** | addEventListener, validasi form, Fetch, Promise, async/await | `\begin{webcode}[language=JavaScript, caption={...}]` |
| **Studi kasus** | Form validasi real-time; aplikasi fetch API + render | Paragraf naratif + diagram + kode |
| **Box** | Konsep penting, catatan | `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}` |

### Seluruh Bab 9 — Wajib ada:

- Minimal **3 gambar**
- Minimal **5 tabel**
- Minimal **8 contoh kode** JavaScript
- Minimal **2 studi kasus** lengkap

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
| `mdnJsGuide` | JavaScript Guide | DOM, event, Promise, Fetch, ES6+ |
| `jsInfo` | The Modern JavaScript Tutorial | Fungsi, array, objek, async |
| `eloquentJs` | Eloquent JavaScript | OOP, closure, prototype |
| `mdnAccessibility` | Accessibility | Validasi, aksesibilitas form |
| `owaspXss` | Cross Site Scripting Prevention | Keamanan, sanitasi output |
| `mdnToolsTesting` | Tools and testing | Debugging, pengujian |

### Sumber baru: tambahkan di `references.bib` dan gunakan `\cite{keyBaru}`

---

## Saran Perdalaman per Kelompok Section

- **Kelompok 1 (9-1–9-9)**: Fungsi lanjutan, array, objek, JSON, error handling
- **Kelompok 2 (9-10–9-13)**: DOM, event (propagation), form validasi, timer
- **Kelompok 3 (9-14, 9-18, 9-19)**: Callback, Promise, async/await, Fetch API
- **Kelompok 4 (9-15–9-22)**: ES6+, class, closure, prototype, pola desain
- **Kelompok 5 (9-23–9-29)**: Debugging, pengujian, XSS, library/framework, proyek

---

## Format File Output

- Section: `bab/bab-09/section-9-N.tex`; utama: `bab/bab-09.tex`
- Kode inline: `\code{...}`; tabel: `tabular`; diagram: TikZ; kode: `\begin{webcode}[language=JavaScript, caption={...}]`; box: `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}`

---

## Contoh Studi Kasus

### Studi Kasus 1: Form Registrasi dengan Validasi Real-Time

```latex
\begin{contoh}
\textbf{Studi Kasus: Form Registrasi dengan Validasi Real-Time}

Validasi saat mengetik: email berformat benar, password min 8 karakter, konfirmasi password sama.
\begin{enumerate}
  \item \code{addEventListener("input", handler)} untuk validasi real-time
  \item Tampilkan pesan error di bawah field
  \item \code{preventDefault()} di submit jika validasi gagal
\end{enumerate}
\end{contoh}
```

### Studi Kasus 2: Aplikasi Fetch Data dari API

```latex
\begin{contoh}
\textbf{Studi Kasus: Menampilkan Daftar Produk dari API}

Gunakan \code{fetch}, \code{async/await}, \code{response.json()}; loop data dan buat elemen DOM; tampilkan loading dan error state.
\end{contoh}
```

---

## Struktur OBE

Bab 9 adalah Unit Materi Inti. Pastikan aktivitas, latihan, asesmen, checklist, rangkuman di `bab-09.tex` selaras dengan section.

---

## Checklist Sebelum Selesai

- [ ] Setiap section memiliki 2–10 paragraf, masing-masing minimal 3 kalimat
- [ ] Setiap section memiliki minimal 2 elemen visual
- [ ] Minimal 3 gambar, 5 tabel, 8 contoh kode di seluruh bab
- [ ] Minimal 2 studi kasus lengkap
- [ ] Semua `\cite{key}` merujuk ke entri di `references.bib`
- [ ] File `bab/bab-09.tex` di-update
- [ ] Gambar di `images/bab-09/`
- [ ] Kompilasi LaTeX berhasil tanpa error
