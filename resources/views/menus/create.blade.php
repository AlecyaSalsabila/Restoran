@extends('layouts.sidebar')

@section('title', 'Tambah Menu')

@section('content')
    <h2 class="text-2xl font-semibold mb-4">Tambah Menu</h2>

    <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data" id="menu-form">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700">Menu Name :</label>
            <input type="text" name="name" id="name" class="mt-1 p-2 border rounded w-full"value="{{ old('name') }}" aria-label="Menu Name"/>
            @error('name')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="price" class="block text-gray-700">Price :</label>
            <input type="number" step="0.01" name="price" id="price" class="mt-1 p-2 border rounded w-full"value="{{ old('price') }}"aria-label="Price"/>
            @error('price')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-4">
            <label for="stock" class="block text-gray-700">Stock :</label>
            <input type="number" name="stock" id="stock" class="mt-1 p-2 border rounded w-full"value="{{ old('stock') }}"aria-label="Stock"/>
            @error('stock')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description :</label>
            <textarea name="description" id="description" class="mt-1 p-2 border rounded w-full"rows="4"aria-label="Description">{{ old('description') }}</textarea> 
            @error('description')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div> 
            @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700">Upload Image :</label>
            <input type="file" name="image" id="image" class="mt-1 p-2 border rounded w-full object-contain" accept="image/*"onchange="previewImage(event)"aria-label="Upload Image"/>
            @error('image')
                <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4" id="imagePreview" style="display:none;">
            <label class="block text-gray-700">Image Preview:</label>
            <img id="preview" src="#" alt="Image Preview" class="mt-2 max-w-xs" />
        </div>

        <div class="flex space-x-4">
            <button type="submit" id="save-button" class="font-bold bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Save</button>
            <a href="{{ route('menus.index') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Back</a>
        </div>
    </form>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            
            reader.onload = function() {
                const preview = document.getElementById('preview');
                const previewContainer = document.getElementById('imagePreview');
                
                preview.src = reader.result;
                previewContainer.style.display = 'block'; 
            }
            
            if (file) {
                reader.readAsDataURL(file);
            }
        }

        document.getElementById('menu-form').addEventListener('submit', function (event) {
            const saveButton = document.getElementById('save-button');
            saveButton.disabled = true; 
            saveButton.innerText = 'Processing...'; 
        });
    </script>
@endsection
