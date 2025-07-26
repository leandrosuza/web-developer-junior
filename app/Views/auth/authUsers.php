<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticação - Blog</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/authUsers.css">
</head>
<body class="auth-bg d-flex align-items-center justify-content-center min-vh-100 p-4">
    <div class="auth-container">
        <!-- Card Principal -->
        <div class="auth-card" id="authCard">
            <!-- Header do Card -->
            <div class="auth-card-header">
                <div class="header-overlay"></div>
                <div class="header-content">
                    <div class="auth-logo">
                        <i class="fas fa-blog"></i>
                    </div>
                    <h1 class="auth-title" id="authTitle">Bem-vindo ao Blog</h1>
                    <p class="auth-subtitle" id="authSubtitle">Faça login para continuar</p>
                </div>
            </div>

            <!-- Corpo do Card -->
            <div class="auth-card-body">
                <!-- Mensagens de Erro/Sucesso -->
                <div id="authMessages"></div>

                <!-- Formulário de Login -->
                <form id="loginForm" class="auth-form active" method="post" action="/auth/login">
                    <div class="form-group">
                        <label for="loginEmail" class="form-label">
                            <i class="fas fa-envelope"></i> Email
                        </label>
                        <input 
                            type="email" 
                            id="loginEmail" 
                            name="email" 
                            class="form-control" 
                            placeholder="seu@email.com" 
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label for="loginPassword" class="form-label">
                            <i class="fas fa-lock"></i> Senha
                        </label>
                        <div class="password-input-group">
                            <input 
                                type="password" 
                                id="loginPassword" 
                                name="password" 
                                class="form-control" 
                                placeholder="Sua senha" 
                                required
                            >
                            <button type="button" class="password-toggle" data-target="loginPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <div class="form-check">
                            <input type="checkbox" id="rememberMe" name="remember_me" class="form-check-input">
                            <label for="rememberMe" class="form-check-label">Lembrar-me</label>
                        </div>
                        <a href="#" class="forgot-password">Esqueceu a senha?</a>
                    </div>

                    <button type="submit" class="auth-btn primary">
                        <i class="fas fa-sign-in-alt"></i> Entrar
                    </button>
                </form>

                <!-- Formulário de Registro -->
                <form id="registerForm" class="auth-form" method="post" action="/auth/register">
                    <div class="register-grid">
                        <div class="form-group">
                            <label for="registerName" class="form-label">
                                <i class="fas fa-user"></i> Nome Completo
                            </label>
                            <input 
                                type="text" 
                                id="registerName" 
                                name="name" 
                                class="form-control" 
                                placeholder="Seu nome completo" 
                                required
                            >
                        </div>
                        <div class="form-group">
                            <label for="registerEmail" class="form-label">
                                <i class="fas fa-envelope"></i> Email
                            </label>
                            <input 
                                type="email" 
                                id="registerEmail" 
                                name="email" 
                                class="form-control" 
                                placeholder="seu@email.com" 
                                required
                            >
                        </div>
                        <div class="form-group">
                            <label for="registerPassword" class="form-label">
                                <i class="fas fa-lock"></i> Senha
                            </label>
                            <div class="password-input-group">
                                <input 
                                    type="password" 
                                    id="registerPassword" 
                                    name="password" 
                                    class="form-control" 
                                    placeholder="Mínimo 6 caracteres" 
                                    minlength="6"
                                    required
                                >
                                <button type="button" class="password-toggle" data-target="registerPassword">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="registerPasswordConfirm" class="form-label">
                                <i class="fas fa-lock"></i> Confirmar Senha
                            </label>
                            <div class="password-input-group">
                                <input 
                                    type="password" 
                                    id="registerPasswordConfirm" 
                                    name="password_confirm" 
                                    class="form-control" 
                                    placeholder="Confirme sua senha" 
                                    required
                                >
                                <button type="button" class="password-toggle" data-target="registerPasswordConfirm">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-options">
                        <div class="form-check">
                            <input type="checkbox" id="agreeTerms" name="agree_terms" class="form-check-input" required>
                            <label for="agreeTerms" class="form-check-label">
                                Concordo com os <a href="#" class="terms-link">Termos de Uso</a>
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="auth-btn primary">
                        <i class="fas fa-user-plus"></i> Criar Conta
                    </button>
                </form>

                <!-- Separador -->
                <div class="auth-separator">
                    <span>ou</span>
                </div>

                <!-- Botões de Alternância -->
                <div class="auth-toggle-buttons">
                    <button type="button" id="showLoginBtn" class="auth-toggle-btn active">
                        <i class="fas fa-sign-in-alt"></i> Já tenho conta
                    </button>
                    <button type="button" id="showRegisterBtn" class="auth-toggle-btn">
                        <i class="fas fa-user-plus"></i> Criar conta
                    </button>
                </div>

                <!-- Links Adicionais -->
                <div class="auth-footer">
                    <p class="text-center">
                        <a href="/blog" class="back-to-blog">
                            <i class="fas fa-arrow-left"></i> Voltar ao Blog
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/authUsers.js"></script>
</body>
</html> 