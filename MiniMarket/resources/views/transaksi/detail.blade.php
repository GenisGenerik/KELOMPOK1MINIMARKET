<x-komponen.cabanglayout>
    <div class="mb-6">


    </div>

    <!-- Detail Produk -->
    <h2 class="text-xl font-semibold text-gray-800 mb-6">Detail Produk:</h2>

    <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-sm mb-7">
        <thead>
            <tr class="bg-gray-200 text-gray-700">
                <th class="px-8 py-4 text-left text-sm font-medium">Nama Produk</th>
                <th class="px-8 py-4 text-left text-sm font-medium">Jumlah</th>
            </tr>
        </thead>
        @foreach ($transaksis as $data )
        <tbody>
            <tr class="bg-gray-50 hover:bg-gray-200 transition duration-200">
                <td class="px-8 py-4 text-gray-800">{{ $data->produk->nama }}</td>
                <td class="px-8 py-4 text-gray-800">{{ $data->jumlah }}</td>
            </tr>

        </tbody>
        @endforeach

    </table>
    <a href="{{ route('transaksi') }}" class=" px-7 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
        Back
      </a>



</x-komponen.cabanglayout>
