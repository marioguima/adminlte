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
        $segmentation->campaign_id = DB::table('campaigns')->get(['id'])->last()->id;
        $segmentation->name = 'Público 1';
        $segmentation->description = 'Público 1';
        $segmentation->save();
    }
}
