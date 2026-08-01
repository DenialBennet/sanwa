<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Sanwa Antar Nusa — Ekspedisi & Logistik Nasional</title>
    <meta name="description" content="PT Sanwa Antar Nusa — jasa ekspedisi dan logistik nasional: kargo laut dan pengiriman darat ke seluruh Indonesia.">

    <!-- Favicon / Profile Icon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js" defer></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-white text-[#1F2328] font-body antialiased" x-data="{ menuOpen: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)">

{{-- ============ NAVBAR ============ --}}
<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-3"
        :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-sm border-b border-[#E5E7EB]/80' : 'bg-transparent shadow-none border-b border-transparent'">
    <nav class="max-w-7xl mx-auto px-6 lg:px-8 flex items-center justify-between" aria-label="Navigasi utama">
        <a href="{{ url('/') }}" class="flex items-center" aria-label="PT Sanwa Antar Nusa - Beranda">
            <img src="{{ asset('images/logo%20sanwa.png') }}" alt="Logo PT Sanwa Antar Nusa" 
                 class="h-16 w-auto sm:h-20 object-contain transition-all duration-300"
                 :class="scrolled ? '' : 'brightness-0 invert'">
        </a>

        <ul class="hidden lg:flex items-center gap-8 font-heading font-medium text-sm transition-colors duration-300"
            :class="scrolled ? 'text-[#1F2328]' : 'text-white'">
            <li><a href="#beranda" class="hover:text-[#E31E24] transition-colors">Beranda</a></li>
            <li><a href="#layanan" class="hover:text-[#E31E24] transition-colors">Layanan</a></li>
            <li><a href="#jadwal" class="hover:text-[#E31E24] transition-colors">Jadwal Kapal</a></li>
            <li><a href="#tentang" class="hover:text-[#E31E24] transition-colors">Tentang</a></li>
            <li><a href="#kontak" class="hover:text-[#E31E24] transition-colors">Kontak</a></li>
        </ul>

        <button @click="menuOpen = !menuOpen" class="lg:hidden transition-colors duration-300" 
                :class="scrolled ? 'text-[#1F2328]' : 'text-white'" aria-label="Buka menu navigasi" :aria-expanded="menuOpen">
            <i data-lucide="menu" x-show="!menuOpen" class="w-7 h-7"></i>
            <i data-lucide="x" x-show="menuOpen" class="w-7 h-7" x-cloak></i>
        </button>
    </nav>

    <div x-show="menuOpen" x-transition x-cloak class="lg:hidden mt-4 mx-6 rounded-2xl bg-white shadow-xl border border-[#E5E7EB] px-6 py-6">
        <ul class="flex flex-col gap-4 font-heading font-medium text-[#1F2328]">
            <li><a href="#beranda" @click="menuOpen=false">Beranda</a></li>
            <li><a href="#layanan" @click="menuOpen=false">Layanan</a></li>
            <li><a href="#jadwal" @click="menuOpen=false">Jadwal Kapal</a></li>
            <li><a href="#tentang" @click="menuOpen=false">Tentang</a></li>
            <li><a href="#kontak" @click="menuOpen=false">Kontak</a></li>
        </ul>
    </div>
</header>

{{-- ============ HERO ============ --}}
<section id="beranda" class="relative min-h-screen flex flex-col justify-end overflow-hidden bg-[#1F2328]">
    <div class="absolute inset-0">
        <img src="{{ asset('images/foto%20kapal.png') }}" alt="Kapal kargo PT Sanwa Antar Nusa di pelabuhan" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-r from-[#1F2328] via-[#1F2328]/85 to-[#1F2328]/30"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-[#1F2328] via-transparent to-[#1F2328]/40"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto w-full px-6 lg:px-8 pt-40 pb-16">
        <span class="inline-block rounded-full bg-[#E31E24]/15 text-[#FF6B6B] text-xs font-heading font-semibold tracking-wide uppercase px-4 py-1.5">
            PT Sanwa Antar Nusa
        </span>

        <h1 class="mt-6 max-w-3xl font-heading font-extrabold text-white text-4xl sm:text-5xl lg:text-6xl leading-[1.1] tracking-tight">
            National Freight<br>
            Forwarder & Logistics<br>
        </h1>

        <p class="mt-6 max-w-xl text-white/80 text-base sm:text-lg leading-relaxed">
            Perusahaan multi nasional jasa angkutan laut & forwarding spesialis rute Jakarta - Surabaya - Kupang dan wilayah Indonesia Timur lainnya. Mengutamakan kelancaran dengan keberangkatan 2-3x seminggu.
        </p>

        <div class="mt-8 flex flex-wrap items-center gap-4">
            <a href="#layanan" class="inline-flex items-center gap-2 rounded-full bg-[#E31E24] text-white px-6 py-3 font-heading font-semibold text-sm shadow-lg shadow-red-900/30 hover:bg-[#B5171C] transition-colors">
                Lihat Layanan <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="mt-16 grid grid-cols-1 sm:grid-cols-3 gap-8 border-t border-white/15 pt-10">
            <div>
                <p class="font-heading font-extrabold text-4xl text-white">18+</p>
                <p class="mt-1 text-white/70 text-sm">Tahun Melayani</p>
            </div>
            <div>
                <p class="font-heading font-extrabold text-4xl text-white">120K+</p>
                <p class="mt-1 text-white/70 text-sm">Pengiriman Berhasil</p>
            </div>
            <div>
                <p class="font-heading font-extrabold text-4xl text-white">25+</p>
                <p class="mt-1 text-white/70 text-sm">Kota Terjangkau</p>
            </div>
        </div>
    </div>
</section>


{{-- ============ ABOUT ============ --}}
<section id="tentang" class="bg-[#F7F8FA] py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 grid lg:grid-cols-2 gap-12 items-center">
        <div class="relative order-2 lg:order-1">
            <img src="{{ asset('images/foto%20muat.jpeg') }}" alt="Kapal kargo memuat kontainer di pelabuhan" class="rounded-2xl shadow-xl w-full h-[420px] object-cover" loading="lazy">
            <div class="absolute -bottom-6 -left-6 bg-[#1F2328] text-white rounded-2xl shadow-xl px-6 py-5 flex items-center gap-4">
                <span class="font-heading font-extrabold text-3xl text-[#E31E24]">18</span>
                <span class="text-sm leading-tight max-w-[7rem]">Tahun Pengalaman Melayani Logistik</span>
            </div>
        </div>

        <div class="order-1 lg:order-2">
            <span class="inline-block rounded-full bg-[#FDEAEA] text-[#B5171C] text-xs font-heading font-semibold tracking-wide uppercase px-4 py-1.5">
                Tentang Sanwa Antar Nusa
            </span>
            <h2 class="mt-4 font-heading font-bold text-3xl lg:text-4xl text-[#1F2328] leading-tight">
                Mitra Logistik Terpercaya untuk Bisnis Anda
            </h2>
            <p class="mt-4 text-[#5B6270] leading-relaxed">
                PT Sanwa Antar Nusa adalah perusahaan multi nasional yang bergerak di bidang jasa transportasi angkutan laut / forwarding dengan rute spesialis Jakarta - Surabaya - Kupang  dan wilayah Indonesia timur lainnya. Berdiri sejak 15 Januari 2008 di Surabaya, kami hadir melayani jasa ekspedisi pengiriman serta pendistribusian barang di Kupang dan sekitarnya dengan mengutamakan kelancaran pengiriman.
            </p>

            <ul class="mt-6 grid sm:grid-cols-2 gap-3">
                @foreach ([
                    'Kargo Laut Antar Pulau', 'Pengiriman Darat Reguler',
                    'Asuransi & Jaminan Barang', 'Pelacakan Real-time',
                    'Layanan Dokumen Ekspedisi',
                ] as $item)
                    <li class="flex items-center gap-2 text-sm text-[#1F2328]">
                        <i data-lucide="check-circle" class="w-5 h-5 text-[#E31E24] shrink-0"></i>
                        {{ $item }}
                    </li>
                @endforeach
            </ul>

            <div class="mt-8 flex flex-wrap items-center gap-6">
                <a href="#kontak" class="inline-flex items-center gap-2 rounded-full bg-[#E31E24] text-white px-6 py-3 font-heading font-semibold text-sm hover:bg-[#B5171C] transition-colors">
                    Hubungi Kami
                </a>
                <a href="https://wa.me/628113144405" target="_blank" rel="noopener" class="flex items-center gap-3 text-[#1F2328] font-heading font-semibold hover:text-[#E31E24] transition-colors">
                    <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#FDEAEA]">
                        <i data-lucide="phone" class="w-4 h-4 text-[#B5171C]"></i>
                    </span>
                    +62 811-3144-405
                </a>
            </div>
        </div>
    </div>
</section>


{{-- ============ SERVICES ============ --}}
<section id="layanan" class="bg-white py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <span class="inline-block rounded-full bg-[#FDEAEA] text-[#B5171C] text-xs font-heading font-semibold tracking-wide uppercase px-4 py-1.5">
                Layanan Kami
            </span>
            <h2 class="mt-4 font-heading font-bold text-3xl lg:text-4xl text-[#1F2328]">
                Solusi Logistik Lengkap untuk Setiap Kebutuhan
            </h2>
            <p class="mt-4 text-[#5B6270]">
                Dari pelabuhan hingga pintu tujuan, kami mengelola setiap tahap pengiriman
                dengan standar keamanan dan ketepatan waktu yang konsisten.
            </p>
        </div>

        <div class="mt-16 space-y-16 lg:space-y-24 w-full">
            @foreach ([
                [
                    'image' => asset('images/foto%20kapal2.jpeg'), 
                    'icon' => 'ship', 
                    'label' => 'Layanan 01', 
                    'title' => 'Kargo Laut (Forwarding)', 
                    'desc' => 'Layanan pengiriman kargo laut (sea freight) spesialis rute Jakarta - Surabaya - Kupang dan wilayah Indonesia Timur. Kami melayani pengiriman skala besar (FCL) maupun eceran (LCL) dengan jadwal rutin keberangkatan kapal 2-2 kali seminggu. Kami menjamin keamanan muatan Anda mulai dari pelabuhan asal hingga tujuan dengan tarif kompetitif.',
                    'reverse' => false
                ],
                [
                    'image' => asset('images/foto%20darat.jpeg'), 
                    'icon' => 'truck', 
                    'label' => 'Layanan 02', 
                    'title' => 'Rute Container Jakarta - Kupang', 
                    'desc' => 'Solusi logistik multimodal terpadu menghubungkan Jakarta, Surabaya, hingga Kupang. Mengombinasikan pengiriman darat/kereta api cepat dari Jakarta ke Surabaya, dilanjutkan dengan jalur laut menggunakan kontainer standar internasional (20 & 40 feet). Layanan ini dirancang untuk meminimalkan risiko kerusakan barang dan efisiensi biaya bisnis Anda.',
                    'reverse' => true
                ],
            ] as $service)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center">
                    <!-- Image Column -->
                    <div class="relative w-full aspect-[16/10] md:aspect-[16/9] rounded-2xl overflow-hidden shadow-lg group transition-all duration-500 hover:shadow-2xl {{ $service['reverse'] ? 'lg:order-2' : '' }} reveal-on-scroll">
                        <img src="{{ $service['image'] }}" alt="{{ $service['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" loading="lazy">
                        <span class="absolute top-6 {{ $service['reverse'] ? 'left-6 lg:left-auto lg:right-6' : 'left-6' }} flex h-14 w-14 items-center justify-center rounded-full bg-accent shadow-lg text-white">
                            <i data-lucide="{{ $service['icon'] }}" class="w-6 h-6"></i>
                        </span>
                    </div>

                    <!-- Text Column -->
                    <div class="space-y-4 {{ $service['reverse'] ? 'lg:order-1' : '' }} reveal-on-scroll flex flex-col items-start min-w-0">
                        <span class="section-eyebrow">
                            {{ $service['label'] }}
                        </span>
                        <h3 class="font-heading font-extrabold text-2xl sm:text-3xl text-primary leading-tight">
                            {{ $service['title'] }}
                        </h3>
                        <p class="text-sm sm:text-base text-neutral-text-secondary leading-relaxed">
                            {{ $service['desc'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ HOW IT WORKS ============ --}}
<section class="bg-[#F7F8FA] py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <span class="inline-block rounded-full bg-[#FDEAEA] text-[#B5171C] text-xs font-heading font-semibold tracking-wide uppercase px-4 py-1.5">
                Alur Pengiriman
            </span>
            <h2 class="mt-4 font-heading font-bold text-3xl lg:text-4xl text-[#1F2328]">
                Empat Langkah Menuju Tujuan
            </h2>
        </div>

        <div class="mt-14 grid sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach ([
                ['step' => '01', 'icon' => 'clipboard-list', 'title' => 'Booking & Konsultasi', 'desc' => 'Ajukan detail pengiriman dan jadwalkan rute kargo Anda.'],
                ['step' => '02', 'icon' => 'package-check', 'title' => 'Pickup & Loading', 'desc' => 'Barang dimuat ke dalam container dengan standar keamanan tinggi.'],
                ['step' => '03', 'icon' => 'route', 'title' => 'Pengiriman Multimodal', 'desc' => 'Barang dikirim via darat/kereta api dan laut/kapal kargo.'],
                ['step' => '04', 'icon' => 'circle-check-big', 'title' => 'Sampai di Tujuan', 'desc' => 'Barang didistribusikan dengan aman di Kupang & sekitarnya.'],
            ] as $step)
                <div class="text-center px-4">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-[#1F2328] shadow-lg">
                        <i data-lucide="{{ $step['icon'] }}" class="w-7 h-7 text-[#E31E24]"></i>
                    </div>
                    <p class="mt-4 font-heading font-extrabold text-sm text-[#E31E24]">{{ $step['step'] }}</p>
                    <h3 class="mt-1 font-heading font-bold text-lg text-[#1F2328]">{{ $step['title'] }}</h3>
                    <p class="mt-2 text-sm text-[#5B6270] leading-relaxed">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ VESSEL SCHEDULE ============ --}}
<section id="jadwal" class="bg-white py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <span class="inline-block rounded-full bg-[#FDEAEA] text-[#B5171C] text-xs font-heading font-semibold tracking-wide uppercase px-4 py-1.5">
                Jadwal Keberangkatan
            </span>
            <h2 class="mt-4 font-heading font-bold text-3xl lg:text-4xl text-[#1F2328]">
                Jadwal Kapal Surabaya ke Kupang
            </h2>
            <p class="mt-4 text-[#5B6270]">
                Pantau jadwal closing kargo dan rencana keberangkatan kapal kargo (ETD Surabaya).
            </p>
        </div>

        <div class="mt-12 bg-white rounded-2xl border border-gray-100 shadow-xl overflow-hidden">
            <!-- Desktop Table View -->
            <div class="hidden md:block max-h-[350px] overflow-y-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#1F2328] text-white font-heading font-semibold text-sm sticky top-0 z-10">
                            <th class="px-8 py-4 bg-[#1F2328]">No.</th>
                            <th class="px-8 py-4 bg-[#1F2328]">Nama Kapal</th>
                            <th class="px-8 py-4 bg-[#1F2328]">VOY</th>
                            <th class="px-8 py-4 text-center bg-[#1F2328]">Closing Surabaya</th>
                            <th class="px-8 py-4 text-center bg-[#1F2328]">ETD Surabaya (SUB)</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm text-[#1F2328]">
                        @forelse ($schedules as $index => $schedule)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-8 py-4 font-semibold text-gray-400">{{ $index + 1 }}</td>
                                <td class="px-8 py-4 font-bold">
                                    <div class="flex items-center gap-2">
                                        <i data-lucide="ship" class="w-4.5 h-4.5 text-[#E31E24]"></i>
                                        {{ $schedule->kapal }}
                                    </div>
                                </td>
                                <td class="px-8 py-4">
                                    <span class="px-2.5 py-1 rounded bg-gray-100 text-gray-700 text-xs font-semibold">
                                        {{ $schedule->voy }}
                                    </span>
                                </td>
                                <td class="px-8 py-4 text-center">
                                    @if ($schedule->is_full)
                                        <span class="inline-block rounded bg-[#FDEAEA] text-[#E31E24] text-[10px] font-heading font-bold uppercase tracking-wider px-2.5 py-1">FULL</span>
                                    @elseif ($schedule->closing->isPast())
                                        <span class="inline-block rounded bg-gray-100 text-gray-500 text-[10px] font-heading font-bold uppercase tracking-wider px-2.5 py-1">CLOSED</span>
                                    @else
                                        <span class="font-medium text-[#B5171C]">{{ $schedule->closing->format('d M Y') }}</span>
                                    @endif
                                </td>
                                <td class="px-8 py-4 text-center font-semibold text-[#1F2328]">
                                    {{ $schedule->etd_sub->format('d M Y') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-[#5B6270]">
                                    <i data-lucide="calendar-x" class="w-12 h-12 text-gray-300 mx-auto mb-3"></i>
                                    Belum ada jadwal kapal yang tersedia saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="block md:hidden max-h-[400px] overflow-y-auto divide-y divide-gray-100">
                @forelse ($schedules as $index => $schedule)
                    <div class="p-6 space-y-4 hover:bg-gray-50 transition-colors">
                        <div class="flex justify-between items-start">
                            <div>
                                <div class="flex items-center gap-2">
                                    <i data-lucide="ship" class="w-4 h-4 text-[#E31E24]"></i>
                                    <h3 class="font-bold text-[#1F2328]">{{ $schedule->kapal }}</h3>
                                </div>
                                <p class="text-xs text-gray-400 mt-0.5">Voyage: {{ $schedule->voy }}</p>
                            </div>
                            <span class="inline-flex items-center rounded-full bg-red-50 text-[#B5171C] px-2.5 py-0.5 text-xs font-semibold">
                                No. {{ $index + 1 }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-4 text-xs">
                            <div>
                                <p class="text-gray-400 font-medium">Closing Surabaya</p>
                                <p class="mt-0.5">
                                    @if ($schedule->is_full)
                                        <span class="inline-block rounded bg-[#FDEAEA] text-[#E31E24] text-[9px] font-heading font-bold uppercase tracking-wider px-2 py-0.5">FULL</span>
                                    @elseif ($schedule->closing->isPast())
                                        <span class="inline-block rounded bg-gray-100 text-gray-500 text-[9px] font-heading font-bold uppercase tracking-wider px-2 py-0.5">CLOSED</span>
                                    @else
                                        <span class="font-semibold text-[#B5171C]">{{ $schedule->closing->format('d M Y') }}</span>
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-400 font-medium">ETD Surabaya</p>
                                <p class="font-semibold text-[#1F2328] mt-0.5">
                                    {{ $schedule->etd_sub->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-6 py-12 text-center text-[#5B6270]">
                        <i data-lucide="calendar-x" class="w-12 h-12 text-gray-300 mx-auto mb-3"></i>
                        Belum ada jadwal kapal yang tersedia saat ini.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ============ TESTIMONIAL ============ --}}
<section class="bg-[#1F2328] py-16 lg:py-24 relative overflow-hidden" x-data="{ activeSlide: 0 }">
    <i data-lucide="quote" class="absolute top-10 left-10 w-24 h-24 text-white/5"></i>
    <div class="relative max-w-4xl mx-auto px-6">
        
        <!-- Slides Container -->
        <div class="relative h-[160px] sm:h-[120px] md:h-[100px] flex items-center justify-center">
            
            <!-- Slide 1 -->
            <div x-show="activeSlide === 0" 
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-300 absolute"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="text-center w-full">
                <p class="font-heading text-white text-lg sm:text-xl lg:text-2xl leading-relaxed italic">
                    "Pengiriman selalu tepat waktu dan barang selalu sampai dengan aman. Pelayanan sangat baik, ramah, dan profesional."
                </p>
            </div>
 
            <!-- Slide 2 -->
            <div x-show="activeSlide === 1" 
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-300 absolute"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="text-center w-full" x-cloak>
                <p class="font-heading text-white text-lg sm:text-xl lg:text-2xl leading-relaxed italic">
                    "Pelayanan pengiriman barang sangat memuaskan dan responsif. Pengangkutan terjamin aman hingga tiba di lokasi tujuan."
                </p>
            </div>

            <!-- Slide 3 -->
            <div x-show="activeSlide === 2" 
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-300 absolute"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="text-center w-full" x-cloak>
                <p class="font-heading text-white text-lg sm:text-xl lg:text-2xl leading-relaxed italic">
                    "Proses pengiriman sangat cepat, aman, dan tanpa kendala. Sangat terpercaya untuk pengiriman kargo dan muatan kapal."
                </p>
            </div>

        </div>

        <!-- Controls (Arrows + Dots) -->
        <div class="flex justify-center items-center gap-6 mt-12">
            <button @click="activeSlide = (activeSlide === 0) ? 2 : activeSlide - 1" 
                    class="flex h-10 w-10 items-center justify-center rounded-full border border-white/20 text-white hover:bg-white/10 hover:border-white transition-colors"
                    aria-label="Slide sebelumnya">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </button>
            
            <!-- Indicator Dots -->
            <div class="flex gap-2">
                <button @click="activeSlide = 0" class="h-2 rounded-full transition-all duration-300" :class="activeSlide === 0 ? 'w-6 bg-[#E31E24]' : 'w-2 bg-white/30 hover:bg-white/50'" aria-label="Slide 1"></button>
                <button @click="activeSlide = 1" class="h-2 rounded-full transition-all duration-300" :class="activeSlide === 1 ? 'w-6 bg-[#E31E24]' : 'w-2 bg-white/30 hover:bg-white/50'" aria-label="Slide 2"></button>
                <button @click="activeSlide = 2" class="h-2 rounded-full transition-all duration-300" :class="activeSlide === 2 ? 'w-6 bg-[#E31E24]' : 'w-2 bg-white/30 hover:bg-white/50'" aria-label="Slide 3"></button>
            </div>

            <button @click="activeSlide = (activeSlide === 2) ? 0 : activeSlide + 1" 
                    class="flex h-10 w-10 items-center justify-center rounded-full border border-white/20 text-white hover:bg-white/10 hover:border-white transition-colors"
                    aria-label="Slide berikutnya">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>
        </div>

    </div>
</section>

{{-- ============ CTA + CONTACT ============ --}}
<section id="kontak" class="bg-[#F7F8FA] py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
        <span class="inline-block rounded-full bg-[#FDEAEA] text-[#B5171C] text-xs font-heading font-semibold tracking-wide uppercase px-4 py-1.5">Hubungi Kami</span>
        <h2 class="mt-4 font-heading font-bold text-3xl lg:text-4xl text-[#1F2328] leading-tight">
            Siap Mengirim Barang Anda ke Seluruh Indonesia
        </h2>
        <p class="mt-4 text-[#5B6270] leading-relaxed max-w-2xl mx-auto">
            Hubungi tim logistik kami di salah satu kantor cabang kami untuk mendapatkan penawaran pengiriman terbaik.
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 mt-12 text-left items-stretch">
            <!-- Peta Rute Cabang (Kiri pada desktop) -->
            <div class="lg:col-span-7 bg-white rounded-3xl p-6 shadow-md border border-[#E5E7EB]/60 flex flex-col overflow-hidden group hover:shadow-lg transition-all duration-300">
                <div class="h-full flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-block rounded-full bg-[#FDEAEA] text-[#B5171C] text-[10px] font-heading font-bold uppercase tracking-wider px-3 py-1">
                            Peta Operasional
                        </span>
                        <span class="text-xs text-gray-500 font-medium flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Jalur Aktif
                        </span>
                    </div>
                    <h3 class="font-heading font-bold text-xl text-[#1F2328] mb-2">Rute Jakarta - Surabaya - Kupang</h3>
                    <p class="text-sm text-[#5B6270] mb-6">Visualisasi jalur konektivitas dan jangkauan ekspedisi laut kami untuk wilayah Indonesia Timur.</p>
                    
                    <div class="relative flex-1 min-h-[300px] md:min-h-[350px] lg:min-h-[380px] bg-[#F8FAFC] rounded-2xl border border-gray-100 overflow-hidden flex items-center justify-center p-4">
                        <img src="{{ asset('images/foto peta.png') }}" alt="Peta Rute PT Sanwa Antar Nusa - Jakarta, Surabaya, Kupang" class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-[1.03]">
                        
                        <!-- Floating Legend -->
                        <div class="absolute bottom-4 left-4 right-4 bg-white/90 backdrop-blur-md px-4 py-2.5 rounded-xl shadow-sm border border-gray-150 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-[#B5171C] animate-pulse"></span>
                                <span class="font-semibold text-[#1F2328]">Konektivitas Laut Utama</span>
                            </div>
                            <span class="text-gray-500 font-medium">Spesialis Indonesia Timur</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kantor Cabang (Kanan pada desktop) -->
            <div class="lg:col-span-5 grid grid-cols-1 md:grid-cols-3 lg:flex lg:flex-col gap-6">
                <!-- Kantor Pusat (Surabaya) -->
                <div class="bg-white rounded-2xl p-6 shadow-md border border-[#E5E7EB]/60 flex flex-col justify-between hover:shadow-lg hover:border-[#B5171C]/30 hover:-translate-y-1 transition-all duration-300">
                    <div>
                        <span class="inline-block rounded-full bg-[#FDEAEA] text-[#B5171C] text-[10px] font-heading font-bold uppercase tracking-wider px-3 py-1 mb-4">
                            Kantor Pusat (Head Office)
                        </span>
                        <h3 class="font-heading font-bold text-xl text-[#1F2328] mb-4">Surabaya</h3>
                        <div class="space-y-3">
                            <div class="flex items-start gap-3 text-sm text-[#5B6270]">
                                <i data-lucide="map-pin" class="w-4 h-4 text-[#B5171C] shrink-0 mt-0.5"></i>
                                <span>Jl. Kalimas Baru No. 26, Surabaya, Jawa Timur</span>
                            </div>
                            <a href="https://wa.me/628113144405" target="_blank" rel="noopener" class="flex items-center gap-3 text-sm text-[#5B6270] hover:text-[#E31E24] transition-colors">
                                <i data-lucide="phone" class="w-4 h-4 text-[#B5171C] shrink-0"></i>
                                <span>+62 811-3144-405</span>
                            </a>
                            <div class="flex items-center gap-3 text-sm text-[#5B6270]">
                                <i data-lucide="mail" class="w-4 h-4 text-[#B5171C] shrink-0"></i>
                                <span>pt.sanwaantarnusa26@gmail.com</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Jakarta -->
                <div class="bg-white rounded-2xl p-6 shadow-md border border-[#E5E7EB]/60 flex flex-col justify-between hover:shadow-lg hover:border-[#B5171C]/30 hover:-translate-y-1 transition-all duration-300">
                    <div>
                        <span class="inline-block rounded-full bg-gray-100 text-gray-700 text-[10px] font-heading font-bold uppercase tracking-wider px-3 py-1 mb-4">
                            Kantor Cabang
                        </span>
                        <h3 class="font-heading font-bold text-xl text-[#1F2328] mb-4">Jakarta</h3>
                        <div class="space-y-3">
                            <div class="flex items-start gap-3 text-sm text-[#5B6270]">
                                <i data-lucide="map-pin" class="w-4 h-4 text-[#B5171C] shrink-0 mt-0.5"></i>
                                <span>Jl. Tembang No. 46, Tanjung Priok, Jakarta Utara</span>
                            </div>
                            <a href="https://wa.me/6281318718883" target="_blank" rel="noopener" class="flex items-center gap-3 text-sm text-[#5B6270] hover:text-[#E31E24] transition-colors">
                                <i data-lucide="phone" class="w-4 h-4 text-[#B5171C] shrink-0"></i>
                                <span>+62 813-1871-8883</span>
                            </a>
                            <div class="flex items-center gap-3 text-sm text-[#5B6270]">
                                <i data-lucide="mail" class="w-4 h-4 text-[#B5171C] shrink-0"></i>
                                <span>ptsanwa@gmail.com</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kupang -->
                <div class="bg-white rounded-2xl p-6 shadow-md border border-[#E5E7EB]/60 flex flex-col justify-between hover:shadow-lg hover:border-[#B5171C]/30 hover:-translate-y-1 transition-all duration-300">
                    <div>
                        <span class="inline-block rounded-full bg-gray-100 text-gray-700 text-[10px] font-heading font-bold uppercase tracking-wider px-3 py-1 mb-4">
                            Kantor Cabang
                        </span>
                        <h3 class="font-heading font-bold text-xl text-[#1F2328] mb-4">Kupang</h3>
                        <div class="space-y-3">
                            <div class="flex items-start gap-3 text-sm text-[#5B6270]">
                                <i data-lucide="map-pin" class="w-4 h-4 text-[#B5171C] shrink-0 mt-0.5"></i>
                                <span>Jl. Oeleta Raya, Alak, Kupang, Nusa Tenggara Timur</span>
                            </div>
                            <a href="https://wa.me/628113144405" target="_blank" rel="noopener" class="flex items-center gap-3 text-sm text-[#5B6270] hover:text-[#E31E24] transition-colors">
                                <i data-lucide="phone" class="w-4 h-4 text-[#B5171C] shrink-0"></i>
                                <span>+62 811-3144-405</span>
                            </a>
                            <div class="flex items-center gap-3 text-sm text-[#5B6270]">
                                <i data-lucide="mail" class="w-4 h-4 text-[#B5171C] shrink-0"></i>
                                <span>pt.sanwaantarnusa26@gmail.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============ FAQ ============ --}}
<section class="bg-white py-16 lg:py-24">
    <div class="max-w-3xl mx-auto px-6 lg:px-8">
        <div class="text-center">
            <span class="inline-block rounded-full bg-[#FDEAEA] text-[#B5171C] text-xs font-heading font-semibold tracking-wide uppercase px-4 py-1.5">FAQ</span>
            <h2 class="mt-4 font-heading font-bold text-3xl lg:text-4xl text-[#1F2328]">Pertanyaan yang Sering Diajukan</h2>
        </div>

        <div class="mt-12 space-y-4">
            @foreach ([
                ['q' => 'Apa saja rute spesialisasi dari PT Sanwa Antar Nusa?', 'a' => 'Kami memiliki spesialisasi rute Jakarta - Surabaya - Kupang dan wilayah Indonesia Timur lainnya.'],
                ['q' => 'Bagaimana rute pengiriman multimodal Jakarta - Surabaya - Kupang?', 'a' => 'Pengiriman dilakukan secara terintegrasi yaitu: Jakarta - Surabaya menggunakan kereta/darat, kemudian Surabaya - Kupang menggunakan kapal/laut.'],
                ['q' => 'Berapa kali jadwal keberangkatan kapal kargo ke Kupang?', 'a' => 'Kami mengutamakan kelancaran pengiriman dan penerimaan barang dengan jadwal keberangkatan 2-3x seminggu yang didukung oleh perusahaan pelayaran nasional.'],
            ] as $index => $faq)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden" x-data="{ open: false }">
                    <button type="button" @click="open = !open"
                            class="w-full flex items-center justify-between gap-4 px-6 py-5 text-left"
                            :aria-expanded="open" aria-controls="faq-panel-{{ $index }}">
                        <span class="font-heading font-semibold text-[#1F2328]">{{ $faq['q'] }}</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-[#E31E24] shrink-0 transition-transform duration-300"
                           :class="open ? 'rotate-180' : ''"></i>
                    </button>
                    <div id="faq-panel-{{ $index }}" x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                        <p class="px-6 pb-5 text-sm text-[#5B6270] leading-relaxed">{{ $faq['a'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ FOOTER (tanpa logo, fokus kontak) ============ --}}
<footer class="bg-[#15181C] pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-[1.3fr_1fr_1fr_1fr] gap-x-10 gap-y-10 pb-12 border-b border-white/10 items-start">

            {{-- Info & Social media --}}
            <div class="pt-1">
                <img src="{{ asset('images/logo%20sanwa.png') }}" alt="Logo PT Sanwa Antar Nusa" class="h-14 w-auto object-contain brightness-0 invert -mt-5 mb-5" loading="lazy">
                <p class="text-sm text-white/60 leading-relaxed mb-6 max-w-xs">
                    Jasa ekspedisi dan logistik nasional kargo laut dan darat terpercaya ke seluruh Indonesia.
                </p>
                <div class="flex items-center gap-3">
                    <a href="https://www.instagram.com/sanwaantarnusa?igsh=a2N6MGpkZGUwcjhq" target="_blank" rel="noopener" aria-label="Kunjungi Instagram Sanwa Antar Nusa"
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white hover:bg-[#E31E24] transition-colors">
                        <i class="fa-brands fa-instagram text-lg"></i>
                    </a>
                    <a href="https://www.tiktok.com/@pt_sanwaantarnusa?_r=1&_t=ZS-97kfLvdwNxX" target="_blank" rel="noopener" aria-label="Kunjungi TikTok Sanwa Antar Nusa"
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white hover:bg-[#E31E24] transition-colors">
                        <i class="fa-brands fa-tiktok text-lg"></i>
                    </a>
                    <a href="https://wa.me/628113144405" target="_blank" rel="noopener" aria-label="Chat WhatsApp Sanwa Antar Nusa"
                    class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white hover:bg-[#E31E24] transition-colors">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                    </a>
                </div>
            </div>

            {{-- Head Office --}}
            <div class="pt-1">
                <p class="font-heading font-semibold text-xs uppercase tracking-wider text-[#E31E24] mb-4">Head Office</p>
                <p class="font-heading font-bold text-white mb-2 text-sm">Surabaya</p>
                <ul class="space-y-2 text-xs text-white/70">
                    <li class="flex items-start gap-2">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#E31E24] shrink-0 mt-0.5"></i>
                        <span>Jl. Kalimas Baru No. 26, Surabaya, Jawa Timur</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="phone" class="w-3.5 h-3.5 text-[#E31E24] shrink-0"></i>
                        <a href="https://wa.me/628113144405" target="_blank" rel="noopener" class="hover:text-[#E31E24] transition-colors">+62 811-3144-405</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="mail" class="w-3.5 h-3.5 text-[#E31E24] shrink-0"></i>
                        <span>pt.sanwaantarnusa26@gmail.com</span>
                    </li>
                </ul>
            </div>

            {{-- Jakarta Branch --}}
            <div class="pt-1">
                <p class="font-heading font-semibold text-xs uppercase tracking-wider text-white/40 mb-4">Branch Office</p>
                <p class="font-heading font-bold text-white mb-2 text-sm">Jakarta</p>
                <ul class="space-y-2 text-xs text-white/70">
                    <li class="flex items-start gap-2">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#E31E24] shrink-0 mt-0.5"></i>
                        <span>Jl. Tembang No. 46, Tanjung Priok, Jakarta Utara</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="phone" class="w-3.5 h-3.5 text-[#E31E24] shrink-0"></i>
                        <a href="https://wa.me/6281318718883" target="_blank" rel="noopener" class="hover:text-[#E31E24] transition-colors">+62 813-1871-8883</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="mail" class="w-3.5 h-3.5 text-[#E31E24] shrink-0"></i>
                        <span>ptsanwa@gmail.com</span>
                    </li>
                </ul>
            </div>

            {{-- Kupang Branch --}}
            <div class="pt-1">
                <p class="font-heading font-semibold text-xs uppercase tracking-wider text-white/40 mb-4">Branch Office</p>
                <p class="font-heading font-bold text-white mb-2 text-sm">Kupang</p>
                <ul class="space-y-2 text-xs text-white/70">
                    <li class="flex items-start gap-2">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#E31E24] shrink-0 mt-0.5"></i>
                        <span>Jl. Oeleta Raya, Alak, Kupang, Nusa Tenggara Timur</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="phone" class="w-3.5 h-3.5 text-[#E31E24] shrink-0"></i>
                        <a href="https://wa.me/628113144405" target="_blank" rel="noopener" class="hover:text-[#E31E24] transition-colors">+62 811-3144-405</a>
                    </li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="mail" class="w-3.5 h-3.5 text-[#E31E24] shrink-0"></i>
                        <span>pt.sanwaantarnusa26@gmail.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-xs text-white/50">
                &copy; {{ date('Y') }} PT Sanwa Antar Nusa. All rights reserved.
            </p>
            <ul class="flex flex-wrap items-center gap-6 text-xs text-white/60">
                <li><a href="#beranda" class="hover:text-white transition-colors">Beranda</a></li>
                <li><a href="#layanan" class="hover:text-white transition-colors">Layanan</a></li>
                <li><a href="#jadwal" class="hover:text-white transition-colors">Jadwal Kapal</a></li>
                <li><a href="#tentang" class="hover:text-white transition-colors">Tentang Kami</a></li>
                <li><a href="#kontak" class="hover:text-white transition-colors">Kontak</a></li>
            </ul>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.lucide) { lucide.createIcons(); }

        // Intersection Observer for scroll reveal animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.reveal-on-scroll').forEach(el => {
            observer.observe(el);
        });
    });
</script>
</body>
</html>