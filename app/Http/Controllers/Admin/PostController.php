<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StorePostRequest; // <-- Gunakan Form Request
use App\Http\Requests\UpdatePostRequest; // <-- Gunakan Form Request

class PostController extends Controller
{
    /**
     * Menampilkan halaman daftar berita dengan DataTables.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Post::with('category')->latest();

            return DataTables::of($query)
                ->addColumn('category', function ($post) {
                    return $post->category ? $post->category->name : 'N/A';
                })
                ->editColumn('created_at', function ($post) {
                    return $post->created_at->format('d M Y H:i');
                })
                ->addColumn('action', function ($post) {
                    $editUrl = route('admin.posts.edit', $post->id);
                    $deleteUrl = route('admin.posts.destroy', $post->id);

                    // Tombol Edit
                    $editBtn = '<a href="' . $editUrl . '" class="btn btn-sm btn-primary me-1">Edit</a>';

                    // Tombol Hapus dengan form
                    $deleteBtn = '<form action="' . $deleteUrl . '" method="POST" style="display:inline-block;">' .
                                 csrf_field() .
                                 method_field('DELETE') .
                                 '<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Apakah Anda yakin ingin menghapus berita ini?\')">Hapus</button>' .
                                 '</form>';

                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.posts.index');
    }

    public function show(Post $post)
    {
        // Kode ini mengambil data post berdasarkan slug di URL
        // lalu mengirimkannya ke view 'post_detail'
        return view('post_detail', compact('post'));
    }

    /**
     * Menampilkan form untuk membuat berita baru.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Menyimpan berita baru ke database.
     */
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();
        $validated['is_featured'] = $request->has('is_featured');

        if (empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $validated['image'] = $path;
        }

        Post::create($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit berita.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Memperbarui data berita di database.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']) . '-' . time();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            // Simpan gambar baru
            $path = $request->file('image')->store('posts', 'public');
            $validated['image'] = $path;
        }

        $post->update($validated);

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Menghapus berita dari database.
     */
    public function destroy(Post $post)
    {
        // Hapus gambar dari storage sebelum menghapus record
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil dihapus!');
    }
}