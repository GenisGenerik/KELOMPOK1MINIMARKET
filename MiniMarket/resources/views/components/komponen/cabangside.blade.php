<x-komponen.sidebar>
    <x-komponen.sidelink link="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">Home</x-komponen.sidelink>
    @hasrole('manager|supervisor|kasir')
    <x-komponen.sidelink link="{{ route('transaksi') }}" :active="request()->routeIs('transaksi')">Transaksi</x-komponen.sidelink>
    @endhasrole
    @hasrole('manager|gudang')
    <x-komponen.sidelink link="{{ route('log') }}" :active="request()->routeIs('log')">Log</x-komponen.sidelink>
    <x-komponen.sidelink link="{{ route('produk') }}" :active="request()->routeIs('produk')">Produk</x-komponen.sidelink>
    @endhasrole
    @hasrole('manager')
    <x-komponen.sidelink link="{{ route('user') }}" :active="request()->routeIs('user')">User</x-komponen.sidelink>
    @endhasrole
    <form action="{{ route('logout') }}" method="POST" class="mt-4">
        @csrf
        <button type="submit" class="w-full p-3 text-white bg-red-500 rounded-lg hover:bg-red-600">
            Logout
        </button>
    </form>
</x-komponen.sidebar>
