<x-komponen.cabanglayout>
    <form method="post" action="{{ route('produk.store') }}">
        @csrf

        <!-- Nama Produk -->
        <div class="mb-6">
            <label for="nama" class="block text-gray-800 font-semibold mb-2">Nama Produk</label>
            <input type="text" id="nama" name="nama"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black"
                placeholder="Masukkan Nama Produk" value="{{ old('nama') }}" required>
            @error('nama')
                <div class="text-red-500 mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Cabang (Jika Peran User 'jayusman') -->
        @hasrole('jayusman')
        <div class="mb-6">
            <label for="cabang_id" class="block text-gray-800 font-semibold mb-2">Cabang</label>
            <select id="cabang_id" name="cabang_id"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black" required>
                <option value="">Pilih Cabang</option>
                @foreach($cabangs as $cabang)
                    <option value="{{ $cabang->id }}" {{ old('cabang_id') == $cabang->id ? 'selected' : '' }}>
                        {{ $cabang->nama }}
                    </option>
                @endforeach
            </select>
            @error('cabang_id')
                <div class="text-red-500 mt-1">{{ $message }}</div>
            @enderror
        </div>
        @else
        <!-- Input Cabang ID Tersembunyi untuk Pengguna Lain -->
        <input type="hidden" name="cabang_id" value="{{ Auth::user()->cabang_id }}">
        @endhasrole

        <!-- Jumlah Stok -->
        <div class="mb-6">
            <label for="jumlah" class="block text-gray-800 font-semibold mb-2">Jumlah Stok</label>
            <input type="number" id="jumlah" name="jumlah"
                class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black"
                placeholder="Masukkan Jumlah Stok" value="{{ old('jumlah') }}" min="0" required>
            @error('jumlah')
                <div class="text-red-500 mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol Save dan Cancel -->
        <div class="flex gap-4 mb-8">
            <a href="{{ route('produk') }}" class="text-blue-500 hover:text-blue-700">Cancel</a>
            <x-primary-button name="save" value="true">Save</x-primary-button>
        </div>
    </form>
</x-komponen.cabanglayout>
