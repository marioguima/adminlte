<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaign = new Campaign();
        $data = ['campaigns' => $campaign
            ->whereRaw('now() BETWEEN start_monitoring AND stop_monitoring')
            ->select(['id', 'name', 'start', 'end', 'start_monitoring', 'stop_monitoring', 'description'])
            ->with([
                'segmentations:id,campaigns_id,name,description',
                'segmentations.groups:id,segmentations_id,name,image_path,description,edit_data,send_message,seats,occuped_seats,people_left,url',
                'segmentations.groups.initialMembers:id,wa_groups_id,contact_name,administrator'
            ])
            ->get()];
            // para depurar uma query basta trocar get() por toSql()
            // dd($data);

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        //
    }
}
