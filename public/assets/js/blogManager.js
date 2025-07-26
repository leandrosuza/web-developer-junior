// blogManager.js
// Manages interactions of the administrative posts panel (admin/posts, admin/dashboard, etc.)
// Contexts: admin panel (posts, dashboard, sidebar, modals)

// =======================
// Plugin Initialization
// Applies to: admin panel (posts carousel)
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
  
  // =======================
  // FAB Button - New Post
  // Applies to: floating button to create new post
  // =======================
  $('#addPostFab').on('click', function() {
    // Clear form
    $('#postForm')[0].reset();
    $('#postModalLabel').text('Novo Post');
    currentPostId = null;
    
    // Open modal
    $('#postModal').modal('show');
  });
});

// =======================
// Sidebar and Navbar
// Applies to: admin panel (sidebar, navbar)
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
    // Highlight active item in sidebar
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
// Navbar: Dynamic Tips
// Applies to: admin panel (navbar)
// =======================
const tips = [
  "Tip: Use the blue button to create a new post quickly!",
  "Shortcut: Press Ctrl+N for new post.",
  "You have 3 posts pending review.",
  "Keep sharing knowledge! 🚀",
  "Automatic backup completed today at 02:00."
];
let tipIndex = 0;
setInterval(() => {
  tipIndex = (tipIndex + 1) % tips.length;
  $('#navbar-tip').fadeOut(200, function() {
    $(this).text(tips[tipIndex]).fadeIn(200);
  });
}, 6000);

// =======================
// Posts: Search, Filters and CRUD
// Applies to: admin panel (posts)
// =======================
let currentPostId = null;
let postIdToDelete = null;

