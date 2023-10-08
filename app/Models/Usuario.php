<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuario';
    protected $keyType = 'string';

    protected $fillable = array(
        'email',
        'nome',
        'sobrenome',
        'senha',
    );

    protected $hidden = array(
        'senha',
    );

    public static function add(array $dados)
    {
        $dados['senha'] = bcrypt($dados['senha']);
        return self::create($dados);
    }
}
