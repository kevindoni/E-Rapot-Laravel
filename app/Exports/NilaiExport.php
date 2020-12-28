<?php

namespace App\Exports;

use App\Models\Jadwal;
use App\Models\KelasSiswa;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class NilaiExport implements WithHeadings, WithEvents, ShouldAutoSize
{
    use Exportable;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function headings(): array
    {
        return [
            "No",
            "No Induk Siswa",
            "Nama Siswa",
            "Mata Pelajaran",
            "Nilai Pengetahuan",
            "Nilai Keterampilan"
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
                $event->sheet->getStyle('A1:F1')->applyFromArray($styleHeader);

                $jadwal = Jadwal::with('mapel')->find($this->id);
                $siswa = KelasSiswa::with('siswa')->where('kelas_id', $jadwal->kelas_id)->get();
                foreach ($siswa as $val => $data) {
                    if ($data->siswa) {
                        $row = $val + 2;
                        $event->sheet->setCellValue("A$row", $val + 1);
                        $event->sheet->setCellValue("B$row", $data->siswa->no_induk);
                        $event->sheet->setCellValue("C$row", $data->siswa->nama_siswa);
                        $event->sheet->setCellValue("D$row", $jadwal->mapel->nama_mapel);
                    }
                }

                $event->sheet->getStyle("A1:F$row")->getBorders()->getAllBorders()->setBorderStyle('thin');
                $event->sheet->getStyle("E2:E$row")->applyFromArray($styleInput);
                $event->sheet->getStyle("F2:F$row")->applyFromArray($styleInput);
            },
        ];
    }
}
