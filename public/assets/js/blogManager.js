// blogManager.js
// Gerencia interações do painel administrativo de posts (admin/posts, admin/dashboard, etc.)
// Contextos: painel admin (posts, dashboard, sidebar, modais)

// =======================
// Inicialização de Plugins
// Aplica em: painel admin (carrossel de posts)
// =======================
$(document).ready(function(){
  $('.featured-carousel').owlCarousel({
    loop:false,
    margin:30,
    nav:true,
    dots:true,
    navText: [
      '<span class="fas fa-chevron-left"></span>',
      '<span class="fas fa-chevron-right"></span>'
    ],
    responsive:{
      0:{ items:1 },
      768:{ items:2 },
      1200:{ items:3 }
    }
  });
});

// =======================
// Sidebar e Navbar
// Aplica em: painel admin (sidebar, navbar)
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
    // Tooltips Bootstrap
    $('[data-bs-toggle="tooltip"]').tooltip();
    // Destacar item ativo na sidebar
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
        let page = $(this).text().trim().toLowerCase();
        if (page === 'configurações') page = 'settings';
        if (page === 'comentários') page = 'comments';
        if (page === 'usuários') page = 'users';
        if (page === 'categorias') page = 'categories';
        const url = new URL(window.location.href);
        url.searchParams.set('page', page);
        window.location.href = url.toString();
    });
    highlightActiveItem();
    $('html, body').animate({ scrollTop: 0 }, 300);
    $('.navbar').addClass('blogManager-navbar-fixed');
});

// =======================
// Navbar: Dicas Dinâmicas
// Aplica em: painel admin (navbar)
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
// Aplica em: painel admin (posts)
// =======================
let currentPostId = null;
let postIdToDelete = null;

function renderPosts(posts) {
    var $carousel = $('.featured-carousel');
    $carousel.trigger('destroy.owl.carousel');
    $carousel.html('');
    if (!posts || posts.length === 0) {
        $carousel.append('<div class="item"><div class="blog-entry d-flex align-items-center justify-content-center" style="height: 550px;"><span class="text-muted">Nenhum post encontrado.</span></div></div>');
    } else {
        posts.forEach(function(post) {
            var image = post.image ? '/' + post.image : 'https://via.placeholder.com/420x180/667eea/ffffff?text=Foto';
            var title = post.title || '';
            var description = post.description || '';
            var id = post.id;
            var card = `
            <div class="item">
                <div class="blog-entry" style="border-radius: 1.3rem; overflow: hidden; box-shadow: 0 8px 32px rgba(102,102,234,0.18); background: linear-gradient(135deg, #f8fafc 80%, #e0e7ff 100%); height: 550px; display: flex; flex-direction: column; justify-content: flex-start; align-items: stretch;">
                    <a href="#" class="block-20 d-flex align-items-start" style="background-image: url('${image}'); height: 200px; background-size: cover; background-position: center; border-top-left-radius: 1.3rem; border-top-right-radius: 1.3rem;"></a>
                    <div class="text border border-top-0 p-4 d-flex flex-column justify-content-between align-items-center" style="flex: 1 1 auto; min-height: 0;">
                        <h3 class="heading text-center" style="color: #3730a3; font-size: 1.18rem; font-weight: bold; text-shadow: 0 2px 8px rgba(102,102,234,0.08); letter-spacing: 0.2px; margin-bottom: 0.5rem;">${title}</h3>
                        <p class="text-center" style="color: #6366f1; font-size: 1.01rem; font-weight: 500; line-height: 1.4; min-height: 36px;">${description}</p>
                        <div class="d-flex justify-content-center align-items-center gap-2 mt-auto" style="width: 100%;">
                            <button class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center" onclick="editPost(${id})" data-bs-toggle="tooltip" title="Editar" style="border-radius: 0.8rem; width: 2.6rem; height: 2.6rem;"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-outline-success btn-sm d-flex align-items-center justify-content-center" onclick="viewPost(${id})" data-bs-toggle="tooltip" title="Visualizar" style="border-radius: 0.8rem; width: 2.6rem; height: 2.6rem;"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center" onclick="deletePost(${id})" data-bs-toggle="tooltip" title="Excluir" style="border-radius: 0.8rem; width: 2.6rem; height: 2.6rem;"><i class="fas fa-trash-can"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            `;
            $carousel.append(card);
        });
    }
    $carousel.owlCarousel({
        loop: false,
        margin: 30,
        nav: true,
        dots: true,
        navText: [
            '<span class="fas fa-chevron-left"></span>',
            '<span class="fas fa-chevron-right"></span>'
        ],
        responsive: {
            0: { items: 1 },
            768: { items: 2 },
            1200: { items: 3 }
        }
    });
}

