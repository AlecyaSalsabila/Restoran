<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use Carbon\Carbon; 

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reportOption = $request->input('report_option');
        $month = $request->input('month');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        $orders = collect();
        $totalRevenue = 0;

        if ($reportOption == 'month' && $month) {
            $orders = Order::whereMonth('created_at', $month)
                        ->with('user')
                        ->get();
    
            $totalRevenue = $orders->sum('total_price');

        } elseif ($reportOption == 'date' && $startDate && $endDate) {
            $orders = Order::whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ])
            ->with('user')
            ->get();
    
            $totalRevenue = $orders->sum('total_price');
        }

        return view('reports.index', compact('orders', 'totalRevenue', 'reportOption', 'month', 'startDate', 'endDate'));
    }
    
    public function show(Request $request)
    {
        $month = $request->input('month');
        $orders = $month ? Order::whereMonth('created_at', $month)->get() : collect();
        $totalRevenue = $orders->sum('total_price');
        return view('reports.show', [
            'orders' => $orders,
            'month' => $month,
            'totalRevenue' => $totalRevenue,
        ]);
    }

    public function export(Request $request)
    {
        $reportOption = $request->input('report_option');
        $month = $request->input('month');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        return Excel::download(new ReportExport($reportOption, $month, $startDate, $endDate), 'report.xlsx');
    }
}
