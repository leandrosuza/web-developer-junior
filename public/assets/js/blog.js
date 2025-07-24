// blog.js
// Lida com interações e efeitos da interface do blog público (home, detalhes, busca, dark mode, etc.)
// Contextos: blog público (home, detalhes, busca)

$(function() {
  // =======================
  // Blog - Dark Mode
  // Aplica em: blog público (todas as páginas)
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
  // Aplica em: blog público (mobile)
  // =======================
  const mobileMenuButton = document.getElementById('mobileMenuButton');
  const mobileMenu = document.getElementById('mobileMenu');
  if (mobileMenuButton && mobileMenu) {
    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });
  }

  // =======================
  // Blog - Scroll e Animações
  // Aplica em: blog público (efeitos visuais)
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
  // Blog - Navegação Suave
  // Aplica em: blog público (ancoras internas)
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
  // Aplica em: blog público (cards de post)
  // =======================
  if ($('.post-card').length) {
    $('.post-card').on('click', function(e) {
      if ($(e.target).hasClass('btn-visualizar') || $(e.target).hasClass('btn-view')) return;
      const id = $(this).data('id');
      if (id) {
        window.location.href = `/blog/details/${id}`;
      }
    });
    $('.post-card .btn-visualizar, .post-card .btn-view').on('click', function(e) {
      e.stopPropagation();
      const id = $(this).closest('.post-card').data('id');
      if (id) {
        window.location.href = `/blog/details/${id}`;
      }
    });
  }

  // =======================
  // Blog - Busca AJAX de Artigos
  // Aplica em: blog público (busca de posts)
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
        window.location.href = `/blog/details/${id}`;
      }
    });
    $('.post-card .btn-visualizar').off('click').on('click', function(e) {
      e.stopPropagation();
      const id = $(this).closest('.post-card').data('id');
      if (id) {
        window.location.href = `/blog/details/${id}`;
      }
    });
  }
  rebindPostCardEvents();
}); 