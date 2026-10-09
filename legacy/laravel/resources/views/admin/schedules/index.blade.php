<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Jadwal Kapal - PT Sanwa Antar Nusa</title>
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
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#F7F8FA] min-h-screen text-[#1F2328] flex flex-col justify-between"
      x-data="{ openDeleteModal: false, deleteActionUrl: '', vesselName: '' }">

    <div>
        <!-- Navbar (Identik dengan Header Landing Page) -->
        <header class="bg-[#1F2328] text-white shadow-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-6 lg:px-8 py-3.5 flex items-center justify-between">
                <a href="{{ url('/') }}" target="_blank" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo%20sanwa.png') }}" alt="Logo PT Sanwa" class="h-12 sm:h-14 w-auto object-contain">
                    <span class="font-heading font-extrabold text-base tracking-wider border-l border-white/20 pl-3 hidden sm:inline text-white/90 uppercase">Admin Panel</span>
                </a>
                <div class="flex items-center gap-4">
                    <a href="{{ url('/') }}" target="_blank" class="text-xs font-heading font-semibold text-white/70 hover:text-[#E31E24] transition-colors flex items-center gap-1.5">
                        Lihat Website <i data-lucide="external-link" class="w-3.5 h-3.5"></i>
                    </a>
                    <form action="{{ route('admin.logout') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin keluar?');">
                        @csrf
                        <button type="submit" class="rounded-full bg-[#E31E24] hover:bg-[#B5171C] text-white text-xs px-4 py-2 font-heading font-bold shadow-md shadow-red-900/20 transition-all flex items-center gap-1.5">
                            <i data-lucide="log-out" class="w-3.5 h-3.5"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-6 lg:px-8 py-10">
            <!-- Header Title -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
                <div>
                    <span class="inline-block rounded-full bg-[#FDEAEA] text-[#B5171C] text-[10px] font-heading font-bold tracking-wider uppercase px-4 py-1.5 mb-2.5">
                        Dashboard Utama
                    </span>
                    <h1 class="font-heading font-extrabold text-3xl tracking-tight text-[#1F2328] lg:text-4xl">Manajemen Jadwal Kapal</h1>
                    <p class="text-sm text-[#5B6270] mt-2 leading-relaxed">Pantau, perbarui, dan tambahkan jadwal pelayaran kapal kargo rute Jakarta - Surabaya - Kupang.</p>
                </div>
                <div class="shrink-0">
                    <a href="{{ route('admin.schedules.create') }}" class="inline-flex items-center gap-2 rounded-full bg-[#E31E24] text-white px-6 py-4 font-heading font-bold text-sm shadow-xl shadow-red-900/35 hover:bg-[#B5171C] transform hover:-translate-y-0.5 transition-all">
                        <i data-lucide="plus" class="w-4.5 h-4.5"></i> Tambah Jadwal Kapal
                    </a>
                </div>
            </div>

            <!-- Quick Statistics Band -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
                <!-- Total Card -->
                <div class="bg-white rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/40 p-6 flex items-center gap-5 border-l-4 border-gray-400">
                    <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-gray-50 text-gray-500">
                        <i data-lucide="calendar" class="w-6 h-6"></i>
                    </span>
                    <div>
                        <p class="font-heading font-extrabold text-3xl leading-none text-[#1F2328]">{{ $schedules->count() }}</p>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mt-2">Total Jadwal</p>
                    </div>
                </div>

                <!-- Active Card -->
                <div class="bg-white rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/40 p-6 flex items-center gap-5 border-l-4 border-green-500">
                    <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-green-50 text-green-600">
                        <i data-lucide="ship" class="w-6 h-6"></i>
                    </span>
                    <div>
                        <p class="font-heading font-extrabold text-3xl leading-none text-[#1F2328]">{{ $schedules->filter(fn($s) => !$s->is_full && !$s->closing->isPast())->count() }}</p>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mt-2">Aktif / Terbuka</p>
                    </div>
                </div>

                <!-- Full Card -->
                <div class="bg-white rounded-3xl border border-gray-100 shadow-xl shadow-gray-200/40 p-6 flex items-center gap-5 border-l-4 border-[#E31E24]">
                    <span class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-[#FDEAEA] text-[#E31E24]">
                        <i data-lucide="ban" class="w-6 h-6"></i>
                    </span>
                    <div>
                        <p class="font-heading font-extrabold text-3xl leading-none text-[#1F2328]">{{ $schedules->where('is_full', true)->count() }}</p>
                        <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mt-2">Penuh (Full)</p>
                    </div>
                </div>
            </div>

            <!-- Session Alert -->
            @if (session('success'))
                <div class="mb-10 rounded-3xl bg-green-50 text-green-700 border border-green-150 text-sm font-semibold px-6 py-4.5 flex items-center gap-3.5 shadow-md shadow-green-100/50">
                    <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green-100">
                        <i data-lucide="check" class="w-4 h-4 text-green-700"></i>
                    </span>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- Search & Filter Card -->
            <form method="GET" action="{{ route('admin.schedules.index') }}" class="bg-white rounded-[2rem] border border-gray-100 shadow-xl shadow-gray-200/30 p-6 sm:p-8 mb-10">
                <div class="flex items-center gap-2 mb-6">
                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-[#FDEAEA] text-[#E31E24]">
                        <i data-lucide="sliders-horizontal" class="w-4 h-4"></i>
                    </span>
                    <p class="text-xs font-heading font-bold uppercase tracking-wider text-gray-500">Cari & Saring Jadwal</p>
                </div>

                <!-- Input Fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 min-w-0">
                    <!-- Column 1: Search -->
                    <div class="space-y-4">
                        <div>
                            <label for="search" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Nama Kapal</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-300">
                                    <i data-lucide="search" class="w-4 h-4"></i>
                                </span>
                                <input type="text" id="search" name="search" value="{{ request('search') }}"
                                       class="w-full rounded-xl border border-gray-200 pl-11 pr-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#E31E24] hover:border-gray-300 transition-all placeholder-gray-300"
                                       placeholder="Cari nama kapal...">
                            </div>
                        </div>

                        <div>
                            <label for="status" class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Status Pengapalan</label>
                            <div class="relative">
                                <select id="status" name="status"
                                        class="w-full rounded-xl border border-gray-200 px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#E31E24] bg-white appearance-none pr-10 hover:border-gray-300 transition-all text-gray-700">
                                    <option value="">Semua Status</option>
                                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Masih Bisa Diisi (Aktif)</option>
                                    <option value="full" {{ request('status') == 'full' ? 'selected' : '' }}>Penuh (FULL)</option>
                                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Lewat Tanggal (Closed)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                    <i data-lucide="chevron-down" class="w-4 h-4"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Column 2: Date Ranges -->
                    <div class="space-y-4">
                        <!-- Closing Range -->
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Range Closing Surabaya</label>
                            <div class="grid grid-cols-2 gap-3">
                                <input type="date" name="closing_start" value="{{ request('closing_start') }}"
                                       class="w-full rounded-xl border border-gray-200 px-3.5 py-3 text-xs focus:outline-none focus:ring-2 focus:ring-[#E31E24] hover:border-gray-300 transition-all text-gray-700">
                                <input type="date" name="closing_end" value="{{ request('closing_end') }}"
                                       class="w-full rounded-xl border border-gray-200 px-3.5 py-3 text-xs focus:outline-none focus:ring-2 focus:ring-[#E31E24] hover:border-gray-300 transition-all text-gray-700">
                            </div>
                        </div>

                        <!-- ETD Range -->
                        <div>
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1.5">Range ETD Surabaya</label>
                            <div class="grid grid-cols-2 gap-3">
                                <input type="date" name="etd_start" value="{{ request('etd_start') }}"
                                       class="w-full rounded-xl border border-gray-200 px-3.5 py-3 text-xs focus:outline-none focus:ring-2 focus:ring-[#E31E24] hover:border-gray-300 transition-all text-gray-700">
                                <input type="date" name="etd_end" value="{{ request('etd_end') }}"
                                       class="w-full rounded-xl border border-gray-200 px-3.5 py-3 text-xs focus:outline-none focus:ring-2 focus:ring-[#E31E24] hover:border-gray-300 transition-all text-gray-700">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-6 mt-6">
                    <a href="{{ route('admin.schedules.index') }}" class="inline-flex items-center gap-1.5 rounded-full border border-gray-200 hover:bg-gray-50 px-5 py-2.5 text-xs font-heading font-semibold transition-all">
                        <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i> Reset Filter
                    </a>
                    <button type="submit" class="inline-flex items-center gap-1.5 rounded-full bg-[#E31E24] text-white px-6 py-2.5 text-xs font-heading font-bold shadow-md shadow-red-955/20 hover:bg-[#B5171C] transition-all">
                        <i data-lucide="filter" class="w-3.5 h-3.5"></i> Saring Jadwal
                    </button>
                </div>
            </form>

            <!-- Table Card Container (Sangat Lapang, Padding px-6 py-5.5) -->
            <div class="bg-white rounded-[2rem] border border-gray-100 shadow-xl overflow-hidden">
                <!-- Desktop View Table -->
                <div class="hidden md:block overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-[#1F2328] text-white font-heading font-semibold text-sm">
                                <th class="px-6 py-5 text-center">No.</th>
                                <th class="px-6 py-5">Nama Kapal</th>
                                <th class="px-6 py-5 text-center">VOY</th>
                                <th class="px-6 py-5 text-center">Closing Surabaya</th>
                                <th class="px-6 py-5 text-center">ETD Surabaya (SUB)</th>
                                <th class="px-6 py-5 text-center">Status</th>
                                <th class="px-6 py-5 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm text-[#1F2328]">
                            @forelse ($schedules as $index => $schedule)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 text-center font-semibold text-gray-400">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-bold">
                                        <div class="flex items-center gap-3">
                                            <span class="flex h-8.5 w-8.5 shrink-0 items-center justify-center rounded-full bg-[#FDEAEA] text-[#E31E24]">
                                                <i data-lucide="ship" class="w-4.5 h-4.5"></i>
                                            </span>
                                            <span class="truncate max-w-[200px] lg:max-w-none">{{ $schedule->kapal }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="px-2.5 py-1 rounded-md bg-gray-100 text-gray-700 text-xs font-semibold font-mono">
                                            {{ $schedule->voy }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($schedule->is_full)
                                            <span class="inline-block rounded bg-[#FDEAEA] text-[#E31E24] text-[10px] font-heading font-bold uppercase tracking-wider px-2.5 py-1 shadow-sm">FULL</span>
                                        @else
                                            <span class="text-[#B5171C] font-semibold">{{ $schedule->closing->format('d M Y') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center font-semibold text-[#1F2328]">
                                        {{ $schedule->etd_sub->format('d M Y') }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if ($schedule->is_full)
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-[#E31E24]">
                                                <span class="h-1.5 w-1.5 rounded-full bg-[#E31E24]"></span>
                                                Penuh
                                            </span>
                                        @elseif ($schedule->closing->isPast())
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-50 px-2.5 py-1 text-xs font-semibold text-gray-500">
                                                <span class="h-1.5 w-1.5 rounded-full bg-gray-400"></span>
                                                Closed
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700">
                                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                                Terbuka
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <a href="{{ route('admin.schedules.edit', $schedule) }}" class="inline-flex items-center gap-1 rounded-full bg-blue-50 text-blue-600 px-3.5 py-1.5 font-heading font-bold text-xs hover:bg-blue-100 transition-colors">
                                                <i data-lucide="pencil" class="w-3 h-3"></i> Edit
                                            </a>
                                            <button type="button" @click="deleteActionUrl = '{{ route('admin.schedules.destroy', $schedule) }}'; vesselName = '{{ $schedule->kapal }}'; openDeleteModal = true"
                                                    class="inline-flex items-center gap-1 rounded-full bg-red-50 text-[#E31E24] px-3.5 py-1.5 font-heading font-bold text-xs hover:bg-[#FDEAEA] transition-colors">
                                                <i data-lucide="trash-2" class="w-3 h-3"></i> Hapus
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-20 text-center text-[#5B6270]">
                                        <i data-lucide="calendar-x" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
                                        <p class="font-heading font-bold text-lg text-gray-400">Belum Ada Jadwal Kapal</p>
                                        <p class="text-xs text-gray-400 mt-1.5">Tidak ditemukan data jadwal kapal untuk pencarian ini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Card List View -->
                <div class="block md:hidden divide-y divide-gray-100">
                    @forelse ($schedules as $index => $schedule)
                        <div class="p-6 space-y-4 hover:bg-gray-50/50 transition-colors border-l-4 {{ $schedule->is_full ? 'border-l-[#E31E24]' : ($schedule->closing->isPast() ? 'border-l-gray-400' : 'border-l-green-500') }}">
                            <!-- Card Header -->
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-center gap-2.5">
                                    <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-[#FDEAEA] text-[#E31E24]">
                                        <i data-lucide="ship" class="w-4.5 h-4.5"></i>
                                    </span>
                                    <div>
                                        <h3 class="font-bold text-sm text-[#1F2328]">{{ $schedule->kapal }}</h3>
                                        <span class="inline-block mt-1 font-mono text-[10px] font-bold text-gray-500 bg-gray-100 px-2 py-0.5 rounded">
                                            {{ $schedule->voy }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    @if ($schedule->is_full)
                                        <span class="inline-flex items-center gap-1 rounded bg-[#FDEAEA] text-[#E31E24] text-[9px] font-heading font-bold uppercase tracking-wider px-2 py-0.5">Penuh</span>
                                    @elseif ($schedule->closing->isPast())
                                        <span class="inline-flex items-center gap-1 rounded bg-gray-100 text-gray-500 text-[9px] font-heading font-bold uppercase tracking-wider px-2 py-0.5">Closed</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 rounded bg-green-50 text-green-700 text-[9px] font-heading font-bold uppercase tracking-wider px-2 py-0.5">Terbuka</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Card Body Info -->
                            <div class="grid grid-cols-2 gap-4 border-t border-gray-50 pt-3 text-xs">
                                <div>
                                    <p class="text-gray-400 font-bold uppercase tracking-wider text-[9px]">Closing Surabaya</p>
                                    <p class="mt-1">
                                        @if ($schedule->is_full)
                                            <span class="text-[#E31E24] font-bold">FULL</span>
                                        @else
                                            <span class="text-[#B5171C] font-semibold">{{ $schedule->closing->format('d M Y') }}</span>
                                        @endif
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-400 font-bold uppercase tracking-wider text-[9px]">ETD Surabaya</p>
                                    <p class="mt-1 font-semibold text-gray-700">
                                        {{ $schedule->etd_sub->format('d M Y') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Card Actions -->
                            <div class="flex items-center justify-end gap-2.5 border-t border-gray-50 pt-3 text-xs">
                                <a href="{{ route('admin.schedules.edit', $schedule) }}" class="inline-flex items-center gap-1 rounded-full bg-blue-50 text-blue-600 px-3.5 py-1.5 font-heading font-bold text-[11px] hover:bg-blue-100 transition-colors">
                                    <i data-lucide="pencil" class="w-3 h-3"></i> Edit
                                </a>
                                <button type="button" @click="deleteActionUrl = '{{ route('admin.schedules.destroy', $schedule) }}'; vesselName = '{{ $schedule->kapal }}'; openDeleteModal = true"
                                        class="inline-flex items-center gap-1 rounded-full bg-red-50 text-[#E31E24] px-3.5 py-1.5 font-heading font-bold text-[11px] hover:bg-[#FDEAEA] transition-colors">
                                    <i data-lucide="trash-2" class="w-3 h-3"></i> Hapus
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center text-[#5B6270]">
                            <i data-lucide="calendar-x" class="w-12 h-12 text-gray-300 mx-auto mb-3"></i>
                            <p class="font-heading font-bold text-gray-400">Belum Ada Jadwal Kapal</p>
                            <p class="text-xs text-gray-400 mt-1.5">Tidak ditemukan data jadwal kapal untuk pencarian ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 py-6 text-center text-xs text-gray-400 font-medium">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            &copy; {{ date('Y') }} PT Sanwa Antar Nusa. Admin Dashboard.
        </div>
    </footer>

    <!-- Delete Confirmation Modal (Alpine.js) -->
    <div x-show="openDeleteModal" 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         x-cloak>
        <div class="bg-white rounded-[2rem] max-w-sm w-full p-8 shadow-2xl border border-gray-100 text-center transform transition-all"
             @click.away="openDeleteModal = false">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-[#FDEAEA] text-[#E31E24] mb-5 border border-[#E31E24]/20">
                <i data-lucide="alert-triangle" class="w-6 h-6"></i>
            </div>
            <h3 class="font-heading font-extrabold text-xl text-[#1F2328]">Hapus Jadwal?</h3>
            <p class="text-xs text-[#5B6270] mt-2.5 leading-relaxed">
                Anda akan menghapus jadwal untuk kapal <span class="font-extrabold text-gray-800" x-text="vesselName"></span>. Tindakan ini tidak dapat dibatalkan.
            </p>
            
            <form :action="deleteActionUrl" method="POST" class="mt-6 flex items-center gap-3">
                @csrf
                @method('DELETE')
                <button type="button" @click="openDeleteModal = false"
                        class="w-1/2 rounded-full border border-gray-200 py-3.5 text-xs font-heading font-bold text-gray-500 hover:bg-gray-50 transition-all">
                    Batal
                </button>
                <button type="submit"
                        class="w-1/2 rounded-full bg-[#E31E24] text-white py-3.5 text-xs font-heading font-bold hover:bg-[#B5171C] transition-all shadow-lg shadow-red-900/20">
                    Ya, Hapus
                </button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.lucide) { lucide.createIcons(); }
        });
    </script>
</body>
</html>