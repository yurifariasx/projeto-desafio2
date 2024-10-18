<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Responses\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FilmeController extends Controller
{

    public function criar(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'titulo' => 'required|string|max:200',
            'anoLancamento' => 'required|numeric',
            'diretor' => 'required|string|max:150',
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message'=> 'Validation error',
                'errors' => $validator->errors()
            ],422);
        }

        $customer = Filme::create($request->all());
        return JsonResponse::success('Filme criado com sucesso', $customer);

    }
    public function listarTodos()
    {
        $filme = Filme::all();
        return JsonResponse::success($filme);
    }

    public function listarPeloID($id)
    {
    
        $customer = Filme::findOrFail($id);
        return JsonResponse::success(data: $customer);
    }

    public function editar(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'titulo' => 'required|string|max:200',
            'anoLancamento' => 'required|numeric',
            'diretor' => 'required|string|max:150',
        ]);
        if ($validator->fails()){
            return response()->json([
                'status' => false,
                'message'=> 'Validation error',
                'errors' => $validator->errors()
            ],422);
        }

        $customer = Filme::findOrFail($id);
        return JsonResponse::success('Filme editado com sucesso', $customer);
    }

    public function remover(Request $request, $id )
    {
        $customer = Filme::findOrFail($id);
        $customer->delete();
        return JsonResponse::success('Filme deletado com sucesso');
    }
}