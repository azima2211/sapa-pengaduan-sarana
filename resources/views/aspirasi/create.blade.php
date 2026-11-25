<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> SAPA</title>
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

    <!-- Sidebar Lengkap Admin (4 Menu) -->
    <aside class="hidden lg:flex w-64 shrink-0 bg-white border-r border-purple-100 flex-col justify-between">
        <div>
            <div class="h-16 px-5 border-b border-purple-100 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl bg-purple-700 text-white flex items-center justify-center shadow-sm shadow-purple-200">
                    <i class="fa-regular fa-building text-sm"></i>
                </div>
                <div class="leading-tight">
                    <div class="font-extrabold text-purple-950 tracking-tight text-base">SAPA</div>
                    <div class="text-[10px] font-bold tracking-wider text-purple-600 uppercase">Sarana Sekolah</div>
                </div>
            </div>

            <nav class="p-4 space-y-6 text-sm">
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

                <div>
                    <div class="px-3 mb-2 text-[11px] font-bold tracking-wider text-slate-400 uppercase">Menu Pelapor</div>
                    <ul class="space-y-1">
                        <li>
                            
                        </li>
                        <li>
                            <a href="{{ route('aspirasi.riwayat') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-purple-50 hover:text-purple-800 font-medium transition">
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
                <button type="submit" class="w-full flex items-center gap-2.5 px-3.5 py-2 rounded-xl text-rose-600 hover:bg-rose-50 font-semibold text-xs transition">
                    <i class="fa-solid fa-arrow-right-from-bracket w-4 text-center"></i>
                    <span>Keluar Sesi</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Area -->
    <div class="flex-1 flex flex-col min-w-0">
        <header class="h-16 bg-white border-b border-purple-100 px-4 sm:px-7 flex items-center justify-between sticky top-0 z-20">
            <div>
                <h1 class="text-base sm:text-lg font-extrabold text-purple-950">Kirim Aspirasi / Pengaduan</h1>
                <p class="text-xs text-slate-500 hidden sm:block">Laporkan kerusakan atau aspirasi sarana &amp; prasarana sekolah</p>
            </div>
            <a href="{{ route('dashboard') }}" class="text-xs font-semibold text-purple-700 hover:text-purple-900">
                &larr; Kembali ke Dashboard
            </a>
        </header>

        <main class="flex-1 p-4 sm:p-7 max-w-3xl w-full mx-auto">
            @if ($errors->any())
                <div class="mb-5 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs space-y-1">
                    @foreach ($errors->all() as $error)
                        <div>&bull; {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-purple-100 p-6 sm:p-8 shadow-sm">
                <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-purple-950 mb-1.5">Judul Laporan</label>
                        <input
                            type="text"
                            name="judul"
                            value="{{ old('judul') }}"
                            placeholder="Contoh: Kipas angin kelas XI RPL 1 mati"
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none text-sm"
                        >
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-purple-950 mb-1.5">Kategori Kerusakan</label>
                            <select
                                name="kategori"
                                required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none text-sm bg-white"
                            >
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Fasilitas Kelas" {{ old('kategori') == 'Fasilitas Kelas' ? 'selected' : '' }}>Fasilitas Kelas</option>
                                <option value="Kamar Mandi" {{ old('kategori') == 'Kamar Mandi' ? 'selected' : '' }}>Kamar Mandi</option>
                                <option value="Olahraga" {{ old('kategori') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                                <option value="Jaringan & Listrik" {{ old('kategori') == 'Jaringan & Listrik' ? 'selected' : '' }}>Jaringan &amp; Listrik</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-purple-950 mb-1.5">Lokasi Kerusakan</label>
                            <input
                                type="text"
                                name="lokasi"
                                value="{{ old('lokasi') }}"
                                placeholder="Contoh: Lab RPL 2, Kelas XI TKJ 1"
                                required
                                class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none text-sm"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-purple-950 mb-1.5">Keterangan Detail Kerusakan</label>
                        <textarea
                            name="deskripsi"
                            rows="4"
                            placeholder="Jelaskan kerusakan secara jelas..."
                            required
                            class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none text-sm"
                        >{{ old('deskripsi') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-purple-950 mb-1.5">Foto Bukti (Opsional)</label>
                        <input
                            type="file"
                            name="foto"
                            accept="image/*"
                            class="w-full text-xs text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100"
                        >
                        <p class="text-[11px] text-slate-400 mt-1">Format JPG, PNG, WEBP. Maksimal 2 MB.</p>
                    </div>

                    <div class="pt-2 flex items-center justify-end gap-3">
                        <a href="{{ route('aspirasi.riwayat') }}" class="px-4 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-50 text-xs font-semibold">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-purple-700 hover:bg-purple-800 text-white text-xs font-semibold shadow-sm shadow-purple-200 transition">
                            Kirim Pengaduan &rarr;
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>