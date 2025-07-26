<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($post->title) ?> | TechBlog</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/blog.css">
    <link rel="stylesheet" href="/assets/css/unavailable.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
    <!-- Navbar -->
    <nav class="navbar-blur fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <a href="/blog" class="flex items-center gap-2 unavailable-navbar">
                <span class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-600 to-secondary-600 flex items-center justify-center text-white"><i class="fas fa-blog text-lg"></i></span>
                <span class="text-2xl font-bold gradient-text">TechBlog</span>
            </a>
            <div class="hidden md:flex items-center gap-8">
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Início</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Artigos</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Tutoriais</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Avaliações</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Sobre</a>
            </div>
            <div class="hidden md:flex items-center gap-4">
                <?php if ($userData['isLoggedIn']): ?>
                    <!-- Usuário logado -->
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <button id="userDropdownBtn" class="flex items-center gap-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 transition-colors no-unavailable">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-500 to-teal-500 flex items-center justify-center text-white text-sm font-semibold">
                                    <?= substr($userData['user']['name'], 0, 1) ?>
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200"><?= esc($userData['user']['name']) ?></span>
                                <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                            </button>
                            <!-- Dropdown Menu -->
                            <div id="userDropdown" class="dropdown-hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-50">
                                <div class="py-2">
                                    <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white"><?= esc($userData['user']['name']) ?></div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400"><?= esc($userData['user']['email']) ?></div>
                                    </div>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors no-unavailable">
                                        <i class="fas fa-user mr-2"></i>Meu Perfil
                                    </a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors no-unavailable">
                                        <i class="fas fa-heart mr-2"></i>Favoritos
                                    </a>
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors no-unavailable">
                                        <i class="fas fa-cog mr-2"></i>Configurações
                                    </a>
                                    <div class="border-t border-gray-200 dark:border-gray-700 mt-1">
                                        <a href="/auth/logout" class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors no-unavailable">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Sair
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Usuário não logado -->
                    <a href="/auth/users" class="px-4 py-2 rounded-md bg-gradient-to-r from-green-500 to-teal-500 text-white font-medium flex items-center gap-2 shadow-md hover:from-green-600 hover:to-teal-600 transition-all no-unavailable">
                        <i class="fas fa-user mr-2"></i>Entrar
                    </a>
                <?php endif; ?>
            </div>
            <button id="mobileMenuButton" class="md:hidden text-gray-600 dark:text-gray-200 unavailable-navbar"><i class="fas fa-bars text-2xl"></i></button>
        </div>
        <div id="mobileMenu" class="hidden md:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
            <div class="px-4 py-4 flex flex-col gap-4">
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Início</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Artigos</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Tutoriais</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Avaliações</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Sobre</a>
                <?php if ($userData['isLoggedIn']): ?>
                    <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-green-500 to-teal-500 flex items-center justify-center text-white text-sm font-semibold">
                                <?= substr($userData['user']['name'], 0, 1) ?>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-white"><?= esc($userData['user']['name']) ?></div>
                                <div class="text-xs text-gray-500 dark:text-gray-400"><?= esc($userData['user']['email']) ?></div>
                            </div>
                        </div>
                        <a href="#" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors no-unavailable">
                            <i class="fas fa-user mr-2"></i>Meu Perfil
                        </a>
                        <a href="#" class="block px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors no-unavailable">
                            <i class="fas fa-heart mr-2"></i>Favoritos
                        </a>
                        <a href="/auth/logout" class="block px-3 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors no-unavailable">
                            <i class="fas fa-sign-out-alt mr-2"></i>Sair
                        </a>
                    </div>
                <?php else: ?>
                    <a href="/auth/users" class="px-4 py-2 rounded-md bg-gradient-to-r from-primary-600 to-secondary-600 text-white font-medium flex items-center gap-2 shadow-md hover:from-primary-700 hover:to-secondary-700 transition-all no-unavailable">
                        <i class="fas fa-user mr-2"></i>Entrar
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-28 pb-16 flex">
        <!-- Left Sidebar - Recent Highlights -->
        <aside class="hidden lg:block fixed left-0 top-16 w-80 h-screen bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 shadow-lg z-40 overflow-y-auto">
            <!-- Sidebar Header -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fas fa-star text-primary-600"></i>
                    Destaques Recentes
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Artigos em alta</p>
            </div>

            <!-- Recent Highlights List -->
            <div class="p-4">
                <div class="space-y-4">
                    <?php foreach($recentes as $rec): ?>
                        <a href="/blog/details/<?= $rec->id ?>" class="block group no-unavailable">
                            <div class="flex gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                <img src="<?= !empty($rec->image) ? '/' . esc($rec->image) : 'https://via.placeholder.com/64x64/667eea/ffffff?text=Foto' ?>" alt="<?= esc($rec->title) ?>" class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                                <div class="min-w-0 flex-1">
                                    <h4 class="font-medium text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2"><?= esc($rec->title) ?></h4>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                        <span>Publicado: <?= date('d/m/Y H:i', strtotime($rec->created_at)) ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </aside>

        <!-- Article Section -->
        <div class="flex-1 pl-0 lg:pl-80 pr-0 lg:pr-80">
            <div class="max-w-4xl mx-auto px-4 sm:px-6">
                <article class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden p-8">
                    <button onclick="window.history.back()" class="btn-back mb-6 flex items-center gap-2 no-unavailable">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </button>
                    <h1 class="detalhes-titulo text-3xl md:text-4xl font-bold mb-4"><?= esc($post->title) ?></h1>
                    <img src="<?= !empty($post->image) ? '/' . esc($post->image) : 'https://via.placeholder.com/900x400/667eea/ffffff?text=Foto' ?>" alt="<?= esc($post->title) ?>" class="detalhes-img w-full rounded-xl mb-6 shadow-md object-cover">
                    <div class="mb-3 text-xs text-gray-500 dark:text-gray-400">
                        <span>Publicado: <?= date('d/m/Y H:i', strtotime($post->created_at)) ?></span><br>
                        <span>Atualizado: <?= date('d/m/Y H:i', strtotime($post->updated_at)) ?></span>
                    </div>
                    <div class="detalhes-descricao prose prose-lg max-w-none">
                        <?= $post->description ?>
                    </div>
                </article>
            </div>
        </div>

        <!-- Right Sidebar -->
        <aside class="hidden lg:block fixed right-0 top-16 w-80 h-screen bg-white dark:bg-gray-800 border-l border-gray-200 dark:border-gray-700 shadow-lg z-40">
            <!-- Sidebar Header -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="fas fa-comments text-primary-600"></i>
                    Comentários
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Compartilhe suas ideias</p>
            </div>

            <!-- Comments Section -->
            <div class="comments-section h-full flex flex-col">
                <div class="comments-header">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="comments-count">
                                0 comentários
                            </p>
                        </div>
                        <div class="flex items-center gap-2">
                            <button class="text-xs text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors no-unavailable">
                                <i class="fas fa-sort-amount-down mr-1"></i>
                                Recentes
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="p-4 flex-1 flex flex-col">
                    <!-- Comment Form -->
                    <div class="comments-placeholder mb-4">
                        <!-- O sistema de comentários será inicializado aqui via JavaScript -->
                    </div>
                    
                    <!-- Comments List -->
                    <div class="comments-list flex-1">
                        <!-- Os comentários serão carregados aqui via JavaScript -->
                    </div>
                </div>
            </div>
        </aside>



        <!-- Mobile Highlights Panel -->
        <div id="mobileHighlightsPanel" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
            <div class="absolute left-0 top-0 h-full w-80 bg-white dark:bg-gray-800 shadow-lg transform -translate-x-full transition-transform duration-300">
                <!-- Mobile Sidebar Header -->
                <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fas fa-star text-primary-600"></i>
                        Destaques Recentes
                    </h2>
                    <button id="closeMobileHighlights" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 no-unavailable">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Mobile Highlights Section -->
                <div class="p-4 overflow-y-auto h-full">
                    <div class="space-y-4">
                        <?php foreach($recentes as $rec): ?>
                            <a href="/blog/details/<?= $rec->id ?>" class="block group no-unavailable">
                                <div class="flex gap-3 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <img src="<?= !empty($rec->image) ? '/' . esc($rec->image) : 'https://via.placeholder.com/64x64/667eea/ffffff?text=Foto' ?>" alt="<?= esc($rec->title) ?>" class="w-16 h-16 rounded-lg object-cover flex-shrink-0">
                                    <div class="min-w-0 flex-1">
                                        <h4 class="font-medium text-gray-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors line-clamp-2"><?= esc($rec->title) ?></h4>
                                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                            <span>Publicado: <?= date('d/m/Y H:i', strtotime($rec->created_at)) ?></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Comments Panel -->
        <div id="mobileCommentsPanel" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
            <div class="absolute right-0 top-0 h-full w-80 bg-white dark:bg-gray-800 shadow-lg transform translate-x-full transition-transform duration-300">
                <!-- Mobile Sidebar Header -->
                <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fas fa-comments text-primary-600"></i>
                        Comentários
                    </h2>
                    <button id="closeMobileComments" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 no-unavailable">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Mobile Comments Section -->
                <div class="comments-section h-full flex flex-col">
                    <div class="comments-header">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="comments-count">
                                    0 comentários
                                </p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="text-xs text-gray-500 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                    <i class="fas fa-sort-amount-down mr-1"></i>
                                    Recentes
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-4 flex-1 flex flex-col">
                        <!-- Comment Form -->
                        <div class="comments-placeholder mb-4">
                            <!-- O sistema de comentários será inicializado aqui via JavaScript -->
                        </div>
                        
                        <!-- Comments List -->
                        <div class="comments-list flex-1">
                            <!-- Os comentários serão carregados aqui via JavaScript -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-r from-primary-700 to-secondary-700 text-white py-10 mt-16">
        <div class="footer-inner">
            <div class="footer-brand">
                <h4>TechBlog</h4>
                <p>O melhor blog sobre tecnologia, programação e inovação.</p>
                <div class="footer-social">
                    <a href="#" aria-label="Twitter" class="no-unavailable"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Facebook" class="no-unavailable"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram" class="no-unavailable"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn" class="no-unavailable"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-links">
                <h5>Links</h5>
                <ul>
                    <li><a href="#" class="no-unavailable">Início</a></li>
                    <li><a href="#" class="no-unavailable">Artigos</a></li>
                    <li><a href="#" class="no-unavailable">Tutoriais</a></li>
                    <li><a href="#" class="no-unavailable">Avaliações</a></li>
                    <li><a href="#" class="no-unavailable">Sobre</a></li>
                </ul>
            </div>
            <div class="footer-categories">
                <h5>Categorias</h5>
                <ul>
                    <li><a href="#" class="no-unavailable">Inteligência Artificial</a></li>
                    <li><a href="#" class="no-unavailable">Programação</a></li>
                    <li><a href="#" class="no-unavailable">Desenvolvimento Web</a></li>
                    <li><a href="#" class="no-unavailable">Carreira</a></li>
                </ul>
            </div>
            <div class="footer-newsletter">
                <h5>Newsletter</h5>
                <form class="no-unavailable">
                    <input type="email" placeholder="Seu melhor email" required class="no-unavailable">
                    <button type="submit" class="no-unavailable">Assinar</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">&copy; 2025 TechBlog. All rights reserved.</div>
    </footer>

    <!-- Floating Buttons: Dark Mode + Mobile Toggles -->
    <div class="floating-buttons">
        <!-- Dark Mode Toggle -->
        <button id="darkModeToggle" class="unavailable-footer unavailable">
            <i class="fas fa-moon dark:hidden"></i>
            <i class="fas fa-sun hidden dark:block"></i>
        </button>
        
        <!-- Mobile Highlights Toggle (apenas mobile) -->
        <button id="mobileHighlightsToggle" class="mobile-toggle lg:hidden unavailable">
            <i class="fas fa-star"></i>
        </button>
        
        <!-- Mobile Comments Toggle (apenas mobile) -->
        <button id="mobileCommentsToggle" class="mobile-toggle lg:hidden unavailable">
            <i class="fas fa-comments"></i>
        </button>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/blog.js"></script>
    <script src="/assets/js/unavailable.js"></script>
    <script>
        // Initialize comments system when page loads
        $(document).ready(function() {
            // Get post ID from URL or data attribute
            const postId = <?= $post->id ?>;
            if (postId) {
                COMMENTS.init(postId);
            }
        });
    </script>
</body>
</html> 