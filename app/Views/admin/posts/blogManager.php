<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Manager | Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/blogManager.css">
    <link rel="stylesheet" href="/assets/css/unavailable.css">
</head>
<body>
<div class="d-flex">
    <nav class="sidebar d-flex flex-column vh-100">
        <div class="sidebar-header">
            <h1 class="h4 mb-0">Blog Manager</h1>
        </div>
        <div class="sidebar-user mb-3">
            <i class="fas fa-user"></i>
            <div>
                <div class="fw-bold">Admin User</div>
                <div class="text-muted small">Administrador</div>
            </div>
        </div>
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a href="#" class="nav-link active"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-newspaper me-2"></i>Posts</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-tags me-2"></i>Categorias</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-comments me-2"></i>Comentários</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-users me-2"></i>Usuários</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-cog me-2"></i>Configurações</a>
            </li>
        </ul>
        <div class="mt-auto p-3 border-top">
            <a href="#" class="nav-link logout"><i class="fas fa-sign-out-alt me-2"></i>Sair</a>
        </div>
    </nav>
    <div class="sidebar-overlay"></div>
    <div class="flex-grow-1" style="min-height:100vh;">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <button class="btn d-lg-none" id="mobile-menu-button">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="navbar-page-title ms-2">
                    <h2 class="navbar-title mb-0">Gerenciar Posts</h2>
                    <span class="navbar-subtitle mb-0" id="navbar-tip">Dica: Use o botão azul para criar um novo post rapidamente!</span>
                </div>
                <div class="navbar-actions d-flex align-items-center ms-auto">
                    <button class="btn position-relative me-3" data-bs-toggle="tooltip" title="Notificações">
                        <i class="fas fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle p-1 border border-light rounded-circle"></span>
                    </button>
                    <button class="btn position-relative me-3" data-bs-toggle="tooltip" title="Mensagens">
                        <i class="fas fa-envelope"></i>
                        <span class="position-absolute top-0 start-100 translate-middle p-1 border border-light rounded-circle"></span>
                    </button>
                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle text-white user-avatar" style="width: 2.5rem; height: 2.5rem;" data-bs-toggle="tooltip" title="Perfil do usuário">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
            </div>
        </nav>
        <main class="container py-4">
            <?php
            $page = $_GET['page'] ?? 'dashboard';
            $partials = [
                'dashboard' => 'partials/_dashboard.php',
                'posts' => 'partials/_posts.php',
                'categorias' => 'partials/_categorias.php',
                'comentários' => 'partials/_comentarios.php',
                'comentarios' => 'partials/_comentarios.php',
                'usuários' => 'partials/_usuarios.php',
                'usuarios' => 'partials/_usuarios.php',
                'configurações' => 'partials/_configuracoes.php',
                'configuracoes' => 'partials/_configuracoes.php',
            ];
            $pageKey = mb_strtolower($page);
            if (array_key_exists($pageKey, $partials) && file_exists(__DIR__ . '/' . $partials[$pageKey])) {
                include __DIR__ . '/' . $partials[$pageKey];
            } else {
                echo '<div class="alert alert-warning mt-4">Página não encontrada.</div>';
            }
            ?>
        </main>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/blogManager.js"></script>
<script src="/assets/js/unavailable.js"></script>
</body>
</html>