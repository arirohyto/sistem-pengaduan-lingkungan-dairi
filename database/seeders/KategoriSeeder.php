<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sampah',
                'children' => [
                    'Sampah Ilegal',
                    'Penumpukan Sampah',
                    'Pembakaran Sampah',
                    'TPS Bermasalah',
                ]
            ],
            [
                'name' => 'Lingkungan',
                'children' => [
                    'Pencemaran Air',
                    'Pencemaran Udara',
                    'Pencemaran Tanah',
                    'Kerusakan Hutan',
                    'Penebangan Liar',
                ]
            ],
        ];

        foreach ($categories as $cat) {
            $parent = Kategori::create([
                'name' => $cat['name'],
                'slug' => Str::slug($cat['name']),
                'is_active' => true,
            ]);

            foreach ($cat['children'] as $child) {
                Kategori::create([
                    'name' => $child,
                    'slug' => Str::slug($child),
                    'parent_id' => $parent->id,
                    'is_active' => true,
                ]);
            }
        }
    }
}