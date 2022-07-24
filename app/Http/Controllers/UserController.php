<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUser(User $user)
    {
        // Query data user
        $petugas = $user->orderBy('name', 'asc')->paginate(5);

        return view('dashboard.masterUser', compact('petugas'));
    }

    public function addUser(Request $request)
    {
        // Validasi menambahkan user
        $this->validate(
            $request,
            [
                'username' => 'required|min:7|unique:users,username',
                'name' => 'required',
                'role' => 'required|',
                'password' => 'required|min:3|confirmed',
            ],
            [
                'username.min' => 'Username terlalu pendek (Minimal 7 karakter)',
                'username.required' => 'Username Tidak Boleh Kosong!',
                'name.required' => 'Nama Lengkap Tidak Boleh Kosong!',
                'role.required' => 'Role Tidak Boleh Kosong!',
                'password.required' => 'Password Tidak Boleh Kosong!',
                'password.min' => 'Kata Sandi Minimal 3 Karakter',
                'confirmed' => 'Password tidak sama',
                'unique' => 'Username sudah digunakan. Silahkan ganti Username.'
            ]
        );

        // Menyimpan data ke tabel User
        User::create([
            'username' => $request->username,
            'name' => ucfirst($request->name),
            'role' => $request->role,
            'password' => bcrypt($request->password)
        ]);
        return redirect('/master/user')->with('status', 'Data User Telah Ditambahkan');
    }

    public function editUser(User $user)
    {
        $getUser = $user->where('user_id', $user->user_id)->first();
        return view('dashboard.editUser', compact('getUser'));
    }
    public function updateUser(User $user, Request $request)
    {
        $getRequest = $request->validate(
            [
                'name' => 'required',
                'username' => 'required|min:7|unique:users,username,' . $user->user_id . ',user_id',
                'role' => 'required',
            ],
            [
                'required' => 'Form Wajib diisi!',
                'username.min' => 'username Minimal 7 Karakter',
            ]
        );

        //Percabangan jika rubah password
        if ($request->password) {
            $request->validate(
                [
                    'password' => 'min:3'
                ],
                [
                    'min' => 'Kata Sandi Minimal 3 karakter',
                ]
            );
            $getRequest['password'] = bcrypt($request->password);
        }

        // Update data user
        $user->update($getRequest);
        return redirect('/master/user')->with('status', 'Data User telah dirubah');
    }

    public function destroyUser(User $user)
    {
        // Menghapus data User
        $user->delete();
        return redirect('/master/user')->with('status', 'Data User telah dihapus');
    }

    public function profil()
    {
        return view('dashboard.profil');
    }

    public function changePassword()
    {
        return view('dashboard.changePassword');
    }

    public function newPassword(Request $request, User $user)
    {
        $getRequest = $request->validate(
            [
                'password' => 'required|min:3|confirmed'
            ],
            [
                'required' => 'Kata Sandi tidak boleh kosong',
                'min' => 'Kata Sandi Minimal 3 karakter',
                'confirmed' => 'Kata Sandi tidak sesuai'
            ]
        );
        $getRequest['password'] = bcrypt($request->password);
        $user->update($getRequest);
        return redirect('/changePassword')->with('status', 'Kata Sandi berhasil diubah');
    }
}
