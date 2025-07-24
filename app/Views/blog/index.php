<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechBlog | Últimas Notícias de Tecnologia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="/assets/css/blog.css">
    <link rel="stylesheet" href="/assets/css/unavailable.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-200">
    <!-- Navbar -->
    <nav class="navbar-blur fixed top-0 left-0 w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <a href="#" class="flex items-center gap-2">
                <span class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-600 to-secondary-600 flex items-center justify-center text-white"><i class="fas fa-blog text-lg"></i></span>
                <span class="text-2xl font-bold gradient-text">TechBlog</span>
            </a>
            <div class="hidden md:flex items-center gap-8">
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Home</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Artigos</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Tutoriais</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Reviews</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Sobre</a>
            </div>
            <div class="hidden md:flex items-center gap-4">
                <a href="#" class="px-4 py-2 rounded-md bg-gradient-to-r from-primary-600 to-secondary-600 text-white font-medium hover:from-primary-700 hover:to-secondary-700 transition-all shadow-md">Assinar</a>
            </div>
            <button id="mobileMenuButton" class="md:hidden text-gray-600 dark:text-gray-200"><i class="fas fa-bars text-2xl"></i></button>
        </div>
        <div id="mobileMenu" class="hidden md:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
            <div class="px-4 py-4 flex flex-col gap-4">
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Home</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Artigos</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Tutoriais</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Reviews</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Sobre</a>
                <a href="#" class="px-4 py-2 rounded-md bg-gradient-to-r from-primary-600 to-secondary-600 text-white font-medium hover:from-primary-700 hover:to-secondary-700 transition-all shadow-md">Assinar</a>
            </div>
        </div>
    </nav>
    <!-- Dark Mode Toggle -->
    <button id="darkModeToggle" class="fixed bottom-6 right-6 z-50 w-12 h-12 rounded-full bg-primary-600 dark:bg-primary-800 text-white shadow-lg flex items-center justify-center hover:bg-primary-700 dark:hover:bg-primary-700 transition-colors duration-300 unavailable-footer">
        <i class="fas fa-moon dark:hidden"></i>
        <i class="fas fa-sun hidden dark:block"></i>
    </button>
    <!-- Hero -->
    <section class="hero-bg pt-28 pb-16 md:pb-24">
        <div class="max-w-3xl mx-auto text-center animate-fade-in">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Explore o mundo da <span class="gradient-text">tecnologia</span></h1>
            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 mb-8">As últimas notícias, tendências e análises sobre tecnologia, programação, inteligência artificial e muito mais.</p>
            <form class="max-w-lg mx-auto" method="get" action="" id="searchForm">
                <div class="flex shadow-lg rounded-lg overflow-hidden">
                    <input type="text" name="q" id="searchInput" value="<?= isset($q) ? esc($q) : '' ?>" placeholder="Buscar artigos..." class="flex-grow px-4 py-3 focus:outline-none dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400">
                    <button id="searchBtn" type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 flex items-center justify-center transition-colors" style="cursor:pointer !important;">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </section>
    <!-- Destaques -->
    <section class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 animate-fade-in">
                <h2 class="text-2xl font-bold mb-4 md:mb-0">
                    <?php if (!empty($q)): ?>
                        Resultado da pesquisa
                    <?php else: ?>
                        Artigos em Destaque
                    <?php endif; ?>
                </h2>
                <a href="#" class="text-primary-600 dark:text-primary-400 font-medium hover:underline flex items-center">Ver todos <i class="fas fa-arrow-right ml-2"></i></a>
            </div>
            <div class="flex justify-center">
                <div id="postsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in">
                    <?php if (isset($posts) && count($posts) > 0): ?>
                        <?php $count = 0; ?>
                        <?php foreach ($posts as $post): ?>
                            <?php if (empty($q) && $count++ >= 3) break; ?>
                            <div class="card-glass rounded-xl overflow-hidden shadow-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 post-card" data-id="<?= $post->id ?>" style="cursor:pointer;">
                                <img src="<?= !empty($post->image) ? '/' . esc($post->image) : 'https://via.placeholder.com/600x400/667eea/ffffff?text=Foto' ?>" alt="<?= esc($post->title) ?>" class="w-full h-48 object-cover">
                                <div class="p-6">
                                    <h3 class="text-xl font-bold mb-2"><?= esc($post->title) ?></h3>
                                    <div class="post-description mb-4"><?= esc($post->description) ?></div>
                                    <div class="mb-2 text-xs text-gray-500 dark:text-gray-400">
                                        <span>Publicado: <?= date('d/m/Y H:i', strtotime($post->created_at)) ?></span><br>
                                        <span>Atualizado: <?= date('d/m/Y H:i', strtotime($post->updated_at)) ?></span>
                                    </div>
                                    <button class="btn-view mt-2 px-4 py-2 rounded-md bg-primary-600 hover:bg-primary-700 text-white font-semibold transition-colors">Visualizar</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-span-3 text-center text-gray-400 py-12">
                            <?php if (!empty($q)): ?>Nenhum resultado encontrado.<?php else: ?>Nenhum post encontrado.<?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
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
                    <li><a href="#">Web Development</a></li>
                    <li><a href="#">Carreira</a></li>
                </ul>
            </div>
            <div class="footer-newsletter">
                <h5>Newsletter</h5>
                <form>
                    <input type="email" placeholder="Seu melhor e-mail" required>
                    <button type="submit">Assinar</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">&copy; 2023 TechBlog. Todos os direitos reservados.</div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/blog.js"></script>
    <script src="/assets/js/unavailable.js"></script>
</body>
</html>