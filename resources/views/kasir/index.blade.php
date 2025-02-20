<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Kasir</title>
  <script>
    // Real-time search functionality
    document.getElementById('search').addEventListener('input', function() {
      let searchQuery = this.value;

      if (searchQuery.length >= 3) {
        fetch(`{{ route('kasir.search') }}?search=${searchQuery}`)
          .then(response => response.json())
          .then(data => {
            let tbody = document.querySelector('tbody');
            tbody.innerHTML = '';

            data.forEach(item => {
              let row = `
                <tr class="text-center">
                  <td class="p-3 border">${item.name}</td>
                  <td class="p-3 border">Rp ${item.price.toLocaleString('id-ID')}</td>
                  <td class="p-3 border">
                    <button type="button" onclick="this.nextElementSibling.stepDown(); updateTotal();" class="px-2 bg-gray-300">-</button>
                    <input type="number" name="items[${item.id}][quantity]" class="jumlah-beli w-16 border border-gray-300 p-1" data-price="${item.price}" value="1" min="0" oninput="updateTotal()">
                    <button type="button" onclick="this.previousElementSibling.stepUp(); updateTotal();" class="px-2 bg-gray-300">+</button>
                  </td>
                </tr>
              `;
              tbody.insertAdjacentHTML('beforeend', row);
            });
          });
      }
    });

    function updateTotal() {
      let total = 0;
      document.querySelectorAll('.jumlah-beli').forEach(input => {
        let price = parseFloat(input.dataset.price);
        let quantity = parseInt(input.value);
        total += price * quantity;
      });

      let discount = {{ auth()->user()->role === 'customer' ? 0.05 : 0 }};
      let totalWithDiscount = total - (total * discount);
      document.getElementById('total-harga').innerText = 'Rp ' + totalWithDiscount.toLocaleString('id-ID');
    }

    function confirmTransaction() {
      document.getElementById('modal-total').innerText = document.getElementById('total-harga').innerText;
      document.getElementById('confirm-modal').classList.remove('hidden');
    }

    function closeModal() {
      document.getElementById('confirm-modal').classList.add('hidden');
    }
  </script>
</head>
<body class="bg-gray-100">
  @include('layout.sidebar')
  <div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Transaksi Kasir</h2>

    <input type="text" id="search" placeholder="Cari produk (minimal 3 karakter)..." class="mb-4 p-2 border border-gray-300 rounded w-full focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">

    <form method="POST" action="{{ route('kasir.proses') }}">
      @csrf
      <div class="overflow-x-auto">
        <table class="w-full bg-white border border-gray-300 rounded-lg shadow-sm">
          <thead class="bg-gray-200">
            <tr>
              <th class="p-3 border">Nama Produk</th>
              <th class="p-3 border">Harga</th>
              <th class="p-3 border">Jumlah</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($barang as $barangs)
            <tr class="text-center">
              <td class="p-3 border">{{ $barangs->name }}</td>
              <td class="p-3 border">Rp {{ number_format($barangs->price, 0, ',', '.') }}</td>
              <td class="p-3 border">
                <button type="button" onclick="this.nextElementSibling.stepDown(); updateTotal();" class="px-2 bg-gray-300">-</button>
                <input type="number" name="items[{{ $loop->index }}][quantity]" class="jumlah-beli w-16 border border-gray-300 p-1" data-price="{{ $barangs->price }}" value="1" min="0" oninput="updateTotal()">
                <button type="button" onclick="this.previousElementSibling.stepUp(); updateTotal();" class="px-2 bg-gray-300">+</button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="bg-white p-4 mt-4 rounded-lg shadow-sm border">
        <h3 class="text-lg font-bold mb-2">Total Harga: <span id="total-harga">Rp 0</span></h3>
      </div>

      <div class="mt-6 flex justify-end space-x-2">
        <button type="button" onclick="confirmTransaction()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Proses Transaksi</button>
      </div>
    </form>
  </div>

  <!-- Modal Konfirmasi -->
  <div id="confirm-modal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg">
      <h3 class="text-lg font-bold mb-2">Konfirmasi Transaksi</h3>
      <p>Total Harga: <span id="modal-total">Rp 0</span></p>
      <div class="mt-4 flex justify-end space-x-2">
        <button onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Konfirmasi</button>
      </div>
    </div>
  </div>
</body>
</html>
