<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Kapal - PT Sanwa Antar Nusa</title>
    <!-- Favicon / Profile Icon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js" defer></script>
    <style>
        .font-heading { font-family: 'Outfit', sans-serif; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#F7F8FA] min-h-screen text-[#1F2328] flex flex-col justify-between">

    <div>
        <!-- Navbar (Identik dengan Header Landing Page) -->
        <header class="bg-[#1F2328] text-white shadow-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-3.5 flex items-center justify-between">
                <a href="{{ route('admin.schedules.index') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo%20sanwa.png') }}" alt="Logo PT Sanwa" class="h-12 sm:h-14 w-auto object-contain">
                    <span class="font-heading font-extrabold text-base tracking-wider border-l border-white/20 pl-3 hidden sm:inline text-white/90 uppercase">Admin Panel</span>
                </a>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.schedules.index') }}" class="rounded-full bg-white/10 hover:bg-white/20 text-xs px-4 py-2 font-heading font-bold transition-all flex items-center gap-1.5">
                        <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali
                    </a>
                </div>
            </div>
        </header>

        <!-- Main Container -->
        <main class="max-w-2xl mx-auto px-6 py-12">
            <!-- Breadcrumb -->
            <div class="flex items-center gap-2 text-xs text-gray-400 mb-6 font-medium">
                <a href="{{ route('admin.schedules.index') }}" class="hover:text-[#E31E24] transition-colors">Jadwal Kapal</a>
                <i data-lucide="chevron-right" class="w-3 h-3"></i>
                <span class="text-gray-600">Edit Jadwal</span>
            </div>

            <!-- Page Title -->
            <div class="mb-8 flex items-start gap-4">
                <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-[#FDEAEA] text-[#E31E24] border border-[#E31E24]/20">
                    <i data-lucide="edit" class="w-6 h-6"></i>
                </span>
                <div>
                    <span class="inline-block rounded-full bg-[#FDEAEA] text-[#B5171C] text-[9px] font-heading font-bold tracking-wider uppercase px-3 py-1 mb-1.5">Ubah Jadwal</span>
                    <h1 class="font-heading font-extrabold text-2xl lg:text-3xl text-[#1F2328]">Edit Jadwal Kapal</h1>
                    <p class="text-sm text-[#5B6270] mt-1">Ubah data jadwal pelayaran kapal kargo yang sudah terdaftar.</p>
                </div>
            </div>

            <!-- Error Alerts -->
            @if ($errors->any())
                <div class="mb-6 bg-[#E31E24]/5 border border-[#E31E24]/10 text-[#B5171C] rounded-2xl p-5 text-sm shadow-sm flex items-start gap-3">
                    <i data-lucide="alert-circle" class="w-5 h-5 shrink-0 text-[#E31E24] mt-0.5"></i>
                    <div>
                        <p class="font-heading font-bold mb-1.5">Mohon koreksi kesalahan berikut:</p>
                        <ul class="list-disc pl-4 space-y-1 text-xs font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Form Card (Desain Identik Kontak Form Landing Page) -->
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl p-8 sm:p-10">
                <form action="{{ route('admin.schedules.update', $schedule) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Section 1: Data Kapal -->
                    <div class="space-y-5">
                        <div class="flex items-center gap-2 text-[10px] font-heading font-bold uppercase tracking-widest text-[#E31E24] border-b border-gray-50 pb-2">
                            <i data-lucide="anchor" class="w-3.5 h-3.5"></i> Informasi Armada
                        </div>

                        <!-- Nama Kapal (Select Dropdown) -->
                        <div>
                            <label for="kapal" class="block text-xs font-heading font-bold text-[#1F2328] mb-2">Nama Kapal</label>
                            <div class="relative">
                                <select id="kapal" name="kapal" required
                                        class="w-full rounded-xl border border-[#E5E7EB] px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#E31E24] focus:border-transparent bg-white appearance-none pr-10 hover:border-gray-300 transition-all text-gray-700">
                                    <option value="" disabled>Pilih kapal...</option>
                                    @foreach ($vessels as $vessel)
                                        <option value="{{ $vessel }}" {{ old('kapal', $schedule->kapal) == $vessel ? 'selected' : '' }}>
                                            {{ $vessel }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                    <i data-lucide="chevron-down" class="w-4.5 h-4.5"></i>
                                </div>
                            </div>
                        </div>

                        <!-- VOY -->
                        <div>
                            <label for="voy" class="block text-xs font-heading font-bold text-[#1F2328] mb-2">Nomor Voyage (VOY)</label>
                            <input type="text" id="voy" name="voy" value="{{ old('voy', $schedule->voy) }}" required
                                   class="w-full rounded-xl border border-[#E5E7EB] px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#E31E24] focus:border-transparent placeholder-gray-300 hover:border-gray-300 transition-all text-gray-700 font-medium"
                                   placeholder="Contoh: VOY. 2607">
                        </div>
                    </div>

                    <!-- Section 2: Jadwal Pelayaran -->
                    <div class="space-y-5 pt-4">
                        <div class="flex items-center gap-2 text-[10px] font-heading font-bold uppercase tracking-widest text-[#E31E24] border-b border-gray-50 pb-2">
                            <i data-lucide="calendar" class="w-3.5 h-3.5"></i> Waktu Pelayaran
                        </div>

                        <!-- Grid Closing & ETD -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <!-- Closing Date -->
                            <div>
                                <label for="closing" class="block text-xs font-heading font-bold text-[#1F2328] mb-2">Tanggal Closing</label>
                                <input type="date" id="closing" name="closing" value="{{ old('closing', $schedule->closing->format('Y-m-d')) }}" required
                                       class="w-full rounded-xl border border-[#E5E7EB] px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#E31E24] focus:border-transparent hover:border-gray-300 transition-all text-gray-700 font-medium">
                            </div>

                            <!-- ETD SUB Date -->
                            <div>
                                <label for="etd_sub" class="block text-xs font-heading font-bold text-[#1F2328] mb-2">ETD Surabaya (SUB)</label>
                                <input type="date" id="etd_sub" name="etd_sub" value="{{ old('etd_sub', $schedule->etd_sub->format('Y-m-d')) }}" required
                                       class="w-full rounded-xl border border-[#E5E7EB] px-4 py-3.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#E31E24] focus:border-transparent hover:border-gray-300 transition-all text-gray-700 font-medium">
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Status Terisi -->
                    <div class="pt-4">
                        <label class="relative flex items-start gap-3.5 cursor-pointer group rounded-2xl border border-[#E5E7EB] bg-[#F7F8FA] p-5 hover:border-[#E31E24]/30 hover:bg-[#FDEAEA]/30 transition-all">
                            <input type="checkbox" name="is_full" value="1" {{ old('is_full', $schedule->is_full) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-[#E31E24] focus:ring-[#E31E24] focus:ring-offset-0 h-5.5 w-5.5 mt-0.5 cursor-pointer shrink-0">
                            <div>
                                <span class="block text-sm font-heading font-bold text-[#1F2328] group-hover:text-[#E31E24] transition-colors">Tandai Kapal Sudah Penuh (FULL)</span>
                                <span class="block text-xs text-[#5B6270] mt-1 leading-relaxed">Centang opsi ini jika kuota kargo kontainer telah terisi penuh. Kolom closing di jadwal landing page akan otomatis berubah menjadi teks merah <b>"FULL"</b>.</span>
                            </div>
                        </label>
                    </div>

                    <!-- Submit & Cancel Buttons -->
                    <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                        <a href="{{ route('admin.schedules.index') }}" class="rounded-full border border-gray-200 hover:bg-gray-50 text-xs font-heading font-bold px-6 py-3.5 transition-all text-gray-600">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 rounded-full bg-[#E31E24] text-white px-6 py-3.5 font-heading font-bold text-xs shadow-lg shadow-red-900/20 hover:bg-[#B5171C] transition-all">
                            <i data-lucide="refresh-cw" class="w-4 h-4"></i> Perbarui Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-6 text-center text-xs text-gray-400 font-medium">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            &copy; {{ date('Y') }} PT Sanwa Antar Nusa. Admin Dashboard.
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.lucide) { lucide.createIcons(); }
        });
    </script>
</body>
</html>