// login.js
// Gerencia interações da tela de login (formulário, lembrar-me, validação, etc.)
// Contextos: página de login

// =======================
// Mostrar/Ocultar Senha
// Aplica em: página de login (campo senha)
// =======================
$(function() {
    $('#togglePassword').on('click', function() {
        const $input = $('#password');
        const type = $input.attr('type') === 'password' ? 'text' : 'password';
        $input.attr('type', type);
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });

// =======================
// Validação e Shake
// Aplica em: página de login (formulário)
// =======================
    $('#loginForm').on('submit', function(e) {
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('shake');
            setTimeout(() => { $(this).removeClass('shake'); }, 500);
        }
        $(this).addClass('was-validated');
        // Lógica lembrar-me
        if ($('#remember-me').is(':checked')) {
            localStorage.setItem('login_email', $('#email').val());
            localStorage.setItem('login_remember', '1');
        } else {
            localStorage.removeItem('login_email');
            localStorage.removeItem('login_remember');
        }
    });

// =======================
// Preencher campos se lembrar-me
// Aplica em: página de login (formulário)
// =======================
    if (localStorage.getItem('login_remember') === '1') {
        $('#email').val(localStorage.getItem('login_email') || '');
        $('#remember-me').prop('checked', true);
    } else {
        $('#email').val('');
        $('#remember-me').prop('checked', false);
    }

// =======================
// Limpar ao desmarcar lembrar-me
// Aplica em: página de login (formulário)
// =======================
    $('#remember-me').on('change', function() {
        if (!$(this).is(':checked')) {
            localStorage.removeItem('login_email');
            localStorage.removeItem('login_remember');
            $('#email').val('');
        }
    });

// =======================
// Nunca preencher senha automaticamente
// Aplica em: página de login (campo senha)
// =======================
    $('#password').val('');
}); 