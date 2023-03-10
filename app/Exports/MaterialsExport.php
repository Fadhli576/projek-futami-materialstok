<?php

namespace App\Exports;


use App\Models\Material;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;



class MaterialsExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return Material::select('id','no_material','nama','satuan_id','lokasi','jumlah','deskripsi')->get();

        return Material::join('satuans', 'materials.satuan_id','=','satuans.id')->select('materials.id','materials.no_material','materials.nama','satuans.name','materials.lokasi','materials.jumlah','materials.deskripsi')->get();
    }

    public function headings(): array
    {
        return [
            'No',
            'Material',
            'Material Description',
            'BUn',
            'Lokasi',
            'Unrestricted',
            'Deskripsi',
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
