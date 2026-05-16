<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class KaryawanController extends Controller implements HasMiddleware
{
    // Cara baru Laravel 11+ untuk memasang gembok Super Admin di Controller
    public static function middleware(): array
    {
        return [
            new Middleware(function ($request, $next) {
                if (auth()->user()->role !== 'super_admin') {
                    abort(403, 'Akses Ditolak. Hanya Super Admin yang diizinkan mengelola karyawan.');
                }
                return $next($request);
            }),
        ];
    }

    public function index()
    {
        // Menampilkan data petugas saja (tidak termasuk pelanggan)
        $karyawan = User::whereIn('role', ['super_admin', 'admin_kantor', 'kasir'])->latest()->get();
        return view('admin.karyawan.index', compact('karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:super_admin,admin_kantor,kasir',
            'telepon' => 'nullable|string|max:20',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'telepon' => $request->telepon,
            'alamat' => 'Kantor Orbit Print',
        ]);

        return back()->with('success', 'Akun Karyawan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'role' => 'required|in:super_admin,admin_kantor,kasir',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Data Karyawan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Cegah Super Admin menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $user->delete();
        return back()->with('success', 'Akun Karyawan berhasil dihapus!');
    }
}