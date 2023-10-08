<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();

        return response()->json([
            'mensagem'  => 'Usuários consultados com êxito',
            'usuarios'  => $usuarios,
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome'      => 'required|max:30',
                'sobrenome' => 'required|max:60',
                'email'     => 'required|max:100|email:rfc,dns',
                'senha'     => 'required',
            ]);

            $usuario = Usuario::add($request->all());

            return response()->json([
                'mensagem'  => 'Usuário cadastrado com êxito',
                'usuario'   => $usuario,
            ], 201);
            return response()->json($usuario);

        } catch (ValidationException $e) {
            return response()->json([
                'erro' => $e->getMessage()
            ], 400);

        } catch (UniqueConstraintViolationException $_e) {
            return response()->json([
                'erro'  => 'E-mail já cadastrado',
            ], 400);
        }

        return response()->json([
            'erro'  => 'Erro interno!',
        ], 500);
    }
}
