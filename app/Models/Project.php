<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Definir o nome da tabela, se for diferente do plural do nome da model
    protected $table = 'projects';

    // Atributos que podem ser preenchidos em massa
    protected $fillable = [
        'titulo',
        'descricao',
        'data_inicio',
        'data_termino',
        'cliente_id',
    ];

    // Definir os tipos dos atributos
    protected $casts = [
        'data_inicio' => 'datetime',
        'data_termino' => 'datetime',
    ];

    // Relacionamento com a model Cliente
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function tarefas()
    {
        return $this->hasMany(Tarefa::class);
    }

}
