<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $orderReport;

    public function __construct(Collection $orderReport)
    {
        $this->orderReport = $orderReport;
    }

    public function collection()
    {
        return collect($this->orderReport)->map(function ($order) {
            return [
                'Reference Number' => $order->reference_number,
                'Transaction Number' => $order->transaction_number,
                'Quantity' => $order->quantity,
                'Product Name' => $order->product_name,
                'Customer Name' => $order->customer_name,
                'Customer Mobile' => $order->mobile_number,
                'Payment Method' => $order->payment_method,
                'Total' => $order->total,
                'Status' => $order->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Reference Number',
            'Transaction Number',
            'Quantity',
            'Product Name',
            'Customer Name',
            'Customer Mobile',
            'Payment Method',
            'Total',
            'Status',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the header row
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'], // White text color
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'rgb' => 'FF0000', // Red background color
                    ],
                ],
            ],
        ];
    }
}
