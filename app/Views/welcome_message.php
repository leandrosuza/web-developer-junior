<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechVision - Seu Blog de Tecnologia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-text {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .hero-pattern {
            background-image: radial-gradient(circle at 10% 20%, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0) 20%), radial-gradient(circle at 90% 80%, rgba(139, 92, 246, 0.1) 0%, rgba(139, 92, 246, 0) 20%);
        }
    </style>
</head>
<body class="bg-light font-sans antialiased">
    <!-- Header/Navbar -->
    <header class="bg-white shadow-sm sticky-top">
        <div class="container py-3 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-laptop-code fs-2 text-primary"></i>
                <a href="#" class="fs-2 fw-bold gradient-text text-decoration-none">TechVision</a>
            </div>
            <nav class="d-none d-md-flex gap-4">
                <a href="#" class="text-secondary text-decoration-none fw-medium">Início</a>
                <a href="#" class="text-secondary text-decoration-none fw-medium">Artigos</a>
                <a href="#" class="text-secondary text-decoration-none fw-medium">Tutoriais</a>
                <a href="#" class="text-secondary text-decoration-none fw-medium">Reviews</a>
                <a href="#" class="text-secondary text-decoration-none fw-medium">Sobre</a>
            </nav>
            <div class="d-flex align-items-center gap-3">
                <button class="d-md-none btn btn-link text-secondary p-0 border-0"><i class="fas fa-bars fs-4"></i></button>
                <button class="d-none d-md-block btn btn-primary rounded-pill px-4 py-2 fw-medium"><i class="fas fa-user-plus me-2"></i>Assinar</button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-pattern">
        <div class="container mx-auto px-4 py-16 md:py-24">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Explore o mundo da <span class="gradient-text">tecnologia</span></h1>
                <p class="text-xl text-gray-600 mb-8">As últimas notícias, tendências e análises sobre tecnologia, programação, inteligência artificial e muito mais.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <input type="text" placeholder="Buscar artigos..." class="flex-grow max-w-md px-4 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-full font-medium transition">
                        <i class="fas fa-search mr-2"></i>Buscar
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Articles -->
    <section class="bg-white py-12">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Artigos em Destaque</h2>
                <a href="#" class="text-blue-500 hover:text-blue-700 font-medium flex items-center">
                    Ver todos <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Article 1 -->
                <div class="article-card bg-white rounded-xl overflow-hidden shadow-md transition duration-300">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://source.unsplash.com/random/600x400/?ai" alt="Inteligência Artificial" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4 bg-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            IA
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span>15 de Junho, 2023</span>
                            <span class="mx-2">•</span>
                            <span>8 min de leitura</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">O futuro da IA: O que esperar nos próximos 5 anos</h3>
                        <p class="text-gray-600 mb-4">Exploramos as tendências emergentes em inteligência artificial e como elas podem transformar indústrias inteiras.</p>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden mr-3">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Autor" class="w-full h-full object-cover">
                            </div>
                            <span class="text-sm font-medium text-gray-700">Ana Silva</span>
                        </div>
                    </div>
                </div>
                
                <!-- Article 2 -->
                <div class="article-card bg-white rounded-xl overflow-hidden shadow-md transition duration-300">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://source.unsplash.com/random/600x400/?programming" alt="Programação" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4 bg-purple-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Dev
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span>10 de Junho, 2023</span>
                            <span class="mx-2">•</span>
                            <span>6 min de leitura</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">React vs Vue vs Angular: Qual framework escolher em 2023?</h3>
                        <p class="text-gray-600 mb-4">Uma análise comparativa dos três principais frameworks JavaScript para desenvolvimento front-end.</p>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden mr-3">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Autor" class="w-full h-full object-cover">
                            </div>
                            <span class="text-sm font-medium text-gray-700">Carlos Oliveira</span>
                        </div>
                    </div>
                </div>
                
                <!-- Article 3 -->
                <div class="article-card bg-white rounded-xl overflow-hidden shadow-md transition duration-300">
                    <div class="relative h-48 overflow-hidden">
                        <img src="https://source.unsplash.com/random/600x400/?cybersecurity" alt="Segurança" class="w-full h-full object-cover">
                        <div class="absolute top-4 right-4 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Segurança
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span>5 de Junho, 2023</span>
                            <span class="mx-2">•</span>
                            <span>10 min de leitura</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Protegendo seus dados: Guia completo de segurança digital</h3>
                        <p class="text-gray-600 mb-4">As melhores práticas para manter seus dados seguros em um mundo cada vez mais conectado.</p>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden mr-3">
                                <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Autor" class="w-full h-full object-cover">
                            </div>
                            <span class="text-sm font-medium text-gray-700">Mariana Costa</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8 text-center">Explore por Categorias</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <a href="#" class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition flex flex-col items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-microchip text-blue-500 text-xl"></i>
                    </div>
                    <span class="font-medium text-gray-700">Hardware</span>
                </a>
                
                <a href="#" class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition flex flex-col items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-code text-purple-500 text-xl"></i>
                    </div>
                    <span class="font-medium text-gray-700">Programação</span>
                </a>
                
                <a href="#" class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition flex flex-col items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-brain text-green-500 text-xl"></i>
                    </div>
                    <span class="font-medium text-gray-700">Inteligência Artificial</span>
                </a>
                
                <a href="#" class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition flex flex-col items-center">
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-shield-alt text-red-500 text-xl"></i>
                    </div>
                    <span class="font-medium text-gray-700">Segurança</span>
                </a>
                
                <a href="#" class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition flex flex-col items-center">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-mobile-alt text-yellow-500 text-xl"></i>
                    </div>
                    <span class="font-medium text-gray-700">Mobile</span>
                </a>
                
                <a href="#" class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition flex flex-col items-center">
                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mb-3">
                        <i class="fas fa-cloud text-indigo-500 text-xl"></i>
                    </div>
                    <span class="font-medium text-gray-700">Cloud Computing</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Latest Articles -->
    <section class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Últimos Artigos</h2>
                <a href="#" class="text-blue-500 hover:text-blue-700 font-medium flex items-center">
                    Ver todos <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Article 1 -->
                <div class="flex flex-col md:flex-row gap-6 bg-gray-50 rounded-xl p-4 hover:shadow-md transition">
                    <div class="md:w-1/3 h-48 overflow-hidden rounded-lg">
                        <img src="https://source.unsplash.com/random/400x300/?blockchain" alt="Blockchain" class="w-full h-full object-cover">
                    </div>
                    <div class="md:w-2/3">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span>3 de Junho, 2023</span>
                            <span class="mx-2">•</span>
                            <span>5 min de leitura</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Blockchain além das criptomoedas: Casos de uso inovadores</h3>
                        <p class="text-gray-600 mb-4">Descubra como a tecnologia blockchain está sendo aplicada em setores como saúde, logística e governo.</p>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden mr-3">
                                <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Autor" class="w-full h-full object-cover">
                            </div>
                            <span class="text-sm font-medium text-gray-700">Ricardo Santos</span>
                        </div>
                    </div>
                </div>
                
                <!-- Article 2 -->
                <div class="flex flex-col md:flex-row gap-6 bg-gray-50 rounded-xl p-4 hover:shadow-md transition">
                    <div class="md:w-1/3 h-48 overflow-hidden rounded-lg">
                        <img src="https://source.unsplash.com/random/400x300/?quantum" alt="Computação Quântica" class="w-full h-full object-cover">
                    </div>
                    <div class="md:w-2/3">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span>28 de Maio, 2023</span>
                            <span class="mx-2">•</span>
                            <span>7 min de leitura</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Computação quântica: O que os desenvolvedores precisam saber</h3>
                        <p class="text-gray-600 mb-4">Uma introdução aos conceitos fundamentais da computação quântica e como ela pode revolucionar a computação.</p>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden mr-3">
                                <img src="https://randomuser.me/api/portraits/women/33.jpg" alt="Autor" class="w-full h-full object-cover">
                            </div>
                            <span class="text-sm font-medium text-gray-700">Fernanda Lima</span>
                        </div>
                    </div>
                </div>
                
                <!-- Article 3 -->
                <div class="flex flex-col md:flex-row gap-6 bg-gray-50 rounded-xl p-4 hover:shadow-md transition">
                    <div class="md:w-1/3 h-48 overflow-hidden rounded-lg">
                        <img src="https://source.unsplash.com/random/400x300/?iot" alt="IoT" class="w-full h-full object-cover">
                    </div>
                    <div class="md:w-2/3">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span>22 de Maio, 2023</span>
                            <span class="mx-2">•</span>
                            <span>4 min de leitura</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">IoT na agricultura: Como a tecnologia está transformando o campo</h3>
                        <p class="text-gray-600 mb-4">Casos reais de como sensores e dispositivos conectados estão aumentando a eficiência na agricultura.</p>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden mr-3">
                                <img src="https://randomuser.me/api/portraits/men/44.jpg" alt="Autor" class="w-full h-full object-cover">
                            </div>
                            <span class="text-sm font-medium text-gray-700">Gustavo Almeida</span>
                        </div>
                    </div>
                </div>
                
                <!-- Article 4 -->
                <div class="flex flex-col md:flex-row gap-6 bg-gray-50 rounded-xl p-4 hover:shadow-md transition">
                    <div class="md:w-1/3 h-48 overflow-hidden rounded-lg">
                        <img src="https://source.unsplash.com/random/400x300/?vr" alt="Realidade Virtual" class="w-full h-full object-cover">
                    </div>
                    <div class="md:w-2/3">
                        <div class="flex items-center text-sm text-gray-500 mb-2">
                            <span>18 de Maio, 2023</span>
                            <span class="mx-2">•</span>
                            <span>6 min de leitura</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-3">O futuro do trabalho remoto com realidade virtual e aumentada</h3>
                        <p class="text-gray-600 mb-4">Como as tecnologias imersivas estão criando novas possibilidades para colaboração e produtividade.</p>
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden mr-3">
                                <img src="https://randomuser.me/api/portraits/women/52.jpg" alt="Autor" class="w-full h-full object-cover">
                            </div>
                            <span class="text-sm font-medium text-gray-700">Patrícia Rocha</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-gradient-to-r from-blue-500 to-purple-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-2xl mx-auto">
                <i class="fas fa-envelope-open-text text-4xl mb-6"></i>
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Assine nossa newsletter</h2>
                <p class="text-lg mb-6 opacity-90">Receba as últimas notícias e artigos sobre tecnologia diretamente no seu e-mail.</p>
                <div class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto">
                    <input type="email" placeholder="Seu melhor e-mail" class="flex-grow px-4 py-3 rounded-full bg-white bg-opacity-20 placeholder-white placeholder-opacity-70 focus:outline-none focus:ring-2 focus:ring-white">
                    <button class="bg-white text-blue-600 hover:bg-gray-100 px-6 py-3 rounded-full font-medium transition">
                        Assinar <i class="fas fa-paper-plane ml-2"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-laptop-code text-2xl text-blue-400"></i>
                        <span class="text-2xl font-bold text-white">TechVision</span>
                    </div>
                    <p class="mb-4">O blog definitivo para entusiastas e profissionais de tecnologia.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-linkedin text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-github text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-white font-medium text-lg mb-4">Categorias</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Programação</a></li>
                        <li><a href="#" class="hover:text-white transition">Inteligência Artificial</a></li>
                        <li><a href="#" class="hover:text-white transition">Segurança Digital</a></li>
                        <li><a href="#" class="hover:text-white transition">Hardware</a></li>
                        <li><a href="#" class="hover:text-white transition">Cloud Computing</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-white font-medium text-lg mb-4">Links Úteis</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="hover:text-white transition">Sobre Nós</a></li>
                        <li><a href="#" class="hover:text-white transition">Contato</a></li>
                        <li><a href="#" class="hover:text-white transition">Política de Privacidade</a></li>
                        <li><a href="#" class="hover:text-white transition">Termos de Uso</a></li>
                        <li><a href="#" class="hover:text-white transition">Trabalhe Conosco</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-white font-medium text-lg mb-4">Contato</h3>
                    <ul class="space-y-2">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-blue-400"></i>
                            <span>Av. Paulista, 1000<br>São Paulo - SP</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-blue-400"></i>
                            <span>contato@techvision.com</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone-alt mr-3 text-blue-400"></i>
                            <span>(11) 1234-5678</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-500">
                <p>&copy; 2023 TechVision. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-6 right-6 bg-blue-500 text-white w-12 h-12 rounded-full shadow-lg flex items-center justify-center opacity-0 invisible transition-all duration-300">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Back to Top Button com jQuery
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 300) {
                $('#backToTop').removeClass('opacity-0 invisible').addClass('opacity-100 visible');
            } else {
                $('#backToTop').removeClass('opacity-100 visible').addClass('opacity-0 invisible');
            }
        });
        $('#backToTop').on('click', function() {
            $('html, body').animate({scrollTop: 0}, 'slow');
        });
        // Menu mobile exemplo com jQuery
        $('.d-md-none').on('click', function() {
            alert('Menu mobile seria implementado aqui!');
        });
    </script>
</body>
</html>