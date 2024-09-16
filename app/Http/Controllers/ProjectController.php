<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tarefa;
use App\Models\Cliente;

class ProjectController extends Controller
{
    // Exibe uma lista de todos os projetos
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    // Mostra o formulário para criar um novo projeto
    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get();
        return view('projects.create', compact('clientes'));
    }

    // Armazena um novo projeto no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio' => 'required|date',
            'data_termino' => 'nullable|date',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $project = new Project();
        $project->titulo = mb_strtoupper($request->titulo, 'UTF-8');
        $project->descricao = $request->descricao;
        $project->data_inicio = $request->data_inicio;
        $project->data_termino = $request->data_termino;
        $project->cliente_id = $request->cliente_id;
        $project->save();

        return redirect()->route('projects.index');
    }

    // Exibe os detalhes de um projeto específico
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    // Mostra o formulário para editar um projeto existente
    public function edit(Project $project)
    {
        $clientes = Cliente::all();
        return view('projects.edit', compact('project', 'clientes'));
    }

    // Atualiza um projeto existente no banco de dados
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_inicio' => 'required|date',
            'data_termino' => 'nullable|date',
            'cliente_id' => 'required|exists:clientes,id',
        ]);

        $project->titulo = mb_strtoupper($request->titulo, 'UTF-8');
        $project->descricao = $request->descricao;
        $project->data_inicio = $request->data_inicio;
        $project->data_termino = $request->data_termino;
        $project->cliente_id = $request->cliente_id;
        $project->save();

        return redirect()->route('projects.index');
    }

    // Remove um projeto do banco de dados
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }
}
