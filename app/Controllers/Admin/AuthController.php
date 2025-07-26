<?php

namespace App\Controllers\Admin;

use App\Models\User;
use CodeIgniter\Controller;

/**
 * Authentication Controller
 * Handles admin and blog user authentication
 */
class AuthController extends Controller
{
    // ========================================
    // ADMIN AUTHENTICATION
    // ========================================
    
    /**
     * Display admin login form
     * Redirects to admin dashboard if already logged in
     */
    public function loginForm()
    {
        if (session('user_id')) {
            return redirect()->to('/admin/posts/blogManager');
        }
        return view('auth/login');
    }

    /**
     * Handle admin login authentication
     * Validates credentials and creates admin session
     */
    public function login()
    {
        $email = filter_var($this->request->getPost('email'), FILTER_SANITIZE_EMAIL);
        $password = $this->request->getPost('password');

        $user = User::where('email', $email)->first();
        if ($user && password_verify($password, $user->password)) {
            // Generate global session token
            $token = bin2hex(random_bytes(32));
            $user->session_token = $token;
            $user->save();
            
            session()->set('user_id', $user->id);
            session()->set('user_name', $user->name);
            session()->set('session_token', $token);
            session()->set('user_role', 'admin');
            
            return redirect()->to('/admin/posts/blogManager');
        } else {
            log_message('warning', 'Invalid login attempt for email: ' . $email);
            return redirect()->back()->with('error', 'Email or password is invalid.');
        }
    }

    /**
     * Handle admin logout
     * Clears session and forces page reload
     */
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
        
