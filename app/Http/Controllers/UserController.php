<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = UserModel::all();
        return view('layouts.master-data.user.user', compact('user'));
    }

    // Menampilkan form create atau update
    public function create($id = null)
    {
        $user = null;
        if ($id) {
            $user = UserModel::find($id); // Ambil data user jika ada ID
        }
        return view('layouts.master-data.user.action-user', compact('user'));
    }

    // Menyimpan data (create atau update)
    public function store(Request $request, $id = null)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users,username,' . $id, // Ganti 'user_models' dengan 'users'
            'email' => 'required|email|unique:users,email,' . $id, // Ganti 'user_models' dengan 'users'
            'password' => $id ? 'nullable|string|min:8' : 'required|string|min:8',
            'role' => 'required|string|in:admin,dokter,perawat,apoteker',
        ]);

        // Data yang akan disimpan
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Jika password diisi, hash password
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        // Jika ada ID, update data. Jika tidak, create data baru
        if ($id) {
            UserModel::find($id)->update($data);
            $message = 'User updated successfully.';
        } else {
            UserModel::create($data);
            $message = 'User created successfully.';
        }

        return redirect('/user')->with('success', $message);
    }

    public function update(Request $request, $id)
    {
        $request -> validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'role' => 'required'
        ]);

        // Update data ke database
        UserModel::findOrFail($id)->update($request->all());

        return redirect('/user')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = UserModel::findOrFail($id); // Cari user berdasarkan ID
        $user->delete(); // Hapus user

        return redirect()->route('v-data-user')->with('success', 'User deleted successfully.');
    }
}
