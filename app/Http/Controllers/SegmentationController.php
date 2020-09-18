<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Segmentation;
use Illuminate\Http\Request;

class SegmentationController extends Controller
{
    public $request;
    protected $model;

    public function __construct(Request $request, Segmentation $model)
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
        $segmentations = $this->model->where('id', '!=', 0)->get();
        return view(
            'panel.segmentation.index',
            [
                'user' => $user,
                'segmentations' => $segmentations
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
        $user = Auth()->User();
        $campaigns = Campaign::orderby('name','asc')->select('id','name')->get();
        return view(
            'panel.segmentation.create',
            [
                'user' => $user,
                'campaigns' => $campaigns
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store = $this->model->create($request->all());
        if ($store)
            return redirect()->route("segmentations.index")->with('success', 'Segmentação cadastrada com sucesso!');

        return redirect()->route('segmentations.index')->with('error', 'Ocorreu um erro ao cadastrar a segmentação');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Segmentation  $segmentation
     * @return \Illuminate\Http\Response
     */
    public function show(Segmentation $segmentation)
    {
        $user = Auth()->User();
        return view('panel.segmentation.show', [
            'user' => $user,
            'segmentation' => $segmentation
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Segmentation  $segmentation
     * @return \Illuminate\Http\Response
     */
    public function edit(Segmentation $segmentation)
    {
        $user = Auth()->User();
        $campaigns = Campaign::orderby('name','asc')->select('id','name')->get();
        return view(
            'panel.segmentation.edit',
            [
                'user' => $user,
                'segmentation' => $segmentation,
                'campaigns' => $campaigns
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Segmentation  $segmentation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Segmentation $segmentation)
    {
        $segmentation->campaigns_id = $request->campaigns_id;
        $segmentation->name = $request->name;
        $segmentation->description = $request->description;
        $segmentation->save();
        if ($segmentation)
            return redirect()->route("segmentations.index")->with('success', 'Segmentação alterada com sucesso!');

        return redirect()->route('segmentations.index')->with('error', 'Ocorreu um erro ao alterar a segmentação');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Segmentation  $segmentation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Segmentation $segmentation)
    {
        $segmentation->delete();
        return redirect()->route('segmentations.index');
    }
}
