// blogManager.js
// Manages interactions of the administrative posts panel (admin/posts, admin/dashboard, etc.)
// Contexts: admin panel (posts, dashboard, sidebar, modals)

// =======================
// Plugin Initialization
// Applies to: admin panel (posts carousel)
// =======================
$(document).ready(function(){
  $('.featured-carousel').owlCarousel({
    loop: false,
    margin: 30,
    nav: true,
    dots: true,
    navText: [
      '<span class="fas fa-chevron-left"></span>',
      '<span class="fas fa-chevron-right"></span>'
    ],
    responsive:{
      0:{ 
        items: 1,
        nav: true,
        dots: true
      },
      768:{ 
        items: 2,
        nav: true,
        dots: true
      },
      1200:{ 
        items: 3,
        nav: true,
        dots: true
      }
    },
    onInitialized: function() {
      $('.owl-nav').show();
      $('.owl-nav button').show();
    },
    onResized: function() {
      $('.owl-nav').show();
      $('.owl-nav button').show();
    }
  });
  
  setTimeout(function() {
    $('.owl-nav').show();
    $('.owl-nav button').show();
  }, 100);
  
  // =======================
  // FAB Button - New Post
  // Applies to: floating button to create new post
  // =======================
  $('#addPostFab').on('click', function() {
    $('#postForm')[0].reset();
    $('#postModalLabel').text('Novo Post');
    currentPostId = null;
    
    $('#postModal').modal('show');
  });
});

