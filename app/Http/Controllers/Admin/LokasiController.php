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
        $areas = Area::kecamatan()->get();

        return view('admin.lokasi.index', compact('lokasis', 'areas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'area_id' => 'required|exists:area,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'type' => 'required|in:tps,sungai,pasar,kawasan,lainnya',
            'is_active' => 'boolean',
        ]);

        Lokasi::create($validated);

        return back()->with('success', 'Lokasi berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'area_id' => 'required|exists:area,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'type' => 'required|in:tps,sungai,pasar,kawasan,lainnya',
            'is_active' => 'boolean',
        ]);

        $lokasi = Lokasi::findOrFail($id);
        $lokasi->update($validated);

        return back()->with('success', 'Lokasi berhasil diupdate!');
    }

    public function destroy($id)
    {
        $lokasi = Lokasi::findOrFail($id);
        $lokasi->delete(); // Soft delete

        return back()->with('success', 'Lokasi berhasil dihapus!');
    }
}