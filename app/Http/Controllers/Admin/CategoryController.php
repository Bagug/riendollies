<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:categories,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
        ]);

        $last = Category::latest('id_kategori')->first();

        $kode = 'KTG' . str_pad(($last?->id_kategori ?? 0) + 1, 3, '0', STR_PAD_LEFT);

        $colors = [
            '#3B82F6', // Blue
            '#8B5CF6', // Purple
            '#10B981', // Emerald
            '#F59E0B', // Amber
            '#EF4444', // Red
            '#06B6D4', // Cyan
            '#EC4899', // Pink
            '#6366F1', // Indigo
        ];

        $color = $colors[Category::count() % count($colors)];

        Category::create([
            'kode_kategori' => $kode,
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
            'color' => $color,
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Data kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:categories,nama_kategori,' . $category->id_kategori . ',id_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
        ]);

        $category->update([
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
        ]);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Data kategori berhasil diperbarui.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (
            $category->dekorasi()->exists() ||
            $category->weddingOrganizers()->exists() ||
            $category->makeups()->exists() ||
            $category->pakaians()->exists() ||
            $category->perawatans()->exists() ||
            $category->hiburans()->exists()
        ) {
            return redirect()
                ->route('admin.categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh data layanan.');
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Data kategori berhasil dihapus.');
    }
    //     public function destroy(Category $category)
    // {
    //     $category->delete();

    //     return redirect()
    //         ->route('categories.index')
    //         ->with('success', 'Kategori berhasil dihapus.');
    // }
}
