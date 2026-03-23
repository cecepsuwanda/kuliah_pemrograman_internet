# Prompt: Perdalam Bab 11 — PHP OOP, Session, dan Keamanan Dasar (Visual Lengkap)

Kamu adalah asisten yang membantu memperdalam **Bab 11 (PHP OOP, Session, dan Keamanan Dasar)** dari buku ajar di folder **buku_ajar_pemrograman_web/**. Ikuti seluruh ketentuan di bawah ini. Gunakan **prompt_perdalam_bab2.md** sebagai referensi format dan aturan penulisan.

---

## Tujuan

Memperdalam Bab 11 dengan memanfaatkan:
1. **Referensi** dari `buku_ajar_pemrograman_web/references.bib`
2. **Sumber terbuka di internet** (PHP Manual, PHP The Right Way, OWASP, MySQL docs, tutorial, dll.)
3. **Elemen visual kaya**: gambar, grafik, tabel, contoh, contoh coding, dan studi kasus
4. **Download gambar** menggunakan skrip Python jika diperlukan (diagram OOP, arsitektur session, flowchart validasi)

---

## Konteks Bab 11

Bab 11 berjudul **"PHP OOP, Session, dan Keamanan Dasar"** dan memiliki **14 section**:

| # | File | Judul |
|---|------|-------|
| 1 | section-11-1.tex | Pengenalan OOP di PHP |
| 2 | section-11-2.tex | Class dan Object: Properti dan Metode |
| 3 | section-11-3.tex | Constructor dan Destructor |
| 4 | section-11-4.tex | Pewarisan (Inheritance) dan Overriding |
| 5 | section-11-5.tex | Visibility: public, protected, private |
| 6 | section-11-6.tex | Static Properti dan Metode |
| 7 | section-11-7.tex | Session: Memulai, Menyimpan, Menghapus |
| 8 | section-11-8.tex | Cookie: Membuat dan Membaca |
| 9 | section-11-9.tex | Unggah File dan Validasi |
| 10 | section-11-10.tex | Penanganan Error |
| 11 | section-11-11.tex | Koneksi Database: MySQL dan MySQLi |
| 12 | section-11-12.tex | Query Dasar: SELECT, INSERT, UPDATE, DELETE |
| 13 | section-11-13.tex | Form Lanjutan: Validasi dan Sanitasi |
| 14 | section-11-14.tex | Praktik: Aplikasi Web Sederhana (CRUD Dasar) |

**Sub-CPMK:**
- Sub-CPMK 3.1: Mengimplementasikan logika server-side dengan PHP (pemrosesan form, struktur dasar, OOP)
- Sub-CPMK 4.2: Menerapkan prinsip keamanan web: validasi, prepared statement, session, mitigasi XSS dan CSRF

Baca seluruh isi Bab 11: `bab/bab-11.tex` dan `bab/bab-11/section-11-*.tex`.

---

## Tugas Utama

1. **Baca** Bab 11 dan referensi di `references.bib` serta sumber terbuka di internet
2. **Perdalam** penjelasan setiap section; kembangkan menjadi 2–10 paragraf (masing-masing minimal 3 kalimat)
3. **Tambahkan** elemen visual:
   - **Gambar** — diagram class OOP, screenshot session di browser, alur form validasi
   - **Grafik** — flowchart session/cookie, diagram inheritance, diagram CRUD
   - **Tabel** — public/protected/private, session vs cookie, fungsi validasi
   - **Contoh coding** — PHP, SQL, HTML (class, session, cookie, mysqli)
   - **Studi kasus** — login dengan session, form validasi, CRUD dengan MySQLi (minimal 1–2)
4. **Boleh hapus atau tambah section baru** selama mengikuti struktur OBE dan format buku_ajar
5. **Update `bab/bab-11.tex`** dan **`references.bib`** jika ada perubahan

---

## Download Gambar dengan Python

```python
# download_gambar_bab11.py
import requests
from pathlib import Path

def download_image(url, filename):
    folder = Path("buku_ajar_pemrograman_web/images/bab-11")
    folder.mkdir(parents=True, exist_ok=True)
    response = requests.get(url)
    response.raise_for_status()
    filepath = folder / filename
    with open(filepath, 'wb') as f:
        f.write(response.content)
    print(f"Downloaded: {filepath}")
```

Aturan: Simpan di `images/bab-11/`; LaTeX: `\includegraphics[width=\textwidth]{images/bab-11/nama-file.png}`

---

## Elemen Visual yang Wajib Diterapkan

### Per Section — Minimal 2 dari daftar berikut:

| Elemen | Contoh untuk Bab 11 | LaTeX/Format |
|--------|---------------------|--------------|
| **Tabel** | Visibility, session vs cookie, filter_var, metode mysqli | `\begin{tabular}`, kolom `P{Xcm}` |
| **Gambar** | Diagram class OOP, screenshot DevTools (cookie/session) | `\includegraphics` atau TikZ |
| **Grafik/Diagram** | Flowchart login dengan session, diagram inheritance, flow CRUD | `\begin{tikzpicture}` |
| **Contoh kode** | PHP (class, session, mysqli), SQL, HTML form | `\begin{webcode}[language=PHP|HTML|SQL, caption={...}]` |
| **Studi kasus** | Login + session, CRUD daftar tugas | Paragraf naratif + kode + diagram |
| **Box** | Konsep OOP, catatan keamanan cookie | `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}` |

### Seluruh Bab 11 — Wajib ada:

- Minimal **2 gambar**
- Minimal **4 tabel**
- Minimal **5 contoh kode**
- Minimal **1 studi kasus** lengkap (login + CRUD)

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
| `phpManual` | PHP Manual | OOP, session, cookie, mysqli |
| `phpRightWay` | PHP The Right Way | Keamanan, validasi, sanitasi |
| `owaspXss` | Cross Site Scripting Prevention | Mitigasi XSS |
| `owaspCsrf` | CSRF Prevention | Token CSRF, SameSite cookie |
| `mysqlDocs` | MySQL Documentation | Query, koneksi |

### Sumber baru: tambahkan di `references.bib` dan gunakan `\cite{keyBaru}`

---

## Saran Topik per Section

- 11-1–11-6: OOP — class, constructor, inheritance, visibility, static
- 11-7–11-8: Session (regenerate_id, keamanan), Cookie (SameSite, Secure, HttpOnly)
- 11-9: File upload — whitelist MIME, move_uploaded_file
- 11-10: Error — try/catch, error_reporting, log
- 11-11–11-12: MySQLi koneksi, query, prepared statement
- 11-13: filter_var, htmlspecialchars, whitelist vs blacklist
- 11-14: Studi kasus CRUD lengkap

---

## Format File Output

- Section: `bab/bab-11/section-11-N.tex`; utama: `bab/bab-11.tex`
- Kode: `\begin{webcode}[language=PHP|SQL, caption={...}]`; box: `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}`

---

## Contoh Studi Kasus

```latex
\begin{contoh}
\textbf{Studi Kasus: Aplikasi Login dan Daftar Tugas (CRUD)}

Login: form POST ke login.php → validasi → session_start, \$_SESSION['user'] → redirect dashboard.
Logout: session_destroy.
CRUD: SELECT daftar, INSERT/UPDATE/DELETE dengan prepared statement.
\end{contoh}
```

---

## Struktur OBE

Bab 11 adalah Unit Materi Inti. Pastikan aktivitas, latihan, asesmen, checklist, rangkuman di `bab-11.tex` selaras dengan section.

---

## Checklist Sebelum Selesai

- [ ] Setiap section memiliki 2–10 paragraf, masing-masing minimal 3 kalimat
- [ ] Setiap section memiliki minimal 2 elemen visual
- [ ] Minimal 2 gambar, 4 tabel, 5 contoh kode di seluruh bab
- [ ] Minimal 1 studi kasus lengkap
- [ ] Semua `\cite{key}` merujuk ke entri di `references.bib`
- [ ] File `bab/bab-11.tex` di-update
- [ ] Gambar di `images/bab-11/`
- [ ] Kompilasi LaTeX berhasil tanpa error
