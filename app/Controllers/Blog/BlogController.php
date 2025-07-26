<?php

namespace App\Controllers\Blog;

use CodeIgniter\Controller;
use App\Models\Post;
use App\Models\User;

/**
 * Blog Controller
 * Handles public blog functionality and user data
 */
class BlogController extends Controller
{
    /**
     * Constructor - Check remember me for blog users
     * Automatically logs in users with valid remember me cookie
     */
    public function __construct()
    {
        // Check "remember me" for blog users
        $authController = new \App\Controllers\Admin\AuthController();
        $authController->checkRememberMe();
    }

    // ========================================
    // BLOG PAGES
    // ========================================

    /**
     * Display blog home page
     * Shows posts with search functionality and user data
     */
    public function index()
    {
        $q = $this->request->getGet('q');
        if ($q) {
            $posts = Post::orderBy('created_at', 'desc')->where('title', 'like', "%$q%")->get();
        } else {
            $posts = Post::orderBy('created_at', 'desc')->take(3)->get();
        }
        
        // Logged in user data (if any)
        $userData = $this->getUserData();
        
        if ($this->request->isAJAX()) {
            ob_start();
            include(APPPATH . 'Views/blog/index.php');
            $html = ob_get_clean();
            
            // Extract only #postsGrid content
            if (preg_match('/<div id="postsGrid"[^>]*>(.*?)<\/div>/is', $html, $matches)) {
                return $matches[1];
            }
            return '';
        }
        
        return view('blog/index', [
            'posts' => $posts, 
            'q' => $q,
            'userData' => $userData
        ]);
    }

    /**
     * Display individual post details
     * Shows post content and related posts
     */
    public function details($id)
    {
        $post = Post::find($id);
        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Post not found');
        }
        
        $recentes = Post::where('id', '!=', $id)->orderBy('created_at', 'desc')->limit(3)->get();
        $userData = $this->getUserData();
        
        return view('blog/partials/_details', [
            'post' => $post, 
            'recentes' => $recentes,
            'userData' => $userData
        ]);
    }

    // ========================================
    // HELPER METHODS
    // ========================================

    /**
     * Get current user data for views
     * Returns authentication status and user information
     */
    private function getUserData()
    {
        $userData = [
            'isLoggedIn' => false,
            'isAdmin' => false,
            'user' => [
                'id' => null,
                'name' => 'Usuário',
                'email' => null,
                'role' => null
            ]
        ];

        // Check if admin
        if (session('user_id') && session('user_role') === 'admin') {
            $userData['isLoggedIn'] = true;
            $userData['isAdmin'] = true;
            $userData['user'] = [
                'id' => session('user_id'),
                'name' => session('user_name') ?: 'Administrador',
                'email' => null, // Admin doesn't have email in session
                'role' => 'admin'
            ];
        }
        // Check if blog user
        elseif (session('blog_user_id') && session('user_role') === 'user') {
            $userData['isLoggedIn'] = true;
            $userData['isAdmin'] = false;
            $userData['user'] = [
                'id' => session('blog_user_id'),
                'name' => session('blog_user_name') ?: 'Usuário',
                'email' => session('blog_user_email'),
                'role' => 'user'
            ];
        }

        return $userData;
    }

    /**
     * Check if blog user is logged in
     * Returns boolean authentication status
     */
    public function isUserLoggedIn()
    {
        return session('blog_user_id') !== null;
    }

    /**
     * Check if admin is logged in
     * Returns boolean authentication status
     */
    public function isAdminLoggedIn()
    {
        return session('user_id') !== null && session('user_role') === 'admin';
    }
} 