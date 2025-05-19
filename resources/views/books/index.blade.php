<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold mb-4">Daftar Buku</h1>
                    <a href="{{ route('books.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Buku</a>

                    @if(session('success'))
                        <div class="bg-green-100 text-green-700 p-2 mt-4 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full mt-4 border">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="p-2">Judul</th>
                                <th class="p-2">Penulis</th>
                                <th class="p-2">Penerbit</th>
                                <th class="p-2">Tahun</th>
                                <th class="p-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($books as $book)
                            <tr class="border-t">
                                <td class="p-2">{{ $book->title }}</td>
                                <td class="p-2">{{ $book->author }}</td>
                                <td class="p-2">{{ $book->publisher }}</td>
                                <td class="p-2">{{ $book->year }}</td>
                                <td class="p-2">
                                    <a href="{{ route('books.edit', $book) }}" class="text-blue-600">Edit</a> |
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin?')" class="text-red-600">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
