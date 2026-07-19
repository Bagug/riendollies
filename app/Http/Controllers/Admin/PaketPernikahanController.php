<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\PaketPernikahan;
use App\Models\PaketPernikahanImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PaketPernikahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = PaketPernikahan::with('kategori', 'images');

    if ($request->filled('search')) {

        $query->where('nama_paket', 'like', '%' . $request->search . '%');

    }

    $paketPernikahans = $query
                       ->paginate(5)
                       ->withQueryString();

    return view('admin.paket-pernikahan.index', compact('paketPernikahans'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $categories = Category::all();

    return view('admin.paket-pernikahan.create', compact('categories'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'id_kategori' => 'required',
        'nama_paket' => 'required|unique:paket_pernikahans,nama_paket',
        'harga' => 'required|numeric',
        'status_ketersediaan' => 'required',
        'deskripsi' => 'required',
        'images' => 'required',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
    ], [

        'id_kategori.required' => 'Kategori wajib dipilih.',
        'nama_paket.required' => 'Nama paket wajib diisi.',
        'nama_paket.unique' => 'Nama paket sudah digunakan.',
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

    $last = PaketPernikahan::latest('id_paket')->first();

    $kode = 'PKT' . str_pad(($last?->id_paket ?? 0) + 1, 3, '0', STR_PAD_LEFT);
    
    $paketPernikahan = PaketPernikahan::create([

        'kode_paket' => $kode,   
        'id_kategori' => $request->id_kategori,

        'nama_paket' => $request->nama_paket,

        'slug' => Str::slug($request->nama_paket),

        'harga' => $request->harga,

        'status_ketersediaan' => $request->status_ketersediaan,

        'deskripsi' => $request->deskripsi,

    ]);

    foreach ($request->file('images') as $image) {

        $path = $image->store('paket', 'public');

        PaketPernikahanImage::create([

            'id_paket' => $paketPernikahan->id_paket,

            'image' => $path,

        ]);
    }

});


    return redirect()
        ->route('admin.paket-pernikahan.index')
        ->with('success', 'Data paket berhasil ditambahkan.');
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
    public function edit(PaketPernikahan $paketPernikahan)
{
   $paketPernikahan->load('images');

        $categories = Category::all();

        return view('admin.paket-pernikahan.edit', compact('paketPernikahan', 'categories'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaketPernikahan $paketPernikahan)
{
    $request->validate([
        'id_kategori' => 'required',
        'nama_paket' => 'required|unique:paket_pernikahans,nama_paket,' . $paketPernikahan->id_paket . ',id_paket',
        'harga' => 'required|numeric',
        'status_ketersediaan' => 'required',
        'deskripsi' => 'required',
        'images' => 'nullable',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
    ],[
        'id_kategori.required' => 'Kategori wajib dipilih.',
        'nama_paket.required' => 'Nama paket wajib diisi.',
        'nama_paket.unique' => 'Nama paket sudah digunakan.',
        'harga.required' => 'Harga wajib diisi.',
        'harga.numeric' => 'Harga harus berupa angka.',
        'deskripsi.required' => 'Deskripsi wajib diisi.',
        'images.*.image' => 'File harus berupa gambar.',
        'images.*.mimes' => 'Format gambar harus JPG, PNG, WEBP.',
        'images.*.max' => 'Ukuran gambar maksimal 5MB.',
    ]);
    
    if (!$request->hasFile('images') && $paketPernikahan->images()->count() == 0) {
    return back()
        ->withErrors([
            'images' => 'Minimal harus memiliki satu gambar.'
        ])
        ->withInput();
}

    DB::transaction(function () use ($request, $paketPernikahan) {

        $paketPernikahan->update([
            'id_kategori' => $request->id_kategori,
            'nama_paket' => $request->nama_paket,
            'slug' => Str::slug($request->nama_paket),
            'harga' => $request->harga,
            'status_ketersediaan' => $request->status_ketersediaan,
            'deskripsi' => $request->deskripsi,
        ]);

        // Jika admin upload foto baru
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('paket', 'public');

                PaketPernikahanImage::create([
                    'id_paket' => $paketPernikahan->id_paket,
                    'image' => $path,
                ]);
            }

        }

    });

    return redirect()
        ->route('admin.paket-pernikahan.index')
        ->with('success', 'Data paket berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(PaketPernikahan $paketPernikahan)
{
    DB::transaction(function () use ($paketPernikahan) {

        // Hapus file gambar
        foreach ($paketPernikahan->images as $image) {

            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }

        }

        // Hapus data gambar
        $paketPernikahan->images()->delete();

        // Hapus paket
        $paketPernikahan->delete();

    });

    return redirect()
        ->route('admin.paket-pernikahan.index')
        ->with('success', 'Data paket berhasil dihapus.');
}
public function destroyImage($id)
{
    $image = PaketPernikahanImage::findOrFail($id);

    if (Storage::disk('public')->exists($image->image)) {
        Storage::disk('public')->delete($image->image);
    }

    $image->delete();

    return response()->json([
        'success' => true
    ]);
}
}
