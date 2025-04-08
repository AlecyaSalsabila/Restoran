@extends('layouts.sidebar')

@php
    use Illuminate\Support\Str;
@endphp

@section('title', 'Detail Menu')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-3xl font-bold text-gray-600 mb-6 mt-2">Detail Menu: {{ $menu->name }}</h2>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="w-full">
                <img 
                    src="{{ $menu->image_url ? asset('storage/' . $menu->image_url) : asset('storage/default.jpg') }}" 
                    alt="{{ $menu->name }}" 
                    class="w-full h-80 object-cover rounded-t-lg shadow-md">
            </div>
            <div class="p-6 space-y-4"> 
                <div>
                    <h3 class="text-2xl font-semibold text-gray-800">{{ $menu->name }}</h3>
                </div>
                <div class="flex items-center space-x-2">
                    <strong class="text-gray-700">Price:</strong>
                    <span class="text-xl text-green-600 font-bold">Rp {{ number_format($menu->price, 2, ',', '.') }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    <strong class="text-gray-700">Stock:</strong>
                    <span class="text-xl">{{ $menu->stock }}</span>
                </div>
                <div class="mb-4">
                    <strong class="text-gray-700">Description:</strong>
                    <p class="text-gray-600 text-justify">
                        {{ $menu->description ?? 'No description has been provided.' }}
                    </p>
                </div>
                <div class="flex space-x-4 mt-6">
                    <a href="{{ route('menus.index') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
