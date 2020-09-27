<?php

namespace App\Http\Controllers;


use App\Models\Campaign;
use App\Models\CampaignMessage;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // dd($request->all());

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
            $campaignMessage->messages_id = $request->messages_id[$i];

            // 'immediate', 'date', 'relative'
            $campaignMessage->shot = $request->shots[$i];

            if ($request->shots[$i] == 'date') {
                $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i', $request->scheduler_dates[$i])->format('Y-m-d H:i');
            } elseif ($request->shots[$i] == 'relative') {
                // Integer (quantidade)
                $campaignMessage->quantity = $request->quantities[$i];

                // 'minutes', 'hours', 'days'
                $campaignMessage->unit = $request->units[$i];

                // 'before', 'after'
                $campaignMessage->trigger = $request->triggers[$i];

                // 'start_campaign', 'end_campaign', 'start_monitoring', 'stop_monitoring'
                $campaignMessage->moment = $request->moments[$i];

                if ($campaignMessage->moment == 'start_campaign') {
                    if ($campaignMessage->trigger == 'after') {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->addMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->addHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->addDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    } else {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->subMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->subHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->subDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    }
                } elseif ($campaignMessage->moment == 'end_campaign') {
                    if ($campaignMessage->trigger == 'after') {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->addMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->addHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->addDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    } else {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->subMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->subHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->subDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    }
                } elseif ($campaignMessage->moment == 'start_monitoring') {
                    if ($campaignMessage->trigger == 'after') {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->addMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->addHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->addDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    } else {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->subMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->subHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->subDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    }
                } elseif ($campaignMessage->moment == 'stop_monitoring') {
                    if ($campaignMessage->trigger == 'after') {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->addMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->addHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->addDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    } else {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->subMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->subHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->subDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    }
                }
            }
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
        // dd($request->all());
        $campaign->name = $request->name;
        $campaign->description = $request->description;
        $campaign->start = Carbon::createFromFormat('d/m/Y', $request->start)->format('Y-m-d');
        $campaign->end = Carbon::createFromFormat('d/m/Y', $request->end)->format('Y-m-d');
        $campaign->start_monitoring = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->format('Y-m-d H:i:s');
        $campaign->stop_monitoring = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->format('Y-m-d H:i:s');
        $campaign->save();

        // Exclui a sequência de mensagens
        CampaignMessage::where('campaigns_id', $campaign->id)->delete();

        // Salva sequência de mensagens
        for ($i = 0; $i < count($request->messages_id); $i++) {
            $campaignMessage = new CampaignMessage();
            $campaignMessage->campaigns_id = $campaign->id;
            $campaignMessage->messages_id = $request->messages_id[$i];

            // 'immediate', 'date', 'relative'
            $campaignMessage->shot = $request->shots[$i];

            if ($request->shots[$i] == 'date') {
                $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i', $request->scheduler_dates[$i])->format('Y-m-d H:i');
            } elseif ($request->shots[$i] == 'relative') {
                // Integer (quantidade)
                $campaignMessage->quantity = $request->quantities[$i];

                // 'minutes', 'hours', 'days'
                $campaignMessage->unit = $request->units[$i];

                // 'before', 'after'
                $campaignMessage->trigger = $request->triggers[$i];

                // 'start_campaign', 'end_campaign', 'start_monitoring', 'stop_monitoring'
                $campaignMessage->moment = $request->moments[$i];

                if ($campaignMessage->moment == 'start_campaign') {
                    if ($campaignMessage->trigger == 'after') {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->addMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->addHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->addDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    } else {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->subMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->subHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start . ' 00:00:00')->subDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    }
                } elseif ($campaignMessage->moment == 'end_campaign') {
                    if ($campaignMessage->trigger == 'after') {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->addMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->addHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->addDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    } else {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->subMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->subHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->end . ' 00:00:00')->subDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    }
                } elseif ($campaignMessage->moment == 'start_monitoring') {
                    if ($campaignMessage->trigger == 'after') {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->addMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->addHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->addDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    } else {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->subMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->subHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->start_monitoring)->subDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    }
                } elseif ($campaignMessage->moment == 'stop_monitoring') {
                    if ($campaignMessage->trigger == 'after') {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->addMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->addHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->addDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    } else {
                        if ($campaignMessage->unit == 'minutes') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->subMinutes($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'hours') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->subHours($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        } elseif ($campaignMessage->unit == 'days') {
                            $campaignMessage->scheduler_date = Carbon::createFromFormat('d/m/Y H:i:s', $request->stop_monitoring)->subDays($campaignMessage->quantity)->format('Y-m-d H:i:s');
                        }
                    }
                }
            }
            $campaignMessage->save();
            unset($campaignMessage);
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
