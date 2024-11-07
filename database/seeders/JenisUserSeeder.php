<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class JenisUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisUsers = [
            [
                'ID_JENIS_USER' => '1',
                'JENIS_USER' => 'User',
                'CREATE_BY' => null,
                'CREATE_DATE' => now(),
                'DELETE_MARK' => '0',
                'UPDATE_BY' => null,
                'UPDATE_DATE' => null
            ],
            [
                'ID_JENIS_USER' => '2',
                'JENIS_USER' => 'Mahasiswa',
                'CREATE_BY' => null,
                'CREATE_DATE' => now(),
                'DELETE_MARK' => '0',
                'UPDATE_BY' => null,
                'UPDATE_DATE' => null
            ],
            [
                'ID_JENIS_USER' => '3',
                'JENIS_USER' => 'Admin',
                'CREATE_BY' => null,
                'CREATE_DATE' => now(),
                'DELETE_MARK' => '0',
                'UPDATE_BY' => null,
                'UPDATE_DATE' => null
            ],
            [
                'ID_JENIS_USER' => '4',
                'JENIS_USER' => 'Kapten',
                'CREATE_BY' => null,
                'CREATE_DATE' => now(),
                'DELETE_MARK' => '0',
                'UPDATE_BY' => null,
                'UPDATE_DATE' => null
            ],
        ];

        DB::table('JENIS_USER')->insert($jenisUsers);
    }
}