# Prompt: Perdalam Bab 10 — PHP Dasar dan Pemrosesan Form (Visual Lengkap)

Kamu adalah asisten yang membantu memperdalam **Bab 10 (PHP Dasar dan Pemrosesan Form)** dari buku ajar di folder **buku_ajar_pemrograman_web/**. Ikuti seluruh ketentuan di bawah ini. Gunakan **prompt_perdalam_bab2.md** sebagai referensi format dan aturan penulisan.

---

## Tujuan

Memperdalam Bab 10 dengan memanfaatkan:
1. **Referensi** dari `buku_ajar_pemrograman_web/references.bib`
2. **Sumber terbuka di internet** (PHP Manual, PHP The Right Way, W3Schools, MDN, dokumentasi, tutorial, dll.)
3. **Elemen visual kaya**: gambar, grafik, tabel, contoh, contoh coding, dan studi kasus
4. **Download gambar** menggunakan skrip Python jika diperlukan (diagram arsitektur PHP, flowchart form, screenshot XAMPP)

---

## Konteks Bab 10

Bab 10 berjudul **"PHP Dasar dan Pemrosesan Form"** dan memiliki **15 section**:

| # | File | Topik |
|---|------|-------|
| 1 | section-10-1.tex | Pengenalan PHP dan Perannya dalam Pemrograman Server-Side Web |
| 2 | section-10-2.tex | Memulai: Instalasi PHP dan Environment (XAMPP, Server Lokal) |
| 3 | section-10-3.tex | Sintaks Dasar PHP: Tag, Komentar, dan Aturan Penulisan |
| 4 | section-10-4.tex | Variabel: Penamaan, Tipe Dinamis, dan Scope Dasar |
| 5 | section-10-5.tex | Tipe Data: String, Integer, Float, Boolean, Null |
| 6 | section-10-6.tex | Operator: Aritmetika, Perbandingan, Logika, Penugasan |
| 7 | section-10-7.tex | Echo dan Print: Menampilkan Output |
| 8 | section-10-8.tex | Percabangan: if, else if, else, dan switch |
| 9 | section-10-9.tex | Perulangan: for, while, do-while |
| 10 | section-10-10.tex | Fungsi: Deklarasi, Parameter, Return |
| 11 | section-10-11.tex | Array |
| 12 | section-10-12.tex | String: Literal, Escape, Konkatenasi, Fungsi String |
| 13 | section-10-13.tex | Superglobal: $_GET, $_POST, $_SERVER |
| 14 | section-10-14.tex | Form HTML dan Pemrosesan Form dengan PHP |
| 15 | section-10-15.tex | Include dan Require: Mengorganisasi Kode |

**Sub-CPMK:** Sub-CPMK 3.1: Mengimplementasikan logika server-side dengan PHP (pemrosesan form, struktur dasar, OOP).

Baca seluruh isi Bab 10: `bab/bab-10.tex` dan `bab/bab-10/section-10-*.tex`.

---

## Tugas Utama

1. **Baca** Bab 10 dan referensi di `references.bib` serta sumber terbuka di internet
2. **Perdalam** penjelasan setiap section; kembangkan menjadi 2–10 paragraf (masing-masing minimal 3 kalimat)
3. **Tambahkan** elemen visual:
   - **Gambar** — diagram arsitektur client-server-PHP, screenshot XAMPP/editor
   - **Grafik** — flowchart percabangan/perulangan, bagan alur pemrosesan form
   - **Tabel** — GET vs POST, tipe data PHP, fungsi string, operator
   - **Contoh coding** — form HTML+PHP, validasi, include/require
   - **Studi kasus** — form login, form registrasi, kalkulator, form kontak (minimal 1–2)
4. **Boleh hapus atau tambah section baru** selama mengikuti struktur OBE dan format buku_ajar
5. **Update `bab/bab-10.tex`** dan **`references.bib`** jika ada perubahan

---

## Download Gambar dengan Python

```python
# download_gambar_bab10.py
import requests
from pathlib import Path

def download_image(url, filename):
    folder = Path("buku_ajar_pemrograman_web/images/bab-10")
    folder.mkdir(parents=True, exist_ok=True)
    response = requests.get(url)
    response.raise_for_status()
    filepath = folder / filename
    with open(filepath, 'wb') as f:
        f.write(response.content)
    print(f"Downloaded: {filepath}")
```

Aturan: Simpan di `images/bab-10/`; LaTeX: `\includegraphics[width=\textwidth]{images/bab-10/nama-file.png}`

---

## Elemen Visual yang Wajib Diterapkan

### Per Section — Minimal 2 dari daftar berikut:

| Elemen | Contoh untuk Bab 10 | LaTeX/Format |
|--------|---------------------|--------------|
| **Tabel** | GET vs POST, tipe data, operator, fungsi string | `\begin{tabular}`, kolom `P{Xcm}` |
| **Gambar** | Diagram arsitektur PHP, screenshot XAMPP | `\includegraphics` atau TikZ |
| **Grafik/Diagram** | Flowchart if/else, alur form submit → validasi | `\begin{tikzpicture}` |
| **Contoh kode** | Variabel, percabangan, loop, form HTML+PHP | `\begin{webcode}[language=PHP|HTML, caption={...}]` |
| **Studi kasus** | Form login/registrasi dengan validasi server-side | Paragraf naratif + kode + diagram |
| **Box** | Konsep superglobal, catatan keamanan | `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}` |

### Seluruh Bab 10 — Wajib ada:

- Minimal **2 gambar**
- Minimal **4 tabel**
- Minimal **5 contoh kode**
- Minimal **1 studi kasus** lengkap (form dengan validasi server-side)

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
| `phpManual` | PHP Manual | Sintaks, tipe data, fungsi, superglobal |
| `phpRightWay` | PHP The Right Way | Praktik baik, keamanan form |
| `w3schoolsPhp` | W3Schools PHP Tutorial | Tutorial dasar |
| `owaspXss` | Cross Site Scripting Prevention | Sanitasi output |
| `owaspCsrf` | CSRF Prevention | Keamanan form |

### Sumber baru: tambahkan di `references.bib` dan gunakan `\cite{keyBaru}`

---

## Saran Topik/Perluasan per Section

- 10-1: Sejarah PHP, perbandingan dengan Node.js/Python
- 10-2: Langkah instalasi XAMPP, phpinfo, struktur htdocs
- 10-4–10-6: Variabel, tipe data, operator (tabel perbandingan)
- 10-7: Heredoc, nowdoc, htmlspecialchars (XSS)
- 10-13: $_GET, $_POST, $_FILES, praktik aman
- 10-14: Studi kasus form lengkap dengan validasi
- 10-15: Include vs require, struktur folder proyek

---

## Format File Output

- Section: `bab/bab-10/section-10-N.tex`; utama: `bab/bab-10.tex`
- Kode inline: `\code{...}`; tabel: `tabular`; diagram: TikZ; kode: `\begin{webcode}[language=PHP, caption={...}]`; box: `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}`

---

## Contoh Studi Kasus

```latex
\begin{contoh}
\textbf{Studi Kasus: Form Kontak dengan Validasi Server-Side}

Form (nama, email, pesan) diproses PHP. Alur: POST ke proses.php → cek \$_POST (kosong, format email filter_var) → jika valid: sukses; jika tidak: error per field.
\end{contoh}
```

---

## Struktur OBE

Bab 10 adalah unit materi inti (Sub-CPMK 3.1). Pastikan aktivitas, latihan, asesmen, checklist, rangkuman di `bab-10.tex` selaras dengan section.

---

## Checklist Sebelum Selesai

- [ ] Setiap section memiliki 2–10 paragraf, masing-masing minimal 3 kalimat
- [ ] Setiap section memiliki minimal 2 elemen visual
- [ ] Minimal 2 gambar, 4 tabel, 5 contoh kode di seluruh bab
- [ ] Minimal 1 studi kasus lengkap
- [ ] Semua `\cite{key}` merujuk ke entri di `references.bib`
- [ ] File `bab/bab-10.tex` di-update
- [ ] Gambar di `images/bab-10/`
- [ ] Kompilasi LaTeX berhasil tanpa error
