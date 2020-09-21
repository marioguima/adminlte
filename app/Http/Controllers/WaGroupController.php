<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Segmentation;
use App\Models\WaGroup;
use App\Models\WaGroupInitialMember;
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
        $user = Auth()->User();
        $campaigns['data'] = Campaign::orderby('name', 'asc')->select('id', 'name')->get();
        return view(
            'panel.groups.create',
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
        // $request->validate([
        //     'segmentations_id' => 'required',
        //     'name' => 'required|min:3|max:25',
        //     'url' => 'required|url',
        //     'description' => 'nullable',
        //     'seats' => 'required|min:1|max:253',
        //     'occuped_seats' => 'required',
        //     'member_names.*' => 'nullable',
        //     'member_names.0' => 'required',
        // ]);

        // Salva o grupo
        $waGroup = new WaGroup();
        $waGroup->segmentations_id = $request->segmentations_id;
        $waGroup->name = $request->name;
        $waGroup->url = $request->url;
        $waGroup->seats = $request->seats;
        $waGroup->occuped_seats = $request->occuped_seats;
        $waGroup->description = $request->description;
        $waGroup->save($request->all());

        // Upload da imagem do grupo
        $image = $request->file('uploadFile')->store('groups/' . $waGroup->id);

        // Atualiza o caminho da imagem do grupo
        $waGroup->image_path = $image;
        $waGroup->save();

        // Salva os membros iniciais
        for ($i = 0; $i < count($request->member_names); $i++) {
            $WaGroupInitialMember = new WaGroupInitialMember();
            $WaGroupInitialMember->wa_groups_id = $waGroup->id;
            $WaGroupInitialMember->contact_name = $request->member_names[$i];
            $WaGroupInitialMember->administrator = $request->member_administrators[$i];
            $WaGroupInitialMember->save();
            unset($WaGroupInitialMember);
        }

        if ($waGroup) {
            return redirect()->route("groups.index")->with('success', 'Grupo cadastrado com sucesso!');
        }
        return redirect()->route('groups.index')->with('error', 'Ocorreu um erro ao cadastrar o grupo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WaGroup  $group
     * @return \Illuminate\Http\Response
     */
    public function show(WaGroup $group)
    {
        $user = Auth()->User();
        return view(
            'panel.groups.show',
            [
                'user' => $user,
                'group' => $group
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WaGroup  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(WaGroup $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WaGroup  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WaGroup $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WaGroup  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaGroup $group)
    {
        //
    }

    public function getSegmentations($campaigns_id = 0)
    {
        $segmentations['data'] =
            Segmentation::orderby('name', 'asc')
            ->select('id', 'name')
            ->where('campaigns_id', $campaigns_id)
            ->get();
        return response()->json($segmentations);
    }
}
