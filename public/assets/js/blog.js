// blog.js
// Handles interactions and effects of the public blog interface (home, details, search, dark mode, etc.)
// Contexts: public blog (home, details, search)

$(function() {
  // =======================
  // Blog - Dark Mode
  // Applies to: public blog (all pages)
  // =======================
  const darkModeToggle = document.getElementById('darkModeToggle');
  const html = document.documentElement;
  if (localStorage.getItem('darkMode') === 'true' || (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      html.classList.add('dark');
  }
  if (darkModeToggle) {
    darkModeToggle.addEventListener('click', () => {
      html.classList.toggle('dark');
      localStorage.setItem('darkMode', html.classList.contains('dark'));
    });
  }

  // =======================
  // Blog - Mobile Menu
  // Applies to: public blog (mobile)
  // =======================
  const mobileMenuButton = document.getElementById('mobileMenuButton');
  const mobileMenu = document.getElementById('mobileMenu');
  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  }

  // =======================
  // Blog - Scroll and Animations
// Applies to: public blog (visual effects)
  // =======================
  const animateOnScroll = () => {
      const elements = document.querySelectorAll('.animate-fade-in, .animate-slide-up');
      elements.forEach(element => {
          const elementPosition = element.getBoundingClientRect().top;
          const screenPosition = window.innerHeight / 1.2;
          if (elementPosition < screenPosition) {
              element.style.opacity = '1';
              element.style.transform = 'translateY(0)';
          }
      });
  };
  document.querySelectorAll('.animate-fade-in').forEach(el => {
      el.style.opacity = '0';
      el.style.transition = 'opacity 0.5s ease-out';
  });
  document.querySelectorAll('.animate-slide-up').forEach(el => {
      el.style.opacity = '0';
      el.style.transform = 'translateY(20px)';
      el.style.transition = 'opacity 0.5s ease-out, transform 0.5s ease-out';
  });
  animateOnScroll();
  window.addEventListener('scroll', animateOnScroll);

  // =======================
  // Blog - Smooth Navigation
// Applies to: public blog (internal anchors)
  // =======================
  $('a[href^="#"]').on('click', function(e) {
    e.preventDefault();
    const targetId = $(this).attr('href');
    if (targetId === '#') return;
    const targetElement = document.querySelector(targetId);
    if (targetElement) {
      targetElement.scrollIntoView({ behavior: 'smooth' });
    }
  });

  // =======================
  // Blog - Post Details
  // Applies to: public blog (post cards)
  // =======================
  if ($('.post-card').length) {
    $('.post-card').on('click', function(e) {
      if ($(e.target).hasClass('btn-visualizar') || $(e.target).hasClass('btn-view')) return;
      const id = $(this).data('id');
      if (id) {
        window.location.href = `blog/details/${id}`;
      }
    });
    $('.post-card .btn-visualizar, .post-card .btn-view').on('click', function(e) {
      e.stopPropagation();
      const id = $(this).closest('.post-card').data('id');
      if (id) {
        window.location.href = `blog/details/${id}`;
      }
    });
  }

  // =======================
  // Blog - Busca AJAX de Artigos
  // Applies to: public blog (post search)
  // =======================
  let searchTimeout = null;
  const $searchInput = $('#searchInput');
  const $searchForm = $('#searchForm');
  const $postsGrid = $('#postsGrid');
  if ($searchInput.length && $searchForm.length && $postsGrid.length) {
    $searchInput.on('input', function() {
      if (searchTimeout) clearTimeout(searchTimeout);
      searchTimeout = setTimeout(() => {
        const q = $searchInput.val();
        const url = q ? `?q=${encodeURIComponent(q)}` : '';
        fetch(window.location.pathname + url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
          .then(res => res.text())
          .then(html => {
            $postsGrid.html(html.replace(/^<div[^>]*>|<\/div>$/g, ''));
            rebindPostCardEvents();
          });
      }, 400);
    });
    $searchInput.on('blur', function() {
      if (!$searchInput.val().trim()) {
        fetch(window.location.pathname, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
          .then(res => res.text())
          .then(html => {
            $postsGrid.html(html.replace(/^<div[^>]*>|<\/div>$/g, ''));
            rebindPostCardEvents();
          });
      }
    });
  }
  const $searchBtn = $searchForm.find('button[type="submit"]');
  if ($searchBtn.length) {
    $searchBtn.prop('disabled', false).css('cursor', '');
  }
  function rebindPostCardEvents() {
    $('.post-card').off('click').on('click', function(e) {
      if ($(e.target).hasClass('btn-visualizar')) return;
      const id = $(this).data('id');
      if (id) {
        window.location.href = `blog/details/${id}`;
      }
    });
    $('.post-card .btn-visualizar').off('click').on('click', function(e) {
      e.stopPropagation();
      const id = $(this).closest('.post-card').data('id');
      if (id) {
        window.location.href = `blog/details/${id}`;
      }
    });
  }
  rebindPostCardEvents();
});

// =======================
// Blog - Mobile Panels
// Applies to: mobile panels for highlights and comments
// =======================
(function() {
    // Mobile Highlights Panel
    const mobileHighlightsToggle = document.getElementById('mobileHighlightsToggle');
    const mobileHighlightsPanel = document.getElementById('mobileHighlightsPanel');
    const closeMobileHighlights = document.getElementById('closeMobileHighlights');
    const mobileHighlightsContainer = mobileHighlightsPanel?.querySelector('.absolute');

    if (mobileHighlightsToggle && mobileHighlightsPanel && mobileHighlightsContainer) {
        // Abrir painel de destaques
        mobileHighlightsToggle.addEventListener('click', function() {
            mobileHighlightsPanel.classList.remove('hidden');
            setTimeout(() => {
                mobileHighlightsContainer.classList.add('translate-x-0');
                mobileHighlightsContainer.classList.remove('-translate-x-full');
            }, 10);
        });

        // Fechar painel de destaques
        function closeHighlightsPanel() {
            mobileHighlightsContainer.classList.remove('translate-x-0');
            mobileHighlightsContainer.classList.add('-translate-x-full');
            setTimeout(() => {
                mobileHighlightsPanel.classList.add('hidden');
            }, 300);
        }

        if (closeMobileHighlights) {
            closeMobileHighlights.addEventListener('click', closeHighlightsPanel);
        }

        mobileHighlightsPanel.addEventListener('click', function(e) {
            if (e.target === mobileHighlightsPanel) {
                closeHighlightsPanel();
            }
        });
    }

    // Mobile Comments Panel
    const mobileCommentsToggle = document.getElementById('mobileCommentsToggle');
    const mobileCommentsPanel = document.getElementById('mobileCommentsPanel');
    const closeMobileComments = document.getElementById('closeMobileComments');
    const mobileCommentsContainer = mobileCommentsPanel?.querySelector('.absolute');

    if (mobileCommentsToggle && mobileCommentsPanel && mobileCommentsContainer) {
        // Open comments panel
        mobileCommentsToggle.addEventListener('click', function() {
            mobileCommentsPanel.classList.remove('hidden');
            setTimeout(() => {
                mobileCommentsContainer.classList.add('translate-x-0');
                mobileCommentsContainer.classList.remove('translate-x-full');
            }, 10);
        });

        // Close comments panel
        function closeCommentsPanel() {
            mobileCommentsContainer.classList.remove('translate-x-0');
            mobileCommentsContainer.classList.add('translate-x-full');
            setTimeout(() => {
                mobileCommentsPanel.classList.add('hidden');
            }, 300);
        }

        if (closeMobileComments) {
            closeMobileComments.addEventListener('click', closeCommentsPanel);
        }

        mobileCommentsPanel.addEventListener('click', function(e) {
            if (e.target === mobileCommentsPanel) {
                closeCommentsPanel();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                if (!mobileCommentsPanel.classList.contains('hidden')) {
                    closeCommentsPanel();
                }
                if (!mobileHighlightsPanel.classList.contains('hidden')) {
                    closeHighlightsPanel();
                }
            }
        });
    }
})();

// =======================
// Blog - User Dropdown (Navbar) - SIMPLIFIED AND ROBUST IMPLEMENTATION
// Applies to: public blog (navbar, user dropdown)
// =======================
(function() {
    let dropdownInitialized = false;
    let clickOutsideHandler = null;
    let escapeKeyHandler = null;
    
    // Function to initialize user dropdown
    function initUserDropdown() {
        const userDropdownBtn = document.getElementById('userDropdownBtn');
        const userDropdown = document.getElementById('userDropdown');
        
        if (!userDropdownBtn || !userDropdown) {
            return;
        }
        
        // If already initialized, don't initialize again
        if (dropdownInitialized) {
            return;
        }
        
        // Limpar event listeners antigos
        cleanupEventListeners();
        
        // Ensure button is clickable
        userDropdownBtn.style.cursor = 'pointer';
        userDropdownBtn.style.pointerEvents = 'auto';
        userDropdownBtn.classList.remove('unavailable', 'unavailable-element');
        
        // ENSURE DROPDOWN STARTS CLOSED
        userDropdown.classList.add('dropdown-hidden');
        userDropdown.style.display = 'none';
        userDropdown.style.opacity = '0';
        userDropdown.style.visibility = 'hidden';
        
        // Function to open/close dropdown
        function toggleDropdown(e) {
            if (e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            const isHidden = userDropdown.classList.contains('dropdown-hidden');
            
            if (isHidden) {
                userDropdown.classList.remove('dropdown-hidden');
            } else {
                userDropdown.classList.add('dropdown-hidden');
            }
        }
        
        // Add event listener for button
        userDropdownBtn.addEventListener('click', toggleDropdown);
        
        // Handler para clicar fora
        clickOutsideHandler = function(e) {
            if (!userDropdownBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdown.classList.add('dropdown-hidden');
            }
        };
        
        // Handler para tecla ESC
        escapeKeyHandler = function(e) {
            if (e.key === 'Escape') {
                userDropdown.classList.add('dropdown-hidden');
            }
        };
        
        // Adicionar event listeners
        document.addEventListener('click', clickOutsideHandler);
        document.addEventListener('keydown', escapeKeyHandler);
        
        // Prevent click propagation inside dropdown
        userDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
        });
        
        // Ensure links inside dropdown are clickable
        userDropdown.querySelectorAll('a').forEach(link => {
            link.style.cursor = 'pointer';
            link.style.pointerEvents = 'auto';
            link.classList.remove('unavailable', 'unavailable-element');
        });
        
        dropdownInitialized = true;
    }
    
    // Function to clear event listeners
    function cleanupEventListeners() {
        if (clickOutsideHandler) {
            document.removeEventListener('click', clickOutsideHandler);
            clickOutsideHandler = null;
        }
        if (escapeKeyHandler) {
            document.removeEventListener('keydown', escapeKeyHandler);
            escapeKeyHandler = null;
        }
    }
    
    // Function to ensure dropdown is closed
    function ensureDropdownClosed() {
        const userDropdown = document.getElementById('userDropdown');
        if (userDropdown) {
            userDropdown.classList.add('dropdown-hidden');
            userDropdown.style.display = 'none';
            userDropdown.style.opacity = '0';
            userDropdown.style.visibility = 'hidden';
        }
    }
    
    // Inicializar quando DOM estiver pronto
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(ensureDropdownClosed, 10);
            setTimeout(initUserDropdown, 50);
        });
    } else {
        setTimeout(ensureDropdownClosed, 10);
        setTimeout(initUserDropdown, 50);
    }
    
    // Ensure dropdown is closed initially
    setTimeout(ensureDropdownClosed, 100);
    setTimeout(initUserDropdown, 200);
    
})();

