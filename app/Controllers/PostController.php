<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\User;
use CodeIgniter\Controller;

class PostController extends Controller
{
    private function requireLogin()
    {
        if (!session('user_id')) {
            return redirect()->to('/login')->send();
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
        return view('admin/posts/blogManager');
    }

    public function store()
    {
        $this->requireLogin();
        $data = [
            'nome' => $this->request->getPost('nome'),
            'descricao' => $this->request->getPost('descricao'),
            'user_id' => session('user_id'),
        ];
        // Upload da foto
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid()) {
            $nomeFoto = $foto->getRandomName();
            $foto->move('uploads', $nomeFoto);
            $data['foto'] = $nomeFoto;
        }
        Post::create($data);
        return redirect()->to('/admin/posts')->with('success', 'Post criado com sucesso!');
    }

    public function edit($id)
    {
        $this->requireLogin();
        $post = Post::findOrFail($id);
        return view('admin/posts/edit', ['post' => $post]);
    }

    public function update($id)
    {
        $this->requireLogin();
        $post = Post::findOrFail($id);
        $post->nome = $this->request->getPost('nome');
        $post->descricao = $this->request->getPost('descricao');
        // Upload da foto
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid()) {
            $nomeFoto = $foto->getRandomName();
            $foto->move('uploads', $nomeFoto);
            $post->foto = $nomeFoto;
        }
        $post->save();
        return redirect()->to('/admin/posts')->with('success', 'Post atualizado com sucesso!');
    }

    public function delete($id)
    {
        $this->requireLogin();
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->to('/admin/posts')->with('success', 'Post excluído com sucesso!');
    }
} 