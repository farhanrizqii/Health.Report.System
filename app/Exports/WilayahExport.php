<?php

namespace App\Exports;

use App\Models\Wilayah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class WilayahExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Wilayah::orderBy('kelurahan')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Kelurahan/Desa',
            'RW',
            'RT',
            'Status Wilayah',
            'Dibuat Pada',
        ];
    }

    public function map($wilayah): array
    {
        $status = $wilayah->parent_id ? 'Child' : 'Tingkat Kelurahan/Desa';
        
        return [
            $wilayah->id,
            $wilayah->kelurahan,
            $wilayah->rw ?? '-',
            $wilayah->rt ?? '-',
            $status,
            $wilayah->created_at ? $wilayah->created_at->format('d-m-Y H:i') : '-',
        ];
    }
}