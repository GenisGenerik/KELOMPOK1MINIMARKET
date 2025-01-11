<x-komponen.cabanglayout>
    <form method="post" action="{{ route('cabang.store') }}">
        @csrf
    <div class="mb-6">
        <label for="nama" class="block text-gray-800 font-semibold mb-2">Nama</label>
        <input type="text" id="nama" name="nama"
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black"
            placeholder="Masukkan Nama Cabang" required>
    </div>
    <div class="mb-6">
        <label for="alamat" class="block text-gray-800 font-semibold mb-2">Alamat</label>
        <input type="text" id="alamat" name="alamat"
            class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-black"
            placeholder="Masukkan Alamat Cabang" required>
    </div>
    <div class="flex gap-4 mb-8">
        <a href="{{ route('cabang') }}">Cancel</a>
        <x-primary-button name="save" value="true">Save</x-primary-button>
    </div>
    </form>
</x-komponen.cabanglayout>
