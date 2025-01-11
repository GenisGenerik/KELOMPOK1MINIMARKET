<x-komponen.cabanglayout>
    <form method="post" action="{{ route('transaksi.store') }}">
        @csrf
        <div class="mb-6">
            <label for="nama" class="block text-gray-800 font-semibold mb-2">Nama Produk:</label>
            <select id="nama" name="produk_id" required
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black">
                @foreach ($produks->unique('id') as $produk)
                    <option value="{{ $produk->id }}" class="text-black">{{ $produk->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-6">
            <label for="jumlah" class="block text-gray-800 font-semibold mb-2">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black"
                placeholder="Masukkan jumlah produk" min="1" required>
        </div>
        <div class="flex gap-4 mb-8">
            <a href="{{ route('transaksi') }}">Cancel</a>
            <x-primary-button name="add_product" value="true">Add Product</x-primary-button>
            <x-primary-button name="save" value="true">Save</x-primary-button>
        </div>
    </form>
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Produk:</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-gray-200 text-gray-800">
                    <th class="px-4 py-3 text-left">No</th>
                    <th class="px-4 py-3 text-left">Nama Produk</th>
                    <th class="px-4 py-3 text-left">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach (session('cart', []) as $index => $item)
                    <tr class="bg-gray-100 text-black">
                        <td class="px-4 py-3">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">{{ $item['name'] }}</td>
                        <td class="px-4 py-3">{{ $item['quantity'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-komponen.cabanglayout>
