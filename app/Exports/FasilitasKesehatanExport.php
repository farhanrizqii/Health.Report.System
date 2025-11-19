<?php

namespace App\Exports;

use App\Models\FasilitasKesehatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FasilitasKesehatanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return FasilitasKesehatan::orderBy('nama_faskes')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Fasilitas',
            'Jenis Fasilitas',
            'Alamat',
            'Kontak (Telepon)',
            'Dibuat Pada',
        ];
    }

    public function map($fasilitas): array
    {
        return [
            $fasilitas->id,
            $fasilitas->nama_faskes,
            $fasilitas->jenis_faskes,
            $fasilitas->alamat,
            $fasilitas->kontak ?? '-',
            $fasilitas->created_at ? $fasilitas->created_at->format('d-m-Y H:i') : '-',
        ];
    }
}