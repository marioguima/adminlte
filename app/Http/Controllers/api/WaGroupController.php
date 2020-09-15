<?php

namespace App\Http\Controllers\api;

use App\api\ApiError;
use App\Http\Controllers\Controller;
use App\Models\WaGroup;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class WaGroupController extends Controller
{

    private $wa_group;

    public function __construct(WaGroup $wa_group)
    {
        $this->wa_group = $wa_group;
    }

    /**
     * Retorna a Lista dos Grupos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // aqui falta filtrar os grupos que o usuário logado tem acesso (essa associação ainda não está implementada)
        // no mínimo precisa de um filtro por campanha porque cada usuário tem suas campanhas

        // Paginação
        // return response()->json($this->wa_group->paginate(10));

        $data = ['data' => $this->wa_group->all()];

        return response()->json($data);
    }

    /**
     * Cria um novo grupo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $WaGroupData = $request->all();
            $this->wa_group->create($WaGroupData);

            $return = ['data' => ['msg' => 'Grupo criado com sucesso!']];
            return response()->json($return, 201);
        } catch (\Exception $e) {
            if (config(('app.debug'))) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
            }
            return response()->json(ApiError::errorMessage('Erro ao cadastrar do grupo!', 1010));
        }
    }

    /**
     * Retorna o grupo especificado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $WaGroup = $this->wa_group->find($id);
        $data = ['data' => $WaGroup];

        return response()->json($data);
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
        try {
            $WaGroupData = $request->all();
            $WaGroup = $this->wa_group->find($id);
            $WaGroup->update($WaGroupData);


            $return = ['data' => ['msg' => 'Grupo atualizado com sucesso!']];
            return response()->json($return, 201);
        } catch (\Exception $e) {
            if (config(('app.debug'))) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1011));
            }
            return response()->json(ApiError::errorMessage('Erro ao alterar do grupo!', 1011));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $wa_group = WaGroup::findOrFail($id);
            $wa_group->delete();

            $return = ['data' => ['msg' => 'Grupo ' . $wa_group->name . ' removido com sucesso!']];
            return response()->json($return, 200);
        } catch (\Exception $e) {
            if (config(('app.debug'))) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1012));
            }
            return response()->json(ApiError::errorMessage('Erro ao excluir o grupo!', 1012));
        }
    }
}
