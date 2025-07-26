<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechBlog | Últimas Notícias de Tecnologia</title>
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
            <a href="#" class="flex items-center gap-2">
                <span class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-600 to-secondary-600 flex items-center justify-center text-white"><i class="fas fa-blog text-lg"></i></span>
                <span class="text-2xl font-bold gradient-text">TechBlog</span>
            </a>
            <div class="hidden md:flex items-center gap-8">
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Início</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Artigos</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Tutoriais</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Avaliações</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Sobre</a>
            </div>
            <div class="hidden md:flex items-center gap-4">
                <?php if ($userData['isLoggedIn']): ?>
                    <!-- Usuário logado -->
                    <div class="flex items-center gap-3">
                        <div class="relative">
                            <button id="userDropdownBtn" class="no-unavailable flex items-center gap-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg p-2 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-500 to-teal-500 flex items-center justify-center text-white text-sm font-semibold">
                                    <?= substr($userData['user']['name'], 0, 1) ?>
                                </div>
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-200">
                                    <?= esc($userData['user']['name']) ?>
                                </span>
                                <i class="fas fa-chevron-down text-xs text-gray-500"></i>
                            </button>
                            <!-- Dropdown Menu -->
                            <div id="userDropdown" class="dropdown-hidden absolute right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-50">
                                <div class="py-2">
                                    <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white"><?= esc($userData['user']['name']) ?></div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400"><?= $userData['user']['email'] ? esc($userData['user']['email']) : 'Administrador' ?></div>
                                    </div>
                                    <a href="#" class="no-unavailable block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                        <i class="fas fa-user mr-2"></i>Meu Perfil
                                    </a>
                                    <a href="#" class="no-unavailable block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                        <i class="fas fa-heart mr-2"></i>Favoritos
                                    </a>
                                    <a href="#" class="no-unavailable block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                        <i class="fas fa-cog mr-2"></i>Configurações
                                    </a>
                                    <div class="border-t border-gray-200 dark:border-gray-700 mt-1">
                                        <?php if ($userData['isAdmin']): ?>
                                            <a href="/admin/posts/blogManager" class="no-unavailable block px-4 py-2 text-sm text-yellow-600 dark:text-yellow-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                <i class="fas fa-cog mr-2"></i>Painel Admin
                                            </a>
                                        <?php endif; ?>
                                        <a href="/auth/logout" class="no-unavailable block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                            <i class="fas fa-sign-out-alt mr-2"></i>Sair
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Usuário não logado -->
                    <a href="/auth/users" class="no-unavailable px-4 py-2 rounded-md bg-gradient-to-r from-green-500 to-teal-500 text-white font-medium flex items-center gap-2 shadow-md hover:from-green-600 hover:to-teal-600 transition-all">
                        <i class="fas fa-user mr-2"></i>Entrar
                    </a>
                <?php endif; ?>
            </div>
            <button id="mobileMenuButton" class="md:hidden text-gray-600 dark:text-gray-200"><i class="fas fa-bars text-2xl"></i></button>
        </div>
        <div id="mobileMenu" class="hidden md:hidden bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800">
            <div class="px-4 py-4 flex flex-col gap-4">
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Início</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Artigos</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Tutoriais</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Avaliações</a>
                <a href="#" class="text-gray-700 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors">Sobre</a>
                <?php if ($userData['isLoggedIn']): ?>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-500 to-teal-500 flex items-center justify-center text-white text-sm font-semibold">
                            <?= substr($userData['user']['name'], 0, 1) ?>
                        </div>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-200">
                            <?= esc($userData['user']['name']) ?>
                        </span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <a href="#" class="px-3 py-2 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-medium transition-all">
                            <i class="fas fa-user mr-2"></i>Meu Perfil
                        </a>
                        <a href="#" class="px-3 py-2 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm font-medium transition-all">
                            <i class="fas fa-heart mr-2"></i>Favoritos
                        </a>
                        <?php if ($userData['isAdmin']): ?>
                            <a href="/admin/posts/blogManager" class="px-3 py-2 rounded-md bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium transition-all">
                                <i class="fas fa-cog mr-1"></i>Admin
                            </a>
                        <?php endif; ?>
                        <a href="/auth/logout" class="px-3 py-2 rounded-md bg-red-600 hover:bg-red-700 text-white text-sm font-medium transition-all">
                            <i class="fas fa-sign-out-alt mr-1"></i>Sair
                        </a>
                    </div>
                <?php else: ?>
                    <a href="/auth/users" class="no-unavailable px-4 py-2 rounded-md bg-gradient-to-r from-green-500 to-teal-500 text-white font-medium flex items-center gap-2 shadow-md hover:from-green-600 hover:to-teal-600 transition-all">
                        <i class="fas fa-user mr-2"></i>Entrar
                    </a>
                <?php endif; ?>
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
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar Mais Vistos -->
                <div class="lg:w-1/3 mb-8 lg:mb-0">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 sticky top-4">
                        <div class="flex items-center mb-6">
                            <i class="fas fa-fire text-orange-500 text-xl mr-3"></i>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white">Mais Vistos</h3>
                        </div>
                        
                        <div class="space-y-4">
                            <!-- Artigo 1 -->
                            <div class="popular-article">
                                <div class="article-icon">
                                    <i class="fas fa-brain text-orange-500"></i>
                                </div>
                                <div class="article-content">
                                    <h4 class="article-title">Inteligência Artificial em 2025</h4>
                                    <p class="article-description">Como a IA está revolucionando o desenvolvimento de software</p>
                                    <div class="article-meta">
                                        <span class="views"><i class="fas fa-eye"></i> 15.2k</span>
                                        <span class="time">2 dias atrás</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Artigo 2 -->
                            <div class="popular-article">
                                <div class="article-icon">
                                    <i class="fab fa-react text-blue-500"></i>
                                </div>
                                <div class="article-content">
                                    <h4 class="article-title">React 19: Novidades</h4>
                                    <p class="article-description">Tudo sobre as novas features do React 19</p>
                                    <div class="article-meta">
                                        <span class="views"><i class="fas fa-eye"></i> 12.8k</span>
                                        <span class="time">3 dias atrás</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Artigo 3 -->
                            <div class="popular-article">
                                <div class="article-icon">
                                    <i class="fab fa-python text-green-500"></i>
                                </div>
                                <div class="article-content">
                                    <h4 class="article-title">Python para Data Science</h4>
                                    <p class="article-description">Ferramentas essenciais para análise de dados</p>
                                    <div class="article-meta">
                                        <span class="views"><i class="fas fa-eye"></i> 10.5k</span>
                                        <span class="time">5 dias atrás</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Artigo 4 -->
                            <div class="popular-article">
                                <div class="article-icon">
                                    <i class="fab fa-node-js text-yellow-500"></i>
                                </div>
                                <div class="article-content">
                                    <h4 class="article-title">Node.js Performance</h4>
                                    <p class="article-description">Otimizando aplicações Node.js para produção</p>
                                    <div class="article-meta">
                                        <span class="views"><i class="fas fa-eye"></i> 9.3k</span>
                                        <span class="time">1 semana atrás</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Artigo 5 -->
                            <div class="popular-article">
                                <div class="article-icon">
                                    <i class="fas fa-cloud text-blue-600"></i>
                                </div>
                                <div class="article-content">
                                    <h4 class="article-title">DevOps Essentials</h4>
                                    <p class="article-description">Fundamentos para implementar DevOps</p>
                                    <div class="article-meta">
                                        <span class="views"><i class="fas fa-eye"></i> 8.7k</span>
                                        <span class="time">1 semana atrás</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Conteúdo Principal -->
                <div class="lg:w-2/3">
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
                        <div id="postsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-8 animate-fade-in">
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
    
    <!-- Estatísticas do Blog -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 animate-fade-in">Estatísticas do TechBlog</h2>
            <div class="stats-container">
                <div class="stat-card animate-slide-in">
                    <div class="stat-number" data-target="150">0</div>
                    <div class="stat-label">Artigos Publicados</div>
                </div>
                <div class="stat-card animate-slide-in">
                    <div class="stat-number" data-target="25000">0</div>
                    <div class="stat-label">Leitores Mensais</div>
                </div>
                <div class="stat-card animate-slide-in">
                    <div class="stat-number" data-target="15">0</div>
                    <div class="stat-label">Categorias</div>
                </div>
                <div class="stat-card animate-slide-in">
                    <div class="stat-number" data-target="98">0</div>
                    <div class="stat-label">% de Satisfação</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tecnologias em Pastas -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 animate-fade-in">Explore por Tecnologia</h2>
            <p class="text-center text-gray-600 dark:text-gray-300 mb-12 text-lg">Navegue pelos nossos artigos organizados por linguagens e tecnologias</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <!-- Python -->
                <div class="tech-folder animate-slide-in" data-tech="python">
                    <div class="folder-icon">
                        <i class="fab fa-python"></i>
                    </div>
                    <div class="folder-content">
                        <h3>Python</h3>
                        <p>Machine Learning, Data Science, Web Development</p>
                        <div class="folder-stats">
                            <span class="stat">42 artigos</span>
                            <span class="stat">15k views</span>
                        </div>
                        <div class="folder-topics">
                            <span class="topic">Django</span>
                            <span class="topic">Flask</span>
                            <span class="topic">Pandas</span>
                        </div>
                    </div>
                </div>

                <!-- JavaScript -->
                <div class="tech-folder animate-slide-in" data-tech="javascript">
                    <div class="folder-icon">
                        <i class="fab fa-js-square"></i>
                    </div>
                    <div class="folder-content">
                        <h3>JavaScript</h3>
                        <p>Frontend, Backend, Full-Stack Development</p>
                        <div class="folder-stats">
                            <span class="stat">38 artigos</span>
                            <span class="stat">22k views</span>
                        </div>
                        <div class="folder-topics">
                            <span class="topic">React</span>
                            <span class="topic">Node.js</span>
                            <span class="topic">Vue.js</span>
                        </div>
                    </div>
                </div>

                <!-- PHP -->
                <div class="tech-folder animate-slide-in" data-tech="php">
                    <div class="folder-icon">
                        <i class="fab fa-php"></i>
                    </div>
                    <div class="folder-content">
                        <h3>PHP</h3>
                        <p>Web Development, CMS, Frameworks</p>
                        <div class="folder-stats">
                            <span class="stat">25 artigos</span>
                            <span class="stat">18k views</span>
                        </div>
                        <div class="folder-topics">
                            <span class="topic">Laravel</span>
                            <span class="topic">WordPress</span>
                            <span class="topic">CodeIgniter</span>
                        </div>
                    </div>
                </div>

                <!-- Java -->
                <div class="tech-folder animate-slide-in" data-tech="java">
                    <div class="folder-icon">
                        <i class="fab fa-java"></i>
                    </div>
                    <div class="folder-content">
                        <h3>Java</h3>
                        <p>Enterprise, Android, Spring Framework</p>
                        <div class="folder-stats">
                            <span class="stat">31 artigos</span>
                            <span class="stat">12k views</span>
                        </div>
                        <div class="folder-topics">
                            <span class="topic">Spring</span>
                            <span class="topic">Android</span>
                            <span class="topic">Maven</span>
                        </div>
                    </div>
                </div>

                <!-- C# -->
                <div class="tech-folder animate-slide-in" data-tech="csharp">
                    <div class="folder-icon">
                        <i class="fas fa-hashtag"></i>
                    </div>
                    <div class="folder-content">
                        <h3>C#</h3>
                        <p>.NET, Unity, Desktop Applications</p>
                        <div class="folder-stats">
                            <span class="stat">28 artigos</span>
                            <span class="stat">14k views</span>
                        </div>
                        <div class="folder-topics">
                            <span class="topic">.NET Core</span>
                            <span class="topic">Unity</span>
                            <span class="topic">ASP.NET</span>
                        </div>
                    </div>
                </div>

                <!-- Go -->
                <div class="tech-folder animate-slide-in" data-tech="go">
                    <div class="folder-icon">
                        <i class="fas fa-golang"></i>
                    </div>
                    <div class="folder-content">
                        <h3>Go</h3>
                        <p>Microservices, Cloud Native, Performance</p>
                        <div class="folder-stats">
                            <span class="stat">19 artigos</span>
                            <span class="stat">8k views</span>
                        </div>
                        <div class="folder-topics">
                            <span class="topic">Gin</span>
                            <span class="topic">Docker</span>
                            <span class="topic">Kubernetes</span>
                        </div>
                    </div>
                </div>

                <!-- Rust -->
                <div class="tech-folder animate-slide-in" data-tech="rust">
                    <div class="folder-icon">
                        <i class="fas fa-rust"></i>
                    </div>
                    <div class="folder-content">
                        <h3>Rust</h3>
                        <p>Systems Programming, WebAssembly, Performance</p>
                        <div class="folder-stats">
                            <span class="stat">15 artigos</span>
                            <span class="stat">6k views</span>
                        </div>
                        <div class="folder-topics">
                            <span class="topic">WebAssembly</span>
                            <span class="topic">Actix</span>
                            <span class="topic">Cargo</span>
                        </div>
                    </div>
                </div>

                <!-- TypeScript -->
                <div class="tech-folder animate-slide-in" data-tech="typescript">
                    <div class="folder-icon">
                        <i class="fas fa-ts"></i>
                    </div>
                    <div class="folder-content">
                        <h3>TypeScript</h3>
                        <p>Type Safety, Angular, Modern JavaScript</p>
                        <div class="folder-stats">
                            <span class="stat">22 artigos</span>
                            <span class="stat">16k views</span>
                        </div>
                        <div class="folder-topics">
                            <span class="topic">Angular</span>
                            <span class="topic">NestJS</span>
                            <span class="topic">Express</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter Melhorado -->
    <section class="newsletter-section">
        <div class="newsletter-content">
            <h2>Fique por dentro das novidades!</h2>
            <p>Receba os melhores artigos sobre tecnologia diretamente no seu email</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Seu melhor email" required>
                <button type="submit">Inscrever-se</button>
            </form>
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
                    <li><a href="#">Início</a></li>
                    <li><a href="#">Artigos</a></li>
                    <li><a href="#">Tutoriais</a></li>
                    <li><a href="#">Avaliações</a></li>
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
        <div class="footer-bottom">&copy; 2025 TechBlog. All rights reserved.</div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/blog.js"></script>
    <script src="/assets/js/unavailable.js"></script>
    
</body>
</html>
