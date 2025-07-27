/**
 * AUTH USERS - JAVASCRIPT
 * Manages user authentication interface interactions
 * Features: login/register form switching, validation, animations
 */

// ========================================
// CONFIGURATION AND CONSTANTS
// ========================================

const AUTH_CONFIG = {
    animationDuration: 400,
    shakeDuration: 500,
    messageTimeout: 5000,
    passwordMinLength: 6
};

// ========================================
// INITIALIZATION
// ========================================

$(document).ready(function() {
    initializeAuthSystem();
    setupEventListeners();
    loadRememberedData();
});

// ========================================
// MAIN SYSTEM
// ========================================

function initializeAuthSystem() {
    // console.log('🔐 Authentication system initialized');
    
    // Set initial state
    setActiveForm('login');
    
    // Apply initial visual effects
    animateCardEntrance();
}

function setupEventListeners() {
    // Toggle buttons
    $('#showLoginBtn').on('click', () => switchToForm('login'));
    $('#showRegisterBtn').on('click', () => switchToForm('register'));
    
    // Password toggle
    $('.password-toggle').on('click', handlePasswordToggle);
    
    // Form validation
    $('#loginForm').on('submit', handleLoginSubmit);
    $('#registerForm').on('submit', handleRegisterSubmit);
    
    // Real-time validation
    setupRealTimeValidation();
    
    // Remember me functionality
    $('#rememberMe').on('change', handleRememberMe);
    
    // Password confirmation validation
    $('#registerPasswordConfirm').on('input', validatePasswordConfirmation);
}

// ========================================
// FORM SWITCHING
// Applies to: switching between login and register forms
// ========================================

function switchToForm(formType) {
    const isLogin = formType === 'login';
    
    // Update toggle buttons
    updateToggleButtons(formType);
    
    // Update headers
    updateHeaderContent(formType);
    
    // Animate form transition
    animateFormTransition(formType);
    
    // Update active state
    setActiveForm(formType);
    
    // Clear messages
    clearMessages();
    
    // Clear validations
    clearValidations();
    
    // console.log(`🔄 Switched to form: ${formType}`);
}

function updateToggleButtons(activeForm) {
    const loginBtn = $('#showLoginBtn');
    const registerBtn = $('#showRegisterBtn');
    
    if (activeForm === 'login') {
        loginBtn.addClass('active');
        registerBtn.removeClass('active');
    } else {
        registerBtn.addClass('active');
        loginBtn.removeClass('active');
    }
}

function updateHeaderContent(formType) {
    const title = $('#authTitle');
    const subtitle = $('#authSubtitle');
    
    if (formType === 'login') {
        title.text('Welcome back!');
        subtitle.text('Sign in to continue');
    } else {
        title.text('Create new account');
        subtitle.text('Join our community');
    }
    
    // Animate text change
    title.addClass('text-change');
    subtitle.addClass('text-change');
    
    setTimeout(() => {
        title.removeClass('text-change');
        subtitle.removeClass('text-change');
    }, 300);
}

function animateFormTransition(formType) {
    const loginForm = $('#loginForm');
    const registerForm = $('#registerForm');
    
    // Determine animation direction
    const direction = formType === 'login' ? -1 : 1;
    
    // Animate current form exit
    const currentForm = formType === 'login' ? registerForm : loginForm;
    const nextForm = formType === 'login' ? loginForm : registerForm;
    
    currentForm.css({
        'transform': `translateX(${direction * 20}px)`,
        'opacity': '0'
    });
    
    setTimeout(() => {
        currentForm.removeClass('active').hide();
        
        // Prepare next form
        nextForm.css({
            'transform': `translateX(${-direction * 20}px)`,
            'opacity': '0'
        }).show();
        
        // Animate entrance
        setTimeout(() => {
            nextForm.addClass('active').css({
                'transform': 'translateX(0)',
                'opacity': '1'
            });
        }, 50);
    }, AUTH_CONFIG.animationDuration / 2);
}

function setActiveForm(formType) {
    $('.auth-form').removeClass('active');
    $(`#${formType}Form`).addClass('active');
}

// ========================================
// ANIMATIONS AND VISUAL EFFECTS
// Applies to: card animations and visual feedback
// ========================================

function animateCardEntrance() {
    const card = $('#authCard');
    
    card.css({
        'opacity': '0',
        'transform': 'translateY(30px) scale(0.95)'
    });
    
    setTimeout(() => {
        card.css({
            'opacity': '1',
            'transform': 'translateY(0) scale(1)'
        });
    }, 100);
}

