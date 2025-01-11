<x-komponen.cabanglayout>
    <form method="post" action="{{ route('produk.store') }}">
        @csrf
        <div class="max-w-4xl mx-auto p-8 bg-white border-2 border-gray-200 shadow-xl rounded-lg">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Tambah Produk</h2>
            <div class="mb-6">
                <label for="nama" class="block text-gray-700 font-medium mb-2">Nama Produk</label>
                <input type="text" id="nama" name="nama"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out"
                    placeholder="Masukkan Nama Produk" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            @hasrole('jayusman')
            <div class="mb-6">
                <label for="cabang_id" class="block text-gray-700 font-medium mb-2">Cabang</label>
                <select id="cabang_id" name="cabang_id"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out" required>
                    <option value="">Pilih Cabang</option>
                    @foreach($cabangs as $cabang)
                        <option value="{{ $cabang->id }}" {{ old('cabang_id') == $cabang->id ? 'selected' : '' }}>{{ $cabang->nama }}</option>
                    @endforeach
                </select>
                @error('cabang_id')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            @else
            <input type="hidden" name="cabang_id" value="{{ Auth::user()->cabang_id }}">
            @endhasrole
            <div class="mb-6">
                <label for="jumlah" class="block text-gray-700 font-medium mb-2">Jumlah Stok</label>
                <input type="number" id="jumlah" name="jumlah"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out"
                    placeholder="Masukkan Jumlah Stok" value="{{ old('jumlah') }}" min="0" required>
                @error('jumlah')
                    <div class="text-red-500 mt-1 text-sm">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex justify-between gap-4 mb-8">
                <x-primary-button name="save" value="true" class="px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-300 ease-in-out transform hover:scale-105">Save</x-primary-button>
                <a href="{{ route('produk') }}" class="ml-auto self-center px-8 py-3 text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-600 hover:text-white text-base font-medium transition duration-300 ease-in-out">Cancel</a>
            </div>
        </div>
    </form>
</x-komponen.cabanglayout>
