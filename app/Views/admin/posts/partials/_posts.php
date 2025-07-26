<!-- Resumo -->
<div class="row mb-3 align-items-center">
    <div class="col-12">
        <div class="posts-summary-card p-3 d-flex align-items-center gap-4 w-100">
            <div>
                <div class="fw-bold text-primary-emphasis" style="font-size: 1.2rem;">Total de Posts</div>
                <div class="h3 mb-0 fw-bold">3</div>
            </div>
            <div class="vr d-none d-md-block" style="height: 2.5rem;"></div>
            <div class="text-muted small">
                <i class="fas fa-clock me-1"></i>Última atualização: 22/07/2025 21:47
            </div>
            <div class="d-none d-md-block ms-auto">
                <span class="badge bg-gradient-primary px-3 py-2">Dica: Clique no lápis para editar um post!</span>
            </div>
        </div>
    </div>
</div>

<!-- Search Bar -->
<div class="card shadow posts-table-card mb-4">
    <div class="card-body">
        <div class="row g-3 justify-content-center align-items-center">
            <div class="col-12 col-md-3 d-flex justify-content-center">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Buscar posts..." id="searchPosts">
                </div>
            </div>
            <div class="col-12 col-md-2 d-flex justify-content-center">
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-calendar-alt text-muted"></i></span>
                    <input type="date" class="form-control" id="filterDateStart" placeholder="Data inicial">
                </div>
            </div>
            <div class="col-12 col-md-2 d-flex justify-content-center">
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-calendar-alt text-muted"></i></span>
                    <input type="date" class="form-control" id="filterDateEnd" placeholder="Data final">
                </div>
            </div>
            <div class="col-12 col-md-3 d-flex justify-content-center">
                <button class="btn btn-primary d-flex align-items-center gap-2" onclick="createNewPost()">
                    <i class="fas fa-plus"></i>
                    Novo Post
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Carrossel de Posts -->
<?php
// Ensure $posts is defined and is array/Collection
if (!isset($posts) || !is_array($posts) && !($posts instanceof \Countable)) {
    $posts = [];
}
$postsArray = is_array($posts) ? $posts : (method_exists($posts, 'toArray') ? $posts->toArray() : []);
// Sort by creation date (most recent first)
if (!empty($postsArray)) {
    usort($postsArray, function($a, $b) {
        $dateA = is_array($a) ? $a['created_at'] : $a->created_at;
        $dateB = is_array($b) ? $b['created_at'] : $b->created_at;
        return strtotime($dateB) - strtotime($dateA);
    });
}
?>
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <!-- Title removed as requested -->
            <div class="col-md-12">
                <div class="featured-carousel owl-carousel">
                    <?php foreach ($postsArray as $post): ?>
                        <?php
                            $image = is_array($post) ? $post['image'] : $post->image;
                            $title = is_array($post) ? $post['title'] : $post->title;
                            $description = is_array($post) ? $post['description'] : $post->description;
                            $id = is_array($post) ? $post['id'] : $post->id;
                        ?>
                        <div class="item">
                            <div class="blog-entry" style="border-radius: 1.3rem; overflow: hidden; box-shadow: 0 8px 32px rgba(102,102,234,0.18); background: linear-gradient(135deg, #f8fafc 80%, #e0e7ff 100%); height: 550px; display: flex; flex-direction: column; justify-content: flex-start; align-items: stretch;">
                                <a href="#" class="block-20 d-flex align-items-start" style="background-image: url('<?= !empty($image) ? '/' . esc($image) : 'https://via.placeholder.com/420x180/667eea/ffffff?text=Foto' ?>'); height: 200px; background-size: cover; background-position: center; border-top-left-radius: 1.3rem; border-top-right-radius: 1.3rem;"></a>
                                <div class="text border border-top-0 p-4 d-flex flex-column justify-content-between align-items-center" style="flex: 1 1 auto; min-height: 0;">
                                    <h3 class="heading text-center" style="color: #3730a3; font-size: 1.18rem; font-weight: bold; text-shadow: 0 2px 8px rgba(102,102,234,0.08); letter-spacing: 0.2px; margin-bottom: 0.5rem;"> <?= esc($title) ?> </h3>
                                    <p class="text-center" style="color: #6366f1; font-size: 1.01rem; font-weight: 500; line-height: 1.4; min-height: 36px;"> <?= esc($description) ?> </p>
                                    <div class="mb-2 text-center small text-muted">
                                        <span>Publicado: <?= isset($post->created_at) ? date('d/m/Y H:i', strtotime($post->created_at)) : (isset($post['created_at']) ? date('d/m/Y H:i', strtotime($post['created_at'])) : '-') ?></span><br>
                                        <span>Atualizado: <?= isset($post->updated_at) ? date('d/m/Y H:i', strtotime($post->updated_at)) : (isset($post['updated_at']) ? date('d/m/Y H:i', strtotime($post['updated_at'])) : '-') ?></span>
                                    </div>
                                    <div class="d-flex justify-content-center align-items-center gap-2 mt-auto" style="width: 100%;">
                                        <button class="btn btn-outline-primary btn-sm d-flex align-items-center justify-content-center" onclick="editPost(<?= $id ?>)" data-bs-toggle="tooltip" title="Editar" style="border-radius: 0.8rem; width: 2.6rem; height: 2.6rem;"><i class="fas fa-edit"></i></button>
                                        <button class="btn btn-outline-success btn-sm d-flex align-items-center justify-content-center" onclick="viewPost(<?= $id ?>)" data-bs-toggle="tooltip" title="Visualizar" style="border-radius: 0.8rem; width: 2.6rem; height: 2.6rem;"><i class="fas fa-eye"></i></button>
                                        <button class="btn btn-outline-danger btn-sm d-flex align-items-center justify-content-center" onclick="deletePost(<?= $id ?>)" data-bs-toggle="tooltip" title="Excluir" style="border-radius: 0.8rem; width: 2.6rem; height: 2.6rem;"><i class="fas fa-trash-can"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Post Modal -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postModalLabel">Novo Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="postForm">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="postTitle" class="form-label">Nome do Post</label>
                            <input type="text" class="form-control" id="postTitle" placeholder="Digite o nome do post" required>
                        </div>
                        <div class="col-12">
                            <label for="postImage" class="form-label">Foto do Post</label>
                            <input type="file" class="form-control" id="postImage" accept="image/*">
                            <div class="form-text">Formatos aceitos: JPG, PNG, GIF. Tamanho máximo: 2MB</div>
                        </div>
                        <div class="col-12">
                            <label for="postContent" class="form-label">Descrição (HTML)</label>
                            <textarea class="form-control" id="postContent" rows="8" placeholder="Digite a descrição em HTML..." required></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="savePost()">
                    <i class="fas fa-save me-2"></i>Salvar Post
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir este post?</p>
                <p class="text-muted small">Esta ação não pode ser desfeita.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                    <i class="fas fa-trash me-2"></i>Excluir
                </button>
            </div>
        </div>
    </div>
</div>

                <!-- Floating button for new post -->
<button id="addPostFab" class="fab-add-post"><i class="fas fa-plus"></i></button> 