// ========================================
// UNAVAILABLE - MAIN SCRIPT
// ========================================

// =======================
// 1. CONFIGURATION
// Applies to: global settings and constants
// =======================

const UNAVAILABLE_CONFIG = {
    balloonDelay: 300,
    animationDuration: 300,
    zIndex: 99999,
    maxBalloons: 1
};

// =======================
// 2. UTILITIES
// Applies to: core utility functions
// =======================

/**
 * Block element with unavailable functionality
 * @param {HTMLElement} el - Element to block
 * @param {string} balloonClass - CSS class for balloon
 * @param {string} iconClass - CSS class for icon
 */
function bloquearElemento(el, balloonClass, iconClass) {
    if (!el || el.classList?.contains('no-unavailable') || el.classList?.contains('unavailable-element')) return;
    
    // Skip dropdown elements completely
    if (el.id === 'userDropdownBtn' || el.id === 'userDropdown' || 
        el.closest('#userDropdownBtn') || el.closest('#userDropdown')) {
        return;
    }
    
    // Add unavailable class
    el.classList.add('unavailable-element');
    
    // Set cursor and prevent interactions
    el.style.cursor = 'not-allowed';
    el.style.pointerEvents = 'auto';
    
    // Prevent clicks
    el.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();
        return false;
    }, true);
    
    // Create balloon on hover
    let balloon = null;
    let balloonTimeout = null;
    
    el.addEventListener('mouseenter', function(e) {
        if (balloonTimeout) clearTimeout(balloonTimeout);
        
        balloonTimeout = setTimeout(() => {
            if (!balloon) {
                balloon = createBalloon(balloonClass, iconClass);
                document.body.appendChild(balloon);
            }
            positionBalloon(balloon, el);
        }, UNAVAILABLE_CONFIG.balloonDelay);
    });
    
    el.addEventListener('mouseleave', function() {
        if (balloonTimeout) clearTimeout(balloonTimeout);
        if (balloon) {
            balloon.style.display = 'none';
        }
    });
}

/**
 * Create balloon element
 * @param {string} balloonClass - CSS class for balloon
 * @param {string} iconClass - CSS class for icon
 * @returns {HTMLElement} Balloon element
 */
function createBalloon(balloonClass, iconClass) {
    const balloon = document.createElement('div');
    balloon.className = `unavailable-balloon ${balloonClass}`;
    balloon.innerHTML = `
        <i class="${iconClass}"></i>
        <span>Resource Unavailable</span>
    `;
    balloon.style.position = 'absolute';
    balloon.style.zIndex = UNAVAILABLE_CONFIG.zIndex;
    balloon.style.display = 'none';
    return balloon;
}

/**
 * Position balloon relative to element
 * @param {HTMLElement} balloon - Balloon element
 * @param {HTMLElement} el - Target element
 */
function positionBalloon(balloon, el) {
    const rect = el.getBoundingClientRect();
    const balloonWidth = balloon.offsetWidth || 200;
    const pageWidth = window.innerWidth;
    
    // Calculate position
    let left = window.scrollX + rect.right + 12;
    let arrowClass = '';
    
    // Check if balloon would go off screen
    if (left + balloonWidth > pageWidth - 8) {
        left = window.scrollX + rect.left - balloonWidth - 12;
        arrowClass = 'arrow-right';
    }
    
    const top = window.scrollY + rect.top + rect.height / 2 - 18;
    
    // Apply position and show
    balloon.className = `unavailable-balloon ${balloon.className.split(' ').slice(1).join(' ')} ${arrowClass}`;
    balloon.style.left = left + 'px';
    balloon.style.top = top + 'px';
    balloon.style.display = 'flex';
}

/**
 * Detect page context for appropriate styling
 * @returns {Object} Context information
 */
