<?php

namespace App\Http\Controllers;

use App\Models\Barang; // Pastikan untuk mengimpor model Barang
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Pastikan untuk mengimpor Storage


class BarangController extends Controller
{
    public function tampilBarang()
    {
        $barang = Barang::all(); // Mengambil semua data barang
        return view('barang.tampilBarang', compact('barang')); // Mengirim data barang ke view
    }

    public function formTambahBarang(){
        return view('barang.tambahBarang'); // Form tambah barang
    }

    public function tambahBarang(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        ]);

        try {
            // Logika untuk menyimpan barang baru
            $imagePath = $request->file('image')->store('images', 'public');

            $barang = Barang::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'image' => $imagePath,
            ]);

            if (!$barang) {
                throw new \Exception('Gagal menyimpan data barang');
            }

            return redirect()->route('tampil-barang')->with('success', 'Barang berhasil ditambahkan');
        } catch (\Exception $e) {
            // Hapus gambar yang sudah diupload jika terjadi error
            if (isset($imagePath) && Storage::exists('public/' . $imagePath)) {
                Storage::delete('public/' . $imagePath);
            }

            return redirect()->back()
                ->withInput()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }

    public function ShowEditBarang($id)
    {
        $barang = Barang::findOrFail($id); // Ambil data barang berdasarkan ID
        return view('barang.editBarang', compact('barang')); // Kirim data ke view
    }




    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $barang->image);
            $barang->image = $request->file('image')->store('images', 'public');
        }

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $barang->update($data);

        return redirect()->route('tampil-barang')->with('success', 'Barang berhasil diperbarui');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        Storage::delete('public/' . $barang->image);
        $barang->delete();

        return redirect()->route('tampil-barang')->with('success', 'Barang berhasil dihapus');
    }
}
