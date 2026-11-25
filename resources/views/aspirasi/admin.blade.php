<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Aspirasi - SAPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f7f4fc;
            color: #1e1b4b;
        }
    </style>
</head>
<body class="min-h-screen flex bg-[#f7f4fc] text-slate-800">

    <!-- Sidebar -->
    <aside class="hidden lg:flex w-64 shrink-0 bg-white border-r border-purple-100 flex-col justify-between">
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

            <!-- Navigation -->
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
                            <a href="{{ route('aspirasi.admin') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl bg-purple-700 text-white font-semibold shadow-sm shadow-purple-200">
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
                            <a href="{{ route('aspirasi.riwayat') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-slate-600 hover:bg-purple-50 hover:text-purple-800 font-medium transition">
                                <i class="fa-solid fa-clock-rotate-left w-4 text-center text-xs"></i>
                                <span>Riwayat &amp; Status</span>
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
                    <span>Keluar Sesi</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Area -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Top Bar -->
        <header class="h-16 bg-white/80 backdrop-blur border-b border-purple-100 px-4 sm:px-7 flex items-center justify-between sticky top-0 z-20">
            <a href="{{ route('dashboard') }}" class="text-xs font-semibold text-purple-700 hover:text-purple-900">
                &larr; Kembali ke Dashboard
            </a>

            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-white border border-purple-100 shadow-2xs text-xs font-bold text-purple-950">
                <i class="fa-solid fa-user-shield text-purple-700 text-[11px]"></i>
                <span>{{ auth()->user()->name ?? 'Admin' }}</span>
            </div>
        </header>

        <main class="flex-1 p-4 sm:p-7 max-w-6xl w-full mx-auto space-y-5">
            <!-- Page Title -->
            <div>
                <h1 class="text-2xl font-extrabold text-purple-950 tracking-tight">Kelola Aspirasi</h1>
                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">Manajemen data pengaduan masuk dan pemantauan perbaikan fasilitas.</p>
            </div>

            @if (session('success'))
                <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-semibold">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Filter Bar -->
            <form action="{{ route('aspirasi.admin') }}" method="GET" class="bg-white rounded-2xl border border-purple-100 p-3.5 shadow-2xs">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 items-center">
                    <div class="md:col-span-5 relative">
                        <i class="fa-solid fa-magnifying-glass text-slate-400 text-xs absolute left-3.5 top-1/2 -translate-y-1/2"></i>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari ID/NIS, Nama Siswa, atau Lokasi..."
                            class="w-full pl-9 pr-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-700 focus:outline-none focus:border-purple-400"
                        >
                    </div>

                    <div class="md:col-span-2">
                        <select name="kategori" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-700 bg-white focus:outline-none focus:border-purple-400">
                            <option value="semua">Semua Kategori</option>
                            @foreach (['Fasilitas Kelas', 'Kamar Mandi', 'Olahraga', 'Jaringan & Listrik', 'Kebersihan', 'Infrastruktur IT', 'Meubelair'] as $kat)
                                <option value="{{ $kat }}" {{ request('kategori') === $kat ? 'selected' : '' }}>{{ $kat }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <select name="status" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-700 bg-white focus:outline-none focus:border-purple-400">
                            <option value="semua">Semua Status</option>
                            <option value="menunggu" {{ request('status') === 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="diproses" {{ request('status') === 'diproses' ? 'selected' : '' }}>Proses</option>
                            <option value="selesai" {{ request('status') === 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <input
                            type="date"
                            name="tanggal"
                            value="{{ request('tanggal') }}"
                            class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs text-slate-700 focus:outline-none focus:border-purple-400"
                        >
                    </div>

                    <div class="md:col-span-1 flex gap-1.5">
                        <button type="submit" class="w-full py-2 px-3 rounded-xl bg-purple-700 hover:bg-purple-800 text-white text-xs font-bold transition">
                            Filter
                        </button>
                    </div>
                </div>
            </form>

            <!-- Table Card -->
            <div class="bg-white rounded-2xl border border-purple-100 shadow-2xs overflow-hidden">
                <div class="px-5 py-4 border-b border-purple-100 flex items-center justify-between gap-3">
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-clipboard text-purple-700 text-sm"></i>
                        <h2 class="text-sm font-extrabold text-purple-950">Daftar Aspirasi &amp; Pengaduan Siswa</h2>
                    </div>
                    <span class="px-3 py-1 rounded-full bg-purple-50 text-purple-800 text-xs font-bold">
                        Total Data: {{ $totalData ?? $aspirasis->count() }}
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-purple-100 text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-purple-50/30">
                                <th class="py-3.5 px-5">ID</th>
                                <th class="py-3.5 px-4">Tanggal</th>
                                <th class="py-3.5 px-4">Pelapor (Siswa)</th>
                                <th class="py-3.5 px-4">Kategori &amp; Lokasi</th>
                                <th class="py-3.5 px-4">Status</th>
                                <th class="py-3.5 px-5 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-purple-100/70 text-xs">
                            @forelse ($aspirasis as $item)
                                @php
                                    $pelapor = $item->user;
                                    $namaPelapor = $pelapor->name ?? 'Pelapor';
                                    $words = preg_split('/\s+/', trim($namaPelapor));
                                    $inisial = strtoupper(substr($words[0] ?? 'S', 0, 1) . substr($words[1] ?? ($words[0] ?? ''), 0, 1));
                                    $kodeId = 'RPT-' . str_pad((string) $item->id, 4, '0', STR_PAD_LEFT);

                                    $statusStyle = match($item->status) {
                                        'selesai' => ['bg' => 'bg-emerald-50 text-emerald-700 border-emerald-200', 'dot' => 'bg-emerald-500', 'label' => 'Selesai'],
                                        'diproses' => ['bg' => 'bg-purple-50 text-purple-700 border-purple-200', 'dot' => 'bg-purple-600', 'label' => 'Proses'],
                                        default => ['bg' => 'bg-amber-50 text-amber-700 border-amber-200', 'dot' => 'bg-amber-500', 'label' => 'Menunggu'],
                                    };
                                @endphp
                                <tr class="hover:bg-purple-50/30 transition align-top">
                                    <td class="py-4 px-5 font-extrabold text-purple-950 whitespace-nowrap">
                                        {{ $kodeId }}
                                    </td>

                                    <td class="py-4 px-4 text-slate-600 whitespace-nowrap leading-relaxed">
                                        <div>{{ $item->created_at->format('d M') }}</div>
                                        <div>{{ $item->created_at->format('Y') }}</div>
                                    </td>

                                    <td class="py-4 px-4">
                                        <div class="flex items-start gap-2.5">
                                            <div class="w-8 h-8 rounded-full bg-purple-100 text-purple-700 font-bold text-[11px] flex items-center justify-center shrink-0 mt-0.5">
                                                {{ $inisial }}
                                            </div>
                                            <div class="leading-snug">
                                                <div class="font-bold text-purple-950">{{ $namaPelapor }}</div>
                                                <div class="text-[11px] text-slate-400">
                                                    ID/NIS: {{ $pelapor->nis ?? $pelapor->id ?? '-' }}
                                                    @if (!empty($pelapor->kelas))
                                                        &bull; Kelas: {{ $pelapor->kelas }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="py-4 px-4 max-w-xs">
                                        <div class="font-extrabold text-purple-950">{{ $item->kategori }}</div>
                                        <div class="text-[11px] text-slate-500 mt-0.5 flex items-center gap-1">
                                            <i class="fa-solid fa-location-dot text-purple-500 text-[10px]"></i>
                                            <span>{{ $item->lokasi }}</span>
                                        </div>
                                        <p class="text-slate-600 mt-1 line-clamp-2">{{ $item->deskripsi }}</p>
                                    </td>

                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full border text-[11px] font-bold {{ $statusStyle['bg'] }}">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $statusStyle['dot'] }}"></span>
                                            {{ $statusStyle['label'] }}
                                        </span>
                                    </td>

                                    <td class="py-4 px-5 text-right whitespace-nowrap">
                                        <div class="inline-flex items-center gap-2">
                                            <button
                                                type="button"
                                                onclick="openKelolaModal({{ $item->id }})"
                                                class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-white border border-purple-200 text-purple-700 hover:bg-purple-50 font-semibold text-xs transition"
                                            >
                                                <i class="fa-regular fa-pen-to-square text-[11px]"></i>
                                                <span>Kelola</span>
                                            </button>

                                            <button
                                                type="button"
                                                onclick="openKelolaModal({{ $item->id }})"
                                                title="Detail &amp; Tanggapan"
                                                class="w-8 h-8 rounded-xl bg-purple-50 hover:bg-purple-100 text-purple-700 inline-flex items-center justify-center transition"
                                            >
                                                <i class="fa-regular fa-eye text-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-10 px-5 text-center">
                                        <p class="text-sm font-bold text-purple-950">Belum ada aspirasi yang masuk</p>
                                        <p class="text-xs text-slate-500 mt-1">Laporan dari siswa akan muncul di tabel ini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal Kelola Status & Tanggapan -->
    <div id="kelolaModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 p-4">
        <div class="bg-white rounded-2xl border border-purple-100 max-w-lg w-full p-6 shadow-xl space-y-4">
            <div class="flex items-start justify-between gap-3 border-b border-purple-100 pb-3">
                <div>
                    <div id="modalKode" class="text-[11px] font-bold text-purple-700 uppercase"></div>
                    <h3 id="modalJudul" class="text-base font-extrabold text-purple-950"></h3>
                    <p id="modalMeta" class="text-xs text-slate-500 mt-0.5"></p>
                </div>
                <button type="button" onclick="closeKelolaModal()" class="text-slate-400 hover:text-slate-700 text-sm">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="space-y-2">
                <div class="text-[11px] font-bold uppercase text-slate-400">Keterangan Laporan</div>
                <p id="modalDeskripsi" class="text-xs text-slate-700 bg-purple-50/50 p-3 rounded-xl border border-purple-100"></p>
            </div>

            <div id="modalFotoWrap" class="hidden">
                <img id="modalFoto" src="" alt="Foto bukti" class="w-44 h-32 object-cover rounded-xl border border-purple-100">
            </div>

            <form id="kelolaForm" method="POST" class="space-y-3 pt-2">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Status</label>
                    <select id="modalStatus" name="status" class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs font-semibold bg-white">
                        <option value="menunggu">Menunggu</option>
                        <option value="diproses">Proses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-slate-500 uppercase mb-1">Tanggapan Admin</label>
                    <input
                        id="modalTanggapan"
                        type="text"
                        name="tanggapan"
                        placeholder="Tulis catatan atau progres perbaikan..."
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs"
                    >
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" onclick="closeKelolaModal()" class="px-4 py-2 rounded-xl border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 rounded-xl bg-purple-700 hover:bg-purple-800 text-white text-xs font-bold transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const dataAspirasi = @json($aspirasiModalData ?? []);
    </script>

    @php
        $aspirasiModalData = $aspirasis->mapWithKeys(function ($item) {
            return [
                $item->id => [
                    'kode' => 'RPT-' . str_pad((string) $item->id, 4, '0', STR_PAD_LEFT),
                    'judul' => $item->judul,
                    'pelapor' => $item->user->name ?? 'Pelapor',
                    'kategori' => $item->kategori,
                    'lokasi' => $item->lokasi,
                    'deskripsi' => $item->deskripsi,
                    'status' => $item->status,
                    'tanggapan' => $item->tanggapan ?? '',
                    'foto' => $item->foto ? asset('storage/' . $item->foto) : null,
                    'action' => route('aspirasi.update', $item),
                ],
            ];
        });
    @endphp

    <script>
        const modalItems = @json($aspirasiModalData);

        function openKelolaModal(id) {
            const item = modalItems[id];
            if (!item) return;

            document.getElementById('modalKode').textContent = item.kode;
            document.getElementById('modalJudul').textContent = item.judul;
            document.getElementById('modalMeta').textContent = `${item.pelapor} • ${item.kategori} • ${item.lokasi}`;
            document.getElementById('modalDeskripsi').textContent = item.deskripsi;
            document.getElementById('modalStatus').value = item.status;
            document.getElementById('modalTanggapan').value = item.tanggapan;
            document.getElementById('kelolaForm').action = item.action;

            const fotoWrap = document.getElementById('modalFotoWrap');
            const fotoImg = document.getElementById('modalFoto');
            if (item.foto) {
                fotoImg.src = item.foto;
                fotoWrap.classList.remove('hidden');
            } else {
                fotoImg.src = '';
                fotoWrap.classList.add('hidden');
            }

            const modal = document.getElementById('kelolaModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeKelolaModal() {
            const modal = document.getElementById('kelolaModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>
</html>