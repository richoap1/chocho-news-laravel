<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;

class PostController extends Controller
{

    public function index()
    {


        $headlinePost = Post::with('category')
                            ->where('is_featured', true)
                            ->published()
                            ->latest()
                            ->first();


        if (!$headlinePost) {
            $headlinePost = Post::with('category')->published()->latest()->first();
        }
        

        $otherPosts = Post::with('category')->latest()->published()
                        ->when($headlinePost, function ($query) use ($headlinePost) {
                            return $query->where('id', '!=', $headlinePost->id);
                        })
                        ->paginate(10);

        $newsflash = Post::latest()->published()->take(5)->get();

        
        return view('home', compact('headlinePost', 'otherPosts', 'newsflash'));
    }

    public function show(Post $post)
    {
        $post->load('category');
        return view('post_detail', compact('post'));
    }

    public function category(Category $category)
    {
        // Laravel secara ajaib sudah mencarikan kategori berdasarkan slug di URL (Route Model Binding)
        
        // Ambil semua post yang dimiliki oleh kategori ini, urutkan dari yang terbaru, dan paginasi
        $posts = $category->posts()->latest()->published()->paginate(10);

        // Kirim data kategori dan daftar post ke view baru
        return view('category_posts', compact('category', 'posts'));
    }
}