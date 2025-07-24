$(function() {
    // Mostrar/ocultar senha
    $('#togglePassword').on('click', function() {
        const $input = $('#password');
        const type = $input.attr('type') === 'password' ? 'text' : 'password';
        $input.attr('type', type);
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });
    // Validação Bootstrap + shake
    $('#loginForm').on('submit', function(e) {
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('shake');
            setTimeout(() => { $(this).removeClass('shake'); }, 500);
        }
        $(this).addClass('was-validated');
    });
}); 