@extends('layouts.sidebar')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="container mx-auto mt-2">
    <h1 class="text-3xl font-bold text-gray-600 mb-6">Daftar Pesanan</h1>

    @if (session('success'))
        <div class="mb-4 text-green-500">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 text-red-500">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded">
        <table class="min-w-full bg-white rounded-lg shadow-lg border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-gray-600 text-md">
                    <th class="py-2 px-4">No</th>
                    <th class="py-2 px-4">Name</th>
                    <th class="py-2 px-4">Price</th>
                    <th class="py-2 px-4">Status</th>
                    <th class="py-2 px-4">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="border-t border-gray-200 px-4 py-3 text-center">{{ $loop->iteration }}</td>
                    <td class="border-t border-gray-200 px-4 py-3 text-center">{{ $order->user->name }}</td>
                    <td class="border-t border-gray-200 px-4 py-3 text-center">Rp {{ number_format($order->total_price, 2, ',', '.') }}</td>
                    <td class="border-t border-gray-200 px-4 py-3 text-center">
                        <form action="{{ route('orders.confirmOrder', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH') 
                            <select name="status" class="border rounded-md bg-white hover:bg-gray-100 transition" onchange="this.form.submit()">
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </form>
                        
                    </td>
                    
                    <td class="border-t border-gray-200 px-4 py-3 text-center">
                        <a href="{{ route('orders.show', $order->id) }}" class="font-bold bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700 transition">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if ($orders->isEmpty())
        <p class="mt-4 text-center text-gray-600">Tidak ada pesanan.</p>
    @endif
</div>
@endsection
