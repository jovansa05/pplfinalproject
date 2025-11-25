<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Sampah & Kebersihan',
                'description' => 'Laporan terkait penumpukan sampah, tempat sampah rusak atau penuh, sampah berserakan di ruang publik, bau tidak sedap dari TPA, dll.',
            ],
            [
                'name' => 'Jalan & Infrastruktur',
                'description' => 'Jalan rusak, berlubang, retak, trotoar rusak, pagar pembatas jalan rusak, rambu lalu lintas hilang atau rusak.',
            ],
            [
                'name' => 'Lampu Jalan',
                'description' => 'Lampu penerangan jalan mati, rusak, redup, atau tiang lampu roboh/miring.',
            ],
            [
                'name' => 'Drainase & Banjir',
                'description' => 'Saluran air tersumbat, got mampet, banjir saat hujan, genangan air berhari-hari, saluran rusak.',
            ],
            [
                'name' => 'Taman & Ruang Hijau',
                'description' => 'Taman kota tidak terawat, rumput liar tinggi, pohon tumbang atau ranting berbahaya, fasilitas taman rusak.',
            ],
            [
                'name' => 'Fasilitas Umum',
                'description' => 'Halte rusak, toilet umum kotor/rusak, papan informasi rusak, bangku taman hilang/rusak, pedestrian rusak.',
            ],
            [
                'name' => 'Air Bersih',
                'description' => 'Pipa PDAM bocor, tidak ada aliran air, air keruh atau berbau, hydrant umum rusak.',
            ],
            [
                'name' => 'Polusi & Lingkungan',
                'description' => 'Polusi udara, asap pabrik berlebihan, polusi air sungai, pencemaran tanah, bau tidak sedap dari limbah.',
            ],
            [
                'name' => 'Vandalisme',
                'description' => 'Coret-coret di fasilitas umum, fasilitas dirusak, graffiti ilegal, kerusakan properti publik.',
            ],
            [
                'name' => 'Keamanan Publik',
                'description' => 'Area gelap tanpa penerangan, jalanan sepi rawan kriminal, CCTV rusak, pagar rumah kosong rusak.',
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'description' => $category['description'],
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}