# Prompt: Perdalam Bab 8 — JavaScript Dasar dan DOM (Visual Lengkap)

Kamu adalah asisten yang membantu memperdalam **Bab 8 (JavaScript Dasar dan DOM)** dari buku ajar di folder **buku_ajar_pemrograman_web/**. Ikuti seluruh ketentuan di bawah ini. Gunakan **prompt_perdalam_bab2.md** sebagai referensi format dan aturan penulisan.

---

## Tujuan

Memperdalam Bab 8 dengan memanfaatkan:
1. **Referensi** dari `buku_ajar_pemrograman_web/references.bib`
2. **Sumber terbuka di internet** (MDN, web.dev, JavaScript.info, ECMAScript, tutorial, dll.)
3. **Elemen visual kaya**: gambar, grafik, tabel, contoh, contoh coding, dan studi kasus
4. **Download gambar** menggunakan skrip Python jika diperlukan (diagram DOM tree, screenshot konsol browser, ilustrasi event flow)

---

## Konteks Bab 8

Bab 8 berjudul **"JavaScript Dasar dan DOM"** dan memiliki **17 section**:

| # | File | Judul |
|---|------|-------|
| 1 | section-8-1.tex | Pengenalan JavaScript dan Perannya di Web (client-side) |
| 2 | section-8-2.tex | Memulai: Menjalankan JavaScript di Browser dan Konsol |
| 3 | section-8-3.tex | Sintaks Dasar: Statement, Komentar, dan Aturan Penulisan |
| 4 | section-8-4.tex | Variabel: var, let, dan const |
| 5 | section-8-5.tex | Tipe Data: number, string, boolean, undefined, null |
| 6 | section-8-6.tex | Operator: Aritmetika, Perbandingan, Logika, dan Penugasan |
| 7 | section-8-7.tex | Konversi Tipe dan typeof |
| 8 | section-8-8.tex | String: Literal, Escape, dan Metode Dasar |
| 9 | section-8-9.tex | Percabangan: if, else if, else, dan switch |
| 10 | section-8-10.tex | Perulangan: for, while, do...while, break, continue |
| 11 | section-8-11.tex | Fungsi: Deklarasi, Parameter, dan Return |
| 12 | section-8-12.tex | Scope: Global, Function, dan Block (let/const) |
| 13 | section-8-13.tex | Array: Membuat, Mengakses Indeks, dan Metode Dasar |
| 14 | section-8-14.tex | Objek: Literal, Properti, dan Metode |
| 15 | section-8-15.tex | Pengenalan DOM (Document Object Model) |
| 16 | section-8-16.tex | Mengakses Elemen DOM dan Mengubah Konten |
| 17 | section-8-17.tex | Event Dasar: click, load, submit |

**Sub-CPMK:** Sub-CPMK 2.3: Mengimplementasikan interaktivitas dengan JavaScript (DOM, event handling, validasi form).

Baca seluruh isi Bab 8: `bab/bab-08.tex` dan `bab/bab-08/section-8-*.tex`.

---

## Tugas Utama

1. **Baca** Bab 8 dan referensi di `references.bib` serta sumber terbuka di internet
2. **Perdalam** penjelasan setiap section; kembangkan menjadi 2–10 paragraf (masing-masing minimal 3 kalimat)
3. **Tambahkan** elemen visual:
   - **Gambar** — screenshot konsol browser, diagram pohon DOM, ilustrasi event bubbling
   - **Grafik** — flowchart percabangan/perulangan, diagram scope, alur event handling
   - **Tabel** — perbandingan var/let/const, operator, tipe data, metode array/string/DOM
   - **Contoh coding** — snippet JavaScript yang dapat dijalankan
   - **Studi kasus** — kalkulator, validasi form, toggle tampilan (minimal 2)
4. **Boleh hapus atau tambah section baru** selama mengikuti struktur OBE dan format buku_ajar
5. **Update `bab/bab-08.tex`** dan **`references.bib`** jika ada perubahan

---

## Download Gambar dengan Python

```python
# download_gambar_bab08.py
import requests
from pathlib import Path

def download_image(url, filename):
    folder = Path("buku_ajar_pemrograman_web/images/bab-08")
    folder.mkdir(parents=True, exist_ok=True)
    response = requests.get(url)
    response.raise_for_status()
    filepath = folder / filename
    with open(filepath, 'wb') as f:
        f.write(response.content)
    print(f"Downloaded: {filepath}")
```

Aturan: Simpan di `images/bab-08/`; LaTeX: `\includegraphics[width=\textwidth]{images/bab-08/nama-file.png}`

---

## Elemen Visual yang Wajib Diterapkan

### Per Section — Minimal 2 dari daftar berikut:

| Elemen | Contoh untuk Bab 8 | LaTeX/Format |
|--------|---------------------|--------------|
| **Tabel** | Perbandingan var/let/const, operator, metode array/string | `\begin{tabular}`, kolom `P{Xcm}` |
| **Gambar** | Screenshot konsol, diagram pohon DOM, event flow | `\includegraphics` atau TikZ |
| **Grafik/Diagram** | Flowchart if/else, for loop, diagram scope | `\begin{tikzpicture}` |
| **Contoh kode** | Snippet JavaScript (variabel, fungsi, array, DOM, event) | `\begin{webcode}[language=JavaScript, caption={...}]` |
| **Studi kasus** | Validasi form, counter, toggle dark mode | Paragraf naratif + kode lengkap |
| **Box** | Konsep penting, catatan debugging | `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}` |

### Seluruh Bab 8 — Wajib ada:

- Minimal **2 gambar**
- Minimal **4 tabel**
- Minimal **5 contoh kode** JavaScript
- Minimal **2 studi kasus** lengkap (validasi form + aplikasi interaktif lain)

---

## Aturan Penulisan per Section

- **Jumlah paragraf**: minimal 2, maksimal 10; setiap paragraf minimal 3 kalimat
- **Gaya**: tutorial untuk pemula; sertakan definisi, analogi, contoh konkret
- **Elemen visual**: per section minimal 2 elemen; section kode wajib punya `\begin{webcode}[language=JavaScript, ...]`

---

## Referensi dan Sitasi

### Prioritas: gunakan dari `references.bib`

| Key | Judul | Relevansi |
|-----|-------|-----------|
| `mdnJsGuide` | JavaScript Guide | Sintaks, tipe data, fungsi, DOM |
| `jsInfo` | The Modern JavaScript Tutorial | Tutorial JavaScript |
| `mdnLearn` | MDN Learn Web Development | Konteks web |
| `eloquentJs` | Eloquent JavaScript | Referensi |
| `mdnHtmlIntro` | Introduction to HTML | Integrasi JS–HTML |
| `mdnAccessibility` | Accessibility | Event, keyboard, validasi aksesibel |
| `owaspXss` | Cross Site Scripting Prevention | Keamanan |

### Sumber baru: tambahkan di `references.bib` dan gunakan `\cite{keyBaru}`

---

## Saran Perdalaman per Section

- 8-1: Sejarah JS, ekosistem Node.js, kaitan ES6+
- 8-2: `<script>`, inline vs eksternal, DevTools Console
- 8-4: Tabel var vs let vs const, temporal dead zone
- 8-6: Tabel operator, short-circuit evaluation
- 8-9: Diagram alur if/else, switch vs if
- 8-10: Diagram for/while, break/continue
- 8-11: First-class function, function expression vs declaration
- 8-13: Tabel metode array (push, pop, slice, indexOf)
- 8-15: Diagram pohon DOM, jenis node
- 8-16: querySelector vs getElementById, innerHTML vs textContent
- 8-17: event.target, preventDefault, capturing dan bubbling

---

## Format File Output

- Section: `bab/bab-08/section-8-N.tex`; utama: `bab/bab-08.tex`
- Kode inline: `\code{...}`; tabel: `tabular`; diagram: TikZ; kode: `\begin{webcode}[language=JavaScript, caption={...}]`; box: `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}`

---

## Contoh Studi Kasus

```latex
\begin{contoh}
\textbf{Studi Kasus: Validasi Form dengan JavaScript}

Form pendaftaran: validasi nama, email, password (min 8 karakter) sebelum submit.
\begin{enumerate}
  \item Tangani event \code{submit} dengan \code{addEventListener}
  \item \code{preventDefault()} jika validasi gagal
  \item Akses nilai dengan \code{querySelector} dan \code{.value}
  \item Cek kondisi dan tampilkan pesan error
\end{enumerate}
\end{contoh}
```

---

## Struktur OBE

Bab 8 adalah Unit Materi Inti. Pastikan aktivitas, latihan, asesmen, checklist, rangkuman di `bab-08.tex` selaras dengan section.

---

## Checklist Sebelum Selesai

- [ ] Setiap section memiliki 2–10 paragraf, masing-masing minimal 3 kalimat
- [ ] Setiap section memiliki minimal 2 elemen visual
- [ ] Minimal 2 gambar, 4 tabel, 5 contoh kode JavaScript di seluruh bab
- [ ] Minimal 2 studi kasus lengkap
- [ ] Semua `\cite{key}` merujuk ke entri di `references.bib`
- [ ] File `bab/bab-08.tex` di-update
- [ ] Gambar di `images/bab-08/`
- [ ] Kompilasi LaTeX berhasil tanpa error
