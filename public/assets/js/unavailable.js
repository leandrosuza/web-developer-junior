// unavailable.js
// Makes navigation elements and actions unavailable on specific pages of the system.
// Contexts: admin (dashboard, posts), login, blog, etc.

// =======================
// Utilities
// =======================
function bloquearElemento(el, balloonClass, iconClass) {
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
            balloon.innerHTML = `<i class="${iconClass}"></i> Resource Unavailable`;
            balloon.style.position = 'absolute';
            balloon.style.zIndex = '99999';
            document.body.appendChild(balloon);
        }
        const rect = el.getBoundingClientRect();
        balloon.style.display = 'flex';
        balloon.style.left = '-9999px';
        balloon.style.top = '-9999px';
        const balloonWidth = balloon.offsetWidth;
        const pageWidth = window.innerWidth;
        let left = window.scrollX + rect.right + 12;
        if (left + balloonWidth > pageWidth - 8) {
            left = window.scrollX + rect.left - balloonWidth - 12;
        }
        balloon.style.top = (window.scrollY + rect.top + rect.height/2 - 18) + 'px';
        balloon.style.left = left + 'px';
        balloon.style.display = 'flex';
    });
    el.addEventListener('mouseleave', function() {
        if (balloon) balloon.style.display = 'none';
    });
}

