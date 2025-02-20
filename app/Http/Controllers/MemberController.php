<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class MemberController extends Controller
{

    public function dataMember() {
        $member = User::where('role', 'customer')->get();
        return view('karyawan.dataMember', compact('member'));
    }

    public function FormInputMember() {
        return view('karyawan.inputMember');
    }

    public function InputMember(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'customer', // Pastikan peran sebagai customer
            'status' => 'verify', //Akun dengan status verify
        ]);

        return redirect()->route('data-member')->with('success', 'Member berhasil ditambahkan');
    }

    public function FormEditMember($id) {
        $member = User::findOrFail($id);
        return view('karyawan.editMember', compact('member'));
    }

    public function updateKaryawan(Request $request, $id) {
        $member = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        $member->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('data-member')->with('success', 'Data member berhasil diperbarui');
    }

    public function hapusKaryawan($id) {
        User::destroy($id);
        return redirect()->route('data-member')->with('success', 'Member berhasil dihapus');
    }
}
