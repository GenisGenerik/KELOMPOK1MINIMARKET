<x-komponen.cabanglayout>
    <button onclick="window.location.href='{{ route('cabang.create') }}'"
        class="bg-blue-500 text-white px-4 py-2 rounded-lg font-medium shadow-md hover:bg-blue-400 transition-transform duration-300 transform hover:scale-105 flex items-center ">
        <span class="text-xl font-bold mr-2"></span> Tambah Cabang
    </button>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-5">
        @foreach ($cabangs as $data)
        <x-komponen.card title="{{ $data->nama }}" deskripsi="{{ $data->alamat }}"></x-komponen.card>
        @endforeach
    </div>
</x-komponen.cabanglayout>




