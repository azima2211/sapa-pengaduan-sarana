<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    private function isAdmin(): bool
    {
        $user = Auth::user();

        if (! $user) {
            return false;
        }

        return str_contains(strtolower($user->email), 'admin') || strtolower((string) ($user->role ?? '')) === 'admin';
    }

    public function dashboard()
    {
        $isAdmin = $this->isAdmin();

        // Siswa diarahkan ke halaman Buat Pengaduan khusus siswa
        if (! $isAdmin) {
            return redirect()->route('aspirasi.create');
        }

        // Dashboard Admin tetap seperti semula
        $totalAspirasi = Aspirasi::count();
        $menunggu = Aspirasi::where('status', 'menunggu')->count();
        $diproses = Aspirasi::where('status', 'diproses')->count();
        $selesai = Aspirasi::where('status', 'selesai')->count();

        $persenSelesai = $totalAspirasi > 0 ? round(($selesai / $totalAspirasi) * 100, 1) : 0;

        $daftarKategori = [
            ['nama' => 'Fasilitas Kelas', 'ikon' => 'fa-regular fa-building'],
            ['nama' => 'Kamar Mandi', 'ikon' => 'fa-solid fa-droplet'],
            ['nama' => 'Olahraga', 'ikon' => 'fa-solid fa-basketball'],
            ['nama' => 'Jaringan & Listrik', 'ikon' => 'fa-solid fa-wifi'],
        ];

        $distribusiKategori = collect($daftarKategori)->map(function ($item) use ($totalAspirasi) {
            $jumlah = Aspirasi::where('kategori', $item['nama'])->count();
            $persen = $totalAspirasi > 0 ? round(($jumlah / $totalAspirasi) * 100) : 0;

            return [
                'nama' => $item['nama'],
                'ikon' => $item['ikon'],
                'jumlah' => $jumlah,
                'persen' => $persen,
            ];
        });

        return view('dashboard', compact(
            'totalAspirasi',
            'menunggu',
            'diproses',
            'selesai',
            'persenSelesai',
            'distribusiKategori',
            'isAdmin'
        ));
    }

    public function create()
    {
        if ($this->isAdmin()) {
            return redirect()->route('aspirasi.admin');
        }

        return view('aspirasi.create_siswa');
    }

    public function store(Request $request)
    {
        if ($this->isAdmin()) {
            return redirect()->route('aspirasi.admin')->with('error', 'Admin tidak menggunakan form pengaduan.');
        }

        $validated = $request->validate([
            'judul'     => ['nullable', 'string', 'max:255'],
            'kategori'  => ['required', 'string', 'max:100'],
            'lokasi'    => ['required', 'string', 'max:255'],
            'deskripsi' => ['required', 'string'],
            'foto'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        $pathFoto = null;
        if ($request->hasFile('foto')) {
            $pathFoto = $request->file('foto')->store('aspirasi', 'public');
        }

        $judulFix = ! empty($validated['judul'])
            ? $validated['judul']
            : $validated['kategori'] . ' - ' . $validated['lokasi'];

        Aspirasi::create([
            'user_id'   => Auth::id(),
            'judul'     => $judulFix,
            'kategori'  => $validated['kategori'],
            'lokasi'    => $validated['lokasi'],
            'deskripsi' => $validated['deskripsi'],
            'foto'      => $pathFoto,
            'status'    => 'menunggu',
        ]);

        return redirect()->route('aspirasi.riwayat')->with('success', 'Laporan pengaduan berhasil dikirim!');
    }

    public function riwayat()
    {
        $isAdmin = $this->isAdmin();

        // Admin melihat semua laporan siswa, sedangkan siswa melihat laporannya sendiri
        if ($isAdmin) {
            $aspirasis = Aspirasi::with('user')->latest()->get();
        } else {
            $aspirasis = Aspirasi::where('user_id', Auth::id())->latest()->get();
        }

        $totalLaporan = $aspirasis->count();
        $sedangDiproses = $aspirasis->where('status', 'diproses')->count();
        $selesai = $aspirasis->where('status', 'selesai')->count();

        return view('aspirasi.riwayat', compact(
            'aspirasis',
            'isAdmin',
            'totalLaporan',
            'sedangDiproses',
            'selesai'
        ));
    }

    public function indexAdmin()
    {
        if (! $this->isAdmin()) {
            return redirect()->route('dashboard')->with('error', 'Halaman Kelola Aspirasi hanya untuk Administrator.');
        }

        $aspirasis = Aspirasi::with('user')->latest()->get();
        $isAdmin = true;

        return view('aspirasi.admin', compact('aspirasis', 'isAdmin'));
    }

    public function updateStatus(Request $request, Aspirasi $aspirasi)
    {
        if (! $this->isAdmin()) {
            return redirect()->route('dashboard')->with('error', 'Hanya Administrator yang dapat mengubah status.');
        }

        $validated = $request->validate([
            'status'    => ['required', 'in:menunggu,diproses,selesai'],
            'tanggapan' => ['nullable', 'string'],
        ]);

        $aspirasi->update($validated);

        return back()->with('success', 'Status dan tanggapan laporan berhasil diperbarui.');
    }
}