function detectContext() {
    const isAdmin = document.querySelector('.sidebar') && document.querySelector('.navbar-actions');
    const isLogin = document.body.classList.contains('gradient-bg') && document.querySelector('.login-card');
    const isBlog = document.querySelector('.hero-bg') && document.querySelector('.gradient-text');
    const isAuthUsers = document.querySelector('.auth-container') && document.querySelector('.auth-card');
    const isDetails = document.querySelector('.details-container') && document.querySelector('.comments-section');
    
    let context = 'default';
    let balloonClass = 'unavailable-balloon';
    let iconClass = 'fas fa-ban unavailable-icon';
    
    if (isAdmin) {
        context = 'admin';
    } else if (isLogin) {
        context = 'login';
    } else if (isDetails) {
        context = 'details';
    } else if (isBlog) {
        context = 'blog';
    } else if (isAuthUsers) {
        context = 'auth';
    }
    
    return { context, balloonClass, iconClass };
}

/**
 * Force enable no-unavailable elements
 */
function forceNoUnavailable() {
    document.querySelectorAll('.no-unavailable').forEach(el => {
        // Skip dropdown elements completely
        if (el.id === 'userDropdownBtn' || el.id === 'userDropdown' || 
            el.closest('#userDropdownBtn') || el.closest('#userDropdown')) {
            return;
        }
        
        el.classList.remove('unavailable-element');
        el.style.cursor = 'pointer';
        el.style.pointerEvents = 'auto';
        el.style.opacity = '1';
        
        // Only clone if not a dropdown element
        if (!el.id || (!el.id.includes('userDropdown') && !el.closest('#userDropdownBtn'))) {
            const newEl = el.cloneNode(true);
            el.parentNode.replaceChild(newEl, el);
        }
    });
    
    document.querySelectorAll('.no-unavailable *').forEach(el => {
        // Skip dropdown elements completely
        if (el.id === 'userDropdownBtn' || el.id === 'userDropdown' || 
            el.closest('#userDropdownBtn') || el.closest('#userDropdown')) {
            return;
        }
        
        el.style.cursor = 'pointer';
        el.style.pointerEvents = 'auto';
        el.style.opacity = '1';
    });
}

// =======================
// 3. CONTEXT-SPECIFIC BLOCKING
// Applies to: different blocking rules for different pages
// =======================

/**
 * Apply admin page blocking
 * @param {string} balloonClass - Balloon CSS class
 * @param {string} iconClass - Icon CSS class
 */
function applyAdminBlocking(balloonClass, iconClass) {
    // Sidebar navigation
    const sidebar = document.querySelector('.sidebar');
    if (sidebar) {
        sidebar.querySelectorAll('.nav-link').forEach(link => {
            if (link.classList?.contains('no-unavailable')) return;
            
            const text = link.textContent.trim().toLowerCase().normalize('NFD').replace(/[^a-z]/g, '');
            if (['dashboard', 'posts', 'configuracoes'].includes(text) || 
                link.classList.contains('logout') || 
                link.classList.contains('settings-link')) {
                return;
            }
            bloquearElemento(link, balloonClass, iconClass);
        });
    }
    
    // Sidebar user
    const sidebarUser = document.querySelector('.sidebar-user');
    if (sidebarUser && !sidebarUser.classList?.contains('no-unavailable')) {
        bloquearElemento(sidebarUser, balloonClass, iconClass);
    }
    
    // Navbar actions
    const navbarActions = document.querySelector('.navbar-actions');
    if (navbarActions) {
        navbarActions.querySelectorAll('.btn, .user-avatar').forEach(btn => {
            if (!btn.classList?.contains('no-unavailable')) {
                bloquearElemento(btn, balloonClass, iconClass);
            }
        });
    }
    
    // Dashboard cards
    document.querySelectorAll('.row.g-4.mb-4 .card.shadow-sm').forEach(card => {
        if (!card.classList?.contains('no-unavailable')) {
            bloquearElemento(card, balloonClass, iconClass);
        }
    });
    
    // Link buttons
    document.querySelectorAll('.btn-link').forEach(el => {
        if (!el.classList?.contains('no-unavailable')) {
            bloquearElemento(el, balloonClass, iconClass);
        }
    });
}

