<?php

namespace App\Exports;

use App\Models\IbuHamil;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IbuHamilExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * Mengambil data collection dari database dengan relasi penduduk
     */
    public function collection()
    {
        return IbuHamil::with('penduduk')->orderBy('id', 'desc')->get();
    }

    /**
     * Menentukan header kolom pada Excel
     */
    public function headings(): array
    {
        return [
            'No',
            'NIK Ibu',
            'Nama Ibu',
            'Tanggal Mulai Hamil',
            'Usia Kehamilan (Minggu)',
            'Tanggal Perkiraan Lahir (TPL)',
            'Golongan Darah',
            'Tinggi Badan (cm)',
            'Berat Badan (kg)',
            'Risiko Kehamilan',
            'Keterangan Tambahan',
            'Tanggal Dibuat'
        ];
    }

    /**
     * Mapping/formatting data sebelum di-export
     */
    public function map($ibuHamil): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $ibuHamil->penduduk->nik ?? '-',
            $ibuHamil->penduduk->nama_lengkap ?? '-',
            $ibuHamil->tanggal_mulai_hamil ? \Carbon\Carbon::parse($ibuHamil->tanggal_mulai_hamil)->format('d-m-Y') : '-',
            $ibuHamil->usia_kehamilan_minggu ?? '-',
            $ibuHamil->tanggal_perkiraan_lahir ? \Carbon\Carbon::parse($ibuHamil->tanggal_perkiraan_lahir)->format('d-m-Y') : '-',
            $ibuHamil->golongan_darah ?? '-',
            $ibuHamil->tinggi_badan ? number_format($ibuHamil->tinggi_badan, 1) : '-',
            $ibuHamil->berat_badan ? number_format($ibuHamil->berat_badan, 1) : '-',
            $ibuHamil->risiko_kehamilan ?? '-',
            $ibuHamil->keterangan_lain ?? '-',
            $ibuHamil->created_at ? $ibuHamil->created_at->format('d-m-Y H:i') : '-'
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