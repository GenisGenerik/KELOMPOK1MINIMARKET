<x-komponen.cabanglayout>
    <form method="post" action="{{ route('transaksi.store') }}">
        @csrf
        <div class="max-w-4xl mx-auto p-8 bg-white border-2 border-gray-200 shadow-xl rounded-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Tambah Produk ke Transaksi</h2>
            
            <div class="mb-6">
                <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Produk</label>
                <select id="nama" name="produk_id" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out shadow-sm">
                    @foreach ($produks->unique('id') as $produk)
                        <option value="{{ $produk->id }}" class="text-black">{{ $produk->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6">
                <label for="jumlah" class="block text-gray-700 font-medium mb-2">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out shadow-sm"
                    placeholder="Masukkan jumlah produk" min="1" required>
            </div>

            <div class="flex gap-4 mb-8">
                <div class="flex gap-4">
                    <x-primary-button name="add_product" value="true" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out shadow-md">Add Product</x-primary-button>
                    <x-primary-button name="save" value="true" class="px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-300 ease-in-out shadow-md">Save</x-primary-button>
                </div>
                <a href="{{ route('transaksi') }}" class="ml-auto self-center px-8 py-3 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-600 hover:text-white text-base font-medium transition duration-300 ease-in-out">Cancel</a>
            </div>
        </div>
    </form>

    <div class="overflow-x-auto mt-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Produk dalam Transaksi</h2>
    <div class="overflow-x-auto">
    <table class="min-w-full bg-white shadow-lg rounded-lg">
            <thead>
            <tr class="bg-gradient-to-r from-blue-500 to-purple-500 text-white text-left text-sm rounded-t-lg">
                    <th class="px-6 py-3 text-left rounded-tl-lg">No</th>
                    <th class="px-6 py-3 text-left">Nama Produk</th>
                    <th class="px-6 py-3 text-left rounded-tr-lg">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach (session('cart', []) as $index => $item)
                <tr class="bg-gradient-to-r from-blue-50 to-purple-50 hover:bg-gradient-to-r hover:from-blue-100 hover:to-purple-100 transition duration-300">
                        <td class="px-6 py-3">{{ $loop->iteration }}</td>
                        <td class="px-6 py-3">{{ $item['name'] }}</td>
                        <td class="px-6 py-3">{{ $item['quantity'] }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gradient-to-r from-blue-50 to-purple-50 text-gray-800">
                    <td colspan="3" class="px-6 py-3 text-right rounded-bl-lg rounded-br-lg font-semibold">Total Produk: {{ count(session('cart', [])) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
</x-komponen.cabanglayout>
