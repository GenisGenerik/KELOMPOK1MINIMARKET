<x-komponen.cabanglayout>
    @hasrole('kasir')
        <button onclick="window.location.href='{{ route('transaksi.create') }}'"
            class="bg-blue-500 text-white px-4 py-2 rounded-lg font-medium shadow-md hover:bg-blue-400 transition-transform duration-300 transform hover:scale-105 flex items-center ">
            <span class="text-xl font-bold mr-2"></span> Tambah Transaksi
        </button>
    @endhasrole

    @hasrole('manager|jayusman|supervisor|kasir')

        <form method="GET" action="{{ route('transaksi') }}" class="mb-4 flex gap-4">

                <div>
                    <label for="tahun" class="block text-gray-800 font-semibold">Tahun</label>
                    <select id="tahun" name="tahun" class="pr-10 py-2 border border-gray-300 rounded-lg">
                        <option value="">Pilih Tahun</option>
                        @foreach (range(2020, now()->year) as $year)
                            <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="bulan" class="block text-gray-800 font-semibold">Bulan</label>
                    <select id="bulan" name="bulan" class="pr-10 py-2 border border-gray-300 rounded-lg">
                        <option value="">Pilih Bulan</option>
                        @foreach (range(1, 12) as $month)
                            <option value="{{ $month }}" {{ request('bulan') == $month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="hari" class="block text-gray-800 font-semibold">Hari</label>
                    <select id="hari" name="hari" class="pr-8 py-2 border border-gray-300 rounded-lg">
                        <option value="">Pilih Hari</option>
                        @foreach (range(1, 30) as $day)
                            <option value="{{ $day }}" {{ request('hari') == $day ? 'selected' : '' }}>
                                {{ $day }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="user_id" class="block text-gray-800 font-semibold">User</label>
                    <select id="user_id" name="user_id" class="pr-10 py-2 border border-gray-300 rounded-lg">
                        <option value="">Pilih User</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @hasrole('jayusman')
                <div>
                    <label for="cabang_id" class="block text-gray-800 font-semibold">Cabang</label>
                    <select id="cabang_id" name="cabang_id" class="pr-10 py-2 border border-gray-300 rounded-lg">
                        <option value="">Pilih Cabang</option>
                        @foreach ($cabangs as $cabang)
                            <option value="{{ $cabang->id }}" {{ request('cabang_id') == $cabang->id ? 'selected' : '' }}>
                                {{ $cabang->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endhasrole
                <button type="submit" class="bg-blue-500 text-white px-4 rounded-lg w-15 h-10 mt-6">Filter</button>
            </form>
            @endhasrole

            @hasrole('jayusman|manager')
        <!-- Export to PDF Button -->
        <div class="mb-4">
            <a href="{{ route('transaksi.export', [
                'tahun' => request('tahun'),
                'bulan' => request('bulan'),
                'hari' => request('hari'),
                'cabang_id' => request('cabang_id'),
                'user_id' => request('user_id'),
            ]) }}"
                class="bg-green-500 text-white px-4 py-2 rounded-lg font-medium shadow-md hover:bg-green-400 transition-transform duration-300 transform hover:scale-105">
                Export to PDF
            </a>
        </div>
@endhasrole

        <!-- Tabel Transaksi -->
        <table class="min-w-full bg-gray-700 shadow-lg rounded-lg mt-5">
            <thead>
                <tr class="bg-gray-600 text-gray-200 text-left">
                    <th class="px-4 py-3 font-semibold">No. Transaksi</th>
                    <th class="px-4 py-3 font-semibold">Jumlah Transaksi</th>
                    <th class="px-4 py-3 font-semibold">Jumlah Barang</th>
                    <th class="px-4 py-3 font-semibold">Nama User</th>
                    @hasrole('jayusman')
                    <th class="px-4 py-3 font-semibold">Nama Cabang</th>
                    @endhasrole
                    <th class="px-4 py-3 font-semibold">Tanggal Transaksi</th>
                    <th class="px-4 py-3 font-semibold">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $data)
                    <tr class="bg-gray-800 hover:bg-gray-700 transition">
                        <td class="px-4 py-3">{{ $data->id }}</td>
                        <td class="px-4 py-3">{{ $data->detailtransaksi_count }}</td>
                        <td class="px-4 py-3">{{ $data->detailtransaksi_sum_jumlah }}</td>
                        <td class="px-4 py-3">{{ $data->user->name }}</td>
                        @hasrole('jayusman')
                        <td class="px-4 py-3">{{ $data->cabang->nama }}</td>
                        @endhasrole
                        <td class="px-4 py-3">{{ $data->created_at->toDateString() }}</td>
                        <td class="px-4 py-3">
                            <button onclick="location.href='{{ route('transaksi.detail', ['id' => $data->id]) }}'"
                                class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600 transition">
                                Detail
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div>{{ $transaksis->links() }}</div>
    </x-komponen.cabanglayout>
