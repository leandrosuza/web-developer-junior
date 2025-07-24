// unavailable.js
// Torna elementos indisponíveis, mostra cursor bloqueado e balão de mensagem

document.addEventListener('DOMContentLoaded', function() {
    // Função utilitária para aplicar bloqueio e balão
    function bloquearElemento(el, balloonClass, iconClass, iconHtml) {
        if (!el) return;
        el.style.cursor = 'not-allowed';
        el.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            return false;
        });
        let balloon;
        el.addEventListener('mouseenter', function(e) {
            if (!balloon) {
                balloon = document.createElement('div');
                balloon.className = balloonClass;
                balloon.innerHTML = `<i class="${iconClass}"></i> Recurso Indisponível`;
                balloon.style.position = 'absolute';
                balloon.style.zIndex = '99999';
                document.body.appendChild(balloon);
            }
            const rect = el.getBoundingClientRect();
            balloon.style.top = (window.scrollY + rect.top + rect.height/2 - 18) + 'px';
            balloon.style.left = (window.scrollX + rect.right + 12) + 'px';
            balloon.style.display = 'flex';
        });
        el.addEventListener('mouseleave', function() {
            if (balloon) balloon.style.display = 'none';
        });
    }

    // Detectar contexto da página
    const isAdmin = document.querySelector('.sidebar') && document.querySelector('.navbar-actions');
    const isLogin = document.body.classList.contains('gradient-bg') && document.querySelector('.login-card');
    const isBlog = document.querySelector('.hero-bg') && document.querySelector('.gradient-text');

    // Definir classes de balão/ícone por contexto
    let balloonClass = 'unavailable-balloon';
    let iconClass = 'fas fa-ban unavailable-icon';
    if (isAdmin) {
        balloonClass = 'blogManager-unavailable-balloon';
        iconClass = 'fas fa-ban blogManager-unavailable-icon';
    } else if (isLogin) {
        balloonClass = 'login-unavailable-balloon';
        iconClass = 'fas fa-ban login-unavailable-icon';
    } else if (isBlog) {
        balloonClass = 'blog-unavailable-balloon';
        iconClass = 'fas fa-ban blog-unavailable-icon';
    }

    // Sidebar links (exceto Dashboard e Posts)
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        const links = sidebar.querySelectorAll('.nav-link');
        links.forEach(link => {
            const text = link.textContent.trim().toLowerCase();
            if (text === 'dashboard' || text === 'posts') {
                link.style.cursor = '';
                return;
            }
            bloquearElemento(link, balloonClass, iconClass);
        });
    }

    // Sidebar user
    bloquearElemento(document.querySelector('.sidebar-user'), balloonClass, iconClass);

    // Navbar actions e user-avatar
    const navbarActions = document.querySelector('.navbar-actions');
    if (navbarActions) {
        const actionBtns = navbarActions.querySelectorAll('.btn, .user-avatar');
        actionBtns.forEach(btn => bloquearElemento(btn, balloonClass, iconClass));
    }

    // Botão 'Carregar mais posts'
    document.querySelectorAll('.btn.btn-outline-primary').forEach(btn => {
        if (btn.textContent.trim().toLowerCase() === 'carregar mais posts') {
            bloquearElemento(btn, balloonClass, iconClass);
        }
    });

    // Botão 'Contate o suporte' na tela de login
    document.querySelectorAll('a').forEach(a => {
        if (a.textContent.trim().toLowerCase().includes('contate o suporte')) {
            bloquearElemento(a, balloonClass, iconClass);
        }
    });

    // LOGIN: bloquear o link 'Esqueceu sua senha?'
    if (isLogin) {
        document.querySelectorAll('a').forEach(a => {
            if (a.textContent.trim().toLowerCase().includes('esqueceu sua senha')) {
                bloquearElemento(a, balloonClass, iconClass);
            }
        });
    }

    // BLOG: bloquear botões da navbar
    if (isBlog) {
        document.querySelectorAll('.navbar-blur .btn, .navbar-blur .user-avatar').forEach(btn => {
            bloquearElemento(btn, balloonClass, iconClass);
        });
    }

    // BLOG: bloquear links da navbar (exceto logo) e botão do menu mobile
    if (isBlog) {
        const navbarLinks = document.querySelectorAll('.navbar-blur a:not(:first-child)');
        navbarLinks.forEach(link => bloquearElemento(link, balloonClass, iconClass));
        const mobileMenuBtn = document.getElementById('mobileMenuButton');
        if (mobileMenuBtn) bloquearElemento(mobileMenuBtn, balloonClass, iconClass);
    }

    // BLOG: bloquear todos os <a>, <button> e elementos clicáveis na navbar, footer e página (exceto logo principal)
    if (isBlog) {
        // Bloquear todos os <a> e <button> na navbar exceto o logo
        const navbar = document.querySelector('.navbar-blur');
        if (navbar) {
            const navbarLinks = navbar.querySelectorAll('a, button');
            navbarLinks.forEach((el, idx) => {
                // Permitir apenas o logo principal (primeiro <a>)
                if (el.tagName.toLowerCase() === 'a' && idx === 0) return;
                bloquearElemento(el, balloonClass, iconClass);
            });
        }
        // Bloquear todos os <a> e <button> no footer
        document.querySelectorAll('footer a, footer button').forEach(el => {
            bloquearElemento(el, balloonClass, iconClass);
        });
        // Bloquear todos os <a> e <button> visíveis na página (exceto logo principal)
        document.querySelectorAll('a, button').forEach(el => {
            // Permitir apenas o logo principal (primeiro <a> da navbar)
            if (el.closest('.navbar-blur') && el.tagName.toLowerCase() === 'a') {
                const navbar = el.closest('.navbar-blur');
                if (navbar && Array.from(navbar.querySelectorAll('a')).indexOf(el) === 0) return;
            }
            bloquearElemento(el, balloonClass, iconClass);
        });
    }
}); 