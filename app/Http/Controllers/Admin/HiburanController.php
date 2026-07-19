<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Hiburan;
use App\Models\HiburanImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HiburanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Hiburan::with('kategori', 'images');

    if ($request->filled('search')) {

        $query->where('nama_hiburan', 'like', '%' . $request->search . '%');

    }

    $hiburans = $query
                       ->paginate(5)
                       ->withQueryString();

    return view('admin.hiburan.index', compact('hiburans'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $categories = Category::all();

    return view('admin.hiburan.create', compact('categories'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'id_kategori' => 'required',
        'nama_hiburan' => 'required|unique:hiburans,nama_hiburan',
        'harga' => 'required|numeric',
        'status_ketersediaan' => 'required',
        'deskripsi' => 'required',
        'images' => 'required',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
    ], [

        'id_kategori.required' => 'Kategori wajib dipilih.',
        'nama_hiburan.required' => 'Nama hiburan wajib diisi.',
        'nama_hiburan.unique' => 'Nama hiburan sudah digunakan.',
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

    $last = Hiburan::latest('id_hiburan')->first();

    $kode = 'HBR' . str_pad(($last?->id_hiburan ?? 0) + 1, 3, '0', STR_PAD_LEFT);
    
    $hiburan = Hiburan::create([

        'kode_hiburan' => $kode,   
        'id_kategori' => $request->id_kategori,

        'nama_hiburan' => $request->nama_hiburan,

        'slug' => Str::slug($request->nama_hiburan),

        'harga' => $request->harga,

        'status_ketersediaan' => $request->status_ketersediaan,

        'deskripsi' => $request->deskripsi,

    ]);

    foreach ($request->file('images') as $image) {

        $path = $image->store('hiburan', 'public');

        HiburanImage::create([

            'id_hiburan' => $hiburan->id_hiburan,

            'image' => $path,

        ]);
    }

});


    return redirect()
        ->route('admin.hiburan.index')
        ->with('success', 'Data hiburan berhasil ditambahkan.');
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
    public function edit(Hiburan $hiburan)
{
   $hiburan->load('images');

        $categories = Category::all();

        return view('admin.hiburan.edit', compact('hiburan', 'categories'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hiburan $hiburan)
{
    $request->validate([
        'id_kategori' => 'required',
        'nama_hiburan' => 'required|unique:hiburans,nama_hiburan,' . $hiburan->id_hiburan . ',id_hiburan',
        'harga' => 'required|numeric',
        'status_ketersediaan' => 'required',
        'deskripsi' => 'required',
        'images' => 'nullable',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
    ],[
        'id_kategori.required' => 'Kategori wajib dipilih.',
        'nama_hiburan.required' => 'Nama hiburan wajib diisi.',
        'nama_hiburan.unique' => 'Nama hiburan sudah digunakan.',
        'harga.required' => 'Harga wajib diisi.',
        'harga.numeric' => 'Harga harus berupa angka.',
        'deskripsi.required' => 'Deskripsi wajib diisi.',
        'images.*.image' => 'File harus berupa gambar.',
        'images.*.mimes' => 'Format gambar harus JPG, PNG, WEBP.',
        'images.*.max' => 'Ukuran gambar maksimal 5MB.',
    ]);
    
    if (!$request->hasFile('images') && $hiburan->images()->count() == 0) {
    return back()
        ->withErrors([
            'images' => 'Minimal harus memiliki satu gambar.'
        ])
        ->withInput();
}

    DB::transaction(function () use ($request, $hiburan) {

        $hiburan->update([
            'id_kategori' => $request->id_kategori,
            'nama_hiburan' => $request->nama_hiburan,
            'slug' => Str::slug($request->nama_hiburan),
            'harga' => $request->harga,
            'status_ketersediaan' => $request->status_ketersediaan,
            'deskripsi' => $request->deskripsi,
        ]);

        // Jika admin upload foto baru
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('hiburan', 'public');

                HiburanImage::create([
                    'id_hiburan' => $hiburan->id_hiburan,
                    'image' => $path,
                ]);
            }

        }

    });

    return redirect()
        ->route('admin.hiburan.index')
        ->with('success', 'Data hiburan berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Hiburan $hiburan)
{
    DB::transaction(function () use ($hiburan) {

        // Hapus file gambar
        foreach ($hiburan->images as $image) {

            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }

        }

        // Hapus data gambar
        $hiburan->images()->delete();

        // Hapus hiburan
        $hiburan->delete();

    });

    return redirect()
        ->route('admin.hiburan.index')
        ->with('success', 'Data hiburan berhasil dihapus.');
}
public function destroyImage($id)
{
    $image = HiburanImage::findOrFail($id);

    if (Storage::disk('public')->exists($image->image)) {
        Storage::disk('public')->delete($image->image);
    }

    $image->delete();

    return response()->json([
        'success' => true
    ]);
}
}
