<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    protected $reportOption;
    protected $month;
    protected $startDate;
    protected $endDate;

    public function __construct($reportOption, $month = null, $startDate = null, $endDate = null)
    {
        $this->reportOption = $reportOption;
        $this->month = $month;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        if ($this->reportOption == 'month' && $this->month) {
            return Order::whereMonth('created_at', $this->month)
                        ->with('user')
                        ->select('id', 'user_id', 'created_at', 'total_price', 'transaction_id') 
                        ->get()
                        ->map(function($order) {
                            return [
                                'id' => $order->id,
                                'user_id' => $order->user_id, 
                                'username' => $order->user->name, 
                                'created_at' => $order->created_at->format('Y-m-d H:i:s'),
                                'total_price' => $order->total_price,
                                'transaction_id' => $order->transaction_id,
                            ];
                        });
        }

        if ($this->reportOption == 'date' && $this->startDate && $this->endDate) {
            $startDate = \Carbon\Carbon::parse($this->startDate)->startOfDay();
            $endDate = \Carbon\Carbon::parse($this->endDate)->endOfDay();

            return Order::whereBetween('created_at', [$startDate, $endDate])
                        ->with('user') 
                        ->select('id', 'user_id', 'created_at', 'total_price', 'transaction_id') 
                        ->get()
                        ->map(function($order) {
                            return [
                                'id' => $order->id,
                                'user_id' => $order->user_id, 
                                'username' => $order->user->name, 
                                'created_at' => $order->created_at->format('Y-m-d H:i:s'), 
                                'total_price' => $order->total_price,
                                'transaction_id' => $order->transaction_id, 
                            ];
                        });
        }

        return collect();
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'User ID',
            'Username',
            'Date',
            'Total Price',
            'Transaction ID', 
        ];
    }
}
