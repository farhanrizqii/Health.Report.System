<?php

namespace App\Exports;

use App\Models\Imunisasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ImunisasiExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * Mengambil data collection dari database dengan relasi penduduk
     */
    public function collection()
    {
        return Imunisasi::with('penduduk')->orderBy('tanggal_imunisasi', 'desc')->get();
    }

    /**
     * Menentukan header kolom pada Excel
     */
    public function headings(): array
    {
        return [
            'No',
            'NIK',
            'Nama Lengkap',
            'Jenis Imunisasi',
            'Tanggal Imunisasi',
            'Fasilitas Kesehatan',
            'Tanggal Dicatat'
        ];
    }

    /**
     * Mapping/formatting data sebelum di-export
     */
    public function map($imunisasi): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $imunisasi->penduduk->nik ?? '-',
            $imunisasi->penduduk->nama_lengkap ?? '-',
            $imunisasi->jenis_imunisasi ?? '-',
            $imunisasi->tanggal_imunisasi ? \Carbon\Carbon::parse($imunisasi->tanggal_imunisasi)->format('d-m-Y') : '-',
            $imunisasi->faskes ?? '-',
            $imunisasi->created_at ? $imunisasi->created_at->format('d-m-Y H:i') : '-'
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