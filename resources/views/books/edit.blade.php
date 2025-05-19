<x-layouts.app>
    <div class="p-6">
        <h1 class="text-xl font-bold mb-4">Edit Buku</h1>
        <form action="{{ route('books.update', $book) }}" method="POST">
            @csrf
            @method('PUT')
            @include('books.form', ['submit' => 'Update'])
        </form>
    </div>
</x-layouts.app>