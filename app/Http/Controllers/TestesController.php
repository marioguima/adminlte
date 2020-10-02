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

    public function rolesPermissions()
    {
        $nameUser = auth()->user()->name;
        echo("<h1>{$nameUser}</h1>");

        foreach (auth()->user()->roles as $role) {
            echo "<b>$role->name</b> -> ";

            $permissions = $role->permissions;
            foreach ($permissions as $permission) {
                echo " $permission->name , ";
            }

            echo "<hr>";
        }
    }
}
