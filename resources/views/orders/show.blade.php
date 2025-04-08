@extends('layouts.sidebar')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container mx-auto mt-2">
    <h1 class="text-3xl font-bold text-gray-600 mb-6">Detail Pesanan : {{ $order->id }}</h1>

    <div class="bg-white shadow-md rounded p-6 border border-blue-300">
        <p class="mb-2"><strong>User ID :</strong> {{ $order->user_id }}</p>
        <p class="mb-2"><strong>ID Pesanan :</strong> {{ $order->id }}</p>
        
        <strong>Menu :</strong>
        <div class="overflow-x-auto mt-2 rounded">
            <table class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Menu</th>
                        <th class="px-4 py-2 text-center">Price/Pcs</th>
                        <th class="px-4 py-2 text-center">Amount</th>
                        <th class="px-4 py-2 text-center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($order->items && $order->items->isNotEmpty())
                        @foreach ($order->items as $item)
                            <tr>
                                <td class="border-t border-gray-300 px-4 py-2">{{ $item->menu->name }}</td>
                                <td class="border-t border-gray-300 px-4 py-2 text-center">Rp {{ number_format($item->menu->price, 2, ',', '.') }}</td>
                                <td class="border-t border-gray-300 px-4 py-2 text-center">{{ $item->amount }}</td>
                                <td class="border-t border-gray-300 px-4 py-2 text-center">Rp {{ number_format($item->menu->price * $item->amount, 2, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4" class="border-t border-gray-300 px-4 py-2 text-center">Tidak ada menu terkait.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <p class="mb-2 mt-4"><strong>Name :</strong> {{ optional($order->user)->name ?? 'Tidak tersedia' }}</p>
        <p class="mb-2"><strong>Total :</strong> Rp {{ number_format($order->total_price, 2, ',', '.') }}</p>
        <p class="mb-2"><strong>Status :</strong>
            <span class="{{ $order->status == 'confirmed' ? 'rounded font-bold bg-yellow-400 text-black' : 'font-bold bg-green-600 text-white' }}">
                {{ ucfirst($order->status) }}
            </span>
        </p>
        <p class="mb-2"><strong>Date :</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('orders.index') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Back</a>
    </div>
</div>
@endsection
