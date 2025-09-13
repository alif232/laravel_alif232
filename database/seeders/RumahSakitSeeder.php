<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RumahSakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rumah_sakits')->insert([
            [
                'nama_rumah_sakit' => 'RS Umum Sehat Selalu',
                'alamat'           => 'Jl. Merdeka No. 123, Jakarta',
                'email'            => 'info@rssehat.com',
                'telepon'          => '021123456',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
            [
                'nama_rumah_sakit' => 'RS Kasih Ibu',
                'alamat'           => 'Jl. Mawar No. 45, Bandung',
                'email'            => 'kontak@rskasihibu.com',
                'telepon'          => '022987654',
                'created_at'       => now(),
                'updated_at'       => now(),
            ],
        ]);
    }
}
