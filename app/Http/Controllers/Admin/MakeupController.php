<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Makeup;
use App\Models\MakeupImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MakeupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = Makeup::with('kategori', 'images');

    if ($request->filled('search')) {

        $query->where('nama_makeup', 'like', '%' . $request->search . '%');

    }

    $makeups = $query
                       ->paginate(5)
                       ->withQueryString();

    return view('admin.makeup.index', compact('makeups'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $categories = Category::all();

    return view('admin.makeup.create', compact('categories'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'id_kategori' => 'required',
        'nama_makeup' => 'required|unique:makeups,nama_makeup',
        'harga' => 'required|numeric',
        'status_ketersediaan' => 'required',
        'deskripsi' => 'required',
        'images' => 'required',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
    ], [

        'id_kategori.required' => 'Kategori wajib dipilih.',
        'nama_makeup.required' => 'Nama Make up wajib diisi.',
        'nama_makeup.unique' => 'Nama Make up sudah digunakan.',
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

    $last = Makeup::latest('id_makeup')->first();

    $kode = 'MKP' . str_pad(($last?->id_makeup ?? 0) + 1, 3, '0', STR_PAD_LEFT);
    
    $makeup = Makeup::create([

        'kode_makeup' => $kode,   
        'id_kategori' => $request->id_kategori,

        'nama_makeup' => $request->nama_makeup,

        'slug' => Str::slug($request->nama_makeup),

        'harga' => $request->harga,

        'status_ketersediaan' => $request->status_ketersediaan,

        'deskripsi' => $request->deskripsi,

    ]);

    foreach ($request->file('images') as $image) {

        $path = $image->store('makeup', 'public');

        MakeupImage::create([

            'id_makeup' => $makeup->id_makeup,

            'image' => $path,

        ]);
    }

});


    return redirect()
        ->route('admin.makeup.index')
        ->with('success', 'Data Makeup berhasil ditambahkan.');
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
    public function edit(Makeup $makeup)
{
    $makeup->load('images');

    $categories = Category::all();

    return view('admin.makeup.edit', compact('makeup', 'categories'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Makeup $makeup)
{
    $request->validate([
        'id_kategori' => 'required',
        'nama_makeup' => 'required|unique:makeups,nama_makeup,' . $makeup->id_makeup . ',id_makeup',
        'harga' => 'required|numeric',
        'status_ketersediaan' => 'required',
        'deskripsi' => 'required',
        'images' => 'nullable',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
    ],[
        'nama_makeup.required' => 'Nama Make up wajib diisi.',
        'nama_makeup.unique' => 'Nama Make up sudah digunakan.',
        'harga.required' => 'Harga wajib diisi.',
        'harga.numeric' => 'Harga harus berupa angka.',
        'deskripsi.required' => 'Deskripsi wajib diisi.',
        'images.*.image' => 'File harus berupa gambar.',
        'images.*.mimes' => 'Format gambar harus JPG, PNG, WEBP.',
        'images.*.max' => 'Ukuran gambar maksimal 5MB.',
    ]);
    
// Jika tidak upload gambar baru dan semua gambar lama sudah dihapus
        if (!$request->hasFile('images') && $makeup->images()->count() == 0) {
            return back()
                ->withErrors([
                    'images' => 'Minimal harus memiliki satu gambar.'
                ])
                ->withInput();
        }
    DB::transaction(function () use ($request, $makeup) {


        $makeup->update([
            'id_kategori' => $request->id_kategori,
            'nama_makeup' => $request->nama_makeup,
            'slug' => Str::slug($request->nama_makeup),
            'harga' => $request->harga,
            'status_ketersediaan' => $request->status_ketersediaan,
            'deskripsi' => $request->deskripsi,
        ]);

        // Jika admin upload foto baru
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('makeup', 'public');

                MakeupImage::create([
                    'id_makeup' => $makeup->id_makeup,
                    'image' => $path,
                ]);
            }

        }

    });

    return redirect()
        ->route('admin.makeup.index')
        ->with('success', 'Data Makeup berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Makeup $makeup)
{
    DB::transaction(function () use ($makeup) {


        // Hapus file gambar
        foreach ($makeup->images as $image) {

            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }

        }

        // Hapus data gambar
        $makeup->images()->delete();

        // Hapus Makeup
        $makeup->delete();

    });

    return redirect()
        ->route('admin.makeup.index')
        ->with('success', 'Data Make up berhasil dihapus.');
}
public function destroyImage($id)
{
    $image = MakeupImage::findOrFail($id);

    if (Storage::disk('public')->exists($image->image)) {
        Storage::disk('public')->delete($image->image);
    }

    $image->delete();

    return response()->json([
        'success' => true
    ]);
}
}
