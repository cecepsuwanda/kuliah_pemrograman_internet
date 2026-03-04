# Prompt: Perdalam Bab 13 — Integrasi API, Evaluasi, dan Keamanan Web (Visual Lengkap)

Kamu adalah asisten yang membantu memperdalam **Bab 13 (Integrasi API, Evaluasi, dan Keamanan Web)** dari buku ajar di folder **buku_ajar_pemrograman_web/**. Ikuti seluruh ketentuan di bawah ini. Gunakan **prompt_perdalam_bab2.md** sebagai referensi format dan aturan penulisan.

---

## Tujuan

Memperdalam Bab 13 dengan memanfaatkan:
1. **Referensi** dari `buku_ajar_pemrograman_web/references.bib`
2. **Sumber terbuka di internet** (MDN, OWASP, PHP The Right Way, web.dev, dokumentasi, tutorial, dll.)
3. **Elemen visual kaya**: gambar, grafik, tabel, contoh, contoh coding, dan studi kasus
4. **Download gambar** menggunakan skrip Python jika diperlukan (diagram keamanan, flowchart pengujian, ilustrasi XSS/CSRF)

---

## Konteks Bab 13

Bab 13 berjudul **"Integrasi API, Evaluasi, dan Keamanan Web"** dan memiliki **20 section**:

| # | File | Topik |
|---|------|-------|
| 1 | section-13-1.tex | Integrasi API dan Pertukaran Data |
| 2 | section-13-2.tex | Pengenalan Pengujian Aplikasi Web |
| 3 | section-13-3.tex | Jenis Pengujian: Fungsional, Kompatibilitas, Performa |
| 4 | section-13-4.tex | Alat Pengujian: DevTools, Network, Console |
| 5 | section-13-5.tex | Strategi: Manual vs Otomatis, Unit vs Integrasi vs E2E |
| 6 | section-13-6.tex | Pengujian Fungsional (Form, Alur, Respons) |
| 7 | section-13-7.tex | Pengukuran Performa: Metrik dan Alat |
| 8 | section-13-8.tex | Pengenalan Keamanan dan Ancaman Umum |
| 9 | section-13-9.tex | Validasi Input dan Sanitasi Data |
| 10 | section-13-10.tex | Validasi Input di Server (PHP) |
| 11 | section-13-11.tex | Prepared Statement: Mencegah SQL Injection |
| 12 | section-13-12.tex | Session: Regenerasi ID, Pengelolaan Aman |
| 13 | section-13-13.tex | Cookie: SameSite, Secure, HttpOnly |
| 14 | section-13-14.tex | Pencegahan XSS: Output Encoding |
| 15 | section-13-15.tex | Pencegahan CSRF: Token, SameSite, Validasi Origin |
| 16 | section-13-16.tex | Load Testing dan Stress Testing |
| 17 | section-13-17.tex | Alat Load Testing: JMeter, Locust, k6 |
| 18 | section-13-18.tex | Optimasi Performa: Caching, Minifikasi, Lazy Loading |
| 19 | section-13-19.tex | Audit Keamanan: OWASP Top 10 |
| 20 | section-13-20.tex | Session Management: Fixation, Hijacking |

**Sub-CPMK:**
- Sub-CPMK 3.3: Mengintegrasikan API dan front-end dengan back-end
- Sub-CPMK 4.1: Melakukan pengujian dan evaluasi performa
- Sub-CPMK 4.2: Menerapkan keamanan aplikasi web

Baca seluruh isi Bab 13: `bab/bab-13.tex` dan `bab/bab-13/section-13-*.tex`.

---

## Tugas Utama

1. **Baca** Bab 13 dan referensi di `references.bib` serta sumber terbuka di internet
2. **Perdalam** penjelasan setiap section; kembangkan menjadi 2–10 paragraf (masing-masing minimal 3 kalimat)
3. **Tambahkan** elemen visual:
   - **Gambar** — diagram arsitektur API, screenshot DevTools/Lighthouse, ilustrasi XSS/CSRF/SQL injection
   - **Grafik** — flowchart pengujian, alur request API, ancaman keamanan
   - **Tabel** — jenis pengujian, metrik performa, OWASP Top 10, prepared statement vs query biasa
   - **Contoh coding** — Fetch API, filter_var, prepared statement, htmlspecialchars, CSRF token
   - **Studi kasus** — form login aman, API + pengujian (minimal 2–3)
4. **Boleh hapus atau tambah section baru** selama mengikuti struktur OBE dan format buku_ajar
5. **Update `bab/bab-13.tex`** dan **`references.bib`** jika ada perubahan

---

## Download Gambar dengan Python

```python
# download_gambar_bab13.py
import requests
from pathlib import Path

def download_image(url, filename):
    folder = Path("buku_ajar_pemrograman_web/images/bab-13")
    folder.mkdir(parents=True, exist_ok=True)
    response = requests.get(url)
    response.raise_for_status()
    filepath = folder / filename
    with open(filepath, 'wb') as f:
        f.write(response.content)
    print(f"Downloaded: {filepath}")
```

Aturan: Simpan di `images/bab-13/`; LaTeX: `\includegraphics[width=\textwidth]{images/bab-13/nama-file.png}`

---

## Elemen Visual yang Wajib Diterapkan

### Per Section — Minimal 2 dari daftar berikut:

| Elemen | Contoh untuk Bab 13 | LaTeX/Format |
|--------|---------------------|--------------|
| **Tabel** | Jenis pengujian, OWASP Top 10, metrik performa, atribut cookie | `\begin{tabular}`, kolom `P{Xcm}` |
| **Gambar** | Diagram API, screenshot Network, alur XSS/CSRF | `\includegraphics` atau TikZ |
| **Grafik/Diagram** | Flowchart pengujian, alur request-response API | `\begin{tikzpicture}` |
| **Contoh kode** | Fetch API, filter_var, prepared statement, htmlspecialchars, CSRF token | `\begin{webcode}[language=JavaScript|PHP, caption={...}]` |
| **Studi kasus** | Form login aman; API + pengujian + load test | Paragraf naratif + kode + diagram |
| **Box** | Konsep penting, catatan keamanan | `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}` |

### Seluruh Bab 13 — Wajib ada:

- Minimal **3 gambar**
- Minimal **5 tabel**
- Minimal **6 contoh kode**
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
| `mdnJsGuide` | JavaScript Guide | Fetch API |
| `mdnToolsTesting` | Tools and testing | Pengujian, performa |
| `phpManual` | PHP Manual | Validasi, prepared statement |
| `phpRightWay` | PHP The Right Way | Keamanan |
| `owaspXss` | XSS Prevention Cheat Sheet | Pencegahan XSS |
| `owaspCsrf` | CSRF Prevention Cheat Sheet | Pencegahan CSRF |

### Sumber baru: tambahkan di `references.bib` dan gunakan `\cite{keyBaru}`

---

## Saran Perdalaman per Section

- 13-1: REST API, JSON, Fetch, error handling
- 13-2–13-7: Jenis pengujian, DevTools, strategi, metrik (FCP, LCP, CLS), Lighthouse
- 13-8–13-15: Ancaman, validasi vs sanitasi, filter_var, prepared statement, session, cookie, XSS, CSRF
- 13-16–13-18: Load/stress testing, JMeter/Locust/k6, caching, minifikasi
- 13-19–13-20: OWASP Top 10, session fixation/hijacking

---

## Format File Output

- Section: `bab/bab-13/section-13-N.tex`; utama: `bab/bab-13.tex`
- Kode: `\begin{webcode}[language=PHP|JavaScript, caption={...}]`; box: `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}`

---

## Contoh Studi Kasus

```latex
\begin{contoh}
\textbf{Studi Kasus: Form Login yang Aman}

Validasi input; prepared statement SELECT; htmlspecialchars pada output; CSRF token; session regenerasi ID; cookie HttpOnly, Secure.
\end{contoh}
```

---

## Struktur OBE

Bab 13 adalah Unit Materi Inti. Pastikan aktivitas, latihan, asesmen, checklist, rangkuman di `bab-13.tex` selaras dengan section.

---

## Checklist Sebelum Selesai

- [ ] Setiap section memiliki 2–10 paragraf, masing-masing minimal 3 kalimat
- [ ] Setiap section memiliki minimal 2 elemen visual
- [ ] Minimal 3 gambar, 5 tabel, 6 contoh kode di seluruh bab
- [ ] Minimal 2 studi kasus lengkap
- [ ] Semua `\cite{key}` merujuk ke entri di `references.bib`
- [ ] File `bab/bab-13.tex` di-update
- [ ] Gambar di `images/bab-13/`
- [ ] Kompilasi LaTeX berhasil tanpa error
