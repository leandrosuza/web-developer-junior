<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso Negado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .access-denied-card { background: #fff; border-radius: 1.5rem; box-shadow: 0 8px 32px 0 rgba(76, 68, 182, 0.18); padding: 3rem 2.5rem; text-align: center; max-width: 420px; }
        .access-denied-icon { font-size: 4rem; color: #dc2626; margin-bottom: 1.2rem; }
        .access-denied-card h2 { font-size: 2.1rem; font-weight: 800; color: #dc2626; margin-bottom: 1rem; }
        .access-denied-card p { color: #6b7280; font-size: 1.15rem; margin-bottom: 2rem; }
        .btn-admin-back { background: #6366f1; color: #fff; font-weight: 700; border-radius: 0.8rem; padding: 0.7rem 2.2rem; font-size: 1.1rem; border: none; transition: background 0.2s; }
        .btn-admin-back:hover { background: #3730a3; color: #fff; }
    </style>
</head>
<body>
    <div class="access-denied-card">
        <div class="access-denied-icon">
            <i class="fas fa-ban"></i>
        </div>
        <h2>Acesso Negado</h2>
        <p>Você não tem permissão para acessar esta página.<br>Faça login para continuar ou retorne ao painel.</p>
        <a href="/admin" class="btn-admin-back"><i class="fas fa-sign-in-alt me-2"></i>Ir para Login</a>
    </div>
</body>
</html> 