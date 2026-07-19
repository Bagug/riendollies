<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Photographer;
use App\Models\PhotographerImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotographerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Photographer::with('kategori', 'images');

    if ($request->filled('search')) {

        $query->where('nama_photographer', 'like', '%' . $request->search . '%');

    }

    $photographers = $query
                       ->paginate(5)
                       ->withQueryString();

    return view('admin.photographer.index', compact('photographers'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $categories = Category::all();

    return view('admin.photographer.create', compact('categories'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'id_kategori' => 'required',
        'nama_photographer' => 'required|unique:photographers,nama_photographer',
        'harga' => 'required|numeric',
        'status_ketersediaan' => 'required',
        'deskripsi' => 'required',
        'images' => 'required',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
    ], [

        'id_kategori.required' => 'Kategori wajib dipilih.',
        'nama_photographer.required' => 'Nama photographer wajib diisi.',
        'nama_photographer.unique' => 'Nama photographer sudah digunakan.',
        'harga.required' => 'Harga wajib diisi.',
        'harga.numeric' => 'Harga harus berupa angka.',
        'status_ketersediaan.required' => 'Status wajib dipilih.',
        'deskripsi.required' => 'Deskripsi wajib diisi.',
        'images.required' => 'Minimal satu gambar harus dipilih.',
        'images.*.image' => 'File harus berupa gambar.',
        'images.*.mimes' => 'Format gambar harus JPG, PNG, atau WEBP.',
        'images.*.max' => 'Ukuran gambar maksimal 5MB.',

    ]);

    

   DB::transaction(function () use ($request) {

    $last = Photographer::latest('id_photographer')->first();

    $kode = 'FG' . str_pad(($last?->id_photographer ?? 0) + 1, 3, '0', STR_PAD_LEFT);
    
    $photographer = Photographer::create([

        'kode_photographer' => $kode,   
        'id_kategori' => $request->id_kategori,

        'nama_photographer' => $request->nama_photographer,

        'slug' => Str::slug($request->nama_photographer),

        'harga' => $request->harga,

        'status_ketersediaan' => $request->status_ketersediaan,

        'deskripsi' => $request->deskripsi,

    ]);

    foreach ($request->file('images') as $image) {

        $path = $image->store('photographer', 'public');

        PhotographerImage::create([

            'id_photographer' => $photographer->id_photographer,

            'image' => $path,

        ]);
    }

});


    return redirect()
        ->route('admin.photographer.index')
        ->with('success', 'Data photographer berhasil ditambahkan.');
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
    public function edit(Photographer $photographer)
{
   $photographer->load('images');

        $categories = Category::all();

        return view('admin.photographer.edit', compact('photographer', 'categories'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photographer $photographer)
{
    $request->validate([
        'id_kategori' => 'required',
        'nama_photographer' => 'required|unique:photographers,nama_photographer,' . $photographer->id_photographer . ',id_photographer',
        'harga' => 'required|numeric',
        'status_ketersediaan' => 'required',
        'deskripsi' => 'required',
        'images' => 'nullable',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
    ],[
        'id_kategori.required' => 'Kategori wajib dipilih.',
        'nama_photographer.required' => 'Nama photographer wajib diisi.',
        'nama_photographer.unique' => 'Nama photographer sudah digunakan.',
        'harga.required' => 'Harga wajib diisi.',
        'harga.numeric' => 'Harga harus berupa angka.',
        'deskripsi.required' => 'Deskripsi wajib diisi.',
        'images.*.image' => 'File harus berupa gambar.',
        'images.*.mimes' => 'Format gambar harus JPG, PNG, WEBP.',
        'images.*.max' => 'Ukuran gambar maksimal 5MB.',
    ]);
    
    if (!$request->hasFile('images') && $photographer->images()->count() == 0) {
    return back()
        ->withErrors([
            'images' => 'Minimal harus memiliki satu gambar.'
        ])
        ->withInput();
}

    DB::transaction(function () use ($request, $photographer) {

        $photographer->update([
            'id_kategori' => $request->id_kategori,
            'nama_photographer' => $request->nama_photographer,
            'slug' => Str::slug($request->nama_photographer),
            'harga' => $request->harga,
            'status_ketersediaan' => $request->status_ketersediaan,
            'deskripsi' => $request->deskripsi,
        ]);

        // Jika admin upload foto baru
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('photographer', 'public');

                PhotographerImage::create([
                    'id_photographer' => $photographer->id_photographer,
                    'image' => $path,
                ]);
            }

        }

    });

    return redirect()
        ->route('admin.photographer.index')
        ->with('success', 'Data photographer berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Photographer $photographer)
{
    DB::transaction(function () use ($photographer) {

        // Hapus file gambar
        foreach ($photographer->images as $image) {

            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }

        }

        // Hapus data gambar
        $photographer->images()->delete();

        // Hapus photographer
        $photographer->delete();

    });

    return redirect()
        ->route('admin.photographer.index')
        ->with('success', 'Data photographer berhasil dihapus.');
}
public function destroyImage($id)
{
    $image = PhotographerImage::findOrFail($id);

    if (Storage::disk('public')->exists($image->image)) {
        Storage::disk('public')->delete($image->image);
    }

    $image->delete();

    return response()->json([
        'success' => true
    ]);
}
}