// =======================
// Blog - Novas Funcionalidades
// =======================



// Animated Statistics Counter
(function() {
    const statNumbers = document.querySelectorAll('.stat-number');
    
    const animateCounter = (element, target) => {
        let current = 0;
        const increment = target / 100;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 20);
    };

    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.getAttribute('data-target') || '0');
                animateCounter(entry.target, target);
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    statNumbers.forEach(stat => {
        observer.observe(stat);
    });
})();

// Newsletter Form
(function() {
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            if (email) {
                // Simulate sending
                const button = this.querySelector('button');
                const originalText = button.textContent;
                button.textContent = 'Enviando...';
                button.disabled = true;
                
                setTimeout(() => {
                    button.textContent = 'Inscrito!';
                    button.style.background = '#10b981';
                    
                    setTimeout(() => {
                        button.textContent = originalText;
                        button.disabled = false;
                        button.style.background = '';
                        this.reset();
                    }, 2000);
                }, 1500);
            }
        });
    }
})();

// Lazy Loading para Imagens
(function() {
    const images = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });

    images.forEach(img => imageObserver.observe(img));
})();

    // Interatividade para Pastas de Tecnologia
    (function() {
        const techFolders = document.querySelectorAll('.tech-folder');
        let currentTooltip = null;
        let tooltipTimeout = null;
        
        techFolders.forEach(folder => {
        // Efeito de clique
        folder.addEventListener('click', function() {
            const tech = this.getAttribute('data-tech');
            showTechModal(tech);
        });
        
        folder.addEventListener('mouseenter', function() {
            createParticles(this);
        });
        
        // Tooltip informativo
        folder.addEventListener('mouseenter', function() {
            // Limpar timeout anterior se existir
            if (tooltipTimeout) {
                clearTimeout(tooltipTimeout);
            }
            // Show tooltip after small delay
            tooltipTimeout = setTimeout(() => {
                showTechTooltip(this);
            }, 200);
        });
        
        folder.addEventListener('mouseleave', function() {
            // Limpar timeout se mouse sair antes de mostrar
            if (tooltipTimeout) {
                clearTimeout(tooltipTimeout);
                tooltipTimeout = null;
            }
            // Esconder tooltip com fade
            hideTechTooltip();
        });
    });
    
    function showTechModal(tech) {
        const techNames = {
            'python': 'Python',
            'javascript': 'JavaScript',
            'php': 'PHP',
            'java': 'Java',
            'csharp': 'C#',
            'go': 'Go',
            'rust': 'Rust',
            'typescript': 'TypeScript'
        };
        
        const techInfo = {
            'python': {
                description: 'Linguagem de programação versátil para IA, Data Science e Web Development',
                frameworks: ['Django', 'Flask', 'FastAPI', 'Pandas', 'NumPy', 'TensorFlow'],
                useCases: ['Machine Learning', 'Web Development', 'Data Analysis', 'Automation']
            },
            'javascript': {
                description: 'Linguagem de programação para desenvolvimento web frontend e backend',
                frameworks: ['React', 'Vue.js', 'Angular', 'Node.js', 'Express', 'Next.js'],
                useCases: ['Frontend Development', 'Backend Development', 'Mobile Apps', 'Desktop Apps']
            },
            'php': {
                description: 'Linguagem de script para desenvolvimento web dinâmico',
                frameworks: ['Laravel', 'CodeIgniter', 'Symfony', 'WordPress', 'Drupal'],
                useCases: ['Web Development', 'CMS', 'E-commerce', 'API Development']
            },
            'java': {
                description: 'Linguagem de programação orientada a objetos para aplicações empresariais',
                frameworks: ['Spring', 'Hibernate', 'Maven', 'Gradle', 'Android SDK'],
                useCases: ['Enterprise Applications', 'Android Development', 'Big Data', 'Cloud Computing']
            },
            'csharp': {
                description: 'Linguagem de programação da Microsoft para desenvolvimento .NET',
                frameworks: ['.NET Core', 'ASP.NET', 'Entity Framework', 'Unity', 'Xamarin'],
                useCases: ['Desktop Applications', 'Game Development', 'Web Development', 'Mobile Apps']
            },
            'go': {
                description: 'Linguagem de programação para desenvolvimento de sistemas e microserviços',
                frameworks: ['Gin', 'Echo', 'Fiber', 'GORM', 'Cobra'],
                useCases: ['Microservices', 'Cloud Native', 'DevOps', 'System Programming']
            },
            'rust': {
                description: 'Linguagem de programação de sistemas com foco em segurança e performance',
                frameworks: ['Actix', 'Rocket', 'Tokio', 'Serde', 'Cargo'],
                useCases: ['System Programming', 'WebAssembly', 'Embedded Systems', 'Performance Critical Apps']
            },
            'typescript': {
                description: 'Superset do JavaScript com tipagem estática para desenvolvimento mais seguro',
                frameworks: ['Angular', 'NestJS', 'Express', 'React', 'Vue.js'],
                useCases: ['Large Scale Applications', 'Enterprise Development', 'Type Safety', 'Modern JavaScript']
            }
        };
        
        const info = techInfo[tech];
        if (info) {
            // Criar modal simples
            const modal = document.createElement('div');
            modal.className = 'tech-modal';
            modal.innerHTML = `
                <div class="tech-modal-content">
                    <div class="tech-modal-header">
                        <h2>${techNames[tech]}</h2>
                        <button class="tech-modal-close">&times;</button>
                    </div>
                    <div class="tech-modal-body">
                        <p>${info.description}</p>
                        <div class="tech-modal-section">
                            <h3>Frameworks Populares</h3>
                            <div class="tech-frameworks">
                                ${info.frameworks.map(fw => `<span class="framework-tag">${fw}</span>`).join('')}
                            </div>
                        </div>
                        <div class="tech-modal-section">
                            <h3>Casos de Uso</h3>
                            <div class="tech-use-cases">
                                ${info.useCases.map(uc => `<span class="use-case-tag">${uc}</span>`).join('')}
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            
            // Fechar modal
            modal.querySelector('.tech-modal-close').addEventListener('click', () => {
                modal.remove();
            });
            
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.remove();
                }
            });
        }
    }
    
    function createParticles(element) {
        const rect = element.getBoundingClientRect();
        const particles = 5;
        
        for (let i = 0; i < particles; i++) {
            const particle = document.createElement('div');
            particle.className = 'tech-particle';
            particle.style.cssText = `
                position: fixed;
                width: 4px;
                height: 4px;
                background: #667eea;
                border-radius: 50%;
                pointer-events: none;
                z-index: 1000;
                left: ${rect.left + rect.width / 2}px;
                top: ${rect.top + rect.height / 2}px;
                animation: particleFloat 1s ease-out forwards;
            `;
            
            document.body.appendChild(particle);
            
            setTimeout(() => {
                particle.remove();
            }, 1000);
        }
    }
    
    function showTechTooltip(element) {
        // Remover tooltip anterior se existir
        if (currentTooltip) {
            currentTooltip.remove();
            currentTooltip = null;
        }
        
        const rect = element.getBoundingClientRect();
        const tooltip = document.createElement('div');
        tooltip.className = 'tech-tooltip';
        tooltip.textContent = 'Clique para saber mais';
        
        // Calculate optimized position
        const left = rect.left + rect.width / 2;
        const top = rect.top - 5; // Closer to the card
        
        tooltip.style.cssText = `
            position: fixed;
            left: ${left}px;
            top: ${top}px;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s ease;
        `;
        
        document.body.appendChild(tooltip);
        
        // Mostrar com fade in
        requestAnimationFrame(() => {
            tooltip.style.opacity = '1';
        });
        
        currentTooltip = tooltip;
    }
    
    function hideTechTooltip() {
        if (currentTooltip) {
            currentTooltip.style.opacity = '0';
            currentTooltip.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                if (currentTooltip && currentTooltip.parentNode) {
                    currentTooltip.remove();
                }
                currentTooltip = null;
            }, 500);
        }
    }
})();

// Progress Bar de Leitura
(function() {
    const progressBar = document.createElement('div');
    progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3px;
        background: linear-gradient(90deg, #7c3aed, #0ea5e9);
        z-index: 9999;
        transition: width 0.1s ease;
    `;
    document.body.appendChild(progressBar);

    window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset;
        const docHeight = document.body.offsetHeight - window.innerHeight;
        const scrollPercent = (scrollTop / docHeight) * 100;
        progressBar.style.width = scrollPercent + '%';
    });
})();

