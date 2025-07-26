<?php

namespace App\Controllers\Admin;

use App\Models\Post;
use App\Models\User;
use CodeIgniter\Controller;

/**
 * Admin Post Controller
 * Handles post management for administrators
 */
class PostController extends Controller
{
    // ========================================
    // AUTHENTICATION
    // ========================================

    /**
     * Require admin authentication
     * Redirects to access denied if not authenticated
     */
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

    // ========================================
    // POST MANAGEMENT
    // ========================================

    /**
     * Display posts list page
     * Shows all posts for admin management
     */
    public function index()
    {
        $this->requireLogin();
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin/posts/index', ['posts' => $posts]);
    }

    /**
     * Display post creation/management page
     * Shows blog manager interface with recent posts
     */
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

    /**
     * Store new post
     * Handles post creation with image upload
     */
    public function store()
    {
        $this->requireLogin();

        // Simple validation
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        $userId = session('user_id');

        if (!$title || !$description || !$userId) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Required fields are missing.'
            ])->setStatusCode(400);
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
            return $this->response->setJSON([
                'success' => true, 
                'message' => 'Post created successfully!', 
                'post' => $post
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Error saving: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    /**
     * Get post data for editing
     * Returns post information as JSON
     */
    public function edit($id)
    {
        $this->requireLogin();
        $post = \App\Models\Post::find($id);
        
        if (!$post) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Post not found'
            ])->setStatusCode(404);
        }
        
        return $this->response->setJSON([
            'success' => true,
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'description' => $post->description,
                'image' => $post->image,
                'created_at' => $post->created_at,
                'updated_at' => $post->updated_at
            ]
        ]);
    }

    /**
     * Update existing post
     * Handles post updates with optional image upload
     */
    public function update($id)
    {
        $this->requireLogin();
        $post = \App\Models\Post::find($id);
        
        if (!$post) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Post not found'
            ])->setStatusCode(404);
        }
        
        $title = $this->request->getPost('title');
        $description = $this->request->getPost('description');
        
        if (!$title || !$description) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Required fields are missing.'
            ])->setStatusCode(400);
        }
        
        $post->title = $title;
        $post->description = $description;
        
        // Image upload (optional)
        $image = $this->request->getFile('image');
        if ($image && $image->isValid()) {
            $fileName = $image->getRandomName();
            $path = 'uploads/posts';
            $image->move($path, $fileName);
            $post->image = $path . '/' . $fileName;
        }
        
        $post->save();
        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Post updated successfully!'
        ]);
    }

    /**
     * Delete post
     * Removes post and associated image file
     */
    public function delete($id)
    {
        $this->requireLogin();
        $post = \App\Models\Post::find($id);
        
        if (!$post) {
            return $this->response->setJSON([
                'success' => false, 
                'message' => 'Post not found'
            ])->setStatusCode(404);
        }
        
        // Delete image file if exists
        if (!empty($post->image) && file_exists($post->image)) {
            @unlink($post->image);
        } elseif (!empty($post->image) && file_exists(FCPATH . $post->image)) {
            @unlink(FCPATH . $post->image);
        }
        
        $post->delete();
        return $this->response->setJSON([
            'success' => true, 
            'message' => 'Post deleted successfully!'
        ]);
    }

    // ========================================
    // SEARCH AND DASHBOARD
    // ========================================

    /**
     * Search posts
     * Handles advanced search with filters
     */
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
                  ->orWhere('description', 'like', "%$query%");
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

    /**
     * Get dashboard data
     * Returns recent posts for dashboard
     */
    public function dashboard()
    {
        $this->requireLogin();
        $recentPosts = \App\Models\Post::orderBy('created_at', 'desc')->limit(3)->get();
        return view('admin/posts/partials/_dashboard', ['recentPosts' => $recentPosts]);
    }
} 