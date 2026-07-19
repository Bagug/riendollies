<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

   public function login(Request $request)
    {
        // Validasi input
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

        // Cari admin berdasarkan username
        $admin = Admin::where('username', $request->username)->first();

        // Cek password
        if ($admin && Hash::check($request->password, $admin->password)) {

            session([
                'id_admin' => $admin->id_admin,
                'username' => $admin->username,
                'login_admin' => true,
            ]);

            return redirect('/admin');
        }

        return back()->with('error', 'Username atau Password salah!');
    }

    public function logout()
{
    session()->flush();

    return redirect('/login-admin');
}
}
