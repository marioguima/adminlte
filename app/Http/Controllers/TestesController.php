<?php

namespace App\Http\Controllers;

use App\Http\Resources\CampaignCollection;
use App\Models\Campaign;
use App\Models\Message;
use Illuminate\Http\Request;

class TestesController extends Controller
{
    public function campanhas($campanha)
    {
        $campanha = Campaign::find($campanha);
        return new CampaignCollection(Campaign::all());
    }

    public function mensagens($mensagem)
    {
        return Message::find($mensagem);
    }
}
