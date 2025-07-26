<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = true;
    
    protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role',
        'status',
        'session_token',
        'remember_token'
    ];
    
    protected $hidden = [
        'password',
        'session_token',
        'remember_token'
    ];

    // ========================================
    // RELATIONSHIPS
    // ========================================
    
    public function posts()
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    // ========================================
    // SCOPES
    // ========================================
    
    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }
    
    public function scopeUsers($query)
    {
        return $query->where('role', 'user');
    }
    
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // ========================================
    // HELPER METHODS
    // ========================================
    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    public function isUser()
    {
        return $this->role === 'user';
    }
    
    public function isActive()
    {
        return $this->status === 'active';
    }
    
    public function getDisplayName()
    {
        return $this->name ?: $this->email;
    }
    
    public function getInitials()
    {
        $words = explode(' ', $this->name);
        $initials = '';
        
        foreach ($words as $word) {
            if (!empty($word)) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
        }
        
        return substr($initials, 0, 2);
    }
} 