@props([
    'link',
    'active' => false,
])

<a href="{{ $link }}"
   class="block py-2 px-4 rounded hover:bg-gray-700 {{ $active ? 'bg-gray-500 text-white' : '' }}">
    {{ $slot }}
</a>
