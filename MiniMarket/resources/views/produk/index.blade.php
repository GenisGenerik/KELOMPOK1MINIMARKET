<x-komponen.cabanglayout>
    @hasrole('jayusman|manager|gudang')
    <!-- Form Filter -->
    <form method="GET" action="{{ route('produk') }}" class="mb-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        <!-- Filter Produk -->
        <div>
            <label for="produk_id" class="block text-gray-700 font-semibold mb-2">Produk</label>
            <select id="produk_id" name="produk_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
                <option value="">Pilih Produk</option>
                @foreach($produks->unique('produk_id') as $produk)
                <option value="{{ $produk->produk->id }}" {{ request('produk_id') == $produk->produk->id ? 'selected' : '' }}>
                    {{ $produk->produk->nama }}
                </option>
                @endforeach
            </select>
        </div>
        <!-- Filter Cabang (Hanya untuk Jayusman) -->
        @hasrole('jayusman')
        <div>
            <label for="cabang_id" class="block text-gray-700 font-semibold mb-2">Cabang</label>
            <select id="cabang_id" name="cabang_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
                <option value="">Pilih Cabang</option>
                @foreach($cabangs as $cabang)
                <option value="{{ $cabang->id }}" {{ request('cabang_id') == $cabang->id ? 'selected' : '' }}>
                    {{ $cabang->nama }}
                </option>
                @endforeach
            </select>
        </div>
        @endhasrole
        <!-- Tombol Filter -->
        <div class="flex items-end">
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-lg font-medium shadow-md hover:bg-blue-400 transition-transform duration-300 transform hover:scale-105 max-w-xs">
                Filter
            </button>
        </div>
    </form>

    <!-- Export to PDF (Hanya untuk Jayusman dan Manager) -->
    @hasrole('jayusman|manager')
    <div class="mt-4">
    <a href="{{ route('produk.export', [
            'cabang_id' => request('cabang_id'),
            'produk_id' => request('produk_id')
        ]) }}"
        class="bg-gradient-to-r from-blue-400 via-purple-500 to-indigo-500 text-white px-6 py-2 rounded-lg font-semibold shadow-lg hover:bg-gradient-to-r hover:from-blue-300 hover:via-purple-400 hover:to-indigo-400 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400">
        Export to PDF
    </a>
</div>


    @endhasrole
    @endhasrole

    <!-- Tambah Produk Button (Hanya untuk Gudang) -->
    @hasrole('gudang')
    <div class="mb-4">
    <button onclick="window.location.href='{{ route('produk.create') }}'"
        class="bg-gradient-to-r from-blue-400 via-purple-500 to-indigo-500 text-white px-4 py-2 rounded-full font-semibold shadow-lg hover:bg-gradient-to-r hover:from-biru-300 hover:via-purple-400 hover:to-indigo-400 hover:scale-105 transition-all duration-300 transform flex items-center">
        <span class="text-xl font-bold mr-2"></span> + Tambah Transaksi
    </button>
</div>
    @endhasrole

    <div class="overflow-x-auto mt-6">
    <table class="min-w-full bg-white shadow-lg rounded-lg">
    <thead>
        <tr class="bg-gradient-to-r from-blue-500 to-purple-500 text-white text-sm">
            <th class="px-3 py-2 font-semibold rounded-tl-lg w-1/2 text-center">Nama Produk</th>
            <th class="px-3 py-2 font-semibold rounded-tr-lg w-1/2 text-center">Jumlah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($produks as $data)
            <tr class="bg-gradient-to-r from-blue-50 to-purple-50 hover:bg-gradient-to-r hover:from-blue-100 hover:to-purple-100 transition duration-300">
                <td class="px-3 py-2 text-sm text-center">{{ $data->produk->nama }}</td>
                <td class="px-3 py-2 text-sm text-center">{{ $data->jumlah }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $produks->links() }}
    </div>
</x-komponen.cabanglayout>
