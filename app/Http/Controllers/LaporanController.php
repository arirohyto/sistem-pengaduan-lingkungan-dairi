<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Lokasi;
use App\Models\LampiranLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function create()
    {
        $lokasis = Lokasi::with('area')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('pages.buatlaporan', compact('lokasis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_laporan' => 'required|in:sampah,lingkungan',
            'location_id' => 'required|exists:lokasi,id',
            'title' => 'required|string|max:200',
            'description' => 'required|string|min:20',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'photos' => 'required|array|min:1|max:3',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
        ], [
            'jenis_laporan.required' => 'Pilih jenis laporan',
            'location_id.required' => 'Pilih lokasi kejadian',
            'location_id.exists' => 'Lokasi tidak valid',
            'title.required' => 'Judul laporan wajib diisi',
            'title.max' => 'Judul maksimal 200 karakter',
            'description.required' => 'Deskripsi laporan wajib diisi',
            'description.min' => 'Deskripsi minimal 20 karakter',
            'photos.required' => 'Minimal 1 foto bukti harus diunggah.',
            'photos.array' => 'Foto bukti tidak valid.',
            'photos.min' => 'Minimal 1 foto bukti harus diunggah.',
            'photos.max' => 'Maksimal 3 foto bukti yang dapat diunggah.',
            'photos.*.image' => 'File harus berupa gambar',
            'photos.*.mimes' => 'Format gambar: jpeg, png, jpg',
            'photos.*.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Ambil lokasi untuk mendapatkan area_id
        $lokasi = Lokasi::findOrFail($validated['location_id']);

        // Buat laporan
        $laporan = Laporan::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'jenis_laporan' => $validated['jenis_laporan'],
            'location_id' => $validated['location_id'],
            'area_id' => $lokasi->area_id,
            'reporter_id' => Auth::id(),
            'reporter_name' => Auth::user()->name,
            'reporter_email' => $validated['email'] ?? Auth::user()->email,
            'reporter_phone' => $validated['phone'] ?? Auth::user()->phone,
            'status' => 'pending',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $photo) {
                if ($index >= 3) break; // Maksimal 3 foto

                $filename = $laporan->code . '_' . ($index + 1) . '.' . $photo->getClientOriginalExtension();
                $path = $photo->storeAs('laporan', $filename, 'public');

                LampiranLaporan::create([
                    'report_id' => $laporan->id,                    
                    'file_path' => $path,                             
                    'file_name' => $filename,                       
                    'mime_type' => $photo->getMimeType(),           
                    'file_size' => $photo->getSize(),
                ]);
            }
        }
        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dikirim dengan kode: ' . $laporan->code);
    }

    public function index()
    {
        $laporan = Laporan::with(['location', 'area'])
            ->when(Auth::check(), function ($q) {
                $q->where('reporter_id', Auth::id());
            })
            ->latest()
            ->paginate(20);

        return view('pages.laporansaya', compact('laporan'));
    }

    public function show($reportCode)
    {
        $laporan = Laporan::with(['location', 'area', 'lampiran', 'riwayatStatus.user'])
            ->where('code', $reportCode)
            ->firstOrFail();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Check authorization
        if (!$user) {
        abort(403, 'Anda tidak memiliki akses ke laporan ini.');
        }

    if (!$user->isAdmin() && (int) $laporan->reporter_id !== (int) $user->id) {
        abort(403, 'Anda tidak memiliki akses ke laporan ini.');
    }

        return view('pages.detaillaporan', compact('laporan'));
    }
}