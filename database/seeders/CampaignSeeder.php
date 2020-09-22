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
        $campaign->name = 'Semana do Destravar do Emagrecimento 28/09 a 01/10 L3';
        $campaign->start = '2020-09-28 00:00:00';
        $campaign->end = '2020-10-01 23:59:59';
        $campaign->start_monitoring = '2020-09-22 00:00:00';
        $campaign->stop_monitoring = '2020-10-08 23:59:59';
        $campaign->description = 'Campanha voltada para venda do Programa Acelerador de Emagrecimento - R$4.000,00';
        $campaign->save();
        unset($campaign);

        // $campaign = new Campaign();
        // $campaign->name = 'Semana da Riqueza Digital 28/09 a 01/10 L1';
        // $campaign->start = '2020-09-28 00:00:00';
        // $campaign->end = '2020-10-01 23:59:59';
        // $campaign->start_monitoring = '2020-09-22 00:00:00';
        // $campaign->stop_monitoring = '2020-10-08 23:59:59';
        // $campaign->description = 'Campanha voltada para captação de afiliado para o produto Desafio 14 dias - R$97,00';
        // $campaign->save();
        // unset($campaign);
    }
}
