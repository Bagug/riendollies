<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Perawatan;
use App\Models\PerawatanImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PerawatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Perawatan::with('kategori', 'images');

    if ($request->filled('search')) {

        $query->where('nama_perawatan', 'like', '%' . $request->search . '%');

    }

    $perawatans = $query
                       ->paginate(5)
                       ->withQueryString();

    return view('admin.perawatan.index', compact('perawatans'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $categories = Category::all();

    return view('admin.perawatan.create', compact('categories'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'id_kategori' => 'required',
        'nama_perawatan' => 'required|unique:perawatans,nama_perawatan',
        'harga' => 'required|numeric',
        'status_ketersediaan' => 'required',
        'deskripsi' => 'required',
        'images' => 'required',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
    ], [

        'id_kategori.required' => 'Kategori wajib dipilih.',
        'nama_perawatan.required' => 'Nama perawatan wajib diisi.',
        'nama_perawatan.unique' => 'Nama perawatan sudah digunakan.',
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

    $last = Perawatan::latest('id_perawatan')->first();

    $kode = 'PWT' . str_pad(($last?->id_perawatan ?? 0) + 1, 3, '0', STR_PAD_LEFT);
    
    $perawatan = Perawatan::create([

        'kode_perawatan' => $kode,   
        'id_kategori' => $request->id_kategori,

        'nama_perawatan' => $request->nama_perawatan,

        'slug' => Str::slug($request->nama_perawatan),

        'harga' => $request->harga,

        'status_ketersediaan' => $request->status_ketersediaan,

        'deskripsi' => $request->deskripsi,

    ]);

    foreach ($request->file('images') as $image) {

        $path = $image->store('perawatan', 'public');

        PerawatanImage::create([

            'id_perawatan' => $perawatan->id_perawatan,

            'image' => $path,

        ]);
    }

});


    return redirect()
        ->route('admin.perawatan.index')
        ->with('success', 'Data perawatan berhasil ditambahkan.');
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
   public function edit(Perawatan $perawatan)
{
     $perawatan->load('images');

        $categories = Category::all();

        return view('admin.perawatan.edit', compact('perawatan', 'categories'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Perawatan $perawatan)
{
    $request->validate([
        'id_kategori' => 'required',
        'nama_perawatan' => 'required|unique:perawatans,nama_perawatan,' . $perawatan->id_perawatan . ',id_perawatan',
        'harga' => 'required|numeric',
        'status_ketersediaan' => 'required',
        'deskripsi' => 'required',
        'images' => 'nullable',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
    ],[
        'id_kategori.required' => 'Kategori wajib dipilih.',
        'nama_perawatan.required' => 'Nama perawatan wajib diisi.',
        'nama_perawatan.unique' => 'Nama perawatan sudah digunakan.',
        'harga.required' => 'Harga wajib diisi.',
        'harga.numeric' => 'Harga harus berupa angka.',
        'deskripsi.required' => 'Deskripsi wajib diisi.',
        'images.*.image' => 'File harus berupa gambar.',
        'images.*.mimes' => 'Format gambar harus JPG, PNG, WEBP.',
        'images.*.max' => 'Ukuran gambar maksimal 5MB.',
    ]);

    if (!$request->hasFile('images') && $perawatan->images()->count() == 0) {
    return back()
        ->withErrors([
            'images' => 'Minimal harus memiliki satu gambar.'
        ])
        ->withInput();
}
    

    DB::transaction(function () use ($request, $perawatan) {

        $perawatan->update([
            'id_kategori' => $request->id_kategori,
            'nama_perawatan' => $request->nama_perawatan,
            'slug' => Str::slug($request->nama_perawatan),
            'harga' => $request->harga,
            'status_ketersediaan' => $request->status_ketersediaan,
            'deskripsi' => $request->deskripsi,
        ]);

        // Jika admin upload foto baru
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('perawatan', 'public');

                PerawatanImage::create([
                    'id_perawatan' => $perawatan->id_perawatan,
                    'image' => $path,
                ]);
            }

        }

    });

    return redirect()
        ->route('admin.perawatan.index')
        ->with('success', 'Data perawatan berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Perawatan $perawatan)
{
    DB::transaction(function () use ($perawatan) {

        // Hapus file gambar
        foreach ($perawatan->images as $image) {

            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }

        }

        // Hapus data gambar
        $perawatan->images()->delete();

        // Hapus perawatan
        $perawatan->delete();

    });

    return redirect()
        ->route('admin.perawatan.index')
        ->with('success', 'Data perawatan berhasil dihapus.');
}
public function destroyImage($id)
{
    $image = PerawatanImage::findOrFail($id);

    if (Storage::disk('public')->exists($image->image)) {
        Storage::disk('public')->delete($image->image);
    }

    $image->delete();

    return response()->json([
        'success' => true
    ]);
}
}