$(function() {
    // Busca
    $('#searchPosts, #filterDateStart, #filterDateEnd').on('input change', function() {
        const q = $('#searchPosts').val();
        const dateStart = $('#filterDateStart').val();
        const dateEnd = $('#filterDateEnd').val();
        $.get('/admin/posts/search', { q, date_start: dateStart, date_end: dateEnd }, function(data) {
            if (data && data.posts) {
                renderPosts(data.posts);
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
// Aplica em: painel admin (posts, modais)
// =======================
function editPost(postId) {
    currentPostId = postId;
    $('#postModalLabel').text('Editar Post');
    $.get(`/admin/posts/edit/${postId}`, function(data) {
        if (data && data.post) {
            $('#postTitle').val(data.post.title || '');
            $('#postContent').val(data.post.description || '');
        }
        $('#postModal').modal('show');
    }).fail(function() {
        showNotification('Erro ao carregar dados do post.', 'error');
    });
}
function viewPost(postId) {
    window.open('/blog', '_blank');
}
function deletePost(postId) {
    postIdToDelete = postId;
    $('#deleteModal').modal('show');
}
function confirmDelete() {
    if (!postIdToDelete) return;
    $.ajax({
        url: `/admin/posts/delete/${postIdToDelete}`,
        type: 'GET',
        success: function(response) {
            showNotification('Post excluído com sucesso!', 'success');
            $('#deleteModal').modal('hide');
            setTimeout(function() { location.reload(); }, 1000);
        },
        error: function() {
            showNotification('Erro ao excluir o post.', 'error');
            $('#deleteModal').modal('hide');
        }
    });
}
function savePost() {
    const form = document.getElementById('postForm');
    const title = $('#postTitle').val().trim();
    const content = $('#postContent').val().trim();
    const image = $('#postImage')[0].files[0];
    if (!title) {
        showNotification('O título é obrigatório.', 'error');
        $('#postTitle').focus();
        return;
    }
    if (!content) {
        showNotification('A descrição é obrigatória.', 'error');
        $('#postContent').focus();
        return;
    }
    const formData = new FormData();
    formData.append('title', title);
    formData.append('description', content);
    if (image) {
        formData.append('image', image);
    }
    let url = '/admin/posts/store';
    let type = 'POST';
    if (currentPostId) {
        url = `/admin/posts/update/${currentPostId}`;
        type = 'POST';
        formData.append('id', currentPostId);
    }
    $.ajax({
        url: url,
        type: type,
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                showNotification(response.message || 'Post salvo com sucesso!', 'success');
                $('#postModal').modal('hide');
                setTimeout(function() { location.reload(); }, 1200);
            } else {
                showNotification(response.message || 'Erro ao salvar o post.', 'error');
            }
        },
        error: function(xhr) {
            let msg = 'Erro ao salvar o post.';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                msg = xhr.responseJSON.message;
            }
            showNotification(msg, 'error');
        }
    });
}

// =======================
// Notificações
// Aplica em: painel admin (feedback visual)
// =======================
if (typeof showNotification !== 'function') {
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
}