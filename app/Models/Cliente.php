<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'email',
        'telefone',
        'endereco',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'cliente_id');
    }
}