        // Force page reload after logout
        header('Location: /admin');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        exit;
    }

    // ========================================
    // BLOG USER AUTHENTICATION
    // ========================================
    
    /**
     * Display blog user authentication form
     * Redirects to blog if already logged in
     */
    public function userAuthForm()
    {
        // If already logged in as blog user, redirect to blog
        if (session('blog_user_id')) {
            return redirect()->to('/blog');
        }
        return view('auth/authUsers');
    }

    /**
     * Handle blog user login authentication
     * Validates credentials and creates blog user session
     */
    public function userLogin()
    {
        $email = filter_var($this->request->getPost('email'), FILTER_SANITIZE_EMAIL);
        $password = $this->request->getPost('password');
        $rememberMe = $this->request->getPost('remember_me');

        // Find blog user (role = 'user')
        $user = User::where('email', $email)
                   ->where('role', 'user')
                   ->first();

        if ($user && password_verify($password, $user->password)) {
            // Generate session token
            $token = bin2hex(random_bytes(32));
            $user->session_token = $token;
            $user->save();

            // Set blog user session
            session()->set('blog_user_id', $user->id);
            session()->set('blog_user_name', $user->name);
            session()->set('blog_user_email', $user->email);
            session()->set('blog_session_token', $token);
            session()->set('user_role', 'user');

            // If "remember me" is checked, save cookie
            if ($rememberMe) {
                $this->setRememberMeCookie($user->id);
            }

            log_message('info', 'Blog user logged in: ' . $email);
            
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Login successful!',
                    'redirect' => '/blog'
                ]);
            }
            
            return redirect()->to('/blog')->with('success', 'Login successful!');
        } else {
            log_message('warning', 'Invalid login attempt for blog user: ' . $email);
            
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid email or password.'
                ]);
            }
            
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }

    /**
     * Handle blog user registration
     * Validates input and creates new blog user account
     */
    public function userRegister()
    {
        $name = htmlspecialchars(strip_tags($this->request->getPost('name')), ENT_QUOTES, 'UTF-8');
        $email = filter_var($this->request->getPost('email'), FILTER_SANITIZE_EMAIL);
        $password = $this->request->getPost('password');
        $passwordConfirm = $this->request->getPost('password_confirm');
        $agreeTerms = $this->request->getPost('agree_terms');

        // Validations
        if (!$name || strlen($name) < 2) {
            return $this->validationError('Name must have at least 2 characters.');
        }

        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->validationError('Invalid email.');
        }

        if (strlen($password) < 6) {
            return $this->validationError('Password must have at least 6 characters.');
        }

        if ($password !== $passwordConfirm) {
            return $this->validationError('Passwords do not match.');
        }

        if (!$agreeTerms) {
            return $this->validationError('You must agree to the terms of use.');
        }

        // Check if email already exists
        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            return $this->validationError('This email is already registered.');
        }

        try {
            // Create new user
            $user = new User();
            $user->name = $name;
            $user->email = $email;
            $user->password = password_hash($password, PASSWORD_DEFAULT);
            $user->role = 'user'; // Regular blog user
            $user->status = 'active';
            $user->save();

            log_message('info', 'New blog user registered: ' . $email);

            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Account created successfully! Please login to continue.'
                ]);
            }

            return redirect()->to('/auth/users')->with('success', 'Account created successfully! Please login to continue.');

        } catch (\Exception $e) {
            log_message('error', 'Error registering user: ' . $e->getMessage());
            
            if ($this->request->isAJAX()) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Error creating account. Please try again.'
                ]);
            }
            
            return redirect()->back()->with('error', 'Error creating account. Please try again.');
        }
    }

    /**
     * Handle blog user logout
     * Clears session and removes remember me cookie
     */
    public function userLogout()
    {
        $userId = session('blog_user_id');
        if ($userId) {
            $user = User::find($userId);
            if ($user) {
                $user->session_token = null;
                $user->save();
            }
        }

        // Clear blog user session
        session()->remove('blog_user_id');
        session()->remove('blog_user_name');
        session()->remove('blog_user_email');
        session()->remove('blog_session_token');
        
        // Remove role if not admin
        if (session('user_role') === 'user') {
            session()->remove('user_role');
        }

        // Remove remember me cookie
        $this->removeRememberMeCookie();

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Logout successful!',
                'redirect' => '/blog'
            ]);
        }

        return redirect()->to('/blog')->with('success', 'Logout successful!');
    }

    // ========================================
    // HELPER METHODS
    // ========================================

    /**
     * Return validation error response
     * Handles both AJAX and regular requests
     */
    private function validationError($message)
    {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => false,
                'message' => $message
            ]);
        }
        
        return redirect()->back()->with('error', $message);
    }

    /**
     * Set remember me cookie for blog users
     * Creates secure token and saves to database
     */
    private function setRememberMeCookie($userId)
    {
        $token = bin2hex(random_bytes(32));
        $expires = time() + (30 * 24 * 60 * 60); // 30 days
        
        // Save token to database (you'll need to add remember_token column to users table)
        $user = User::find($userId);
        if ($user) {
            $user->remember_token = $token;
            $user->save();
        }
        
        // Set cookie
        setcookie('blog_remember_token', $token, $expires, '/', '', false, true);
    }

    /**
     * Remove remember me cookie
     * Clears token from database and removes cookie
     */
    private function removeRememberMeCookie()
    {
        if (isset($_COOKIE['blog_remember_token'])) {
            // Clear token in database
            $token = $_COOKIE['blog_remember_token'];
            $user = User::where('remember_token', $token)->first();
            if ($user) {
                $user->remember_token = null;
                $user->save();
            }
            
            // Remove cookie
            setcookie('blog_remember_token', '', time() - 3600, '/');
        }
    }

    /**
     * Check remember me cookie for automatic login
     * Returns true if user was automatically logged in
     */
    public function checkRememberMe()
    {
        if (isset($_COOKIE['blog_remember_token']) && !session('blog_user_id')) {
            $token = $_COOKIE['blog_remember_token'];
            $user = User::where('remember_token', $token)
                       ->where('role', 'user')
                       ->first();
            
            if ($user) {
                // Auto login
                session()->set('blog_user_id', $user->id);
                session()->set('blog_user_name', $user->name);
                session()->set('blog_user_email', $user->email);
                session()->set('user_role', 'user');
                
                return true;
            }
        }
        
        return false;
    }
} 