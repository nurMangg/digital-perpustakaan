<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BukusExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Buku::with('kategori')->get()->map(function($buku) {
            return [
                $buku->bukuId,
                $buku->bukuNama,
                $buku->kategori->kategoriNama ?? 'No Kategori',
                $buku->bukuDeskripsi,
                $buku->bukuJumlah,
            ];
        });
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Buku',
            'Kategori',
            'Deskripsi',
            'Jumlah',
        ];
    }
}
