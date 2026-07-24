<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DekorasiController as AdminDekorasiController;
use App\Http\Controllers\Admin\HiburanController;
use App\Http\Controllers\Admin\LaporanPembayaranController;
use App\Http\Controllers\Admin\LaporanPenyewaanController;
use App\Http\Controllers\Admin\MakeupController;
use App\Http\Controllers\Admin\PakaianController;
use App\Http\Controllers\Admin\PaketPernikahanController;
use App\Http\Controllers\Admin\PenyewaanController as AdminPenyewaanController;
use App\Http\Controllers\Admin\PerawatanController;
use App\Http\Controllers\Admin\PhotographerController;
use App\Http\Controllers\Admin\WeddingOrganizerController;
use App\Http\Controllers\Pelanggan\AuthController as PelangganAuthController;
use App\Http\Controllers\Pelanggan\DekorasiController as PelangganDekorasiController;
use App\Http\Controllers\Pelanggan\PembayaranController;
use App\Http\Controllers\Pelanggan\PenyewaanController as PelangganPenyewaanController;
use App\Http\Controllers\Pelanggan\PesananController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home', [
        'title' => 'Home'
    ]);
})->name('home');

Route::get('/about', function () {
    return view('about', [
        'title' => 'About'
    ]);
});

// Route::get('/posts', function () {

//     return view('posts', ['title' => 'Blog', 'posts' => Post::filter(request(['search', 'category', 'author']))->latest()->get()]);
// });

// route::get('/posts/{post:slug}', function (post $post) {

//     return view('post', [
//         'title' => 'Single Post',
//         'post' => $post
//     ]);
// });

route::get('/authors/{user:username}', function (User $user) {
    // $posts = $user->posts->load('category', 'author');

    return view('posts', [
        'title' => count($user->posts) . ' Articles by ' . $user->name,
        'posts' => $user->posts
    ]);
});



route::get('/categories/{category:slug}', function (Category $category) {
    // $posts = $category->posts->load('author', 'category');

    return view('posts', [
        'title' => 'Articles in ' . $category->name,
        'posts' => $category->posts
    ]);
});

Route::get('/contact', function () {
    return view('contact', [
        'title' => 'Contact'
    ]);
});

Route::get('/admin', [DashboardController::class, 'index'])
    ->name('admin.dashboard');


Route::get('/layanan', function () {
    return view('layanan', [
        'title' => 'Layanan'
    ]);
});


//admin

