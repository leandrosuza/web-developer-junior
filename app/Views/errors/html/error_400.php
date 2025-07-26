<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Requisição inválida - 400</title>
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
            <a href="/blog" class="flex items-center gap-2">
                <span class="w-10 h-10 rounded-full bg-gradient-to-r from-primary-600 to-secondary-600 flex items-center justify-center text-white"><i class="fas fa-blog text-lg"></i></span>
                <span class="text-2xl font-bold gradient-text">TechBlog</span>
            </a>
        </div>
    </nav>
    <main class="flex flex-col items-center justify-center min-h-screen pt-32 pb-16 px-4">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-10 flex flex-col items-center max-w-lg w-full">
            <div class="mb-6">
                <i class="fas fa-exclamation-circle text-6xl text-red-400"></i>
            </div>
            <h1 class="text-4xl font-bold mb-2 text-primary-700 dark:text-primary-400">400 - Requisição inválida</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 mb-6">A requisição enviada não pôde ser processada.<br>Verifique os dados e tente novamente ou volte para a página inicial.</p>
            <a href="/blog" class="btn-back px-6 py-3 text-lg font-semibold">Voltar para o início</a>
        </div>
    </main>
    <footer>
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
                            <li><a href="/blog">Início</a></li>
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
              <div class="footer-bottom">&copy; 2025 TechBlog. All rights reserved.</div>
    </footer>
</body>
</html>