/**
 * Apply login page blocking
 * @param {string} balloonClass - Balloon CSS class
 * @param {string} iconClass - Icon CSS class
 */
function applyLoginBlocking(balloonClass, iconClass) {
    // Support contact button
    document.querySelectorAll('a').forEach(a => {
        if (a.textContent.trim().toLowerCase().includes('contate o suporte')) {
            bloquearElemento(a, balloonClass, iconClass);
        }
    });
    
    // Forgot password link
    document.querySelectorAll('a').forEach(a => {
        if (a.textContent.trim().toLowerCase().includes('esqueceu sua senha')) {
            bloquearElemento(a, balloonClass, iconClass);
        }
    });
}

/**
 * Apply blog page blocking
 * @param {string} balloonClass - Balloon CSS class
 * @param {string} iconClass - Icon CSS class
 */
function applyBlogBlocking(balloonClass, iconClass) {
    // Navbar elements (except logo)
    const navbar = document.querySelector('.navbar-blur');
    if (navbar) {
        navbar.querySelectorAll('a, button').forEach((el, idx) => {
            if (el.tagName.toLowerCase() === 'a' && idx === 0) return; // Skip logo
            if (!el.classList?.contains('no-unavailable')) {
                bloquearElemento(el, balloonClass, iconClass);
            }
        });
    }
    
    // Interactive elements (except search and view buttons)
    document.querySelectorAll('a, button, input').forEach(el => {
        if (el.classList?.contains('no-unavailable')) return;
        if (el.id === 'searchInput' || el.id === 'searchBtn') return;
        if (el.classList?.contains('btn-view')) return;
        
        // Skip logo link
        if (el.closest('.navbar-blur') && el.tagName.toLowerCase() === 'a') {
            const navbar = el.closest('.navbar-blur');
            if (navbar && Array.from(navbar.querySelectorAll('a')).indexOf(el) === 0) return;
        }
        
        bloquearElemento(el, balloonClass, iconClass);
    });
    
    // Load more posts button
    document.querySelectorAll('.btn.btn-outline-primary').forEach(btn => {
        if (btn.textContent.trim().toLowerCase() === 'carregar mais posts') {
            bloquearElemento(btn, balloonClass, iconClass);
        }
    });
}

/**
 * Apply auth users page blocking
 * @param {string} balloonClass - Balloon CSS class
 * @param {string} iconClass - Icon CSS class
 */
function applyAuthUsersBlocking(balloonClass, iconClass) {
    // Back to blog link
    document.querySelectorAll('a').forEach(a => {
        if (a.textContent.trim().toLowerCase().includes('voltar ao blog')) {
            bloquearElemento(a, balloonClass, iconClass);
        }
    });
}

/**
 * Apply details page blocking
 * @param {string} balloonClass - Balloon CSS class
 * @param {string} iconClass - Icon CSS class
 */
function applyDetailsBlocking(balloonClass, iconClass) {
    // Floating buttons
    document.querySelectorAll('.floating-buttons button').forEach(btn => {
        if (!btn.classList?.contains('no-unavailable') && !btn.classList?.contains('unavailable-element')) {
            bloquearElemento(btn, balloonClass, iconClass);
        }
    });
    
    // Comments section buttons
    document.querySelectorAll('.comments-section button').forEach(btn => {
        if (!btn.classList?.contains('no-unavailable')) {
            bloquearElemento(btn, balloonClass, iconClass);
        }
    });
    
    // Comment form elements (when they exist)
    document.querySelectorAll('.comment-form button, .comment-form textarea, .comment-form input').forEach(el => {
        if (!el.classList?.contains('no-unavailable')) {
            bloquearElemento(el, balloonClass, iconClass);
        }
    });
    
    // Comment action buttons
    document.querySelectorAll('.comment-action-btn').forEach(btn => {
        if (!btn.classList?.contains('no-unavailable')) {
            bloquearElemento(btn, balloonClass, iconClass);
        }
    });
    
    // Mobile panel buttons
    document.querySelectorAll('#mobileHighlightsPanel button, #mobileCommentsPanel button').forEach(btn => {
        if (!btn.classList?.contains('no-unavailable')) {
            bloquearElemento(btn, balloonClass, iconClass);
        }
    });
    
    // Interactive elements in details page
    document.querySelectorAll('a, button, input, textarea').forEach(el => {
        if (el.classList?.contains('no-unavailable')) return;
        if (el.id === 'userDropdownBtn' || el.id === 'userDropdown') return;
        if (el.closest('#userDropdownBtn') || el.closest('#userDropdown')) return;
        
        // Skip logo link
        if (el.closest('.navbar-blur') && el.tagName.toLowerCase() === 'a') {
            const navbar = el.closest('.navbar-blur');
            if (navbar && Array.from(navbar.querySelectorAll('a')).indexOf(el) === 0) return;
        }
        
        bloquearElemento(el, balloonClass, iconClass);
    });
}

