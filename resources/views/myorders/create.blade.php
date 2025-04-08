@extends('layouts.sidebar')

@section('title', 'Form Pemesanan')

@section('content')
<div class="container mx-auto mt-10">
    <div class="bg-white shadow-lg rounded-lg p-6 border border-blue-300">
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-6">Form Pemesanan</h1>
        <button type="button" id="add-menu" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 mb-4">Tambah Menu</button>
        
        <form action="{{ route('myorders.store') }}" method="POST" id="order-form">
            @csrf
            <div id="menu-items" class="mb-4">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Pilih Menu</h2>

            </div>

            <div class="mt-4">
                <strong>Total Keseluruhan:</strong> <span id="total-keseluruhan">Rp. 0</span>
            </div>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded transition duration-300 mt-4" id="submit-order" disabled>Pesan</button>
            <a href="{{ route('myorders.index') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Back</a>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addMenuButton = document.getElementById('add-menu');
        const menuItemsContainer = document.getElementById('menu-items');
        const submitButton = document.getElementById('submit-order');
        let menuCount = 0; 

        addMenuButton.addEventListener('click', function () {
            if (menuCount >= 5) {
                alert("Anda hanya bisa menambah maksimal 5 menu.");
                return;
            }

            const newMenuItem = document.createElement('div');
            newMenuItem.classList.add('menu-item', 'flex', 'flex-col', 'items-start', 'mb-4', 'p-4', 'bg-gray-50', 'rounded-lg', 'shadow-md');

            newMenuItem.innerHTML = `
                <label class="w-full font-semibold text-gray-700" for="menu">Nama Menu:</label>
                <select name="menu_id[]" class="mt-1 block w-full rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 menu-select" required>
                    <option value="">-- Pilih Menu --</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}" data-harga="{{ $menu->price }}" data-stok="{{ $menu->stock }}" data-image="{{ asset('storage/' . $menu->image_url) }}">
                            {{ $menu->name }} - Rp {{ number_format($menu->price, 0, ',', '.') }} (Stok: {{ $menu->stock }})
                        </option>
                    @endforeach
                </select>

                <!-- Image will be inserted here -->
                <div class="w-48 mt-2 hidden menu-image-container">
                    <img class="w-48 h-auto rounded-md" alt="Menu Image">
                </div>

                <label class="w-full mt-2 font-semibold text-gray-700" for="amount">Jumlah:</label>
                <input type="number" name="amount[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 jumlah-input" required min="1" value="1">

                <label class="w-full mt-2 font-semibold text-gray-700" for="total_price">Total Menu:</label>
                <input type="text" name="total_price[]" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 total-input" readonly value="0">

                <button type="button" class="ml-2 bg-red-500 text-white font-bold py-2 px-4 rounded remove-menu mt-2">Hapus</button>
            `;

            menuItemsContainer.appendChild(newMenuItem);
            menuCount++; 
            updateTotalPrice();
        });

        menuItemsContainer.addEventListener('change', function (event) {
            if (event.target.classList.contains('menu-select') || event.target.classList.contains('jumlah-input')) {
                updateTotalPrice();
            }
        });

        menuItemsContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-menu')) {
                event.target.closest('.menu-item').remove();
                menuCount--;
                updateTotalPrice();
            }
        });

        function updateTotalPrice() {
            const menuItems = menuItemsContainer.getElementsByClassName('menu-item');
            let totalKeseluruhan = 0;
            let allMenusValid = true;

            for (let item of menuItems) {
                const select = item.querySelector('.menu-select');
                const jumlahInput = item.querySelector('.jumlah-input');
                const totalInput = item.querySelector('.total-input');
                const imageContainer = item.querySelector('.menu-image-container');
                const img = imageContainer.querySelector('img');

                if (select.value) {
                    const harga = parseFloat(select.options[select.selectedIndex].dataset.harga);
                    const jumlah = parseInt(jumlahInput.value);
                    const stok = parseInt(select.options[select.selectedIndex].dataset.stok);
                    const imageUrl = select.options[select.selectedIndex].dataset.image;

                    imageContainer.classList.remove('hidden');
                    img.src = imageUrl;

                    if (jumlah > stok) {
                        alert('Stok tidak cukup untuk menu ' + select.options[select.selectedIndex].text);
                        jumlahInput.value = stok; 
                    }

                    const total = harga * jumlah;
                    totalInput.value = total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }).replace(/,/g, '.');

                    totalKeseluruhan += total;
                } else {
                    totalInput.value = 0;
                    imageContainer.classList.add('hidden');
                    allMenusValid = false;
                }
            }

            document.getElementById('total-keseluruhan').textContent = totalKeseluruhan.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }).replace(/,/g, '.');

          
            if (allMenusValid) {
                submitButton.disabled = false;
            } else {
                submitButton.disabled = true;
            }
        }


        document.getElementById('order-form').addEventListener('submit', function (event) {
            submitButton.disabled = true; 
            submitButton.innerText = 'Processing...'; 

        });
    });
</script>
@endsection
