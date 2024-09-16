<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalhes do Usuário</title>
</head>
<body>
    <div class="container mt-4">
        <h1>Detalhes do Usuário</h1>
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <p class="form-control">{{ $user->name }}</p>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <p class="form-control">{{ $user->email }}</p>
        </div>
        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Editar</a>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
