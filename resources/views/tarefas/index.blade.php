<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Lista de Tarefas</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Tarefas</h1>
        <a href="{{ route('tarefas.create') }}" class="btn btn-primary mb-3">Nova Tarefa</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Data Início</th>
                    <th>Data Término</th>
                    <th>Projeto</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tarefas as $tarefa)
                <tr>
                    <td>{{ $tarefa->id }}</td>
                    <td>{{ $tarefa->titulo }}</td>
                    <td>{{ $tarefa->descricao }}</td>
                    <td>{{ $tarefa->data_inicio }}</td>
                    <td>{{ $tarefa->data_termino }}</td>
                    <td>{{ $tarefa->projeto->titulo ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('tarefas.show', $tarefa->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('tarefas.edit', $tarefa->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('tarefas.destroy', $tarefa->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
