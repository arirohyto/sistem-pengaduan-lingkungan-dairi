<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lokasi;
use App\Models\Area;

class LokasiSeeder extends Seeder
{
    public function run()
    {
        $kecamatans = Area::where('level', 'kecamatan')->get();
        
        echo " Found " . $kecamatans->count() . " kecamatan(s)\n";

        // Buat lokasi untuk setiap kecamatan
        foreach ($kecamatans as $kecamatan) {
            // Cek apakah lokasi sudah ada
            $existing = Lokasi::where('name', $kecamatan->name)
                             ->where('area_id', $kecamatan->id)
                             ->first();
            
            if (!$existing) {
                Lokasi::create([
                    'name' => $kecamatan->name,
                    'description' => 'Kecamatan ' . $kecamatan->name . ', Kabupaten Dairi',
                    'area_id' => $kecamatan->id,
                    'type' => 'kawasan',
                    'is_active' => true,
                ]);
                echo " Created lokasi: {$kecamatan->name}\n";
            } else {
                echo " Lokasi {$kecamatan->name} already exists\n";
            }
        }
        
        echo " Lokasi seeder completed successfully!\n";
    }
}