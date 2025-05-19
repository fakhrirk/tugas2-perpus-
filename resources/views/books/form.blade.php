@csrf
<div class="mb-4">
    <label class="block mb-1">Judul</label>
    <input type="text" name="title" value="{{ old('title', $book->title ?? '') }}" class="w-full border rounded p-2">
</div>
<div class="mb-4">
    <label class="block mb-1">Penulis</label>
    <input type="text" name="author" value="{{ old('author', $book->author ?? '') }}" class="w-full border rounded p-2">
</div>
<div class="mb-4">
    <label class="block mb-1">Penerbit</label>
    <input type="text" name="publisher" value="{{ old('publisher', $book->publisher ?? '') }}" class="w-full border rounded p-2">
</div>
<div class="mb-4">
    <label class="block mb-1">Tahun</label>
    <input type="number" name="year" value="{{ old('year', $book->year ?? '') }}" class="w-full border rounded p-2">
</div>
<button class="bg-blue-500 text-white px-4 py-2 rounded">{{ $submit ?? 'Simpan' }}</button>
