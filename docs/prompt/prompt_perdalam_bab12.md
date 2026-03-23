# Prompt: Perdalam Bab 12 — MySQL dan Operasi CRUD (Visual Lengkap)

Kamu adalah asisten yang membantu memperdalam **Bab 12 (MySQL dan Operasi CRUD)** dari buku ajar di folder **buku_ajar_pemrograman_web/**. Ikuti seluruh ketentuan di bawah ini. Gunakan **prompt_perdalam_bab2.md** sebagai referensi format dan aturan penulisan.

---

## Tujuan

Memperdalam Bab 12 dengan memanfaatkan:
1. **Referensi** dari `buku_ajar_pemrograman_web/references.bib`
2. **Sumber terbuka di internet** (MySQL docs, PHP manual, OWASP, MDN, tutorial, dll.)
3. **Elemen visual kaya**: gambar, grafik, tabel, contoh, contoh coding, dan studi kasus
4. **Download gambar** menggunakan skrip Python jika diperlukan (diagram ER, screenshot phpMyAdmin, skema database)

---

## Konteks Bab 12

Bab 12 berjudul **"MySQL dan Operasi CRUD"** dan memiliki **46 section** mencakup:
- **MySQL dasar**: pengenalan database/SQL, instalasi, DDL (CREATE, ALTER), DML (SELECT, INSERT, UPDATE, DELETE), operator, ORDER BY, LIMIT, agregat, GROUP BY, JOIN, relasi, normalisasi, index, backup/restore
- **MySQL lanjut**: VIEW, stored procedure, trigger, transaksi, EXPLAIN, keamanan user
- **Integrasi PHP–MySQL**: MySQLi, fetch, CRUD aplikasi, prepared statement, PDO
- **PHP lanjut**: exception, namespace, Composer, REST API, keamanan web, pengujian, deployment

**Sub-CPMK:**
- Sub-CPMK 3.2: Mengelola basis data dan operasi CRUD dengan MySQL serta koneksi dari PHP
- Sub-CPMK 3.3: Mengintegrasikan API dan front-end dengan back-end
- Sub-CPMK 4.2: Menerapkan prinsip keamanan web (validasi, prepared statement, XSS, CSRF)

Baca seluruh isi Bab 12: `bab/bab-12.tex` dan `bab/bab-12/section-12-*.tex`.

---

## Tugas Utama

1. **Baca** Bab 12 dan referensi di `references.bib` serta sumber terbuka di internet
2. **Perdalam** penjelasan setiap section; kembangkan menjadi 2–10 paragraf (masing-masing minimal 3 kalimat)
3. **Tambahkan** elemen visual:
   - **Gambar** — diagram ER, screenshot phpMyAdmin/MySQL Workbench, diagram alur CRUD
   - **Grafik** — flowchart query, diagram relasi tabel, alur request–response API
   - **Tabel** — MySQLi vs PDO, tipe data SQL, sintaks DDL/DML, perbandingan JOIN
   - **Contoh coding** — SQL, PHP (MySQLi/PDO), JavaScript (Fetch API)
   - **Studi kasus** — CRUD lengkap, REST API, pencegahan SQL injection (minimal 2–3)
4. **Boleh hapus atau tambah section baru** selama mengikuti struktur OBE dan format buku_ajar
5. **Update `bab/bab-12.tex`** dan **`references.bib`** jika ada perubahan

---

## Download Gambar dengan Python

```python
# download_gambar_bab12.py
import requests
from pathlib import Path

def download_image(url, filename):
    folder = Path("buku_ajar_pemrograman_web/images/bab-12")
    folder.mkdir(parents=True, exist_ok=True)
    response = requests.get(url)
    response.raise_for_status()
    filepath = folder / filename
    with open(filepath, 'wb') as f:
        f.write(response.content)
    print(f"Downloaded: {filepath}")
```

Aturan: Simpan di `images/bab-12/`; LaTeX: `\includegraphics[width=\textwidth]{images/bab-12/nama-file.png}`

---

## Elemen Visual yang Wajib Diterapkan

### Per Section — Minimal 2 dari daftar berikut:

| Elemen | Contoh untuk Bab 12 | LaTeX/Format |
|--------|---------------------|--------------|
| **Tabel** | MySQLi vs PDO, tipe data SQL, sintaks DDL/DML, JOIN | `\begin{tabular}`, kolom `P{Xcm}` |
| **Gambar** | Diagram ER, screenshot phpMyAdmin, skema relasi | `\includegraphics` atau TikZ |
| **Grafik/Diagram** | Flowchart CRUD, alur prepared statement, request API | `\begin{tikzpicture}` |
| **Contoh kode** | SQL, PHP (MySQLi/PDO), JavaScript Fetch | `\begin{webcode}[language=SQL|PHP|JavaScript, caption={...}]` |
| **Studi kasus** | CRUD produk, REST API, pencegahan SQL injection | Paragraf naratif + kode + diagram |
| **Box** | Konsep penting, catatan keamanan | `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}` |

### Seluruh Bab 12 — Wajib ada:

- Minimal **3 gambar**
- Minimal **5 tabel**
- Minimal **8 contoh kode** (SQL dan PHP wajib; JavaScript untuk Fetch)
- Minimal **2 studi kasus** lengkap (CRUD + API atau Keamanan)

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
| `mysqlDocs` | MySQL Documentation | SQL, DDL, DML |
| `mysqlGettingStarted` | MySQL Getting Started Guide | Praktik MySQL |
| `phpManual` | PHP Manual | MySQLi, PDO |
| `phpRightWay` | PHP The Right Way | Keamanan, Composer |
| `owaspXss` | Cross Site Scripting Prevention | XSS |
| `owaspCsrf` | CSRF Prevention | CSRF |

### Sumber baru: tambahkan di `references.bib` dan gunakan `\cite{keyBaru}`

---

## Prioritas Section untuk Diperdalam

- **MySQL Dasar (1–14)**: CREATE, ALTER, SELECT, INSERT, UPDATE, DELETE, ORDER BY, agregat, GROUP BY, JOIN, relasi
- **MySQL Lanjut (15–24)**: HAVING, normalisasi, index, backup/restore
- **Integrasi PHP–MySQL (25–27)**: CRUD aplikasi, prepared statement, PDO
- **MySQL Advanced (28–35)**: VIEW, stored procedure, transaksi, optimasi
- **PHP dan Keamanan (36–46)**: Validasi, XSS, CSRF, exception, Composer, REST API

---

## Format File Output

- Section: `bab/bab-12/section-12-N.tex`; utama: `bab/bab-12.tex`
- Kode: `\begin{webcode}[language=SQL|PHP|JavaScript, caption={...}]`; box: `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}`

---

## Contoh Studi Kasus

### Studi Kasus 1: CRUD Produk

```latex
\begin{contoh}
\textbf{Studi Kasus: Aplikasi CRUD Produk}

Form → PHP validasi → INSERT dengan prepared statement → MySQL → redirect daftar. Daftar: SELECT, fetch, tampilkan.
\end{contoh}
```

### Studi Kasus 2: Pencegahan SQL Injection

```latex
\begin{contoh}
\textbf{Studi Kasus: Prepared Statement Mencegah SQL Injection}

Input "1 OR 1=1" — query rentan mengembalikan semua baris; prepared statement menganggap sebagai data.
\end{contoh}
```

---

## Struktur OBE

Bab 12 adalah unit materi inti. Pastikan aktivitas, latihan, asesmen, checklist, rangkuman di `bab-12.tex` selaras dengan section.

---

## Checklist Sebelum Selesai

- [ ] Setiap section memiliki 2–10 paragraf, masing-masing minimal 3 kalimat
- [ ] Setiap section memiliki minimal 2 elemen visual
- [ ] Minimal 3 gambar, 5 tabel, 8 contoh kode di seluruh bab
- [ ] Minimal 2 studi kasus lengkap
- [ ] Semua `\cite{key}` merujuk ke entri di `references.bib`
- [ ] File `bab/bab-12.tex` di-update
- [ ] Gambar di `images/bab-12/`
- [ ] Kompilasi LaTeX berhasil tanpa error
