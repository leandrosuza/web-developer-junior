<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $q = $this->request->getGet('q');
        if ($q) {
            $posts = Post::orderBy('created_at', 'desc')->where('title', 'like', "%$q%")->get();
        } else {
            $posts = Post::orderBy('created_at', 'desc')->take(3)->get();
        }
        if ($this->request->isAJAX()) {
            ob_start();
            include(APPPATH . 'Views/blog/index.php');
            $html = ob_get_clean();
            // Extrai apenas o conteúdo do #postsGrid
            if (preg_match('/<div id="postsGrid"[^>]*>(.*?)<\/div>/is', $html, $matches)) {
                return $matches[1];
            }
            return '';
        }
        return view('blog/index', ['posts' => $posts, 'q' => $q]);
    }

    public function details($id)
    {
        $post = Post::find($id);
        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Notícia não encontrada');
        }
        $recentes = Post::where('id', '!=', $id)->orderBy('created_at', 'desc')->limit(3)->get();
        return view('blog/partials/_details', ['post' => $post, 'recentes' => $recentes]);
    }
} 