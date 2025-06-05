<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // --- Data untuk Kartu Statistik ---
        $totalBooks = Book::count();
        $newBooksThisMonth = Book::where('created_at', '>=', Carbon::now()->startOfMonth())->count();
        // Contoh stat tambahan: Buku terbit tahun ini
        $booksPublishedThisYear = Book::where('year', Carbon::now()->year)->count();
        // Contoh stat tambahan: Jumlah penulis unik
        $uniqueAuthorsCount = Book::distinct('author')->count('author');


        // --- Data untuk Opsi Filter ---
        $authors = Book::distinct()->orderBy('author')->pluck('author');
        // Ambil tahun unik dari buku, atau definisikan rentang jika lebih sesuai
        $publicationYears = Book::distinct()->orderBy('year', 'desc')->pluck('year');


        // --- Query Utama dengan Filter ---
        $query = Book::query();

        // Filter berdasarkan Penulis
        if ($request->filled('filter_author') && $request->filter_author !== 'all') {
            $query->where('author', $request->filter_author);
        }

        // Filter berdasarkan Tahun Terbit (contoh: satu tahun spesifik)
        if ($request->filled('filter_year') && $request->filter_year !== 'all') {
            $query->where('year', $request->filter_year);
        }

        // Filter berdasarkan Tanggal Ditambahkan
        if ($request->filled('filter_added_date') && $request->filter_added_date !== 'all') {
            switch ($request->filter_added_date) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'this_week':
                    $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'this_month':
                    $query->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
                    break;
            }
        }

        // Pencarian (opsional, jika Anda ingin menambahkan search bar seperti di header)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('author', 'like', "%{$searchTerm}%")
                  ->orWhere('publisher', 'like', "%{$searchTerm}%");
            });
        }

        $books = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->except('page'));

        return view('books.index', compact(
            'books',
            'totalBooks',
            'newBooksThisMonth',
            'booksPublishedThisYear',
            'uniqueAuthorsCount',
            'authors',
            'publicationYears',
            'request' // Untuk mempertahankan nilai filter di form
        ));
    }

    // Metode create, store, edit, update, destroy Anda lainnya ...
    public function create()
    {
        return view('books.create'); // Pastikan Anda punya view ini
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book')); // Pastikan Anda punya view ini
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'required|integer|min:1000|max:' . (date('Y') + 1),
        ]);

        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }
}