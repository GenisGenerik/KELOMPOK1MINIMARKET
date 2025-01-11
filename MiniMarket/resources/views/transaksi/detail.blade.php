<x-komponen.cabanglayout>
    <div class="mb-6"></div>
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Detail Produk:</h2>
    <table class="min-w-full bg-white shadow-lg rounded-lg">
        <thead>
        <tr class="bg-gradient-to-r from-blue-500 to-purple-500 text-white text-left text-sm rounded-t-lg">
        <th class="px-3 py-2 font-semibold rounded-tl-lg w-1/2 text-center">Nama Produk</th>
        <th class="px-3 py-2 font-semibold rounded-tr-lg w-1/2 text-center">Jumlah</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($transaksis as $data)
            <tr class="bg-gradient-to-r from-blue-50 to-purple-50 hover:bg-gradient-to-r hover:from-blue-100 hover:to-purple-100 transition duration-300">
                <td class="px-3 py-2 text-sm text-center">{{ $data->produk->nama }}</td>
                <td class="px-3 py-2 text-sm text-center">{{ $data->jumlah }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="flex justify-center mt-6">
        <a href="{{ route('transaksi') }}" 
            class="text-blue-600 hover:text-blue-800 font-medium text-base transition duration-300 transform hover:scale-105">
            Kembali
        </a>
    </div>
</x-komponen.cabanglayout>
