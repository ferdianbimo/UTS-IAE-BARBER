<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menyimpan pengguna baru
    // Menyimpan pengguna baru
public function store(Request $request)
{
    // Validasi data yang diterima
    $data = $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|email|unique:users,email',
        'password' => 'required|string|min:6',
        'vip' => 'required|boolean',
    ]);

    // Membuat pengguna baru jika validasi berhasil
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']), // Enkripsi password
        'vip' => $data['vip'],
    ]);

    // Mengembalikan respons pengguna yang baru dibuat
    return response()->json($user, 201); // Status code 201 Created
}


    // Mengambil daftar semua pengguna
    public function index()
    {
        $users = User::all();  // Mengambil semua data pengguna
        return response()->json($users);
    }

    // Mengupdate data pengguna
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string',
            'email' => 'sometimes|required|string|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
            'vip' => 'sometimes|required|boolean',
        ]);

        $user = User::findOrFail($id);
        $user->update($data);

        return response()->json($user);
    }

    // Menghapus pengguna
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
    // Menampilkan data pengguna berdasarkan ID
public function show($id)
{
    // Mencari pengguna berdasarkan ID
    $user = User::find($id);  // Gunakan find() untuk mencari berdasarkan ID

    // Jika pengguna tidak ditemukan, kembalikan respons error
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404); // Status code 404 Not Found
    }

    // Jika pengguna ditemukan, kembalikan data pengguna
    return response()->json($user);
}

}
