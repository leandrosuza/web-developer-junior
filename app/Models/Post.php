<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'title', 'image', 'description', 'user_id',
    ];

    // ========================================
    // RELATIONSHIPS
    // ========================================
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // ========================================
    // SCOPES
    // ========================================
    
    public function scopePublished($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeRecent($query, $limit = 10)
    {
        return $query->orderBy('created_at', 'desc')->limit($limit);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where('title', 'like', "%{$term}%")
                    ->orWhere('description', 'like', "%{$term}%");
    }

    // ========================================
    // ACCESSORS
    // ========================================
    
    public function getFormattedDateAttribute()
    {
        return date('d/m/Y H:i', strtotime($this->created_at));
    }

    public function getExcerptAttribute()
    {
        return substr(strip_tags($this->description), 0, 150) . '...';
    }

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return 'https://via.placeholder.com/900x400/667eea/ffffff?text=Sem+Imagem';
        }
        return '/' . $this->image;
    }

    // ========================================
    // HELPER METHODS
    // ========================================
    
    public function getAuthorName()
    {
        return $this->user ? $this->user->name : 'Autor Desconhecido';
    }

    public function getReadingTime()
    {
        $words = str_word_count(strip_tags($this->description));
        $minutes = ceil($words / 200); // 200 words per minute
        return $minutes . ' min de leitura';
    }
} 