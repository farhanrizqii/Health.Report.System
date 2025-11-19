<?php

namespace App\Exports;

use App\Models\KegiatanPosyandu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KegiatanPosyanduExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return KegiatanPosyandu::with('wilayah')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Jenis Kegiatan',
            'Wilayah',
            'RT/RW',
            'Tanggal',
            'Jumlah Peserta',
            'Keterangan',
        ];
    }

    public function map($kegiatan): array
    {
        return [
            $kegiatan->id,
            $kegiatan->jenis_kegiatan,
            $kegiatan->wilayah->kelurahan ?? '-',
            ($kegiatan->wilayah->rt ?? '-') . '/' . ($kegiatan->wilayah->rw ?? '-'),
            \Carbon\Carbon::parse($kegiatan->tanggal)->format('d-m-Y'),
            $kegiatan->jumlah_peserta ?? '-',
            $kegiatan->keterangan ?? '-',
        ];
    }
}