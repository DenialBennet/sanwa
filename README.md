# PT Sanwa Antar Nusa — Next.js + Supabase

Aplikasi sekarang berjalan dengan Next.js App Router, React, TypeScript, dan database PostgreSQL Supabase. Vercel menjalankan Next.js tanpa PHP atau Composer. Landing page memakai konten HTML lokal dengan interaksi Alpine yang dibundel lewat npm; data jadwal dan panel admin menggunakan React/Next.js.

## Status deployment

- Production aktif: https://sanwa-three.vercel.app
- Login admin: https://sanwa-three.vercel.app/sanwa-internal-portal/login
- Project Vercel: https://vercel.com/daniel-bennet/sanwa
- Repository: https://github.com/PHANTAHT/sanwa, branch `main`; perubahan yang dipush akan dideploy otomatis.
- Tujuh jadwal lama sudah diimpor ke Supabase. Jadwal Juni–Juli tidak tampil pada periode publik September–Oktober; seluruhnya tetap tersedia di admin.
- `sanwaantarnusa.com` sudah ditambahkan ke Production; `www.sanwaantarnusa.com` diatur redirect permanen (308) ke domain utama. Keduanya masih menunggu perubahan DNS pada penyedia domain.

Record yang diminta dashboard Vercel:

| Type | Name | Value |
| --- | --- | --- |
| A | `@` | `216.198.79.1` |
| CNAME | `www` | `0db98c85e8fd359b.vercel-dns-017.com.` |

Nameserver saat diperiksa: `bromo.cloudhost.id` dan `rinjani.cloudhost.id`. Record MX masih mengarah ke `sanwaantarnusa.com` sendiri, sehingga penggunaan email domain perlu diperiksa sebelum record A diubah. Panel DNS belum diakses saat deployment awal.

Supabase Auth Site URL sementara memakai alamat Vercel yang sudah aktif; redirect domain utama, www, dan localhost sudah terdaftar. Setelah DNS dan HTTPS domain utama valid, ubah Site URL menjadi `https://sanwaantarnusa.com`.

## Jalankan lokal

Gunakan Node.js 22.13 atau lebih baru.

```sh
npm ci
copy .env.example .env.local
npm run dev
```

Isi `.env.local` dengan URL project dan **publishable key** dari Supabase → Project Settings → API. Publishable key boleh digunakan aplikasi; akses data dibatasi RLS. Aplikasi ini tidak membutuhkan `service_role` atau secret key.

Buka 
. Tanpa konfigurasi Supabase, halaman publik tetap terbuka dan menampilkan pesan bahwa jadwal belum tersedia.

## Siapkan Supabase gratis

1. Buat project di https://supabase.com, pilih region terdekat seperti Singapore.
2. Buka SQL Editor. Jalankan isi `supabase/migrations/202610090001_initial.sql` **sekali** pada project baru. Ini membuat tabel jadwal, daftar admin, indeks, dan kebijakan RLS.
3. Di Authentication → Providers → Email, nonaktifkan pendaftaran akun publik (Allow new users to sign up). Tidak ada halaman signup di aplikasi.
4. Di Authentication → Users → Add user, buat akun admin dengan email dan password sendiri. Konfirmasi email akun tersebut.
5. Daftarkan akun tersebut sebagai admin melalui SQL Editor:

```sql
insert into public.admin_users (user_id)
select id from auth.users where email = 'EMAIL_ADMIN_KAMU'
on conflict do nothing;
```

6. Isi dua environment variables Supabase di `.env.local`.
7. Buka `/sanwa-internal-portal/login`, masuk, lalu tambah jadwal.

Jangan memakai akun demo Laravel untuk produksi. Password Laravel tidak otomatis dipindahkan; akun admin baru dikelola Supabase Auth. Login memakai pembatasan percobaan bawaan Supabase Auth. Pengguna biasa tidak dapat mengubah jadwal, sekalipun mengakses REST API Supabase langsung.

## Pindahkan jadwal lama

Sumber Laravel dan perubahan lokal pada `DatabaseSeeder.php` disimpan di `legacy/laravel/`. Folder ini tidak dibutuhkan saat deploy. Beberapa folder cache Laravel yang terkunci masih ada di root lokal dan juga tersalin di arsip.

Database SQLite lokal dibaca tanpa dimodifikasi:

```sh
node scripts/export-sqlite.mjs
```

Jika database berada di lokasi lain:

```sh
node scripts/export-sqlite.mjs PATH_KE_DATABASE.sqlite
```

