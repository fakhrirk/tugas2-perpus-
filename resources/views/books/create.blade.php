<x-layouts.app>
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Tambah Buku</h1>
        <form action="{{ route('books.store') }}" method="POST">
            @include('books.form', ['submit' => 'Tambah'])
        </form>
    </div>
</x-layouts.app>