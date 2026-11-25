<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - SAPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f6f4fc;
            color: #1e1b4b;
        }
    </style>
</head>
<body class="min-h-screen flex bg-[#f6f4fc] text-slate-800">

    <!-- Mobile Sidebar Backdrop -->
    <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/40 z-30 hidden lg:hidden"></div>

    <!-- Sidebar -->
    <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-40 w-64 shrink-0 bg-white border-r border-purple-100 flex flex-col justify-between transform -translate-x-full lg:translate-x-0 transition-transform duration-200">
        <div>
            <!-- Brand Header -->
            <div class="h-16 px-5 border-b border-purple-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-purple-700 text-white flex items-center justify-center shadow-sm shadow-purple-200">
                    <i class="fa-regular fa-building text-sm"></i>
                </div>
                <div class="leading-tight">
                    <div class="font-extrabold text-purple-950 tracking-tight text-base">SAPA</div>
                    <div class="text-[10px] font-bold tracking-wider text-purple-600 uppercase">Sarana Sekolah</div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <nav class="p-4 space-y-6 text-sm">
                <div>
                    <div class="px-3 mb-2 text-[11px] font-bold tracking-wider text-slate-400 uppercase">
                        Administrator
                    </div>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-purple-700 text-white font-semibold shadow-sm shadow-purple-200">
                                <i class="fa-solid fa-table-cells-large w-4 text-center text-xs"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('aspirasi.admin') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-purple-50 hover:text-purple-800 font-medium transition">
                                <i class="fa-regular fa-file-lines w-4 text-center text-xs"></i>
                                <span>Kelola Aspirasi</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <div class="px-3 mb-2 text-[11px] font-bold tracking-wider text-slate-400 uppercase">
                        Menu Pelapor
                    </div>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('aspirasi.riwayat') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-purple-50 hover:text-purple-800 font-medium transition">
                                <i class="fa-solid fa-clock-rotate-left w-4 text-center text-xs"></i>
                                <span>Riwayat &amp; Status</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-purple-100 space-y-3">
            <div class="px-3 py-2 rounded-xl bg-purple-50/80 border border-purple-100 flex items-center justify-between text-xs">
                <span class="inline-flex items-center gap-1.5 font-semibold text-purple-800">
                    <span class="w-2 h-2 rounded-full bg-purple-600"></span>
                    Mode: {{ str_contains(strtolower(auth()->user()->email), 'admin') ? 'Admin' : 'Pelapor' }}
                </span>
                <span class="text-slate-500 truncate max-w-[95px]">{{ auth()->user()->name }}</span>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-rose-600 hover:bg-rose-50 font-semibold text-xs transition">
                    <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i>
                    <span>Keluar Sesi</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Area -->
    <div class="flex-1 flex flex-col min-w-0">

        <!-- Top Header -->
        <header class="h-16 bg-white border-b border-purple-100 px-4 sm:px-7 flex items-center justify-between sticky top-0 z-20">
            <div class="flex items-center gap-3 min-w-0">
                <button type="button" onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-purple-50">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="truncate">
                    <h1 class="text-base sm:text-lg font-extrabold text-purple-950 truncate">
                        Aplikasi Pengaduan Sarana
                    </h1>
                    <p class="text-[11px] sm:text-xs text-slate-500 truncate hidden sm:block">
                        Sistem Aspirasi &amp; Pengaduan Fasilitas Akademik
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3 sm:gap-4 shrink-0">
                <div class="flex items-center gap-2.5">
                    <div class="hidden sm:block text-right leading-tight">
                        <div class="text-xs font-bold text-purple-950">{{ auth()->user()->name }}</div>
                        <div class="text-[11px] text-slate-500">
                            {{ str_contains(strtolower(auth()->user()->email), 'admin') ? 'Administrator' : 'Siswa / Pelapor' }}
                        </div>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-sm border border-purple-200">
                        <i class="fa-regular fa-user text-xs"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main class="flex-1 p-4 sm:p-7 max-w-7xl w-full mx-auto space-y-6">

            <!-- 4 Stat Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl border border-purple-100/90 p-5 shadow-sm flex items-start justify-between">
                    <div>
                        <div class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">Total Aspirasi</div>
                        <div class="mt-2.5 flex items-baseline gap-2">
                            <span class="text-3xl font-extrabold text-purple-950">{{ $totalAspirasi }}</span>
                            <span class="text-xs font-bold text-purple-700">
                                <i class="fa-solid fa-database mr-0.5"></i>Tercatat
                            </span>
                        </div>
                        <div class="mt-2 text-xs text-slate-500">Seluruh laporan masuk</div>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center shrink-0">
                        <i class="fa-regular fa-file-lines"></i>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl border border-purple-100/90 p-5 shadow-sm flex items-start justify-between">
                    <div>
                        <div class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">Menunggu Tinjauan</div>
                        <div class="mt-2.5 flex items-center gap-2">
                            <span class="text-3xl font-extrabold text-purple-950">{{ $menunggu }}</span>
                            <span class="px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 text-[11px] font-bold">
                                Perlu Respon
                            </span>
                        </div>
                        <div class="mt-2 text-xs text-slate-500">Laporan baru</div>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                        <i class="fa-regular fa-folder-open"></i>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-2xl border border-purple-100/90 p-5 shadow-sm flex items-start justify-between">
                    <div>
                        <div class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">Sedang Dikerjakan</div>
                        <div class="mt-2.5 flex items-center gap-2">
                            <span class="text-3xl font-extrabold text-purple-950">{{ $diproses }}</span>
                            <span class="px-2 py-0.5 rounded-md bg-purple-50 text-purple-700 text-[11px] font-bold">
                                Teknisi aktif
                            </span>
                        </div>
                        <div class="mt-2 text-xs text-slate-500">Proses perbaikan</div>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-700 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white rounded-2xl border border-purple-100/90 p-5 shadow-sm flex items-start justify-between">
                    <div>
                        <div class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">Selesai Diperbaiki</div>
                        <div class="mt-2.5 flex items-center gap-2">
                            <span class="text-3xl font-extrabold text-purple-950">{{ $selesai }}</span>
                            <span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-[11px] font-bold">
                                {{ $persenSelesai }}% Sukses
                            </span>
                        </div>
                        <div class="mt-2 text-xs text-slate-500">Fasilitas normal</div>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <i class="fa-regular fa-circle-check"></i>
                    </div>
                </div>
            </div>

            <!-- Lower Grid: Category Distribution & Response Status -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left 2 Columns: Distribusi Laporan Kategori -->
                <div class="lg:col-span-2 bg-white rounded-2xl border border-purple-100/90 p-6 shadow-sm">
                    <div class="flex items-start justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-base font-extrabold text-purple-950">Distribusi Laporan Kategori</h2>
                            <p class="text-xs text-slate-500 mt-0.5">Sebaran masalah sarana dan prasarana berdasarkan unit fasilitas</p>
                        </div>
                        <a href="{{ route('aspirasi.admin') }}" class="text-xs font-bold text-purple-700 hover:text-purple-900 shrink-0 transition">
                            Lihat Detail &rarr;
                        </a>
                    </div>

                    <div class="space-y-5">
                        @foreach ($distribusiKategori as $kat)
                            <div>
                                <div class="flex items-center justify-between text-xs mb-2">
                                    <span class="font-bold text-purple-950 inline-flex items-center gap-2">
                                        <i class="{{ $kat['ikon'] }} text-slate-400"></i>
                                        {{ $kat['nama'] }}
                                    </span>
                                    <span class="font-semibold text-slate-600">
                                        {{ $kat['jumlah'] }} Laporan <span class="text-slate-400 font-normal">({{ $kat['persen'] }}%)</span>
                                    </span>
                                </div>
                                <div class="w-full h-2 rounded-full bg-purple-50 overflow-hidden">
                                    <div class="h-full rounded-full bg-purple-700" style="width: {{ $kat['persen'] }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right Column: Status Respon Fasilitas -->
                <div class="bg-white rounded-2xl border border-purple-100/90 p-6 shadow-sm flex flex-col justify-between">
                    <div>
                        <h2 class="text-base font-extrabold text-purple-950">Status Respon Fasilitas</h2>
                        <p class="text-xs text-slate-500 mt-0.5">Indikator efisiensi penanganan pengaduan</p>
                    </div>

                    <div class="my-6 text-center py-6 px-4 rounded-2xl bg-purple-50/50 border border-purple-100/80">
                        <div class="text-4xl font-extrabold text-purple-800 tracking-tight">{{ $persenSelesai }}%</div>
                        <div class="mt-2 text-xs font-bold text-purple-950">Tingkat Penyelesaian</div>
                        <p class="mt-1 text-[11px] text-slate-500">
                            {{ $selesai }} selesai dari {{ $totalAspirasi }} total laporan
                        </p>
                    </div>

                    <div class="flex items-center justify-between text-xs text-slate-500 pt-3 border-t border-purple-100">
                        <span class="inline-flex items-center gap-1.5 text-emerald-700 font-semibold">
                            <i class="fa-regular fa-circle-check"></i>
                            Layanan Aktif
                        </span>
                        <span>Periode Nov 2026</span>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            sidebar.classList.toggle('-translate-x-full');
            backdrop.classList.toggle('hidden');
        }
    </script>
</body>
</html>