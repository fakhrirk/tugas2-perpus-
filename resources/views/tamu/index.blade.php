@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex flex-col justify-center items-center p-6">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-xl w-full text-center">
        <h1 class="text-3xl font-bold text-green-900 mb-4">Selamat Datang, Tamu!</h1>
        <p class="text-gray-700 mb-6">Anda berhasil login sebagai tamu. Silakan nikmati fitur-fitur umum yang tersedia.</p>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="inline-block bg-green-700 text-white px-6 py-2 rounded-full hover:bg-green-800 transition">
            Keluar
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</div>
@endsection