function shakeElement(element) {
    element.addClass('shake');
    setTimeout(() => {
        element.removeClass('shake');
    }, AUTH_CONFIG.shakeDuration);
}

// ========================================
// PASSWORD HANDLING
// Applies to: password visibility toggle
// ========================================

function handlePasswordToggle() {
    const button = $(this);
    const targetId = button.data('target');
    const input = $(`#${targetId}`);
    const icon = button.find('i');
    
    // Toggle input type
    const newType = input.attr('type') === 'password' ? 'text' : 'password';
    input.attr('type', newType);
    
    // Toggle icon
    icon.toggleClass('fa-eye fa-eye-slash');
    
    // Visual effect
    button.addClass('toggled');
    setTimeout(() => button.removeClass('toggled'), 200);
}

// ========================================
// FORM VALIDATION
// Applies to: real-time and submit validation
// ========================================

function setupRealTimeValidation() {
    // Email validation
    $('input[type="email"]').on('input', function() {
        validateEmail($(this));
    });
    
    // Password validation
    $('#registerPassword').on('input', function() {
        validatePassword($(this));
    });
    
    // Name validation
    $('#registerName').on('input', function() {
        validateName($(this));
    });
}

function validateEmail(input) {
    const email = input.val();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (email && !emailRegex.test(email)) {
        showFieldError(input, 'Invalid email');
        return false;
    } else {
        showFieldSuccess(input);
        return true;
    }
}

function validatePassword(input) {
    const password = input.val();
    
    if (password.length > 0 && password.length < AUTH_CONFIG.passwordMinLength) {
        showFieldError(input, `Minimum ${AUTH_CONFIG.passwordMinLength} characters`);
        return false;
    } else if (password.length >= AUTH_CONFIG.passwordMinLength) {
        showFieldSuccess(input);
        return true;
    } else {
        clearFieldValidation(input);
        return false;
    }
}

function validateName(input) {
    const name = input.val().trim();
    
    if (name.length > 0 && name.length < 2) {
        showFieldError(input, 'Name must have at least 2 characters');
        return false;
    } else if (name.length >= 2) {
        showFieldSuccess(input);
        return true;
    } else {
        clearFieldValidation(input);
        return false;
    }
}

function validatePasswordConfirmation() {
    const password = $('#registerPassword').val();
    const confirmPassword = $(this).val();
    
    if (confirmPassword && password !== confirmPassword) {
        showFieldError($(this), 'Passwords do not match');
        return false;
    } else if (confirmPassword && password === confirmPassword) {
        showFieldSuccess($(this));
        return true;
    } else {
        clearFieldValidation($(this));
        return false;
    }
}

function showFieldError(input, message) {
    input.removeClass('is-valid').addClass('is-invalid');
    
    // Remove previous feedback
    input.siblings('.invalid-feedback, .valid-feedback').remove();
    
    // Add new feedback
    input.after(`<div class="invalid-feedback">${message}</div>`);
}

function showFieldSuccess(input) {
    input.removeClass('is-invalid').addClass('is-valid');
    
    // Remove previous feedback
    input.siblings('.invalid-feedback, .valid-feedback').remove();
    
    // Add new feedback
    input.after('<div class="valid-feedback">Field valid</div>');
}

function clearFieldValidation(input) {
    input.removeClass('is-valid is-invalid');
    input.siblings('.invalid-feedback, .valid-feedback').remove();
}

function clearValidations() {
    $('.form-control').removeClass('is-valid is-invalid');
    $('.invalid-feedback, .valid-feedback').remove();
}

// ========================================
// FORM SUBMISSION
// Applies to: login and register form submissions
// ========================================

