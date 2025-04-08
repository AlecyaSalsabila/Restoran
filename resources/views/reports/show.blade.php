@extends('layouts.sidebar')

@section('title', 'Detail Laporan')

@section('content')
<div class="container mx-auto mt-2">
    <h2 class="text-3xl font-bold text-gray-600 mb-6">
        Laporan Bulan 
        <span class="text-3xl font-bold text-gray-600 mb-6">
            {{ $month ? DateTime::createFromFormat('!m', $month)->format('F') : 'N/A' }}
        </span>
    </h2>

    @if ($orders->isNotEmpty())
        <div class="mb-4">
            <p class="mb-4 text-lg font-semibold">Total Pendapatan : <span class="text-green-600">Rp {{ number_format($totalRevenue, 2, ',', '.') }}</span></p>
        </div>
        <div class="overflow-x-auto rounded">
            <table class="min-w-full bg-white rounded-lg shadow-lg border border-gray-300">
                <thead class="bg-gray-200">
                    <tr class="text-gray-600 text-md">
                        <th class="border border-gray-300 p-2">No</th>
                        <th class="border border-gray-300 p-2">Tanggal</th>
                        <th class="border border-gray-300 p-2">ID Pesanan</th>
                        <th class="border border-gray-300 p-2">User ID</th>
                        <th class="border border-gray-300 p-2">User</th>
                        <th class="border border-gray-300 p-2">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr class="hover:bg-gray-100">
                            <td class="border border-gray-300 p-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $order->created_at->format('d-m-Y') }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $order->id }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $order->user_id }}</td>
                            <td class="border border-gray-300 p-2 text-center">{{ $order->user->name }}</td>
                            <td class="border border-gray-300 p-2 text-center">Rp {{ number_format($order->total_price, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            <a href="{{ route('reports.index') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Back</a>
        </div>
    @else
        <p class="mt-4 text-red-600 font-semibold text-center">Tidak ada data untuk laporan yang dipilih.</p>
        <a href="{{ route('reports.index') }}" class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">Back</a>
    @endif
</div>
@endsection
