<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login', [
            'title' => 'Login'
        ]);
    }

    public function showRegister()
    {
        return view('register', [
            'title' => 'Register'
        ]);
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|max:255',
                'username' => 'required|unique:pelanggans,username|max:50',
                'email' => 'required|email|unique:pelanggans,email',
                'no_hp' => 'required',
                'alamat' => 'required',
                'password' => 'required|min:8|confirmed',
                'terms' => 'accepted',
            ],

            [
                'nama.required' => 'Nama wajib diisi.',
                'username.required' => 'Username wajib diisi.',
                'username.unique' => 'Username sudah digunakan.',
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan.',
                'no_hp.required' => 'Nomor HP wajib diisi.',
                'alamat.required' => 'Alamat wajib diisi.',
                'password.required' => 'Password wajib diisi.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan.',
            ]
        );


        Pelanggan::create([
            'nama' => $request->nama,
            'username' => $request->username,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username wajib diisi.',
                'password.required' => 'Password wajib diisi.',
            ]
        );

        // ==========================
        // Cek Login Admin
        // ==========================
        $admin = Admin::where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {

            session([
                'id_admin' => $admin->id_admin,
                'username' => $admin->username,
                'login_admin' => true,
            ]);

            return redirect('/admin');
        }

        // ==========================
        // Cek Login Pelanggan
        // ==========================
        $pelanggan = Pelanggan::where('username', $request->username)->first();

        if ($pelanggan && Hash::check($request->password, $pelanggan->password)) {

            session([
                'id_pelanggan' => $pelanggan->id_pelanggan,
                'nama' => $pelanggan->nama,
                'username' => $pelanggan->username,
                'login_pelanggan' => true,
            ]);

            return redirect('/');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        session()->flush();

        return redirect('/login');
    }

public function editProfile()
{
    if (!session('login_pelanggan')) {
        return redirect('/login');
    }

    $pelanggan = Pelanggan::findOrFail(session('id_pelanggan'));

    return view('pelanggan.profile.edit', [
        'title' => 'Profil Saya',
        'pelanggan' => $pelanggan,
    ]);
}
    public function updateProfile(Request $request)
{
    $pelanggan = Pelanggan::findOrFail(session('id_pelanggan'));

    $request->validate([
        'nama' => 'required|max:255',

        'username' => 'required|max:50|unique:pelanggans,username,' .
            $pelanggan->id_pelanggan . ',id_pelanggan',

        'email' => 'required|email|unique:pelanggans,email,' .
            $pelanggan->id_pelanggan . ',id_pelanggan',

        'no_hp' => 'required',

        'alamat' => 'required',

        'password' => 'nullable|min:8|confirmed',
    ], [

        'nama.required' => 'Nama wajib diisi.',

        'username.required' => 'Username wajib diisi.',
        'username.unique' => 'Username sudah digunakan.',

        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',

        'no_hp.required' => 'Nomor HP wajib diisi.',

        'alamat.required' => 'Alamat wajib diisi.',

        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ]);

    $pelanggan->nama = $request->nama;
    $pelanggan->username = $request->username;
    $pelanggan->email = $request->email;
    $pelanggan->no_hp = $request->no_hp;
    $pelanggan->alamat = $request->alamat;

    if ($request->filled('password')) {
        $pelanggan->password = Hash::make($request->password);
    }

    $pelanggan->save();

    session([
        'nama' => $pelanggan->nama,
        'username' => $pelanggan->username,
    ]);

    return redirect()
        ->route('pelanggan.profil.edit')
        ->with('success', 'Profil berhasil diperbarui.');
}
}
