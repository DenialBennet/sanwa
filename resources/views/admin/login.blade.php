<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PT Sanwa Antar Nusa</title>
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
<body class="bg-[#15181C] min-h-screen flex items-center justify-center relative overflow-hidden px-4">
    <!-- Decorative Blurry Orbs -->
    <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] rounded-full bg-[#E31E24]/10 blur-[150px] pointer-events-none"></div>
    <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] rounded-full bg-[#E31E24]/5 blur-[150px] pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        <!-- Main Card -->
        <div class="bg-[#1F2328]/80 border border-white/10 rounded-[2.5rem] p-8 sm:p-10 backdrop-blur-xl shadow-2xl shadow-black/50">
            <!-- Header -->
            <div class="text-center mb-8">
                <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-[#E31E24]/15 mb-4 border border-[#E31E24]/30">
                    <i data-lucide="lock" class="w-8 h-8 text-[#E31E24]"></i>
                </div>
                <h1 class="font-heading font-extrabold text-2xl text-white tracking-tight">PT Sanwa Antar Nusa</h1>
                <p class="text-xs text-white/50 mt-2 font-medium tracking-wide uppercase">Admin Portal Login</p>
            </div>

            <!-- Error Alerts -->
            @if (isset($errors) && $errors->any())
                <div class="mb-6 bg-[#E31E24]/10 border border-[#E31E24]/20 text-red-200 rounded-2xl p-4 text-xs">
                    <ul class="list-disc pl-4 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                <!-- Email -->
                <div>
                    <label for="email" class="block text-[10px] font-bold uppercase tracking-wider text-white/60 mb-2">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-white/30">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                        </span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full rounded-xl bg-white/5 border border-white/10 pl-11 pr-4 py-3.5 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#E31E24] focus:border-transparent transition-all placeholder-white/20"
                               placeholder="admin@sanwaantarnusa.co.id">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-[10px] font-bold uppercase tracking-wider text-white/60 mb-2">Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-white/30">
                            <i data-lucide="key-round" class="w-4 h-4"></i>
                        </span>
                        <input type="password" id="password" name="password" required
                               class="w-full rounded-xl bg-white/5 border border-white/10 pl-11 pr-4 py-3.5 text-sm text-white focus:outline-none focus:ring-2 focus:ring-[#E31E24] focus:border-transparent transition-all placeholder-white/20"
                               placeholder="••••••••">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs text-white/60 pt-1">
                    <label class="flex items-center gap-2.5 cursor-pointer group">
                        <input type="checkbox" name="remember" class="rounded bg-white/5 border-white/15 text-[#E31E24] focus:ring-[#E31E24] focus:ring-offset-0 h-4.5 w-4.5 cursor-pointer">
                        <span class="group-hover:text-white transition-colors">Ingat akun saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-full bg-[#E31E24] text-white py-4 font-heading font-bold text-sm shadow-lg shadow-red-900/40 hover:bg-[#B5171C] transform hover:-translate-y-0.5 active:translate-y-0 transition-all">
                    Masuk ke Dashboard <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>
        </div>

        <!-- Back to Website Link -->
        <div class="text-center mt-6">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-1.5 text-xs text-white/40 hover:text-white transition-colors">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali ke Website Utama
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.lucide) { lucide.createIcons(); }
        });
    </script>
</body>
</html>