function renderPosts(posts) {
    var $carousel = $('.featured-carousel');
    $carousel.empty();
    
    if (posts.length === 0) {
        $carousel.append(`
            <div class="item">
                <div class="text-center py-5">
                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">No posts found</h4>
                    <p class="text-muted">Click the + button to create your first post!</p>
                </div>
            </div>
        `);
        return;
    }
    
    posts.forEach(function(post) {
        var postHtml = `
            <div class="item">
                <div class="blog-entry" style="border-radius: 1.3rem; overflow: hidden; box-shadow: 0 8px 32px rgba(102,102,234,0.18); background: linear-gradient(135deg, #f8fafc 80%, #e0e7ff 100%); height: 550px; display: flex; flex-direction: column; justify-content: flex-start; align-items: stretch;">
                    <a href="#" class="block-20 d-flex align-items-start" style="background-image: url('${post.image || 'https://via.placeholder.com/420x180/667eea/ffffff?text=Foto'}'); height: 200px; background-size: cover; background-position: center; border-top-left-radius: 1.3rem; border-top-right-radius: 1.3rem;"></a>
                    <div class="text border border-top-0 p-4 d-flex flex-column justify-content-between align-items-center" style="flex: 1 1 auto; min-height: 0;">
                        <h3 class="heading text-center" style="color: #3730a3; font-size: 1.18rem; font-weight: bold; text-shadow: 0 2px 8px rgba(102,102,234,0.08); letter-spacing: 0.2px; margin-bottom: 0.5rem;">${post.title}</h3>
                        <p class="text-center" style="color: #6366f1; font-size: 1.01rem; font-weight: 500; line-height: 1.4; min-height: 36px;">${post.description}</p>
                        <div class="mb-2 text-center small text-muted">
                            <span>Publicado: ${post.created_at ? new Date(post.created_at).toLocaleString('pt-BR') : '-'}</span><br>
                            <span>Atualizado: ${post.updated_at ? new Date(post.updated_at).toLocaleString('pt-BR') : '-'}</span>
                        </div>
                        <div class="d-flex justify-content-center align-items-center gap-2 mt-auto" style="width: 100%;">
                            <button class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center" onclick="editPost(${post.id})" data-bs-toggle="tooltip" title="Editar" style="border-radius: 0.8rem; width: 2.6rem; height: 2.6rem;"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-outline-success btn-sm d-flex align-items-center justify-content-center" onclick="viewPost(${post.id})" data-bs-toggle="tooltip" title="Visualizar" style="border-radius: 0.8rem; width: 2.6rem; height: 2.6rem;"><i class="fas fa-eye"></i></button>
                            <button class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center" onclick="deletePost(${post.id})" data-bs-toggle="tooltip" title="Excluir" style="border-radius: 0.8rem; width: 2.6rem; height: 2.6rem;"><i class="fas fa-trash-can"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $carousel.append(postHtml);
    });
    
    // Reinitialize carousel
    $carousel.trigger('refresh.owl.carousel');
}

function editPost(postId) {
    currentPostId = postId;
    $('#postModalLabel').text('Editar Post');
    
    // Make AJAX request to fetch post data
    $.ajax({
        url: '/admin/posts/edit/' + postId,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const post = response.post;
                $('#postTitle').val(post.title);
                $('#postContent').val(post.description);
                
                // Show current image if exists
                if (post.image) {
                    $('#currentImagePreview').attr('src', '/' + post.image);
                    $('#currentImage').show();
                } else {
                    $('#currentImage').hide();
                }
                
                $('#postModal').modal('show');
            } else {
                showNotification('Erro ao carregar dados do post: ' + response.error, 'error');
            }
        },
        error: function(xhr, status, error) {
            showNotification('Erro ao carregar dados do post: ' + error, 'error');
        }
    });
}

function viewPost(postId) {
    // Implement post viewing
    // TODO: Implement post viewing functionality
    console.log('Viewing post:', postId);
}

function createNewPost() {
    currentPostId = null;
    $('#postModalLabel').text('Criar Novo Post');
    $('#postForm')[0].reset();
    $('#currentImage').hide();
    $('#postModal').modal('show');
}

function deletePost(postId) {
    postIdToDelete = postId;
    $('#deleteModal').modal('show');
}

function confirmDelete() {
    if (postIdToDelete) {
        $.ajax({
            url: '/admin/posts/delete/' + postIdToDelete,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#deleteModal').modal('hide');
                    showNotification(response.message, 'success');
                    postIdToDelete = null;
                    
                    // Reload posts list
                    location.reload();
                } else {
                    showNotification('Erro ao deletar post: ' + response.message, 'error');
                }
            },
            error: function(xhr, status, error) {
                showNotification('Erro ao deletar post: ' + error, 'error');
            }
        });
    }
}

function savePost() {
    var title = $('#postTitle').val();
    var content = $('#postContent').val();
    var imageFile = $('#postImage')[0].files[0];
    
    if (!title || !content) {
        showNotification('Por favor, preencha todos os campos obrigatórios!', 'error');
        return;
    }
    
    // Create FormData to send form data
    var formData = new FormData();
    formData.append('title', title);
    formData.append('description', content);
    if (imageFile) {
        formData.append('image', imageFile);
    }
    
    // Determine URL based on whether it's creation or editing
    var url = currentPostId ? '/admin/posts/update/' + currentPostId : '/admin/posts/store';
    
    $.ajax({
        url: url,
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#postModal').modal('hide');
                showNotification(response.message, 'success');
                
                // Clear form
                $('#postForm')[0].reset();
                $('#currentImage').hide();
                currentPostId = null;
                
                // Reload posts list
                location.reload();
            } else {
                showNotification('Erro ao salvar post: ' + response.message, 'error');
            }
        },
        error: function(xhr, status, error) {
            showNotification('Erro ao salvar post: ' + error, 'error');
        }
    });
}

// =======================
// Notifications
// Applies to: user feedback
// =======================
function showNotification(message, type) {
    // Create notification element
    var notification = $('<div class="alert alert-' + (type === 'error' ? 'danger' : type) + ' alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">' +
        message +
        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
        '</div>');
    
    $('body').append(notification);
    
    // Auto-remove after 5 seconds
    setTimeout(function() {
        notification.alert('close');
    }, 5000);
}

// =======================
// Search and Filters
// Applies to: post search functionality
// =======================
$('#searchPosts').on('input', function() {
    var searchTerm = $(this).val().toLowerCase();
    // Implement search logic
    console.log('Searching:', searchTerm);
});

$('#filterDateStart, #filterDateEnd').on('change', function() {
    var startDate = $('#filterDateStart').val();
    var endDate = $('#filterDateEnd').val();
    // Implement date filter logic
    console.log('Filtering by date:', { startDate, endDate });
});

// Post form submit event
$('#postForm').on('submit', function(e) {
    e.preventDefault();
    savePost();
});

// Clear form when modal is closed
$('#postModal').on('hidden.bs.modal', function() {
    $('#postForm')[0].reset();
    $('#currentImage').hide();
    currentPostId = null;
    $('#postModalLabel').text('Criar Novo Post');
});