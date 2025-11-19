<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendudukExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    /**
     * Mengambil data collection dari database dengan relasi wilayah
     */
    public function collection()
    {
        return Penduduk::with('wilayah')->orderBy('nama_lengkap')->get();
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
            'No. KK',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Golongan Darah',
            'Alamat',
            'No. HP',
            'Kelurahan/Desa',
            'RW',
            'RT',
            'Kecamatan',
            'Tanggal Dibuat'
        ];
    }

    /**
     * Mapping/formatting data sebelum di-export
     */
    public function map($penduduk): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $penduduk->nik,
            $penduduk->nama_lengkap,
            $penduduk->no_kk ?? '-',
            $penduduk->tanggal_lahir ? \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d-m-Y') : '-',
            $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan',
            $penduduk->golongan_darah ?? '-',
            $penduduk->alamat ?? '-',
            $penduduk->no_hp ?? '-',
            $penduduk->wilayah->kelurahan ?? '-',
            $penduduk->wilayah->rw ?? '-',
            $penduduk->wilayah->rt ?? '-',
            $penduduk->wilayah->kecamatan ?? '-',
            $penduduk->created_at ? $penduduk->created_at->format('d-m-Y H:i') : '-'
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