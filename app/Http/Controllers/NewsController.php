<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        // Mengambil semua berita yang ada beserta kategorinya
        $news = News::with('category')->latest()->get();
        return view('admin.news.index', compact('news'));
    }

    public function userIndex()
    {
        $news = News::with('category')->latest()->paginate(9); // Pakai paginate kalau banyak
        return view('news.index', compact('news'));
    }

    public function create()
    {
        // Mengambil semua kategori untuk dipilih
        $categories = Category::all();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id', // Menambahkan kategori
            'image' => 'nullable|image|max:2048',
        ]);

        // Proses upload gambar
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news_images', 'public');
        }

        // Menambahkan ID pengguna
        $validated['user_id'] = Auth::id();

        // Menyimpan data berita ke dalam database
        News::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit(News $news)
    {
        // Mengambil semua kategori untuk dipilih
        $categories = Category::all();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        // Validasi input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id', // Menambahkan kategori
            'image' => 'nullable|image|max:2048',
        ]);

        // Proses upload gambar jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news_images', 'public');
        }

        // Update data berita
        $news->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy(News $news)
    {
        // Hapus gambar jika ada
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        // Hapus berita dari database
        $news->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus!');
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }
}