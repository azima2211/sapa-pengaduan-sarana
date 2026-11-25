<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Laporan Saya - SAPA</title>
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

    <!-- Sidebar -->
    <aside class="hidden lg:flex w-64 shrink-0 bg-white border-r border-purple-100 flex-col justify-between">
        <div>
            <div class="h-16 px-5 border-b border-purple-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-purple-700 text-white flex items-center justify-center shadow-sm shadow-purple-200">
                    <i class="fa-regular fa-building text-sm"></i>
                </div>
                <div class="leading-tight">
                    <div class="font-extrabold text-purple-950 tracking-tight text-base">SAPA</div>
                    <div class="text-[10px] font-bold tracking-wider text-purple-600 uppercase">
                        {{ ($isAdmin ?? false) ? 'Sarana Sekolah' : 'Panel Siswa' }}
                    </div>
                </div>
            </div>

            @unless ($isAdmin ?? false)
                <div class="mx-4 mt-4 p-3.5 rounded-2xl bg-purple-50/70 border border-purple-100">
                    <div class="text-xs font-extrabold text-purple-950 truncate">{{ auth()->user()->name }}</div>
                    <div class="text-[11px] text-slate-500 mt-0.5">Akun Pelapor &bull; Siswa</div>
                </div>
            @endunless

            <nav class="p-4 space-y-6 text-sm">
                @if ($isAdmin ?? false)
                    <div>
                        <div class="px-3 mb-2 text-[11px] font-bold tracking-wider text-slate-400 uppercase">Administrator</div>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-purple-50 hover:text-purple-800 font-medium transition">
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
                @endif

                <div>
                    <div class="px-3 mb-2 text-[11px] font-bold tracking-wider text-slate-400 uppercase">
                        {{ ($isAdmin ?? false) ? 'Menu Pelapor' : 'Menu Siswa' }}
                    </div>
                    <ul class="space-y-1">
                        @unless ($isAdmin ?? false)
                            <li>
                                <a href="{{ route('aspirasi.create') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-purple-50 hover:text-purple-800 font-medium transition">
                                    <i class="fa-solid fa-pen-to-square w-4 text-center text-xs"></i>
                                    <span>Buat Pengaduan</span>
                                </a>
                            </li>
                        @endunless
                        <li>
                            <a href="{{ route('aspirasi.riwayat') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-purple-700 text-white font-semibold shadow-sm shadow-purple-200">
                                <i class="fa-regular fa-file-lines w-4 text-center text-xs"></i>
                                <span>Riwayat Laporan Saya</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>

        <div class="p-4 border-t border-purple-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-3.5 py-2.5 rounded-xl border border-rose-200 text-rose-600 hover:bg-rose-50 font-semibold text-xs transition">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Area -->
    <div class="flex-1 flex flex-col min-w-0">
        <header class="h-16 bg-white border-b border-purple-100 px-4 sm:px-7 flex items-center justify-between sticky top-0 z-20">
            <div>
                <h1 class="text-base sm:text-lg font-extrabold text-purple-950">Riwayat Laporan Saya</h1>
                <p class="text-xs text-slate-500 hidden sm:block">Pantau status penanganan dan tanggapan admin atas pengaduan yang sudah kamu kirim.</p>
            </div>
           
        </header>

        <main class="flex-1 p-4 sm:p-7 max-w-5xl w-full mx-auto space-y-5">
            @if (session('success'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <!-- 3 Kartu Ringkasan Riwayat -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white rounded-2xl border border-purple-100 p-5 shadow-sm">
                    <div class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">Total Laporan</div>
                    <div class="mt-2 text-2xl font-extrabold text-purple-950">{{ $aspirasis->count() }}</div>
                </div>
                <div class="bg-white rounded-2xl border border-purple-100 p-5 shadow-sm">
                    <div class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">Sedang Diproses</div>
                    <div class="mt-2 text-2xl font-extrabold text-purple-700">{{ $aspirasis->where('status', 'diproses')->count() }}</div>
                </div>
                <div class="bg-white rounded-2xl border border-purple-100 p-5 shadow-sm">
                    <div class="text-[11px] font-bold tracking-wider text-slate-400 uppercase">Selesai</div>
                    <div class="mt-2 text-2xl font-extrabold text-emerald-600">{{ $aspirasis->where('status', 'selesai')->count() }}</div>
                </div>
            </div>

            <!-- Daftar Pengaduan -->
            <div class="space-y-4">
                @forelse ($aspirasis as $item)
                    <div class="bg-white rounded-2xl border border-purple-100 p-5 shadow-sm space-y-3">
                        <div class="flex flex-wrap items-start justify-between gap-2">
                            <div>
                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <span class="font-bold text-purple-700">{{ $item->kategori }}</span>
                                    <span>&bull;</span>
                                    <span>{{ $item->lokasi }}</span>
                                    <span>&bull;</span>
                                    <span>{{ $item->created_at->format('d M Y') }}</span>
                                </div>
                                <h2 class="text-base font-extrabold text-purple-950 mt-1">{{ $item->judul }}</h2>
                            </div>

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
                            <span class="px-3 py-1 rounded-full text-xs font-bold {{ $badge }}">
                                {{ $labelStatus }}
                            </span>
                        </div>

                        <p class="text-sm text-slate-600">{{ $item->deskripsi }}</p>

                        @if ($item->foto)
                            <div>
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto bukti" class="w-44 h-32 object-cover rounded-xl border border-purple-100">
                            </div>
                        @endif

                        <div class="p-3.5 rounded-xl bg-purple-50/60 border border-purple-100 text-xs">
                            <span class="font-bold text-purple-950">Tanggapan Admin:</span>
                            <span class="text-slate-600">
                                {{ $item->tanggapan ?: 'Belum ada tanggapan dari petugas sarpras.' }}
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl border border-purple-100 p-10 text-center space-y-2">
                        <p class="text-sm font-bold text-purple-950">Belum ada riwayat pengaduan.</p>
                        <div>
                         
                        </div>
                    </div>
                @endforelse
            </div>
        </main>
    </div>
</body>
</html>