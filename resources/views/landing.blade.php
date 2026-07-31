<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Sanwa Antar Nusa — Ekspedisi & Logistik Nasional</title>
    <meta name="description" content="PT Sanwa Antar Nusa — jasa ekspedisi dan logistik nasional: kargo laut dan pengiriman darat ke seluruh Indonesia.">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-white text-[#1F2328] font-body antialiased" 
      x-data="{ menuOpen: false, scrolled: false, activeSection: 'beranda' }" 
      x-init="
        const updateActive = () => {
            scrolled = (window.pageYOffset > 50);
            const sections = ['beranda', 'tentang', 'layanan', 'keunggulan', 'jadwal', 'kontak'];
            for (let i = sections.length - 1; i >= 0; i--) {
                const el = document.getElementById(sections[i]);
                if (el && window.pageYOffset >= (el.offsetTop - 180)) {
                    activeSection = sections[i];
                    break;
                }
            }
        };
        updateActive();
      "
      @scroll.window="
        scrolled = (window.pageYOffset > 50);
        const sections = ['beranda', 'tentang', 'layanan', 'keunggulan', 'jadwal', 'kontak'];
        for (let i = sections.length - 1; i >= 0; i--) {
            const el = document.getElementById(sections[i]);
            if (el && window.pageYOffset >= (el.offsetTop - 180)) {
                activeSection = sections[i];
                break;
            }
        }
      ">

{{-- ============ NAVBAR ============ --}}
<header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-3"
        :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-sm border-b border-[#E5E7EB]/80' : 'bg-transparent shadow-none border-b border-transparent'">
    <nav class="max-w-7xl mx-auto px-6 lg:px-8 flex items-center justify-between" aria-label="Navigasi utama">
        <a href="{{ url('/') }}" class="flex items-center" aria-label="PT Sanwa Antar Nusa - Beranda">
            <img src="{{ asset('images/logo%20sanwa.png') }}" alt="Logo PT Sanwa Antar Nusa" 
                 class="h-16 w-auto sm:h-20 object-contain transition-all duration-300"
                 :class="scrolled ? '' : 'brightness-0 invert'">
        </a>

        @php
            $navItems = [
                ['id' => 'beranda', 'label' => 'Beranda'],
                ['id' => 'tentang', 'label' => 'Tentang'],
                ['id' => 'layanan', 'label' => 'Layanan'],
                ['id' => 'keunggulan', 'label' => 'Keunggulan'],
                ['id' => 'jadwal', 'label' => 'Jadwal Kapal'],
                ['id' => 'kontak', 'label' => 'Kontak'],
            ];
        @endphp

        <ul class="hidden lg:flex items-center gap-8 font-heading font-medium text-sm transition-colors duration-300"
            :class="scrolled ? 'text-[#1F2328]' : 'text-white'">
            @foreach ($navItems as $item)
                <li class="relative py-1.5">
                    <a href="#{{ $item['id'] }}" 
                       @click="activeSection = '{{ $item['id'] }}'"
                       class="transition-colors hover:text-[#E31E24]"
                       :class="activeSection === '{{ $item['id'] }}' ? (scrolled ? 'text-[#E31E24] font-bold' : 'text-white font-bold') : ''">
                        {{ $item['label'] }}
                    </a>
                    <!-- Red Indicator Line Below Active Item -->
                    <span class="absolute -bottom-1 left-0 right-0 h-[2.5px] bg-[#E31E24] rounded-full transition-all duration-300 transform origin-left"
                          :class="activeSection === '{{ $item['id'] }}' ? 'scale-x-100 opacity-100' : 'scale-x-0 opacity-0'"></span>
                </li>
            @endforeach
        </ul>

        <button @click="menuOpen = !menuOpen" class="lg:hidden transition-colors duration-300" 
                :class="scrolled ? 'text-[#1F2328]' : 'text-white'" aria-label="Buka menu navigasi" :aria-expanded="menuOpen">
            <i data-lucide="menu" x-show="!menuOpen" class="w-7 h-7"></i>
            <i data-lucide="x" x-show="menuOpen" class="w-7 h-7" x-cloak></i>
        </button>
    </nav>

    <div x-show="menuOpen" x-transition x-cloak class="lg:hidden mt-4 mx-6 rounded-2xl bg-white shadow-xl border border-[#E5E7EB] px-6 py-6">
        <ul class="flex flex-col gap-4 font-heading font-medium text-[#1F2328]">
            @foreach ($navItems as $item)
                <li>
                    <a href="#{{ $item['id'] }}" 
                       @click="menuOpen = false; activeSection = '{{ $item['id'] }}'"
                       class="flex items-center justify-between py-1 transition-colors"
                       :class="activeSection === '{{ $item['id'] }}' ? 'text-[#E31E24] font-bold' : ''">
                        <span>{{ $item['label'] }}</span>
                        <span x-show="activeSection === '{{ $item['id'] }}'" class="w-2 h-2 rounded-full bg-[#E31E24]"></span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</header>


{{-- ============ HERO ============ --}}
<section id="beranda" class="relative min-h-[90vh] lg:min-h-screen flex flex-col justify-between overflow-hidden bg-[#06111F] pt-32 sm:pt-40 lg:pt-44 pb-12 sm:pb-16">
    <!-- Hero Background Image with Layered Gradient Mask -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/foto%20kapal.png') }}" 
             alt="Kapal kargo STAR BIRD PT Sanwa Antar Nusa" 
             class="w-full h-full object-cover object-center">
        <!-- Horizontal Layered Gradient: Dark Navy on left, transparent on right -->
        <div class="absolute inset-0 bg-gradient-to-r from-[#06111F] via-[#06111F]/90 via-50% sm:via-45% to-transparent"></div>
        <!-- Vertical Layered Gradient: Dark Navy top and bottom -->
        <div class="absolute inset-0 bg-gradient-to-b from-[#06111F]/80 via-transparent to-[#06111F]"></div>
    </div>

    <!-- Main Hero Body -->
    <div class="relative z-10 max-w-7xl mx-auto w-full px-6 lg:px-8 my-auto pt-6">
        <!-- Controlled Content Column (Left Side ~40-45%) -->
        <div class="lg:max-w-[48%] xl:max-w-[45%] flex flex-col items-start">
            
            <!-- Compact Red Pill Label -->
            <div class="inline-flex items-center gap-2 rounded-full bg-[#EF2029]/20 border border-[#EF2029]/40 text-[#EF2029] text-[11px] font-heading font-bold tracking-widest uppercase px-3.5 py-1 mb-6 reveal-immediate reveal-down">
                <span class="w-1.5 h-1.5 rounded-full bg-[#EF2029] animate-pulse"></span>
                18+ YEARS OF LOGISTICS EXPERIENCE
            </div>

            <!-- Main Heading (2 Lines on Desktop) -->
            <h1 class="font-heading font-extrabold text-white text-4xl sm:text-5xl lg:text-6xl leading-[1.1] tracking-tight mb-6 reveal-immediate reveal-up delay-100">
                National Freight<br class="hidden sm:inline">
                Forwarder & Logistics
            </h1>

            <!-- Supporting Paragraph -->
            <p class="max-w-xl text-slate-300 text-base sm:text-lg leading-relaxed mb-8 reveal-immediate reveal-up delay-200">
                Menghubungkan Jakarta, Surabaya, Kupang, serta berbagai wilayah Indonesia Timur melalui layanan angkutan laut dan freight forwarding yang terpercaya.
            </p>

            <!-- Two CTA Buttons -->
            <div class="flex flex-wrap items-center gap-4 reveal-immediate reveal-up delay-300">
                <a href="#layanan" class="inline-flex items-center gap-2.5 rounded-xl bg-[#EF2029] text-white px-7 py-3.5 font-heading font-semibold text-sm shadow-lg shadow-[#EF2029]/30 hover:bg-[#C8161E] hover:scale-[1.02] transition-all duration-300">
                    Lihat Layanan <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
                <a href="#kontak" class="inline-flex items-center justify-center rounded-xl bg-[#0D1D30]/80 border border-white/20 text-white px-7 py-3.5 font-heading font-semibold text-sm hover:bg-[#0D1D30] hover:border-white/40 transition-all duration-300">
                    Hubungi Kami
                </a>
            </div>

        </div>
    </div>

    <!-- Integrated Statistics Horizontal Row (Bottom of Hero) -->
    <div class="relative z-10 max-w-7xl mx-auto w-full px-6 lg:px-8 mt-12 sm:mt-16 reveal-immediate reveal-up delay-400">
        <div class="bg-[#081522]/90 border border-white/10 rounded-2xl p-6 sm:p-7 backdrop-blur-md shadow-2xl">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-0 divide-y sm:divide-y-0 sm:divide-x divide-white/10">
                
                <!-- Stat 1 -->
                <div class="flex items-center gap-4 sm:px-6 first:pl-0">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#EF2029]/15 text-[#EF2029] border border-[#EF2029]/30">
                        <i data-lucide="anchor" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <div class="font-heading font-extrabold text-3xl lg:text-4xl text-white count-up" data-target="18" data-suffix="+">0</div>
                        <div class="text-xs text-slate-400 font-medium uppercase tracking-wider mt-0.5">Tahun Melayani</div>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="flex items-center gap-4 sm:px-6 pt-4 sm:pt-0">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#EF2029]/15 text-[#EF2029] border border-[#EF2029]/30">
                        <i data-lucide="package-check" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <div class="font-heading font-extrabold text-3xl lg:text-4xl text-white count-up" data-target="120000" data-format="k" data-suffix="+">0</div>
                        <div class="text-xs text-slate-400 font-medium uppercase tracking-wider mt-0.5">Pengiriman Berhasil</div>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="flex items-center gap-4 sm:px-6 pt-4 sm:pt-0">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-[#EF2029]/15 text-[#EF2029] border border-[#EF2029]/30">
                        <i data-lucide="map-pin" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <div class="font-heading font-extrabold text-3xl lg:text-4xl text-white count-up" data-target="25" data-suffix="+">0</div>
                        <div class="text-xs text-slate-400 font-medium uppercase tracking-wider mt-0.5">Kota Terjangkau</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


{{-- ============ ABOUT SECTION (EDITORIAL REDESIGN) ============ --}}
<section id="tentang" class="bg-[#F7F8FA] py-20 lg:py-28 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
        
        <!-- LEFT COLUMN: Visually dominant container port image (~48% width) -->
        <div class="lg:col-span-6 relative order-1 reveal-on-scroll reveal-left">
            <div class="relative rounded-2xl overflow-hidden shadow-2xl bg-[#1F2328] group">
                <!-- Port & Container Image -->
                <img src="{{ asset('images/foto%20muat.jpeg') }}" 
                     alt="Operasional kargo laut dan pemuatan kontainer PT Sanwa Antar Nusa di pelabuhan" 
                     class="w-full h-[450px] sm:h-[500px] lg:h-[560px] object-cover object-center group-hover:scale-105 transition-transform duration-700" 
                     loading="lazy">
                
                <!-- Bottom Integrated Editorial Information Strip Overlay -->
                <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-[#1F2328]/95 via-[#1F2328]/80 to-transparent pt-12 pb-6 px-6 sm:px-8 backdrop-blur-[2px]">
                    <div class="flex flex-wrap items-end justify-between gap-6 border-t border-white/15 pt-5">
                        
                        <!-- Primary Stat: 18+ TAHUN PENGALAMAN DALAM LOGISTIK -->
                        <div class="flex items-center gap-4">
                            <span class="font-heading font-extrabold text-4xl sm:text-5xl text-[#E31E24] leading-none count-up" data-target="18" data-suffix="+">0</span>
                            <div class="text-[11px] sm:text-xs font-heading font-bold uppercase tracking-wider text-white leading-tight max-w-[10rem]">
                                Tahun Pengalaman<br>Dalam Logistik
                            </div>
                        </div>

                        <!-- Secondary Metadata: SURABAYA PORT EST. 2008 -->
                        <div class="text-right border-l border-white/20 pl-5">
                            <span class="block text-xs font-heading font-bold text-[#E31E24] uppercase tracking-widest">SURABAYA PORT</span>
                            <span class="block text-[11px] font-heading font-medium text-white/70 uppercase tracking-wider mt-0.5">EST. 2008</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Company introduction, editorial capabilities list, and CTA (~52% width) -->
        <div class="lg:col-span-6 order-2 space-y-8 reveal-on-scroll reveal-right">
            
            <!-- Section Label & Headline -->
            <div>
                <div class="flex items-center gap-2.5 mb-3">
                    <span class="w-6 h-[2px] bg-[#E31E24]"></span>
                    <span class="text-xs font-heading font-bold text-[#E31E24] tracking-widest uppercase">TENTANG SANWA ANTAR NUSA</span>
                </div>

                <h2 class="font-heading font-extrabold text-3xl sm:text-4xl lg:text-[2.6rem] text-[#1F2328] leading-[1.15] tracking-tight">
                    Mitra Logistik Terpercaya<br class="hidden sm:inline">
                    untuk Bisnis Anda
                </h2>

                <!-- Short Red Horizontal Divider -->
                <div class="w-12 h-[2px] bg-[#E31E24] my-5"></div>
            </div>

            <!-- Two Concise Paragraphs -->
            <div class="space-y-4 text-[#5B6270] text-base leading-relaxed font-body">
                <p>
                    PT Sanwa Antar Nusa adalah perusahaan jasa transportasi laut dan freight forwarding yang menghubungkan berbagai wilayah Indonesia.
                </p>
                <p>
                    Berbasis di Surabaya sejak 2008, kami melayani rute Jakarta – Surabaya – Kupang dan berbagai wilayah Indonesia Timur dengan fokus pada pengiriman yang terjadwal dan dapat diandalkan.
                </p>
            </div>

            <!-- Structured Editorial Capabilities List (Exactly 3 Items) -->
            <div class="space-y-5 pt-2">
                
                <!-- Capability Item 01 -->
                <div class="pb-5 border-b border-gray-200/80 flex items-start gap-4">
                    <span class="font-heading font-bold text-xs text-[#E31E24] tracking-wider pt-0.5 shrink-0">01</span>
                    <div>
                        <h3 class="font-heading font-bold text-sm sm:text-base uppercase tracking-wider text-[#1F2328] mb-1">
                            MARITIME FREIGHT
                        </h3>
                        <p class="text-xs sm:text-sm text-[#5B6270] leading-relaxed">
                            Kargo laut antar pulau dan rute Indonesia Timur.
                        </p>
                    </div>
                </div>

                <!-- Capability Item 02 -->
                <div class="pb-5 border-b border-gray-200/80 flex items-start gap-4">
                    <span class="font-heading font-bold text-xs text-[#E31E24] tracking-wider pt-0.5 shrink-0">02</span>
                    <div>
                        <h3 class="font-heading font-bold text-sm sm:text-base uppercase tracking-wider text-[#1F2328] mb-1">
                            INTEGRATED LOGISTICS
                        </h3>
                        <p class="text-xs sm:text-sm text-[#5B6270] leading-relaxed">
                            Pengiriman darat, dokumen ekspedisi, dan koordinasi logistik.
                        </p>
                    </div>
                </div>

                <!-- Capability Item 03 -->
                <div class="pb-2 flex items-start gap-4">
                    <span class="font-heading font-bold text-xs text-[#E31E24] tracking-wider pt-0.5 shrink-0">03</span>
                    <div>
                        <h3 class="font-heading font-bold text-xs sm:text-base uppercase tracking-wider text-[#1F2328] mb-1">
                            CARGO PROTECTION
                        </h3>
                        <p class="text-xs sm:text-sm text-[#5B6270] leading-relaxed">
                            Asuransi dan perlindungan untuk menjaga keamanan muatan.
                        </p>
                    </div>
                </div>

            </div>

            <!-- CTA Area -->
            <div class="pt-4 flex flex-wrap items-center gap-6">
                <!-- Primary Red Button -->
                <a href="#kontak" class="inline-flex items-center gap-2.5 rounded-xl bg-[#E31E24] text-white px-7 py-3.5 font-heading font-semibold text-sm hover:bg-[#B5171C] hover:scale-[1.02] transition-all duration-300 shadow-md shadow-red-900/15">
                    HUBUNGI KAMI <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>

                <!-- Visually Secondary Phone Number -->
                <div class="text-xs">
                    <span class="block text-gray-400 font-medium mb-0.5">atau hubungi langsung</span>
                    <a href="https://wa.me/628113144405" target="_blank" rel="noopener" class="font-heading font-bold text-sm text-[#1F2328] hover:text-[#E31E24] transition-colors">
                        +62 811-3144-405
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>


{{-- ============ SERVICES SECTION (EDITORIAL REDESIGN) ============ --}}
<section id="layanan" class="bg-white py-20 lg:py-28 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <!-- SECTION HEADER (Full-width left-aligned) -->
        <div class="max-w-3xl reveal-on-scroll reveal-up">
            <div class="flex items-center gap-2.5 mb-3">
                <span class="w-6 h-[2px] bg-[#E31E24]"></span>
                <span class="text-xs font-heading font-bold text-[#E31E24] tracking-widest uppercase">LAYANAN KAMI</span>
            </div>
            
            <h2 class="font-heading font-extrabold text-3xl sm:text-4xl lg:text-[2.5rem] text-[#1F2328] leading-tight tracking-tight">
                Dari Pelabuhan hingga Tujuan
            </h2>

            <p class="mt-4 text-[#5B6270] text-base sm:text-lg leading-relaxed font-body">
                Solusi pengiriman laut dan darat yang menghubungkan bisnis Anda dengan berbagai wilayah Indonesia.
            </p>
        </div>

        <!-- Subtle thin horizontal divider below header -->
        <div class="w-full h-[1px] bg-gray-200/80 my-10 lg:my-14"></div>

        <!-- SERVICES CONTAINER -->
        <div class="space-y-16 lg:space-y-24">
            
            <!-- SERVICE 01 — FEATURED CORE SERVICE (ASYMMETRIC TWO-COLUMN: LEFT IMAGE, RIGHT INFO) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center reveal-on-scroll reveal-up">
                
                <!-- Left Column: Large Cargo Ship Image (Primary Visual Anchor) -->
                <div class="lg:col-span-6 relative">
                    <div class="rounded-2xl overflow-hidden shadow-xl bg-[#1F2328] group">
                        <img src="{{ asset('images/foto%20kapal2.png') }}" 
                             alt="Kargo Laut (Forwarding) PT Sanwa Antar Nusa" 
                             class="w-full h-[360px] sm:h-[440px] lg:h-[480px] object-cover object-center group-hover:scale-105 transition-transform duration-700" 
                             loading="lazy">
                    </div>
                </div>

                <!-- Right Column: Service Information & Metadata -->
                <div class="lg:col-span-6 space-y-6 flex flex-col justify-center">
                    
                    <!-- Category & Number Header -->
                    <div class="flex items-center gap-3">
                        <span class="font-heading font-extrabold text-xl text-[#E31E24]">01</span>
                        <span class="w-[1px] h-4 bg-gray-300"></span>
                        <span class="text-xs font-heading font-bold text-gray-500 uppercase tracking-widest">CORE SERVICE</span>
                    </div>

                    <!-- Title -->
                    <h3 class="font-heading font-extrabold text-2xl sm:text-3xl lg:text-4xl text-[#1F2328] leading-tight tracking-tight">
                        KARGO LAUT (FORWARDING)
                    </h3>

                    <!-- Description -->
                    <p class="text-[#5B6270] text-base leading-relaxed font-body">
                        Layanan sea freight dengan rute utama Jakarta–Surabaya–Kupang dan berbagai wilayah Indonesia Timur. Melayani pengiriman FCL maupun LCL dengan jadwal keberangkatan rutin 2–3 kali setiap minggu.
                    </p>

                    <!-- Operational Metadata Row (3 Groups) -->
                    <div class="pt-4 border-t border-gray-200/80">
                        <div class="grid grid-cols-3 gap-4 divide-x divide-gray-200 text-left">
                            
                            <!-- Group 1: ROUTE -->
                            <div class="pr-2">
                                <span class="block text-[10px] font-heading font-bold text-[#E31E24] uppercase tracking-widest mb-1">ROUTE</span>
                                <span class="block text-xs font-heading font-bold text-[#1F2328] leading-tight">JAKARTA — SURABAYA — KUPANG</span>
                            </div>

                            <!-- Group 2: FREQUENCY -->
                            <div class="px-4">
                                <span class="block text-[10px] font-heading font-bold text-[#E31E24] uppercase tracking-widest mb-1">FREQUENCY</span>
                                <span class="block text-xs font-heading font-bold text-[#1F2328] leading-tight">2–3× / WEEK</span>
                            </div>

                            <!-- Group 3: CARGO -->
                            <div class="pl-4">
                                <span class="block text-[10px] font-heading font-bold text-[#E31E24] uppercase tracking-widest mb-1">CARGO</span>
                                <span class="block text-xs font-heading font-bold text-[#1F2328] leading-tight">FCL · LCL</span>
                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <!-- Thin horizontal separator between Service 01 and Service 02 -->
            <div class="w-full h-[1px] bg-gray-200/60"></div>

            <!-- SERVICE 02 — SUPPORTING SERVICE (ASYMMETRIC TWO-COLUMN: LEFT INFO, RIGHT IMAGE) -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-14 items-center reveal-on-scroll reveal-up">
                
                <!-- Left Side: Service Information & Metadata -->
                <div class="lg:col-span-6 space-y-5 order-2 lg:order-1 flex flex-col justify-center">
                    
                    <!-- Category & Number Header -->
                    <div class="flex items-center gap-3">
                        <span class="font-heading font-extrabold text-lg text-[#E31E24]">02</span>
                        <span class="w-[1px] h-4 bg-gray-300"></span>
                        <span class="text-xs font-heading font-bold text-gray-500 uppercase tracking-widest">SUPPORTING SERVICE</span>
                    </div>

                    <!-- Title -->
                    <h3 class="font-heading font-bold text-xl sm:text-2xl lg:text-3xl text-[#1F2328] leading-tight tracking-tight">
                        RUTE CONTAINER JAKARTA – KUPANG
                    </h3>

                    <!-- Description -->
                    <p class="text-[#5B6270] text-sm sm:text-base leading-relaxed font-body">
                        Solusi logistik multimodal yang menghubungkan Jakarta, Surabaya, hingga Kupang melalui kombinasi transportasi darat dan laut.
                    </p>

                    <!-- Operational Metadata Row (2 Groups) -->
                    <div class="pt-4 border-t border-gray-200/80">
                        <div class="flex items-center gap-8 divide-x divide-gray-200 text-left">
                            
                            <!-- Group 1: CONTAINER -->
                            <div>
                                <span class="block text-[10px] font-heading font-bold text-[#E31E24] uppercase tracking-widest mb-1">CONTAINER</span>
                                <span class="block text-xs font-heading font-bold text-[#1F2328]">20' · 40'</span>
                            </div>

                            <!-- Group 2: ROUTE -->
                            <div class="pl-8">
                                <span class="block text-[10px] font-heading font-bold text-[#E31E24] uppercase tracking-widest mb-1">ROUTE</span>
                                <span class="block text-xs font-heading font-bold text-[#1F2328]">JAKARTA — SURABAYA — KUPANG</span>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Right Side: Container Truck Image (Slightly smaller visual anchor) -->
                <div class="lg:col-span-6 order-1 lg:order-2">
                    <div class="rounded-2xl overflow-hidden shadow-lg bg-[#1F2328] group">
                        <img src="{{ asset('images/foto%20darat.jpeg') }}" 
                             alt="Rute Container Jakarta Kupang PT Sanwa Antar Nusa" 
                             class="w-full h-[300px] sm:h-[360px] lg:h-[400px] object-cover object-center group-hover:scale-105 transition-transform duration-700" 
                             loading="lazy">
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>


{{-- ============ WHY CHOOSE US SECTION (EDITORIAL INTERACTIVE REDESIGN) ============ --}}
<section id="keunggulan" class="bg-[#F4F5F8] py-20 lg:py-28 overflow-hidden border-y border-gray-200/70" x-data="{ activeIndex: 0 }">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <!-- SECTION HEADER (Full-width left-aligned) -->
        <div class="max-w-3xl reveal-on-scroll reveal-up">
            <div class="flex items-center gap-2.5 mb-3">
                <span class="w-6 h-[2px] bg-[#E31E24]"></span>
                <span class="text-xs font-heading font-bold text-[#E31E24] tracking-widest uppercase">KEUNGGULAN KAMI</span>
            </div>
            
            <h2 class="font-heading font-extrabold text-3xl sm:text-4xl lg:text-[2.5rem] text-[#1F2328] leading-tight tracking-tight">
                Mengapa PT Sanwa Antar Nusa<br class="hidden sm:inline">
                menjadi pilihan bisnis?
            </h2>

            <p class="mt-4 text-[#5B6270] text-base sm:text-lg leading-relaxed font-body">
                Kami berkomitmen memberikan layanan logistik yang terjadwal, aman, dan efisien untuk mendukung kelancaran bisnis Anda.
            </p>
        </div>

        <!-- Subtle thin horizontal divider below header -->
        <div class="w-full h-[1px] bg-gray-200/80 my-10 lg:my-14"></div>

        @php
            $advantages = [
                [
                    'num' => '01',
                    'title' => 'JADWAL KEBERANGKATAN TERATUR & TEPAT WAKTU',
                    'desc' => 'Kami menjaga konsistensi jadwal keberangkatan kapal agar rantai pasok Anda tetap berjalan tanpa hambatan.',
                    'meta' => [
                        ['label' => 'SAILING FREQUENCY', 'val' => '2–3× / WEEK'],
                        ['label' => 'MAIN ROUTE', 'val' => 'SURABAYA → KUPANG'],
                        ['label' => 'ETA', 'val' => 'TERJADWAL & DAPAT DIANDALKAN'],
                    ]
                ],
                [
                    'num' => '02',
                    'title' => 'SPESIALIS RUTE INDONESIA TIMUR',
                    'desc' => 'Berpengalaman melayani rute Jakarta, Surabaya, Kupang, dan berbagai wilayah Indonesia Timur.',
                    'meta' => [
                        ['label' => 'MAIN ROUTE', 'val' => 'JAKARTA → SURABAYA → KUPANG'],
                        ['label' => 'REGION', 'val' => 'EASTERN INDONESIA'],
                        ['label' => 'SERVICE', 'val' => 'DIRECT ROUTE SPECIALIST'],
                    ]
                ],
                [
                    'num' => '03',
                    'title' => 'STANDAR KEAMANAN TINGGI & ASURANSI KARGO',
                    'desc' => 'Prosedur keamanan dan perlindungan asuransi membantu menjaga keamanan setiap pengiriman selama proses distribusi.',
                    'meta' => [
                        ['label' => 'CARGO PROTECTION', 'val' => 'INSURED'],
                        ['label' => 'SECURITY', 'val' => 'CONTROLLED PROCESS'],
                        ['label' => 'SERVICE', 'val' => 'SAFE DELIVERY'],
                    ]
                ],
                [
                    'num' => '04',
                    'title' => 'KANTOR CABANG RESMI DIRECT TANPA PERANTARA',
                    'desc' => 'Layanan direct melalui kantor cabang resmi memberikan komunikasi yang lebih cepat, jelas, dan efisien.',
                    'meta' => [
                        ['label' => 'OPERATION', 'val' => 'DIRECT SERVICE'],
                        ['label' => 'COMMUNICATION', 'val' => 'FASTER RESPONSE'],
                        ['label' => 'NETWORK', 'val' => 'OFFICIAL BRANCH'],
                    ]
                ],
                [
                    'num' => '05',
                    'title' => 'TARIF TRANSPARAN & KOMPETITIF',
                    'desc' => 'Struktur tarif yang jelas dan kompetitif membantu bisnis mengatur kebutuhan pengiriman dengan lebih efisien.',
                    'meta' => [
                        ['label' => 'PRICING', 'val' => 'TRANSPARENT'],
                        ['label' => 'SERVICE', 'val' => 'COMPETITIVE'],
                        ['label' => 'APPROACH', 'val' => 'BUSINESS-FOCUSED'],
                    ]
                ],
            ];
        @endphp

        <!-- MAIN INTERACTIVE AREA (TWO-COLUMN EDITORIAL) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start">
            
            <!-- LEFT COLUMN: FEATURED ADVANTAGE DETAIL (lg:col-span-7) -->
            <div class="lg:col-span-7 relative min-h-[340px] reveal-on-scroll reveal-left">
                @foreach ($advantages as $index => $item)
                    <div x-show="activeIndex === {{ $index }}"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150 absolute inset-0 pointer-events-none"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         x-cloak
                         class="space-y-8">
                        
                        <!-- Selected Number & Header Indicator -->
                        <div class="flex items-center gap-3 border-b border-gray-200/80 pb-4">
                            <span class="font-heading font-extrabold text-3xl sm:text-4xl text-[#E31E24] leading-none">{{ $item['num'] }}</span>
                            <span class="w-[1px] h-6 bg-gray-300"></span>
                            <span class="text-xs font-heading font-bold text-gray-500 uppercase tracking-widest">KEUNGGULAN TERPILIH</span>
                        </div>

                        <!-- Main Title -->
                        <h3 class="font-heading font-extrabold text-2xl sm:text-3xl lg:text-4xl text-[#1F2328] leading-tight tracking-tight">
                            {{ $item['title'] }}
                        </h3>

                        <!-- Description -->
                        <p class="text-[#5B6270] text-base sm:text-lg leading-relaxed font-body">
                            {{ $item['desc'] }}
                        </p>

                        <!-- Operational Metadata Row (3 Groups) -->
                        <div class="pt-6 border-t border-gray-200/80">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-4 divide-y sm:divide-y-0 sm:divide-x divide-gray-200 text-left">
                                @foreach ($item['meta'] as $metaIdx => $meta)
                                    <div class="{{ $metaIdx === 0 ? 'pr-2' : ($metaIdx === 1 ? 'sm:px-4 pt-3 sm:pt-0' : 'sm:pl-4 pt-3 sm:pt-0') }}">
                                        <span class="block text-[10px] font-heading font-bold text-[#E31E24] uppercase tracking-widest mb-1">{{ $meta['label'] }}</span>
                                        <span class="block text-xs font-heading font-bold text-[#1F2328] leading-snug">{{ $meta['val'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- RIGHT COLUMN: INTERACTIVE ADVANTAGE NAVIGATION (INDEX) (lg:col-span-5) -->
            <div class="lg:col-span-5 border-t lg:border-t-0 lg:border-l border-gray-200/80 pt-8 lg:pt-0 lg:pl-10 space-y-0 reveal-on-scroll reveal-right">
                <div class="text-xs font-heading font-bold text-gray-400 uppercase tracking-widest pb-4 mb-2 border-b border-gray-200/60 hidden lg:block pl-5">
                    INDEKS KEUNGGULAN
                </div>

                <div class="divide-y divide-gray-200/80">
                    @foreach ($advantages as $index => $item)
                        <button type="button"
                                @click="activeIndex = {{ $index }}"
                                class="w-full py-4 sm:py-5 text-left transition-all duration-300 group cursor-pointer block border-l-[3px]"
                                :class="activeIndex === {{ $index }} ? 'pl-5 sm:pl-6 border-l-active-red bg-[#E31E24]/[0.04]' : 'pl-5 sm:pl-6 border-l-inactive-gray hover:border-gray-400 hover:bg-gray-100/50'">
                            
                            <div class="flex items-start gap-4">
                                <span class="font-heading font-extrabold text-sm tracking-wider transition-colors pt-0.5 shrink-0"
                                      :class="activeIndex === {{ $index }} ? 'text-[#E31E24]' : 'text-gray-400 group-hover:text-gray-600'">
                                    {{ $item['num'] }}
                                </span>

                                <h4 class="font-heading text-sm sm:text-base leading-snug uppercase tracking-wider transition-colors"
                                    :class="activeIndex === {{ $index }} ? 'font-extrabold text-[#1F2328]' : 'font-semibold text-[#5B6270] group-hover:text-[#1F2328]'">
                                    {{ $item['title'] }}
                                </h4>
                            </div>

                        </button>
                    @endforeach
                </div>
            </div>

        </div>

    </div>
</section>


{{-- ============ HOW IT WORKS SECTION (EDITORIAL INTERACTIVE PROCESS) ============ --}}
<section class="bg-white py-20 lg:py-28 overflow-hidden" x-data="{ activeStep: 0 }">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <!-- SECTION HEADER (Full-width left-aligned with right operational statement) -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 reveal-on-scroll reveal-up">
            <div class="max-w-2xl">
                <div class="flex items-center gap-2.5 mb-3">
                    <span class="w-6 h-[2px] bg-[#E31E24]"></span>
                    <span class="text-xs font-heading font-bold text-[#E31E24] tracking-widest uppercase">ALUR PENGIRIMAN</span>
                </div>
                
                <h2 class="font-heading font-extrabold text-3xl sm:text-4xl lg:text-[2.5rem] text-[#1F2328] leading-tight tracking-tight">
                    Dari Booking hingga Tujuan
                </h2>

                <p class="mt-4 text-[#5B6270] text-base sm:text-lg leading-relaxed font-body">
                    Setiap pengiriman bergerak melalui proses yang terarah, mulai dari konsultasi hingga distribusi ke tujuan.
                </p>
            </div>

            <!-- Right Operational Statement -->
            <div class="text-left md:text-right border-l-2 md:border-l-0 border-[#E31E24] pl-4 md:pl-0 pt-2 md:pt-0 shrink-0">
                <span class="block text-[11px] font-heading font-bold text-gray-400 uppercase tracking-widest mb-1">PROSES OPERASIONAL</span>
                <span class="font-heading font-extrabold text-xs text-[#1F2328] tracking-wider uppercase">DARAT &rarr; PELABUHAN &rarr; LAUT &rarr; TUJUAN</span>
            </div>
        </div>

        <!-- Subtle thin horizontal divider below header -->
        <div class="w-full h-[1px] bg-gray-200/80 my-10 lg:my-14"></div>

        @php
            $steps = [
                [
                    'num' => '01',
                    'title' => 'BOOKING & KONSULTASI',
                    'desc' => 'Ajukan detail pengiriman dan tentukan rute yang sesuai untuk kebutuhan kargo Anda.',
                    'meta' => [
                        ['label' => 'SHIPMENT DETAILS', 'val' => 'Informasi kebutuhan pengiriman'],
                        ['label' => 'ROUTE PLANNING', 'val' => 'Perencanaan rute terbaik'],
                        ['label' => 'STARTING POINT', 'val' => 'DETAIL PENGIRIMAN'],
                    ],
                    'route_vis' => null
                ],
                [
                    'num' => '02',
                    'title' => 'PICKUP & LOADING',
                    'desc' => 'Barang dikumpulkan dan dimuat ke dalam container dengan standar penanganan yang terkontrol.',
                    'meta' => [
                        ['label' => 'CONTAINER', 'val' => "20' · 40'"],
                        ['label' => 'HANDLING', 'val' => 'Standar penanganan yang aman'],
                        ['label' => 'PROCESS', 'val' => 'PICKUP → LOADING → SECURED'],
                    ],
                    'route_vis' => null
                ],
                [
                    'num' => '03',
                    'title' => 'MULTIMODAL TRANSIT',
                    'desc' => 'Barang bergerak melalui kombinasi transportasi darat dan laut menuju wilayah tujuan.',
                    'meta' => [
                        ['label' => 'TRANSPORT MODE', 'val' => 'MULTIMODAL'],
                        ['label' => 'MAIN ROUTE', 'val' => 'SURABAYA → KUPANG'],
                        ['label' => 'FREQUENCY', 'val' => '2–3× / WEEK'],
                    ],
                    'route_vis' => 'TRUCK ───── PELABUHAN ───── SHIP'
                ],
                [
                    'num' => '04',
                    'title' => 'SAMPAI DI TUJUAN',
                    'desc' => 'Barang didistribusikan dengan aman ke Kupang dan wilayah sekitarnya.',
                    'meta' => [
                        ['label' => 'DESTINATION', 'val' => 'KUPANG & SURROUNDING AREAS'],
                        ['label' => 'FINAL DELIVERY', 'val' => 'Distribusi aman dan terarah'],
                        ['label' => 'STATUS', 'val' => 'DELIVERED TO DESTINATION'],
                    ],
                    'route_vis' => null
                ]
            ];
        @endphp

        <!-- MAIN INTERACTIVE PROCESS AREA (TWO-COLUMN EDITORIAL) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start">
            
            <!-- LEFT SIDE: INTERACTIVE STEP NAVIGATION (lg:col-span-5) -->
            <div class="lg:col-span-5 space-y-0 reveal-on-scroll reveal-left">
                <div class="text-xs font-heading font-bold text-gray-400 uppercase tracking-widest pb-4 mb-2 border-b border-gray-200/60 hidden lg:block pl-5">
                    TAHAPAN PROSES
                </div>

                <div class="divide-y divide-gray-200/80">
                    @foreach ($steps as $index => $item)
                        <button type="button"
                                @click="activeStep = {{ $index }}"
                                class="w-full py-4 sm:py-5 text-left transition-all duration-300 group cursor-pointer block border-l-[3px]"
                                :class="activeStep === {{ $index }} ? 'pl-5 sm:pl-6 border-l-active-red bg-[#E31E24]/[0.04]' : 'pl-5 sm:pl-6 border-l-inactive-gray hover:border-gray-400 hover:bg-gray-100/50'">
                            
                            <div class="flex items-start gap-4">
                                <span class="font-heading font-extrabold text-sm tracking-wider transition-colors pt-0.5 shrink-0"
                                      :class="activeStep === {{ $index }} ? 'text-[#E31E24]' : 'text-gray-400 group-hover:text-gray-600'">
                                    {{ $item['num'] }}
                                </span>

                                <h4 class="font-heading text-sm sm:text-base leading-snug uppercase tracking-wider transition-colors"
                                    :class="activeStep === {{ $index }} ? 'font-extrabold text-[#1F2328]' : 'font-semibold text-[#5B6270] group-hover:text-[#1F2328]'">
                                    {{ $item['title'] }}
                                </h4>
                            </div>

                        </button>
                    @endforeach
                </div>
            </div>

            <!-- RIGHT SIDE: DYNAMIC DETAIL CONTENT (lg:col-span-7) -->
            <div class="lg:col-span-7 relative min-h-[340px] border-t lg:border-t-0 lg:border-l border-gray-200/80 pt-8 lg:pt-0 lg:pl-10 reveal-on-scroll reveal-right">
                @foreach ($steps as $index => $item)
                    <div x-show="activeStep === {{ $index }}"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150 absolute inset-0 pointer-events-none lg:pl-10"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         x-cloak
                         class="space-y-8">
                        
                        <!-- Selected Step Header Indicator -->
                        <div class="flex items-center gap-3 border-b border-gray-200/80 pb-4">
                            <span class="font-heading font-extrabold text-3xl sm:text-4xl text-[#E31E24] leading-none">{{ $item['num'] }}</span>
                            <span class="w-[1px] h-6 bg-gray-300"></span>
                            <span class="text-xs font-heading font-bold text-gray-500 uppercase tracking-widest">LANGKAH OPERASIONAL {{ $item['num'] }}</span>
                        </div>

                        <!-- Title -->
                        <h3 class="font-heading font-extrabold text-2xl sm:text-3xl lg:text-4xl text-[#1F2328] leading-tight tracking-tight">
                            {{ $item['title'] }}
                        </h3>

                        <!-- Description -->
                        <p class="text-[#5B6270] text-base sm:text-lg leading-relaxed font-body">
                            {{ $item['desc'] }}
                        </p>

                        <!-- Optional Multimodal Route Visualizer Structure (Step 03 special operational element) -->
                        @if ($item['route_vis'])
                            <div class="bg-[#F8FAFC] border border-gray-200/80 rounded-xl p-4 sm:p-5">
                                <span class="block text-[10px] font-heading font-bold text-[#E31E24] uppercase tracking-widest mb-2">ALUR TRANSIT MULTIMODAL</span>
                                <div class="font-heading font-extrabold text-xs sm:text-sm text-[#1F2328] tracking-wider uppercase flex items-center justify-between gap-2">
                                    <span>TRUCK</span>
                                    <span class="flex-1 border-b border-dashed border-[#E31E24]"></span>
                                    <span>PELABUHAN</span>
                                    <span class="flex-1 border-b border-dashed border-[#E31E24]"></span>
                                    <span>SHIP</span>
                                </div>
                            </div>
                        @endif

                        <!-- Operational Metadata Row (3 Groups) -->
                        <div class="pt-6 border-t border-gray-200/80">
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-4 divide-y sm:divide-y-0 sm:divide-x divide-gray-200 text-left">
                                @foreach ($item['meta'] as $metaIdx => $meta)
                                    <div class="{{ $metaIdx === 0 ? 'pr-2' : ($metaIdx === 1 ? 'sm:px-4 pt-3 sm:pt-0' : 'sm:pl-4 pt-3 sm:pt-0') }}">
                                        <span class="block text-[10px] font-heading font-bold text-[#E31E24] uppercase tracking-widest mb-1">{{ $meta['label'] }}</span>
                                        <span class="block text-xs font-heading font-bold text-[#1F2328] leading-snug">{{ $meta['val'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>

    </div>
</section>


{{-- ============ VESSEL SCHEDULE SECTION (REFINED OFFICIAL SCHEDULING) ============ --}}
<section id="jadwal" class="bg-[#F7F8FA] py-20 lg:py-28 overflow-hidden border-b border-gray-200/70">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <!-- SECTION HEADER (Two-Column Editorial Layout) -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-12 items-end reveal-on-scroll reveal-up">
            
            <!-- Left Side: Section Label & Headline -->
            <div class="lg:col-span-7">
                <div class="flex items-center gap-2.5 mb-3">
                    <span class="w-6 h-[2px] bg-[#E31E24]"></span>
                    <span class="text-xs font-heading font-bold text-[#E31E24] tracking-widest uppercase">JADWAL KEBERANGKATAN</span>
                </div>
                
                <h2 class="font-heading font-extrabold text-3xl sm:text-4xl lg:text-[2.5rem] text-[#1F2328] leading-tight tracking-tight">
                    Jadwal Kapal Surabaya ke Kupang
                </h2>
            </div>

            <!-- Right Side: Mature Operational Status Indicator & Description -->
            <div class="lg:col-span-5 space-y-2">
                <div class="flex items-center gap-2 text-xs font-heading font-extrabold text-[#1F2328] uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse shrink-0"></span>
                    KEBERANGKATAN RUTIN 2–3× SEMINGGU
                </div>
                
                <p class="text-[#5B6270] text-sm leading-relaxed font-body">
                    Pantau jadwal closing kargo dan rencana keberangkatan kapal kargo dari Surabaya menuju Kupang.
                </p>
            </div>

        </div>

        @php
            $firstEtd = $schedules->min('etd_sub');
            $lastEtd = $schedules->max('etd_sub');
            
            if ($firstEtd && $lastEtd) {
                $startCarbon = \Carbon\Carbon::parse($firstEtd);
                $endCarbon = \Carbon\Carbon::parse($lastEtd);
                
                if ($startCarbon->format('M Y') === $endCarbon->format('M Y')) {
                    $schedulePeriodLabel = 'JADWAL TERBARU ' . mb_strtoupper($startCarbon->translatedFormat('F Y'));
                } else {
                    $schedulePeriodLabel = 'JADWAL TERBARU ' . mb_strtoupper($startCarbon->translatedFormat('F')) . ' — ' . mb_strtoupper($endCarbon->translatedFormat('F Y'));
                }
            } else {
                $schedulePeriodLabel = 'JADWAL TERBARU ' . mb_strtoupper(now()->translatedFormat('F Y'));
            }

            $latestUpdated = $schedules->max('updated_at') ?? $schedules->max('created_at');
            $updatedLabel = $latestUpdated 
                ? 'UPDATED ' . mb_strtoupper(\Carbon\Carbon::parse($latestUpdated)->format('d M Y')) 
                : 'UPDATED ' . mb_strtoupper(now()->format('d M Y'));
        @endphp

        <!-- SUBTLE ROUTE CONTEXT BAR -->
        <div class="flex flex-wrap items-center justify-between gap-4 py-4 border-y border-gray-200/80 my-8 lg:my-10 reveal-on-scroll reveal-up">
            <div class="flex items-center gap-2">
                <span class="font-heading font-extrabold text-xs text-[#1F2328] tracking-widest uppercase">SURABAYA</span>
                <span class="text-[#E31E24] font-bold text-xs">→</span>
                <span class="font-heading font-extrabold text-xs text-[#1F2328] tracking-widest uppercase">KUPANG</span>
            </div>

            <div class="text-xs font-heading font-bold text-[#E31E24] tracking-widest uppercase">
                {{ $schedulePeriodLabel }}
            </div>
        </div>

        <!-- UNIFIED SCHEDULE TABLE CONTAINER (Natural Flow, No Native Inner Vertical Scrollbar) -->
        <div class="bg-white rounded-xl border border-gray-200/80 shadow-sm overflow-hidden reveal-on-scroll reveal-up">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[640px]">
                    <thead>
                        <tr class="bg-[#1F2328] text-white font-heading font-bold text-xs uppercase tracking-wider">
                            <th class="px-6 py-4">KAPAL</th>
                            <th class="px-6 py-4">VOYAGE</th>
                            <th class="px-6 py-4 text-center">STATUS</th>
                            <th class="px-6 py-4 text-right">ETD SURABAYA</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200/80 text-sm text-[#1F2328]">
                        @forelse ($schedules as $index => $schedule)
                            <tr class="hover:bg-gray-50/80 transition-colors">
                                
                                <!-- KAPAL (No icon repetition, Vessel name as primary text identifier) -->
                                <td class="px-6 py-4 font-heading font-bold text-[#1F2328]">
                                    {{ $schedule->kapal }}
                                </td>

                                <!-- VOYAGE -->
                                <td class="px-6 py-4">
                                    <span class="font-heading font-semibold text-xs text-gray-600 bg-gray-100 px-2.5 py-1 rounded-md">
                                        {{ $schedule->voy }}
                                    </span>
                                </td>

                                <!-- STATUS (Compact, visually restrained) -->
                                <td class="px-6 py-4 text-center">
                                    @if ($schedule->is_full)
                                        <span class="inline-block rounded bg-[#FDEAEA] text-[#E31E24] text-[11px] font-heading font-bold uppercase tracking-wider px-2.5 py-1">FULL</span>
                                    @elseif ($schedule->closing->isPast())
                                        <span class="inline-block rounded bg-gray-100 text-gray-600 text-[11px] font-heading font-bold uppercase tracking-wider px-2.5 py-1">CLOSED</span>
                                    @else
                                        <span class="font-heading font-semibold text-xs text-[#1F2328]">{{ $schedule->closing->format('d M Y') }}</span>
                                    @endif
                                </td>

                                <!-- ETD SURABAYA (Strongest information in row) -->
                                <td class="px-6 py-4 text-right font-heading font-extrabold text-sm sm:text-base text-[#1F2328] tracking-wide">
                                    {{ $schedule->etd_sub->format('d M Y') }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-[#5B6270]">
                                    Belum ada jadwal kapal yang tersedia saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- SUBTLE FOOTNOTE -->
        <div class="mt-4 flex flex-wrap items-center justify-between gap-4 text-xs text-[#5B6270]">
            <p>Jadwal dapat berubah mengikuti kondisi operasional dan kebijakan pelayaran.</p>
            <span class="font-heading font-semibold text-gray-400 uppercase tracking-wider">{{ $updatedLabel }}</span>
        </div>

    </div>
</section>


{{-- ============ TESTIMONIAL SECTION (ANONYMOUS EDITORIAL CUSTOMER FEEDBACK) ============ --}}
<section class="bg-[#1F2328] py-20 lg:py-28 relative overflow-hidden" x-data="{ activeSlide: 0, totalSlides: 3 }">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
            
            <!-- LEFT COLUMN: CONTEXT & TITLE (lg:col-span-5) -->
            <div class="lg:col-span-5 space-y-6 reveal-on-scroll reveal-left">
                
                <div>
                    <div class="flex items-center gap-2.5 mb-3">
                        <span class="w-6 h-[2px] bg-[#E31E24]"></span>
                        <span class="text-xs font-heading font-bold text-[#E31E24] tracking-widest uppercase">TESTIMONI PELANGGAN</span>
                    </div>

                    <h2 class="font-heading font-extrabold text-2xl sm:text-3xl lg:text-4xl text-white leading-tight tracking-tight">
                        Dipercaya untuk mendukung<br class="hidden sm:inline">
                        pengiriman bisnis antarpulau.
                    </h2>
                </div>

                <div class="pt-2 border-t border-white/10">
                    <span class="text-xs font-heading font-bold text-gray-400 uppercase tracking-widest block mb-4">CUSTOMER EXPERIENCE</span>
                    
                    <!-- Carousel Counter: 01 / 03 -->
                    <div class="font-heading font-extrabold text-sm text-[#E31E24] tracking-widest">
                        <span x-text="'0' + (activeSlide + 1)">01</span>
                        <span class="text-gray-500 font-normal"> / 03</span>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: DYNAMIC ANONYMOUS TESTIMONIAL QUOTE (lg:col-span-7) -->
            <div class="lg:col-span-7 relative reveal-on-scroll reveal-right">
                
                <!-- Low-contrast Quote Mark Anchor -->
                <span class="absolute -top-12 -left-6 font-serif text-8xl sm:text-9xl text-white/5 select-none pointer-events-none leading-none">“</span>

                <!-- Slides Container -->
                <div class="relative min-h-[380px] sm:min-h-[340px] flex flex-col justify-between pt-4">
                    
                    <!-- Slide 01 -->
                    <div x-show="activeSlide === 0"
                         x-transition:enter="transition ease-out duration-400"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200 absolute inset-x-0 top-4"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         class="space-y-6">
                        
                        <blockquote class="font-heading font-semibold text-lg sm:text-xl lg:text-2xl text-white leading-relaxed tracking-tight">
                            “Pengiriman kami dari Surabaya ke Kupang menjadi lebih mudah diprediksi sejak menggunakan layanan Sanwa Antar Nusa.”
                        </blockquote>

                        <div class="pt-4 border-t border-white/10">
                            <span class="block text-xs font-heading font-bold text-[#E31E24] uppercase tracking-widest">CUSTOMER FEEDBACK</span>
                            <span class="block text-xs font-heading font-extrabold text-white uppercase tracking-wider mt-0.5">SURABAYA → KUPANG</span>
                        </div>

                        <!-- CUSTOMER EXPERIENCE HIGHLIGHTS -->
                        <div class="pt-6 border-t border-white/10 space-y-4">
                            <span class="block text-[11px] font-heading font-bold text-gray-400 uppercase tracking-widest">CUSTOMER EXPERIENCE</span>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-left">
                                <div>
                                    <span class="block font-heading font-extrabold text-xs text-[#E31E24] tracking-wider mb-1">01</span>
                                    <h4 class="font-heading font-bold text-xs text-white uppercase tracking-wider mb-1">JADWAL TERPREDIKSI</h4>
                                    <p class="text-xs text-gray-400 leading-relaxed font-body">Keberangkatan rutin untuk membantu perencanaan pengiriman.</p>
                                </div>
                                <div>
                                    <span class="block font-heading font-extrabold text-xs text-[#E31E24] tracking-wider mb-1">02</span>
                                    <h4 class="font-heading font-bold text-xs text-white uppercase tracking-wider mb-1">RUTE SURABAYA → KUPANG</h4>
                                    <p class="text-xs text-gray-400 leading-relaxed font-body">Rute pengiriman yang jelas dan mudah dipahami.</p>
                                </div>
                                <div>
                                    <span class="block font-heading font-extrabold text-xs text-[#E31E24] tracking-wider mb-1">03</span>
                                    <h4 class="font-heading font-bold text-xs text-white uppercase tracking-wider mb-1">PERENCANAAN LEBIH MUDAH</h4>
                                    <p class="text-xs text-gray-400 leading-relaxed font-body">Informasi jadwal membantu bisnis mempersiapkan kebutuhan logistik.</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Slide 02 -->
                    <div x-show="activeSlide === 1"
                         x-transition:enter="transition ease-out duration-400"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200 absolute inset-x-0 top-4"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         x-cloak
                         class="space-y-6">
                        
                        <blockquote class="font-heading font-semibold text-lg sm:text-xl lg:text-2xl text-white leading-relaxed tracking-tight">
                            “Kepastian jadwal keberangkatan kapal kargo dan komunikasi direct kantor cabang sangat membantu efisiensi rantai pasok bisnis kami.”
                        </blockquote>

                        <div class="pt-4 border-t border-white/10">
                            <span class="block text-xs font-heading font-bold text-[#E31E24] uppercase tracking-widest">CUSTOMER FEEDBACK</span>
                            <span class="block text-xs font-heading font-extrabold text-white uppercase tracking-wider mt-0.5">JAKARTA → SURABAYA → KUPANG</span>
                        </div>

                        <!-- CUSTOMER EXPERIENCE HIGHLIGHTS -->
                        <div class="pt-6 border-t border-white/10 space-y-4">
                            <span class="block text-[11px] font-heading font-bold text-gray-400 uppercase tracking-widest">CUSTOMER EXPERIENCE</span>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-left">
                                <div>
                                    <span class="block font-heading font-extrabold text-xs text-[#E31E24] tracking-wider mb-1">01</span>
                                    <h4 class="font-heading font-bold text-xs text-white uppercase tracking-wider mb-1">KEPASTIAN JADWAL</h4>
                                    <p class="text-xs text-gray-400 leading-relaxed font-body">Jadwal kapal kargo yang teratur dan konsisten.</p>
                                </div>
                                <div>
                                    <span class="block font-heading font-extrabold text-xs text-[#E31E24] tracking-wider mb-1">02</span>
                                    <h4 class="font-heading font-bold text-xs text-white uppercase tracking-wider mb-1">KOMUNIKASI DIRECT</h4>
                                    <p class="text-xs text-gray-400 leading-relaxed font-body">Koordinasi langsung melalui kantor cabang resmi.</p>
                                </div>
                                <div>
                                    <span class="block font-heading font-extrabold text-xs text-[#E31E24] tracking-wider mb-1">03</span>
                                    <h4 class="font-heading font-bold text-xs text-white uppercase tracking-wider mb-1">EFISIENSI RANTAI PASOK</h4>
                                    <p class="text-xs text-gray-400 leading-relaxed font-body">Mendukung efisiensi operasional distribusi bisnis.</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Slide 03 -->
                    <div x-show="activeSlide === 2"
                         x-transition:enter="transition ease-out duration-400"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200 absolute inset-x-0 top-4"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"
                         x-cloak
                         class="space-y-6">
                        
                        <blockquote class="font-heading font-semibold text-lg sm:text-xl lg:text-2xl text-white leading-relaxed tracking-tight">
                            “Penanganan kontainer yang terkoordinasi dengan baik menjaga kondisi kargo bisnis tetap aman hingga titik pembongkaran.”
                        </blockquote>

                        <div class="pt-4 border-t border-white/10">
                            <span class="block text-xs font-heading font-bold text-[#E31E24] uppercase tracking-widest">CUSTOMER FEEDBACK</span>
                            <span class="block text-xs font-heading font-extrabold text-white uppercase tracking-wider mt-0.5">NUSA TENGGARA TIMUR</span>
                        </div>

                        <!-- CUSTOMER EXPERIENCE HIGHLIGHTS -->
                        <div class="pt-6 border-t border-white/10 space-y-4">
                            <span class="block text-[11px] font-heading font-bold text-gray-400 uppercase tracking-widest">CUSTOMER EXPERIENCE</span>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-left">
                                <div>
                                    <span class="block font-heading font-extrabold text-xs text-[#E31E24] tracking-wider mb-1">01</span>
                                    <h4 class="font-heading font-bold text-xs text-white uppercase tracking-wider mb-1">PENANGANAN KONTAINER</h4>
                                    <p class="text-xs text-gray-400 leading-relaxed font-body">Koordinasi pemuatan dan bongkar muat secara profesional.</p>
                                </div>
                                <div>
                                    <span class="block font-heading font-extrabold text-xs text-[#E31E24] tracking-wider mb-1">02</span>
                                    <h4 class="font-heading font-bold text-xs text-white uppercase tracking-wider mb-1">KONDISI KARGO TERJAGA</h4>
                                    <p class="text-xs text-gray-400 leading-relaxed font-body">Standar keamanan tinggi selama proses pengiriman.</p>
                                </div>
                                <div>
                                    <span class="block font-heading font-extrabold text-xs text-[#E31E24] tracking-wider mb-1">03</span>
                                    <h4 class="font-heading font-bold text-xs text-white uppercase tracking-wider mb-1">DISTRIBUSI AMAN</h4>
                                    <p class="text-xs text-gray-400 leading-relaxed font-body">Pengawalan muatan hingga lokasi tujuan akhir.</p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Carousel Controls (Arrow Buttons) -->
                <div class="flex items-center gap-3 mt-8 pt-4">
                    <button type="button" 
                            @click="activeSlide = (activeSlide - 1 + totalSlides) % totalSlides" 
                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/20 text-white hover:bg-white/10 hover:border-white/40 transition-all cursor-pointer"
                            aria-label="Testimoni sebelumnya">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    </button>
                    
                    <button type="button" 
                            @click="activeSlide = (activeSlide + 1) % totalSlides" 
                            class="flex h-10 w-10 items-center justify-center rounded-xl border border-white/20 text-white hover:bg-white/10 hover:border-white/40 transition-all cursor-pointer"
                            aria-label="Testimoni berikutnya">
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </button>
                </div>

            </div>

        </div>

    </div>
</section>


{{-- ============ CONTACT & OPERATIONAL NETWORK SECTION ============ --}}
<section id="kontak" class="bg-white py-20 lg:py-28 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <!-- SECTION HEADER (Two-Column Editorial Header) -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-6 reveal-on-scroll reveal-up">
            <div class="max-w-2xl text-left">
                <div class="flex items-center gap-2.5 mb-3">
                    <span class="w-6 h-[2px] bg-[#E31E24]"></span>
                    <span class="text-xs font-heading font-bold text-[#E31E24] tracking-widest uppercase">HUBUNGI KAMI</span>
                </div>
                
                <h2 class="font-heading font-extrabold text-3xl sm:text-4xl lg:text-[2.5rem] text-[#1F2328] leading-tight tracking-tight">
                    Mari Rencanakan Pengiriman Anda
                </h2>
            </div>

            <p class="max-w-md text-left text-[#5B6270] text-sm sm:text-base leading-relaxed font-body">
                Butuh bantuan menentukan rute atau jadwal pengiriman?<br class="hidden sm:inline">
                Tim kami siap membantu Anda menemukan solusi logistik yang sesuai.
            </p>
        </div>

        <!-- Subtle thin horizontal divider below header -->
        <div class="w-full h-[1px] bg-gray-200/80 my-10 lg:my-12"></div>

        <!-- MAIN TWO-COLUMN CONTENT -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-start text-left">
            
            <!-- LEFT COLUMN: OPERATIONAL ROUTE MAP (~55% width -> lg:col-span-7) -->
            <div class="lg:col-span-7 space-y-4 reveal-on-scroll reveal-left">
                
                <!-- Map Context Header -->
                <div class="flex flex-wrap items-center justify-between gap-4 pb-2">
                    <div>
                        <span class="block text-[10px] font-heading font-bold text-[#E31E24] uppercase tracking-widest mb-0.5">RUTE OPERASIONAL UTAMA</span>
                        <h3 class="font-heading font-extrabold text-lg sm:text-xl text-[#1F2328]">Jakarta · Surabaya · Kupang</h3>
                    </div>

                    <div class="flex items-center gap-2 text-xs font-heading font-extrabold text-[#1F2328] uppercase tracking-wider bg-gray-50 px-3 py-1.5 rounded-md border border-gray-200/60">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse shrink-0"></span>
                        SURABAYA &rarr; KUPANG
                    </div>
                </div>

                <p class="text-xs sm:text-sm text-[#5B6270] leading-relaxed font-body">
                    Rute utama pengiriman laut menuju Indonesia Timur.
                </p>

                <!-- Map Asset Container (Preserves existing map asset exactly) -->
                <div class="relative bg-[#F8FAFC] rounded-2xl border border-gray-200/80 overflow-hidden shadow-sm p-4 sm:p-6 flex items-center justify-center group min-h-[340px] sm:min-h-[380px] lg:min-h-[440px]">
                    <img src="{{ asset('images/foto peta.png') }}" 
                         alt="Peta Rute Operasional PT Sanwa Antar Nusa - Jakarta, Surabaya, Kupang" 
                         class="w-full h-full object-contain transition-transform duration-700 group-hover:scale-[1.02]" 
                         loading="lazy">

                    <!-- Subtle Route Legend Overlay -->
                    <div class="absolute bottom-4 left-4 right-4 bg-white/95 backdrop-blur-sm px-4 py-3 rounded-xl border border-gray-200/80 flex items-center justify-between text-xs shadow-sm">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#E31E24]"></span>
                            <span class="font-heading font-bold text-[#1F2328]">Konektivitas Laut Utama</span>
                        </div>
                        <span class="text-gray-500 font-heading font-medium text-[11px] uppercase tracking-wider">INDONESIA TIMUR</span>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: PRIMARY OFFICE & BRANCH DIRECTORY (~45% width -> lg:col-span-5) -->
            <div class="lg:col-span-5 space-y-8 reveal-on-scroll reveal-right">
                
                <!-- PRIMARY OFFICE (KANTOR PUSAT - HIGHEST HIERARCHY) -->
                <div class="space-y-4 pb-6 border-b border-gray-200/80">
                    <span class="block text-[11px] font-heading font-bold text-[#E31E24] uppercase tracking-widest">KANTOR PUSAT</span>
                    
                    <h3 class="font-heading font-extrabold text-2xl sm:text-3xl text-[#1F2328] tracking-tight">
                        SURABAYA
                    </h3>

                    <p class="text-sm text-[#5B6270] leading-relaxed font-body">
                        Jl. Kalimas Baru No. 26, Surabaya, Jawa Timur
                    </p>

                    <div class="space-y-1.5 pt-1 text-sm text-[#5B6270] font-body">
                        <div class="inline-flex items-center gap-1.5 font-heading font-bold text-[#1F2328]">
                            <span>+62 811-3144-405</span>
                            <i data-lucide="phone-call" class="w-3.5 h-3.5 text-[#E31E24]"></i>
                        </div>
                        <div>
                            pt.sanwaantarnusa26@gmail.com
                        </div>
                    </div>
                </div>

                <!-- BRANCH DIRECTORY (KANTOR CABANG - COMPACT EDITORIAL DIRECTORY) -->
                <div class="space-y-5">
                    <span class="block text-[11px] font-heading font-bold text-gray-400 uppercase tracking-widest">KANTOR CABANG</span>

                    <!-- Branch 1: JAKARTA -->
                    <div class="space-y-1.5 pb-4 border-b border-gray-200/60">
                        <h4 class="font-heading font-bold text-base uppercase tracking-wider text-[#1F2328]">
                            JAKARTA
                        </h4>
                        <p class="text-xs sm:text-sm text-[#5B6270] font-body leading-relaxed">
                            Jl. Tembang No. 46, Tanjung Priok, Jakarta Utara
                        </p>
                        <div class="space-y-1 pt-1 text-xs">
                            <a href="tel:+6281318718883" class="inline-flex items-center gap-1.5 font-heading font-bold text-[#1F2328] hover:text-[#E31E24] transition-colors">
                                <span>+62 813-1871-8883</span>
                                <i data-lucide="phone-call" class="w-3 h-3 text-[#E31E24]"></i>
                            </a>
                            <p class="text-[#5B6270]">ptsanwa@gmail.com</p>
                        </div>
                    </div>

                    <!-- Branch 2: KUPANG -->
                    <div class="space-y-1.5 pt-1">
                        <h4 class="font-heading font-bold text-base uppercase tracking-wider text-[#1F2328]">
                            KUPANG
                        </h4>
                        <p class="text-xs sm:text-sm text-[#5B6270] font-body leading-relaxed">
                            Jl. Oeleta Raya, Alak, Kupang, Nusa Tenggara Timur
                        </p>
                        <div class="space-y-1 pt-1 text-xs">
                            <a href="tel:+628113144405" class="inline-flex items-center gap-1.5 font-heading font-bold text-[#1F2328] hover:text-[#E31E24] transition-colors">
                                <span>+62 811-3144-405</span>
                                <i data-lucide="phone-call" class="w-3 h-3 text-[#E31E24]"></i>
                            </a>
                            <p class="text-[#5B6270]">pt.sanwaantarnusa26@gmail.com</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>


{{-- ============ FAQ SECTION (EDITORIAL ACCORDION REDESIGN) ============ --}}
<section id="faq" class="bg-[#F7F8FA] py-20 lg:py-28 overflow-hidden border-t border-gray-200/70">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-start">
            
            <!-- LEFT COLUMN: HEADER & CTA (lg:col-span-5) -->
            <div class="lg:col-span-5 space-y-6 reveal-on-scroll reveal-left">
                
                <div>
                    <div class="flex items-center gap-2.5 mb-3">
                        <span class="w-6 h-[2px] bg-[#E31E24]"></span>
                        <span class="text-xs font-heading font-bold text-[#E31E24] tracking-widest uppercase">FAQ</span>
                    </div>

                    <h2 class="font-heading font-extrabold text-3xl sm:text-4xl lg:text-[2.5rem] text-[#1F2328] leading-tight tracking-tight">
                        Yang Perlu Anda Ketahui<br class="hidden sm:inline">
                        Sebelum Mengirim
                    </h2>

                    <p class="mt-4 text-[#5B6270] text-sm sm:text-base leading-relaxed font-body">
                        Temukan jawaban atas pertanyaan umum mengenai rute pengiriman, layanan multimodal, dan jadwal kapal PT Sanwa Antar Nusa.
                    </p>
                </div>

                <!-- Subtle Horizontal Divider -->
                <div class="w-full h-[1px] bg-gray-200/80 my-6"></div>

                <!-- Professional Contact CTA -->
                <div class="space-y-2">
                    <span class="block text-[11px] font-heading font-bold text-gray-400 uppercase tracking-widest">BUTUH INFORMASI LEBIH SPESIFIK?</span>
                    
                    <a href="https://wa.me/628113144405" target="_blank" rel="noopener" class="inline-flex items-center gap-2 font-heading font-bold text-sm text-[#E31E24] hover:text-[#B5171C] transition-colors group">
                        <span>Konsultasikan Pengiriman Anda</span>
                        <i data-lucide="arrow-right" class="w-4 h-4 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>

            </div>

            <!-- RIGHT COLUMN: EXACTLY 3 FAQ ACCORDION ITEMS (lg:col-span-7) -->
            <div class="lg:col-span-7 reveal-on-scroll reveal-right">
                
                @php
                    $faqs = [
                        [
                            'num' => '01',
                            'q' => 'Apa saja rute spesialisasi PT Sanwa Antar Nusa?',
                            'a' => 'Kami berfokus pada layanan pengiriman dan konektivitas logistik menuju wilayah Indonesia Timur, dengan rute utama yang menghubungkan Surabaya dan Kupang serta wilayah sekitarnya.'
                        ],
                        [
                            'num' => '02',
                            'q' => 'Bagaimana rute pengiriman multimodal Jakarta – Surabaya – Kupang?',
                            'a' => 'Pengiriman dapat terhubung melalui jalur darat dari Jakarta menuju Surabaya, kemudian dilanjutkan melalui transportasi laut menuju Kupang dan wilayah tujuan lainnya di Indonesia Timur.'
                        ],
                        [
                            'num' => '03',
                            'q' => 'Berapa kali jadwal keberangkatan kapal kargo ke Kupang?',
                            'a' => 'Jadwal keberangkatan kapal kargo dari Surabaya menuju Kupang tersedia secara rutin sekitar 2–3 kali setiap minggu. Jadwal dapat berubah mengikuti kondisi operasional dan jadwal pelayaran.'
                        ]
                    ];
                @endphp

                <div class="border-t border-gray-200/80 divide-y divide-gray-200/80">
                    @foreach ($faqs as $index => $faq)
                        <div x-data="{ open: false }" class="py-6 transition-all duration-300">
                            
                            <!-- Question Button -->
                            <button type="button" 
                                    @click="open = !open"
                                    class="w-full flex items-start justify-between gap-4 text-left group cursor-pointer focus:outline-none">
                                
                                <div class="flex items-start gap-4">
                                    <span class="font-heading font-extrabold text-sm tracking-wider transition-colors pt-0.5 shrink-0"
                                          :class="open ? 'text-[#E31E24]' : 'text-gray-400 group-hover:text-gray-600'">
                                        {{ $faq['num'] }}
                                    </span>

                                    <h3 class="font-heading font-bold text-base sm:text-lg leading-snug transition-colors"
                                        :class="open ? 'text-[#E31E24]' : 'text-[#1F2328] group-hover:text-[#E31E24]'">
                                        {{ $faq['q'] }}
                                    </h3>
                                </div>

                                <!-- Chevron Up/Down Icon Control -->
                                <i data-lucide="chevron-down" 
                                   class="w-5 h-5 text-gray-400 group-hover:text-[#1F2328] shrink-0 transition-all duration-300 pt-0.5"
                                   :class="open ? 'rotate-180 !text-[#E31E24]' : ''"></i>

                            </button>

                            <!-- Answer Panel -->
                            <div x-show="open"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 -translate-y-1"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100"
                                 x-transition:leave-end="opacity-0"
                                 x-cloak
                                 class="pl-9 pr-6 pt-4">
                                <p class="text-sm sm:text-base text-[#5B6270] leading-relaxed font-body">
                                    {{ $faq['a'] }}
                                </p>
                            </div>

                        </div>
                    @endforeach
                </div>

            </div>

        </div>

    </div>
</section>


{{-- ============ FOOTER ============ --}}
<footer class="bg-[#15181C] pt-16 pb-8 text-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-[1.3fr_1fr_1fr_1fr] gap-x-10 gap-y-10 pb-12 border-b border-white/10 items-start">
            <!-- Logo & About -->
            <div class="pt-1">
                <img src="{{ asset('images/logo%20sanwa.png') }}" alt="Logo PT Sanwa Antar Nusa" class="h-12 w-auto object-contain brightness-0 invert mb-5" loading="lazy">
                <p class="text-sm text-white/70 leading-relaxed mb-6 max-w-xs">
                    Jasa ekspedisi dan logistik nasional kargo laut dan darat terpercaya ke seluruh Indonesia.
                </p>
                <div class="flex items-center gap-3">
                    <a href="https://www.instagram.com/sanwaantarnusa?igsh=a2N6MGpkZGUwcjhq" target="_blank" rel="noopener" aria-label="Instagram Sanwa Antar Nusa"
                       class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white hover:bg-[#E31E24] transition-colors">
                        <i class="fa-brands fa-instagram text-base"></i>
                    </a>
                    <a href="https://www.tiktok.com/@pt_sanwaantarnusa?_r=1&_t=ZS-97kfLvdwNxX" target="_blank" rel="noopener" aria-label="TikTok Sanwa Antar Nusa"
                       class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white hover:bg-[#E31E24] transition-colors">
                        <i class="fa-brands fa-tiktok text-base"></i>
                    </a>
                    <a href="https://wa.me/628113144405" target="_blank" rel="noopener" aria-label="WhatsApp Sanwa Antar Nusa"
                       class="flex h-10 w-10 items-center justify-center rounded-full bg-white/10 text-white hover:bg-[#E31E24] transition-colors">
                        <i class="fa-brands fa-whatsapp text-base"></i>
                    </a>
                </div>
            </div>

            <!-- Head Office Surabaya -->
            <div class="pt-1">
                <p class="font-heading font-semibold text-xs uppercase tracking-wider text-[#E31E24] mb-4">HEAD OFFICE</p>
                <p class="font-heading font-bold text-white mb-2 text-sm">Surabaya</p>
                <ul class="space-y-2.5 text-xs text-white/70">
                    <li class="flex items-start gap-2.5">
                        <i data-lucide="map-pin" class="w-4 h-4 text-[#E31E24] shrink-0 mt-0.5"></i>
                        <span>Jl. Kalimas Baru No. 26, Surabaya, Jawa Timur</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="phone" class="w-4 h-4 text-[#E31E24] shrink-0"></i>
                        <a href="https://wa.me/628113144405" target="_blank" rel="noopener" class="hover:text-white transition-colors">+62 811-3144-405</a>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="mail" class="w-4 h-4 text-[#E31E24] shrink-0"></i>
                        <span>pt.sanwaantarnusa26@gmail.com</span>
                    </li>
                </ul>
            </div>

            <!-- Jakarta Branch -->
            <div class="pt-1">
                <p class="font-heading font-semibold text-xs uppercase tracking-wider text-white/50 mb-4">BRANCH OFFICE</p>
                <p class="font-heading font-bold text-white mb-2 text-sm">Jakarta</p>
                <ul class="space-y-2.5 text-xs text-white/70">
                    <li class="flex items-start gap-2.5">
                        <i data-lucide="map-pin" class="w-4 h-4 text-[#E31E24] shrink-0 mt-0.5"></i>
                        <span>Jl. Tembang No. 46, Tanjung Priok, Jakarta Utara</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="phone" class="w-4 h-4 text-[#E31E24] shrink-0"></i>
                        <a href="https://wa.me/6281318718883" target="_blank" rel="noopener" class="hover:text-white transition-colors">+62 813-1871-8883</a>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="mail" class="w-4 h-4 text-[#E31E24] shrink-0"></i>
                        <span>ptsanwa@gmail.com</span>
                    </li>
                </ul>
            </div>

            <!-- Kupang Branch -->
            <div class="pt-1">
                <p class="font-heading font-semibold text-xs uppercase tracking-wider text-white/50 mb-4">BRANCH OFFICE</p>
                <p class="font-heading font-bold text-white mb-2 text-sm">Kupang</p>
                <ul class="space-y-2.5 text-xs text-white/70">
                    <li class="flex items-start gap-2.5">
                        <i data-lucide="map-pin" class="w-4 h-4 text-[#E31E24] shrink-0 mt-0.5"></i>
                        <span>Jl. Oeleta Raya, Alak, Kupang, Nusa Tenggara Timur</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="phone" class="w-4 h-4 text-[#E31E24] shrink-0"></i>
                        <a href="https://wa.me/628113144405" target="_blank" rel="noopener" class="hover:text-white transition-colors">+62 811-3144-405</a>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i data-lucide="mail" class="w-4 h-4 text-[#E31E24] shrink-0"></i>
                        <span>pt.sanwaantarnusa26@gmail.com</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-white/50">
            <p>&copy; {{ date('Y') }} PT Sanwa Antar Nusa.</p>
            <ul class="flex flex-wrap items-center gap-6">
                <li><a href="#beranda" class="hover:text-white transition-colors">Beranda</a></li>
                <li><a href="#tentang" class="hover:text-white transition-colors">Tentang Kami</a></li>
                <li><a href="#layanan" class="hover:text-white transition-colors">Layanan</a></li>
                <li><a href="#keunggulan" class="hover:text-white transition-colors">Keunggulan</a></li>
                <li><a href="#jadwal" class="hover:text-white transition-colors">Jadwal Kapal</a></li>
                <li><a href="#kontak" class="hover:text-white transition-colors">Kontak</a></li>
            </ul>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (window.lucide) { lucide.createIcons(); }

        // Count up animation function
        const countUp = (el) => {
            const target = parseInt(el.getAttribute('data-target'));
            const suffix = el.getAttribute('data-suffix') || '';
            const duration = 2000;
            const startTime = performance.now();

            const updateCount = (currentTime) => {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                const easeProgress = progress * (2 - progress);
                const currentValue = Math.floor(easeProgress * target);
                
                if (target >= 1000) {
                    if (el.getAttribute('data-format') === 'k') {
                        el.textContent = (currentValue / 1000).toFixed(0) + 'K' + suffix;
                    } else {
                        el.textContent = currentValue.toLocaleString('id-ID') + suffix;
                    }
                } else {
                    el.textContent = currentValue + suffix;
                }

                if (progress < 1) {
                    requestAnimationFrame(updateCount);
                } else {
                    el.textContent = (target >= 1000 && el.getAttribute('data-format') === 'k' ? (target / 1000).toFixed(0) + 'K' : target.toLocaleString('id-ID')) + suffix;
                }
            };

            requestAnimationFrame(updateCount);
        };

        // Intersection Observer for scroll reveal animations & count-ups
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    if (entry.target.classList.contains('count-up') && !entry.target.classList.contains('counted')) {
                        setTimeout(() => countUp(entry.target), 150);
                        entry.target.classList.add('counted');
                    }
                } else {
                    const rect = entry.target.getBoundingClientRect();
                    const viewportHeight = window.innerHeight || document.documentElement.clientHeight;
                    if (rect.top > viewportHeight) {
                        entry.target.classList.remove('active');
                    }
                }
            });
        }, { 
            threshold: 0.05,
            rootMargin: '0px 0px -30px 0px'
        });

        document.querySelectorAll('.reveal-on-scroll, .count-up').forEach(el => {
            observer.observe(el);
        });

        setTimeout(() => {
            document.querySelectorAll('.reveal-immediate').forEach(el => {
                el.classList.add('active');
            });
        }, 100);
    });
</script>
</body>
</html>