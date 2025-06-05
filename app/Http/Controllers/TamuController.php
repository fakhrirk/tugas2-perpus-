<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TamuController extends Controller
{
    public function dashboard(Request $request) // Atau bisa juga method bernama index()
    {
        // --- Data untuk Kartu Statistik (Sederhanakan jika perlu untuk tamu) ---
        // Mungkin tamu tidak perlu semua statistik, atau statistiknya berbeda
        $totalBooks = Book::count(); // Contoh: Tamu masih bisa lihat total buku
        // $newBooksThisMonth = Book::where('created_at', '>=', Carbon::now()->startOfMonth())->count();
        // $booksPublishedThisYear = Book::where('year', Carbon::now()->year)->count();
        // $uniqueAuthorsCount = Book::distinct('author')->count('author');

        // --- Data untuk Opsi Filter ---
        // Tamu mungkin masih bisa menggunakan filter ini
        $authors = Book::distinct()->orderBy('author')->pluck('author');
        $publicationYears = Book::distinct()->orderBy('year', 'desc')->pluck('year');

        // --- Query Utama dengan Filter ---
        $query = Book::query();

        if ($request->filled('filter_author') && $request->filter_author !== 'all') {
            $query->where('author', $request->filter_author);
        }
        if ($request->filled('filter_year') && $request->filter_year !== 'all') {
            $query->where('year', $request->filter_year);
        }
        // Untuk filter 'Added Date', Anda mungkin perlu menyesuaikan nama route di form jika berbeda
        if ($request->filled('filter_added_date') && $request->filter_added_date !== 'all') {
            switch ($request->filter_added_date) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                // ... kasus lainnya ...
            }
        }

        // Jika tamu juga bisa search
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                  ->orWhere('author', 'like', "%{$searchTerm}%");
            });
        }

        $books = $query->orderBy('title', 'asc')->paginate(10)->appends($request->except('page'));

        return view('tamu.dashboard', compact( // Sesuaikan nama view
            'books',
            'totalBooks', // Kirim hanya statistik yang relevan untuk tamu
            // 'newBooksThisMonth',
            // 'booksPublishedThisYear',
            // 'uniqueAuthorsCount',
            'authors',
            'publicationYears',
            'request'
        ));
    }
}