<?php

namespace Database\Seeders;

use App\Models\WaGroupInitialMember;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WaGroupInitialMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $waGroupInitialMember = new WaGroupInitialMember();
        $waGroupInitialMember->wa_groups_id = DB::table('wa_groups')->get(['id'])->last()->id;
        $waGroupInitialMember->contact_name = 'Mário Guimarães Beta';
        $waGroupInitialMember->administrator = 1;
        $waGroupInitialMember->save();
    }
}
