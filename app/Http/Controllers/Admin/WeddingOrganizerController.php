<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\WeddingOrganizer;
use App\Models\WeddingOrganizerImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WeddingOrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = WeddingOrganizer::with('kategori', 'images');

    if ($request->filled('search')) {

        $query->where('nama_wo', 'like', '%' . $request->search . '%');

    }

    $weddingOrganizers = $query
                       ->paginate(5)
                       ->withQueryString();

    return view('admin.wedding-organizer.index', compact('weddingOrganizers'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $categories = Category::all();

    return view('admin.wedding-organizer.create', compact('categories'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'id_kategori' => 'required',
        'nama_wo' => 'required|unique:wedding_organizers,nama_wo',
        'harga' => 'required|numeric',
        'status_ketersediaan' => 'required',
        'deskripsi' => 'required',
        'images' => 'required',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
    ], [

        'id_kategori.required' => 'Kategori wajib dipilih.',
        'nama_wo.required' => 'Nama Wedding Organizer wajib diisi.',
        'nama_wo.unique' => 'Nama Wedding Organizer sudah digunakan.',
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

    $last = WeddingOrganizer::latest('id_wo')->first();

    $kode = 'WO' . str_pad(($last?->id_wo ?? 0) + 1, 3, '0', STR_PAD_LEFT);
    $weddingOrganizer = WeddingOrganizer::create([
        'kode_wo' => $kode  ,
        'id_kategori' => $request->id_kategori,

        'nama_wo' => $request->nama_wo,

        'slug' => Str::slug($request->nama_wo),

        'harga' => $request->harga,

        'status_ketersediaan' => $request->status_ketersediaan,

        'deskripsi' => $request->deskripsi,

    ]);

    foreach ($request->file('images') as $image) {

        $path = $image->store('wedding-organizer', 'public');

        WeddingOrganizerImage::create([

            'id_wo' => $weddingOrganizer->id_wo,

            'image' => $path,

        ]);
    }

});


    return redirect()
        ->route('admin.wedding-organizer.index')
        ->with('success', 'Data Wedding Organizer berhasil ditambahkan.');
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
    public function edit(WeddingOrganizer $weddingOrganizer)
{
     $weddingOrganizer->load('images');

        $categories = Category::all();

        return view('admin.wedding-organizer.edit', compact('weddingOrganizer', 'categories'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WeddingOrganizer $weddingOrganizer)
{
    $request->validate([
        'id_kategori' => 'required',
        'nama_wo' => 'required|unique:wedding_organizers,nama_wo,' . $weddingOrganizer->id_wo . ',id_wo',
        'harga' => 'required|numeric',
        'status_ketersediaan' => 'required',
        'deskripsi' => 'required',
        'images' => 'nullable',
        'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
    ],[
        'id_kategori.required' => 'Kategori wajib dipilih.',
        'nama_wo.required' => 'Nama Wedding Organizer wajib diisi.',
        'nama_wo.unique' => 'Nama Wedding Organizer sudah digunakan.',
        'harga.required' => 'Harga wajib diisi.',
        'harga.numeric' => 'Harga harus berupa angka.',
        'deskripsi.required' => 'Deskripsi wajib diisi.',
        'images.*.image' => 'File harus berupa gambar.',
        'images.*.mimes' => 'Format gambar harus JPG, PNG, WEBP.',
        'images.*.max' => 'Ukuran gambar maksimal 5MB.',
    ]);

    // Jika tidak upload gambar baru dan semua gambar lama sudah dihapus
        if (!$request->hasFile('images') && $weddingOrganizer->images()->count() == 0) {
            return back()
                ->withErrors([
                    'images' => 'Minimal harus memiliki satu gambar.'
                ])
                ->withInput();
        }
    

    DB::transaction(function () use ($request, $weddingOrganizer) {

        $weddingOrganizer->update([
            'id_kategori' => $request->id_kategori,
            'nama_wo' => $request->nama_wo,
            'slug' => Str::slug($request->nama_wo),
            'harga' => $request->harga,
            'status_ketersediaan' => $request->status_ketersediaan,
            'deskripsi' => $request->deskripsi,
        ]);

        // Jika admin upload foto baru
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $image) {

                $path = $image->store('wedding-organizer', 'public');

                WeddingOrganizerImage::create([
                    'id_wo' => $weddingOrganizer->id_wo,
                    'image' => $path,
                ]);
            }

        }

    });

    return redirect()
        ->route('admin.wedding-organizer.index')
        ->with('success', 'Data WeddingOrganizer berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(WeddingOrganizer $weddingOrganizer)
{
    DB::transaction(function () use ($weddingOrganizer) {

        $weddingOrganizer->load('images');

        // Hapus file gambar
        foreach ($weddingOrganizer->images as $image) {

            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }

        }

        // Hapus data gambar
        $weddingOrganizer->images()->delete();

        // Hapus WeddingOrganizer
        $weddingOrganizer->delete();

    });

    return redirect()
        ->route('admin.wedding-organizer.index')
        ->with('success', 'Data WeddingOrganizer berhasil dihapus.');
}
public function destroyImage($id)
{
    $image = WeddingOrganizerImage::findOrFail($id);

    if (Storage::disk('public')->exists($image->image)) {
        Storage::disk('public')->delete($image->image);
    }

    $image->delete();

    return response()->json([
        'success' => true
    ]);
}
}