// Smooth Scroll para Links Internos
(function() {
    const internalLinks = document.querySelectorAll('a[href^="#"]');
    
    internalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
})();

// Parallax Effect para Hero Section
(function() {
    const heroSection = document.querySelector('.hero-bg');
    if (heroSection) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.5;
            heroSection.style.transform = `translateY(${rate}px)`;
        });
    }
})();

// Interatividade para Artigos Populares
(function() {
    const popularArticles = document.querySelectorAll('.popular-article');
    
    popularArticles.forEach(article => {
        // Efeito de clique
        article.addEventListener('click', function() {
            // Simulate navigation to article
            const title = this.querySelector('.article-title').textContent;
            
            // Adicionar efeito de clique
            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
        
        article.addEventListener('mouseenter', function() {
            createArticleParticles(this);
        });
        
        // Entry animation
        article.style.opacity = '0';
        article.style.transform = 'translateX(-20px)';
        
        setTimeout(() => {
            article.style.transition = 'all 0.5s ease';
            article.style.opacity = '1';
            article.style.transform = 'translateX(0)';
        }, Math.random() * 500);
    });
    
    function createArticleParticles(element) {
        const rect = element.getBoundingClientRect();
        const particles = 3;
        
        for (let i = 0; i < particles; i++) {
            const particle = document.createElement('div');
            particle.className = 'article-particle';
            particle.style.cssText = `
                position: fixed;
                width: 3px;
                height: 3px;
                background: #667eea;
                border-radius: 50%;
                pointer-events: none;
                z-index: 1000;
                left: ${rect.left + Math.random() * rect.width}px;
                top: ${rect.top + Math.random() * rect.height}px;
                animation: articleParticleFloat 1.5s ease-out forwards;
            `;
            
            document.body.appendChild(particle);
            
            setTimeout(() => {
                particle.remove();
            }, 1500);
        }
    }
})();

        // Animation for article particles
const style = document.createElement('style');
style.textContent = `
    @keyframes articleParticleFloat {
        0% {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
        100% {
            opacity: 0;
            transform: translateY(-30px) scale(0);
        }
    }
`;
document.head.appendChild(style);

// =======================
// 9. COMMENTS SYSTEM
// Applies to: blog post comments functionality
// =======================

// =======================
// 9.1 CONFIGURATION
// Applies to: global settings and constants
// =======================

const COMMENTS_CONFIG = {
    maxLength: 500,
    autoSaveInterval: 30000, // 30 seconds
    loadDelay: 1000,
    animationDuration: 400
};

// =======================
// 9.2 STATE MANAGEMENT
// Applies to: comments state and data
// =======================

let commentsState = {
    comments: [],
    isLoading: false,
    currentUser: null,
    postId: null,
    autoSaveTimer: null,
    draftComment: ''
};

// =======================
// 9.3 UTILITIES
// Applies to: helper functions
// =======================

/**
 * Get current user info
 * @returns {Object|null} User information
 */
function getCurrentUser() {
    // This would typically come from your authentication system
    // For now, we'll simulate a logged-in user
    return {
        id: 1,
        name: 'Usuário',
        email: 'usuario@example.com',
        avatar: null
    };
}

/**
 * Get user initials for avatar
 * @param {string} name - User name
 * @returns {string} User initials
 */
function getUserInitials(name) {
    return name
        .split(' ')
        .map(word => word.charAt(0))
        .join('')
        .toUpperCase()
        .slice(0, 2);
}

/**
 * Format date for display
 * @param {string} dateString - Date string
 * @returns {string} Formatted date
 */
function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffInMinutes = Math.floor((now - date) / (1000 * 60));
    
    if (diffInMinutes < 1) return 'Agora mesmo';
    if (diffInMinutes < 60) return `${diffInMinutes} min atrás`;
    if (diffInMinutes < 1440) return `${Math.floor(diffInMinutes / 60)}h atrás`;
    
    return date.toLocaleDateString('pt-BR', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

/**
 * Validate comment content
 * @param {string} content - Comment content
 * @returns {Object} Validation result
 */
function validateComment(content) {
    const trimmed = content.trim();
    
    if (!trimmed) {
        return { isValid: false, message: 'O comentário não pode estar vazio.' };
    }
    
    if (trimmed.length < 3) {
        return { isValid: false, message: 'O comentário deve ter pelo menos 3 caracteres.' };
    }
    
    if (trimmed.length > COMMENTS_CONFIG.maxLength) {
        return { isValid: false, message: `O comentário não pode ter mais de ${COMMENTS_CONFIG.maxLength} caracteres.` };
    }
    
    return { isValid: true, message: '' };
}

/**
 * Show notification message
 * @param {string} message - Message to show
 * @param {string} type - Message type (success, error, warning)
 */
function showCommentNotification(message, type = 'info') {
    const notification = $(`
        <div class="comment-notification comment-notification-${type}">
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
            <span>${message}</span>
        </div>
    `);
    
    $('body').append(notification);
    
    // Animate in
    setTimeout(() => notification.addClass('show'), 100);
    
    // Auto remove
    setTimeout(() => {
        notification.removeClass('show');
        setTimeout(() => notification.remove(), 300);
    }, 4000);
}

// =======================
// 9.4 DOM MANIPULATION
// Applies to: HTML generation and updates
// =======================

/**
 * Create comment HTML element
 * @param {Object} comment - Comment data
 * @returns {string} Comment HTML
 */
function createCommentHTML(comment) {
    const initials = getUserInitials(comment.user_name);
    const formattedDate = formatDate(comment.created_at);
    
    return `
        <div class="comment-item" data-comment-id="${comment.id}">
            <div class="comment-header">
                <div class="comment-avatar">
                    ${initials}
                </div>
                <div class="comment-user-info">
                    <h4 class="comment-username">${comment.user_name}</h4>
                    <p class="comment-date">${formattedDate}</p>
                </div>
                <div class="comment-actions">
                    <button class="comment-action-btn" onclick="likeComment(${comment.id})" title="Curtir">
                        <i class="fas fa-heart"></i>
                        <span class="like-count">${comment.likes || 0}</span>
                    </button>
                    <button class="comment-action-btn" onclick="replyToComment(${comment.id})" title="Responder">
                        <i class="fas fa-reply"></i>
                    </button>
                    ${comment.user_id === commentsState.currentUser?.id ? `
                        <button class="comment-action-btn" onclick="editComment(${comment.id})" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="comment-action-btn" onclick="deleteComment(${comment.id})" title="Excluir">
                            <i class="fas fa-trash"></i>
                        </button>
                    ` : ''}
                </div>
            </div>
            <div class="comment-content">
                ${comment.content}
            </div>
        </div>
    `;
}

/**
 * Render comments list
 * @param {Array} comments - Comments array
 */
function renderComments(comments) {
    const $commentsLists = $('.comments-list');
    
    if (!comments || comments.length === 0) {
        const emptyHTML = `
            <div class="comments-empty">
                <div class="comments-empty-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3 class="comments-empty-title">Nenhum comentário ainda</h3>
                <p class="comments-empty-text">Seja o primeiro a comentar neste post!</p>
            </div>
        `;
        $commentsLists.html(emptyHTML);
        return;
    }
    
    const commentsHTML = comments.map(comment => createCommentHTML(comment)).join('');
    $commentsLists.html(commentsHTML);
    

    
    // Update comments count
    updateCommentsCount(comments.length);
}

/**
 * Update comments count display
 * @param {number} count - Number of comments
 */
function updateCommentsCount(count) {
    $('.comments-count').each(function() {
        $(this).text(`${count} comentário${count !== 1 ? 's' : ''}`);
    });
}

/**
 * Show loading state
 */
function showCommentsLoading() {
    const loadingHTML = `
        <div class="comments-loading">
            <div class="comments-loading-spinner"></div>
            <p>Carregando comentários...</p>
        </div>
    `;
    $('.comments-list').html(loadingHTML);
}

/**
 * Create comment form HTML
 * @returns {string} Comment form HTML
 */
function createCommentFormHTML() {
    const user = commentsState.currentUser;
    const initials = user ? getUserInitials(user.name) : 'U';
    const userName = user ? user.name : 'Usuário';
    
    return `
        <div class="comment-form">
            <div class="comment-form-header">
                <div class="comment-form-avatar">
                    ${initials}
                </div>
                <div class="comment-form-user">${userName}</div>
            </div>
            <textarea 
                class="comment-form-textarea" 
                placeholder="Digite seu comentário aqui..."
                maxlength="${COMMENTS_CONFIG.maxLength}"
            ></textarea>
            <div class="comment-form-actions">
                <button class="comment-form-submit" onclick="submitComment()">
                    <i class="fas fa-paper-plane"></i>
                    Comentar
                </button>
                <span class="comment-form-char-count">0/${COMMENTS_CONFIG.maxLength}</span>
            </div>
        </div>
    `;
}

// =======================
// 9.5 API INTERACTIONS
// Applies to: server communication
// =======================

/**
 * Load comments from server
 * @param {number} postId - Post ID
 */
async function loadComments(postId) {
    if (commentsState.isLoading) return;
    
    commentsState.isLoading = true;
    showCommentsLoading();
    
    try {
        // Simulate API call - replace with actual endpoint
        await new Promise(resolve => setTimeout(resolve, COMMENTS_CONFIG.loadDelay));
        
        // Mock data - replace with actual API response
        const mockComments = [
            {
                id: 1,
                content: 'Excelente artigo! Muito útil para entender as tendências atuais.',
                user_name: 'João Silva',
                user_id: 2,
                created_at: new Date(Date.now() - 3600000).toISOString(), // 1 hour ago
                likes: 3
            },
            {
                id: 2,
                content: 'Concordo totalmente! Esses frameworks estão realmente revolucionando o desenvolvimento web.',
                user_name: 'Maria Santos',
                user_id: 3,
                created_at: new Date(Date.now() - 7200000).toISOString(), // 2 hours ago
                likes: 1
            }
        ];
        
        commentsState.comments = mockComments;
        renderComments(mockComments);
        
    } catch (error) {
        console.error('Erro ao carregar comentários:', error);
        showCommentNotification('Erro ao carregar comentários. Tente novamente.', 'error');
        
        const errorHTML = `
            <div class="comments-empty">
                <div class="comments-empty-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h3 class="comments-empty-title">Erro ao carregar</h3>
                <p class="comments-empty-text">Não foi possível carregar os comentários.</p>
            </div>
        `;
        $('.comments-list').html(errorHTML);
    } finally {
        commentsState.isLoading = false;
    }
}

/**
 * Submit new comment
 */
async function submitComment() {
    const $textarea = $('.comment-form-textarea').first();
    const content = $textarea.val().trim();
    
    const validation = validateComment(content);
    if (!validation.isValid) {
        showCommentNotification(validation.message, 'error');
        return;
    }
    
    const submitBtn = $('.comment-form-submit').first();
    const originalText = submitBtn.html();
    
    // Show loading state
    $('.comment-form-submit').html('<i class="fas fa-spinner fa-spin"></i> Enviando...');
    $('.comment-form-submit').prop('disabled', true);
    
    try {
        // Simulate API call - replace with actual endpoint
        await new Promise(resolve => setTimeout(resolve, 1000));
        
        // Mock new comment - replace with actual API response
        const newComment = {
            id: Date.now(),
            content: content,
            user_name: commentsState.currentUser.name,
            user_id: commentsState.currentUser.id,
            created_at: new Date().toISOString(),
            likes: 0
        };
        
        // Add to comments array
        commentsState.comments.unshift(newComment);
        
        // Re-render comments
        renderComments(commentsState.comments);
        
        // Clear all forms
        $('.comment-form-textarea').val('');
        updateCharCount();
        
        // Clear draft
        commentsState.draftComment = '';
        clearAutoSave();
        
        showCommentNotification('Comentário adicionado com sucesso!', 'success');
        
    } catch (error) {
        console.error('Erro ao enviar comentário:', error);
        showCommentNotification('Erro ao enviar comentário. Tente novamente.', 'error');
    } finally {
        // Restore buttons
        $('.comment-form-submit').html(originalText);
        $('.comment-form-submit').prop('disabled', false);
    }
}

/**
 * Delete comment
 * @param {number} commentId - Comment ID
 */
async function deleteComment(commentId) {
    if (!confirm('Tem certeza que deseja excluir este comentário?')) {
        return;
    }
    
    try {
        // Simulate API call - replace with actual endpoint
        await new Promise(resolve => setTimeout(resolve, 500));
        
        // Remove from comments array
        commentsState.comments = commentsState.comments.filter(c => c.id !== commentId);
        
        // Re-render comments
        renderComments(commentsState.comments);
        
        showCommentNotification('Comentário excluído com sucesso!', 'success');
        
    } catch (error) {
        console.error('Erro ao excluir comentário:', error);
        showCommentNotification('Erro ao excluir comentário. Tente novamente.', 'error');
    }
}

/**
 * Like comment
 * @param {number} commentId - Comment ID
 */
async function likeComment(commentId) {
    const comment = commentsState.comments.find(c => c.id === commentId);
    if (!comment) return;
    
    try {
        // Simulate API call - replace with actual endpoint
        await new Promise(resolve => setTimeout(resolve, 300));
        
        // Toggle like
        comment.likes = comment.likes || 0;
        comment.likes += 1;
        
        // Update UI
        $(`.comment-item[data-comment-id="${commentId}"] .like-count`).text(comment.likes);
        
    } catch (error) {
        console.error('Erro ao curtir comentário:', error);
        showCommentNotification('Erro ao curtir comentário. Tente novamente.', 'error');
    }
}

// =======================
// 9.6 AUTO-SAVE FUNCTIONALITY
// Applies to: draft saving
// =======================

/**
 * Start auto-save timer
 */
function startAutoSave() {
    clearAutoSave();
    commentsState.autoSaveTimer = setInterval(saveDraft, COMMENTS_CONFIG.autoSaveInterval);
}

/**
 * Clear auto-save timer
 */
function clearAutoSave() {
    if (commentsState.autoSaveTimer) {
        clearInterval(commentsState.autoSaveTimer);
        commentsState.autoSaveTimer = null;
    }
}

/**
 * Save comment draft
 */
function saveDraft() {
    const content = $('.comment-form-textarea').val();
    if (content.trim()) {
        commentsState.draftComment = content;
        localStorage.setItem(`comment-draft-${commentsState.postId}`, content);
    }
}

/**
 * Load comment draft
 */
function loadDraft() {
    const draft = localStorage.getItem(`comment-draft-${commentsState.postId}`);
    if (draft) {
        $('.comment-form-textarea').val(draft);
        commentsState.draftComment = draft;
        updateCharCount();
    }
}

/**
 * Clear comment draft
 */
function clearDraft() {
    localStorage.removeItem(`comment-draft-${commentsState.postId}`);
    commentsState.draftComment = '';
    $('.comment-form-textarea').val('');
    updateCharCount();
}

// =======================
// 9.7 EVENT HANDLERS
// Applies to: user interactions
// =======================

/**
 * Update character count
 */
function updateCharCount() {
    $('.comment-form-textarea').each(function() {
        const content = $(this).val();
        const count = content.length;
        const $charCount = $(this).closest('.comment-form').find('.comment-form-char-count');
        
        $charCount.text(`${count}/${COMMENTS_CONFIG.maxLength}`);
        
        // Change color based on length
        if (count > COMMENTS_CONFIG.maxLength * 0.9) {
            $charCount.addClass('text-red-500');
        } else {
            $charCount.removeClass('text-red-500');
        }
    });
}

/**
 * Reply to comment
 * @param {number} commentId - Comment ID
 */
function replyToComment(commentId) {
    const comment = commentsState.comments.find(c => c.id === commentId);
    if (!comment) return;
    
    const $textarea = $('.comment-form-textarea').first();
    const currentContent = $textarea.val();
    const replyText = `@${comment.user_name} `;
    
    $('.comment-form-textarea').val(replyText + currentContent);
    $textarea.focus();
    updateCharCount();
}

/**
 * Edit comment
 * @param {number} commentId - Comment ID
 */
function editComment(commentId) {
    const comment = commentsState.comments.find(c => c.id === commentId);
    if (!comment) return;
    
    const newContent = prompt('Editar comentário:', comment.content);
    
    if (newContent && newContent.trim() && newContent !== comment.content) {
        comment.content = newContent.trim();
        renderComments(commentsState.comments);
        showCommentNotification('Comentário editado com sucesso!', 'success');
    }
}

/**
 * Initialize comments system
 * @param {number} postId - Post ID
 */
function initComments(postId) {
    commentsState.postId = postId;
    commentsState.currentUser = getCurrentUser();
    
    // Replace all placeholders with actual comments section
    $('.comments-placeholder').each(function() {
        $(this).replaceWith(createCommentFormHTML());
    });
    

    
    // Load existing comments
    loadComments(postId);
    
    // Load draft if exists
    loadDraft();
    
    // Setup event listeners
    setupCommentEventListeners();
    
    // Start auto-save
    startAutoSave();
}

/**
 * Setup comment event listeners
 */
function setupCommentEventListeners() {
    // Character count update
    $(document).on('input', '.comment-form-textarea', updateCharCount);
    
    // Auto-save on input
    $(document).on('input', '.comment-form-textarea', function() {
        clearAutoSave();
        startAutoSave();
    });
    
    // Submit on Enter (Ctrl+Enter)
    $(document).on('keydown', '.comment-form-textarea', function(e) {
        if (e.ctrlKey && e.key === 'Enter') {
            e.preventDefault();
            submitComment();
        }
    });
    
    // Clear draft on successful submit
    $(document).on('comment:submitted', clearDraft);
}

// =======================
// 10. GLOBAL FUNCTIONS
// Applies to: functions accessible globally
// =======================

// Make comment functions globally accessible
window.COMMENTS = {
    init: initComments,
    submit: submitComment,
    delete: deleteComment,
    like: likeComment,
    reply: replyToComment,
    edit: editComment
}; 

 