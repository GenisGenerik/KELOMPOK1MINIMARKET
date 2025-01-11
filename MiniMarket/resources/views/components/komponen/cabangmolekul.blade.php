<x-komponen.layout>
    @if (Auth::user()->hasRole('jayusman'))
        <x-komponen.jayusmanside></x-komponen.jayusmanside>
    @else
    <x-komponen.cabangside></x-komponen.cabangside>
    @endif

    <x-komponen.mkonten>
        {{ $slot }}
    </x-komponen.mkonten>
</x-komponen.layout>