function handleLoginSubmit(e) {
    e.preventDefault();
    
    const form = $(this);
    const submitBtn = form.find('button[type="submit"]');
    
    // Validate form
    if (!validateLoginForm()) {
        shakeElement(form);
        return false;
    }
    
    // Show loading
    setButtonLoading(submitBtn, true);
    
    // Send data via AJAX
    $.ajax({
        url: '/auth/login',
        method: 'POST',
        data: form.serialize(),
        dataType: 'json',
        success: function(response) {
            setButtonLoading(submitBtn, false);
            
            if (response.success) {
                showMessage(response.message, 'success');
                
                // Redirect after success
                setTimeout(() => {
                    window.location.href = response.redirect || 'blog';
                }, 1500);
            } else {
                showMessage(response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            setButtonLoading(submitBtn, false);
            
            let message = 'Login error. Please try again.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }
            
            showMessage(message, 'error');
        }
    });
}

function handleRegisterSubmit(e) {
    e.preventDefault();
    
    const form = $(this);
    const submitBtn = form.find('button[type="submit"]');
    
    // Validate form
    if (!validateRegisterForm()) {
        shakeElement(form);
        return false;
    }
    
    // Show loading
    setButtonLoading(submitBtn, true);
    
    // Send data via AJAX
    $.ajax({
        url: '/auth/register',
        method: 'POST',
        data: form.serialize(),
        dataType: 'json',
        success: function(response) {
            setButtonLoading(submitBtn, false);
            
            if (response.success) {
                showMessage(response.message, 'success');
                
                // Switch to login after success
                setTimeout(() => {
                    switchToForm('login');
                }, 2000);
            } else {
                showMessage(response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            setButtonLoading(submitBtn, false);
            
            let message = 'Registration error. Please try again.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }
            
            showMessage(message, 'error');
        }
    });
}

function validateLoginForm() {
    const email = $('#loginEmail').val().trim();
    const password = $('#loginPassword').val();
    
    let isValid = true;
    
    if (!email) {
        showFieldError($('#loginEmail'), 'Email is required');
        isValid = false;
    } else if (!validateEmail($('#loginEmail'))) {
        isValid = false;
    }
    
    if (!password) {
        showFieldError($('#loginPassword'), 'Password is required');
        isValid = false;
    }
    
    return isValid;
}

function validateRegisterForm() {
    const name = $('#registerName').val().trim();
    const email = $('#registerEmail').val().trim();
    const password = $('#registerPassword').val();
    const confirmPassword = $('#registerPasswordConfirm').val();
    const agreeTerms = $('#agreeTerms').is(':checked');
    
    let isValid = true;
    
    if (!name || !validateName($('#registerName'))) {
        isValid = false;
    }
    
    if (!email || !validateEmail($('#registerEmail'))) {
        isValid = false;
    }
    
    if (!password || !validatePassword($('#registerPassword'))) {
        isValid = false;
    }
    
    if (!confirmPassword || !validatePasswordConfirmation.call($('#registerPasswordConfirm'))) {
        isValid = false;
    }
    
    if (!agreeTerms) {
        showMessage('You must agree to the terms of use', 'error');
        isValid = false;
    }
    
    return isValid;
}

// ========================================
// HELPER FUNCTIONS
// Applies to: utility functions and helpers
// ========================================

function setButtonLoading(button, loading) {
    if (loading) {
        button.addClass('loading').prop('disabled', true);
        button.find('i').hide();
    } else {
        button.removeClass('loading').prop('disabled', false);
        button.find('i').show();
    }
}

function handleRememberMe() {
    const isChecked = $(this).is(':checked');
    
    if (isChecked) {
        localStorage.setItem('auth_remember_email', $('#loginEmail').val());
        localStorage.setItem('auth_remember_me', '1');
    } else {
        localStorage.removeItem('auth_remember_email');
        localStorage.removeItem('auth_remember_me');
    }
}

function loadRememberedData() {
    if (localStorage.getItem('auth_remember_me') === '1') {
        const rememberedEmail = localStorage.getItem('auth_remember_email');
        if (rememberedEmail) {
            $('#loginEmail').val(rememberedEmail);
            $('#rememberMe').prop('checked', true);
        }
    }
}

// ========================================
// MESSAGE SYSTEM
// Applies to: success, error, and info messages
// ========================================

// Enhanced alert system
let currentMessage = null;
let messageTimeout = null;

function showMessage(message, type = 'info') {
    const messagesContainer = $('#authMessages');
    
    // If same message already exists, just animate
    if (currentMessage && currentMessage.type === type && currentMessage.text === message) {
        animateExistingMessage();
        return;
    }
    
    // If different message exists, fade out current
    if (currentMessage) {
        fadeOutCurrentMessage(() => {
            createNewMessage(message, type);
        });
    } else {
        createNewMessage(message, type);
    }
}

function createNewMessage(message, type) {
    const messagesContainer = $('#authMessages');
    const messageId = 'msg_' + Date.now();
    
    const messageHtml = `
        <div id="${messageId}" class="auth-message ${type} message-new">
            <i class="fas ${getMessageIcon(type)}"></i>
            <span>${message}</span>
        </div>
    `;
    
    messagesContainer.html(messageHtml);
    
    // Animate entrance
    setTimeout(() => {
        $(`#${messageId}`).removeClass('message-new');
    }, 10);
    
    // Store current message reference
    currentMessage = {
        id: messageId,
        type: type,
        text: message
    };
    
    // Auto-remove after timeout
    if (messageTimeout) {
        clearTimeout(messageTimeout);
    }
    
    messageTimeout = setTimeout(() => {
        fadeOutCurrentMessage();
    }, AUTH_CONFIG.messageTimeout);
}

function animateExistingMessage() {
    if (!currentMessage) return;
    
    const messageElement = $(`#${currentMessage.id}`);
    if (messageElement.length) {
        // Pulse animation for same message
        messageElement.addClass('message-pulse');
        setTimeout(() => {
            messageElement.removeClass('message-pulse');
        }, 300);
        
        // Reset timeout
        if (messageTimeout) {
            clearTimeout(messageTimeout);
        }
        
        messageTimeout = setTimeout(() => {
            fadeOutCurrentMessage();
        }, AUTH_CONFIG.messageTimeout);
    }
}

function fadeOutCurrentMessage(callback = null) {
    if (!currentMessage) {
        if (callback) callback();
        return;
    }
    
    const messageElement = $(`#${currentMessage.id}`);
    if (messageElement.length) {
        messageElement.addClass('message-fade-out');
        setTimeout(() => {
            messageElement.remove();
            currentMessage = null;
            if (callback) callback();
        }, 300);
    } else {
        currentMessage = null;
        if (callback) callback();
    }
    
    if (messageTimeout) {
        clearTimeout(messageTimeout);
        messageTimeout = null;
    }
}

function clearMessages() {
    fadeOutCurrentMessage();
    $('#authMessages').empty();
}

function getMessageIcon(type) {
    const icons = {
        success: 'fa-check-circle',
        error: 'fa-exclamation-circle',
        warning: 'fa-exclamation-triangle',
        info: 'fa-info-circle'
    };
    
    return icons[type] || icons.info;
}

// ========================================
// UTILITIES
// Applies to: utility functions and helpers
// ========================================

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// ========================================
// GLOBAL EVENTS
// Applies to: global event handlers
// ========================================

// Prevent form submission with Enter on specific fields
$(document).on('keypress', 'input', function(e) {
    if (e.which === 13) {
        const form = $(this).closest('form');
        if (form.length) {
            e.preventDefault();
            form.submit();
        }
    }
});

// Focus on first field when switching forms
$(document).on('shown.bs.tab', function() {
    const activeForm = $('.auth-form.active');
    const firstInput = activeForm.find('input:first');
    if (firstInput.length) {
        firstInput.focus();
    }
});

// ========================================
// DEBUG AND LOGS
// Applies to: development debugging features
// ========================================

if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
    // console.log('🐛 Debug mode active');
    
    // Expose functions for debugging
    window.authDebug = {
        switchToForm,
        showMessage,
        clearMessages,
        testAlerts: function() {
            // console.log('🧪 Testing alert system...');
            
            // Test 1: First message
            showMessage('Success message test', 'success');
            
            // Test 2: Same message (should pulse)
            setTimeout(() => {
                showMessage('Success message test', 'success');
            }, 2000);
            
            // Test 3: Different message (should fade out/in)
            setTimeout(() => {
                showMessage('Different error message', 'error');
            }, 4000);
            
            // Test 4: Clear messages
            setTimeout(() => {
                clearMessages();
            }, 6000);
        }
    };
    
    // Add test button if it doesn't exist
    setTimeout(() => {
        if (!document.getElementById('debugTestBtn')) {
            const testBtn = document.createElement('button');
            testBtn.id = 'debugTestBtn';
            testBtn.innerHTML = '🧪 Test Alerts';
            testBtn.style.cssText = `
                position: fixed;
                top: 10px;
                right: 10px;
                z-index: 9999;
                padding: 8px 12px;
                background: #667eea;
                color: white;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                font-size: 12px;
            `;
            testBtn.onclick = window.authDebug.testAlerts;
            document.body.appendChild(testBtn);
        }
    }, 1000);
} 