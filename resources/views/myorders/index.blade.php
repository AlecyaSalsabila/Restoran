@extends('layouts.sidebar')

@section('title', 'Pesanan Saya')

@section('content')
<div class="container mx-auto mt-2">
    <h2 class="text-3xl font-bold text-gray-600 mb-6">Pesanan Saya</h2>
</div>

@if ($orders->isEmpty())
    <p class="text-center">Tidak ada pesanan yang ditemukan.</p>
@else
    <div class="overflow-x-auto rounded">
        <table class="min-w-full bg-white border border-gray-300 shadow-md mx-auto">
            <thead class="bg-gray-200">
                <tr class="bg-gray-200 text-gray-600 text-md">
                    <th class="py-2 px-4">No</th>
                    <th class="py-2 px-4">Transaction ID</th>
                    <th class="py-2 px-4">Total</th>
                    <th class="py-2 px-4">Date</th>
                    <th class="py-2 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="border-b hover:bg-gray-100 text-center">
                        <td class="py-2 px-4">{{ $loop->iteration }}</td>
                        <td class="py-2 px-4">{{ $order->transaction_id ?? 'N/A' }}</td> 
                        <td class="py-2 px-4">Rp {{ number_format($order->total_price, 2, ',', '.') }}</td>
                        <td class="py-2 px-4">{{ $order->created_at->format('d-m-Y') }}</td>
                        <td class="py-2 px-4">
                            <a href="{{ route('myorders.show', $order->id) }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-4 rounded">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection
