<?php

namespace App\Exports;

use App\Models\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ActivityLogExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    protected $logs;

    public function __construct($logs)
    {
        $this->logs = $logs;
    }

    public function collection()
    {
        return $this->logs->map(function ($log) {
            return [
                'Username' => $log->user->username,
                'Action' => $log->action,
                'Timestamps' => $log->created_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Username',
            'Action',
            'Timestamps',
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
