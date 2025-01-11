<x-komponen.cabanglayout>
@hasrole('kasir')
    <div class="mb-4">
        <button onclick="window.location.href='{{ route('transaksi.create') }}'"
            class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-500 text-white px-4 py-2 rounded-full font-semibold shadow-lg hover:bg-gradient-to-r hover:from-green-300 hover:via-blue-400 hover:to-purple-400 hover:scale-105 transition-all duration-300 transform flex items-center">
            <span class="text-xl font-bold mr-2"></span> + Tambah Transaksi
        </button>
    </div>
    @endhasrole

    @hasrole('manager|jayusman|supervisor|kasir')
    <!-- Form Filter -->
    <form method="GET" action="{{ route('transaksi') }}" class="mb-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
    <!-- Tahun -->
    <div class="space-y-1">
        <label for="tahun" class="block text-gray-700 font-semibold">Tahun</label>
        <select id="tahun" name="tahun" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            <option value="">Pilih Tahun</option>
            @foreach (range(2020, now()->year) as $year)
                <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>{{ $year }}</option>
            @endforeach
        </select>
    </div>

    <div class="space-y-1">
        <label for="bulan" class="block text-gray-700 font-semibold">Bulan</label>
        <select id="bulan" name="bulan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            <option value="">Pilih Bulan</option>
            @foreach (range(1, 12) as $month)
                <option value="{{ $month }}" {{ request('bulan') == $month ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($month)->format('F') }}</option>
            @endforeach
        </select>
    </div>

    <div class="space-y-1">
        <label for="hari" class="block text-gray-700 font-semibold">Hari</label>
        <select id="hari" name="hari" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            <option value="">Pilih Hari</option>
            @foreach (range(1, 30) as $day)
                <option value="{{ $day }}" {{ request('hari') == $day ? 'selected' : '' }}>{{ $day }}</option>
            @endforeach
        </select>
    </div>

    <div class="space-y-1">
        <label for="user_id" class="block text-gray-700 font-semibold">User</label>
        <select id="user_id" name="user_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            <option value="">Pilih User</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    @hasrole('jayusman')
    <div class="space-y-1">
        <label for="cabang_id" class="block text-gray-700 font-semibold">Cabang</label>
        <select id="cabang_id" name="cabang_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-400">
            <option value="">Pilih Cabang</option>
            @foreach ($cabangs as $cabang)
                <option value="{{ $cabang->id }}" {{ request('cabang_id') == $cabang->id ? 'selected' : '' }}>{{ $cabang->nama }}</option>
            @endforeach
        </select>
    </div>
    @endhasrole

        <div class="flex items-end">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg font-semibold shadow-lg hover:bg-blue-400 transition-transform duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400 w-full">
                Filter
            </button>
        </div>
    </form>
        @endhasrole

    @hasrole('jayusman|manager')
    <div class="mb-6">
        <a href="{{ route('transaksi.export', [
                'tahun' => request('tahun'),
                'bulan' => request('bulan'),
                'hari' => request('hari'),
                'cabang_id' => request('cabang_id'),
                'user_id' => request('user_id'),
            ]) }}"
            class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-4 py-2 rounded-lg font-semibold shadow-lg hover:bg-gradient-to-r hover:from-blue-400 hover:to-purple-400 hover:scale-105 transition-all duration-300 transform">
            Export to PDF
        </a>
    </div>
    @endhasrole

    <div class="overflow-x-auto mt-6">
        <table class="min-w-full bg-white shadow-lg rounded-lg">
            <thead>
                <tr class="bg-gradient-to-r from-blue-500 to-purple-500 text-white text-left text-sm rounded-t-lg">
                    <th class="px-3 py-2 font-semibold rounded-tl-lg">No. Transaksi</th>
                    <th class="px-3 py-2 font-semibold">Jumlah Transaksi</th>
                    <th class="px-3 py-2 font-semibold">Jumlah Barang</th>
                    <th class="px-3 py-2 font-semibold">Nama User</th>
                    @hasrole('jayusman')
                    <th class="px-3 py-2 font-semibold">Nama Cabang</th>
                    @endhasrole
                    <th class="px-3 py-2 font-semibold">Tanggal Transaksi</th>
                    <th class="px-3 py-2 font-semibold rounded-tr-lg">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $data)
                <tr class="bg-gradient-to-r from-blue-50 to-purple-50 hover:bg-gradient-to-r hover:from-blue-100 hover:to-purple-100 transition duration-300">
                    <td class="px-3 py-2 text-sm">{{ $data->id }}</td>
                    <td class="px-3 py-2 text-sm">{{ $data->detailtransaksi_count }}</td>
                    <td class="px-3 py-2 text-sm">{{ $data->detailtransaksi_sum_jumlah }}</td>
                    <td class="px-3 py-2 text-sm">{{ $data->user->name }}</td>
                    @hasrole('jayusman')
                    <td class="px-3 py-2 text-sm">{{ $data->cabang->nama }}</td>
                    @endhasrole
                    <td class="px-3 py-2 text-sm">{{ $data->created_at->toDateString() }}</td>
                    <td class="px-3 py-2">
                        <button onclick="location.href='{{ route('transaksi.detail', ['id' => $data->id]) }}'"
                            class="bg-purple-500 text-white px-4 py-2 rounded-lg hover:bg-blue-400 transition">
                            Detail
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $transaksis->links() }}
    </div>
</x-komponen.cabanglayout>
