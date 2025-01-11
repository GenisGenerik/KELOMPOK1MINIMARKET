<x-komponen.cabanglayout>
    <div class="container mx-auto px-4">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Tambah User</h1>

        <!-- Formulir Tambah User -->
        <form method="POST" action="{{ route('user.store') }}">
            @csrf

            <!-- Nama -->
            <div class="mb-6">
                <label for="name" class="block text-gray-800 font-semibold mb-2">Nama:</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black"
                    placeholder="Masukkan nama pengguna" required  autocomplete="off">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label for="email" class="block text-gray-800 font-semibold mb-2">Email:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black"
                    placeholder="Masukkan email pengguna" required  autocomplete="off">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-800 font-semibold mb-2">Password:</label>
                <input type="password" id="password" name="password"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black"
                    placeholder="Masukkan password" required  autocomplete="off">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="mb-6">
                <label for="password_confirmation" class="block text-gray-800 font-semibold mb-2">Konfirmasi Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black"
                    placeholder="Ulangi password" required  autocomplete="off">
                @error('password_confirmation')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            @hasrole('jayusman')
            <!-- Cabang -->
            <div class="mb-6">
                <label for="cabang" class="block text-gray-800 font-semibold mb-2">Cabang:</label>
                <select id="cabang" name="cabang_id" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black">
                    @foreach ($cabangs as $cabang)
                        <option value="{{ $cabang->id }}" class="text-black">{{ $cabang->nama }}</option>
                    @endforeach
                </select>
                @error('cabang_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            @endhasrole
            <!-- Role -->
            <div class="mb-6">
                <label for="role" class="block text-gray-800 font-semibold mb-2">Role:</label>
                <select id="role" name="role" required
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black">
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" class="text-black">{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tombol Submit -->
            <div class="flex gap-4">
                <a href="{{ route('user') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Cancel</a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Save</button>
            </div>
        </form>
    </div>
</x-komponen.cabanglayout>
