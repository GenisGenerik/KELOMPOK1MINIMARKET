<x-komponen.cabanglayout>
    @hasrole('jayusman')
    <form method="GET" action="{{ route('user') }}" class="mb-4">
        <label for="cabang_id" class="text-white font-medium mr-2">Filter by Cabang:</label>
        <select name="cabang_id" id="cabang_id" class="bg-gradient-to-r from-green-400 via-blue-500 to-purple-600 text-white px-4 py-2 rounded-lg font-medium shadow-md hover:opacity-90 transition-transform duration-300">
            <option value="">-- Select Cabang --</option>
            @foreach ($cabangs as $cabang)
                <option value="{{ $cabang->id }}" {{ request('cabang_id') == $cabang->id ? 'selected' : '' }}>{{ $cabang->nama }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-gradient-to-r from-blue-500 to-green-400 text-white px-4 py-2 rounded-lg font-medium shadow-md hover:opacity-90 transition-transform duration-300 transform hover:scale-105 ml-2">Filter</button>
    </form>
    @endhasrole

    <button onclick="window.location.href='{{ route('user.create') }}'"
        class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-6 py-2 rounded-lg font-medium shadow-md hover:opacity-90 transition-transform duration-300 transform hover:scale-105 flex items-center">
        <span class="text-xl font-bold mr-2"></span> Tambah User
    </button>

    <div class="overflow-x-auto mt-6">
        <table class="min-w-full bg-gradient-to-r from-white to-white rounded-lg shadow-md">
            <thead class="bg-gradient-to-r from-blue-500 to-blue-300 border-b">
                <tr>
                    <th class="py-3 px-6 text-left text-black font-bold">No</th>
                    <th class="py-3 px-6 text-left text-black font-bold">Nama User</th>
                    @hasrole('jayusman')
                    <th class="py-3 px-6 text-left text-black font-bold">Nama Cabang</th>
                    @endhasrole
                    <th class="py-3 px-6 text-left text-black font-bold">Role</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-blue">
                @foreach ($users as $index => $user)
                    <tr class="hover:bg-gradient-to-r from-blue-50 to-green-50">
                        <td class="py-3 px-6">{{ $index + 1 }}</td>
                        <td class="py-3 px-6">{{ $user->name }}</td>
                        @hasrole('jayusman')
                        <td class="py-3 px-6">{{ $user->cabang->nama ?? '-' }}</td>
                        @endhasrole
                        <td class="py-3 px-6">{{ $user->roles->pluck('name')->join(', ') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</x-komponen.cabanglayout>
