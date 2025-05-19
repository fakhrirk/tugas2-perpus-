<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-xl font-bold mb-4">Tambah Buku</h1>
                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block mb-1">Judul</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded p-2">
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block mb-1">Penulis</label>
                            <input type="text" name="author" value="{{ old('author') }}" class="w-full border rounded p-2">
                            @error('author')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block mb-1">Penerbit</label>
                            <input type="text" name="publisher" value="{{ old('publisher') }}" class="w-full border rounded p-2">
                        </div>
                        <div class="mb-4">
                            <label class="block mb-1">Tahun</label>
                            <input type="number" name="year" value="{{ old('year') }}" class="w-full border rounded p-2">
                        </div>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
