<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SAPA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: linear-gradient(160deg, #f6f4fc 0%, #ede7fb 100%);
            color: #1e1b4b;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-3xl border border-purple-100 shadow-lg shadow-purple-900/5 p-6 sm:p-8 space-y-6">
        <div class="text-center">
            <div class="w-12 h-12 rounded-2xl bg-purple-700 text-white flex items-center justify-center mx-auto shadow-sm shadow-purple-200">
                <i class="fa-regular fa-building text-lg"></i>
            </div>
            <h1 class="text-xl font-extrabold text-purple-950 mt-3">Masuk Sistem SAPA</h1>
            <p class="text-xs text-slate-500 mt-1">Sistem Aspirasi &amp; Pengaduan Sarana Sekolah</p>
        </div>

        @if ($errors->any())
            <div class="p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-700 text-xs font-semibold">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-purple-950 mb-1.5">Email / NIS / Username</label>
                <input
                    id="loginInput"
                    type="text"
                    name="login"
                    value="{{ old('login') }}"
                    placeholder="Contoh: siswa@sapa.sch.id atau 24101"
                    required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none text-sm"
                >
            </div>

            <div>
                <label class="block text-xs font-bold text-purple-950 mb-1.5">Kata Sandi</label>
                <input
                    id="passwordInput"
                    type="password"
                    name="password"
                    placeholder="Masukkan kata sandi"
                    required
                    class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 outline-none text-sm"
                >
            </div>

            <button type="submit" class="w-full py-3 rounded-xl bg-purple-700 hover:bg-purple-800 text-white font-bold text-sm shadow-sm shadow-purple-200 transition">
                Masuk Sistem
            </button>
        </form>

        <!-- Panel Akun Demo -->
        <div class="pt-2 border-t border-purple-100">
            <button
                type="button"
                onclick="toggleDemo()"
                class="w-full flex items-center justify-between px-4 py-2.5 rounded-xl bg-purple-50 hover:bg-purple-100/80 text-purple-900 text-xs font-bold transition"
            >
                <span><i class="fa-solid fa-key mr-1.5 text-purple-700"></i>Akun Demo (klik untuk isi otomatis)</span>
                <i id="demoChevron" class="fa-solid fa-chevron-up text-[10px]"></i>
            </button>

            <div id="demoBox" class="mt-3 space-y-3 text-xs">
                <div>
                    <div class="text-[10px] font-bold tracking-wider text-purple-700 uppercase mb-1.5">Akun Admin</div>
                    <button
                        type="button"
                        onclick="fillLogin('admin', 'admin123')"
                        class="w-full text-left px-3.5 py-2.5 rounded-xl border border-purple-100 bg-purple-50/40 hover:bg-purple-50 flex items-center justify-between transition"
                    >
                        <div>
                            <div class="font-bold text-purple-950">Administrator &bull; <span class="font-normal text-slate-600">Petugas Sarpras</span></div>
                            <div class="text-[11px] text-slate-500">admin / admin123</div>
                        </div>
                        <span class="text-purple-700 font-bold">&rarr;</span>
                    </button>
                </div>

                <div>
                    <div class="text-[10px] font-bold tracking-wider text-slate-500 uppercase mb-1.5">Akun Siswa</div>
                    <div class="space-y-2">
                        <button
                            type="button"
                            onclick="fillLogin('24101', 'siswa123')"
                            class="w-full text-left px-3.5 py-2 rounded-xl border border-purple-100 bg-purple-50/30 hover:bg-purple-50 flex items-center justify-between transition"
                        >
                            <div>
                                <div class="font-bold text-purple-950">Citra Kirana &bull; <span class="font-normal text-slate-600">Siswa Kelas XI RPL 1</span></div>
                                <div class="text-[11px] text-slate-500">24101 / siswa123</div>
                            </div>
                            <span class="text-purple-700 font-bold">&rarr;</span>
                        </button>

                        <button
                            type="button"
                            onclick="fillLogin('24102', 'siswa123')"
                            class="w-full text-left px-3.5 py-2 rounded-xl border border-purple-100 bg-purple-50/30 hover:bg-purple-50 flex items-center justify-between transition"
                        >
                            <div>
                                <div class="font-bold text-purple-950">Bagas Aditya &bull; <span class="font-normal text-slate-600">Siswa Kelas XII TKJ 2</span></div>
                                <div class="text-[11px] text-slate-500">24102 / siswa123</div>
                            </div>
                            <span class="text-purple-700 font-bold">&rarr;</span>
                        </button>

                        <button
                            type="button"
                            onclick="fillLogin('24103', 'siswa123')"
                            class="w-full text-left px-3.5 py-2 rounded-xl border border-purple-100 bg-purple-50/30 hover:bg-purple-50 flex items-center justify-between transition"
                        >
                            <div>
                                <div class="font-bold text-purple-950">Alya Zahra &bull; <span class="font-normal text-slate-600">Siswa Kelas X AKL 1</span></div>
                                <div class="text-[11px] text-slate-500">24103 / siswa123</div>
                            </div>
                            <span class="text-purple-700 font-bold">&rarr;</span>
                        </button>

                        <button
                            type="button"
                            onclick="fillLogin('24104', 'siswa123')"
                            class="w-full text-left px-3.5 py-2 rounded-xl border border-purple-100 bg-purple-50/30 hover:bg-purple-50 flex items-center justify-between transition"
                        >
                            <div>
                                <div class="font-bold text-purple-950">Fajar Nugroho &bull; <span class="font-normal text-slate-600">Siswa Kelas XI MM 1</span></div>
                                <div class="text-[11px] text-slate-500">24104 / siswa123</div>
                            </div>
                            <span class="text-purple-700 font-bold">&rarr;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center pt-1">
            <a href="{{ url('/') }}" class="text-xs text-slate-500 hover:text-purple-700 font-medium">
                &larr; Kembali ke Beranda
            </a>
        </div>
    </div>

    <script>
        function toggleDemo() {
            const box = document.getElementById('demoBox');
            const icon = document.getElementById('demoChevron');
            box.classList.toggle('hidden');
            icon.classList.toggle('fa-chevron-up');
            icon.classList.toggle('fa-chevron-down');
        }

        function fillLogin(loginVal, passVal) {
            document.getElementById('loginInput').value = loginVal;
            document.getElementById('passwordInput').value = passVal;
        }
    </script>
</body>
</html>