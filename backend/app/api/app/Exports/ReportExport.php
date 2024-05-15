<?php

namespace App\Exports;


use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
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
        return collect($this->orderReport)->map(function ($transaction) {
            // Initialize an empty array to store product information
            $orderDetails = [];

            // Iterate over each order in the transaction
            foreach ($transaction->orders as $order) {
                // Format the product details (quantity and name)
                $productDetails = $order->quantity . 'x ' . $order->product->name;

                // Add the formatted product details to the array
                $orderDetails[] = $productDetails;
            }

            // Convert the array of product details to a string separated by newlines
            $orderString = implode("\n", $orderDetails);

            return [
                'Reference Number' => $transaction->reference_number,
                'Order Number' => $transaction->id,
                'Order' => $orderString, // Set the order column to the concatenated product details
                'Payment Method' => $transaction->payment_method,
                'Total' => $transaction->total,
                'Status' => $transaction->status, // Change 'Pending' to 'Status'
            ];
        });
    }


    public function headings(): array
    {
        return [
            'Reference Number',
            'Order Number',
            'Order',
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
