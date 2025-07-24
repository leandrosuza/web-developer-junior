<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use CodeIgniter\Controller;

class AdminPostController extends Controller
{
    private function requireLogin()
    {
        $userId = session('user_id');
        $sessionToken = session('session_token');
        if (!$userId || !$sessionToken) {
            echo view('errors/html/access_denied');
            exit;
        }
        $user = \App\Models\User::find($userId);
        if (!$user || $user->session_token !== $sessionToken) {
            session()->destroy();
            echo view('errors/html/access_denied');
            exit;
        }
    }

    public function index()
    {
        $this->requireLogin();
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin/posts/index', ['posts' => $posts]);
    }

    public function create()
    {
        $this->requireLogin();
        $posts = \App\Models\Post::orderBy('created_at', 'desc')->get();
        $recentPosts = \App\Models\Post::orderBy('created_at', 'desc')->limit(3)->get();
        return view('admin/posts/blogManager', [
            'posts' => $posts,
            'recentPosts' => $recentPosts
        ]);
    }

    public function store()
    {
        $this->requireLogin();

        // Simple validation
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $userId = session('user_id');

        if (!$title || !$description || !$userId) {
            return $this->response->setJSON(['success' => false, 'message' => 'Required fields are missing.'])->setStatusCode(400);
        }

        $data = [
            'title' => $title,
            'description' => $description,
            'user_id' => $userId,
        ];

        // Image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid()) {
            $fileName = $image->getRandomName();
            $path = 'uploads/posts';
            $image->move($path, $fileName);
            $data['image'] = $path . '/' . $fileName;
        }

        try {
            $post = \App\Models\Post::create($data);
            return $this->response->setJSON(['success' => true, 'message' => 'Post created successfully!', 'post' => $post]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Error saving: ' . $e->getMessage()])->setStatusCode(500);
        }
    }

    public function edit($id)
    {
        $this->requireLogin();
        $post = \App\Models\Post::find($id);
        if (!$post) {
            return $this->response->setJSON(['error' => 'Post não encontrado'])->setStatusCode(404);
        }
        return $this->response->setJSON(['post' => [
            'id' => $post->id,
            'title' => $post->title,
            'description' => $post->description,
            // Adicione outros campos se necessário
        ]]);
    }

    public function update($id)
    {
        $this->requireLogin();
        $post = \App\Models\Post::find($id);
        if (!$post) {
            return $this->response->setJSON(['success' => false, 'message' => 'Post não encontrado'])->setStatusCode(404);
        }
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        if (!$title || !$description) {
            return $this->response->setJSON(['success' => false, 'message' => 'Campos obrigatórios ausentes.'])->setStatusCode(400);
        }
        $post->title = $title;
        $post->description = $description;
        // Upload da imagem (opcional)
        $image = $this->request->getFile('image');
        if ($image && $image->isValid()) {
            $fileName = $image->getRandomName();
            $path = 'uploads/posts';
            $image->move($path, $fileName);
            $post->image = $path . '/' . $fileName;
        }
        $post->save();
        return $this->response->setJSON(['success' => true, 'message' => 'Post atualizado com sucesso!']);
    }

    public function delete($id)
    {
        $this->requireLogin();
        $post = \App\Models\Post::find($id);
        if (!$post) {
            return $this->response->setJSON(['success' => false, 'message' => 'Post não encontrado'])->setStatusCode(404);
        }
        // Apagar imagem do upload se existir
        if (!empty($post->image) && file_exists($post->image)) {
            @unlink($post->image);
        } elseif (!empty($post->image) && file_exists(FCPATH . $post->image)) {
            @unlink(FCPATH . $post->image);
        }
        $post->delete();
        return $this->response->setJSON(['success' => true, 'message' => 'Post excluído com sucesso!']);
    }

    public function search()
    {
        $this->requireLogin();
        $query = $this->request->getGet('q');
        $dateStart = $this->request->getGet('date_start');
        $dateEnd = $this->request->getGet('date_end');

        $posts = \App\Models\Post::query();
        if ($query) {
            $posts->where(function($q) use ($query) {
                $q->where('title', 'like', "%$query%")
                  ->orWhere('description', 'like', "%$query%") ;
            });
        }
        if ($dateStart) {
            $posts->where('created_at', '>=', $dateStart . ' 00:00:00');
        }
        if ($dateEnd) {
            $posts->where('created_at', '<=', $dateEnd . ' 23:59:59');
        }
        $result = $posts->orderBy('created_at', 'desc')->get();
        return $this->response->setJSON(['posts' => $result]);
    }

    public function dashboard()
    {
        $this->requireLogin();
        $recentPosts = \App\Models\Post::orderBy('created_at', 'desc')->limit(3)->get();
        return view('admin/posts/partials/_dashboard', ['recentPosts' => $recentPosts]);
    }
} 