<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dekorasi;
use App\Models\DekorasiImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DekorasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Dekorasi::with('kategori', 'images');

        if ($request->filled('search')) {

            $query->where('nama_dekorasi', 'like', '%' . $request->search . '%');
        }

        $dekorasis = $query
            ->paginate(5)
            ->withQueryString();

        return view('admin.dekorasi.index', compact('dekorasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.dekorasi.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama_dekorasi' => 'required|unique:dekorasis,nama_dekorasi',
            'harga' => 'required|numeric',
            'status_ketersediaan' => 'required',
            'deskripsi' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [

            'id_kategori.required' => 'Kategori wajib dipilih.',
            'nama_dekorasi.required' => 'Nama dekorasi wajib diisi.',
            'nama_dekorasi.unique' => 'Nama dekorasi sudah digunakan.',
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

            $last = Dekorasi::latest('id_dekorasi')->first();

            $kode = 'DKR' . str_pad(($last?->id_dekorasi ?? 0) + 1, 3, '0', STR_PAD_LEFT);

            $dekorasi = Dekorasi::create([

                'kode_dekorasi' => $kode,
                'id_kategori' => $request->id_kategori,

                'nama_dekorasi' => $request->nama_dekorasi,

                'slug' => Str::slug($request->nama_dekorasi),

                'harga' => $request->harga,

                'status_ketersediaan' => $request->status_ketersediaan,

                'deskripsi' => $request->deskripsi,

            ]);

            foreach ($request->file('images') as $image) {

                $path = $image->store('dekorasi', 'public');

                DekorasiImage::create([

                    'id_dekorasi' => $dekorasi->id_dekorasi,

                    'image' => $path,

                ]);
            }
        });


        return redirect()
            ->route('admin.dekorasi.index')
            ->with('success', 'Data dekorasi berhasil ditambahkan.');
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
    public function edit(Dekorasi $dekorasi)
    {
        $dekorasi->load('images');

        $categories = Category::all();

        return view('admin.dekorasi.edit', compact('dekorasi', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Dekorasi $dekorasi)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama_dekorasi' => 'required|unique:dekorasis,nama_dekorasi,' . $dekorasi->id_dekorasi . ',id_dekorasi',
            'harga' => 'required|numeric',
            'status_ketersediaan' => 'required',
            'deskripsi' => 'required',
            'images' => 'nullable',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'id_kategori.required' => 'Kategori wajib dipilih.',
            'nama_dekorasi.required' => 'Nama dekorasi wajib diisi.',
            'nama_dekorasi.unique' => 'Nama dekorasi sudah digunakan.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'images.*.image' => 'File harus berupa gambar.',
            'images.*.mimes' => 'Format gambar harus JPG, PNG, WEBP.',
            'images.*.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        // Jika tidak upload gambar baru dan semua gambar lama sudah dihapus
        if (!$request->hasFile('images') && $dekorasi->images()->count() == 0) {
            return back()
                ->withErrors([
                    'images' => 'Minimal harus memiliki satu gambar.'
                ])
                ->withInput();
        }

        DB::transaction(function () use ($request, $dekorasi) {

            $dekorasi->update([
                'id_kategori' => $request->id_kategori,
                'nama_dekorasi' => $request->nama_dekorasi,
                'slug' => Str::slug($request->nama_dekorasi),
                'harga' => $request->harga,
                'status_ketersediaan' => $request->status_ketersediaan,
                'deskripsi' => $request->deskripsi,
            ]);

            // Jika admin upload foto baru
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {

                    $path = $image->store('dekorasi', 'public');

                    DekorasiImage::create([
                        'id_dekorasi' => $dekorasi->id_dekorasi,
                        'image' => $path,
                    ]);
                }
            }
        });

        return redirect()
            ->route('admin.dekorasi.index')
            ->with('success', 'Data dekorasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dekorasi $dekorasi)
    {
        DB::transaction(function () use ($dekorasi) {

            // Hapus file gambar
            foreach ($dekorasi->images as $image) {

                if (Storage::disk('public')->exists($image->image)) {
                    Storage::disk('public')->delete($image->image);
                }
            }

            // Hapus data gambar
            $dekorasi->images()->delete();

            // Hapus dekorasi
            $dekorasi->delete();
        });

        return redirect()
            ->route('admin.dekorasi.index')
            ->with('success', 'Data dekorasi berhasil dihapus.');
    }
    public function destroyImage($id)
    {
        $image = DekorasiImage::findOrFail($id);

        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
