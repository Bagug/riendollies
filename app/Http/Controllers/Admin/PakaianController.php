<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Pakaian;
use App\Models\PakaianImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pakaian::with('kategori', 'images');

        if ($request->filled('search')) {

            $query->where('nama_pakaian', 'like', '%' . $request->search . '%');
        }

        $pakaians = $query
            ->paginate(5)
            ->withQueryString();

        return view('admin.pakaian.index', compact('pakaians'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.pakaian.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama_pakaian' => 'required|unique:pakaians,nama_pakaian',
            'ukuran' => 'required',
            'jumlah_item' => 'required|integer|min:1',
            'harga' => 'required|numeric',
            'status_ketersediaan' => 'required',
            'deskripsi' => 'required',
            'images' => 'required',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [

            'id_kategori.required' => 'Kategori wajib dipilih.',
            'nama_pakaian.required' => 'Nama Pakaian wajib diisi.',
            'nama_pakaian.unique' => 'Nama Pakaian sudah digunakan.',
            'ukuran.required' => 'Ukuran wajib diisi.',
            'jumlah_item.required' => 'Jumlah Item wajib diisi.',
            'jumlah_item.integer' => 'Jumlah Item harus berupa angka.',
            'jumlah_item.min' => 'Jumlah Item minimal 1.',
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

            $last = Pakaian::latest('id_pakaian')->first();

            $kode = 'PKN' . str_pad(($last?->id_pakaian ?? 0) + 1, 3, '0', STR_PAD_LEFT);

            $pakaian = Pakaian::create([

                'kode_pakaian' => $kode,
                'id_kategori' => $request->id_kategori,

                'nama_pakaian' => $request->nama_pakaian,

                'ukuran' => $request->ukuran,

                'jumlah_item' => $request->jumlah_item,

                'slug' => Str::slug($request->nama_pakaian),

                'harga' => $request->harga,

                'status_ketersediaan' => $request->status_ketersediaan,

                'deskripsi' => $request->deskripsi,

            ]);

            foreach ($request->file('images') as $image) {

                $path = $image->store('pakaian', 'public');

                PakaianImage::create([

                    'id_pakaian' => $pakaian->id_pakaian,

                    'image' => $path,

                ]);
            }
        });


        return redirect()
            ->route('admin.pakaian.index')
            ->with('success', 'Data Pakaian berhasil ditambahkan.');
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
    public function edit(Pakaian $pakaian)
    {
        $pakaian->load('images');

        $categories = Category::all();

        return view('admin.pakaian.edit', compact('pakaian', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pakaian $pakaian)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nama_pakaian' => 'required|unique:pakaians,nama_pakaian,' . $pakaian->id_pakaian . ',id_pakaian',
            'ukuran' => 'required',
            'jumlah_item' => 'required|integer|min:1',
            'harga' => 'required|numeric',
            'status_ketersediaan' => 'required',
            'deskripsi' => 'required',
            'images' => 'nullable',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'id_kategori.required' => 'Kategori wajib dipilih.',
            'nama_pakaian.required' => 'Nama Pakaian wajib diisi.',
            'nama_pakaian.unique' => 'Nama Pakaian sudah digunakan.',
            'ukuran.required' => 'Ukuran wajib diisi.',
            'jumlah_item.required' => 'Jumlah Item wajib diisi.',
            'jumlah_item.integer' => 'Jumlah Item harus berupa angka.',
            'jumlah_item.min' => 'Jumlah Item minimal 1.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'deskripsi.required' => 'Deskripsi wajib diisi.',
            'images.*.image' => 'File harus berupa gambar.',
            'images.*.mimes' => 'Format gambar harus JPG, PNG, WEBP.',
            'images.*.max' => 'Ukuran gambar maksimal 5MB.',
        ]);

        if (!$request->hasFile('images') && $pakaian->images()->count() == 0) {
            return back()
                ->withErrors([
                    'images' => 'Minimal harus memiliki satu gambar.'
                ])
                ->withInput();
        }

        DB::transaction(function () use ($request, $pakaian) {

            $pakaian->update([
                'id_kategori' => $request->id_kategori,
                'nama_pakaian' => $request->nama_pakaian,
                'ukuran' => $request->ukuran,
                'jumlah_item' => $request->jumlah_item,
                'slug' => Str::slug($request->nama_pakaian),
                'harga' => $request->harga,
                'status_ketersediaan' => $request->status_ketersediaan,
                'deskripsi' => $request->deskripsi,
            ]);


            // Jika admin upload foto baru
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {

                    $path = $image->store('pakaian', 'public');

                    PakaianImage::create([
                        'id_pakaian' => $pakaian->id_pakaian,
                        'image' => $path,
                    ]);
                }
            }
        });

        return redirect()
            ->route('admin.pakaian.index')
            ->with('success', 'Data Pakaian berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pakaian $pakaian)
    {
        DB::transaction(function () use ($pakaian) {

            // Hapus file gambar
            foreach ($pakaian->images as $image) {

                if (Storage::disk('public')->exists($image->image)) {
                    Storage::disk('public')->delete($image->image);
                }
            }

            // Hapus data gambar
            $pakaian->images()->delete();

            // Hapus Pakaian
            $pakaian->delete();
        });

        return redirect()
            ->route('admin.pakaian.index')
            ->with('success', 'Data Pakaian berhasil dihapus.');
    }
    public function destroyImage($id)
    {
        $image = PakaianImage::findOrFail($id);

        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
