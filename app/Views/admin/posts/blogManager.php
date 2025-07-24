<?php
// Proteção extra: impedir acesso direto sem autenticação
if (!session('user_id') || !session('session_token')) {
    echo view('errors/html/access_denied');
    exit;
}
// Opcional: validar token no banco (reforço)
$user = \App\Models\User::find(session('user_id'));
if (!$user || $user->session_token !== session('session_token')) {
    session()->destroy();
    echo view('errors/html/access_denied');
    exit;
}
?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>
</head>
<body>
<div class="d-flex">
    <nav class="sidebar d-flex flex-column vh-100">
        <div class="sidebar-header">
            <h1 class="h4 mb-0">
                <i class="fas fa-blog me-2"></i>Blog Manager
            </h1>
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
                <a href="#" class="nav-link"><i class="fas fa-tags me-2"></i>Categories</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-comments me-2"></i>Comentários</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-users me-2"></i>Usuários</a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link settings-link"><i class="fas fa-cog me-2"></i>Configurações</a>
            </li>
        </ul>
        <div class="mt-auto p-3 border-top d-flex align-items-center justify-content-center" style="min-height:90px;">
            <a href="/logout" class="btn btn-danger fw-bold d-flex align-items-center justify-content-center gap-2 logout" style="font-size:1.1rem; min-width: 180px; padding: 0.9rem 2.2rem;">
                <i class="fas fa-sign-out-alt"></i> Sair
            </a>
        </div>
    </nav>
    <div class="sidebar-overlay"></div>
    <nav class="navbar navbar-expand-lg navbar-light blogManager-navbar-fixed">
        <div class="container-fluid">
            <button class="btn d-lg-none" id="mobile-menu-button">
                <i class="fas fa-bars"></i>
            </button>
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
    <div class="flex-grow-1 page-transition fade-in" style="min-height:100vh;">
        <main class="container py-4">
            <?php
            $page = $_GET['page'] ?? 'dashboard';
            $partials = [
                'dashboard' => 'partials/_dashboard.php',
                'posts' => 'partials/_posts.php',
                'categories' => 'partials/_categories.php',
                'comments' => 'partials/_comments.php',
                'users' => 'partials/_users.php',
                'settings' => 'partials/_settings.php',
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/blogManager.js"></script>
<script src="/assets/js/unavailable.js"></script>
</body>
</html>