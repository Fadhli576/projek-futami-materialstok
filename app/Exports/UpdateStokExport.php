<?php

namespace App\Exports;

use App\Models\UpdateStok;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class UpdateStokExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return  UpdateStok::join('materials','update_stoks.stok_id','=','materials.id')->join('users','update_stoks.user_id','users.id')->where([['status','out']])
        ->select('materials.no_material as no_material','materials.nama as nama_material','update_stoks.jumlah_stok as jumlah_stok','users.name as user_name','update_stoks.status as status','update_stoks.created_at as created_at_update', 'update_stoks.metode_scan as metode_scan')
        ->get();
    }

    public function headings(): array
    {
        return [
            'Material',
            'Material Description',
            'Jumlah Stok',
            'Nama User',
            'Status',
            'Tanggal',
            'Metode Scan'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ];

        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . $sheet->getHighestRow())->applyFromArray($styleArray);
    }
}