// =======================
// 4. INITIALIZATION
// Applies to: DOM ready and setup
// =======================

document.addEventListener('DOMContentLoaded', function() {
    // Force enable no-unavailable elements immediately
    forceNoUnavailable();
    
    // Detect context
    const { context, balloonClass, iconClass } = detectContext();
    
    // Apply context-specific blocking
    switch (context) {
        case 'admin':
            applyAdminBlocking(balloonClass, iconClass);
            break;
        case 'login':
            applyLoginBlocking(balloonClass, iconClass);
            break;
        case 'details':
            applyDetailsBlocking(balloonClass, iconClass);
            break;
        case 'blog':
            applyBlogBlocking(balloonClass, iconClass);
            break;
        case 'auth':
            applyAuthUsersBlocking(balloonClass, iconClass);
            break;
    }
    
    // Apply global unavailable elements
    document.querySelectorAll('.unavailable-navbar, .unavailable-footer').forEach(el => {
        // Skip if already processed by context-specific blocking
        if (el.classList.contains('unavailable-element')) return;
        
        el.classList.add('unavailable-element');
        el.style.cursor = 'not-allowed';
        
        // Prevent interactions
        el.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            return false;
        }, true);
        
        // Add balloon
        let balloon = null;
        el.addEventListener('mouseenter', function() {
            if (!balloon) {
                balloon = createBalloon('unavailable-balloon', 'fas fa-ban unavailable-icon');
                document.body.appendChild(balloon);
            }
            positionBalloon(balloon, el);
        });
        
        el.addEventListener('mouseleave', function() {
            if (balloon) {
                balloon.style.display = 'none';
            }
        });
    });
    
    // Monitor for dynamically loaded elements
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                // Check if new comment elements were added
                const hasCommentElements = Array.from(mutation.addedNodes).some(node => {
                    if (node.nodeType === Node.ELEMENT_NODE) {
                        return node.classList?.contains('comment-form') ||
                               node.classList?.contains('comment-item') ||
                               node.classList?.contains('comment-action-btn') ||
                               node.querySelector('.comment-form') ||
                               node.querySelector('.comment-item') ||
                               node.querySelector('.comment-action-btn');
                    }
                    return false;
                });
                
                if (hasCommentElements) {
                    // Re-apply blocking for new elements
                    setTimeout(() => {
                        applyDetailsBlocking(balloonClass, iconClass);
                    }, 100);
                }
            }
        });
    });
    
    // Start observing
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
    
    // Final cleanup to ensure no-unavailable elements are properly enabled
    setTimeout(forceNoUnavailable, 100);
    setTimeout(forceNoUnavailable, 1000);
});

// =======================
// 5. GLOBAL FUNCTIONS
// Applies to: functions accessible globally
// =======================

// Make functions globally accessible
window.UNAVAILABLE = {
    forceNoUnavailable,
    bloquearElemento,
    detectContext,
    applyDetailsBlocking
}; 