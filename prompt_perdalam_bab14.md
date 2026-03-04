# Prompt: Perdalam Bab 14 — Deployment, Administrasi, dan Evaluasi Akhir (Visual Lengkap)

Kamu adalah asisten yang membantu memperdalam **Bab 14 (Deployment, Administrasi, dan Evaluasi Akhir)** dari buku ajar di folder **buku_ajar_pemrograman_web/**. Ikuti seluruh ketentuan di bawah ini. Gunakan **prompt_perdalam_bab2.md** sebagai referensi format dan aturan penulisan.

---

## Tujuan

Memperdalam Bab 14 dengan memanfaatkan:
1. **Referensi** dari `buku_ajar_pemrograman_web/references.bib`
2. **Sumber terbuka di internet** (MDN Deploy, PHP The Right Way, OWASP, Apache/Nginx, Let's Encrypt, GitHub Actions, dll.)
3. **Elemen visual kaya**: gambar, grafik, tabel, contoh, contoh coding, dan studi kasus
4. **Download gambar** menggunakan skrip Python jika diperlukan (diagram arsitektur server, ilustrasi CI/CD, screenshot panel)

---

## Konteks Bab 14

Bab 14 berjudul **"Deployment, Administrasi, dan Evaluasi Akhir"** dan memiliki **14 section**:

| # | File | Topik |
|---|------|-------|
| 1 | section-14-1.tex | Lingkungan Development vs Produksi |
| 2 | section-14-2.tex | Deployment dan Siklus Rilis Aplikasi Web |
| 3 | section-14-3.tex | Server Web (Apache/Nginx) dan Peran PHP |
| 4 | section-14-4.tex | Basis Data dalam Konteks Produksi |
| 5 | section-14-5.tex | Environment Variable dan Konfigurasi Per Lingkungan |
| 6 | section-14-6.tex | Konfigurasi PHP untuk Produksi |
| 7 | section-14-7.tex | Deployment ke Server: Upload, Permissions, Environment |
| 8 | section-14-8.tex | Reverse Proxy dan HTTPS |
| 9 | section-14-9.tex | Hardening Server: Firewall, Updates |
| 10 | section-14-10.tex | Administrasi Basis Data: Backup, Restore, Pemantauan |
| 11 | section-14-11.tex | CI/CD Dasar: Otomasi Build dan Deploy |
| 12 | section-14-12.tex | Pemantauan: Log, Error Tracking, Uptime |
| 13 | section-14-13.tex | Referensi Standar: MDN, OWASP, web.dev, PHP The Right Way |
| 14 | section-14-14.tex | Evaluasi Akhir dan Integrasi Kompetensi |

**Sub-CPMK:** Sub-CPMK 4.3: Melakukan deployment ke lingkungan produksi dan administrasi dasar (server/web, basis data).

Bab ini merupakan **Bab Akhir** yang menggabungkan asesmen akhir, evaluasi kompetensi, dan materi deployment/administrasi. Baca seluruh isi: `bab/bab-14.tex` dan `bab/bab-14/section-14-*.tex`.

---

## Tugas Utama

1. **Baca** Bab 14 dan referensi di `references.bib` serta sumber terbuka di internet
2. **Perdalam** penjelasan setiap section; kembangkan menjadi 2–10 paragraf (masing-masing minimal 3 kalimat)
3. **Tambahkan** elemen visual:
   - **Gambar** — diagram arsitektur server, reverse proxy, screenshot php.ini/panel
   - **Grafik** — flowchart siklus rilis, alur deployment, diagram CI/CD pipeline
   - **Tabel** — dev vs produksi, checklist php.ini, Apache vs Nginx, alat pemantauan
   - **Contoh coding** — file .env, blok php.ini, mysqldump, skrip backup, cron, GitHub Actions
   - **Studi kasus** — deploy aplikasi PHP ke produksi; backup-restore database (minimal 2)
4. **Boleh hapus atau tambah section baru** selama mengikuti struktur OBE dan format buku_ajar
5. **Update `bab/bab-14.tex`** dan **`references.bib`** jika ada perubahan

---

## Download Gambar dengan Python

```python
# download_gambar_bab14.py
import requests
from pathlib import Path

def download_image(url, filename):
    folder = Path("buku_ajar_pemrograman_web/images/bab-14")
    folder.mkdir(parents=True, exist_ok=True)
    response = requests.get(url)
    response.raise_for_status()
    filepath = folder / filename
    with open(filepath, 'wb') as f:
        f.write(response.content)
    print(f"Downloaded: {filepath}")
```

Aturan: Simpan di `images/bab-14/`; LaTeX: `\includegraphics[width=\textwidth]{images/bab-14/nama-file.png}`

---

## Elemen Visual yang Wajib Diterapkan

### Per Section — Minimal 2 dari daftar berikut:

| Elemen | Contoh untuk Bab 14 | LaTeX/Format |
|--------|---------------------|--------------|
| **Tabel** | Dev vs produksi, checklist php.ini, Apache vs Nginx, alat pemantauan | `\begin{tabular}`, kolom `P{Xcm}` |
| **Gambar** | Diagram arsitektur server, reverse proxy, screenshot error log | `\includegraphics` atau TikZ |
| **Grafik/Diagram** | Flowchart siklus rilis, alur deployment, pipeline CI/CD | `\begin{tikzpicture}` |
| **Contoh kode** | .env, php.ini, mysqldump, cron, GitHub Actions, konfigurasi Nginx | `\begin{webcode}[language=Bash|PHP|ini|YAML, caption={...}]` |
| **Studi kasus** | Deploy aplikasi ke VPS; backup-restore database | Paragraf naratif + diagram/langkah |
| **Box** | Konsep penting, catatan keamanan | `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}` |

### Seluruh Bab 14 — Wajib ada:

- Minimal **2 gambar**
- Minimal **4 tabel**
- Minimal **4 contoh kode**
- Minimal **2 studi kasus** lengkap

---

## Aturan Penulisan per Section

- **Jumlah paragraf**: minimal 2, maksimal 10; setiap paragraf minimal 3 kalimat
- **Gaya**: tutorial untuk pemula; sertakan definisi, analogi, contoh konkret (perintah, konfigurasi)
- **Elemen visual**: per section minimal 2 elemen

---

## Referensi dan Sitasi

### Prioritas: gunakan dari `references.bib`

| Key | Judul | Relevansi |
|-----|-------|-----------|
| `mdnDeploy` | Deploying to production | Deployment, konfigurasi, hosting |
| `phpRightWay` | PHP The Right Way | Keamanan, konfigurasi PHP produksi |
| `phpManual` | PHP Manual | Konfigurasi php.ini |
| `mysqlDocs` | MySQL Documentation | Backup, restore, administrasi DB |
| `owaspXss` | XSS Prevention | Keamanan web |
| `owaspCsrf` | CSRF Prevention | Keamanan web |

### Sumber baru: tambahkan di `references.bib` dan gunakan `\cite{keyBaru}`

---

## Saran Pengembangan per Section

- 14-1: Tabel dev vs produksi, staging environment
- 14-2: Flowchart siklus rilis, checklist pra-deployment
- 14-3: Apache vs Nginx, mod_php, PHP-FPM
- 14-5: File .env, phpdotenv, .gitignore
- 14-6: Pengaturan php.ini, OPcache
- 14-7: Langkah SFTP/Git, chmod, struktur folder
- 14-8: Diagram reverse proxy, Let's Encrypt, certbot
- 14-9: Firewall (UFW), update rutin, user non-root
- 14-10: mysqldump, cron backup, slow_query_log
- 14-11: Pipeline GitHub Actions, build, test, deploy
- 14-12: Jenis log, Sentry, uptime monitoring

---

## Format File Output

- Section: `bab/bab-14/section-14-N.tex`; utama: `bab/bab-14.tex`
- Kode: `\begin{webcode}[language=Bash|PHP|ini|YAML, caption={...}]`; box: `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}`

---

## Contoh Studi Kasus

### Studi Kasus 1: Deploy Aplikasi ke Server VPS

```latex
\begin{contoh}
\textbf{Studi Kasus: Deploy Toko Online ke Server VPS}

Instal Apache/PHP/MySQL; clone proyek ke /var/www; buat .env; atur permission; konfigurasi virtual host; pasang SSL; import DB; nonaktifkan display_errors; uji fitur.
\end{contoh}
```

### Studi Kasus 2: Backup dan Restore Database

```latex
\begin{contoh}
\textbf{Studi Kasus: Pemulihan Database}

Restore: mysql -u user -p db < backup.sql. Contoh skrip backup: mysqldump dengan cron.
\end{contoh}
```

---

## Struktur OBE

Bab 14 adalah Bab Akhir. Pastikan aktivitas, latihan, asesmen, checklist, rangkuman di `bab-14.tex` selaras dengan section.

---

## Checklist Sebelum Selesai

- [ ] Setiap section memiliki 2–10 paragraf, masing-masing minimal 3 kalimat
- [ ] Setiap section memiliki minimal 2 elemen visual
- [ ] Minimal 2 gambar, 4 tabel, 4 contoh kode di seluruh bab
- [ ] Minimal 2 studi kasus lengkap
- [ ] Semua `\cite{key}` merujuk ke entri di `references.bib`
- [ ] File `bab/bab-14.tex` di-update
- [ ] Gambar di `images/bab-14/`
- [ ] Kompilasi LaTeX berhasil tanpa error
