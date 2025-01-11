<x-komponen.cabanglayout>

@hasrole('jayusman|manager|gudang')
    <form method="GET" action="{{ route('produk') }}" class="mb-4 flex gap-4">
        <div>
            <label for="produk_id" class="block text-gray-800 font-semibold">Produk</label>
            <select id="produk_id" name="produk_id" class="pr-10 py-2 border border-gray-300 rounded-lg">
                <option value="">Pilih Produk</option>
                @foreach($produks->unique('produk_id') as $produk)
                    <option value="{{ $produk->produk->id }}" {{ request('produk_id') == $produk->produk->id ? 'selected' : '' }}>
                        {{ $produk->produk->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        @hasrole('jayusman')
        <div>
            <label for="cabang_id" class="block text-gray-800 font-semibold">Cabang</label>
            <select id="cabang_id" name="cabang_id" class="pr-10 py-2 border border-gray-300 rounded-lg">
                <option value="">Pilih Cabang</option>
                @foreach($cabangs as $cabang)
                    <option value="{{ $cabang->id }}" {{ request('cabang_id') == $cabang->id ? 'selected' : '' }}>
                        {{ $cabang->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        @endhasrole

        <button type="submit" class="bg-blue-500 text-white px-4 rounded-lg w-15 h-10 mt-6">Filter</button>
    </form>
    @hasrole('jayusman|manager')
    <div class="mb-4">
        <a href="{{ route('produk.export', [
                'cabang_id' => request('cabang_id'),
                'produk_id' => request('produk_id')
            ]) }}"
            class="bg-green-500 text-white px-4 py-2 rounded-lg font-medium shadow-md hover:bg-green-400 transition-transform duration-300 transform hover:scale-105">
            Export to PDF
        </a>
    </div>
    @endhasrole
    @endhasrole
    @hasrole('gudang')
    <!-- Table displaying product data -->
    <button onclick="window.location.href='{{ route('produk.create') }}'"
        class="bg-blue-500 text-white px-4 py-2 rounded-lg font-medium shadow-md hover:bg-blue-400 transition-transform duration-300 transform hover:scale-105 flex items-center ">
        <span class="text-xl font-bold mr-2"></span> Tambah Produk
    </button>
@endhasrole
    <table class="min-w-full table-auto border-collapse border border-gray-200 mt-5">
        <thead>
            <tr class="bg-blue-300 text-black-600 text-sm leading-normal">
                <th class="py-3 px-6 text-left">Nama Produk</th>
                <th class="py-3 px-6 text-left">Jumlah</th>
                @hasrole('jayusman')
                    <th class="py-3 px-6 text-left">Cabang</th>
                @endhasrole
            </tr>
        </thead>
        <tbody class="text-black-600 text-sm font-light">
            @foreach ($produks as $data)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6 text-left">{{ $data->produk->nama }}</td>
                    <td class="py-3 px-6 text-left">{{ $data->jumlah }}</td>
                    @hasrole('jayusman')
                        <td class="py-3 px-6 text-left">{{ $data->cabang->nama }}</td>
                    @endhasrole
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>{{ $produks->links() }}</div>
</x-komponen.cabanglayout>
