<?php

namespace App\Http\Controllers;


use App\Models\Campaign;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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

    private function relative_scheduler_date(Request $request,  $i)
    {
        $scheduler_date = null;
        if ($request->moments[$i] == 'start_campaign') {
            if ($request->triggers[$i] == 'after') {
                if ($request->units[$i] == 'minutes') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->addMinutes($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'hours') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->addHours($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'days') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->addDays($request->quantities[$i])->format('Y-m-d H:i:s');
                }
            } else {
                if ($request->units[$i] == 'minutes') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->subMinutes($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'hours') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->subHours($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'days') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->subDays($request->quantities[$i])->format('Y-m-d H:i:s');
                }
            }
        } elseif ($request->moments[$i] == 'end_campaign') {
            if ($request->triggers[$i] == 'after') {
                if ($request->units[$i] == 'minutes') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->addMinutes($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'hours') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->addHours($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'days') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->addDays($request->quantities[$i])->format('Y-m-d H:i:s');
                }
            } else {
                if ($request->units[$i] == 'minutes') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->subMinutes($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'hours') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->subHours($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'days') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->subDays($request->quantities[$i])->format('Y-m-d H:i:s');
                }
            }
        } elseif ($request->moments[$i] == 'start_monitoring') {
            if ($request->triggers[$i] == 'after') {
                if ($request->units[$i] == 'minutes') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->addMinutes($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'hours') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->addHours($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'days') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->addDays($request->quantities[$i])->format('Y-m-d H:i:s');
                }
            } else {
                if ($request->units[$i] == 'minutes') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->subMinutes($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'hours') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->subHours($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'days') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->subDays($request->quantities[$i])->format('Y-m-d H:i:s');
                }
            }
        } elseif ($request->moments[$i] == 'stop_monitoring') {
            if ($request->triggers[$i] == 'after') {
                if ($request->units[$i] == 'minutes') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->addMinutes($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'hours') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->addHours($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'days') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->addDays($request->quantities[$i])->format('Y-m-d H:i:s');
                }
            } else {
                if ($request->units[$i] == 'minutes') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->subMinutes($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'hours') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->subHours($request->quantities[$i])->format('Y-m-d H:i:s');
                } elseif ($request->units[$i] == 'days') {
                    $scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->subDays($request->quantities[$i])->format('Y-m-d H:i:s');
                }
            }
        }
        return $scheduler_date;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campaign = new Campaign();
        $campaign->user_id = Auth::id();
        $campaign->name = $request->name;
        $campaign->description = $request->description;
        $campaign->start = Carbon::createFromFormat('d/m/Y', $request->start)->format('Y-m-d');
        $campaign->end = Carbon::createFromFormat('d/m/Y', $request->end)->format('Y-m-d');
        $campaign->start_monitoring = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->format('Y-m-d H:i:s');
        $campaign->stop_monitoring = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->format('Y-m-d H:i:s');
        $campaign->save();

        // Salva sequência de mensagens
        for ($i = 0; $i < count($request->message_ids); $i++) {
            $scheduler_date = $request->scheduler_date[$i];
            if ($request->shots[$i] == 'date') {
                $scheduler_date = Carbon::createFromFormat('d/m/Y H:i', $request->scheduler_dates[$i])->format('Y-m-d H:i');
            } elseif ($request->shots[$i] == 'relative') {
                $scheduler_date = $this->relative_scheduler_date($request, $i);
            }

            $campaign->messages()->attach(
                $request->message_ids[$i],
                array(
                    'shot' => $request->shots[$i],
                    'scheduler_date' => $scheduler_date,
                    'quantity' => $request->quantities[$i],
                    'unit' => $request->units[$i],
                    'trigger' => $request->triggers[$i],
                    'moment' => $request->moments[$i]
                )
            );
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
        $messages = Message::all();
        return view('panel.campaign.edit', [
            'user' => $user,
            'messages' => $messages,
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
        Gate::authorize('udpate-campaign', $campaign);

        $campaign->name = $request->name;
        $campaign->description = $request->description;
        $campaign->start = Carbon::createFromFormat('d/m/Y', $request->start)->format('Y-m-d');
        $campaign->end = Carbon::createFromFormat('d/m/Y', $request->end)->format('Y-m-d');
        $campaign->start_monitoring = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->format('Y-m-d H:i:s');
        $campaign->stop_monitoring = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->format('Y-m-d H:i:s');
        $campaign->save();

        // Exclui as linhas
        $campaign->messages()->detach();

        // Salva sequência de mensagens
        for ($i = 0; $i < count($request->message_ids); $i++) {
            $scheduler_date = $request->scheduler_date[$i];
            if ($request->shots[$i] == 'date') {
                $scheduler_date = Carbon::createFromFormat('d/m/Y H:i', $request->scheduler_dates[$i])->format('Y-m-d H:i');
            } elseif ($request->shots[$i] == 'relative') {
                $scheduler_date = $this->relative_scheduler_date($request, $i);
            }

            $campaign->messages()->attach(
                $request->message_ids[$i],
                array(
                    'shot' => $request->shots[$i],
                    'scheduler_date' => $scheduler_date,
                    'quantity' => $request->quantities[$i],
                    'unit' => $request->units[$i],
                    'trigger' => $request->triggers[$i],
                    'moment' => $request->moments[$i]
                )
            );
        }

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
