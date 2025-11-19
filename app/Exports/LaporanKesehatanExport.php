<?php

namespace App\Exports;

use App\Models\LaporanKesehatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LaporanKesehatanExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return LaporanKesehatan::with(['fasilitas', 'user', 'detailPenyakit.kategoriPenyakit', 'detailPenyakit.penduduk'])
                               ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Tanggal Laporan',
            'Fasilitas Kesehatan',
            'Jenis Kegiatan',
            'Deskripsi Laporan',
            'Nama Petugas',
            'Penyakit',
            'Penduduk Terkait',
            'Jumlah Kasus',
            'Keterangan',
        ];
    }

    public function map($laporan): array
    {
        // Gabungkan detail penyakit menjadi string
        $detailPenyakit = $laporan->detailPenyakit->map(function ($detail) {
            return $detail->kategoriPenyakit->nama_penyakit . ' (' . $detail->penduduk->nama_lengkap . ': ' . $detail->jumlah_kasus . ' kasus)';
        })->implode('; ');

        return [
            $laporan->id,
            $laporan->tanggal_laporan,
            $laporan->fasilitas->nama_faskes ?? '-',
            $laporan->jenis_kegiatan,
            $laporan->deskripsi_laporan,
            $laporan->user->name ?? '-',
            '',
            '',
            '',
            $detailPenyakit,
        ];
    }
}