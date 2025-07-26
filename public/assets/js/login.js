// ========================================
// LOGIN - MAIN SCRIPT
// ========================================

// =======================
// 1. PASSWORD TOGGLE
// Applies to: login page password field visibility
// =======================

$(function() {
    $('#togglePassword').on('click', function() {
        const $input = $('#password');
        const type = $input.attr('type') === 'password' ? 'text' : 'password';
        $input.attr('type', type);
        $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    });

    // =======================
    // 2. FORM VALIDATION
    // Applies to: login form validation and shake effect
    // =======================
    
    $('#loginForm').on('submit', function(e) {
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            $(this).addClass('shake');
            setTimeout(() => { $(this).removeClass('shake'); }, 500);
        }
        $(this).addClass('was-validated');
        
        // Remember me functionality
        if ($('#remember-me').is(':checked')) {
            localStorage.setItem('login_email', $('#email').val());
            localStorage.setItem('login_remember', '1');
        } else {
            localStorage.removeItem('login_email');
            localStorage.removeItem('login_remember', '1');
        }
    });

    // =======================
    // 3. REMEMBER ME DATA
    // Applies to: loading remembered email data
    // =======================
    
    if (localStorage.getItem('login_remember') === '1') {
        $('#email').val(localStorage.getItem('login_email') || '');
        $('#remember-me').prop('checked', true);
    } else {
        $('#email').val('');
        $('#remember-me').prop('checked', false);
    }

    // =======================
    // 4. REMEMBER ME TOGGLE
    // Applies to: clearing data when unchecked
    // =======================
    
    $('#remember-me').on('change', function() {
        if (!$(this).is(':checked')) {
            localStorage.removeItem('login_email');
            localStorage.removeItem('login_remember');
            $('#email').val('');
        }
    });

    // =======================
    // 5. PASSWORD SECURITY
    // Applies to: never auto-fill password field
    // =======================
    
    $('#password').val('');
}); 