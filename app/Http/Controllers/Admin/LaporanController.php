<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Lokasi;
use App\Models\RiwayatPerubahanStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::with(['location', 'area', 'reporter']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by jenis_laporan
        if ($request->filled('jenis_laporan')) {
            $query->where('jenis_laporan', $request->jenis_laporan);
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('code', 'like', "%{$request->search}%")
                    ->orWhere('title', 'like', "%{$request->search}%")
                    ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        $laporan = $query->latest()->paginate(20);

        return view('admin.laporan.index', compact('laporan'));
    }

    public function show($id)
    {
        $laporan = Laporan::with([
            'location',
            'area',
            'reporter',
            'lampiran',
            'riwayatStatus.user'
        ])->findOrFail($id);

        return view('admin.laporan.show', compact('laporan'));
    }

    public function updateStatus(Request $request)
    {
        $validated = $request->validate([
            'report_id' => 'required|exists:laporan,id',
            'status' => 'required|in:pending,diproses,selesai,ditolak',
            'notes' => 'nullable|string',
        ]);

        $laporan = Laporan::findOrFail($validated['report_id']);
        $oldStatus = $laporan->status;

        // Update status
        $laporan->update(['status' => $validated['status']]);

        // Record history
        RiwayatPerubahanStatus::create([
            'report_id' => $laporan->id,
            'from_status' => $oldStatus,
            'to_status' => $validated['status'],
            'note' => $validated['notes'] ?? null,
            'changed_by' => Auth::id(),
        ]);

        return back()->with('success', 'Status laporan berhasil diubah!');
    }

    public function getFilterData()
    {
        // Data untuk dropdown filter di admin
        $statusOptions = [
            'pending' => 'Menunggu',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak'
        ];

        $jenisOptions = [
            'sampah' => 'Sampah',
            'lingkungan' => 'Lingkungan Hidup'
        ];

        return compact('statusOptions', 'jenisOptions');
    }

    public function destroy($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete(); // Soft delete

        return redirect()
            ->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus!');
    }
}
