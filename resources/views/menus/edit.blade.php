@extends('layouts.sidebar')

@section('title', 'Edit Menu')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h2 class="text-3xl font-bold text-gray-600 mb-6 mt-2">Edit Menu: {{ $menu->name }}</h2>

        <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-semibold">Menu Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $menu->name) }}" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required>
                @error('name')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-semibold">Price</label>
                <input type="number" name="price" id="price" value="{{ old('price', $menu->price) }}" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required min="0"step="0.01">
                @error('price')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="stock" class="block text-gray-700 font-semibold">Stock</label>
                <input type="number" name="stock" id="stock" value="{{ old('stock', $menu->stock) }}" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" required min="0">
        
                @error('stock')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4 mt-2">
                <label for="description" class="block text-gray-700 font-semibold">Description</label>
                <textarea name="description" id="description" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" rows="4"required>{{ old('description', $menu->description) }}</textarea>
                @error('description')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image_url" class="block text-gray-700 font-semibold">Image</label>
                <input type="file" name="image_url" id="image_url" class="mt-1 p-2 w-full border border-gray-300 rounded-lg" accept="image/*">
                @if ($menu->image_url)
                    <div class="mt-2">
                        <strong>Current Image:</strong><br>
                        <img src="{{ asset('storage/' . $menu->image_url) }}" alt="Current Menu Image" class="w-32 h-32 object-cover mt-2">
                    </div>
                @endif
                @error('image_url')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex space-x-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 font-semibold">Save</button>
                <a href="{{ route('menus.index') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Back</a>
            </div>
        </form>
    </div>
@endsection
