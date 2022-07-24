<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('guest.login');
    }
    public function getRegister()
    {
        return view('guest.register');
    }
    public function register(Request $request)
    {
        $this->validate(
            $request,
            [
                'username' => 'required|min:7|unique:users',
                'name' => 'required',
                'code' => 'required',
                'password' => 'required|min:3|confirmed',
            ],
            [
                'required' => 'Form Tidak Boleh Kosong!',
                'username.min' => 'Username terlalu pendek (Minimal 7 karakter)',
                'password.min' => 'Kata Sandi Minimal 3 Karakter',
                'confirmed' => 'Password tidak sama',
                'unique' => 'Username sudah digunakan. Silahkan ganti Username.'
            ]
        );
        if ($request->code == 'regisparkir') {
            User::create([
                'username' => $request->username,
                'name' => ucfirst($request->name),
                'role' => 1,
                'password' => bcrypt($request->password)
            ]);
            return redirect('/')->with('status', 'Registrasi berhasil. Silahkan melakukan Login.');
        } else {
            return redirect()->back()->with('status', 'Kode Rahasia Salah!');
        }
    }
    public function login(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            return redirect('/dashboard');
        }
        return redirect()->back()->with('error', 'Username/Password tidak sesuai');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
