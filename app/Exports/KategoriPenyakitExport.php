<?php

namespace App\Exports;

use App\Models\KategoriPenyakit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KategoriPenyakitExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * Mengambil data collection dari database
     */
    public function collection()
    {
        return KategoriPenyakit::orderBy('nama_penyakit')->get();
    }

    /**
     * Menentukan header kolom pada Excel
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Penyakit',
            'Kode ICD',
            'Tanggal Dibuat'
        ];
    }

    /**
     * Mapping/formatting data sebelum di-export
     */
    public function map($kategoriPenyakit): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $kategoriPenyakit->nama_penyakit,
            $kategoriPenyakit->kode_icd ?? '-',
            $kategoriPenyakit->created_at ? $kategoriPenyakit->created_at->format('d-m-Y H:i') : '-'
        ];
    }

    /**
     * Styling untuk Excel (Header Bold)
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Style untuk baris pertama (header)
            1 => [
                'font' => [
                    'bold' => true, 
                    'size' => 12
                ]
            ],
        ];
    }
}