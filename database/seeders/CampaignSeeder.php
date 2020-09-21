<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $campaign = new Campaign();
        $campaign->name = 'Riqueza Digital 28/09 L1';
        $campaign->description = 'Campanha voltada para captação de afiliado para o produto Desafio 14 dias';
        $campaign->save();
    }
}
