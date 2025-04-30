<?php

namespace App\Http\Controllers;

use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Tampilkan daftar user di web (tanpa API).
     */
    public function index(): View
    {
        $users = UsersModel::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Ambil data semua user sebagai JSON untuk API.
     */
    public function getUsers()
    {
        $users = UsersModel::all();
        return response()->json($users);
    }

    /**
     * Tampilkan form untuk membuat user baru.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Simpan user baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'fullname' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'bod' => 'required|date',
            'role' => 'in:user,admin'
        ]);

        UsersModel::create([
            'email' => $request->email,
            'password' => $request->password,
            'fullname' => $request->fullname,
            'address' => $request->address,
            'bod' => $request->bod,
            'role' => $request->role ?? 'user',
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail user tertentu.
     */
 public function show($id)
    {
        return response()->json(UsersModel::findOrFail($id));
    }

    /**
     * Tampilkan form edit user.
     */
    public function edit(UsersModel $user): View
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update user dalam database.
     */
    public function update(Request $request, UsersModel $user, $id): RedirectResponse
    {
        $user = UsersModel::findOrFail($id);

        $data = $request->only(['email', 'password', 'fullname', 'address', 'bod', 'role']);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Hapus user dari database.
     */
    public function destroy(UsersModel $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
