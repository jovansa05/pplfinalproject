<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    public function run(): void
    {
        $kecamatans = [
            'Asemrowo', 'Benowo', 'Bubutan', 'Bulak', 'Dukuh Pakis',
            'Gayungan', 'Genteng', 'Gubeng', 'Gunung Anyar', 'Jambangan',
            'Karang Pilang', 'Kenjeran', 'Krembangan', 'Lakarsantri', 'Mulyorejo',
            'Pabean Cantian', 'Pakal', 'Rungkut', 'Sambikerep', 'Sawahan',
            'Semampir', 'Simokerto', 'Sukolilo', 'Sukomanunggal', 'Tambaksari',
            'Tandes', 'Tegalsari', 'Tenggilis Mejoyo', 'Wiyung', 'Wonocolo',
            'Wonokromo'
        ];

        foreach ($kecamatans as $kecamatan) {
            DB::table('kecamatans')->insert([
                'name' => $kecamatan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}