<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    public function run(): void
    {
        // Kabupaten Dairi
        $dairi = Area::create([
            'name' => 'Kabupaten Dairi',
            'level' => 'kabupaten',
        ]);

        // Kecamatan-kecamatan di Dairi
        $kecamatans = [
            'Sidikalang' => ['Siempat Rube', 'Pasar Sidikalang', 'Tanjung Beringin'],
            'Parbuluan' => ['Parbuluan I', 'Parbuluan II', 'Parbuluan III'],
            'Silima Pungga-Pungga' => ['Silima I', 'Silima II'],
            'STM Hilir' => ['Salak', 'Tanjung Muda'],
            'Sumbul' => ['Sumbul', 'Gunung Meriah'],
        ];

        foreach ($kecamatans as $kecName => $desas) {
            $kec = Area::create([
                'name' => $kecName,
                'level' => 'kecamatan',
                'parent_id' => $dairi->id,
            ]);

            // Desa/Kelurahan
            foreach ($desas as $desa) {
                Area::create([
                    'name' => $desa,
                    'level' => 'desa',
                    'parent_id' => $kec->id,
                ]);
            }
        }
    }
}