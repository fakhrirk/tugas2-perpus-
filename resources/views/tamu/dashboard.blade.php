<x-app-layout>
    {{-- Container Utama Halaman --}}
    <div class="p-4 sm:p-6 lg:p-8 bg-gray-100 min-h-screen">

        {{-- Judul Halaman (Tanpa Tombol Tambah) --}}
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-700">Daftar Buku</h1>
            {{-- Tombol Tambah Buku Baru Dihapus untuk Tamu --}}
        </div>

        {{-- Kartu Statistik (Sederhanakan atau sesuaikan untuk tamu) --}}
        {{-- Anda bisa memilih untuk menampilkan semua atau hanya beberapa statistik --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            {{-- Total Buku (Contoh statistik yang mungkin masih relevan) --}}
            @isset($totalBooks)
            <div class="bg-white overflow-hidden shadow-md rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                            <i class="fas fa-book text-white"></i> {{-- Ikon yang lebih relevan untuk buku --}}
                        </div>
                        <div class="ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Total Buku Tersedia</dt>
                                <dd class="text-2xl font-semibold text-gray-900">{{ $totalBooks }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            @endisset

            {{-- Anda bisa menambahkan kartu statistik lain yang relevan untuk tamu di sini --}}
            {{-- Contoh: Jika ada 'Buku Populer' atau 'Genre Terbanyak' --}}
            {{--
            @isset($newBooksThisMonth)
            <div class="bg-white overflow-hidden shadow-md rounded-lg">
                <div class="p-5">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                            <i class="fas fa-calendar-plus text-white"></i>
                        </div>
                        <div class="ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 truncate">Baru Ditambahkan</dt>
                                <dd class="text-2xl font-semibold text-gray-900">{{ $newBooksThisMonth }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            @endisset
            --}}
            {{-- Kosongkan sisa kolom agar layout tetap konsisten atau isi dengan statistik lain --}}
            @if(!isset($totalBooks) || (isset($totalBooks) && $totalBooks > 0 && !isset($statistikLain1)))
            <div class="hidden lg:block"></div> {{-- Placeholder untuk menjaga layout 4 kolom --}}
            @endif
            @if(!isset($totalBooks) || (isset($totalBooks) && $totalBooks > 0 && !isset($statistikLain2)))
            <div class="hidden lg:block"></div> {{-- Placeholder --}}
            @endif
            @if(!isset($totalBooks) || (isset($totalBooks) && $totalBooks > 0 && !isset($statistikLain3)))
            <div class="hidden lg:block"></div> {{-- Placeholder --}}
            @endif
        </div>


        {{-- Kontrol Filter --}}
        {{-- Pastikan action form mengarah ke route yang benar untuk tamu --}}
        <div class="mb-8 bg-white p-4 shadow-md rounded-lg">
            <form method="GET" action="{{ route('tamu.dashboard') }}"> {{-- Ubah route jika perlu --}}
                <div class="grid grid-cols-1 md:flex md:items-end md:space-x-4 space-y-4 md:space-y-0">
                    <div class="flex-1 min-w-0">
                        <label for="filter_author_tamu" class="block text-sm font-medium text-gray-700">Filter by Author</label>
                        <select id="filter_author_tamu" name="filter_author" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm">
                            <option value="all" @if(old('filter_author', $request->input('filter_author', 'all')) == 'all') selected @endif>Semua Penulis</option>
                            @isset($authors)
                                @foreach($authors as $author)
                                    <option value="{{ $author }}" @if(old('filter_author', $request->input('filter_author')) == $author) selected @endif>{{ $author }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="flex-1 min-w-0">
                        <label for="filter_year_tamu" class="block text-sm font-medium text-gray-700">Filter by Publication Year</label>
                        <select id="filter_year_tamu" name="filter_year" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm">
                            <option value="all" @if(old('filter_year', $request->input('filter_year', 'all')) == 'all') selected @endif>Semua Tahun</option>
                             @isset($publicationYears)
                                @foreach($publicationYears as $year)
                                    <option value="{{ $year }}" @if(old('filter_year', $request->input('filter_year')) == $year) selected @endif>{{ $year }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                    <div class="flex-1 min-w-0">
                        <label for="filter_added_date_tamu" class="block text-sm font-medium text-gray-700">Filter by Added Date</label>
                        <select id="filter_added_date_tamu" name="filter_added_date" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm">
                            <option value="all" @if(old('filter_added_date', $request->input('filter_added_date', 'all')) == 'all') selected @endif>Semua Waktu</option>
                            <option value="today" @if(old('filter_added_date', $request->input('filter_added_date')) == 'today') selected @endif>Hari Ini</option>
                            <option value="this_week" @if(old('filter_added_date', $request->input('filter_added_date')) == 'this_week') selected @endif>Minggu Ini</option>
                            <option value="this_month" @if(old('filter_added_date', $request->input('filter_added_date')) == 'this_month') selected @endif>Bulan Ini</option>
                        </select>
                    </div>
                    <div class="pt-1 md:pt-0">
                        <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2 -ml-1" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L10 14.414V17a1 1 0 01-1 1H7a1 1 0 01-1-1v-2.586L1.293 6.707A1 1 0 011 6V3z" clip-rule="evenodd" /></svg>
                            Apply Filters
                        </button>
                    </div>
                </div>
            </form>
        </div>

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
                            {{-- Kolom Aksi Dihapus untuk Tamu --}}
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @isset($books)
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
                                    <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $book->year }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $book->created_at->format('M d, Y') }}
                                </td>
                                {{-- Kolom Aksi Dihapus untuk Tamu --}}
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500"> {{-- Colspan menjadi 5 karena 1 kolom aksi hilang --}}
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8M9 20H7a2 2 0 01-2-2V6a2 2 0 012-2h6l2 2h4a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" /></svg>
                                        <p class="text-lg font-medium">Tidak ada buku ditemukan.</p>
                                        @if(isset($request) && $request->hasAny(['filter_author', 'filter_year', 'filter_added_date', 'search']))
                                            <p class="text-sm">Coba ubah kriteria filter Anda atau <a href="{{ route('tamu.dashboard') }}" class="text-blue-600 hover:underline">reset filter</a>.</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        @else
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                    Data buku tidak tersedia.
                                </td>
                            </tr>
                        @endisset
                    </tbody>
                </table>
            </div>

            {{-- Paginasi --}}
            @isset($books)
                @if ($books->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    {{ $books->links() }}
                </div>
                @endif
            @endisset
        </div>

        {{-- Tombol Logout (jika tamu adalah user yang login tapi bukan admin) --}}
        {{-- Jika tamu tidak login, ini tidak perlu --}}
        @auth
        <div class="mt-8 text-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 underline">
                    Logout
                </button>
            </form>
        </div>
        @endauth
    </div>
</x-app-layout>