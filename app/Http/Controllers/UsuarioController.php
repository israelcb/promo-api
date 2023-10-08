<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\Request;

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
            $usuario = Usuario::add($request->all());

            return response()->json([
                'mensagem'  => 'Usuário cadastrado com êxito',
                'usuarios'  => $usuario,
            ], 201);
            return response()->json($usuario);

        } catch (UniqueConstraintViolationException $_e) {
            return response()->json([
                'erro'  => 'E-mail já cadastrado',
            ], 400);
        }
    }
}
