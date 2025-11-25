<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelurahanSeeder extends Seeder
{
    public function run(): void
    {
        $kelurahans = [
            // Kecamatan Asemrowo (1)
            ['kecamatan_id' => 1, 'name' => 'Asemrowo'],
            ['kecamatan_id' => 1, 'name' => 'Genting Kalianak'],
            ['kecamatan_id' => 1, 'name' => 'Greges'],
            ['kecamatan_id' => 1, 'name' => 'Kalianak'],

            // Kecamatan Benowo (2)
            ['kecamatan_id' => 2, 'name' => 'Benowo'],
            ['kecamatan_id' => 2, 'name' => 'Kandangan'],
            ['kecamatan_id' => 2, 'name' => 'Romokalisari'],
            ['kecamatan_id' => 2, 'name' => 'Sememi'],
            ['kecamatan_id' => 2, 'name' => 'Tambak Osowilangun'],

            // Kecamatan Bubutan (3)
            ['kecamatan_id' => 3, 'name' => 'Alun-Alun Contong'],
            ['kecamatan_id' => 3, 'name' => 'Bubutan'],
            ['kecamatan_id' => 3, 'name' => 'Gundih'],
            ['kecamatan_id' => 3, 'name' => 'Jepara'],
            ['kecamatan_id' => 3, 'name' => 'Tembok Dukuh'],

            // Kecamatan Bulak (4)
            ['kecamatan_id' => 4, 'name' => 'Bulak'],
            ['kecamatan_id' => 4, 'name' => 'Kenjeran'],
            ['kecamatan_id' => 4, 'name' => 'Kedung Cowek'],
            ['kecamatan_id' => 4, 'name' => 'Sukolilo Baru'],

            // Kecamatan Dukuh Pakis (5)
            ['kecamatan_id' => 5, 'name' => 'Dukuh Kupang'],
            ['kecamatan_id' => 5, 'name' => 'Dukuh Pakis'],
            ['kecamatan_id' => 5, 'name' => 'Gunung Sari'],
            ['kecamatan_id' => 5, 'name' => 'Pradah Kali Kendal'],

            // Kecamatan Gayungan (6)
            ['kecamatan_id' => 6, 'name' => 'Dukuh Menanggal'],
            ['kecamatan_id' => 6, 'name' => 'Gayungan'],
            ['kecamatan_id' => 6, 'name' => 'Ketintang'],
            ['kecamatan_id' => 6, 'name' => 'Menanggal'],

            // Kecamatan Genteng (7)
            ['kecamatan_id' => 7, 'name' => 'Embong Kaliasin'],
            ['kecamatan_id' => 7, 'name' => 'Genteng'],
            ['kecamatan_id' => 7, 'name' => 'Kapasari'],
            ['kecamatan_id' => 7, 'name' => 'Ketabang'],
            ['kecamatan_id' => 7, 'name' => 'Peneleh'],

            // Kecamatan Gubeng (8)
            ['kecamatan_id' => 8, 'name' => 'Airlangga'],
            ['kecamatan_id' => 8, 'name' => 'Barata Jaya'],
            ['kecamatan_id' => 8, 'name' => 'Gubeng'],
            ['kecamatan_id' => 8, 'name' => 'Kertajaya'],
            ['kecamatan_id' => 8, 'name' => 'Mojo'],
            ['kecamatan_id' => 8, 'name' => 'Pucang Sewu'],

            // Kecamatan Gunung Anyar (9)
            ['kecamatan_id' => 9, 'name' => 'Gunung Anyar'],
            ['kecamatan_id' => 9, 'name' => 'Gunung Anyar Tambak'],
            ['kecamatan_id' => 9, 'name' => 'Rungkut Menanggal'],
            ['kecamatan_id' => 9, 'name' => 'Rungkut Tengah'],

            // Kecamatan Jambangan (10)
            ['kecamatan_id' => 10, 'name' => 'Jambangan'],
            ['kecamatan_id' => 10, 'name' => 'Karah'],
            ['kecamatan_id' => 10, 'name' => 'Kebonsari'],
            ['kecamatan_id' => 10, 'name' => 'Pagesangan'],

            // Kecamatan Karang Pilang (11)
            ['kecamatan_id' => 11, 'name' => 'Karang Pilang'],
            ['kecamatan_id' => 11, 'name' => 'Kedurus'],
            ['kecamatan_id' => 11, 'name' => 'Kebraon'],
            ['kecamatan_id' => 11, 'name' => 'Warugunung'],

            // Kecamatan Kenjeran (12)
            ['kecamatan_id' => 12, 'name' => 'Bulak Banteng'],
            ['kecamatan_id' => 12, 'name' => 'Kenjeran'],
            ['kecamatan_id' => 12, 'name' => 'Sidotopo Wetan'],
            ['kecamatan_id' => 12, 'name' => 'Tanah Kali Kedinding'],

            // Kecamatan Krembangan (13)
            ['kecamatan_id' => 13, 'name' => 'Dupak'],
            ['kecamatan_id' => 13, 'name' => 'Kemayoran'],
            ['kecamatan_id' => 13, 'name' => 'Krembangan Selatan'],
            ['kecamatan_id' => 13, 'name' => 'Morokrembangan'],
            ['kecamatan_id' => 13, 'name' => 'Perak Barat'],

            // Kecamatan Lakarsantri (14)
            ['kecamatan_id' => 14, 'name' => 'Bangkingan'],
            ['kecamatan_id' => 14, 'name' => 'Jeruk'],
            ['kecamatan_id' => 14, 'name' => 'Lakarsantri'],
            ['kecamatan_id' => 14, 'name' => 'Lidah Kulon'],
            ['kecamatan_id' => 14, 'name' => 'Lidah Wetan'],
            ['kecamatan_id' => 14, 'name' => 'Sumur Welut'],

            // Kecamatan Mulyorejo (15)
            ['kecamatan_id' => 15, 'name' => 'Dukuh Sutorejo'],
            ['kecamatan_id' => 15, 'name' => 'Kalijudan'],
            ['kecamatan_id' => 15, 'name' => 'Kalisari'],
            ['kecamatan_id' => 15, 'name' => 'Kejawan Putih Tambak'],
            ['kecamatan_id' => 15, 'name' => 'Manyar Sabrangan'],
            ['kecamatan_id' => 15, 'name' => 'Menur Pumpungan'],
            ['kecamatan_id' => 15, 'name' => 'Mulyorejo'],

            // Kecamatan Pabean Cantian (16)
            ['kecamatan_id' => 16, 'name' => 'Bongkaran'],
            ['kecamatan_id' => 16, 'name' => 'Krembangan Utara'],
            ['kecamatan_id' => 16, 'name' => 'Nyamplungan'],
            ['kecamatan_id' => 16, 'name' => 'Pabean Cantian'],
            ['kecamatan_id' => 16, 'name' => 'Perak Timur'],

            // Kecamatan Pakal (17)
            ['kecamatan_id' => 17, 'name' => 'Babat Jerawat'],
            ['kecamatan_id' => 17, 'name' => 'Benowo'],
            ['kecamatan_id' => 17, 'name' => 'Pakal'],
            ['kecamatan_id' => 17, 'name' => 'Sumber Rejo'],

            // Kecamatan Rungkut (18)
            ['kecamatan_id' => 18, 'name' => 'Kedung Baruk'],
            ['kecamatan_id' => 18, 'name' => 'Kali Rungkut'],
            ['kecamatan_id' => 18, 'name' => 'Medokan Ayu'],
            ['kecamatan_id' => 18, 'name' => 'Penjaringan Sari'],
            ['kecamatan_id' => 18, 'name' => 'Rungkut Kidul'],
            ['kecamatan_id' => 18, 'name' => 'Wonorejo'],

            // Kecamatan Sambikerep (19)
            ['kecamatan_id' => 19, 'name' => 'Bringin'],
            ['kecamatan_id' => 19, 'name' => 'Lontar'],
            ['kecamatan_id' => 19, 'name' => 'Made'],
            ['kecamatan_id' => 19, 'name' => 'Sambikerep'],

            // Kecamatan Sawahan (20)
            ['kecamatan_id' => 20, 'name' => 'Banyu Urip'],
            ['kecamatan_id' => 20, 'name' => 'Kupang Krajan'],
            ['kecamatan_id' => 20, 'name' => 'Pakis'],
            ['kecamatan_id' => 20, 'name' => 'Petemon'],
            ['kecamatan_id' => 20, 'name' => 'Putat Jaya'],
            ['kecamatan_id' => 20, 'name' => 'Sawahan'],

            // Kecamatan Semampir (21)
            ['kecamatan_id' => 21, 'name' => 'Ampel'],
            ['kecamatan_id' => 21, 'name' => 'Pegirian'],
            ['kecamatan_id' => 21, 'name' => 'Sidotopo'],
            ['kecamatan_id' => 21, 'name' => 'Ujung'],
            ['kecamatan_id' => 21, 'name' => 'Wonokusumo'],

            // Kecamatan Simokerto (22)
            ['kecamatan_id' => 22, 'name' => 'Kapasan'],
            ['kecamatan_id' => 22, 'name' => 'Sidodadi'],
            ['kecamatan_id' => 22, 'name' => 'Simokerto'],
            ['kecamatan_id' => 22, 'name' => 'Simolawang'],
            ['kecamatan_id' => 22, 'name' => 'Tambakrejo'],

            // Kecamatan Sukolilo (23)
            ['kecamatan_id' => 23, 'name' => 'Gebang Putih'],
            ['kecamatan_id' => 23, 'name' => 'Keputih'],
            ['kecamatan_id' => 23, 'name' => 'Klampis Ngasem'],
            ['kecamatan_id' => 23, 'name' => 'Medokan Semampir'],
            ['kecamatan_id' => 23, 'name' => 'Menur Pumpungan'],
            ['kecamatan_id' => 23, 'name' => 'Nginden Jangkungan'],
            ['kecamatan_id' => 23, 'name' => 'Semolowaru'],

            // Kecamatan Sukomanunggal (24)
            ['kecamatan_id' => 24, 'name' => 'Putat Gede'],
            ['kecamatan_id' => 24, 'name' => 'Simomulyo'],
            ['kecamatan_id' => 24, 'name' => 'Simomulyo Baru'],
            ['kecamatan_id' => 24, 'name' => 'Sonokwijenan'],
            ['kecamatan_id' => 24, 'name' => 'Sukomanunggal'],
            ['kecamatan_id' => 24, 'name' => 'Tanjungsari'],

            // Kecamatan Tambaksari (25)
            ['kecamatan_id' => 25, 'name' => 'Dukuh Setro'],
            ['kecamatan_id' => 25, 'name' => 'Gading'],
            ['kecamatan_id' => 25, 'name' => 'Kapas Madya'],
            ['kecamatan_id' => 25, 'name' => 'Pacar Keling'],
            ['kecamatan_id' => 25, 'name' => 'Pacar Kembang'],
            ['kecamatan_id' => 25, 'name' => 'Ploso'],
            ['kecamatan_id' => 25, 'name' => 'Rangkah'],
            ['kecamatan_id' => 25, 'name' => 'Tambaksari'],

            // Kecamatan Tandes (26)
            ['kecamatan_id' => 26, 'name' => 'Balongsari'],
            ['kecamatan_id' => 26, 'name' => 'Banjar Sugihan'],
            ['kecamatan_id' => 26, 'name' => 'Karangpoh'],
            ['kecamatan_id' => 26, 'name' => 'Manukan Kulon'],
            ['kecamatan_id' => 26, 'name' => 'Manukan Wetan'],
            ['kecamatan_id' => 26, 'name' => 'Tandes'],

            // Kecamatan Tegalsari (27)
            ['kecamatan_id' => 27, 'name' => 'Dr. Soetomo'],
            ['kecamatan_id' => 27, 'name' => 'Kedungdoro'],
            ['kecamatan_id' => 27, 'name' => 'Keputran'],
            ['kecamatan_id' => 27, 'name' => 'Tegalsari'],
            ['kecamatan_id' => 27, 'name' => 'Wonorejo'],

            // Kecamatan Tenggilis Mejoyo (28)
            ['kecamatan_id' => 28, 'name' => 'Kendangsari'],
            ['kecamatan_id' => 28, 'name' => 'Kutisari'],
            ['kecamatan_id' => 28, 'name' => 'Panjang Jiwo'],
            ['kecamatan_id' => 28, 'name' => 'Tenggilis Mejoyo'],

            // Kecamatan Wiyung (29)
            ['kecamatan_id' => 29, 'name' => 'Babatan'],
            ['kecamatan_id' => 29, 'name' => 'Balas Klumprik'],
            ['kecamatan_id' => 29, 'name' => 'Jajar Tunggal'],
            ['kecamatan_id' => 29, 'name' => 'Wiyung'],

            // Kecamatan Wonocolo (30)
            ['kecamatan_id' => 30, 'name' => 'Bendul Merisi'],
            ['kecamatan_id' => 30, 'name' => 'Jemur Wonosari'],
            ['kecamatan_id' => 30, 'name' => 'Margorejo'],
            ['kecamatan_id' => 30, 'name' => 'Sidosermo'],
            ['kecamatan_id' => 30, 'name' => 'Siwalankerto'],

            // Kecamatan Wonokromo (31)
            ['kecamatan_id' => 31, 'name' => 'Darmo'],
            ['kecamatan_id' => 31, 'name' => 'Jagir'],
            ['kecamatan_id' => 31, 'name' => 'Ngagel'],
            ['kecamatan_id' => 31, 'name' => 'Ngagel Rejo'],
            ['kecamatan_id' => 31, 'name' => 'Sawunggaling'],
            ['kecamatan_id' => 31, 'name' => 'Wonokromo'],
        ];

        foreach ($kelurahans as $kelurahan) {
            DB::table('kelurahans')->insert([
                'kecamatan_id' => $kelurahan['kecamatan_id'],
                'name' => $kelurahan['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}