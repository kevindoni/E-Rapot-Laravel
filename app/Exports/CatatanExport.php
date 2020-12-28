<?php

namespace App\Exports;

use App\Models\KelasSiswa;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CatatanExport implements WithHeadings, WithEvents, ShouldAutoSize
{
    use Exportable;

    public function headings(): array
    {
        return [
            "No",
            "No Induk Siswa",
            "Nama Siswa",
            "Catatan Akademik",
        ];
    }

    public function registerEvents(): array
    {
        $styleHeader = [
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
            'alignment' => [
                'vertical' => 'center',
                'horizontal' => 'center'
            ],
        ];
        $styleInput = [
            'alignment' => [
                'vertical' => 'center',
                'horizontal' => 'center'
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => [
                    'rgb' => '92D050',
                ]
            ],
        ];

        return [
            AfterSheet::class => function (AfterSheet $event) use ($styleHeader, $styleInput) {
                $event->sheet->getStyle('A1:D1')->applyFromArray($styleHeader);

                $siswa = KelasSiswa::with('siswa')->where('kelas_id', Auth::user()->data_id)->get();
                foreach ($siswa as $val => $data) {
                    if ($data->siswa) {
                        $row = $val + 2;
                        $event->sheet->setCellValue("A$row", $val + 1);
                        $event->sheet->setCellValue("B$row", $data->siswa->no_induk);
                        $event->sheet->setCellValue("C$row", $data->siswa->nama_siswa);
                    }
                }

                $event->sheet->getStyle("A1:D$row")->getBorders()->getAllBorders()->setBorderStyle('thin');
                $event->sheet->getStyle("D2:D$row")->applyFromArray($styleInput);
            },
        ];
    }
}
