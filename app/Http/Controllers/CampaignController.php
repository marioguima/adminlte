<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public $request;
    protected $model;

    public function __construct(Request $request, Campaign $model)
    {
        $this->middleware('auth');
        $this->request = $request;
        $this->model = $model;
    }

    // protected function parametes()
    // {
    //     $uri = $this->request->route()->uri();
    //     $urlAtual = $uri;
    //     $breadcrumbs = $uri;
    //     if (strpos($uri, '/') !== false) {
    //         $urlAtual = join(' - ', array_map('ucfirst', explode('/', $uri)));
    //         $breadcrumbs = join(' / ', array_map('ucfirst', explode('/', $uri)));
    //     }
    //     $user = Auth()->User();
    //     return array(
    //         'user' => $user,
    //         'urlAtual' => $urlAtual,
    //         'breadcrumbs' => $breadcrumbs
    //     );
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->User();
        $campaigns = $this->model->where('id', '!=', 0)->get();
        return view(
            'panel.campaign.index',
            [
                'user' => $user,
                'campaigns' => $campaigns
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
        return view(
            'panel.campaign.create',
            ['user' => $user]
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
        $store = Campaign::create($request->all());
        if ($store)
            return redirect()->route("campaigns.index")->with('success', 'Campanha cadastrada com sucesso!');

        return redirect()->route('campaigns.index')->with('error', 'Ocorreu um erro ao cadastrar a campanha');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function show(Campaign $campaign)
    {
        $user = Auth()->User();
        return view('panel.campaign.show', [
            'user' => $user,
            'campaign' => $campaign
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function edit(Campaign $campaign)
    {
        $user = Auth()->User();
        return view('panel.campaign.edit', [
            'user' => $user,
            'campaign' => $campaign
        ]);
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
        $campaign->name = $request->name;
        $campaign->description = $request->description;
        $campaign->save();
        if ($campaign)
            return redirect()->route("campaigns.index")->with('success', 'Campanha alterada com sucesso!');

        return redirect()->route('campaigns.index')->with('error', 'Ocorreu um erro ao alterar a campanha');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campaign  $campaign
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route('campaigns.index');
    }
}
