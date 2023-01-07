<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =
            [
                [
                    'name' => 'Mujaidin',
                    'username' => 'muja',
                ],
                [
                    'name' => 'M. Khoirul Umam,S.Ag',
                    'username' => 'umam',
                ],
                [
                    'name' => 'Taqius Shofi Albastomi,S.Kom',
                    'username' => 'taqi'
                ]
            ];
        foreach ($data as $user) {
            User::create([
                'name' => $user['name'],
                'username' => $user['username'],
                'password' => bcrypt('12345678')
            ]);
        }
    }
}
