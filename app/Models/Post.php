<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    // Pastikan properti ini ada, untuk mengizinkan mass assignment
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
        // Ini penting agar kolom tanggal diperlakukan sebagai objek Carbon
    protected $casts = [
        'published_at' => 'datetime',
        'is_featured' => 'boolean', // <-- Tambahkan ini
    ];

    /**
     * Mendefinisikan relasi ke model Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // ==========================================================
    // INI BAGIAN YANG PERLU ANDA TAMBAHKAN
    // ==========================================================
    /**
     * Scope sebuah query untuk hanya menyertakan post yang sudah dipublikasikan.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }
}