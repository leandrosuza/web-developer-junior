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
                <span class="w-10 h-10 rounded-lg bg-gradient-to-r from-primary-600 to-secondary-600 flex items-center justify-center text-white"><i class="fas fa-blog text-lg"></i></span>
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
    <button id="darkModeToggle" class="fixed bottom-6 right-6 z-50 w-12 h-12 rounded-full bg-primary-600 dark:bg-primary-800 text-white shadow-lg flex items-center justify-center hover:bg-primary-700 dark:hover:bg-primary-700 transition-colors duration-300">
        <i class="fas fa-moon dark:hidden"></i>
        <i class="fas fa-sun hidden dark:block"></i>
    </button>
    <!-- Hero -->
    <section class="hero-bg pt-28 pb-16 md:pb-24">
        <div class="max-w-3xl mx-auto text-center animate-fade-in">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Explore o mundo da <span class="gradient-text">tecnologia</span></h1>
            <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 mb-8">As últimas notícias, tendências e análises sobre tecnologia, programação, inteligência artificial e muito mais.</p>
            <form class="max-w-lg mx-auto">
                <div class="flex shadow-lg rounded-lg overflow-hidden">
                    <input type="text" placeholder="Buscar artigos..." class="flex-grow px-4 py-3 focus:outline-none dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:placeholder-gray-400">
                    <button type="submit" class="bg-primary-600 hover:bg-primary-700 text-white px-6 flex items-center justify-center transition-colors">
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
                <h2 class="text-2xl font-bold mb-4 md:mb-0">Artigos em Destaque</h2>
                <a href="#" class="text-primary-600 dark:text-primary-400 font-medium hover:underline flex items-center">Ver todos <i class="fas fa-arrow-right ml-2"></i></a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 animate-fade-in">
                <!-- Card 1 -->
                <div class="card-glass rounded-xl overflow-hidden shadow-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    <img src="https://source.unsplash.com/random/600x400/?ai" alt="Inteligência Artificial" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="inline-block text-xs font-medium px-2.5 py-0.5 rounded-full bg-indigo-100 text-indigo-800 mb-2">Inteligência Artificial</span>
                        <h3 class="text-xl font-bold mb-2">O futuro da IA: O que esperar nos próximos 5 anos</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">Exploramos as tendências emergentes em inteligência artificial e como elas podem transformar indústrias inteiras.</p>
                        <div class="flex items-center gap-3">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Ana Silva" class="w-8 h-8 rounded-full">
                            <span class="text-sm font-medium">Ana Silva</span>
                            <span class="text-xs text-gray-400">15 de Junho, 2023</span>
                            <span class="text-xs text-gray-400">8 min de leitura</span>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="card-glass rounded-xl overflow-hidden shadow-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    <img src="https://source.unsplash.com/random/600x400/?programming" alt="Programação" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="inline-block text-xs font-medium px-2.5 py-0.5 rounded-full bg-green-100 text-green-800 mb-2">Programação</span>
                        <h3 class="text-xl font-bold mb-2">React vs Vue vs Angular: Qual framework escolher em 2023?</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">Uma análise comparativa dos três principais frameworks JavaScript para desenvolvimento front-end.</p>
                        <div class="flex items-center gap-3">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="João Pedro" class="w-8 h-8 rounded-full">
                            <span class="text-sm font-medium">João Pedro</span>
                            <span class="text-xs text-gray-400">10 de Junho, 2023</span>
                            <span class="text-xs text-gray-400">6 min de leitura</span>
                        </div>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="card-glass rounded-xl overflow-hidden shadow-lg border border-gray-200 dark:border-gray-700 transition-all duration-300 hover:shadow-2xl hover:-translate-y-1">
                    <img src="https://source.unsplash.com/random/600x400/?webdev" alt="Web Development" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="inline-block text-xs font-medium px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800 mb-2">Web Development</span>
                        <h3 class="text-xl font-bold mb-2">Como criar um portfólio de desenvolvedor impressionante</h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">Dicas práticas para destacar suas habilidades e conquistar oportunidades no mercado de tecnologia.</p>
                        <div class="flex items-center gap-3">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Carlos Souza" class="w-8 h-8 rounded-full">
                            <span class="text-sm font-medium">Carlos Souza</span>
                            <span class="text-xs text-gray-400">8 de Junho, 2023</span>
                            <span class="text-xs text-gray-400">5 min de leitura</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="bg-gradient-to-r from-primary-700 to-secondary-700 text-white py-10 mt-16">
        <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row justify-between items-center gap-8">
            <div class="mb-6 md:mb-0">
                <h4 class="text-2xl font-bold mb-2">TechBlog</h4>
                <p class="text-gray-200">O melhor blog sobre tecnologia, programação e inovação.</p>
            </div>
            <div class="flex flex-col md:flex-row gap-6">
                <div>
                    <h5 class="font-semibold mb-2">Links</h5>
                    <ul class="space-y-1">
                        <li><a href="#" class="hover:underline">Home</a></li>
                        <li><a href="#" class="hover:underline">Artigos</a></li>
                        <li><a href="#" class="hover:underline">Tutoriais</a></li>
                        <li><a href="#" class="hover:underline">Reviews</a></li>
                        <li><a href="#" class="hover:underline">Sobre</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-semibold mb-2">Categorias</h5>
                    <ul class="space-y-1">
                        <li><a href="#" class="hover:underline">Inteligência Artificial</a></li>
                        <li><a href="#" class="hover:underline">Programação</a></li>
                        <li><a href="#" class="hover:underline">Web Development</a></li>
                        <li><a href="#" class="hover:underline">Carreira</a></li>
                    </ul>
                </div>
            </div>
            <div class="flex gap-4">
                <a href="#" class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/40 transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/40 transition"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/40 transition"><i class="fab fa-instagram"></i></a>
                <a href="#" class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center hover:bg-white/40 transition"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        <div class="text-center text-gray-200 mt-8">&copy; 2023 TechBlog. Todos os direitos reservados.</div>
    </footer>
    <script src="/assets/js/blog.js"></script>
    <script src="/assets/js/unavailable.js"></script>
</body>
</html>