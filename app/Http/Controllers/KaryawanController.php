<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{

    public function dataKaryawan() {
        $karyawan = User::where('role', 'staff')->get();
        return view('admin.dataKaryawan', compact('karyawan'));
    }

    public function FormInputKaryawan() {
        return view('admin.inputKaryawan');
    }

    public function InputKaryawan(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'staff', // Pastikan peran sebagai staff
            'status' => 'verify', //Akun dengan status verify
        ]);

        return redirect()->route('data-karyawan')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function FormEditKaryawan($id) {
        $karyawan = User::findOrFail($id);
        return view('admin.editKaryawan', compact('karyawan'));
    }

    public function updateKaryawan(Request $request, $id) {
        $karyawan = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $karyawan->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('data-karyawan')->with('success', 'Data karyawan berhasil diperbarui');
    }

    public function hapusKaryawan($id) {
        User::destroy($id);
        return redirect()->route('data-karyawan')->with('success', 'Karyawan berhasil dihapus');
    }
}
