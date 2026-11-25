<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Pengaduan - SAPA</title>
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

    @php
        $infoSiswa = match(strtolower(auth()->user()->email ?? '')) {
            'bagas.siswa@sapa.sch.id' => 'NIS: 24102 • XII TKJ 2',
            'alya.siswa@sapa.sch.id'  => 'NIS: 24103 • X AKL 1',
            'fajar.siswa@sapa.sch.id' => 'NIS: 24104 • XI MM 1',
            default                    => 'NIS: 24101 • XI RPL 1',
        };
    @endphp

    <!-- Sidebar Panel Siswa (Ungu) -->
    <aside class="w-64 shrink-0 bg-[#faf8ff] border-r border-purple-200/70 flex flex-col justify-between">
        <div>
            <div class="px-6 pt-6 pb-4">
                <div class="text-xl font-black text-purple-800 tracking-tight">SAPA</div>
                <div class="text-[11px] font-bold tracking-wider text-purple-500 uppercase mt-0.5">PANEL SISWA</div>
            </div>

            <!-- Kartu Profil Siswa -->
            <div class="mx-4 p-3.5 rounded-xl bg-white border border-purple-200/80 shadow-2xs">
                <div class="text-xs font-extrabold text-purple-950 truncate">{{ auth()->user()->name }}</div>
                <div class="text-[11px] text-slate-500 mt-0.5 truncate">{{ $infoSiswa }}</div>
            </div>

            <!-- Navigasi Siswa -->
            <nav class="px-4 mt-5 space-y-1.5 text-xs">
                <a href="{{ route('aspirasi.create') }}" class="flex items-center gap-2.5 px-4 py-3 rounded-xl bg-purple-700 text-white font-bold shadow-sm shadow-purple-200">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Buat Pengaduan</span>
                </a>
                <a href="{{ route('aspirasi.riwayat') }}" class="flex items-center gap-2.5 px-4 py-3 rounded-xl text-slate-700 hover:bg-purple-100/70 hover:text-purple-900 font-semibold transition">
                    <i class="fa-regular fa-file-lines"></i>
                    <span>Riwayat Laporan Saya</span>
                </a>
            </nav>
        </div>

        <!-- Tombol Keluar Sistem -->
        <div class="p-4">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-centerc gap-2 px-4 py-2.5 rounded-xl bg-white border border-purple-200 text-purple-800 hover:bg-purple-50 font-bold text-xs transition">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Konten Utama -->
    <main class="flex-1 p-6 sm:p-8 max-w-4xl">
        <div class="mb-6">
            <h1 class="text-2xl font-extrabold text-purple-950 tracking-tight">
                Buat Pengaduan Sarana &amp; Prasarana
            </h1>
            <p class="text-xs sm:text-sm text-slate-600 mt-1">
                Sampaikan laporan fasilitas sekolah yang rusak atau perlu perbaikan agar segera ditindaklanjuti.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-5 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs space-y-1">
                @foreach ($errors->all() as $error)
                    <div>&bull; {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-purple-200/70 p-6 sm:p-8 shadow-xs">
            <div class="flex items-center gap-2 text-sm font-extrabold text-purple-950 mb-6">
                <i class="fa-solid fa-pen-to-square text-purple-700"></i>
                <span>Form Pengaduan Sarana &amp; Prasarana</span>
            </div>

            <form action="{{ route('aspirasi.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-bold text-purple-950 mb-2">Kategori Kerusakan</label>
                    <select
                        name="kategori"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-purple-200/90 focus:border-purple-600 focus:ring-2 focus:ring-purple-200 outline-none text-sm bg-white text-slate-700"
                    >
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Fasilitas Kelas" {{ old('kategori') == 'Fasilitas Kelas' ? 'selected' : '' }}>Fasilitas Kelas</option>
                        <option value="Kamar Mandi" {{ old('kategori') == 'Kamar Mandi' ? 'selected' : '' }}>Kamar Mandi</option>
                        <option value="Olahraga" {{ old('kategori') == 'Olahraga' ? 'selected' : '' }}>Olahraga</option>
                        <option value="Jaringan & Listrik" {{ old('kategori') == 'Jaringan & Listrik' ? 'selected' : '' }}>Jaringan &amp; Listrik</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-purple-950 mb-2">Lokasi Kerusakan</label>
                    <input
                        type="text"
                        name="lokasi"
                        value="{{ old('lokasi') }}"
                        placeholder="Contoh: Lab RPL 2, Kelas XI TKJ 1"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-purple-200/90 focus:border-purple-600 focus:ring-2 focus:ring-purple-200 outline-none text-sm text-slate-800 placeholder:text-slate-400"
                    >
                </div>

                <div>
                    <label class="block text-xs font-bold text-purple-950 mb-2">Keterangan Detail Kerusakan</label>
                    <textarea
                        name="deskripsi"
                        rows="4"
                        placeholder="Jelaskan kerusakan secara jelas..."
                        required
                        class="w-full px-4 py-3 rounded-xl border border-purple-200/90 focus:border-purple-600 focus:ring-2 focus:ring-purple-200 outline-none text-sm text-slate-800 placeholder:text-slate-400"
                    >{{ old('deskripsi') }}</textarea>
                </div>

                <div class="pt-1">
                    <button type="submit" class="px-6 py-3 rounded-xl bg-purple-700 hover:bg-purple-800 text-white text-xs font-bold shadow-sm shadow-purple-200 transition">
                        Kirim Pengaduan
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>