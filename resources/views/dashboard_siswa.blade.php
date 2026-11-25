<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Siswa - SAPA</title>
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

    <!-- Sidebar Khusus Siswa -->
    <aside id="sidebar" class="fixed lg:static inset-y-0 left-0 z-40 w-64 shrink-0 bg-white border-r border-purple-100 flex flex-col justify-between transform -translate-x-full lg:translate-x-0 transition-transform duration-200">
        <div>
            <div class="h-16 px-5 border-b border-purple-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-purple-700 text-white flex items-center justify-center shadow-sm shadow-purple-200">
                    <i class="fa-regular fa-building text-sm"></i>
                </div>
                <div class="leading-tight">
                    <div class="font-extrabold text-purple-950 tracking-tight text-base">SAPA</div>
                    <div class="text-[10px] font-bold tracking-wider text-purple-600 uppercase">Portal Pelapor</div>
                </div>
            </div>

            <nav class="p-4 space-y-6 text-sm">
                <div>
                    <div class="px-3 mb-2 text-[11px] font-bold tracking-wider text-slate-400 uppercase">
                        Menu Siswa
                    </div>
                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-purple-700 text-white font-semibold shadow-sm shadow-purple-200">
                                <i class="fa-solid fa-house w-4 text-center text-xs"></i>
                                <span>Beranda Saya</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('aspirasi.create') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-purple-50 hover:text-purple-800 font-medium transition">
                                <i class="fa-solid fa-bullhorn w-4 text-center text-xs"></i>
                                <span>Kirim Aspirasi</span>
                            </a>
                        </li>
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

        <div class="p-4 border-t border-purple-100 space-y-3">
            <div class="px-3 py-2 rounded-xl bg-purple-50/80 border border-purple-100 flex items-center justify-between text-xs">
                <span class="inline-flex items-center gap-1.5 font-semibold text-purple-800">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Mode: Siswa
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

        <!-- Header -->
        <header class="h-16 bg-white border-b border-purple-100 px-4 sm:px-7 flex items-center justify-between sticky top-0 z-20">
            <div class="flex items-center gap-3 min-w-0">
                <button type="button" onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg text-slate-600 hover:bg-purple-50">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="truncate">
                    <h1 class="text-base sm:text-lg font-extrabold text-purple-950 truncate">
                        Beranda Aspirasi Siswa
                    </h1>
                    <p class="text-[11px] sm:text-xs text-slate-500 truncate hidden sm:block">
                        Laporkan kerusakan fasilitas dan pantau tindak lanjutnya
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3 shrink-0">
                <div class="hidden sm:block text-right leading-tight">
                    <div class="text-xs font-bold text-purple-950">{{ auth()->user()->name }}</div>
                    <div class="text-[11px] text-slate-500">Pelapor / Siswa</div>
                </div>
                <div class="w-9 h-9 rounded-full bg-purple-100 text-purple-700 flex items-center justify-center font-bold text-sm border border-purple-200">
                    <i class="fa-solid fa-user-graduate text-xs"></i>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 p-4 sm:p-7 max-w-6xl w-full mx-auto space-y-6">

            @if (session('error'))
                <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Welcome Banner Siswa -->
            <div class="rounded-2xl bg-gradient-to-r from-purple-800 to-purple-600 p-6 sm:p-7 text-white shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="inline-block px-2.5 py-1 rounded-lg bg-white/15 text-[11px] font-semibold tracking-wide mb-2">
                        Layanan Pengaduan Sarana Sekolah
                    </span>
                    <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight">
                        Halo, {{ auth()->user()->name }}!
                    </h2>
                    <p class="text-xs sm:text-sm text-purple-100 mt-1 max-w-xl">
                        Menemukan fasilitas kelas, kamar mandi, olahraga, atau jaringan listrik yang bermasalah? Sampaikan laporanmu langsung ke tim sarpras.
                    </p>
                </div>
                <a href="{{ route('aspirasi.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 rounded-xl bg-white text-purple-800 hover:bg-purple-50 font-bold text-xs shadow-sm shrink-0 transition">
                    <i class="fa-solid fa-plus"></i>
                    <span>Buat Pengaduan Baru</span>
                </a>
            </div>

            <!-- 4 Kartu Ringkasan Milik Siswa -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl border border-purple-100 p-4 sm:p-5 shadow-sm">
                    <div class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">Laporan Saya</div>
                    <div class="mt-2 text-2xl sm:text-3xl font-extrabold text-purple-950">{{ $totalSaya }}</div>
                    <div class="mt-1 text-xs text-slate-500">Total terkirim</div>
                </div>

                <div class="bg-white rounded-2xl border border-purple-100 p-4 sm:p-5 shadow-sm">
                    <div class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">Menunggu</div>
                    <div class="mt-2 text-2xl sm:text-3xl font-extrabold text-amber-600">{{ $menungguSaya }}</div>
                    <div class="mt-1 text-xs text-slate-500">Belum ditinjau</div>
                </div>

                <div class="bg-white rounded-2xl border border-purple-100 p-4 sm:p-5 shadow-sm">
                    <div class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">Diproses</div>
                    <div class="mt-2 text-2xl sm:text-3xl font-extrabold text-purple-700">{{ $diprosesSaya }}</div>
                    <div class="mt-1 text-xs text-slate-500">Sedang diperbaiki</div>
                </div>

                <div class="bg-white rounded-2xl border border-purple-100 p-4 sm:p-5 shadow-sm">
                    <div class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">Selesai</div>
                    <div class="mt-2 text-2xl sm:text-3xl font-extrabold text-emerald-600">{{ $selesaiSaya }}</div>
                    <div class="mt-1 text-xs text-slate-500">Sudah ditangani</div>
                </div>
            </div>

            <!-- Daftar Laporan Terbaru Siswa -->
            <div class="bg-white rounded-2xl border border-purple-100 p-6 shadow-sm">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-base font-extrabold text-purple-950">Laporan Terbaru Saya</h3>
                        <p class="text-xs text-slate-500">3 pengaduan terakhir yang pernah kamu kirim</p>
                    </div>
                    <a href="{{ route('aspirasi.riwayat') }}" class="text-xs font-bold text-purple-700 hover:text-purple-900">
                        Lihat Semua &rarr;
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse ($laporanTerbaru as $item)
                        @php
                            $badge = match($item->status) {
                                'selesai' => 'bg-emerald-50 text-emerald-700',
                                'diproses' => 'bg-purple-50 text-purple-700',
                                default => 'bg-amber-50 text-amber-700',
                            };
                            $labelStatus = match($item->status) {
                                'selesai' => 'Selesai Diperbaiki',
                                'diproses' => 'Sedang Dikerjakan',
                                default => 'Menunggu Tinjauan',
                            };
                        @endphp
                        <div class="p-4 rounded-xl border border-purple-100/80 bg-purple-50/30 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                            <div>
                                <div class="text-xs text-slate-500">
                                    <span class="font-bold text-purple-700">{{ $item->kategori }}</span> &bull; {{ $item->lokasi }} &bull; {{ $item->created_at->format('d M Y') }}
                                </div>
                                <div class="font-bold text-sm text-purple-950 mt-0.5">{{ $item->judul }}</div>
                                @if ($item->tanggapan)
                                    <div class="text-xs text-slate-600 mt-1">
                                        <span class="font-semibold text-purple-800">Balasan Admin:</span> {{ $item->tanggapan }}
                                    </div>
                                @endif
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-bold self-start sm:self-center shrink-0 {{ $badge }}">
                                {{ $labelStatus }}
                            </span>
                        </div>
                    @empty
                        <div class="text-center py-8 text-xs text-slate-500">
                            Kamu belum pernah mengirim laporan. Klik <strong>Buat Pengaduan Baru</strong> di atas untuk memulai.
                        </div>
                    @endforelse
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