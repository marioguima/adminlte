<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Segmentation;
use App\Models\WaGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RedirectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // DB::enableQueryLog();
        // $segmentation = Segmentation::findOrFail($id);
        $group = WaGroup::where('segmentations_id', $id)
            ->whereRaw('seats > occuped_seats')
            ->get()
            ->first();
        // var_dump(DB::getQueryLog());
        // return;
        return redirect()->away($group->url);
        // return $group;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
