<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Exibe uma lista de todos os usuários
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Mostra o formulário para criar um novo usuário
    public function create()
    {
        return view('users.create');
    }

    // Armazena um novo usuário no banco de dados
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        return redirect()->route('users.index')->with('success', 'Usuário criado com sucesso.');
    }

    // Mostra o formulário para editar um usuário existente
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Atualiza um usuário existente no banco de dados
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    // Exibe os detalhes de um usuário
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    // Remove um usuário do banco de dados
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuário excluído com sucesso.');
    }
}