document.addEventListener('DOMContentLoaded', function() {
    // =======================
    // Context Detection
    // =======================
    // Define the context of the page to apply specific blockings.
    const isAdmin = document.querySelector('.sidebar') && document.querySelector('.navbar-actions');
    const isLogin = document.body.classList.contains('gradient-bg') && document.querySelector('.login-card');
    const isBlog = document.querySelector('.hero-bg') && document.querySelector('.gradient-text');

    let balloonClass = 'unavailable-balloon';
    let iconClass = 'fas fa-ban unavailable-icon';
    if (isAdmin) {
        balloonClass = 'admin-unavailable-balloon';
        iconClass = 'fas fa-ban admin-unavailable-icon';
    } else if (isLogin) {
        balloonClass = 'login-unavailable-balloon';
        iconClass = 'fas fa-ban login-unavailable-icon';
    } else if (isBlog) {
        balloonClass = 'blog-unavailable-balloon';
        iconClass = 'fas fa-ban blog-unavailable-icon';
    }

    // =======================
    // Blockings: Admin (Dashboard, Posts)
    // =======================
    if (isAdmin) {
        // Sidebar (except Dashboard, Posts, Settings)
        const sidebar = document.querySelector('.sidebar');
        if (sidebar) {
            const links = sidebar.querySelectorAll('.nav-link');
            links.forEach(link => {
                let text = link.textContent.trim().toLowerCase();
                text = text.normalize('NFD').replace(/[^a-z]/g, '');
                if (
                    text === 'dashboard' ||
                    text === 'posts' ||
                    text === 'configuracoes' ||
                    link.classList.contains('logout') ||
                    link.classList.contains('settings-link')
                ) {
                    link.style.cursor = '';
                    return;
                }
                bloquearElemento(link, balloonClass, iconClass);
            });
        }
        // Sidebar user
        bloquearElemento(document.querySelector('.sidebar-user'), balloonClass, iconClass);
        // Navbar actions and user-avatar
        const navbarActions = document.querySelector('.navbar-actions');
        if (navbarActions) {
            const actionBtns = navbarActions.querySelectorAll('.btn, .user-avatar');
            actionBtns.forEach(btn => bloquearElemento(btn, balloonClass, iconClass));
        }
        // Dashboard summary cards
        document.querySelectorAll('.row.g-4.mb-4 .card.shadow-sm').forEach(card => {
            bloquearElemento(card, balloonClass, iconClass);
        });
        // .btn-link
        document.querySelectorAll('.btn-link').forEach(el => {
            bloquearElemento(el, balloonClass, iconClass);
        });
    }

    // =======================
    // Blockings: Login
    // =======================
    if (isLogin) {
        // Button 'Contact Support'
        document.querySelectorAll('a').forEach(a => {
            if (a.textContent.trim().toLowerCase().includes('contate o suporte')) {
                bloquearElemento(a, balloonClass, iconClass);
            }
        });
        // Link 'Forgot your password?'
        document.querySelectorAll('a').forEach(a => {
            if (a.textContent.trim().toLowerCase().includes('esqueceu sua senha')) {
                bloquearElemento(a, balloonClass, iconClass);
            }
        });
    }

    // =======================
    // Blockings: Blog
    // =======================
    if (isBlog) {
        // Buttons and avatar in navbar
        document.querySelectorAll('.navbar-blur .btn, .navbar-blur .user-avatar').forEach(btn => {
            bloquearElemento(btn, balloonClass, iconClass);
        });
        // Navbar links (except logo)
        const navbarLinks = document.querySelectorAll('.navbar-blur a:not(:first-child)');
        navbarLinks.forEach(link => bloquearElemento(link, balloonClass, iconClass));
        // Mobile menu button
        const mobileMenuBtn = document.getElementById('mobileMenuButton');
        if (mobileMenuBtn) bloquearElemento(mobileMenuBtn, balloonClass, iconClass);
        // All <a> and <button> in navbar except logo
        const navbar = document.querySelector('.navbar-blur');
        if (navbar) {
            const navbarLinks = navbar.querySelectorAll('a, button');
            navbarLinks.forEach((el, idx) => {
                if (el.tagName.toLowerCase() === 'a' && idx === 0) return;
                bloquearElemento(el, balloonClass, iconClass);
            });
        }
        // All <a>, <button> and <input> visible on the page (except main logo and search)
        document.querySelectorAll('a, button, input').forEach(el => {
            if (el.closest('.navbar-blur') && el.tagName.toLowerCase() === 'a') {
                const navbar = el.closest('.navbar-blur');
                if (navbar && Array.from(navbar.querySelectorAll('a')).indexOf(el) === 0) return;
            }
            if (el.id === 'searchInput' || el.id === 'searchBtn') return;
            if (el.classList && el.classList.contains('btn-view')) return;
            bloquearElemento(el, balloonClass, iconClass);
        });
        // Button 'Load more posts'
        document.querySelectorAll('.btn.btn-outline-primary').forEach(btn => {
            if (btn.textContent.trim().toLowerCase() === 'carregar mais posts') {
                bloquearElemento(btn, balloonClass, iconClass);
            }
        });
    }

    // =======================
    // Global Blockings (Custom Navbar/Footer)
    // =======================
    document.querySelectorAll('.unavailable-navbar').forEach(el => {
        el.style.cursor = 'not-allowed';
        el.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            return false;
        }, true);
        if (el.id === 'darkModeToggle') {
            el.onclick = function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                return false;
            };
        }
        let balloon;
        el.addEventListener('mouseenter', function(e) {
            if (!balloon) {
                balloon = document.createElement('div');
                balloon.className = 'blog-unavailable-balloon';
                balloon.innerHTML = `<i class="fas fa-ban blog-unavailable-icon"></i> Resource Unavailable`;
                balloon.style.position = 'absolute';
                balloon.style.zIndex = '99999';
                document.body.appendChild(balloon);
            }
            const rect = el.getBoundingClientRect();
            balloon.style.display = 'flex';
            balloon.style.left = '-9999px';
            balloon.style.top = '-9999px';
            const balloonWidth = balloon.offsetWidth;
            const pageWidth = window.innerWidth;
            let left = window.scrollX + rect.right + 12;
            if (left + balloonWidth > pageWidth - 8) {
                left = window.scrollX + rect.left - balloonWidth - 12;
            }
            balloon.style.top = (window.scrollY + rect.top + rect.height/2 - 18) + 'px';
            balloon.style.left = left + 'px';
            balloon.style.display = 'flex';
        });
        el.addEventListener('mouseleave', function() {
            if (balloon) balloon.style.display = 'none';
        });
    });
    document.querySelectorAll('.unavailable-footer').forEach(el => {
        el.style.cursor = 'not-allowed';
        el.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            return false;
        }, true);
        if (el.id === 'darkModeToggle') {
            el.onclick = function(e) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                return false;
            };
        }
        let balloon;
        el.addEventListener('mouseenter', function(e) {
            if (!balloon) {
                balloon = document.createElement('div');
                balloon.className = 'blog-unavailable-balloon';
                balloon.innerHTML = `<i class="fas fa-ban blog-unavailable-icon"></i> Resource Unavailable`;
                balloon.style.position = 'absolute';
                balloon.style.zIndex = '99999';
                document.body.appendChild(balloon);
            }
            const rect = el.getBoundingClientRect();
            balloon.style.display = 'flex';
            balloon.style.left = '-9999px';
            balloon.style.top = '-9999px';
            const balloonWidth = balloon.offsetWidth;
            const pageWidth = window.innerWidth;
            let left = window.scrollX + rect.right + 12;
            if (left + balloonWidth > pageWidth - 8) {
                left = window.scrollX + rect.left - balloonWidth - 12;
            }
            balloon.style.top = (window.scrollY + rect.top + rect.height/2 - 18) + 'px';
            balloon.style.left = left + 'px';
            balloon.style.display = 'flex';
        });
        el.addEventListener('mouseleave', function() {
            if (balloon) balloon.style.display = 'none';
        });
    });
}); 