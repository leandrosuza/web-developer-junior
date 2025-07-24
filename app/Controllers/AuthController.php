<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth/login');
    }

    public function login()
    {
        $email = $this->request->getPost('email');
        $senha = $this->request->getPost('senha');

        $user = User::where('email', $email)->first();
        if ($user && password_verify($senha, $user->senha)) {
            session()->set('user_id', $user->id);
            session()->set('user_nome', $user->nome);
            return redirect()->to('/admin/posts');
        } else {
            return redirect()->back()->with('error', 'E-mail ou senha inválidos.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
} 