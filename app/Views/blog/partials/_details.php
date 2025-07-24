<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($post->title) ?> | TechBlog</title>
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
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Home</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Articles</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Tutorials</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Reviews</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">About</a>
            </div>
            <div class="hidden md:flex items-center gap-4">
                <a href="#" class="px-4 py-2 rounded-md bg-gradient-to-r from-primary-600 to-secondary-600 text-white font-medium hover:from-primary-700 hover:to-secondary-700 transition-all shadow-md unavailable-navbar">Assinar</a>
            </div>
            <button id="mobileMenuButton" class="md:hidden text-gray-600 dark:text-gray-200 unavailable-navbar"><i class="fas fa-bars text-2xl"></i></button>
        </div>
        <div id="mobileMenu" class="hidden md:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
            <div class="px-4 py-4 flex flex-col gap-4">
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Home</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Articles</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Tutorials</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">Reviews</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors unavailable-navbar">About</a>
                <a href="#" class="px-4 py-2 rounded-md bg-gradient-to-r from-primary-600 to-secondary-600 text-white font-medium hover:from-primary-700 hover:to-secondary-700 transition-all shadow-md unavailable-navbar">Assinar</a>
            </div>
        </div>
    </nav>
    <!-- Main Content -->
    <main class="pt-28 pb-16 max-w-5xl mx-auto px-4 sm:px-6 flex flex-col md:flex-row gap-8">
        <!-- Article -->
        <article class="flex-1 bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden p-8">
            <button onclick="window.history.back()" class="btn-back mb-6 flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Voltar
            </button>
            <h1 class="detalhes-titulo text-3xl md:text-4xl font-bold mb-4"><?= esc($post->title) ?></h1>
            <img src="<?= !empty($post->image) ? '/' . esc($post->image) : 'https://via.placeholder.com/900x400/667eea/ffffff?text=Foto' ?>" alt="<?= esc($post->title) ?>" class="detalhes-img w-full rounded-xl mb-6 shadow-md object-cover">
            <div class="mb-3 text-xs text-gray-500 dark:text-gray-400">
                <span>Publicado: <?= date('d/m/Y H:i', strtotime($post->created_at)) ?></span><br>
                <span>Atualizado: <?= date('d/m/Y H:i', strtotime($post->updated_at)) ?></span>
            </div>
            <div class="detalhes-descricao prose prose-lg max-w-none mb-10">
                <?= $post->description ?>
            </div>
            <div class="detalhes-comentarios mt-10">
                <h2 class="text-2xl font-semibold mb-4">Comentários</h2>
                <div class="comments-placeholder text-gray-500">(Área de comentários em breve...)</div>
            </div>
        </article>
        <!-- Recent Highlights Card -->
        <aside class="md:w-80 flex-shrink-0">
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6 mb-6 shadow-md">
                <h3 class="font-bold text-lg mb-4">Destaques Recentes</h3>
                <div class="space-y-4">
                    <?php foreach($recentes as $rec): ?>
                        <a href="/blog/details/<?= $rec->id ?>" class="block group">
                            <div class="flex gap-3">
                                <img src="<?= !empty($rec->image) ? '/' . esc($rec->image) : 'https://via.placeholder.com/64x64/667eea/ffffff?text=Foto' ?>" alt="<?= esc($rec->title) ?>" class="w-16 h-16 rounded-lg object-cover">
                                <div>
                                    <h4 class="font-medium group-hover:text-primary-600 dark:group-hover:text-primary-400 transition"><?= esc($rec->title) ?></h4>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        <span>Publicado: <?= date('d/m/Y H:i', strtotime($rec->created_at)) ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </aside>
    </main>
    <!-- Footer -->
    <footer class="bg-gradient-to-r from-primary-700 to-secondary-700 text-white py-10 mt-16">
        <div class="footer-inner">
            <div class="footer-brand">
                <h4>TechBlog</h4>
                <p>O melhor blog sobre tecnologia, programação e inovação.</p>
                <div class="footer-social">
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-links">
                <h5>Links</h5>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Artigos</a></li>
                    <li><a href="#">Tutoriais</a></li>
                    <li><a href="#">Reviews</a></li>
                    <li><a href="#">Sobre</a></li>
                </ul>
            </div>
            <div class="footer-categories">
                <h5>Categorias</h5>
                <ul>
                    <li><a href="#">Inteligência Artificial</a></li>
                    <li><a href="#">Programação</a></li>
                    <li><a href="#">Desenvolvimento Web</a></li>
                    <li><a href="#">Carreira</a></li>
                </ul>
            </div>
            <div class="footer-newsletter">
                <h5>Newsletter</h5>
                <form>
                    <input type="email" placeholder="Seu melhor email" required>
                    <button type="submit">Assinar</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">&copy; 2023 TechBlog. Todos os direitos reservados.</div>
    </footer>
    <!-- Dark Mode Toggle -->
    <button id="darkModeToggle" class="fixed bottom-6 right-6 z-50 w-12 h-12 rounded-full bg-primary-600 dark:bg-primary-800 text-white shadow-lg flex items-center justify-center hover:bg-primary-700 dark:hover:bg-primary-700 transition-colors duration-300 unavailable-footer">
        <i class="fas fa-moon dark:hidden"></i>
        <i class="fas fa-sun hidden dark:block"></i>
    </button>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/blog.js"></script>
    <script src="/assets/js/unavailable.js"></script>
</body>
</html> 