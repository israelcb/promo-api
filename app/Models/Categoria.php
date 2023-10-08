<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria';
    protected $keyType = 'string';

    protected $fillable = array(
        'nome',
        'categoria_pai_id',
    );
}
