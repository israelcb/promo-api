<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        return response()->json([
            'mensagem'      => 'Categorias consultadas com êxito',
            'categorias'    => $categorias,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome'              => 'required|max:50',
                'categoria_pai_id'  => 'nullable|uuid',
            ]);

            if (
                !is_null($request->categoria_pai_id)
                && is_null(Categoria::find($request->categoria_pai_id))
            ) {
                return response()->json([
                    'erro' => 'Categoria pai não existente!'
                ], 400);
            }

            $categoria = Categoria::create($request->all());
    
            return response()->json([
                'mensagem'  => 'Categoria cadastrada com êxito',
                'categoria' => $categoria,
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'erro' => $e->getMessage()
            ], 400);
        }

        return response()->json([
            'erro'  => 'Erro interno!',
        ], 500);
    }
}
