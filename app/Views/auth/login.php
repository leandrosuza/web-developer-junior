<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Moderno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/unavailable.css">
    <link rel="stylesheet" href="/assets/css/login.css">
</head>
<body class="gradient-bg d-flex align-items-center justify-content-center min-vh-100 p-4">
<div class="login-card position-relative">
    <div class="login-card-header">
        <div class="overlay"></div>
        <div class="header-content">
            <h1>Painel do Blog</h1>
            <p>Acesso restrito aos administradores</p>
        </div>
        <div class="login-user-avatar">
            <i class="fas fa-user-circle"></i>
        </div>
    </div>
    <div class="login-card-body">
        <!-- Mensagem de erro de login -->
        <?php if (session('error')): ?>
            <div class="alert alert-danger text-center fw-semibold" role="alert" style="margin-top:1rem;">
                <i class="fas fa-exclamation-triangle me-2"></i> <?= esc(session('error')) ?>
            </div>
        <?php endif; ?>
        <form id="loginForm" class="needs-validation" method="post" action="/admin" novalidate>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope text-secondary"></i></span>
                    <input id="email" name="email" type="email" class="form-control" placeholder="your@email.com" required autofocus>
                    <div class="invalid-feedback">Informe um e-mail válido.</div>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock text-secondary"></i></span>
                    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                    <button type="button" id="togglePassword" class="btn btn-outline-secondary"><i class="fas fa-eye"></i></button>
                    <div class="invalid-feedback">Please enter your password.</div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" name="remember-me">
                    <label class="form-check-label" for="remember-me">Lembrar-me</label>
                </div>
                <a href="#" class="small">Forgot your password?</a>
            </div>
            <button type="submit" class="btn btn-primary w-100 fw-bold">Acessar Painel <i class="fas fa-arrow-right ms-2"></i></button>
        </form>
        <div class="mt-4 text-center small">
            <p class="text-secondary mb-0">
                Problemas para acessar? <a href="#" class="fw-medium">Contate o suporte</a>
            </p>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/js/unavailable.js"></script>
<script src="/assets/js/login.js"></script>
</body>
</html>