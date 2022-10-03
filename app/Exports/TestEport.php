<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class TestEport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    private $data;
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function collection()
    {
        return $this->data;
    }
    public function map($data): array
    {
        return [
            $data->name,
            $data->phone,
            $data->email
        ];
    }
    public function headings(): array
    {
        return [
            'Tên',
            'Số điện thoại',
            'Email',
        ];
    }
    public function registerEvents(): array
    {
        return [AfterSheet::class => function (AfterSheet $event) {
            $default_font_style = [
                'font' => [
                    'name' => 'Times New Roman', 'size' => 12, 'color' => ['argb' => '#FFFFFF'],
                    'background' => [
                        'color' => '#5B9BD5'
                    ]
                ]
            ];

            $active_sheet = $event->sheet->getDelegate();
            $active_sheet->getParent()->getDefaultStyle()->applyFromArray($default_font_style);
            $arrayAlphabet = [
                'A', 'B', 'C'
            ];
            foreach ($arrayAlphabet as $alphabet) {
                $event->sheet->getColumnDimension($alphabet)->setAutoSize(true);
            }

            // title
            $cellRange = 'A1:C1';
            $active_sheet->getStyle($cellRange)->applyFromArray($default_font_style);
            $active_sheet->getStyle($cellRange)->getFont()
                ->getColor()->setRGB('000000');
            $active_sheet->getStyle($cellRange)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('00d6d6c2');
            $active_sheet->getStyle($cellRange)->getAlignment()->applyFromArray(
                array('horizontal' => 'center', 'vertical' => 'center')
            );
            $active_sheet->getStyle($cellRange)->getFont()->setBold(true);
        },];
    }
}