//admin

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::post('/logout-admin', [AdminAuthController::class, 'logout'])
            ->name('logout');

        Route::resource('categories', CategoryController::class);

        Route::resource('dekorasi', AdminDekorasiController::class);

        Route::delete(
            'dekorasi/image/{id}',
            [AdminDekorasiController::class, 'destroyImage']
        )->name('dekorasi.image.destroy');

        Route::resource('wedding-organizer', WeddingOrganizerController::class);

        Route::delete(
            'wedding-organizer/image/{id}',
            [WeddingOrganizerController::class, 'destroyImage']
        )->name('wedding-organizer.image.destroy');

        Route::resource('makeup', MakeupController::class);

        Route::delete(
            'makeup/image/{id}',
            [MakeupController::class, 'destroyImage']
        )->name('makeup.image.destroy');

        Route::resource('pakaian', PakaianController::class);

        Route::delete(
            'pakaian/image/{id}',
            [PakaianController::class, 'destroyImage']
        )->name('pakaian.image.destroy');

        Route::resource('perawatan', PerawatanController::class);

        Route::delete(
            'perawatan/image/{id}',
            [PerawatanController::class, 'destroyImage']
        )->name('perawatan.image.destroy');

        Route::resource('hiburan', HiburanController::class);

        Route::delete(
            'hiburan/image/{id}',
            [HiburanController::class, 'destroyImage']
        )->name('hiburan.image.destroy');

        Route::resource('photographer', PhotographerController::class);

        Route::delete(
            'photographer/image/{id}',
            [PhotographerController::class, 'destroyImage']
        )->name('photographer.image.destroy');

        Route::resource('paket-pernikahan', PaketPernikahanController::class);

        Route::delete(
            'paket-pernikahan/image/{id}',
            [PaketPernikahanController::class, 'destroyImage']
        )->name('paket-pernikahan.image.destroy');

        Route::resource('penyewaan', AdminPenyewaanController::class)
            ->only(['index', 'show']);

        Route::patch(
            'penyewaan/{penyewaan}/setujui',
            [AdminPenyewaanController::class, 'setujui']
        )->name('penyewaan.setujui');

        Route::get(
            'penyewaan/{penyewaan}/tolak',
            [AdminPenyewaanController::class, 'formTolak']
        )->name('penyewaan.tolak.form');

        Route::patch(
            'penyewaan/{penyewaan}/tolak',
            [AdminPenyewaanController::class, 'tolak']
        )->name('penyewaan.tolak');

        Route::patch(
            'penyewaan/{penyewaan}/selesai',
            [AdminPenyewaanController::class, 'selesai']
        )->name('penyewaan.selesai');

        //laporan penyewaan
        Route::get(
            'laporan-penyewaan',
            [LaporanPenyewaanController::class, 'index']
        )->name('laporan.penyewaan');

        Route::get(
            'laporan-penyewaan/pdf',
            [LaporanPenyewaanController::class, 'print']
        )->name('laporan.penyewaan.pdf');

        //laporan pembayaran
        Route::get('laporan-pembayaran', [LaporanPembayaranController::class, 'index'])
            ->name('laporan.pembayaran');

        Route::get('laporan-pembayaran/pdf', [LaporanPembayaranController::class, 'pdf'])
            ->name('laporan.pembayaran.pdf');
    });

//pelanggan
Route::name('pelanggan.')->group(function () {

    // Auth
    Route::get('/login', [PelangganAuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [PelangganAuthController::class, 'login'])
        ->name('login.process');

    Route::get('/register', [PelangganAuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [PelangganAuthController::class, 'register'])
        ->name('register.store');

    Route::post('/logout', [PelangganAuthController::class, 'logout'])
        ->name('logout');

    // Pesanan
    Route::get('/pesanan', [PesananController::class, 'index'])
        ->name('pesanan');

    // Profil
    Route::get('/profil', [PelangganAuthController::class, 'editProfile'])
        ->name('profil.edit');

    Route::put('/profil', [PelangganAuthController::class, 'updateProfile'])
        ->name('profil.update');

    // Penyewaan
    Route::get('/penyewaan/{jenis}/{slug}', [PelangganPenyewaanController::class, 'create'])
        ->name('penyewaan.create');

    Route::post('/penyewaan', [PelangganPenyewaanController::class, 'store'])
        ->name('penyewaan.store');

    // Dekorasi
    Route::get('/dekorasi', [PelangganDekorasiController::class, 'index'])
        ->name('dekorasi.index');

    Route::get('/dekorasi/{slug}', [PelangganDekorasiController::class, 'show'])
        ->name('dekorasi.show');

    //detail penyewaan
    Route::get('/pesanan/{id}', [PesananController::class, 'show'])
        ->name('pesanan.show');

    //pembayaran
    Route::post('/pesanan/{id}/pembayaran', [PembayaranController::class, 'store'])
        ->name('pembayaran.store');

    // Keranjang
    Route::post('/keranjang', [PelangganPenyewaanController::class, 'addCart'])
        ->name('cart.add');

    Route::get('/keranjang', [PelangganPenyewaanController::class, 'cart'])
        ->name('cart');

    Route::delete('/keranjang/{jenis}/{id}', [PelangganPenyewaanController::class, 'removeCart'])
        ->name('cart.remove');

    Route::get('/checkout', [PelangganPenyewaanController::class, 'checkout'])
        ->name('checkout');
});
