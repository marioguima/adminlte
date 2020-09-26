<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\CampaignMessage;
use App\Models\Message;
use Carbon\Carbon;
use DateTime;
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
        $campaigns = $this->model->where('id', '!=', 0)->with(['segmentations'])->get();
        // dd($campaigns);
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
        $messages = Message::all();
        return view(
            'panel.campaign.create',
            [
                'user' => $user,
                'messages' => $messages
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
        dd($request->all());

        $campaign = new Campaign();
        $campaign->name = $request->name;
        $campaign->description = $request->description;
        $campaign->start = Carbon::createFromFormat('d/m/Y', $request->start)->format('Y-m-d');
        $campaign->end = Carbon::createFromFormat('d/m/Y', $request->end)->format('Y-m-d');
        $campaign->start_monitoring = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->format('Y-m-d H:i:s');
        $campaign->stop_monitoring = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->format('Y-m-d H:i:s');
        $campaign->save();

        // Salva sequência de mensagens
        for ($i = 0; $i < count($request->messages_id); $i++) {
            $campaignMessage = new CampaignMessage();
            $campaignMessage->campaigns_id = $campaign->id;
            $campaignMessage->messages_id = $request->messages_id->id;
            $campaignMessage->save();
            unset($campaignMessage);
        }

        if ($campaign)
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
        $campaign->start = Carbon::createFromFormat('d/m/Y', $request->start)->format('Y-m-d');
        $campaign->end = Carbon::createFromFormat('d/m/Y', $request->end)->format('Y-m-d');
        $campaign->start_monitoring = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->format('Y-m-d H:i:s');
        $campaign->stop_monitoring = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->format('Y-m-d H:i:s');
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
