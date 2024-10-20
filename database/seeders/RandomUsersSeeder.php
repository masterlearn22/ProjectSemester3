<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RandomUsersSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Sang Admin',
                'username' => 'admin',
                'email' => 'admin@email.com',
                'password' => '1234567890',
                'no_hp' => '081234567890',
                'wa' => '081234567890',
                'pin' => '123456',
                'ID_JENIS_USER' => '3',
            ],
            [
                'name' => 'Bang User',
                'username' => 'user',
                'email' => 'user@email.com',
                'password' => '1234567890',
                'no_hp' => '087654321098',
                'wa' => '087654321098',
                'pin' => '654321',
                'ID_JENIS_USER' => '1',
            ],
            [
                'name' => 'Mahasiswa Jago ',
                'username' => 'mahasiswa',
                'email' => 'mahasiswa@email.com',
                'password' => '1234567890',
                'no_hp' => '089876543210',
                'wa' => '089876543210',
                'pin' => '987654',
                'ID_JENIS_USER' => '2',
            ],
            [
                'name' => 'Monkey D. Luffy',
                'username' => 'Raja_Bajak_Laut',
                'email' => 'kapten@email.com',
                'password' => '1234567890',
                'no_hp' => '082345678901',
                'wa' => '082345678901',
                'pin' => '432156',
                'ID_JENIS_USER' => '4',
            ],
            [
                'name' => 'Surya Dwi Satria',
                'username' => 'suryads_',
                'email' => 'suryafc349@email.com',
                'password' => '1234567890',
                'no_hp' => '085678901234',
                'wa' => '085678901234',
                'pin' => '876543',
                'ID_JENIS_USER' => '3',
            ],
            [
                'name' => 'Reta Hadiana Unggula',
                'username' => 'retahadiana_',
                'email' => 'reta190306@email.com',
                'password' => '1234567890',
                'no_hp' => '083456789012',
                'wa' => '083456789012',
                'pin' => '234567',
                'ID_JENIS_USER' => '4',
            ],
            [
                'name' => 'Astaroth',
                'username' => 'asta',
                'email' => 'asta@email.com',
                'password' => '1234567890',
                'no_hp' => '086789012345',
                'wa' => '086789012345',
                'pin' => '789012',
                'ID_JENIS_USER' => '2',
            ],
            [
                'name' => 'Yhwach',
                'username' => 'the_almight',
                'email' =>  'yhwach@email.com',
                'password' => '1234567890',
                'no_hp' => '084321098765',
                'wa' => '084321098765',
                'pin' => '567890',
                'ID_JENIS_USER' => '4',
            ],
            [
                'name' => 'Violet Evergardeen',
                'username' => 'violet',
                'email' => 'violet@email.com',
                'password' => '1234567890',
                'no_hp' => '081098765432',
                'wa' => '081098765432',
                'pin' => '123456',
                'ID_JENIS_USER' => '1',
            ],
        ];

        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'] ?? '',
                'username' => $userData['username'] ?? '',
                'email' => $userData['email'] ?? '',
                'password' => Hash::make($userData['password'] ?? ''),
                'no_hp' => $userData['no_hp'] ?? '',
                'wa' => $userData['wa'] ?? '',
                'pin' => $userData['pin'] ?? '',
                'ID_JENIS_USER' => $userData['ID_JENIS_USER'] ?? '2', // default ke 2 jika tidak ada
                'STATUS_USER' => '1',
            ]);
        }
    }
}