// =======================
// Sidebar and Navbar
// Applies to: admin panel (sidebar, navbar)
// =======================
$(function() {
    $('#mobile-menu-button').on('click', function() {
        $('.sidebar').toggleClass('active');
        $('.sidebar-overlay').toggleClass('active');
    });
    $('.sidebar-overlay').on('click', function() {
        $('.sidebar').removeClass('active');
        $('.sidebar-overlay').removeClass('active');
    });
    $('[data-bs-toggle="tooltip"]').tooltip();
    
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

function ensureNavButtonsVisible() {
  setTimeout(function() {
    $('.owl-nav').show();
    $('.owl-nav button').show();
    $('.owl-nav button').css({
      'display': 'flex !important',
      'visibility': 'visible !important',
      'opacity': '1 !important'
    });
  }, 50);
}

function getImageUrl(imagePath) {
    if (!imagePath) {
        return 'https://via.placeholder.com/420x180/667eea/ffffff?text=Foto';
    }
    
    if (imagePath.startsWith('/')) {
        return imagePath;
    }
    
    return '/' + imagePath;
}

function renderPosts(posts) {
    var $carousel = $('.featured-carousel');
    $carousel.empty();
    
    if (posts.length === 0) {
        $carousel.append(`
            <div class="item">
                <div class="text-center py-5">
                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                    <h4 class="text-muted">Nenhum post encontrado</h4>
                    <p class="text-muted">Clique no botão + para criar seu primeiro post!</p>
                </div>
            </div>
        `);
        return;
    }
    
    posts.forEach(function(post) {
        var imageUrl = getImageUrl(post.image);
        var postHtml = `
            <div class="item">
                <div class="blog-entry" style="border-radius: 1.3rem; overflow: hidden; box-shadow: 0 8px 32px rgba(102,102,234,0.18); background: linear-gradient(135deg, #f8fafc 80%, #e0e7ff 100%); height: 550px; display: flex; flex-direction: column;">
                    <a href="#" class="block-20 d-flex align-items-start" style="background-image: url('${imageUrl}'); height: 200px; background-size: cover; background-position: center; border-top-left-radius: 1.3rem; border-top-right-radius: 1.3rem; flex-shrink: 0;"></a>
                    
                    <div class="text border border-top-0 p-4" style="flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div class="content-section">
                            <h3 class="heading text-center" style="color: #3730a3; font-size: 1.18rem; font-weight: bold; text-shadow: 0 2px 8px rgba(102,102,234,0.08); letter-spacing: 0.2px; margin-bottom: 0.8rem;">${post.title}</h3>
                            <p class="text-center" style="color: #6366f1; font-size: 1.01rem; font-weight: 500; line-height: 1.4; margin-bottom: 1rem; min-height: 40px;">${post.description}</p>
                        </div>
                        
                        <div class="dates-section text-center small text-muted" style="margin-bottom: 1rem;">
                            <div style="margin-bottom: 0.3rem;">
                                <span>Publicado: ${post.created_at ? new Date(post.created_at).toLocaleString('pt-BR') : '-'}</span>
                            </div>
                            <div>
                                <span>Atualizado: ${post.updated_at ? new Date(post.updated_at).toLocaleString('pt-BR') : '-'}</span>
                            </div>
                        </div>
                        
                        <div class="actions-section d-flex justify-content-center align-items-center gap-2" style="margin-top: auto;">
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
    
    $carousel.trigger('refresh.owl.carousel');
    
    ensureNavButtonsVisible();
}

function editPost(postId) {
    currentPostId = postId;
    $('#postModalLabel').text('Editar Post');
    
    $.ajax({
        url: '/admin/posts/edit/' + postId,
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                const post = response.post;
                $('#postTitle').val(post.title);
                $('#postContent').val(post.description);
                
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
    
    var formData = new FormData();
    formData.append('title', title);
    formData.append('description', content);
    if (imageFile) {
        formData.append('image', imageFile);
    }
    
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
                
                $('#postForm')[0].reset();
                $('#currentImage').hide();
                currentPostId = null;
                
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
    var notification = $('<div class="alert alert-' + (type === 'error' ? 'danger' : type) + ' alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">' +
        message +
        '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
        '</div>');
    
    $('body').append(notification);
    
    setTimeout(function() {
        notification.alert('close');
    }, 5000);
}

// =======================
// Carousel Navigation Fix
// Applies to: ensure navigation buttons are always visible
// =======================

setInterval(function() {
    if ($('.featured-carousel').length > 0) {
        ensureNavButtonsVisible();
    }
}, 2000);

$(window).on('resize', function() {
    setTimeout(function() {
        ensureNavButtonsVisible();
    }, 100);
});

$(document).on('click', '.owl-nav button', function() {
    setTimeout(function() {
        ensureNavButtonsVisible();
    }, 100);
});

// =======================
// Search and Filter Functionality
// Applies to: post search and date filtering
// =======================

function searchAndFilterPosts() {
    var searchTerm = $('#searchPosts').val().toLowerCase();
    var startDate = $('#filterDateStart').val();
    var endDate = $('#filterDateEnd').val();
    
    if (!searchTerm && !startDate && !endDate) {
        location.reload();
        return;
    }
    
    $.ajax({
        url: '/admin/posts/search',
        method: 'GET',
        data: {
            q: searchTerm,
            date_start: startDate,
            date_end: endDate
        },
        dataType: 'json',
        success: function(response) {
            if (response.posts) {
                updateCarouselContent(response.posts);
            }
        },
        error: function(xhr, status, error) {
            console.error('Erro na busca:', error);
            location.reload();
        }
    });
}

function updateCarouselContent(posts) {
    var $carousel = $('.featured-carousel');
    var $owlCarousel = $carousel.data('owl.carousel');
    
    if (posts.length === 0) {
        $carousel.find('.owl-stage').html(`
            <div class="owl-item active" style="width: 100%;">
                <div class="item">
                    <div class="no-results">
                        <div class="text-center">
                            <i class="fas fa-search fa-3x mb-3"></i>
                            <h4>Nenhum resultado encontrado</h4>
                            <p>Tente ajustar os filtros de busca</p>
                        </div>
                    </div>
                </div>
            </div>
        `);
        return;
    }
    
    $carousel.find('.owl-stage').empty();
    
    posts.forEach(function(post, index) {
        var imageUrl = getImageUrl(post.image);
        var postHtml = `
            <div class="owl-item ${index === 0 ? 'active' : ''}" style="width: 350px; margin-right: 30px;">
                <div class="item">
                    <div class="blog-entry" style="border-radius: 1.3rem; overflow: hidden; box-shadow: 0 8px 32px rgba(102,102,234,0.18); background: linear-gradient(135deg, #f8fafc 80%, #e0e7ff 100%); height: 550px; display: flex; flex-direction: column;">
                        <a href="#" class="block-20 d-flex align-items-start" style="background-image: url('${imageUrl}'); height: 200px; background-size: cover; background-position: center; border-top-left-radius: 1.3rem; border-top-right-radius: 1.3rem; flex-shrink: 0;"></a>
                        
                        <div class="text border border-top-0 p-4" style="flex: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            <div class="content-section">
                                <h3 class="heading text-center" style="color: #3730a3; font-size: 1.18rem; font-weight: bold; text-shadow: 0 2px 8px rgba(102,102,234,0.08); letter-spacing: 0.2px; margin-bottom: 0.8rem;">${post.title}</h3>
                                <p class="text-center" style="color: #6366f1; font-size: 1.01rem; font-weight: 500; line-height: 1.4; margin-bottom: 1rem; min-height: 40px;">${post.description}</p>
                            </div>
                            
                            <div class="dates-section text-center small text-muted" style="margin-bottom: 1rem;">
                                <div style="margin-bottom: 0.3rem;">
                                    <span>Publicado: ${post.created_at ? new Date(post.created_at).toLocaleString('pt-BR') : '-'}</span>
                                </div>
                                <div>
                                    <span>Atualizado: ${post.updated_at ? new Date(post.updated_at).toLocaleString('pt-BR') : '-'}</span>
                                </div>
                            </div>
                            
                            <div class="actions-section d-flex justify-content-center align-items-center gap-2" style="margin-top: auto;">
                                <button class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center" onclick="editPost(${post.id})" data-bs-toggle="tooltip" title="Editar" style="border-radius: 0.8rem; width: 2.6rem; height: 2.6rem;"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-outline-success btn-sm d-flex align-items-center justify-content-center" onclick="viewPost(${post.id})" data-bs-toggle="tooltip" title="Visualizar" style="border-radius: 0.8rem; width: 2.6rem; height: 2.6rem;"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center" onclick="deletePost(${post.id})" data-bs-toggle="tooltip" title="Excluir" style="border-radius: 0.8rem; width: 2.6rem; height: 2.6rem;"><i class="fas fa-trash-can"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $carousel.find('.owl-stage').append(postHtml);
    });
    
    if ($owlCarousel) {
        $owlCarousel.refresh();
    }
    
    ensureNavButtonsVisible();
}

function debounce(func, wait) {
    var timeout;
    return function executedFunction() {
        var context = this;
        var args = arguments;
        var later = function() {
            timeout = null;
            func.apply(context, args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

var debouncedSearch = debounce(searchAndFilterPosts, 300);

$('#searchPosts').on('input', function() {
    debouncedSearch();
});

$('#filterDateStart, #filterDateEnd').on('change', function() {
    searchAndFilterPosts();
});

function clearFilters() {
    $('#searchPosts').val('');
    $('#filterDateStart').val('');
    $('#filterDateEnd').val('');
    
    location.reload();
}

$(document).ready(function() {
    $('<button type="button" class="btn btn-outline-secondary btn-sm ms-2" onclick="clearFilters()" title="Limpar filtros"><i class="fas fa-times"></i></button>')
        .insertAfter('#filterDateEnd');
});

// =======================
// Post Form Events
// Applies to: post form submission and modal handling
// =======================

$('#postForm').on('submit', function(e) {
    e.preventDefault();
    savePost();
});

$('#postModal').on('hidden.bs.modal', function() {
    $('#postForm')[0].reset();
    $('#currentImage').hide();
    currentPostId = null;
    $('#postModalLabel').text('Criar Novo Post');
});