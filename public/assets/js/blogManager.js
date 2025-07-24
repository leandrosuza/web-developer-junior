// =======================
// Sidebar e Navbar
// =======================
$(function() {
    // Sidebar mobile toggle
    $('#mobile-menu-button').on('click', function() {
        $('.sidebar').toggleClass('active');
        $('.sidebar-overlay').toggleClass('active');
    });
    $('.sidebar-overlay').on('click', function() {
        $('.sidebar').removeClass('active');
        $('.sidebar-overlay').removeClass('active');
    });
    // Ativar tooltips Bootstrap
    $('[data-bs-toggle="tooltip"]').tooltip();
    // Sidebar: destacar item ativo
    function highlightActiveItem() {
        const urlParams = new URLSearchParams(window.location.search);
        const currentPage = urlParams.get('page') || 'dashboard';
        $('.sidebar .nav-link').removeClass('active');
        $('.sidebar .nav-link').each(function() {
            const linkText = $(this).text().trim().toLowerCase();
            if (linkText === currentPage || (currentPage === 'dashboard' && linkText === 'dashboard')) {
                $(this).addClass('active');
            }
        });
    }
    $('.sidebar .nav-link').on('click', function(e) {
        e.preventDefault();
        $('.sidebar .nav-link').removeClass('active');
        $(this).addClass('active');
        const page = $(this).text().trim().toLowerCase();
        const url = new URL(window.location.href);
        url.searchParams.set('page', page);
        window.location.href = url.toString();
    });
    highlightActiveItem();
    // Scroll to top ao trocar de página
    $('html, body').animate({ scrollTop: 0 }, 300);
    // Fixar navbar do painel admin no topo
    $('.navbar').addClass('blogManager-navbar-fixed');
});

// =======================
// Navbar: Dicas/Mensagens Dinâmicas
// =======================
const tips = [
  "Dica: Use o botão azul para criar um novo post rapidamente!",
  "Atalho: Pressione Ctrl+N para novo post.",
  "Você tem 3 posts pendentes de revisão.",
  "Continue compartilhando conhecimento! 🚀",
  "Backup automático realizado hoje às 02:00."
];
let tipIndex = 0;
setInterval(() => {
  tipIndex = (tipIndex + 1) % tips.length;
  $('#navbar-tip').fadeOut(200, function() {
    $(this).text(tips[tipIndex]).fadeIn(200);
  });
}, 6000);

// =======================
// Posts: Busca, Filtros e CRUD
// =======================
$(function() {
    let currentPostId = null;
    // Busca
    $('#searchPosts').on('input', function() {
        const searchTerm = $(this).val().toLowerCase();
        $('.post-item').each(function() {
            const title = $(this).find('.card-title').text().toLowerCase();
            const content = $(this).find('.card-text').text().toLowerCase();
            const category = $(this).find('.badge').text().toLowerCase();
            if (title.includes(searchTerm) || content.includes(searchTerm) || category.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    // Filtro por status
    $('#statusFilter').on('change', function() {
        const status = $(this).val().toLowerCase();
        $('.post-item').each(function() {
            const postStatus = $(this).find('.badge.bg-success, .badge.bg-warning').text().toLowerCase();
            if (status === '' || postStatus.includes(status)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    // Filtro por categoria
    $('#categoryFilter').on('change', function() {
        const category = $(this).val().toLowerCase();
        $('.post-item').each(function() {
            const postCategory = $(this).find('.badge.bg-primary, .badge.bg-warning, .badge.bg-info').text().toLowerCase();
            if (category === '' || postCategory.includes(category)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
    // Resetar formulário ao fechar modal
    $('#postModal').on('hidden.bs.modal', function() {
        $('#postForm')[0].reset();
        currentPostId = null;
        $('#postModalLabel').text('Novo Post');
    });
});

// =======================
// Funções Globais de Post
// =======================
function editPost(postId) {
    currentPostId = postId;
    $('#postModalLabel').text('Editar Post');
    // Simular carregamento de dados do post
    const postData = {
        title: 'Como criar um blog moderno',
        category: 'tecnologia',
        status: 'published',
        content: 'Guia completo para criar um blog com as melhores práticas...',
        tags: 'web, design, tecnologia'
    };
    $('#postTitle').val(postData.title);
    $('#postCategory').val(postData.category);
    $('#postStatus').val(postData.status);
    $('#postContent').val(postData.content);
    $('#postTags').val(postData.tags);
    $('#postModal').modal('show');
}
function viewPost(postId) {
    alert(`Visualizando post ID: ${postId}`);
}
function deletePost(postId) {
    currentPostId = postId;
    $('#deleteModal').modal('show');
}
function confirmDelete() {
    $(`.post-item:has([onclick*="deletePost(${currentPostId})"])`).fadeOut(300, function() {
        $(this).remove();
    });
    $('#deleteModal').modal('hide');
    showNotification('Post excluído com sucesso!', 'success');
}
function savePost() {
    const title = $('#postTitle').val();
    const category = $('#postCategory').val();
    const status = $('#postStatus').val();
    const content = $('#postContent').val();
    if (!title || !category || !status || !content) {
        showNotification('Por favor, preencha todos os campos obrigatórios.', 'error');
        return;
    }
    if (currentPostId) {
        showNotification('Post atualizado com sucesso!', 'success');
    } else {
        showNotification('Post criado com sucesso!', 'success');
    }
    $('#postModal').modal('hide');
}
function showNotification(message, type) {
    const notification = $(`
        <div class="alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show position-fixed" 
             style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `);
    $('body').append(notification);
    setTimeout(() => {
        notification.alert('close');
    }, 5000);
} 