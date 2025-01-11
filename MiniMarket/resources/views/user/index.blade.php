<x-komponen.cabanglayout>
    @hasrole('jayusman')
    <form method="GET" action="{{ route('user') }}" class="mb-4">
        <label for="cabang_id" class="text-white font-medium mr-2">Filter by Cabang:</label>
        <select name="cabang_id" id="cabang_id" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-medium shadow-md hover:bg-gray-500 transition-transform duration-300">
            <option value="">-- Select Cabang --</option>
            @foreach ($cabangs as $cabang)
                <option value="{{ $cabang->id }}" {{ request('cabang_id') == $cabang->id ? 'selected' : '' }}>{{ $cabang->nama }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg font-medium shadow-md hover:bg-blue-400 transition-transform duration-300 transform hover:scale-105 ml-2">Filter</button>
    </form>
    @endhasrole
    <button onclick="window.location.href='{{ route('user.create') }}'"
        class="bg-blue-500 text-white px-4 py-2 rounded-lg font-medium shadow-md hover:bg-blue-400 transition-transform duration-300 transform hover:scale-105 flex items-center">
        <span class="text-xl font-bold mr-2"></span> Tambah User
    </button>

    <table class="min-w-full bg-gray-700 shadow-lg rounded-lg mt-5">
        <thead>
            <tr class="bg-gray-600 text-gray-200 text-left">
                <th class="px-4 py-3 font-semibold">No</th>
                <th class="px-4 py-3 font-semibold">Nama User</th>
                @hasrole('jayusman')
                <th class="px-4 py-3 font-semibold">Nama Cabang</th>
                @endhasrole
                <th class="px-4 py-3 font-semibold">Role</th>
            </tr>
        </thead>
        <tbody>
            @hasrole('jayusman')
            <tr class="bg-gray-800 hover:bg-gray-700 transition">
                <td class="px-4 py-3">1</td>
                <td class="px-4 py-3">Jayusman</td>
                <td class="px-4 py-3">Utama</td>
                <td class="px-4 py-3">Pemilik</td>
            </tr>
            @endhasrole
            @foreach ($users as $data)
                <tr class="bg-gray-800 hover:bg-gray-700 transition">
                    <td class="px-4 py-3">{{ $data->id }}</td>
                    <td class="px-4 py-3">{{ $data->name }}</td>
                    @hasrole('jayusman')
                    <td class="px-4 py-3">{{ $data->cabang->nama }}</td>
                    @endhasrole
                    <td class="px-4 py-3">
                        @foreach ($data->roles as $role)
                            {{ $role->name }}
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>{{ $users->links() }}</div>
</x-komponen.cabanglayout>
