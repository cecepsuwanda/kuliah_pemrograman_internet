# Judul Materi Belajar Evaluasi, Deployment dan Administrasi Web: Dasar sampai Mahir

Daftar judul materi ini disusun berdasarkan referensi pada bagian **"Referensi CPMK4 – Evaluasi, Deployment dan Administrasi Web"** di [sumber_materi.md](sumber_materi.md), serta kurikulum standar dari MDN Tools and testing, web.dev Performance, OWASP, PHP The Right Way Security, dan panduan deployment. Urutan dari dasar sampai mahir mengikuti alur: pengenalan pengujian & keamanan & deployment → pengujian fungsional dan performa → keamanan web (validasi, prepared statement, session, XSS, CSRF) → deployment dan administrasi produksi → topik lanjut (load testing, hardening, administrasi server/basis data).

---

## Tingkat Dasar

1. Pengenalan pengujian (testing) aplikasi web dan tujuannya
2. Jenis pengujian: fungsional, kompatibilitas, dan performa (pengenalan)
3. Pengenalan keamanan aplikasi web dan ancaman umum
4. Pengenalan validasi input dan sanitasi data
5. Pengenalan lingkungan development vs produksi
6. Pengenalan deployment dan siklus rilis aplikasi web
7. Pengenalan server web (Apache/Nginx) dan peran PHP
8. Pengenalan basis data dalam konteks produksi
9. Pengenalan environment variable dan konfigurasi per lingkungan
10. Alat pengujian dasar: browser DevTools dan Network/Console

---

## Tingkat Menengah

1. Strategi pengujian: manual vs otomatis, unit vs integrasi vs end-to-end (konsep)
2. Pengujian fungsional aplikasi web (form, alur, respons)
3. Pengukuran performa: metrik (load time, FCP, LCP) dan alat (PageSpeed, Network Monitor)
4. Validasi input di server (PHP): tipe data, format, dan whitelist
5. Prepared statement dan parameterized query: mencegah SQL injection
6. Session: memulai, menyimpan, regenerasi ID, dan pengelolaan aman
7. Cookie: SameSite, Secure, HttpOnly untuk keamanan
8. Pencegahan XSS: output encoding dan sanitasi output
9. Pencegahan CSRF: token, SameSite cookie, dan validasi origin
10. Konfigurasi PHP untuk produksi (error reporting, expose_php, session security)
11. Deployment ke server: upload, permissions, dan environment
12. Reverse proxy dan HTTPS (konsep dasar)

---

## Tingkat Lanjut / Mahir

1. Load testing dan stress testing: konsep dan skenario
2. Alat load testing: JMeter, Locust, atau k6 (penggunaan dasar)
3. Optimasi performa aplikasi web: caching, minifikasi, lazy loading (konsep)
4. Audit keamanan: OWASP Top 10 dan checklist keamanan
5. Session management lanjutan: fixation, hijacking, dan mitigasi
6. Hardening server: firewall, updates, dan konfigurasi aplikasi
7. Administrasi basis data di produksi: backup, restore, dan pemantauan
8. CI/CD dasar: otomasi build dan deploy (konsep)
9. Pemantauan aplikasi di produksi: log, error tracking, dan uptime
10. Referensi standar: MDN Deploying to production, OWASP Cheat Sheets, web.dev Performance, PHP The Right Way Security

---

## Referensi

Materi detail untuk setiap judul di atas dapat dipelajari dari referensi berikut (lihat bagian **"Referensi CPMK4 – Evaluasi, Deployment dan Administrasi Web"** di [sumber_materi.md](sumber_materi.md)):

- **MDN – Tools and testing** — Modul belajar pengujian aplikasi web: strategi testing, functional testing, compatibility testing, performance testing
- **MDN – Measuring performance** — Pengukuran performa web dengan PageSpeed Insights, Network Monitor, Performance Monitor
- **web.dev – Performance** — Materi belajar performa aplikasi web oleh Google (metrik, optimasi, alat)
- **Locust** — Framework open source untuk load testing dan evaluasi performa (Python)
- **Apache JMeter** — Aplikasi open source untuk load testing dan pengujian performa (Java)
- **Baeldung – Load Testing with k6** — Tutorial load testing dengan framework k6 (sumber terbuka)
- **PHP The Right Way – Security** — Praktik keamanan PHP: validasi input, prepared statement, session, sanitasi
- **OWASP – Cross Site Scripting Prevention Cheat Sheet** — Panduan pencegahan XSS (output encoding, validasi)
- **OWASP – Cross-Site Request Forgery Prevention Cheat Sheet** — Panduan pencegahan CSRF (token, SameSite cookie)
- **OWASP – Session Management Cheat Sheet** — Praktik aman pengelolaan session
- **OWASP – PHP Configuration Cheat Sheet** — Konfigurasi PHP yang aman untuk produksi
- **MDN – Server-side website programming (security)** — Konsep keamanan website sisi server (autentikasi, injeksi, XSS, CSRF)
- **MDN – Deploying to production** — Panduan deployment ke produksi: infrastruktur, hosting, environment
- **DigitalOcean – Set Up Application Server (Ubuntu)** — Konfigurasi server aplikasi, reverse proxy, SSL, process management
- **FreeCodeCamp – Deploy Node.js App to Production** — Langkah deployment aplikasi ke server produksi
- **Apache Friends – XAMPP** — Lingkungan development lokal; referensi untuk transisi ke produksi
- **PHP – Runtime Configuration** — Konfigurasi PHP untuk lingkungan produksi (dokumentasi resmi)
