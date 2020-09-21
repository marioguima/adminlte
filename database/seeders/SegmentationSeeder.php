<?php

namespace Database\Seeders;

use App\Models\Segmentation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SegmentationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $segmentation = new Segmentation();
        $segmentation->campaigns_id = DB::table('campaigns')->get(['id'])->last()->id;
        $segmentation->name = 'Homens-Hotmart-20a35-Brasil';
        $segmentation->description = 'Homens que curtem hotmart, que tenham entre 20 a 35 anos, que morem no Brasil';
        $segmentation->save();
    }
}
