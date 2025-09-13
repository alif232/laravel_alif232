<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pasiens')->insert([
            [
                'nama_pasien'    => 'Budi Santoso',
                'alamat'         => 'Jl. Kenanga No. 10, Jakarta',
                'no_telpon'      => '081234567890',
                'rumah_sakit_id' => 1,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nama_pasien'    => 'Siti Aminah',
                'alamat'         => 'Jl. Melati No. 22, Bandung',
                'no_telpon'      => '082345678901',
                'rumah_sakit_id' => 2,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
