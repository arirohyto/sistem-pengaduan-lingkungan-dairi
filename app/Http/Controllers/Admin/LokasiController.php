<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    public function index()
    {
        $lokasis = Lokasi::with('area')->latest()->paginate(20);

        return view('admin.lokasi.index', compact('lokasis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // Set default values
        $validated['area_id'] = 1; // Default ke Kabupaten Dairi
        $validated['type'] = 'kawasan';
        $validated['address'] = null;
        $validated['latitude'] = null;
        $validated['longitude'] = null;

        Lokasi::create($validated);

        return back()->with('success', 'Kecamatan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update($validated);

        return back()->with('success', 'Kecamatan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete(); // Soft delete

        return back()->with('success', 'Lokasi berhasil dihapus!');
    }
}
