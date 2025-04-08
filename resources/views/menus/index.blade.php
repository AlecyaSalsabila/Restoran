@extends('layouts.sidebar')

@php
    use Illuminate\Support\Str;
@endphp

@section('title', 'Daftar Menu')

@section('content')
    <h2 class="text-3xl font-bold text-gray-600 mb-6 mt-2">Daftar Menu</h2>

    @if (session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-400 rounded" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (Auth::check() && Str::endsWith(Auth::user()->email, '@admin.com'))
        <a href="{{ route('menus.create') }}" class="font-bold mb-4 inline-block bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700" aria-label="Tambah Menu">Tambah Menu</a>
    @endif
    
    @if (Auth::check())
        <div class="bg-blue-100 p-6 rounded-lg shadow-lg mb-6">

                <label class="text-sm text-gray-700">Apakah Anda ingin memesan? Silahkan klik "Pesan" terlebih dahulu</label>
                <div class="mt-2">
                <a href="{{ route('myorders.create') }}" class="font-bold inline-block bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600" aria-label="Pesan Menu" disabled>Pesan</a>
                </div>         
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($menus as $menu)
            <div class="bg-white border border-gray-300 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <img 
                    src="{{ $menu->image_url ? asset('storage/' . $menu->image_url) : asset('storage/default.jpg') }}" 
                    alt="{{ $menu->name }}" 
                    class="w-full h-48 object-cover"
                >

                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $menu->name }}</h3>
                    <p class="text-sm text-gray-600">Stock: {{ $menu->stock }}</p>
                    <p class="text-xl text-green-600 font-bold">Rp {{ number_format($menu->price, 2, ',', '.') }}</p>
                </div>

                <div class="flex justify-between items-center p-4 bg-gray-100">
                    <a href="{{ route('menus.show', $menu->id) }}" class="font-bold bg-green-600 text-white py-2 px-4 rounded hover:bg-green-700" aria-label="Lihat menu {{ $menu->name }}">Detail</a>

                    @if (Auth::check() && Str::endsWith(Auth::user()->email, '@admin.com'))
                        <div class="flex space-x-2">
                            <a href="{{ route('menus.edit', $menu->id) }}" class="font-bold bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600" aria-label="Edit menu {{ $menu->name }}">Edit</a>

                            <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-bold bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600" aria-label="Hapus menu {{ $menu->name }}">Hapus</button>
                            </form>
                        </div>
                    @endif

             
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center text-gray-600 p-4">
                Tidak ada menu tersedia
            </div>
        @endforelse
    </div>

@endsection
