<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Log') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <form method="post" action="{{ route('log.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <!-- Produk Dropdown -->
                        <div class="max-w-xl">
                            <x-input-label for="produk_id" value="Produk" />
                            <select id="produk_id" name="produk_id" class="mt-1 block w-full text-black" required>
                                @foreach ($produks as $produk)
                                    <option value="{{ $produk->id }}" class="text-black">{{ $produk->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jumlah Input -->
                        <div class="max-w-xl">
                            <x-input-label for="jumlah" value="Jumlah" />
                            <x-text-input id="jumlah" type="number" name="jumlah" class="mt-1 block w-full" required />
                            <x-input-error class="mt-2" :messages="$errors->get('jumlah')" />

                        </div>

                        <!-- Radio Buttons for "Masuk" and "Keluar" -->
                        <div class="max-w-xl">
                            <x-input-label for="status" value="Status" />
                            <div class="flex items-center space-x-6">
                                <label for="masuk" class="flex items-center">
                                    <input type="radio" id="masuk" name="status" value="1" class="mr-2" required />
                                    Masuk
                                </label>
                                <label for="keluar" class="flex items-center">
                                    <input type="radio" id="keluar" name="status" value="0" class="mr-2" required />
                                    Keluar
                                </label>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <!-- Buttons -->
                        <a href="{{ route('log') }}" class="text-blue-500 hover:text-blue-700">Cancel</a>
                      
                        <x-primary-button name="save" value="true">Save</x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
