<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    public function run()
    {
        // Cek apakah Kabupaten Dairi sudah ada
        $dairi = Area::where('name', 'Kabupaten Dairi')->where('level', 'kabupaten')->first();

        if (!$dairi) {
            // Buat Kabupaten Dairi jika belum ada
            $dairi = Area::create([
                'name' => 'Kabupaten Dairi',
                'level' => 'kabupaten',
                'parent_id' => null,
            ]);
            echo " Created Kabupaten Dairi\n";
        } else {
            echo " Kabupaten Dairi already exists\n";
        }

        // 15 Kecamatan lengkap di Dairi
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
            // Cek apakah kecamatan sudah ada
            $existing = Area::where('name', $kecamatan)
                ->where('level', 'kecamatan')
                ->where('parent_id', $dairi->id)
                ->first();

            if (!$existing) {
                Area::create([
                    'name' => $kecamatan,
                    'level' => 'kecamatan',
                    'parent_id' => $dairi->id,
                ]);
                echo " Created kecamatan: {$kecamatan}\n";
            } else {
                echo " Kecamatan {$kecamatan} already exists\n";
            }
        }

        echo "🎉 Area seeder completed successfully!\n";
    }
}