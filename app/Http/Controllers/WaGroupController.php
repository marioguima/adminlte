<?php

namespace App\Http\Controllers;

use App\Models\WaGroup;
use Illuminate\Http\Request;

class WaGroupController extends Controller
{

    public $request;
    protected $model;

    public function __construct(Request $request, WaGroup $model)
    {
        $this->middleware('auth');
        $this->request = $request;
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->User();
        $groups = $this->model->where('id', '!=', 0)->get();
        return view(
            'panel.groups.index',
            [
                'user' => $user,
                'groups' => $groups
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
     * @param  \App\Models\WaGroup  $waGroup
     * @return \Illuminate\Http\Response
     */
    public function show(WaGroup $waGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaGroup  $waGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(WaGroup $waGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WaGroup  $waGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WaGroup $waGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaGroup  $waGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaGroup $waGroup)
    {
        //
    }
}
