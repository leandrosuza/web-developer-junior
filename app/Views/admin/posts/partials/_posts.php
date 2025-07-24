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
        <div class="row g-3">
            <div class="col-12 col-md-6">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="fas fa-search text-muted"></i>
                    </span>
                    <input type="text" class="form-control border-start-0" placeholder="Buscar posts..." id="searchPosts">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Posts Table -->
<div class="card shadow posts-table-card mb-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 posts-table">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Linha 1 -->
                    <tr class="post-item">
                        <td>
                            <img src="https://via.placeholder.com/60x40/667eea/ffffff?text=Foto" alt="Foto do Post" class="rounded" style="width: 60px; height: 40px; object-fit: cover;">
                        </td>
                        <td>
                            Como criar um blog moderno
                            <span class="badge bg-success ms-2">Novo</span>
                        </td>
                        <td><div class="text-truncate" style="max-width: 220px;">Guia completo para criar um blog com as melhores práticas de desenvolvimento web...</div></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" onclick="editPost(1)" data-bs-toggle="tooltip" title="Editar"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-outline-success" onclick="viewPost(1)" data-bs-toggle="tooltip" title="Visualizar"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-outline-danger" onclick="deletePost(1)" data-bs-toggle="tooltip" title="Excluir"><i class="fas fa-trash-can"></i></button>
                            </div>
                        </td>
                    </tr>
                    <!-- Linha 2 -->
                    <tr class="post-item">
                        <td>
                            <img src="https://via.placeholder.com/60x40/764ba2/ffffff?text=Foto" alt="Foto do Post" class="rounded" style="width: 60px; height: 40px; object-fit: cover;">
                        </td>
                        <td>Estratégias de SEO para 2023</td>
                        <td><div class="text-truncate" style="max-width: 220px;">As melhores técnicas de SEO para melhorar seu ranking nos motores de busca...</div></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" onclick="editPost(2)" data-bs-toggle="tooltip" title="Editar"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-outline-success" onclick="viewPost(2)" data-bs-toggle="tooltip" title="Visualizar"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-outline-danger" onclick="deletePost(2)" data-bs-toggle="tooltip" title="Excluir"><i class="fas fa-trash-can"></i></button>
                            </div>
                        </td>
                    </tr>
                    <!-- Linha 3 -->
                    <tr class="post-item">
                        <td>
                            <img src="https://via.placeholder.com/60x40/67eaff/ffffff?text=Foto" alt="Foto do Post" class="rounded" style="width: 60px; height: 40px; object-fit: cover;">
                        </td>
                        <td>Tendências de UI/UX para apps</td>
                        <td><div class="text-truncate" style="max-width: 220px;">Conheça as principais tendências de design para aplicativos móveis...</div></td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" onclick="editPost(3)" data-bs-toggle="tooltip" title="Editar"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-outline-success" onclick="viewPost(3)" data-bs-toggle="tooltip" title="Visualizar"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-outline-danger" onclick="deletePost(3)" data-bs-toggle="tooltip" title="Excluir"><i class="fas fa-trash-can"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Footer branco arredondado -->
        <div class="posts-table-footer"></div>
    </div>
</div>

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