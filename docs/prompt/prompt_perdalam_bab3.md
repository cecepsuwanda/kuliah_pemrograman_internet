# Prompt: Perdalam Bab 3 — Analisis Kebutuhan dan Perancangan Antarmuka (Visual Lengkap)

Kamu adalah asisten yang membantu memperdalam **Bab 3 (Analisis Kebutuhan dan Perancangan Antarmuka)** dari buku ajar di folder **buku_ajar_pemrograman_web/**. Ikuti seluruh ketentuan di bawah ini. Gunakan **prompt_perdalam_bab2_visual_lengkap.md** sebagai referensi format dan aturan penulisan.

---

## Tujuan

Memperdalam Bab 3 dengan memanfaatkan:
1. **Referensi** dari `buku_ajar_pemrograman_web/references.bib`
2. **Sumber terbuka di internet** (MDN Accessibility, web.dev, Figma docs, WCAG, Nielsen Norman Group, dll.)
3. **Elemen visual kaya**: gambar, grafik, tabel, contoh, contoh coding, dan studi kasus
4. **Download gambar** menggunakan skrip Python jika diperlukan (wireframe contoh, mockup, screenshot alat desain, diagram)

---

## Konteks Bab 3

Bab 3 berjudul **"Analisis Kebutuhan dan Perancangan Antarmuka"** dan memiliki **26 section** (section-3-1 s.d. section-3-26). Setiap section saat ini hanya berisi 1–2 paragraf pendek. Section perlu diperdalam dan boleh digabung agar menjadi 10–15 section mendalam.

### Daftar Section Saat Ini

1. **section-3-1**: Pengenalan Analisis Kebutuhan dalam Pengembangan Solusi Web
2. **section-3-2**: Kebutuhan Fungsional dan Non-Fungsional: Definisi dan Perbedaan
3. **section-3-3**: Pengenalan UI (User Interface) dan UX (User Experience)
4. **section-3-4**: Mengenal Pengguna (User) dan Konteks Penggunaan
5. **section-3-5**: Pengenalan Wireframe dan Mockup
6. **section-3-6**: Perbedaan Low-Fidelity dan High-Fidelity dalam Desain
7. **section-3-7**: Pengenalan User Flow dan Alur Pengguna
8. **section-3-8**: Pengenalan Aksesibilitas (a11y) dan Pengalaman Pengguna (UX) untuk Web
9. **section-3-9**: Penggalian Kebutuhan (Elicitation) dan Wawancara Pengguna
10. **section-3-10**: Mendokumentasikan Kebutuhan Fungsional dan Non-Fungsional
11. **section-3-11**: Analisis Tugas (Task Analysis) dan Pemetaan User Flow
12. **section-3-12**: Membuat Wireframe (Low-Fidelity) untuk Halaman Web
13. **section-3-13**: Membuat Mockup (High-Fidelity) dari Wireframe
14. **section-3-14**: Prinsip Desain Visual Dasar: Layout, Hierarki, dan Konsistensi
15. **section-3-15**: Prinsip Pengalaman Pengguna: Usability dan Learnability
16. **section-3-16**: Aksesibilitas Web: Prinsip WCAG dan HTML Semantik
17. **section-3-17**: Prototyping dan Iterasi Desain
18. **section-3-18**: Alat Desain: Pengenalan Figma (atau Alternatif)
19. **section-3-19**: Prioritisasi dan Validasi Kebutuhan (MoSCoW, Acceptance Criteria)
20. **section-3-20**: User Flow Lanjutan dan Skenario Pengguna
21. **section-3-21**: Design System dan Konsistensi Antarmuka
22. **section-3-22**: Aksesibilitas Lanjutan: Audit WCAG, ARIA, dan Pengujian a11y
23. **section-3-23**: UX Research dan Usability Testing
24. **section-3-24**: Handoff Desain ke Pengembang: Spesifikasi dan Komponen
25. **section-3-25**: Praktik Terbaik Desain dan Aksesibilitas untuk Produk Web
26. **section-3-26**: Referensi Standar: W3C WAI, web.dev Accessibility, MDN Accessibility

**Sub-CPMK** yang dicakup:
- Sub-CPMK 1.1: Mengidentifikasi kebutuhan fungsional dan non-fungsional pengguna untuk solusi web
- Sub-CPMK 1.2: Membuat wireframe dan mockup antarmuka web yang mendukung alur pengguna
- Sub-CPMK 1.3: Menerapkan prinsip aksesibilitas (a11y) dan pengalaman pengguna (UX)

Menurut **struktur_bab_buku_ajar_OBE.text**, bab inti harus memuat: Judul Bab, Outcome Pembelajaran Khusus (Sub-CPMK), Materi Pokok (dengan contoh/ilustrasi/grafik/kasus), Aktivitas Pembelajaran, Soal Latihan & Refleksi, Asesmen, Checklist Pencapaian Kompetensi, dan Rangkuman.

Baca seluruh isi Bab 3: `bab/bab-03.tex` dan semua file `bab/bab-03/section-3-*.tex`.

---

## Tugas Utama

1. **Baca** Bab 3 dan referensi di `references.bib` serta sumber terbuka di internet
2. **Perdalam** penjelasan setiap section; kembangkan menjadi 2–10 paragraf (masing-masing minimal 3 kalimat) dengan definisi, contoh, analogi, dan elemen visual
3. **Tambahkan** elemen visual ke dalam section (distribusikan secara merata):
   - **Gambar** — contoh wireframe, mockup, screenshot Figma/Balsamiq, ilustrasi prinsip WCAG, before/after aksesibilitas (boleh didownload dengan Python)
   - **Grafik** — flowchart proses analisis kebutuhan, diagram user flow, bagan MoSCoW, diagram POUR (WCAG)
   - **Tabel** — perbandingan kebutuhan fungsional vs non-fungsional, wireframe vs mockup, checklist WCAG, komponen design system
   - **Contoh** — template persona, contoh acceptance criteria, contoh user flow, contoh design token
   - **Contoh coding** — snippet HTML semantik untuk aksesibilitas, struktur ARIA, CSS design system
   - **Studi kasus** — aplikasi catatan harian, toko online sederhana, atau sistem booking—dari kebutuhan sampai wireframe dan mockup (minimal 1–2 studi kasus)
4. **Boleh hapus, gabung, atau tambah section baru** selama mengikuti struktur OBE dan format di **buku_ajar/**
5. **Update `references.bib`** jika menggunakan sumber baru; sertakan sitasi `\cite{key}` di section yang mengutip

### Catatan Khusus: Penggabungan Section

Bab ini memiliki 26 section yang sangat tipis. **Boleh menggabungkan** section yang topiknya mirip menjadi satu section yang lebih dalam. Misalnya:
- Section 3-1 dan 3-9 (analisis kebutuhan + elicitation) → bisa digabung
- Section 3-5, 3-6, 3-12, 3-13 (wireframe + mockup) → bisa digabung
- Section 3-8, 3-16, 3-22 (aksesibilitas) → bisa digabung
- Section 3-25 dan 3-26 (praktik terbaik + referensi) → bisa digabung

**Target: 10–15 section yang mendalam** lebih baik daripada 26 section yang dangkal.

---

## Download Gambar dengan Python

Jika memerlukan gambar dari internet (contoh wireframe, mockup, diagram UI/UX, screenshot alat), buat skrip Python untuk mengunduhnya:

```python
# download_gambar_bab3.py
import requests
from pathlib import Path

def download_image(url, filename):
    """Download gambar dari URL dan simpan ke folder images/bab-03/"""
    folder = Path("buku_ajar_pemrograman_web/images/bab-03")
    folder.mkdir(parents=True, exist_ok=True)
    response = requests.get(url)
    response.raise_for_status()
    filepath = folder / filename
    with open(filepath, 'wb') as f:
        f.write(response.content)
    print(f"Downloaded: {filepath}")

# Contoh: download gambar sumber terbuka
# download_image("https://example.com/wireframe-contoh.png", "wireframe-landing.png")
```

Aturan penggunaan gambar:
- Simpan di `buku_ajar_pemrograman_web/images/bab-03/` (buat folder jika belum ada)
- Gunakan format PNG, JPG, atau SVG
- Pastikan sumber gambar terbuka dan berhak digunakan (lisensi permissive, public domain, atau fair use)
- Sertakan atribusi/caption sumber jika wajib
- Dalam LaTeX: `\includegraphics[width=\textwidth]{images/bab-03/nama-file.png}`

---

## Elemen Visual yang Wajib Diterapkan

### Per Section — Minimal 2 dari daftar berikut:

| Elemen | Contoh (relevan Bab 3) | LaTeX/Format |
|--------|------------------------|--------------|
| **Tabel** | Fungsional vs non-fungsional, wireframe vs mockup, checklist WCAG, MoSCoW | `\begin{tabular}`, kolom `P{Xcm}` |
| **Gambar** | Contoh wireframe, mockup, persona, screenshot Figma, diagram user flow | `\includegraphics` atau TikZ |
| **Grafik/Diagram** | Flowchart analisis kebutuhan, user flow, diagram POUR, alur handoff | `\begin{tikzpicture}` dengan style dari preamble |
| **Contoh kode** | HTML semantik, ARIA attributes, CSS design token, template dokumen | `\begin{webcode}[language=HTML|CSS, caption={...}]` |
| **Studi kasus** | Aplikasi catatan harian: kebutuhan → persona → wireframe → mockup → user flow | Paragraf naratif + diagram/flow |
| **Box** | Konsep penting, catatan, contoh | `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}` |

### Seluruh Bab 3 — Wajib ada:

- Minimal **3 gambar** (wireframe, mockup, atau diagram UI/UX—dapat TikZ atau file gambar)
- Minimal **4 tabel** (kebutuhan, wireframe vs mockup, WCAG, design system)
- Minimal **3 contoh kode** (HTML semantik, ARIA, CSS, atau template dokumen)
- Minimal **2 studi kasus** lengkap (satu untuk analisis kebutuhan + wireframe, satu untuk aksesibilitas atau design system)

---

## Aturan Penulisan per Section

- **Jumlah paragraf**: minimal 2, maksimal 10; setiap paragraf minimal 3 kalimat
- **Gaya**: tutorial untuk pemula; bahasa jelas, bertahap; sertakan definisi, analogi, contoh konkret
- **Elemen visual**: per section minimal 2 elemen (tabel/gambar/grafik/kode/studi kasus/box)

---

## Referensi dan Sitasi

### Prioritas: gunakan referensi dari `references.bib`

| Key | Judul | Relevansi |
|-----|-------|-----------|
| `mdnLearn` | MDN Learn Web Development | Konteks umum |
| `webdevLearn` | web.dev Learn Web Development | Konteks pembelajaran |
| `mdnAccessibility` | Accessibility (Learn web development) | WCAG, aksesibilitas, HTML semantik |
| `webdevAccessibility` | web.dev Learn Accessibility | Prinsip a11y, desain inklusif |
| `mdnHtmlIntro` | Introduction to HTML | HTML semantik |
| `w3schoolsTutorials` | W3Schools Tutorials | Referensi umum |
| `mdnCss` | Styling the Web with CSS | Desain, layout |
| `w3cValidator` | W3C Markup Validation Service | Validasi HTML |
| `mdnToolsTesting` | Tools and testing | Pengujian |
| `aptikomObe` | Panduan Kurikulum Berbasis OBE | Konteks OBE |

### Sumber baru dari internet

Gunakan sumber terbuka tambahan (WCAG spesifikasi, Figma tutorial, Balsamiq, Nielsen Norman Group, Interaction Design Foundation) bila perlu. Jika menambahkan sumber baru:

1. **Tambahkan entri di `references.bib`**:
```bibtex
@misc{keyBaru,
  author = {Nama Penulis/Organisasi},
  title = {Judul Halaman atau Dokumen},
  year = {2026},
  howpublished = {\url{https://url-lengkap}}
}
```

2. **Sertakan sitasi** `\cite{keyBaru}` di section yang mengutip

---

## Saran Penggabungan dan Topik Section

Berikut saran penggabungan menjadi **12 section mendalam** (boleh disesuaikan):

1. **Pengenalan Analisis Kebutuhan dalam Pengembangan Web** *(gabungan 3-1 + 3-9)* — Definisi, elicitation, wawancara, output dokumen
2. **Kebutuhan Fungsional dan Non-Fungsional** *(gabungan 3-2 + 3-10 + 3-19)* — Definisi, dokumentasi, MoSCoW, acceptance criteria
3. **Memahami Pengguna: Persona, Skenario, dan Konteks** *(gabungan 3-4 + 3-20)* — Persona, skenario, user flow lanjutan
4. **Pengenalan UI dan UX** *(dari 3-3)* — Definisi UI vs UX, hubungan, prinsip dasar
5. **Wireframe dan Mockup: Low-Fidelity hingga High-Fidelity** *(gabungan 3-5 + 3-6 + 3-12 + 3-13)* — Wireframe, mockup, alat, langkah pembuatan
6. **User Flow dan Analisis Tugas** *(gabungan 3-7 + 3-11)* — User flow, task analysis, diagram
7. **Prinsip Desain Visual: Layout, Hierarki, Tipografi, dan Warna** *(dari 3-14)* — Grid, hierarki, konsistensi
8. **Prinsip UX: Usability, Learnability, dan Heuristik Nielsen** *(dari 3-15)* — Usability, learnability, 10 heuristik Nielsen
9. **Aksesibilitas Web: WCAG, HTML Semantik, dan ARIA** *(gabungan 3-8 + 3-16 + 3-22)* — POUR, HTML semantik, ARIA, audit
10. **Prototyping, Iterasi, dan Alat Desain (Figma)** *(gabungan 3-17 + 3-18)* — Prototype, iterasi, Figma
11. **Design System, Handoff, dan Konsistensi Antarmuka** *(gabungan 3-21 + 3-24)* — Design system, handoff ke developer
12. **UX Research, Usability Testing, dan Praktik Terbaik** *(gabungan 3-23 + 3-25 + 3-26)* — UX research, usability testing, referensi standar

---

## Format File Output

- Setiap section: `bab/bab-03/section-3-N.tex`
- File utama: `bab/bab-03.tex` — update daftar `\input`
- **Hapus file section lama yang tidak dipakai** setelah penggabungan
- Kode inline: `\code{...}`
- Tabel: `tabular` dengan `\hline`, kolom `P{Xcm}` (ragged right)
- Gambar: `\begin{figure}[ht] \centering \includegraphics[width=...]{path} \caption{...} \end{figure}`
- Diagram TikZ: style `class`, `object`, `arrow` dari preamble
- Kode program: `\begin{webcode}[language=HTML|CSS, caption={...}]`
- Box: `\begin{konsep}`, `\begin{catatan}`, `\begin{contoh}`

---

## Contoh Pola Section

```latex
\section{Judul Section}
Paragraf pertama: penjelasan konsep utama, definisi, konteks. Minimal 3 kalimat. Sitasi \cite{mdnLearn}.

Paragraf kedua: detail tambahan, contoh konkret. Minimal 3 kalimat. Sitasi \cite{webdevAccessibility}.

\begin{table}[ht]
\centering
\begin{tabular}{|P{4cm}|P{8cm}|}
\hline
\textbf{Kolom 1} & \textbf{Kolom 2} \\
\hline
Item 1 & Deskripsi 1 \\
\hline
\end{tabular}
\caption{Judul tabel}
\end{table}
```

---

## Contoh Studi Kasus (relevan Bab 3)

### Studi Kasus 1: Aplikasi Catatan Harian

```latex
\begin{contoh}
\textbf{Studi Kasus: Dari Kebutuhan sampai Wireframe untuk Aplikasi Catatan Harian}

\textbf{Tahap 1 — Kebutuhan:} Pengguna ingin mencatat kegiatan harian, mengedit, dan menghapus. Kebutuhan non-fungsional: responsif, load cepat, dapat dipakai pengguna tunanetra (screen reader).

\textbf{Tahap 2 — Persona:} "Budi, mahasiswa, 22 tahun, menggunakan smartphone untuk catatan cepat. Kadang pakai laptop untuk review."

\textbf{Tahap 3 — User Flow (Tambah Catatan):} Buka app → Klik "Tambah" → Isi form → Klik "Simpan" → Tampil di daftar.

\textbf{Tahap 4 — Wireframe:} Gambar sketsa low-fi menampilkan header, tombol Tambah, daftar kartu catatan, form modal.
\end{contoh}
```

### Studi Kasus 2: Aksesibilitas Form Login

```latex
\begin{contoh}
\textbf{Studi Kasus: Meningkatkan Aksesibilitas Form Login}

\textbf{Masalah:} Form login tanpa label terlihat, placeholder saja, kontras rendah.

\textbf{Solusi:} Gunakan \code{<label for="...">}, \code{aria-describedby} untuk pesan error, kontras minimal 4.5:1, fokus visible.

\begin{webcode}[language=HTML, caption={Form login aksesibel}]
<label for="email">Email</label>
<input type="email" id="email" name="email" required 
       aria-describedby="email-error">
<span id="email-error" role="alert"></span>
\end{webcode}
\end{contoh}
```

---

## Struktur OBE (struktur_bab_buku_ajar_OBE.text)

Bab 3 adalah **Unit Materi Inti**. Pastikan:

- Materi pokok disertai contoh, ilustrasi, grafik, atau kasus
- Tetap ada: Sub-CPMK, materi pokok, aktivitas pembelajaran, latihan, asesmen, checklist, rangkuman
- Update `\begin{aktivitas}`, `\begin{latihan}`, `\begin{asesmen}`, `\begin{checklist}`, `\begin{rangkuman}` di `bab-03.tex`

---

## Checklist Sebelum Selesai

- [ ] Section sudah digabung/dikurangi dari 26 menjadi sekitar 10–15 section mendalam
- [ ] Setiap section memiliki 2–10 paragraf, masing-masing minimal 3 kalimat
- [ ] Setiap section memiliki minimal 2 elemen visual (tabel/diagram/kode/studi kasus/box)
- [ ] Minimal 3 gambar, 4 tabel, 3 contoh kode di seluruh bab
- [ ] Minimal 2 studi kasus lengkap
- [ ] Semua `\cite{key}` merujuk ke entri di `references.bib`
- [ ] Sumber baru (jika ada) sudah ditambahkan ke `references.bib` dan disitasi
- [ ] File `bab/bab-03.tex` di-update: daftar `\input`, aktivitas, latihan, asesmen, checklist, rangkuman
- [ ] File section lama yang tidak dipakai sudah dihapus atau dikosongkan
- [ ] Gambar (jika didownload) disimpan di `images/bab-03/` dan path di LaTeX benar
- [ ] Format mengikuti buku_ajar (preamble, struktur bab)
- [ ] Tidak ada overfull/underfull hbox yang parah
- [ ] Kompilasi LaTeX berhasil tanpa error
