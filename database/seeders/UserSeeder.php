<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Mário Guimarães',
            'email'     => 'contato@marioguimaraes.com.br',
            'password'  => bcrypt('mcsg2408'),
        ]);
    }
}