Jalankan SQL hasilnya di `exports/schedules.sql` melalui Supabase SQL Editor, sesudah migration. Export mempertahankan ID dan status FULL; ID yang sudah ada dilewati agar tidak menimpa data baru. File export diabaikan Git dan Vercel. Script hanya memindahkan jadwal, tanpa akun dan password. Export lokal saat migrasi berisi 7 jadwal.

**Asumsi waktu import:** tanggal/jam closing database lama dibaca sebagai WIB (`+07:00`). Periksa sebelum import jika instalasi lama menyimpan UTC. Input admin baru selalu berlabel WIB dan disimpan sebagai `timestamptz`. Jadwal publik menampilkan bulan sebelumnya dan bulan berjalan sesuai Asia/Jakarta; jadwal lama di luar periode tetap dapat dicari di admin.

## Deploy ke Vercel

1. Push repository ke GitHub.
2. Vercel → Add New → Project → import repository tersebut.
3. Framework Preset: **Next.js**. Root Directory: root repository. Build Command: `npm run build`. Output Directory: default Next.js. Node.js: 22.x atau 24.x.
4. Tambahkan environment variables untuk Production dan Preview:

| Variable | Nilai |
| --- | --- |
| `NEXT_PUBLIC_SUPABASE_URL` | URL project Supabase |
| `NEXT_PUBLIC_SUPABASE_PUBLISHABLE_KEY` | Publishable key Supabase |
| `ADMIN_PATH` | `sanwa-internal-portal` atau satu segmen URL lain |

5. Deploy. Jika mengubah environment variables, redeploy agar perubahan masuk ke build.
6. Di Supabase → Authentication → URL Configuration, isi Site URL dengan domain produksi. Tambahkan localhost sebagai redirect URL bila diperlukan. Login aplikasi saat ini menggunakan email/password, bukan OAuth.
7. Uji login admin, tambah/edit/hapus jadwal, filter, logout, serta tampilan mobile dan publik. Pastikan akun non-admin tidak dapat mengubah jadwal.

Tidak perlu `vercel.json`, PHP runtime, `artisan migrate`, atau database di Vercel. `.vercelignore` mengecualikan arsip Laravel, vendor, data lokal, dan export.

## Fitur dan pemeriksaan

- Landing page, gambar, kontak WhatsApp, FAQ, menu mobile, dan interaksi layanan dipertahankan.
- Supabase Auth untuk login/logout admin. Keanggotaan admin diperiksa di server dan melalui RLS database.
- Tambah, edit, hapus, status FULL/CLOSED/AVAILABLE, filter kapal/tanggal/status, serta pagination 50 jadwal.
- Validasi server untuk tanggal, panjang input, dan closing sebelum keberangkatan.
- Endpoint kontak Laravel sebelumnya tidak menyimpan/mengirim pesan; landing page tetap memakai tautan kontak WhatsApp.

```sh
npm test
npm run typecheck
npm run build
```

Tes browser menggunakan Playwright Chromium (`npx playwright install chromium`, lalu `npm run test:e2e` setelah build). Untuk memakai Chrome yang sudah terpasang, isi `CHROME_PATH` dengan path executable Chrome. Tes fallback database dijalankan tanpa environment Supabase; tes ini tidak menguji database live. Screenshot disimpan lokal di `exports/`.

Audit runtime (`npm audit --omit=dev`) bersih saat migrasi. Audit lengkap masih melaporkan 7 temuan pada dependency build Tailwind CSS 3; perbaikan yang ditawarkan membutuhkan migrasi mayor Tailwind CSS 4.

Koneksi lokal ke Supabase sudah dikonfigurasi dan akses baca publik tabel jadwal sudah diverifikasi (HTTP 200). Akun admin juga sudah terdaftar. Pengujian login dan perubahan jadwal dilakukan sesudah login admin; build sendiri tidak otomatis menerbitkan situs.

## Mengapa Supabase

Supabase menyediakan PostgreSQL yang cocok dengan tabel dan relasi aplikasi lama, serta Auth dan RLS. Convex juga memiliki paket gratis, tetapi model backend dan query-nya memerlukan penulisan ulang yang lebih jauh. Supabase Free saat pengecekan menyediakan database 500 MB; paket gratis memiliki batas pemakaian dan project dapat dijeda karena tidak aktif. Lihat https://supabase.com/pricing dan https://www.convex.dev/pricing untuk batas terbaru.
