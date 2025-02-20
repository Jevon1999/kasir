<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Barang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;

class KasirController extends Controller
{
    // Menampilkan halaman kasir
    public function index()
    {
        $barang = Barang::all();
        return view('kasir.index', compact('barang'));
    }

    // Proses transaksi
    public function prosesTransaksi(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:barang,id',
            'items.*.quantity' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,debit,credit',
            'payment_amount' => 'required|numeric|min:0'
        ]);

        try {
            $user = Auth::user();
            $items = $request->input('items');
            $paymentMethod = $request->input('payment_method');
            $paymentAmount = $request->input('payment_amount');

            DB::beginTransaction();

            $total_price = 0;
            foreach ($items as $item) {
                $barang = Barang::findOrFail($item['product_id']);

                if ($barang->stock < $item['quantity']) {
                    throw new \Exception('Stok produk '.$barang->name.' tidak mencukupi');
                }

                $subtotal = $barang->price * $item['quantity'];
                $total_price += $subtotal;

                // Update stok produk
                $barang->stock -= $item['quantity'];
                $barang->save();
            }

            // Cek role customer untuk diskon 5%
            $discount = ($user->role === 'customer') ? $total_price * 0.05 : 0;
            $final_price = $total_price - $discount;

            // Cek pembayaran
            if ($paymentAmount < $final_price) {
                throw new \Exception('Jumlah pembayaran kurang');
            }

            // Simpan transaksi
            $transaction = Transaksi::create([
                'user_id' => $user->id,
                'total_price' => $total_price,
                'discount' => $discount,
                'final_price' => $final_price,
                'payment_method' => $paymentMethod,
                'payment_amount' => $paymentAmount,
                'change' => $paymentAmount - $final_price
            ]);

            DB::commit();

            return redirect()->route('kasir.index')
                ->with('success', 'Transaksi berhasil!')
                ->with('transaction_id', $transaction->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Transaksi gagal: '.$e->getMessage());
        }
    }

    // Cetak struk
    public function cetakStruk($id)
    {
        $transaction = Transaksi::with('user')->findOrFail($id);
        return view('kasir.struk', compact('transaction'));
    }

    // Search barang real-time
    public function searchBarang(Request $request)
    {
        $search = $request->input('search');
        $barang = Barang::where('name', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->get();

        return response()->json($barang);
    }
}
