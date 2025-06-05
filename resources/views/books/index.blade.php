<x-app-layout>

<div class="p-4 sm:p-6 lg:p-8 bg-gray-100 min-h-screen">
        {{-- Judul Halaman dan Tombol Tambah --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-700">Manajemen Buku</h1>
            <a href="{{ route('books.create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-800 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 shadow">
                {{-- Heroicon: plus-sm (mirip user-plus) --}}
                <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                Tambah Buku Baru
            </a>
        </div>

        {{-- Kartu Statistik --}}
<div class="grid grid-cols-4 gap-5 mb-8">
    {{-- Total Buku --}}
    <div class="bg-white overflow-hidden shadow-md rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
<div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                    <i class="fas fa-users text-white"></i>
                                </div>
                <div class="ml-4 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Buku</dt>
                        <dd class="text-2xl font-semibold text-gray-900">{{ $totalBooks ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    {{-- Buku Baru Bulan Ini --}}
    <div class="bg-white overflow-hidden shadow-md rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                    <i class="fas fa-user-check text-white"></i>
                                </div>
                <div class="ml-4 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Baru Bulan Ini</dt>
                        <dd class="text-2xl font-semibold text-gray-900">{{ $newBooksThisMonth ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    {{-- Buku Terbit Tahun Ini --}}
    <div class="bg-white overflow-hidden shadow-md rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-yellow-400 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Terbit Tahun Ini</dt>
                        <dd class="text-2xl font-semibold text-gray-900">{{ $booksPublishedThisYear ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    {{-- Penulis Unik --}}
    <div class="bg-white overflow-hidden shadow-md rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0 bg-red-500 rounded-md p-3">
                    <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a7 7 0 00-7 7h14a7 7 0 00-7-7zm8-1a1 1 0 100-2h-2a1 1 0 100 2h2zm-2-2a1 1 0 10-2 0v2a1 1 0 102 0V9z"/>
                    </svg>
                </div>
                <div class="ml-4 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Penulis Unik</dt>
                        <dd class="text-2xl font-semibold text-gray-900">{{ $uniqueAuthorsCount ?? 0 }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

        {{-- Kontrol Filter --}}
        <div class="mb-8 bg-white p-4 shadow-md rounded-lg">
            <form method="GET" action="{{ route('books.index') }}">
                <div class="grid grid-cols-1 md:flex md:items-end md:space-x-4 space-y-4 md:space-y-0">
                    <div class="flex-1 min-w-0">
                        <label for="filter_author" class="block text-sm font-medium text-gray-700">Filter by Author</label>
                        <select id="filter_author" name="filter_author" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm">
                            <option value="all" @if(old('filter_author', $request->input('filter_author', 'all')) == 'all') selected @endif>Semua Penulis</option>
                            @foreach($authors as $author)
                                <option value="{{ $author }}" @if(old('filter_author', $request->input('filter_author')) == $author) selected @endif>{{ $author }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 min-w-0">
                        <label for="filter_year" class="block text-sm font-medium text-gray-700">Filter by Publication Year</label>
                        <select id="filter_year" name="filter_year" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm">
                            <option value="all" @if(old('filter_year', $request->input('filter_year', 'all')) == 'all') selected @endif>Semua Tahun</option>
                            @foreach($publicationYears as $year)
                                <option value="{{ $year }}" @if(old('filter_year', $request->input('filter_year')) == $year) selected @endif>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-1 min-w-0">
                        <label for="filter_added_date" class="block text-sm font-medium text-gray-700">Filter by Added Date</label>
                        <select id="filter_added_date" name="filter_added_date" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm">
                            <option value="all" @if(old('filter_added_date', $request->input('filter_added_date', 'all')) == 'all') selected @endif>Semua Waktu</option>
                            <option value="today" @if(old('filter_added_date', $request->input('filter_added_date')) == 'today') selected @endif>Hari Ini</option>
                            <option value="this_week" @if(old('filter_added_date', $request->input('filter_added_date')) == 'this_week') selected @endif>Minggu Ini</option>
                            <option value="this_month" @if(old('filter_added_date', $request->input('filter_added_date')) == 'this_month') selected @endif>Bulan Ini</option>
                        </select>
                    </div>
                    <div class="pt-1 md:pt-0">
                        <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            {{-- Heroicon: filter (mirip) --}}
                            <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L10 14.414V17a1 1 0 01-1 1H7a1 1 0 01-1-1v-2.586L1.293 6.707A1 1 0 011 6V3z" clip-rule="evenodd" />
                            </svg>
                            Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Pesan Sukses (jika ada) --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-md shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- Tabel Buku --}}
        <div class="bg-white shadow-md overflow-hidden sm:rounded-lg">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penerbit</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ditambahkan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($books as $book)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $book->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-600">{{ $book->author }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-600">{{ $book->publisher ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{-- Badge Tahun (Mirip "Status" atau "Role" di contoh) --}}
                                <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $book->year }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $book->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center space-x-3">
                                    {{-- Tombol Aksi (Menyesuaikan ikon dari contoh) --}}
                                    {{-- <a href="#" class="text-blue-600 hover:text-blue-800" title="View">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.522 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a> --}}
                                    <a href="{{ route('books.edit', $book) }}" class="text-green-500 hover:text-green-700" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700" title="Delete">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8M9 20H7a2 2 0 01-2-2V6a2 2 0 012-2h6l2 2h4a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" /></svg>
                                    <p class="text-lg font-medium">Tidak ada buku ditemukan.</p>
                                    @if(request()->hasAny(['filter_author', 'filter_year', 'filter_added_date', 'search']))
                                        <p class="text-sm">Coba ubah kriteria filter Anda atau <a href="{{ route('books.index') }}" class="text-blue-600 hover:underline">reset filter</a>.</p>
                                    @else
                                        <p class="text-sm">Silakan tambahkan buku baru terlebih dahulu.</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Paginasi --}}
            @if ($books->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $books->links() }} {{-- Pastikan view paginasi Tailwind Anda sudah benar --}}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>