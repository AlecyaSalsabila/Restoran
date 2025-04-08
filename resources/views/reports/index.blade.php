@extends('layouts.sidebar')

@section('title', 'Laporan')

@section('content')
<div class="container mx-auto mt-2">
    <h2 class="text-3xl font-bold text-gray-600 mb-6">Laporan</h2>
  
    <form action="{{ route('reports.index') }}" method="GET" id="reportForm" class="mb-6" onsubmit="return validateForm()">
   
        <div class="mb-4">
            <label for="report_option" class="block text-gray-700 font-medium">Pilih Opsi Laporan:</label>
            <select name="report_option" id="report_option" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" onchange="toggleDateInputs()">
                <option value="">-- Pilih Opsi --</option>
                <option value="month" {{ request('report_option') == 'month' ? 'selected' : '' }}>Pilih Bulan</option>
                <option value="date" {{ request('report_option') == 'date' ? 'selected' : '' }}>Pilih Tanggal</option>
            </select>
        </div>

        <div id="monthInput" class="mb-4 {{ request('report_option') == 'month' ? '' : 'hidden' }}">
            <label for="month" class="block text-gray-700 font-medium mb-2">Pilih Bulan:</label>
            <select name="month" id="month" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <option value="">-- Pilih Bulan --</option>
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>{{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                @endfor
            </select>
        </div>

        <div id="dateInputs" class="{{ request('report_option') == 'date' ? '' : 'hidden' }}">
            <div class="mb-4">
                <label for="start_date" class="block text-gray-700 font-medium">Tanggal Awal:</label>
                <input type="date" name="start_date" id="start_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ request('start_date') }}">
            </div>
            <div class="mb-4">
                <label for="end_date" class="block text-gray-700 font-medium">Tanggal Akhir:</label>
                <input type="date" name="end_date" id="end_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ request('end_date') }}">
            </div>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition">Submit</button>
        <p id="error-message" class="mt-2 text-red-600 hidden">Tanggal awal dan akhir wajib diisi.</p>
    </form>

    @if (request('report_option') == 'month' && request('month'))
        <div class="mt-6 p-4 bg-white border border-gray-200 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Laporan Bulanan</h3>
            <p class="mb-2 text-gray-600">Bulan : <span class="font-bold">{{ DateTime::createFromFormat('!m', request('month'))->format('F') }} {{ date('Y') }}</span></p>
            <p class="mb-4 text-gray-600">Total Pendapatan : <span class="font-bold text-green-600">Rp {{ number_format($totalRevenue, 2, ',', '.') }}</span></p>
            <a href="{{ route('reports.show', ['month' => request('month')]) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">Show</a>
            <a href="{{ route('reports.export', ['report_option' => 'month', 'month' => request('month')]) }}" class="ml-2 bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition">Export File</a>
        </div>
    @elseif (request('report_option') == 'date')
        @if ($orders->isNotEmpty())
            <div class="mt-6 bg-white border border-gray-200 rounded-lg shadow-md p-6">
                <h3 class="text-xl font-semibold text-gray-800">Laporan Harian</h3>
                <p class="mb-2 text-gray-600">Tanggal Awal: <span class="font-bold">{{ \Carbon\Carbon::parse(request('start_date'))->format('d-m-Y') }}</span></p>
                <p class="mb-2 text-gray-600">Tanggal Akhir: <span class="font-bold">{{ \Carbon\Carbon::parse(request('end_date'))->format('d-m-Y') }}</span></p>
                <table class="min-w-full bg-white border border-gray-200 mt-4">
                    <thead>
                        <tr class="bg-gray-300">
                            <th class="border px-4 py-2">ID Pesanan</th>
                            <th class="border px-4 py-2">Tanggal</th>
                            <th class="border px-4 py-2">Total Harga</th>
                            <th class="border px-4 py-2">Pengguna</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="border px-4 py-2 text-center">{{ $order->id }}</td>
                                <td class="border px-4 py-2 text-center">{{ \Carbon\Carbon::parse($order->created_at)->format('d-m-Y') }}</td>
                                <td class="border px-4 py-2 text-center">Rp {{ number_format($order->total_price, 2, ',', '.') }}</td>
                                <td class="border px-4 py-2 text-center">{{ $order->user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <p class="mt-4 text-lg font-semibold">Total Pendapatan: <span class="text-green-600">Rp {{ number_format($totalRevenue, 2, ',', '.') }}</span></p>
                <div class="mt-2">
                <a href="{{ route('reports.export', ['report_option' => 'date', 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700 transition">Export File</a>
            </div></div>
        @else
            <p class="mt-4 text-red-600">Tidak ada data untuk laporan yang dipilih.</p>
        @endif
    @endif
</div>

<script>
    function toggleDateInputs() {
        const reportOption = document.getElementById('report_option').value;
        const monthInput = document.getElementById('monthInput');
        const dateInputs = document.getElementById('dateInputs');

        monthInput.classList.toggle('hidden', reportOption !== 'month');
        dateInputs.classList.toggle('hidden', reportOption !== 'date');
    }

    function validateForm() {
        const reportOption = document.getElementById('report_option').value;
        const startDate = document.getElementById('start_date').value;
        const endDate = document.getElementById('end_date').value;
        const errorMessage = document.getElementById('error-message');

        if (reportOption == 'date' && (!startDate || !endDate)) {
            errorMessage.classList.remove('hidden');
            return false; 
        }
        errorMessage.classList.add('hidden');
        return true;
    }
</script>
@endsection
