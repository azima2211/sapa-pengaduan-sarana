<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAPA - Sistem Aspirasi & Pengaduan Sarana</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #faf7ff;
            color: #1e1b4b;
        }
    </style>
</head>
<body class="antialiased">

    <!-- Navbar -->
    <header class="sticky top-0 z-30 bg-white/95 backdrop-blur border-b border-purple-100">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2.5">
                <div class="w-9 h-9 rounded-lg bg-purple-700 text-white flex items-center justify-center shadow-sm">
                    <i class="fa-regular fa-building text-sm"></i>
                </div>
                <div class="leading-tight">
                    <div class="font-extrabold text-purple-950 tracking-tight text-base">SAPA</div>
                    <div class="text-[10px] font-semibold tracking-wider text-purple-600 uppercase">Sarana &amp; Prasarana</div>
                </div>
            </a>

            <div class="flex items-center gap-3 sm:gap-5">
                <a href="{{ route('login') }}" class="text-sm font-semibold text-purple-700 hover:text-purple-900 transition">
                    Masuk
                </a>
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg bg-purple-700 hover:bg-purple-800 text-white text-sm font-semibold shadow-sm shadow-purple-200 transition">
                    Mulai Sekarang
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative overflow-hidden pt-14 pb-16 px-4 sm:px-6 bg-gradient-to-b from-purple-50/90 via-white to-white">
        <!-- Decorative shapes -->
        <div class="hidden md:block absolute top-16 left-12 w-14 h-14 rounded-2xl border-2 border-purple-200/70 -rotate-12 pointer-events-none"></div>
        <div class="hidden md:block absolute top-32 right-16 w-7 h-7 rounded-full bg-purple-200/60 pointer-events-none"></div>

        <div class="max-w-3xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-100 text-purple-800 text-xs font-semibold mb-6">
                <span class="w-2 h-2 rounded-full bg-purple-600"></span>
                Sistem Pengaduan Digital Sekolah
            </div>

            <h1 class="text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight text-purple-950 leading-[1.12]">
                Suarakan Aspirasi<br>
                Wujudkan <span class="text-purple-700">Perubahan</span>
            </h1>

            <p class="mt-5 max-w-xl mx-auto text-base sm:text-lg text-slate-600 leading-relaxed">
                Platform digital untuk menyampaikan pengaduan sarana dan prasarana sekolah. Dari siswa, untuk sekolah yang lebih baik.
            </p>

            <div class="mt-8 flex justify-center">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2.5 px-7 py-3.5 rounded-xl bg-purple-700 hover:bg-purple-800 text-white font-semibold text-sm sm:text-base shadow-lg shadow-purple-200 transition">
                    <i class="fa-solid fa-right-to-bracket text-sm"></i>
                    <span>Masuk Sekarang</span>
                    <i class="fa-solid fa-arrow-right text-sm"></i>
                </a>
            </div>

            <div class="mt-8 flex flex-wrap items-center justify-center gap-x-6 gap-y-2 text-xs sm:text-sm font-medium text-slate-500">
                <span class="inline-flex items-center gap-1.5">
                    <i class="fa-regular fa-circle-check text-purple-600"></i>
                    Aman &amp; Terpercaya
                </span>
                <span class="inline-flex items-center gap-1.5">
                    <i class="fa-solid fa-bolt text-purple-600"></i>
                    Respon Cepat
                </span>
                <span class="inline-flex items-center gap-1.5">
                    <i class="fa-regular fa-star text-purple-600"></i>
                    Gratis Selamanya
                </span>
            </div>
        </div>
    </section>

    <!-- Stats Strip -->
    <section class="border-y border-purple-100 bg-purple-50/50 py-10 px-4 sm:px-6">
        <div class="max-w-5xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="w-10 h-10 mx-auto mb-3 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center">
                    <i class="fa-regular fa-file-lines"></i>
                </div>
                <div class="text-2xl sm:text-3xl font-extrabold text-purple-950">500+</div>
                <div class="text-xs sm:text-sm text-slate-500 mt-1">Laporan Ditangani</div>
            </div>

            <div>
                <div class="w-10 h-10 mx-auto mb-3 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center">
                    <i class="fa-regular fa-circle-check"></i>
                </div>
                <div class="text-2xl sm:text-3xl font-extrabold text-purple-950">95%</div>
                <div class="text-xs sm:text-sm text-slate-500 mt-1">Tingkat Penyelesaian</div>
            </div>

            <div>
                <div class="w-10 h-10 mx-auto mb-3 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center">
                    <i class="fa-regular fa-clock"></i>
                </div>
                <div class="text-2xl sm:text-3xl font-extrabold text-purple-950">24 Jam</div>
                <div class="text-xs sm:text-sm text-slate-500 mt-1">Rata-rata Respon</div>
            </div>

            <div>
                <div class="w-10 h-10 mx-auto mb-3 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div class="text-2xl sm:text-3xl font-extrabold text-purple-950">8</div>
                <div class="text-xs sm:text-sm text-slate-500 mt-1">Kategori Sarana</div>
            </div>
        </div>
    </section>

    <!-- Fitur Unggulan -->
    <section id="mulai" class="py-16 px-4 sm:px-6 bg-white">
        <div class="max-w-5xl mx-auto">
            <div class="text-center max-w-xl mx-auto mb-12">
                <span class="inline-block px-3 py-1 rounded-full bg-purple-100 text-purple-800 text-[11px] font-bold tracking-wider uppercase mb-3">
                    Fitur Unggulan
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-purple-950 tracking-tight">
                    Semua yang Kamu Butuhkan
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600">
                    Dirancang khusus untuk mempermudah proses pengaduan sarana dan prasarana di lingkungan sekolah.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-6 rounded-2xl border border-purple-100 bg-white hover:border-purple-300 hover:shadow-md hover:shadow-purple-100/60 transition">
                    <div class="w-11 h-11 rounded-xl bg-purple-700 text-white flex items-center justify-center mb-4">
                        <i class="fa-solid fa-bullhorn"></i>
                    </div>
                    <h3 class="text-lg font-bold text-purple-950">Lapor Mudah</h3>
                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                        Sampaikan pengaduan sarana sekolah hanya dalam hitungan detik melalui formulir digital yang simpel.
                    </p>
                </div>

                <div class="p-6 rounded-2xl border border-purple-100 bg-white hover:border-purple-300 hover:shadow-md hover:shadow-purple-100/60 transition">
                    <div class="w-11 h-11 rounded-xl bg-fuchsia-600 text-white flex items-center justify-center mb-4">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h3 class="text-lg font-bold text-purple-950">Pantau Progres</h3>
                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                        Lacak status pengaduan secara real-time. Tahu kapan laporan diterima, diproses, hingga selesai.
                    </p>
                </div>

                <div class="p-6 rounded-2xl border border-purple-100 bg-white hover:border-purple-300 hover:shadow-md hover:shadow-purple-100/60 transition">
                    <div class="w-11 h-11 rounded-xl bg-violet-600 text-white flex items-center justify-center mb-4">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h3 class="text-lg font-bold text-purple-950">Transparan &amp; Akuntabel</h3>
                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                        Setiap laporan tercatat dan terdokumentasi. Admin wajib memberikan tanggapan resmi.
                    </p>
                </div>

                <div class="p-6 rounded-2xl border border-purple-100 bg-purple-50/40 hover:border-purple-300 hover:shadow-md hover:shadow-purple-100/60 transition">
                    <div class="w-11 h-11 rounded-xl bg-purple-900 text-white flex items-center justify-center mb-4">
                        <i class="fa-solid fa-gauge-high"></i>
                    </div>
                    <h3 class="text-lg font-bold text-purple-950">Respon Cepat</h3>
                    <p class="mt-2 text-sm text-slate-600 leading-relaxed">
                        Sistem notifikasi memastikan admin segera menindaklanjuti setiap pengaduan yang masuk.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cara Kerja: 4 Langkah Mudah -->
    <section class="py-16 px-4 sm:px-6 bg-purple-50/60 border-t border-purple-100">
        <div class="max-w-5xl mx-auto">
            <div class="text-center max-w-xl mx-auto mb-12">
                <span class="inline-block px-3 py-1 rounded-full bg-purple-100 text-purple-800 text-[11px] font-bold tracking-wider uppercase mb-3">
                    Cara Kerja
                </span>
                <h2 class="text-2xl sm:text-4xl font-extrabold text-purple-950 tracking-tight">
                    4 Langkah Mudah
                </h2>
                <p class="mt-3 text-sm sm:text-base text-slate-600">
                    Proses pengaduan yang simpel dan terstruktur dari awal hingga tuntas.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="relative bg-white p-6 rounded-2xl border border-purple-100 text-center">
                    <span class="absolute top-3 right-3 w-6 h-6 rounded-full bg-purple-700 text-white text-xs font-bold flex items-center justify-center">01</span>
                    <div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center">
                        <i class="fa-solid fa-right-to-bracket"></i>
                    </div>
                    <h3 class="font-bold text-purple-950">Masuk Akun</h3>
                    <p class="mt-2 text-xs text-slate-600 leading-relaxed">
                        Login dengan email dan password akun siswa atau admin.
                    </p>
                </div>

                <div class="relative bg-white p-6 rounded-2xl border border-purple-100 text-center">
                    <span class="absolute top-3 right-3 w-6 h-6 rounded-full bg-purple-700 text-white text-xs font-bold flex items-center justify-center">02</span>
                    <div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center">
                        <i class="fa-regular fa-pen-to-square"></i>
                    </div>
                    <h3 class="font-bold text-purple-950">Buat Laporan</h3>
                    <p class="mt-2 text-xs text-slate-600 leading-relaxed">
                        Isi formulir pengaduan lengkap dengan lokasi dan deskripsi.
                    </p>
                </div>

                <div class="relative bg-white p-6 rounded-2xl border border-purple-100 text-center">
                    <span class="absolute top-3 right-3 w-6 h-6 rounded-full bg-purple-700 text-white text-xs font-bold flex items-center justify-center">03</span>
                    <div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center">
                        <i class="fa-regular fa-clipboard"></i>
                    </div>
                    <h3 class="font-bold text-purple-950">Admin Meninjau</h3>
                    <p class="mt-2 text-xs text-slate-600 leading-relaxed">
                        Tim sarpras menerima dan menindaklanjuti laporan Anda.
                    </p>
                </div>

                <div class="relative bg-white p-6 rounded-2xl border border-purple-100 text-center">
                    <span class="absolute top-3 right-3 w-6 h-6 rounded-full bg-purple-700 text-white text-xs font-bold flex items-center justify-center">04</span>
                    <div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <h3 class="font-bold text-purple-950">Masalah Selesai</h3>
                    <p class="mt-2 text-xs text-slate-600 leading-relaxed">
                        Terima umpan balik dan konfirmasi penyelesaian.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-purple-100 bg-white py-6 px-4 sm:px-6">
        <div class="max-w-6xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
            <div class="flex items-center gap-2">
                <span class="w-6 h-6 rounded bg-purple-700 text-white flex items-center justify-center text-[11px]">
                    <i class="fa-regular fa-building"></i>
                </span>
                <span><strong class="text-purple-950">SAPA</strong> &copy; 2026 &bull; Sistem Aspirasi &amp; Pengaduan Sarana</span>
            </div>

            <div class="flex items-center gap-4">
                <span class="inline-flex items-center gap-1.5 text-emerald-700 font-medium">
                    <i class="fa-regular fa-circle-check"></i>
                    System Online
                </span>
                <span class="text-slate-300">|</span>
                <span>UKK RPL 2025/2026</span>
            </div>
        </div>
    </footer>

</body>
</html>