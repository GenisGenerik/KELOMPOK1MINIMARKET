<x-komponen.cabangmolekul>
    @if(Auth::user()->hasRole('jayusman'))
        <x-komponen.header halaman="Cabang Utama" user="{{ Auth::user()->name }}" jab="Pemilik" ></x-komponen.header>
    @else
        <x-komponen.header halaman="Cabang {{ Auth::user()->cabang->nama }}" user="{{ Auth::user()->name }}  " jab="{{  Auth::user()->roles->first()->name }}"></x-komponen.header>
    @endif
    <!-- Tombol Logout -->

    <x-komponen.kontent>
        {{ $slot }}
    </x-komponen.kontent>
</x-komponen.cabangmolekul>
