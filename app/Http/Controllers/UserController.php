<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Exibe uma lista de todos os usuários
    public function index()
    {
        $users = User::all(); // Lista todos os usuários
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
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('users.index');
    }

    // Exibe os detalhes de um usuário específico
    public function show(User $user)
    {
        return view('users.show', compact('user'));
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
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('users.index');
    }

    // Remove um usuário do banco de dados
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }
}
