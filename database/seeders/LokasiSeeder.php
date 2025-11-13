<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lokasi;

class LokasiSeeder extends Seeder
{
    public function run()
    {
        $kecamatans = [
            'Berampu',
            'Gunung Sitember', 
            'Lae Parira',
            'Parbuluan',
            'Pegagan Hilir',
            'Sidikalang',
            'Siempat Nempu',
            'Siempat Nempu Hilir',
            'Siempat Nempu Hulu',
            'Silahisabungan',
            'Silima Pungga Pungga',
            'Sitinjo',
            'Sumbul',
            'Tanah Pinem',
            'Tigalingga'
        ];

        foreach ($kecamatans as $kecamatan) {
            Lokasi::create([
                'name' => $kecamatan,
                'area_id' => 1, // Kabupaten Dairi
                'is_active' => true,
            ]);
        }
    }
}