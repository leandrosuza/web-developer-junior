<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function loginForm()
    {
        if (session('user_id')) {
            return redirect()->to('/admin/posts/blogManager');
        }
        return view('auth/login');
    }

    public function login()
    {
        $email = filter_var($this->request->getPost('email'), FILTER_SANITIZE_EMAIL);
        $password = $this->request->getPost('password');

        $user = User::where('email', $email)->first();
        if ($user && password_verify($password, $user->password)) {
            // Gerar token de sessão global
            $token = bin2hex(random_bytes(32));
            $user->session_token = $token;
            $user->save();
            session()->set('user_id', $user->id);
            session()->set('user_name', $user->name);
            session()->set('session_token', $token);
            return redirect()->to('/admin/posts/blogManager');
        } else {
            log_message('warning', 'Tentativa de login inválida para o e-mail: ' . $email);
            return redirect()->back()->with('error', 'Email or password is invalid.');
        }
    }

    public function logout()
    {
        $userId = session('user_id');
        if ($userId) {
            $user = User::find($userId);
            if ($user) {
                $user->session_token = null;
                $user->save();
            }
        }
        session()->destroy();
        // Forçar recarregamento da página após logout
        header('Location: /admin');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        exit;
    }
} 